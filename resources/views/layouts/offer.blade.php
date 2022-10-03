<div class="col-lg-4 mt-5 mt-lg-0 links">
    <h1>Latest Offers</h1>
    @if(Auth::check())
    @foreach($unclaimed_offers as $offer)
    <div class="row mb-2">
        <div class="col-6">
            <a href="{{url('sign-up-bonus/'.$offer->id)}}">
                <img src="{{asset('images/offers/'.$offer->offer_image.'')}}" style="width: 100%" alt="{{$offer->title}} - {{$offer->description}}" />
            </a>
        </div>
        <div class="col-6 d-flex align-items-center">
            <a href="{{url('sign-up-bonus/'.$offer->id)}}">
                {{$offer->title}} {{$offer->offer_type}} Offer </a>
        </div>
    </div>
    @endforeach
    @endif
    @if(!Auth::check())
    @foreach($all_offers as $offer)
    <div class="row mb-2">
        <div class="col-6">
            <a href="{{url('sign-up-bonus/'.$offer->id)}}">
                <img src="{{asset('images/offers/'.$offer->offer_image.'')}}" style="width: 100%" alt="{{$offer->title}} - {{$offer->description}}" />
            </a>
        </div>
        <div class="col-6 d-flex align-items-center">
            <a href="{{url('sign-up-bonus/'.$offer->id)}}">
                {{$offer->title}} {{$offer->offer_type}} Offer </a>
        </div>
    </div>
    @endforeach

    @endif
    <h1 class="mt-5">
        Casino Tips
    </h1>
    <p>Have a look at some of the tips we expose on playing casino games, tips on bonus and our guides on making
        the most of your play in our <a href="/casino-tips">tips section</a></p>

    <h1 class="mt-5">
        Best Offers
    </h1>
    <p>Check out the latest offers from casino sites, from free spins to massive math up bonus, make the most of
        your play, check them out in the <a href="/casino-best-bonus">best offers section</a></p>
</div>