<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tt extends Model
{
    use HasFactory;

    protected $table = 'tts';
    protected $fillable = [
        'title',
        'status',
        'description',
        'start_date',
        'deadline',
    ];

    public function projects() {
        return $this->belongsToMany(Project::class, 'project__tts');
    }
}
