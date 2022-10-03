<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Offer;
use Illuminate\Support\Facades\File;
use DataTables;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offer = [];
        if($request->ajax()) {
            $offer = DB::table('offers')
                            ->latest()->get();  
            return DataTables::of($offer)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-outline-secondary btn-sm editOffer"><i class="bi-pencil-square"></i> Edit</a> ';
                    $btn .= '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-outline-danger btn-sm deleteOffer"><i class="bi-trash"></i> Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/offer', compact('offer'));
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
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1280',
            'offer_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1280',
            'offer_type' => 'required',
            'credit' => 'required',
        ]);
        // get offer image name
        $offer_image = $request->offer_image->getClientOriginalName();

        // move the offer image to offers folder
        $request->offer_image->move(public_path('images/offers'), $offer_image);

        // get banner image name
        $banner_image = $request->banner_image->getClientOriginalName();

        // move the banner image to offers folder
        $request->banner_image->move(public_path('images/offers'), $banner_image);

        // save data
        $save = Offer::updateOrCreate([
            'title' => $request->title,
            'offer_image' => $offer_image,
            'banner_image' => $offer_image,
            'description' => $request->description,
            'validity' => $request->validity,
            'offer_type' => $request->offer_type,
            'credit' => $request->credit,
        ]);

        return response()->json('Offer created successfully');

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
        $file_path = DB::table('offers')
                    ->select('offers.*')
                    ->where('id', $request->id)
                    ->first();
        // delete image from folder
        File::delete(public_path('images/offers/'.$file_path->offer_image.''));

        File::delete(public_path('images/offers/'.$file_path->banner_image.''));

        // delete image path in database
        Offer::where('id', $request->id)->delete();
        
    }
}
