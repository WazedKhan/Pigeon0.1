<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function liked()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function post_image()
    {
        return $this->hasMany(PostImage::class);
    }

    public function commnet()
    {
        return $this->hasMany(Commnet::class);
    }
}
