<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Toastr;

class FavoriteController extends Controller
{
    public function addFavorite($id)
    {
    	$isFavorite = Auth::user()->favorite_post()->where('post_id', $id)->count();

    	if ($isFavorite == 0) {
    		Auth::user()->favorite_post()->attach($id);

    		Toastr::success('Post successfully added to your favorite list');
    		return redirect()->back(); 
    	}else{
    		Auth::user()->favorite_post()->detach($id);

    		Toastr::success('Post successfully removed to your favorite list');
    		return redirect()->back(); 
    	}
    }

}
