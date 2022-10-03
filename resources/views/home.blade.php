@extends('welcome')

@section('content')
@include('layouts.banner')
<div class="mt-5">
    <h1 class="mb-4">Latest Casino Bonus</h1>
    <div class="row mb-2">
        {{-- @auth

        @foreach($new_offers as $new_offer)
        <div class="col-12 col-md-4 mt-2 mt-md-0 mb-3" id="offers">
            <a href="{{url('sign-up-bonus/'.$offer->id)}}">
                <img src="{{asset('images/offers/'.$offer->offer_image.'')}}" alt="{{asset('images/offers/'.$new_offer->description.'')}}" style="width: 100%;">
            </a>
        </div>
        @endforeach
        @endauth --}}
        @foreach($offers as $offer)
        <div class="col-12 col-md-4 mt-2 mt-md-0 mb-3" id="offers">
            <a href="{{url('sign-up-bonus/'.$offer->id)}}">
                <img src="{{asset('images/offers/'.$offer->offer_image.'')}}" alt="{{asset('images/offers/'.$offer->description.'')}}" style="width: 100%;">
            </a>
        </div>
        @endforeach
    </div>
</div>
</main>
@endsection
