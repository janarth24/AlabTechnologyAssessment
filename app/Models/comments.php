<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $fillable = [
    'user_id',
    'postid',
    'comment_content',
];

public function blog()
{
    return $this->belongsTo(Blog::class, 'postid', 'id');
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
