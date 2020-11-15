<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Post;
use App\Category;
use App\Tag;

class PostDetailsController extends Controller
{
    public function postDetails($slug)
    {
    	$post = Post::where('slug', $slug)->approved()->published()->first();

    	$blogKey = 'blog_'.$post->id;

    	if (!Session::has($blogKey)) {
			$post->increment('view_count');
			Session::put($blogKey,1);    		
    	}

    	$randomPosts = Post::approved()->published()->take(3)->inRandomOrder()->get();

    	return view('website.frontend.post_details.post',compact('post', 'randomPosts'));
    }


    public function postByCategory($slug)
    {
        $category = Category::where('slug',$slug)->first();
        //Check Post Published & Approved
        $posts = $category->posts()->approved()->published()->get();
        
        return view('website.frontend.categoryPost.index',compact('category', 'posts'));
    }

    public function postByTag($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        //Check Post Published & Approved
        $posts = $tag->posts()->approved()->published()->get();

        return view('website.frontend.tagPost.index',compact('tag', 'posts'));
    }

}
