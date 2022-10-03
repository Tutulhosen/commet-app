<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorypost extends Model
{
    use HasFactory;
    protected $guarded=[];

    //relation with post
    public function post()
    {
        return $this->belongsToMany(Post::class);
    }
}
