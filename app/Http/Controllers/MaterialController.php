<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course;
use App\Models\User;
use App\Models\MaterialVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class MaterialController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Use Eloquent query with relationships for proper model binding
        $query = Material::with(['course', 'user'])
            ->when($request->filled('verified'), function ($query) {
                $query->where('is_verified', true);
            })
            ->when($request->filled('course'), function ($query) use ($request) {
                $query->where('course_id', $request->course);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', "%{$request->search}%")
                        ->orWhere('description', 'like', "%{$request->search}%");
                });
            })
            ->when($request->filled('fakultas'), function ($query) use ($request) {
                $fakultas = $request->fakultas === 'other' ? $request->fakultas_other : $request->fakultas;
                if ($fakultas) {
                    $query->where('fakultas', 'like', "%{$fakultas}%");
                }
            })
            ->when($request->filled('jurusan'), function ($query) use ($request) {
                $jurusan = $request->jurusan === 'other' ? $request->jurusan_other : $request->jurusan;
                if ($jurusan) {
                    $query->where('jurusan', 'like', "%{$jurusan}%");
                }
            })
            ->when($request->filled('semester'), function ($query) use ($request) {
                $query->where('semester', $request->semester);
            })
            ->when($request->filled('mata_kuliah'), function ($query) use ($request) {
                $mata_kuliah = $request->mata_kuliah === 'other' ? $request->mata_kuliah_other : $request->mata_kuliah;
                if ($mata_kuliah) {
                    $query->where('mata_kuliah', 'like', "%{$mata_kuliah}%");
                }
            })
            ->latest();

        $materials = $query->paginate(10)->withQueryString();
        $courses = Course::all();

        // Log query for debugging
        Log::info('Materials Index Query', [
            'total_materials' => $materials->total(),
            'current_page' => $materials->currentPage(),
            'per_page' => $materials->perPage(),
            'filters' => $request->all(),
            'results_count' => $materials->count(),
            'user_id' => Auth::id(),
            'timestamp' => now()->toDateTimeString()
        ]);

        // Additional debug logging
        Log::info('Materials Index - Raw Materials Data', [
            'materials_collection' => $materials->items(),
            'materials_ids' => $materials->pluck('id')->toArray()
        ]);

        // Add cache-busting timestamp
        $cacheTimestamp = now()->timestamp;

        return view('materials.index', compact('materials', 'courses', 'cacheTimestamp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        
        // Ensure at least one course exists
        if ($courses->isEmpty()) {
            $user = Auth::user();
            $defaultCourse = Course::create([
                'name' => 'General Course',
                'code' => 'GEN001',
                'description' => 'Default course for materials',
                'user_id' => $user->id
            ]);
            $courses = collect([$defaultCourse]);
        }
        
        return view('materials.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Material Upload - Request Started', [
            'user_id' => Auth::id(),
            'request_data' => $request->except(['file']),
            'has_file' => $request->hasFile('file')
        ]);

        // Ensure course exists, create default if needed
        $courseId = $request->input('course_id', 1);
        $course = Course::find($courseId);
        if (!$course) {
            Log::warning('Course not found, creating default course', ['requested_course_id' => $courseId]);
            $course = Course::create([
                'name' => 'General Course',
                'code' => 'GEN001',
                'description' => 'Default course for materials',
                'user_id' => Auth::id()
            ]);
            $courseId = $course->id;
        }

        // Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt,zip,rar|max:20480',
            'course_id' => 'nullable|integer',
            'fakultas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'semester' => 'required|string|max:10',
            'mata_kuliah' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'fakultas_other' => 'nullable|required_if:fakultas,other|string|max:255',
            'jurusan_other' => 'nullable|required_if:jurusan,other|string|max:255',
            'mata_kuliah_other' => 'nullable|required_if:mata_kuliah,other|string|max:255',
        ], [
            'file.mimes' => 'File harus berformat: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, TXT, ZIP, atau RAR',
            'file.max' => 'Ukuran file maksimal 20MB',
            'title.required' => 'Judul materi wajib diisi',
            'description.required' => 'Deskripsi materi wajib diisi',
                        'fakultas.required' => 'Fakultas wajib dipilih',
            'jurusan.required' => 'Jurusan wajib dipilih',
            'semester.required' => 'Semester wajib dipilih',
            'mata_kuliah.required' => 'Mata kuliah wajib dipilih',
        ]);

        // Override course_id with the verified one
        $validated['course_id'] = $courseId;

        Log::info('Material Upload - Validation Passed', ['validated_data' => $validated]);

        // Handle "other" options
        $fakultas = $validated['fakultas'] === 'other' ? ($request->input('fakultas_other') ?? '') : $validated['fakultas'];
        $jurusan = $validated['jurusan'] === 'other' ? ($request->input('jurusan_other') ?? '') : $validated['jurusan'];
        $mata_kuliah = $validated['mata_kuliah'] === 'other' ? ($request->input('mata_kuliah_other') ?? '') : $validated['mata_kuliah'];

        // Validate processed values
        if (empty($fakultas) || empty($jurusan) || empty($mata_kuliah)) {
            Log::error('Material Upload - Empty processed values', [
                'fakultas' => $fakultas,
                'jurusan' => $jurusan,
                'mata_kuliah' => $mata_kuliah
            ]);
            return redirect()->back()->withInput()->withErrors([
                'fakultas' => empty($fakultas) ? 'Fakultas tidak boleh kosong' : null,
                'jurusan' => empty($jurusan) ? 'Jurusan tidak boleh kosong' : null,
                'mata_kuliah' => empty($mata_kuliah) ? 'Mata kuliah tidak boleh kosong' : null,
            ]);
        }

        // Ensure storage directory exists
        $materialsDir = storage_path('app/public/materials');
        if (!is_dir($materialsDir)) {
            mkdir($materialsDir, 0755, true);
            Log::info('Material Upload - Created materials directory', ['path' => $materialsDir]);
        }

        // Generate unique filename
        $originalName = $request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = time() . '_' . str_replace(' ', '_', pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

        Log::info('Material Upload - File Processing', [
            'original_name' => $originalName,
            'new_filename' => $filename,
            'file_size' => $request->file('file')->getSize()
        ]);

        // Start database transaction
        DB::beginTransaction();
        
        try {
            // Store the file first
            $filePath = $request->file('file')->storeAs('materials', $filename, 'public');
            
            if (!$filePath) {
                throw new \Exception('Gagal menyimpan file ke storage');
            }

            // Verify file was stored
            if (!Storage::disk('public')->exists($filePath)) {
                throw new \Exception('File tidak tersimpan dengan benar di storage');
            }

            Log::info('Material Upload - File Stored Successfully', [
                'file_path' => $filePath,
                'storage_path' => storage_path('app/public/' . $filePath)
            ]);

            // Prepare material data
            $materialData = [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'file_path' => $filePath,
                'original_filename' => $originalName,
                'course_id' => $validated['course_id'],
                'user_id' => Auth::id(),
                'fakultas' => $fakultas,
                'jurusan' => $jurusan,
                'semester' => $validated['semester'],
                'mata_kuliah' => $mata_kuliah,
                'kategori' => $validated['kategori'],
                'is_verified' => false,
                'downloads_count' => 0,
                'views_count' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ];

            Log::info('Material Upload - Attempting Database Insert', [
                'material_data' => $materialData
            ]);

            // Try multiple insertion methods for reliability
            $materialId = null;
            $insertSuccess = false;

            // Method 1: Direct DB insert (most reliable)
            try {
                $materialId = DB::table('materials')->insertGetId($materialData);
                if ($materialId) {
                    $insertSuccess = true;
                    Log::info('Material Upload - DB Insert Success', ['material_id' => $materialId]);
                }
            } catch (\Exception $e) {
                Log::error('Material Upload - DB Insert Failed', ['error' => $e->getMessage()]);
            }

            // Method 2: Eloquent as fallback
            if (!$insertSuccess) {
                try {
                    $material = new Material();
                    foreach ($materialData as $key => $value) {
                        if ($key !== 'created_at' && $key !== 'updated_at') {
                            $material->$key = $value;
                        }
                    }
                    
                    $saved = $material->save();
                    if ($saved && $material->id) {
                        $materialId = $material->id;
                        $insertSuccess = true;
                        Log::info('Material Upload - Eloquent Insert Success', ['material_id' => $materialId]);
                    }
                } catch (\Exception $e) {
                    Log::error('Material Upload - Eloquent Insert Failed', ['error' => $e->getMessage()]);
                }
            }

            if (!$insertSuccess || !$materialId) {
                throw new \Exception('Gagal menyimpan data materi ke database');
            }

            // Verify the material was saved and can be retrieved
            $savedMaterial = DB::table('materials')->where('id', $materialId)->first();
            if (!$savedMaterial) {
                throw new \Exception('Materi tersimpan tapi tidak dapat diambil kembali');
            }

            Log::info('Material Upload - Verification Success', [
                'material_id' => $materialId,
                'title' => $savedMaterial->title,
                'file_path' => $savedMaterial->file_path
            ]);

            // Commit transaction
            DB::commit();

            Log::info('Material Upload - Complete Success', [
                'material_id' => $materialId,
                'user_id' => Auth::id(),
                'title' => $savedMaterial->title
            ]);

            // Get material for redirect
            $material = Material::find($materialId);
            if (!$material) {
                // Fallback: redirect to index with success message
                return redirect()->route('materials.index')
                    ->with('success', 'Materi berhasil diunggah dengan ID: ' . $materialId . '! Menunggu verifikasi dari dosen.');
            }
            
            return redirect()->route('materials.show', $material)
                ->with('success', 'Materi berhasil diunggah! Menunggu verifikasi dari dosen.');

        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();
            
            // Clean up uploaded file
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                Log::info('Material Upload - File cleaned up after error', ['file_path' => $filePath]);
            }
            
            Log::error('Material Upload - Complete Failure', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['file'])
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengunggah materi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        $material->load(['course', 'user', 'discussions' => function ($query) {
            $query->whereNull('parent_id')->with(['user', 'replies.user']);
        }]);
        return view('materials.show', compact('material'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        // Check if user is the owner of the material
        if ($material->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus materi ini.');
        }

        try {
            DB::beginTransaction();

            // Delete file from storage
            if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }

            // Hard delete the material (no more soft delete)
            $material->delete();

            Log::info('Material Deleted', [
                'material_id' => $material->id,
                'user_id' => Auth::id(),
                'title' => $material->title
            ]);

            DB::commit();

            return redirect()->route('materials.index')
                ->with('success', 'Materi berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Material Delete Failed', [
                'material_id' => $material->id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus materi: ' . $e->getMessage());
        }
    }

    public function toggleSave(Material $material)
    {
        Auth::user()->savedMaterials()->toggle($material->id);
        return back()->with('success', 'Material saved status updated!');
    }

    public function download(Material $material)
    {
        $material->increment('downloads_count');

        $filePath = storage_path('app/public/' . $material->file_path);
        $downloadName = $material->original_filename ?? basename($material->file_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath, $downloadName);
    }

    public function saved()
    {
        $materials = Auth::user()->savedMaterials()->with(['course', 'user'])->paginate(10);
        return view('materials.saved', compact('materials'));
    }

    /**
     * Show materials pending verification (for lecturers only)
     */
    public function pendingVerification()
    {
        // Check if user is a lecturer
        if (!Auth::user()->isLecturer()) {
            abort(403, 'Hanya dosen yang dapat mengakses halaman ini.');
        }

        $materials = Material::with(['user', 'course', 'verifications' => function($query) {
            $query->latest();
        }])
        ->where('is_verified', false)
        ->whereDoesntHave('verifications', function($query) {
            $query->where('status', 'approved');
        })
        ->latest()
        ->paginate(10);

        return view('materials.pending-verification', compact('materials'));
    }

    /**
     * Verify a material (for lecturers only)
     */
    public function verify(Request $request, Material $material)
    {
        // Check if user is a lecturer
        if (!Auth::user()->isLecturer()) {
            abort(403, 'Hanya dosen yang dapat memverifikasi materi.');
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'comments' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // Create verification record
            $verification = MaterialVerification::create([
                'material_id' => $material->id,
                'verified_by' => Auth::id(),
                'status' => $request->status,
                'comments' => $request->comments,
            ]);

            // Update material verification status if approved
            if ($request->status === 'approved') {
                $material->update(['is_verified' => true]);
                $message = 'Materi berhasil diverifikasi dan disetujui!';
            } else {
                $material->update(['is_verified' => false]);
                $message = 'Materi telah ditolak dengan alasan yang diberikan.';
            }

            DB::commit();

            Log::info('Material Verification', [
                'material_id' => $material->id,
                'verified_by' => Auth::id(),
                'status' => $request->status,
                'comments' => $request->comments
            ]);

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Material Verification Failed', [
                'material_id' => $material->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memverifikasi materi.');
        }
    }

    /**
     * Show verification history for a material
     */
    public function verificationHistory(Material $material)
    {
        // Check if user is lecturer or material owner
        if (!Auth::user()->isLecturer() && $material->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat riwayat verifikasi materi ini.');
        }

        $verifications = $material->verifications()
            ->with('verifier')
            ->latest()
            ->paginate(10);

        return view('materials.verification-history', compact('material', 'verifications'));
    }

    /**
     * Show all verified materials
     */
    public function verified()
    {
        $materials = Material::with(['course', 'user', 'verifications' => function($query) {
            $query->approved()->latest();
        }])
        ->where('is_verified', true)
        ->latest()
        ->paginate(12);

        return view('materials.verified', compact('materials'));
    }
}
