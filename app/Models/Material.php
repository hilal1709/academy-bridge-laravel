<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Material extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'original_filename',
        'is_verified',
        'course_id',
        'user_id',
        'fakultas',
        'jurusan',
        'semester',
        'mata_kuliah',
        'kategori',
        'downloads_count',
        'views_count',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'metadata' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function verifications()
    {
        return $this->hasMany(MaterialVerification::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_materials');
    }
}
