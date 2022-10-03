<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];

    //relation with categorypost table
    public function categorypost()
    {
        return $this->belongsToMany(Categorypost::class);
    }

    //rtelation with tagpost
    public function tagpost()
    {
        return $this->belongsToMany(Tagpost::class);
    }
}
