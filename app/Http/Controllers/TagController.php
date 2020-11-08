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
                ->addColumn('action', function($data){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editTag"><i class="far fa-edit"></i> Edit </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteTag">Delete</a>';

                    return $button;
                })
                ->rawColumns(['action'])
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request()->validate([
        //         'name' => 'name'
        //     ]);

        $slug = Str::slug($request->name, '-');

        $data = Tag::updateOrCreate(['id' => $request->tag_id],
                [
                    'name' => $request->name,
                    'slug' => $slug
                ]);        
        
        //return response()->json(['success'=>'Customer saved successfully.']);
        return response()->json($data);
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
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::findorFail($id)->delete();
     
        return response()->json(['success'=>'Tag deleted successfully.']);
    }
}
