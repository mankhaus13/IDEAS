<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Tt extends Model
{
    use HasFactory;

    protected $table = 'project__tts';
    protected $fillable = ['project_id','tt_id'];
}
