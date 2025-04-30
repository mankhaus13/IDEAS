<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Profiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'passport_series',
        'passport_number',
        'passport_issued_at',
        'passport_issued_by',
        'phone',
        'address'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
