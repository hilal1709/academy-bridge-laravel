<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'student_id',
        'enrolled_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
    ];

    // Relationship dengan classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Relationship dengan student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Scope untuk enrollment aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope untuk enrollment berdasarkan classroom
    public function scopeByClassroom($query, $classroomId)
    {
        return $query->where('classroom_id', $classroomId);
    }
}
