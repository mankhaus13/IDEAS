<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prototype extends Model
{
    use HasFactory;

    protected $table = 'prototypes';
    protected $fillable = [
        'number_exp',
        'model_detail',
        'date_exp',
        'status',
        'description',
    ];

    public static function completedExp() {
        $countSuccess = Prototype::where('status', 'success')->count();
        $all = Prototype::count();
        return  $countSuccess / $all * 100;
    }
}
