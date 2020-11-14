<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Post;

class PostDetailsController extends Controller
{
    public function postDetails($slug)
    {
    	$post = Post::where('slug', $slug)->first();

    	$blogKey = 'blog_'.$post->id;

    	if (!Session::has($blogKey)) {
			$post->increment('view_count');
			Session::put($blogKey,1);    		
    	}

    	$randomPosts = Post::all()->random(3);

    	return view('website.frontend.post_details.post',compact('post', 'randomPosts'));
    }

}
