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

    public function datatable()
    {
        $images = Images::orderBy('created_at','desc')->get();
        $index = 0;
        return DataTables::of($images)
        ->addIndexColumn()
        ->addColumn('action',function(Images $data){
            return view('dashboard.actions.edit',compact('data'));
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
