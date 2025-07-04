<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blogPost) {
            $blogPost->slug = Str::slug($blogPost->title);
        });

        static::updating(function ($blogPost) {
            $blogPost->slug = Str::slug($blogPost->title);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }
}
