<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\File;;
use App\Models\User;
use App\Models\Banner;
use App\Models\ClaimedOffer;
use App\Models\Offer;
use App\Models\PageView;
use App\Models\LinkView;
use Carbon\Carbon;
use Auth;
use Session;
use URL;


class WebsiteController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = 'user/home';
    // user login page
    public function user_login()
    {   
        $banners = Banner::getBanner();
        $offers = Offer::all();
        // get current offers
        $remaining_offers = ClaimedOffer::unclaimedOffer();

        return view('user_login', compact('offers', 'banners', 'remaining_offers'));
    }

    // welcome page
    public function index()
    {
        // show latest offer
        $offers = Offer::all();

        // get all banners
        $banners = Banner::getBanner();
        // get user edit
        $credit = Offer::getCredit();
        // insert page view
        PageView::insertPageView();

        return view('home', compact('banners', 'offers', 'credit'));
    }

    // help page
    public function help()
    {
        // get credit
        $credit = Offer::getCredit();

        // show latest offer
        $all_offers = Offer::getOffer();

        // insert page views
        PageView::insertPageView();

        // call remaining offers
        $unclaimed_offers = ClaimedOffer::unclaimedOffer();

        $helps = DB::table('helps')
                    ->latest()
                    ->paginate(1);

        return view('help', compact('helps', 'credit', 'all_offers', 'unclaimed_offers'));
    }
    // casino tips page
    public function casino_tips()
    {
        $tips = DB::table('tips')
                    ->latest()
                    ->paginate(1);
        // get credit
        $credit = Offer::getCredit();
     
        // show latest offer
        $all_offers = Offer::getOffer();

        // call remaining offers
        $unclaimed_offers = ClaimedOffer::unclaimedOffer();

        PageView::insertPageView();

        $links_category = DB::table('link_categories')
                     ->get();

        $links = DB::table('links as l')
                    ->leftJoin('link_categories as c', 'l.category_id', 'c.id')
                    ->groupBY('l.id')
                    ->orderBy('c.id')
                    ->get();

        return view('tips', compact('tips', 'links_category', 'links', 'credit', 'all_offers', 'unclaimed_offers'));
    }

    // casino bonus page
    public function casino_bonus()
    {
        $credit = Offer::getCredit();
        
        $all_offers = Offer::getOffer();

        // call remaining offers
        $unclaimed_offers = ClaimedOffer::unclaimedOffer();

        PageView::insertPageView();

        return view('bonus', compact('all_offers', 'credit', 'unclaimed_offers'));
    }
   
    // sign up page
    public function signUpBonus($id)
    {
        // get current offer id
         $offers = Offer::find($id);

        //  $show_offer_id = $offers->id;

        // display all offers
         $all_offers = Offer::getOffer();

        // save page views
        PageView::insertPageView();

         // call remaining offers
        $unclaimed_offers = ClaimedOffer::unclaimedOffer();

        // get credit
         $credit = Offer::getCredit();

        // get client header
         $header = \Request::header('User-Agent');
        
         //  save visited offers
         $insertClickedOffers = LinkView::create([
             'offer_id' => $offers->id,
             'url' => URL::current(),
             'session_id' =>  \Request::getSession()->getId(),
             'user_id' => Auth::id(),
             'ip' =>'192.168.1.0',
             'agent' => $header,
         ]);

        // view sign up bonus
         return view('sign_up_bonus', compact('offers', 'all_offers', 'credit', 'unclaimed_offers'));
    }

    // contact page
    public function contact()
    {
        // show credit
        $credit = Offer::getCredit();
        
        // save page views
        PageView::insertPageView();

        // view contact page
        return view('contact', compact('credit'));
    }

    // save claimed offer
    public function claimed_offer(Request $request)
    {
        // validate
        $request->validate([
            'offer_id' => 'required',
            'name' => 'required',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // insert into users
        $user = User::updateOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
        ]);
        // get user id
        $lastInsertedId = $user->id;

        // insert into claimed offers
        $claimed_offer = ClaimedOffer::updateOrCreate([
            'user_id' => $lastInsertedId,
            'offer_id' => $request->offer_id,
            'credit' => $request->credit,
        ]);

    }
}

