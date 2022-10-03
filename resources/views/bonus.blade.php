@extends('welcome')
<style>
    #bonus {
        color: white;
    }

    #home {
        text-decoration: none;
        color: #A9A9A9
    }
</style>
@section('content')
<main class="mt-5 container">
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sn-container">
                        <div class="sn-content">
                            <h2>Best and most trusted bonus offers</h2>
                            <p>We dont just list promotions because a casino paid us to, we actually try out the casino.
                                We track online casinos and make sure what they offer is what is actually available on
                                the site itself. If you register with us you can get the free mail out of the latest
                                offers and you can add feedback or notify us if you spot anything we should look into.
                            </p>
                            <p>The list below is out hand picked collection of bonus offers, not just big wins and no
                                deposit bonus but mybonushunter hand picked offers. Player safety and your data matter
                                to us, so when you choose any offer shown here on mybonushunter you can rest that the
                                only data we collect is for site use, nothing personal and we certainly do not sell data
                                on like other sites.</p>
                        </div>
                        @auth
                        @foreach($unclaimed_offers as $offer)
                        <div class="row table-row py-4 mt-4 mx-1 mx-md-0 shadow">

                            <div class="col-xs-12 col-md-4 col-lg-3 d-flex justify-content-center align-items-center"><a
                                    href="{{url('sign-up-bonus/'.$offer->id)}}"><img src="{{asset('images/offers/'.$offer->offer_image.'')}}"
                                        alt="<h4>{{asset($offer->title)}}</h4><p>{{asset($offer->description)}}</p>"
                                        style="width: 100%;"></a></div>
                            <div class="col-xs-12 col-md-8 col-lg-6 d-flex flex-column justify-content-center align-items-center my-4 mt-my-0">
                                <div class="row w-100">
                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center"> {{$offer->title}}
                                        <br> {{$offer->offer_type}} </div>
                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center my-4 my-md-0">
                                        <div>
                                            <div><i class="bi bi-check"></i> {{ Str::limit($offer->description, 70) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center"> Valid
                                        until<br><span>{{$offer->validity}}</span><br></div>
                                </div>
                            </div>
                            <div
                                class="col-xs-12 col-md-12 col-lg-3 d-flex flex-column justify-content-center align-items-center mt-md-4 mt-lg-0">
                                <a class="d-block btn btn-success w-100"
                                    href="{{url('sign-up-bonus/'.$offer->id)}}" rel="noreferrer">Claim now</a><a
                                    class="mt-2 d-block btn btn-primary w-100"
                                    href="{{url('sign-up-bonus/'.$offer->id)}}" id="{{$offer->id}}">Read more...</a></div>
                        </div>
                        <div class="mt-2 text-center text-muted"><small>Terms and conditions apply new players
                            only</small></div>
                        @endforeach
                        @endauth
                        @if(!Auth::check())
                        @foreach($all_offers as $offer)
                        <div class="row table-row py-4 mt-4 mx-1 mx-md-0 shadow">

                            <div class="col-xs-12 col-md-4 col-lg-3 d-flex justify-content-center align-items-center"><a
                                    href="{{url('sign-up-bonus/'.$offer->id)}}"><img src="{{asset('images/offers/'.$offer->offer_image.'')}}"
                                        alt="<h4>{{asset($offer->title)}}</h4><p>{{asset($offer->description)}}</p>"
                                        style="width: 100%;"></a></div>
                            <div class="col-xs-12 col-md-8 col-lg-6 d-flex flex-column justify-content-center align-items-center my-4 mt-my-0">
                                <div class="row w-100">
                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center"> {{$offer->title}}
                                        <br> {{$offer->offer_type}} </div>
                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center my-4 my-md-0">
                                        <div>
                                            <div><i class="bi bi-check"></i> {{ Str::limit($offer->description, 70) }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex flex-column justify-content-center"> Valid
                                        until<br><span>{{date('F j, Y', strtotime($offer->validity))}}</span><br></div>
                                </div>
                            </div>
                            <div
                                class="col-xs-12 col-md-12 col-lg-3 d-flex flex-column justify-content-center align-items-center mt-md-4 mt-lg-0">
                                <a class="d-block btn btn-success w-100"
                                    href="{{url('sign-up-bonus/'.$offer->id)}}" rel="noreferrer">Claim now</a><a
                                    class="mt-2 d-block btn btn-primary w-100"
                                    href="{{url('sign-up-bonus/'.$offer->id)}}" id="{{$offer->id}}">Read more...</a></div>
                        </div>
                        <div class="mt-2 text-center text-muted"><small>Terms and conditions apply new players
                            only</small></div>
                        @endforeach
                        @endif


                        <div class="mt-5 sn-content">
                            <h2>Types of Bonus at My Bonus Hunter</h2>
                            <p>The latest casino bonus that require no money to be funded are typically one of two
                                options, a bonus of Free Credit or Free Spins. You often have to opt in or sign up to
                                claim them, check the <a href="/no-deposit-bonus">no deposit bonus @
                                    mybonushunter.com</a></p>
                            <h5>Free Spins</h5>
                            <p>The title kind of explains this, you join one of the online casino sites using our on
                                site bonus codes or links and you are given Free Spins. This is a set number of spins
                                and a set betting ratio of money per line and number of lines. See our <a
                                    href="/free-spins-offers">free spins offers @ mybonushunter.com</a> and remember to
                                check back for new offers daily. Any winnings are credited to your account and would be
                                subject to the wager requirement of that sites terms.</p>
                            <h5>Free Credit</h5>
                            <p>This is often translated to free play money, it will be a fixed amount of credit in the
                                form of currency, like ten dollars, and it allows you to play on the sites games without
                                risking your money. Again if you win the terms and conditions need to be adhered to
                                before you can withdraw your winnings. In some cases the value of this on site free
                                credit will be up to 100 Dollar/Euro etc. and in some casino sites it is only allowed to
                                be used on a small set of machines.</p>
                            <p>See our other offers collected from the best online casino sites:<br><a
                                    href="/best-casino-bonus">Best casino bonus</a><br><a
                                    href="/biggest-deposit-bonus">Biggest deposit bonus</a><br><a
                                    href="/best-bonus-offers">Best bonus offer</a><br><a href="/sign-up-bonus">Casino
                                    Sign up</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">Casino Tips</h2>
                            <p>Have a look at some of the tips we expose on playing casino games, tips on bonus and our
                                guides on making the most of your play in our <a href="/casino-tips"
                                    title="Tips section">tips section</a></p>
                        </div>
                        <div class="sidebar-widget">
                            <h2 class="sw-title">How we pick Bonus</h2>
                            <p>Online casino bonus offer is not confusing or deceptive</p>
                            <p>The casino accepts all major online payment options</p>
                            <p>The site has customer support online 24/7</p>
                            <p>The casino must have a list of varied games</p>
                            <p>White listed and gaming approved sites only</p>
                        </div>
                        <div class="sidebar-widget">
                            <h2 class="sw-title">Why My Bonus Hunter?</h2>
                            <p>If you have never heard of My Bonus Hunter before you might wonder what we do. We select
                                casino bonus codes, offers and incentives for you to play in casino sites. These bonuses
                                allow new players a better chance when playing online casino games. Many bonus codes
                                allow you to play free of charge too!</p>
                            <p>When you sign up to the casino you have the option to claim or use the codes and offers
                                and the bonus lets you test out the site with more chances to win than if you joined and
                                did not use a promotion code. I know, this sounds like you get to play in demo-mode
                                right? But actually playing online casino games with our bonus codes simply increases
                                the amount of turns you get in a game by increasing your deposit value or better yet,
                                lets you have free games!</p>
                        </div>
                        <div class="sidebar-widget">
                            <h2 class="sw-title">Casino Review</h2>
                            <p>We have been looking at all the online casino sites on the web, have a look at our
                                reviews in the <a href="/all-casino-reviews" alt="My Bonus Hunter reviews casino sites"
                                    title="Casino Reviews">Casino Review Section</a></p>
                        </div>
                        <div class="sidebar-widget">
                            <div class="image"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
