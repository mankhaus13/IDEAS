<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
    use HasFactory;

    protected $table = 'user__role';
    protected $fillable = ['user_id', 'role_id'];
}
