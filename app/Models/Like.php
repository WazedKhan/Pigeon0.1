<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table='post_user';
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
