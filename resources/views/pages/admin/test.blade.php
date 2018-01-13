@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ asset('css/slick/slick.css') }}"/>
@endsection


@section('title','Upcoming Events')
@section("content")

<div class="container">
<div class="col-md-12">
  <div class="card-panel">
  <h3>Upcoming events</h3>
  <br>
  <div class="row">
    <div class="col-md-12">
    <input type="text" class="form-control searchbar" placeholder="Search"/>
    </div>
  </div>
  <!-- <div class="row"> -->
  @foreach($events as $event)
        <div class="col-md-4 searchable">
          <div class="card">
              <div class="card-img"></div>
              <div class="card-block">
                <div class="card-div">
                  <h2 class="card-title">{{$event->event_name}}</h2>
                <div>
                <span class="card-text">Date:</span>
                <span class="card-text">Time:</span>
                <p class="card-text">Location:</p>
              </div>

                <a href="{{route('event.view',$event->id)}}" class="btn btn-primary">View Event</a>
                </div>
              </div>
            </div>
        </div>
  @endforeach
<!-- </div> -->
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endsection
