<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WebsiteController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Offer;
use App\Models\LinkView;
use App\Models\PageView;
use App\Models\ClaimedOffer;
use Auth;
use DataTables;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // get most viewed offers
        $most_clicked_offers = LinkView::offerView();

        // number of views
        $count_view = LinkView::countView();
     

        // get most claimed offers
        $most_claimed_offers = ClaimedOffer::offerClaimed();

        // filter claimed offers for the last 7 days
        $claimed_offers = ClaimedOffer::claimedOfferCount();
                        
        // get page views
        $page_views = PageView::pageViewCount();

        // new users
        $new_users = User::newUser();

        return view('admin/home', compact('page_views', 'claimed_offers', 'new_users', 'most_clicked_offers',  'most_claimed_offers', 'count_view'));
    }
        // display credit
    public function credits()
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

        // user home page
        public function user()
        {   
            // call remaining offers
            $unclaimed_offers = ClaimedOffer::unclaimedOffer();

            // get user credits
            $credit = $this->credits();

            // display claimed offers
            $claimed_offers = ClaimedOffer::claimedOffer();

                return view('user/home', compact('credit', 'unclaimed_offers', 'claimed_offers'));
        }
    // user profile
    public function userProfile()
    {
        $unclaimed_offers = CLaimedOffer::unclaimedOffer();
         // display claimed offers
         $claimed_offers = ClaimedOffer::claimedOffer();
        

        $credit = $this->credits();
        return view('user/profile', compact('unclaimed_offers', 'credit', 'claimed_offers'));
    }

        // admin profile
        public function profile()
        {   
            return view('admin/profile');
        }

    // admin profile update
    public function adminProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        return redirect()->route('admin.profile')->withSuccess('Profile updated successfully.');
    }

    // user profile update
    public function userProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        return redirect()->route('user.profile')->withSuccess('Profile updated successfully.');
    }
    public function storeClaimedOffer(Request $request)
    {
        // insert into claimed offers
            $claimed_offer = ClaimedOffer::updateOrCreate([
                'user_id' => Auth::id(),
                'offer_id' => $request->offer_id,
                'credit' => $request->credit,
            ]);

        return redirect()->route('user.home');
    }

    public function registeredUser(Request $request)
    {
        $user = [];
        if($request->ajax()) {
            $user = User::where('is_admin', 0)
                        ->latest()
                        ->get();
                            
            return DataTables::of($user)
                ->addIndexColumn()   
                ->make(true);
        }

        return view('admin/registered_users', compact('user'));
    }

}
