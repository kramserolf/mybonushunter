@extends('layouts.admin')
<style>
    #home {
        background-color: gray;
    }
</style>
@section('content')
<div class="row px-5 mt-3">
    <div class="col-md-3 p-2 mt-2">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-secondary fw-bold mb-3">Registered Users</div>
                        <div class="h2 m-4 fw-bold">{{$new_users}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 p-2 mt-2">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-secondary fw-bold mb-3">New Users</div>
                        <div class="h2 m-2 fw-bold">{{$new_users}}</div>
                        
                    </div>
                </div>
                <div class="m-2">
                    <span class="text-success fw-bold">
                        <i class="bi-graph-up" style="font-size: 16px; margin-right: 6px"></i>
                    </span>
                    </span> <span  style="font-size: 12px;">
                        Past 7 days
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 p-2 mt-2">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-secondary fw-bold mb-3">Claimed Offers</div>
                        <div class="h2 m-2 fw-bold">{{$claimed_offers}}</div>
                        
                    </div>
                </div>
                <div class="m-2">
                    <span class="text-success fw-bold">
                        <i class="bi-graph-up" style="font-size: 16px; margin-right: 6px"></i>
                    </span>
                    </span> <span  style="font-size: 12px;">
                        Past 7 days
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 p-2 mt-2">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-secondary fw-bold mb-3">Page Views</div>
                        <div class="h2 m-2 fw-bold">{{$page_views}}</div>
                        
                    </div>
                </div>
                <div class="m-2">
                    <span class="text-success fw-bold">
                        <i class="bi-graph-up" style="font-size: 16px; margin-right: 6px"></i>
                    </span>
                    </span> <span  style="font-size: 12px;">
                        Past 30 days
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row px-5 mt-5">
    <div class="col-md-6">
        @if(!empty($most_claimed_offers))
            <div class="card">
                <img src="{{asset('images/offers/'.$most_claimed_offers->image .'')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-secondary fw-bold">Most claimed offers</h5>
                    <h2 class="mt-3 px-3 font-monospace">{{$most_claimed_offers->title}}</h2>
                </div>
            </div>
        @else
            <div class="card">
                <img src="{{asset('images/logo.png')}}" class="card-img-top w-50" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-secondary fw-bold">Most claimed offers</h5>
                    <h2 class="mt-3 px-3 font-monospace"></h2 class="mt-3 px-3 font-monospace">
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        @if(!empty($most_clicked_offers))
            <div class="card">
                <img src="{{asset('images/offers/'.$most_clicked_offers->image .'')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-secondary fw-bold">Most clicked offers</h5>
                    <div class="d-flex">
                        <h2 class="me-auto mt-3 px-3 font-monospace">{{$most_clicked_offers->title}}</h2> 
                        <h2 class="mt-3 px-3">{{$count_view}} <span style="font-size: 14px">views</span></h2> 
                    </div>
                   
                </div>
            </div>
        @else
            <div class="card">
                <img src="{{asset('images/logo.png')}}" class="card-img-top w-50" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-secondary fw-bold">Most clicked offers</h5>
                    <h2 class="mt-3 px-3 font-monospace"></h2 class="mt-3 px-3 font-monospace">
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
