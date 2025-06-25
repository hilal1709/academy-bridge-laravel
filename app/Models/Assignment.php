<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'title',
        'description',
        'instructions',
        'type',
        'max_score',
        'start_date',
        'due_date',
        'late_submission_date',
        'allow_late_submission',
        'late_penalty_percent',
        'attachment_path',
        'attachment_name',
        'is_published',
        'submission_settings',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'due_date' => 'datetime',
        'late_submission_date' => 'datetime',
        'allow_late_submission' => 'boolean',
        'is_published' => 'boolean',
        'max_score' => 'integer',
        'late_penalty_percent' => 'integer',
        'submission_settings' => 'array',
    ];

    // Relationship dengan classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Relationship dengan submissions (akan dibuat nanti)
    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    // Scope untuk assignment yang sudah dipublikasi
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope untuk assignment yang sedang aktif
    public function scopeActive($query)
    {
        return $query->where('start_date', '<=', now())
                    ->where('due_date', '>=', now());
    }

    // Scope untuk assignment yang sudah lewat deadline
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now());
    }

    // Method untuk cek apakah assignment sudah dimulai
    public function hasStarted()
    {
        return Carbon::now()->greaterThanOrEqualTo($this->start_date);
    }

    // Method untuk cek apakah assignment sudah lewat deadline
    public function isOverdue()
    {
        return Carbon::now()->greaterThan($this->due_date);
    }

    // Method untuk cek apakah masih bisa submit terlambat
    public function canSubmitLate()
    {
        if (!$this->allow_late_submission) return false;
        if (!$this->late_submission_date) return false;
        
        return Carbon::now()->lessThanOrEqualTo($this->late_submission_date);
    }

    // Method untuk mendapatkan status assignment
    public function getStatusAttribute()
    {
        if (!$this->hasStarted()) {
            return 'upcoming';
        } elseif ($this->isOverdue()) {
            if ($this->canSubmitLate()) {
                return 'late_submission';
            }
            return 'closed';
        } else {
            return 'active';
        }
    }

    // Method untuk mendapatkan waktu tersisa
    public function getTimeRemainingAttribute()
    {
        if ($this->isOverdue()) {
            return null;
        }
        
        return Carbon::now()->diffForHumans($this->due_date, true);
    }

    // Method untuk mendapatkan jumlah submission
    public function getSubmissionCountAttribute()
    {
        return $this->submissions()->count();
    }

    // Method untuk mendapatkan submission dari student tertentu
    public function getSubmissionByStudent($studentId)
    {
        return $this->submissions()->where('student_id', $studentId)->first();
    }
}
