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
    <div class="row">
        <div class="col-lg-8">
            <div class="sn-container">
                <div class="sn-img">
                    <img src="{{asset('images/offers/'.$offers->banner_image.'')}}" style="width: 100%; max-height: 302px;">
                </div>
                <h1 class="mt-5 text-center">{{$offers->offer_type}} offer</h1>
                <h2 class="text-center"> Casino: <a
                        href="https://captrkr.com/track/de82deec-4dc6-4510-86c9-2f9d77937f9b?type=email" target="_blank"
                        rel="noreferrer"> {{$offers->title}} </a></h2>
                <p class="mt-5">This offer is valid from {{date('F j, Y', strtotime($offers->validity))}} and provided by Spin Away. Get this amazing
                    offer by simply clicking the button below.</p>
                <p class="mt-5 p-2 text-center" style="border: 3px solid orange;"><a
                        href="https://captrkr.com/track/de82deec-4dc6-4510-86c9-2f9d77937f9b?type=email" target="_blank"
                        rel="noreferrer"> Claim: <strong> 20 Free spins and pre-signup bonus cash game </strong></a></p>
                <div class="mt-5">
                    <h4>Free spins at {{$offers->title}}</h4>
                    <p>{{$offers->description}}</p>
                </div>
                @if(!Auth::check())
                <div class="mt-5 justify-content-start">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="offer_id" value="{{$offers->id}}">
                        <input type="hidden" name="credit" value="{{$offers->credit}}">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4" style="display: block">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Signup') }}
                                </button>
                               <span style="font-size: 12px;"> Already have an account?</span> <a href="{{route('user_login')}}" class="">
                                    Click here.
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                @else   
                    <div class="d-flex justify-content-center">
                        <div class="col-auto">
                            <form action="{{route('user.claimed')}}" method="POST">
                                @csrf
                                <input type="hidden" name="offer_id" value="{{$offers->id}}">
                                <input type="hidden" name="credit" value="{{$offers->credit}}">
                                <button type="submit" class="btn btn-lg btn-success" style="width: 200px;">Claim</button>
                            </form>
                        </div>
                    </div>
                @endif
                <div class="mt-5">
                    <h3>Bonus offer</h3>
                    <div class="text-center"> 20 Free spins and pre-signup bonus cash game </div>
                </div>
                <div class="text-center mt-2"><small class="text-muted"> Conditions: Canadian new registrations only
                    </small></div>
                <p class="mt-5">Sign up offers are designed to give you a great introduction to a casino so you get the most
                    action and best bonus to join and enjoy the fun at the casino. Accept no other offers unless
                    MyBonusHunter has hunted them down!</p>
            </div>
        </div>
        @include('layouts.offer')
    </div>
</main>
@endsection
