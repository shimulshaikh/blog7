<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Redirect,Response;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        if ($request->ajax()) {

            return Datatables::of(Tag::query()->latest())
                ->setRowId('{{$id}}')
                ->editColumn('created_at', function(Tag $tag) {
                    return $tag->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function(Tag $tag) {
                    return $tag->updated_at->format('h:m:s');
                })
                ->addColumn('actions', function($row){
                    $editUrl = route('tag.edit', $row->id);
                    $deleteUrl = route('tag.destroy', $row->id);

                    return view('website.backend.colmun.column', compact('editUrl', 'deleteUrl'));
                    })
                ->addIndexColumn()->make(true);

        }   

        return view('website.backend.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website.backend.tag.create');
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
                'name' => 'required'
            ]);

        $slug = Str::slug($request->name, '-');

        $tag = new Tag();

        $tag->name = request('name');
        $tag->slug = $slug;

            if ($tag->save()) {
                $request->session()->flash('success','Tag has been created');
            }
            else{
                $request->session()->flash('error','There was an error created the Tag');
            }

            return redirect()->route('tag.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findorFail($id);
        return view('website.backend.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate([
                'name' => 'required'
            ]);

        $slug = Str::slug($request->name, '-');

        $tag = Tag::findorFail($request->id);

        $tag->name = request('name');
        $tag->slug = $slug;

            if ($tag->update()) {
                $request->session()->flash('success','Tag has been updated');
            }
            else{
                $request->session()->flash('error','There was an error updated the Tag');
            }

            return redirect()->route('tag.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $tag = Tag::findorFail($id);

       
        if ($tag->delete()) {
                $request->session()->flash('success','Tag has been deleted');
            }
        else{
                $request->session()->flash('error','There was an error deleted the Tag');
            }

        return redirect()->route('tag.index');
    }
}
