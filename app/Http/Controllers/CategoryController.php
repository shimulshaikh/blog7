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

                ->addColumn('actions', function($row){
                    $editUrl = route('category.edit', $row->id);
                    $deleteUrl = route('category.destroy', $row->id);

                    return view('website.backend.colmun.column', compact('editUrl', 'deleteUrl'));
                    })
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
        return view('website.backend.category.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);


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
            $img = Image::make($image)->resize(1600,479)->save(storage_path('app/public/category').'/'.$imageName);
            Storage::disk('public')->put('category/'.$imageName,$img);

            //check category slider dir is exists
            if (!Storage::disk('public')->exists('category/slider')) 
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //resize image for category slider and upload
            $slider = Image::make($image)->resize(500,333)->save(storage_path('app/public/category/slider').'/'.$imageName);
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);

        }
        else{
            $imageName = "default.png";
        }

        $category = new Category();

        $category->name = request('name');
        $category->slug = $slug;
        $category->image = $imageName;

        if ($category->save()) {
                $request->session()->flash('success','Category has been created');
            }
            else{
                $request->session()->flash('error','There was an error created the Category');
            }

            return redirect()->route('category.index');
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
            
        return view('website.backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);


        $slug = Str::slug($request->name, '-');

        $image = $request->file('image');

        $category = Category::findorFail($id);
 
        if(isset($image)){

            //make unique nake for image
            $currentDate = Carbon::now()->toDateString();

            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check category dir is exists
            if (!Storage::disk('public')->exists('category')) 
            {
                Storage::disk('public')->makeDirectory('category');
            }

            //delete old image
            if (Storage::disk('public')->exists('category/'.$category->image))
            {
                Storage::disk('public')->delete('category/'.$category->image);
            }

            //resize image for category and upload
            $img = Image::make($image)->resize(1600,479)->save(storage_path('app/public/category').'/'.$imageName);
            Storage::disk('public')->put('category/'.$imageName,$img);

            //check category slider dir is exists
            if (!Storage::disk('public')->exists('category/slider')) 
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //delete old slider image
            if (Storage::disk('public')->exists('category/slider/'.$category->image))
            {
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

            //resize image for category slider and upload
            $slider = Image::make($image)->resize(500,333)->save(storage_path('app/public/category/slider').'/'.$imageName);
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);

        }
        else{
            $imageName = $category->image;
        }

        $category->name = request('name');
        $category->slug = $slug;
        $category->image = $imageName;

        if ($category->update()) {
                $request->session()->flash('success','Category has been Updated');
            }
            else{
                $request->session()->flash('error','There was an error Updated the Category');
            }

            return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $category = Category::findorFail($id);

        if (Storage::disk('public')->exists('category/'.$category->image))
            {
                Storage::disk('public')->delete('category/'.$category->image);
            }

        if (Storage::disk('public')->exists('category/slider/'.$category->image))
            {
                Storage::disk('public')->delete('category/slider/'.$category->image);
            } 
            
        
        if ($category->delete())
         {
            $request->session()->flash('success','Category has been deleted');
         }
        else
         {
            $request->session()->flash('error','There was an error deleted the Category');
         }       
     
        return redirect()->route('category.index');
    }
}
