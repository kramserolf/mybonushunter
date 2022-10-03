<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Link;
use Illuminate\Support\Str;
use DataTables;

class LinkController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $link_category = DB::table('link_categories')
                        ->get();
        $link = [];
        if($request->ajax()) {
            $link = DB::table('links as l')
                            ->leftJoin('link_categories as c', 'l.category_id', 'c.id')
                            ->select('l.*', 'c.category')
                            ->get();
                            
            return DataTables::of($link)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-outline-secondary btn-sm editLinkr"><i class="bi-pencil-square"></i> Edit</a> ';
                    $btn .= '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-outline-danger btn-sm deleteLink"><i class="bi-trash"></i> Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin/link', compact('link', 'link_category'));
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
            'category_id' => 'required',
            'title' => 'required',
            'link' => 'required',
        ]);
        $link = Str::of($request->link)
                ->replace('watch?v=', 'embed/')
                ->squish();
        // save data
        $save = Link::updateOrCreate([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'link' => $link,
            'description' => $request->description
        ]);

        return response()->json('Link created successfully');
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
        Link::where('id', $request->id)->delete();
    }
}
