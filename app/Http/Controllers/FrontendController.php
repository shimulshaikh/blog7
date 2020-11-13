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
    	$posts = Post::latest()->take(6)->get();
    	return view('website.frontend.home.index', compact('categorys', 'posts'));
    }

    public function getPost()
    {
    	$categorys = Category::all();
    	$posts = Post::all();
    	return view('website.frontend.home.showAllPost', compact('categorys', 'posts'));
    }
}
