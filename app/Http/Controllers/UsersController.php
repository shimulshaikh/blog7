<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;   
use App\User;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        if(Gate::denies('manage-users'))
        {
            return redirect()->route('backend.index');
        }

        $users = User::all();
        return view('website.backend.user.index',compact('users'));
    }


    public function edit($id)
    {
        if(Gate::denies('edit-user'))
        {
            return redirect()->route('user.index');
        }

        $users = User::findorFail($id);
        $roles = Role::all();

        return view('website.backend.user.edit',compact('users','roles'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findorFail($request->id);
        //dd($request);
        $user->roles()->sync($request->roles);
        //dd($users);
        $user->name =  $request->name;
        $user->email =  $request->email;

        if ($user->save()) {
           $request->session()->flash('success', $user->name . ' has been updated');
        }
        else{
            $request->session()->flash('error','There was an error updating thr user');
        }
        

        return redirect()->route('user.index');

    }


    public function destroy(Request $request, $id)
    {
        if(Gate::denies('delete-user'))
        {
            return redirect()->route('user.index');
        }

        $user = User::findorFail($id);
        $user->roles()->detach();

        if ($user->delete()) {
           $request->session()->flash('success', $user->name . ' has been deleted');
        }
        else{
            $request->session()->flash('error','There was an error deleted thr user');
        }


        return redirect()->route('user.index');
    }
}
