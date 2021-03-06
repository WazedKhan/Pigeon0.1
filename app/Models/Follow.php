<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Table\Table;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'profile_user';
    protected $guarded = [];
    
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
