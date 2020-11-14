<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostDetailsController extends Controller
{
    public function postDetails($slug)
    {
    	$post = Post::where('slug', $slug)->first();
    	
    	$randomPosts = Post::all()->random(3);

    	return view('website.frontend.post_details.post',compact('post', 'randomPosts'));
    }

}
