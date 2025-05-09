<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function resources() {
        return $this->hasMany(Resource::class);
    }
    public function roles() {
        return $this->belongsToMany(Role::class, "user__roles");
    }
    public function extraInfo() {
        return $this->hasOne(User_Profiles::class);
    }
    public function managedProjects() {
        return $this->hasMany(Project::class);
    }
    public function participatedProjects() {
        return $this->belongsToMany(Project::class, 'project__user');
    }

    public function hasRole($role) {
        if(is_string($role)) {
            return $this->roles->contains('title', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }
    public function hasPermissions($permissions) {
        $userPermissions = $this->roles->flatMap(function ($role) {
            return $role->permissions;
        });
        $userPermissionsTitle = $userPermissions->map(function ($userPermission) {
            return $userPermission->title;
        })->toArray();

       return empty(array_diff($permissions, $userPermissionsTitle));
    }
}
