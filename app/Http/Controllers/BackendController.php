<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
use Responsive;

class BackendController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
    	$postData = Post::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

                    //dd($postData);

     	return view('website.backend.dashboard.index', compact('postData'));
    }
}
