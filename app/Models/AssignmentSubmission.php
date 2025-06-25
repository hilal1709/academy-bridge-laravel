<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'content',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'submitted_at',
        'is_late',
        'score',
        'feedback',
        'graded_at',
        'status',
        'metadata',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
        'is_late' => 'boolean',
        'score' => 'decimal:2',
        'metadata' => 'array',
    ];

    // Relationship dengan assignment
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    // Relationship dengan student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Scope untuk submission yang sudah dinilai
    public function scopeGraded($query)
    {
        return $query->where('status', 'graded');
    }

    // Scope untuk submission yang terlambat
    public function scopeLate($query)
    {
        return $query->where('is_late', true);
    }

    // Method untuk mendapatkan URL download file
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

    // Method untuk cek apakah file ada
    public function fileExists()
    {
        if (!$this->file_path) return false;
        return Storage::exists($this->file_path);
    }

    // Method untuk mendapatkan nilai dengan penalty jika terlambat
    public function getFinalScoreAttribute()
    {
        if (!$this->score) return null;
        
        if ($this->is_late && $this->assignment->late_penalty_percent > 0) {
            $penalty = ($this->assignment->late_penalty_percent / 100) * $this->score;
            return max(0, $this->score - $penalty);
        }
        
        return $this->score;
    }

    // Method untuk mendapatkan grade letter
    public function getGradeLetterAttribute()
    {
        if (!$this->final_score) return null;
        
        $percentage = ($this->final_score / $this->assignment->max_score) * 100;
        
        if ($percentage >= 85) return 'A';
        if ($percentage >= 80) return 'A-';
        if ($percentage >= 75) return 'B+';
        if ($percentage >= 70) return 'B';
        if ($percentage >= 65) return 'B-';
        if ($percentage >= 60) return 'C+';
        if ($percentage >= 55) return 'C';
        if ($percentage >= 50) return 'C-';
        if ($percentage >= 45) return 'D+';
        if ($percentage >= 40) return 'D';
        
        return 'E';
    }
}
