<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class AdminUser extends User
{
    use HasFactory , Notifiable;
    protected $guarded= [];


    /**
     * relationship with role table
     */

     public function role()
     {
       return $this->belongsTo(Role::class, 'role_id', 'id');
     }



}
