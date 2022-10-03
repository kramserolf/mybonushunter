<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Offer;
use Auth;
use Carbon\Carbon;

class ClaimedOffer extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'offer_id', 
        'user_id',
        'credit',
        'user_type'
    ];

    public function insertClaimedOffer()
    {
        //  save visited offers
        $insertClickedOffers = LinkView::create([
                'offer_id' => $show_offer_id,
                'url' => URL::current(),
                'session_id' =>  \Request::getSession()->getId(),
                'user_id' => Auth::id(),
                'ip' =>'192.168.1.0',
                'agent' => $header,
        ]);
    }

    public function scopeofferClaimed()
    {
         // claimed offers table
         $claimed_offers_table = ClaimedOffer::all();

          // count claimed offers table by offer id
        $claim_collection = collect($claimed_offers_table)->countBy('offer_id');

        // convert claimed offers collection into array
        $claim_colletion_array = $claim_collection->toArray();

         

          if(!empty($claim_colletion_array))
            {
                // get the highest value in the array
                $claimed_value = max($claim_colletion_array);

                        
                // get the key of the higest value
                $claimed_key = array_search($claimed_value, $claim_colletion_array);

                // display the value of the filtered array
                $most_claimed_offers = DB::table('claimed_offers as c')
                        ->leftJoin('offers as o', 'c.offer_id', 'o.id')
                        ->select('o.title as title', 'o.banner_image as image', 'o.id')
                        ->where('offer_id', $claimed_key)
                        ->first();
                
            } else {
                $most_claimed_offers = 0;
            }

            return $most_claimed_offers;
    }

    public function scopeclaimedOfferCount()
    {

        return ClaimedOffer::where(
            'created_at', '>=', Carbon::now()->subDays(7)
            )
            ->count();
    }

    public function scopeunclaimedOffer()
    {
        $offers = Offer::where('offer_type', 'Deposit')
                    ->pluck('id')
                    ->all();

        $remaining_offers = ClaimedOffer::where('user_id', Auth::id())
                    ->pluck('offer_id')
                    ->all();

        $filter = array_diff($offers, $remaining_offers);

        return Offer::wherein('id', $filter)
                        ->get();
    }

    public function scopeclaimedOffer()
    {
        $claimed_offers = DB::table('claimed_offers as c')
                                ->leftJoin('offers as o', 'c.offer_id', 'o.id')
                                ->select('o.*', 'c.user_id')
                                ->where('c.user_id', Auth::id())
                                ->get();

        return $claimed_offers;
    }
}
