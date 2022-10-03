<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Session;
use URL;


class PageView extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'url',
        'session_id',
        'user_id',
        'ip',
        'agent'
    ];
    
    public function scopepageViewCount()
    {

        return PageView::distinct()
                    ->where('created_at', '>=', Carbon::now()->subDays(7))
                    ->count('session_id');
    }

    public function scopeinsertPageView()
    {
         // get client header
         $header = \Request::header('User-Agent');

         $insertPageView = PageView::create([
             'url' => URL::current(),
             'session_id' =>  \Request::getSession()->getId(),
             'user_id' => Auth::id(),
             'ip' =>'192.168.1.0',
             'agent' => $header,
         ]);

         return $insertPageView;
    }   
}
