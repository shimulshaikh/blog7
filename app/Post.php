<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = "posts";
    protected $fillable = ["user_id", "title", "slug", "image", "body", "view_count", "status", "is_approved"];




    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class)->withTimestamps();
        //return $this->belongsToMany(Category::class, 'category_post','post_id','category_id');
    }

    public function tags()
    {
    	return $this->belongsToMany(Tag::class)->withTimestamps();
        //return $this->belongsToMany(Tag::class, 'post_tag','post_id','tag_id');
    }
}
