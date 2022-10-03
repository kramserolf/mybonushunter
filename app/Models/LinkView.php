<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Auth;


class LinkView extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'offer_id', 
        'url',
        'session_id',
        'user_id',
        'ip',
        'agent'
    ];

    // get most viewed offer
    public function scopeofferView()
    {
        // get link views table
        $offer_views = LinkView::all();

         // count table by offer id
         $collection = collect($offer_views)->countBy('offer_id');

         // convert collection into array
        $array = $collection->toArray();

        if(!empty($array)){
            // get the highest value in the array
            $value = max($array);

            // get the key of the higest value
            $key = array_search($value, $array);

            // display the value of the filtered array
            $most_clicked_offers = DB::table('link_views as l')
                    ->leftJoin('offers as o', 'l.offer_id', 'o.id')
                    ->select('o.title as title', 'o.banner_image as image', 'o.id')
                    ->where('offer_id', $key)
                    ->first();
        } else {
            $most_clicked_offers = 0;
        }

        return $most_clicked_offers;
    }

    public function scopecountView()
    {
         // get link views table
         $offer_views = LinkView::all();

         // count table by offer id
         $collection = collect($offer_views)->countBy('offer_id');

         // convert collection into array
        $array = $collection->toArray();

        if(!empty($array)){
            // get the highest value in the array
            $value = max($array);

            // get the key of the higest value
            $key = array_search($value, $array);

            // display the value of the filtered array
            $most_clicked_offers = DB::table('link_views as l')
                    ->leftJoin('offers as o', 'l.offer_id', 'o.id')
                    ->select('o.title as title', 'o.banner_image as image', 'o.id')
                    ->where('offer_id', $key)
                    ->first();
            return $value;
        } else {
            $most_clicked_offers = 0;
        }

        
    }
}
