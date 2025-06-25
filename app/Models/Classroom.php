<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'subject',
        'program',
        'semester',
        'academic_year',
        'status',
        'lecturer_id',
        'room',
        'schedule',
        'max_students',
        'syllabus',
        'cover_image',
    ];

    protected $casts = [
        'schedule' => 'array',
        'semester' => 'integer',
        'max_students' => 'integer',
    ];

    // Relationship dengan dosen
    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    // Relationship dengan enrollment (mahasiswa yang terdaftar)
    public function enrollments()
    {
        return $this->hasMany(ClassroomEnrollment::class);
    }

    // Relationship dengan mahasiswa melalui enrollment
    public function students()
    {
        return $this->belongsToMany(User::class, 'classroom_enrollments', 'classroom_id', 'student_id')
                    ->withPivot('enrolled_at', 'status')
                    ->withTimestamps();
    }

    // Relationship dengan materi kelas
    public function materials()
    {
        return $this->hasMany(ClassroomMaterial::class);
    }

    // Relationship dengan tugas
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // Scope untuk kelas aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope untuk kelas berdasarkan semester
    public function scopeBySemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }

    // Scope untuk kelas berdasarkan program studi
    public function scopeByProgram($query, $program)
    {
        return $query->where('program', $program);
    }

    // Method untuk mendapatkan jumlah mahasiswa terdaftar
    public function getEnrolledStudentsCountAttribute()
    {
        return $this->enrollments()->where('status', 'active')->count();
    }

    // Method untuk cek apakah kelas sudah penuh
    public function isFullAttribute()
    {
        return $this->enrolled_students_count >= $this->max_students;
    }

    // Method untuk generate kode kelas otomatis
    public static function generateClassCode($subject, $program, $semester, $academicYear)
    {
        $subjectCode = strtoupper(substr($subject, 0, 3));
        $programCode = strtoupper(substr($program, 0, 2));
        $semesterCode = str_pad($semester, 2, '0', STR_PAD_LEFT);
        $yearCode = substr($academicYear, 2, 2);
        
        $baseCode = $subjectCode . $programCode . $semesterCode . $yearCode;
        
        // Cek apakah kode sudah ada, jika ya tambahkan suffix
        $counter = 1;
        $code = $baseCode;
        while (self::where('code', $code)->exists()) {
            $code = $baseCode . '-' . $counter;
            $counter++;
        }
        
        return $code;
    }
}
