<?php

namespace App\Models\Prosiding;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Prosiding\ProsidingNaskah;

class Certificate extends Model
{
    use HasFactory;

    protected $table = 'prosiding_certificates';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAuthor(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getNaskah(){
        return $this->belongsTo(ProsidingNaskah::class, 'nashkah_id');
    }


}