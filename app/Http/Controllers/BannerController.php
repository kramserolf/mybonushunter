<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
use DataTables;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banner = [];
        if($request->ajax()) {
            $banner = DB::table('banners')
                            ->latest()->get();  
            return DataTables::of($banner)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-outline-secondary btn-sm editBaner"><i class="bi-pencil-square"></i> Edit</a> ';
                    $btn .= '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-outline-danger btn-sm deleteBanner"><i class="bi-trash"></i> Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/banner', compact('banner'));
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
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1280',
        ]);
        // get image name
        $imageName = $request->image->getClientOriginalName();

        // move the image to banners folder
        $request->image->move(public_path('images/banners'), $imageName);

        // save data
        $save = Banner::updateOrCreate([
            'title' => $request->title,
            'image' => $imageName,
            'description' => $request->description
        ]);

        return response()->json('Banner created successfully');

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
    public function destroy(Request $request)
    {
        $file_path = DB::table('banners')
                    ->select('banners.*')
                    ->where('id', $request->id)
                    ->first();
        // delete image from folder
        File::delete(public_path('images/banners/'.$file_path->image.''));
        // delete image path in database
        Banner::where('id', $request->id)->delete();
    }
}
