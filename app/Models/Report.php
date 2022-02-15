<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function report_category()
    {
        return $this->belongsTo(ReportCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'reporter_id','id');
    }
}
