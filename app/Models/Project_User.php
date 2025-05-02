<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_User extends Model
{
    use HasFactory;

    protected $table = 'project__user';
    protected $fillable = ['project_id','user_id'];
}
