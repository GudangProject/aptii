<?php

namespace App\Models\Prosiding;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProsidingNaskah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
