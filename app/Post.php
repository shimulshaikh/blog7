<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = "posts";
    protected $fillable = ["user_id", "title", "slug", "image", "body", "view_count", "status", "is_approved"];




    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function tags()
    {
    	return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function favorite_user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

}
