<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'title', 'content', 'url', 'image', 'username'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'post_id');
        // Du moment qu'on abandonne les commentaires imbriqués
        // return $this->morphMany(Comment::class, 'user_id', 'post_id')->whereNull('parent_id');
    }
}
