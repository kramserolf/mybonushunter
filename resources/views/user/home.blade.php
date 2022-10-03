@extends('welcome')
<style>
    #carousel{
        display: none;
    }
</style>
@section('content')
    @auth
        <main class="mt-5 container">
            <main class="mt-5 container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="sn-container">
                            <div class="sn-img">
                                {{-- <img src="{{asset('images/helps/'.$help->image.'')}}" style="width: 100%" /> --}}
                            </div>
                            <div class="mt-5 sn-content">
                                <h2 class="sn-title mb-4">My Claimed offers</h2>
                                <div class="">
                                     @foreach($claimed_offers as $claimed_offer)    
                                        
                                        <img class="m-2" src="{{asset('images/offers/'.$claimed_offer->banner_image.'')}}" style="width: 40%;" />
                                        
                                        <h3 class="mt-3">{{$claimed_offer->title}}</h3>
                                        <ul>
                                            <li>
                                                <p>{{$claimed_offer->description}}</p>
                                            </li>
                                        </ul>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('layouts.offer')
                </div>
                </div>
            </main>
    @endauth
@endsection