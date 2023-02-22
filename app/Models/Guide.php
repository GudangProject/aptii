<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Guide extends Model
{
    use HasFactory;

    protected $guaded = [];

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function access($value)
    {
        $roleId = json_decode($value);
        $roles = Role::whereIn('id', $roleId)->pluck('name');

        return $roles;
    }
}
