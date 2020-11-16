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
    	$post = Post::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

        $months = Post::select(\DB::raw("Month(created_at) as month"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('month');    

        $postData = array(0,0,0,0,0,0,0,0,0,0,0,0);                    

        foreach ($months as $index => $month) {
                    $postData[$month] = $post[$index];
                }        

     	return view('website.backend.dashboard.index', compact('postData'));
    }
}
