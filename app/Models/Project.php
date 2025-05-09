<?php

namespace App\Models;

use App\Constants\Statuses\TtStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'title',
        'status',
        'description',
        'start_date',
        'deadline',
        'user_id'
    ];

    public function manager() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function users() {
        return $this->belongsToMany(User::class, 'project__user');
    }
    public function tasks() {
        return $this->belongsToMany(Tt::class, 'project__tts');
    }


    public function total_tasks() {
        return $this->tasks()->count();
    }
    public function completed_tasks() {
        return $this->tasks()->where('status', TtStatuses::COMPLETED)->count();
    }
    public function progress() {
        $total = $this->total_tasks();
        $completed = $this->completed_tasks();

        if($total == 0 || $completed == 0) {
            return 0;
        }
        return round(($completed / $total) * 100);
    }
}
