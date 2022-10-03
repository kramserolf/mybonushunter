<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;


class Offer extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'banner_image', 
        'offer_image', 
        'title',
        'description', 
        'validity', 
        'active', 
        'offer_type',
        'credit',
    ];

    public function scopegetOffer()
    {
        $all_offers = Offer::latest()->paginate(6);

    
        return $all_offers;
    }

    
    public function scopegetCredit()
    {
        if(Auth::check())
        {
            $current_id = Auth::user()->is_admin;
            $get_credit = DB::table('offers as o')
                    ->leftJoin('claimed_offers as c', 'o.id', 'c.offer_id')
                    ->leftJoin('users as u', 'c.user_id', 'u.id')
                    ->select('o.credit as credit')
                    ->where('u.is_admin', 0)
                    ->first();

                if($get_credit) {
                    $credit = $get_credit->credit;
                    return $credit;
                }      
        } 
    }
}