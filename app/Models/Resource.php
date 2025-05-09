<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resource extends Model
{
    use HasFactory;

    protected $table = 'resources';
    protected $fillable = [
        'number_report',
        'user_id',
        'resource_name',
        'date_report',
        'description',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function countResourcesUseUser() {
        return self::query()
            ->with('user')
            ->select('user_id', DB::raw('count(*) as resources_count'))
            ->groupBy('user_id')
            ->get()
            ->pluck('resources_count', 'user.name')
            ->toArray();
    }
}
