<?php

namespace App\Http\Controllers;

use App\Subscribe;
use Yajra\Datatables\Datatables;
use Redirect,Response;
use Illuminate\Http\Request;

class ManageSubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            return Datatables::of(Subscribe::query()->latest())
                ->setRowId('{{$id}}')
                ->editColumn('created_at', function(Subscribe $subscribe) {
                    return $subscribe->created_at->diffForHumans();
                })
                ->addColumn('action', function($row){
                    $deleteUrl = route('subscribe.destroy', $row->id);

                    return view('website.backend.subscriber.column', compact('deleteUrl'));
                    })
                ->addIndexColumn()->make(true);

        }   

        return view('website.backend.subscriber.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $subscribe = Subscribe::findorFail($id);

       
        if ($subscribe->delete()) {
                $request->session()->flash('success','Subscribe has been deleted');
            }
        else{
                $request->session()->flash('error','There was an error deleted the Subscribe');
            }

        return redirect()->route('subscribe.index');
    }
}
