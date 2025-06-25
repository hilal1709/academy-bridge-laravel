<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ClassroomMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'title',
        'description',
        'type',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'content',
        'external_link',
        'week',
        'publish_date',
        'is_published',
        'download_count',
        'metadata',
    ];

    protected $casts = [
        'publish_date' => 'date',
        'is_published' => 'boolean',
        'download_count' => 'integer',
        'week' => 'integer',
        'metadata' => 'array',
    ];

    // Relationship dengan classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Scope untuk materi yang sudah dipublikasi
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope untuk materi berdasarkan tipe
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope untuk materi berdasarkan minggu
    public function scopeByWeek($query, $week)
    {
        return $query->where('week', $week);
    }

    // Method untuk mendapatkan URL download
    public function getDownloadUrlAttribute()
    {
        if ($this->file_path) {
            return Storage::url($this->file_path);
        }
        return null;
    }

    // Method untuk mendapatkan ukuran file dalam format readable
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return null;
        
        $bytes = intval($this->file_size);
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Method untuk increment download count
    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    // Method untuk cek apakah file ada
    public function fileExists()
    {
        if (!$this->file_path) return false;
        return Storage::exists($this->file_path);
    }

    // Method untuk mendapatkan icon berdasarkan tipe file
    public function getFileIconAttribute()
    {
        $icons = [
            'pdf' => 'fas fa-file-pdf text-red-500',
            'doc' => 'fas fa-file-word text-blue-500',
            'docx' => 'fas fa-file-word text-blue-500',
            'ppt' => 'fas fa-file-powerpoint text-orange-500',
            'pptx' => 'fas fa-file-powerpoint text-orange-500',
            'xls' => 'fas fa-file-excel text-green-500',
            'xlsx' => 'fas fa-file-excel text-green-500',
            'jpg' => 'fas fa-file-image text-purple-500',
            'jpeg' => 'fas fa-file-image text-purple-500',
            'png' => 'fas fa-file-image text-purple-500',
            'gif' => 'fas fa-file-image text-purple-500',
            'mp4' => 'fas fa-file-video text-red-600',
            'avi' => 'fas fa-file-video text-red-600',
            'mov' => 'fas fa-file-video text-red-600',
            'zip' => 'fas fa-file-archive text-yellow-500',
            'rar' => 'fas fa-file-archive text-yellow-500',
        ];

        return $icons[$this->file_type] ?? 'fas fa-file text-gray-500';
    }
}
