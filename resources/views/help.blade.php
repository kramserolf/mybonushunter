@extends('welcome')
<style>
    #help {
        color: white;
    }

    #home {
        text-decoration: none;
        color: #A9A9A9
    }
</style>
@section('content')
<main class="mt-5 container">
    <div class="row">
        <div class="col-lg-8">
            <div class="sn-container">
                <div class="sn-img">
                    @foreach($helps as $help)
                        <img src="{{asset('images/helps/'.$help->image.'')}}" style="width: 100%" />
                    @endforeach

                </div>
                <div class="mt-5 sn-content">
                    <h1 class="sn-title">Our help pages</h1>
                    <p>Advice, help and general information to help you get started. Check out our help topic listed
                        below:</p>
                    <ul>
                        <li><b>Sign up Bonus</b> is an incentive to help you get started in the casino. <a
                                href="/help-signup" title="Read more about casino sign up offers"
                                alt="Information on casino sign up and the bonus they offer">Read more</a></li>
                        <li><b>VPN</b> is some software that connects you to another server to mask your real IP address
                            (Internet address of your PC) and often is used to pretend you are in another country.<a
                                href="/help-vpn" title="Read more about VPN software and help"
                                alt="Information on VPN software and the best award winning solutions 2021">Read
                                more</a></li>
                        <li><b>Gamble Aware</b> website is a place where you can go and get useful help and advice if
                            you are starting to be concerned about gambling</li>
                        <li><b>Wager Requirment</b> is a level of wagers you must complete before cashing out your
                            winnings.</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('layouts.offer')
    </div>
    </div>
</main>

@endsection