@extends('layouts.master')

@section('css')
<link href="{{URL::asset('css/main.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
@endsection


@section('title','Select Event')
@section("container")
<div class="row">
  <div class="col s12">
      <div class="card">
        <div class="row">
          <div class="col s12">
          <h5>Select Events</h5>
          </div>
        </div>

        <div class="row">
        <div class="container">
          <div class="input field col s12">
            <!-- fix this soon-->
            <!-- <i class="material-icons prefix">search</i> -->
            <input type="text" id="search" class="form-control searchbar" placeholder="Search"/>

          </div>
        </div>
        </div>

        <div class="row">
          <div class="col s12">
            @foreach($events as $event)
                  <div class="col s4 searchable">
                    <div class="card">
                        <div class="card-img"></div>
                        <div class="card-block">
                          <div class="card-div">
                          <div class="col s12">
                            <h5 class="card-title">{{$event->event_name}}</h5>
                          </div>

                          <div class="col s6">
                          <span class="card-text">Date:</span>
                          </div>
                          <div class="col s6">
                          <span class="card-text">Time:</span>
                          </div>
                          <div class="col s12">
                          <p class="card-text">Location:</p>
                          </div>

                        <div class="row">
                          <div class="col s12">
                          <a href="{{route('event.view',$event->id)}}" class="btn btn-primary right">Update Event</a>
                          </div>
                        </div>
                          </div>
                        </div>
                      </div>
                  </div>
            @endforeach
          </div>
        </div>

      </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endsection
