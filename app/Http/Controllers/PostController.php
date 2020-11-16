<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Image;
use Auth;
use Redirect,Response;
use App\Notifications\NewAuthorPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if(empty($request->user)){
                //Start for date range search
                $postQuery = Post::query()->latest();

                $startDate = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
                $endDate = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

                if ($startDate && $endDate) {
                    $startDate = date('y-m-d', strtotime($startDate));
                    $endDate = date('y-m-d', strtotime($endDate)); 

                    $postQuery->whereRaw("date(posts.created_at) >= '" . $startDate . "' AND date(posts.created_at) <= '" . $endDate  . "'");
                }
                //End for date range search

                $posts = $postQuery->select('*');    
            }    

            else{
                
                    if ($request->get('user')) {
                        $posts = Post::where('user_id', '=', $request->user);
                    }

                    else{
                        $posts = Post::query()->latest();
                    }
            }

            


            return Datatables::of($posts)
                ->setRowId('{{$id}}')
                ->editColumn('created_at', function(Post $post) {
                    return $post->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function(Post $post) {
                    return $post->updated_at->format('h:m:s');
                })
                ->addColumn('author', function(Post $post) {
                    return $post->user->name;
                })
                ->addColumn('is_approved', function($row) {
                    if($row->is_approved == true){
                        $is_approvedUrl = route('post.approve', $row->id);
                        return view('website.backend.post.colmun.is_approved', compact('is_approvedUrl'));
                    }
                    else{
                        $pendingUrl = route('post.approve', $row->id);
                        return view('website.backend.post.colmun.pending', compact('pendingUrl'));
                    }
                })
                ->addColumn('status', function($row) {
                    if($row->status == true){
                        $statusApproveUrl = route('post.status', $row->id);
                        return view('website.backend.post.colmun.satatusApproved', compact('statusApproveUrl'));
                    }else{
                        $statusPendingUrl = route('post.status', $row->id);
                        return view('website.backend.post.colmun.statusPending', compact('statusPendingUrl'));
                    }
                })

                ->addColumn('actions', function($row){
                    $showtUrl = route('post.show', $row->id);
                    $editUrl = route('post.edit', $row->id);
                    $deleteUrl = route('post.destroy', $row->id);

                    return view('website.backend.post.colmun.colmun', compact('showtUrl', 'editUrl', 'deleteUrl'));
                    })
                ->addIndexColumn()->make(true);

        }

        return view('website.backend.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website.backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
                'tags' => 'required',
                'categories' => 'required',
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
                'body' => 'required'
            ]);

        $slug = Str::slug($request->title, '-');

        $image = $request->file('image');

        if(isset($image)){

            //make unique nake for image
            $currentDate = Carbon::now()->toDateString();

            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check post dir is exists
            if (!Storage::disk('public')->exists('post')) 
            {
                Storage::disk('public')->makeDirectory('post');
            }

            //resize image for post and upload
            $img = Image::make($image)->resize(1600,1066)->save(storage_path('app/public/post').'/'.$imageName);
            Storage::disk('public')->put('post/'.$imageName,$img);

        }
        else{
            $imageName = "default.png";
        }

        $post = new Post();

        $post->user_id = Auth::id();
        $post->title = request('title');
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = request('body');
        if (isset($request->status)) {
            $post->status = true;
        }
        else{
            $post->status = false;
        }

        ////Auth::Role()->name == 'admin'
        if (Auth::id() == 1) { 
            $post->is_approved = true;
        }
        else{
            $post->is_approved = false;
        }
        

        if ($post->save()) {
                $request->session()->flash('success','Post has been created');
            }
            else{
                $request->session()->flash('error','There was an error created the Post');
            }

        $post->categories()->attach(request('categories'));
        $post->tags()->attach(request('tags'));

        //For mail notification send
        // if(!(Auth::id() == 1)){
        //         $users = User::where('id','1')->get();
        //         Notification::send($users, new NewAuthorPost($post));
        // }
        

            return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {

        return view('website.backend.post.show',compact('post'));
                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('website.backend.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        request()->validate([
                'tags' => 'required',
                'categories' => 'required',
                'title' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
                'body' => 'required'
            ]);

        $slug = Str::slug($request->title, '-');

        $image = $request->file('image');

        if(isset($image)){

            //make unique nake for image
            $currentDate = Carbon::now()->toDateString();

            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check post dir is exists
            if (!Storage::disk('public')->exists('post')) 
            {
                Storage::disk('public')->makeDirectory('post');
            }

            //delete old post image
            if (Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }

            //resize image for post and upload
            $img = Image::make($image)->resize(1600,1066)->save(storage_path('app/public/post').'/'.$imageName);
            Storage::disk('public')->put('post/'.$imageName,$img);

        }
        else{
            $imageName = $post->image;
        }

      

        $post->user_id = Auth::id();
        $post->title = request('title');
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = request('body');
        if (isset($request->status)) {
            $post->status = true;
        }
        else{
            $post->status = false;
        }

        if (Auth::id() == 1) {
            $post->is_approved = true;
        }
        else{
            $post->is_approved = false;
        }
        

        if ($post->save()) {
                $request->session()->flash('success','Post has been Updated');
            }
            else{
                $request->session()->flash('error','There was an error Updated the Post');
            }

        $post->categories()->sync(request('categories'));
        $post->tags()->sync(request('tags'));

            return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        //delete post image
        if (Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }

        $post->categories()->detach();
        $post->tags()->detach();

        if ($post->delete()) {
                $request->session()->flash('success','Post has been Deleted');
            }
            else{
                $request->session()->flash('error','There was an error Deleted the Post');
            }

           return redirect()->route('post.index'); 
    }


    //All pending post show
    
    public function getPending(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::where('is_approved',false)->latest();

            return Datatables::of($data)
                ->setRowId('{{$id}}')
                ->editColumn('created_at', function(Post $post) {
                    return $post->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function(Post $post) {
                    return $post->updated_at->format('h:m:s');
                })
                ->addColumn('author', function(Post $post) {
                    return $post->user->name;
                })
                ->addColumn('is_approved', function($row) {
                    if($row->is_approved == true){
                        $is_approvedUrl = route('post.approve', $row->id);
                        return view('website.backend.post.colmun.is_approved', compact('is_approvedUrl'));
                    }
                    else{
                        $pendingUrl = route('post.approve', $row->id);
                        return view('website.backend.post.colmun.pending', compact('pendingUrl'));
                    }
                })
                ->addColumn('status', function($row) {
                    if($row->status == true){
                        $statusApproveUrl = route('post.show', $row->id);
                        return view('website.backend.post.colmun.satatusApproved', compact('statusApproveUrl'));
                    }else{
                        $statusPendingUrl = route('post.show', $row->id);
                        return view('website.backend.post.colmun.statusPending', compact('statusPendingUrl'));
                    }
                })

                ->addColumn('actions', function($row){
                    $showtUrl = route('post.show', $row->id);
                    $editUrl = route('post.edit', $row->id);
                    $deleteUrl = route('post.destroy', $row->id);

                    return view('website.backend.post.colmun.colmun', compact('showtUrl', 'editUrl', 'deleteUrl'));
                    })
                ->addIndexColumn()->make(true);
        }

            return view('website.backend.post.pending');

    }

    //For post approved
    public function approval(Request $request, $id)
    {
        $post = Post::findorFail($id);

        if (Auth::id() == 1 && $post->is_approved == false) {
            $post->is_approved = true;

            if ($post->update()) {
                $request->session()->flash('success','Post has been Approved');
            }
            else{
                $request->session()->flash('error','There was an error Approved the Post');
            }
            return redirect()->back();
        }
        else{
            $request->session()->flash('success','Sorry you are not Admin');
            return redirect()->back();
        }
    }


    //For post approved
    public function status(Request $request, $id)
    {
        $post = Post::findorFail($id);

        if (Auth::id() == 1) {

            if ($post->status == false) {
                $post->status = true;

                    if ($post->update()) {
                        $request->session()->flash('success','Post Status has been Published');
                    }
                    else{
                        $request->session()->flash('error','There was an error Published the Post Status');
                    }
                    return redirect()->back();
                }else{
                    $post->status = false;

                    if ($post->update()) {
                        $request->session()->flash('success','Post Status has been Pending');
                    }
                    else{
                        $request->session()->flash('error','There was an error Pending the Post Status');
                    }
                    return redirect()->back();
                }
                
        }
        else{
            $request->session()->flash('success','Sorry you are not Admin');
            return redirect()->back();
        }
    }


}
