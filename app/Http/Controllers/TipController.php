<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tip;
use Illuminate\Support\Facades\File;
use DataTables;


class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tip = [];
        if($request->ajax()) {
            $tip = DB::table('tips')
                            ->latest()->get();  
            return DataTables::of($tip)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-outline-secondary btn-sm editTip><i class="bi-pencil-square"></i> Edit</a> ';
                    $btn .= '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-outline-danger btn-sm deleteTip"><i class="bi-trash"></i> Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/tips', compact('tip'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1280',
        ]);
        // get image name
        $imageName = $request->image->getClientOriginalName();

        // move the image to banners folder
        $request->image->move(public_path('images/tips'), $imageName);

        // save data
        $save = Tip::updateOrCreate([
            'image' => $imageName,
            'description' => $request->description
        ]);

        return response()->json('Tip image created successfully');
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
        $file_path = DB::table('tips')
                    ->select('tips.*')
                    ->where('id', $request->id)
                    ->first();
        // delete image from folder
        File::delete(public_path('images/tips/'.$file_path->image.''));
        // delete image path in database
        Tip::where('id', $request->id)->delete();
    }
}
