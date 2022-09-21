<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $guarded=[];

    //connection with category dable
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
