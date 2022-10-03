@extends('welcome')
<style>
    #tips {
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
                    <img src="/images/tips/tips.jpg" style="width: 100%;"/>
                </div>  
                <div class="mt-5 sn-content">
                    <h1 class="sn-title">Casino tips</h1>
                <p>Learn how to play, get some inspiration, get advice and tips from the pro's. Below is our list of helpful videos on how to play, how to win, how to avoid common mistakes, basic strategy for games and tips from across the web. Check out the many channels on YouTube to get better advantages online and in the casino.</p>
                </div>
                <div class="mt-5 sn-content">
                    @foreach($links as $link )
                    {{-- <iframe wi dth="300" height="200" type="text/html" src="{{$link->link}}" frameborder="0"></iframe> --}}

                    <h1 class="sn-title"><a href="{{$link->link}}" target="_blank" style="text-decoration: none; color: black;">
                        {{$link->title}}</a></h1>
                    <p>Learn how to play {{$link->category}}, watch the videos and master this classic casino game. Become a pro and earn money playing {{$link->category}}</p>
    
                                        <div class="mt-4 row">
                            <div class="col-6 mb-3">
                                <iframe wi dth="300" height="200" type="text/html" src="{{$link->link}}" frameborder="0"></iframe>
                            </div>
                            
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                  {{Str::limit($link->description, 100)}}
                                </div>
                            </div>
                        </div>
                                
                    @endforeach
                </div>
                

            </div>
        </div>
    
        @include('layouts.offer')
    </div>
</main>
@endsection
