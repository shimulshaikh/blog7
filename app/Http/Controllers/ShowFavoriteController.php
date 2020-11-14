<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Redirect,Response;
use Auth;

class ShowFavoriteController extends Controller
{
    public function index(Request $request)
    {
    	$posts = Auth::user()->favorite_post;
    	
    	if ($request->ajax()) {

            return Datatables::of($posts)
                ->setRowId('{{$id}}')
                ->editColumn('created_at', function($posts) {
                    return $posts->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function($posts) {
                    return $posts->updated_at->format('h:m:s');
                })
                ->addColumn('author', function($posts) {
                    return $posts->user->name;
                })
                ->addColumn('favorite', function($posts) {
                    return $posts->favorite_user->count();
                })
                ->addIndexColumn()->make(true);

        }  

    	return view('website.backend.favorite.index');
    }

}
