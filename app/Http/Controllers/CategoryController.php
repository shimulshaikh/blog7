<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Image;
use Redirect,Response;
use File;

class CategoryController extends Controller
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

            return Datatables::of(Category::query()->latest())
                ->setRowId('{{$id}}')
                ->editColumn('created_at', function(Category $category) {
                    return $category->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function(Category $category) {
                    return $category->updated_at->format('h:m:s');
                })
                ->addColumn('categoryImage', function($category) {
                    $url=asset("/storage/$category->image"); 
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                })
                ->rawColumns(['image', 'action'])

                ->addColumn('action', function($data){
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editCategory"><i class="far fa-edit"></i> Edit </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteCategory">Delete</a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()->make(true);

        } 

        return view('website.backend.category.index');
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
        $slug = Str::slug($request->name, '-');

        $image = $request->file('image');

        if(isset($image)){

            //make unique nake for image
            $currentDate = Carbon::now()->toDateString();

            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check category dir is exists
            if (!Storage::disk('public')->exists('category')) 
            {
                Storage::disk('public')->makeDirectory('category');
            }

            //resize image for category and upload
            $categoryImage = Image::make($image)->resize(1600,479)->save();
            Storage::disk('public')->put('category/'.$imageName,$categoryImage);

            //check category slider dir is exists
            if (!Storage::disk('public')->exists('category/slider')) 
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //resize image for category slider and upload
            $slider = Image::make($image)->resize(500,333)->save();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);

        }
        else{
            $imageName = "default.png";
        }



        $data = Category::updateOrCreate(['id' => $request->category_id],
                [
                    'name' => $request->name,
                    'slug' => $slug,
                    'image' => $imageName
                ]);        
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category = Category::findorFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findorFail($id)->delete();
     
        return response()->json(['success'=>'Category deleted successfully.']);
    }
}
