<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission($permission)
    {
        return $this->permissions()
            ->where('slug', $permission)
            ->exists();
    }
}
