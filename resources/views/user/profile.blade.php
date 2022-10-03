@extends('welcome')

<style>
    #home {
        text-decoration: none;
        color: #A9A9A9
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
                           <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-lg-10 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{route('userProfile.update')}}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Profile information</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Name<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('firstname', Auth::user()->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Email</label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Current password</label>
                                        <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">New password</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirm password</label>
                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4 mt-1">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
                    </div>
                    <div class="mt-2 sn-content">
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