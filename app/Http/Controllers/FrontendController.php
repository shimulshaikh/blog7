<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
    	$categorys = Category::all();
        $posts = Post::where('is_approved', true)->Published()->take(6)->get();
    	return view('website.frontend.home.index', compact('categorys', 'posts'));
    }

    public function getPost()
    {
        $posts = Post::where('is_approved', true)->Published()->take(6)->paginate(6);
    	return view('website.frontend.home.showAllPost', compact('posts'));
    }
}
