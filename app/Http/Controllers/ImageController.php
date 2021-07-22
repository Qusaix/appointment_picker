<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ImageController extends Controller
{
    public function index()
    {
        $images = Images::get();
        return view('dashboard.images.index',compact('images'));
    }

    public function create()
    {
        return view('dashboard.images.create');
    }

    public function store(Request $request)
    {
        Images::create($request->all());
        
        return \redirect()->route('dashboard.images.index');
    }

    public function edit($id)
    {
        $image = Images::findOrFail($id);
        return view('dashboard.images.edit',compact('image'));
    }

    public function update(Request $request, $id)
    {
        $image = Images::findOrFail($id);
        $image->link = $request->link;
        $image->save();
        return \redirect()->route('dashboard.images.index');
    }

    public function delete($id)
    {
        Images::find($id)->delete();
        return \redirect()->route('dashboard.images.index');

    }


    public function datatable()
    {
        $images = Images::orderBy('created_at','desc')->get();
        $index = 0;
        return DataTables::of($images)
        ->addIndexColumn()
        ->addColumn('action',function(Images $data){
            return view('dashboard.actions.editImage',compact('data'));
        })
        ->editColumn('link',function(Images $image){
            return view('dashboard.actions.image',compact('image'));
        })
        ->editColumn('created_at',function(Images $image){
            return $image->created_at->diffForHumans();
        })
        ->rawColumns(['action'])
        ->make(true);

    }
}
