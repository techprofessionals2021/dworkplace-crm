<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Department\Department;
use App\Models\Permission\Permission;
use App\Models\Role\Role;
use App\Models\Status\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'status_id',
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
        'password' => 'hashed',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function getPermissions()
    {
        return Permission::join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
        ->join('roles', 'role_permissions.role_id', '=', 'roles.id')
        ->whereIn('roles.id', $this->roles->pluck('id'))
        ->select('permissions.*')
        ->get();
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'user_departments', 'user_id','department_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }


    public function getDepartmentPermissions()
    {
        return Permission::join('role_permission_departments', 'permissions.id', '=', 'role_permission_departments.permission_id')
        ->join('roles', 'role_permission_departments.role_id', '=', 'roles.id')
        ->whereIn('roles.id', $this->roles->pluck('id'))
        ->whereIn('role_permission_departments.department_id', $this->departments->pluck('id'))
        ->select('permissions.*')
        ->get();
    }

}
