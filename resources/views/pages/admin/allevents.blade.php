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
          <h5>All Events</h5>
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
            @foreach($currentEvents as $event)
                  <div class="col s6 searchable equalize">
                    <div class="card main-card">
                      <div class="card-image">

                      <img style="max-height:300px" src="{{ asset('eventimg/' . $event->photos[0]->url) }}"/>
                      <span class="card-title">{{$event->event_name}}</span>
                      <a href="{{route('event.view',['id' => $event->id, 'past' => 0])}}" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">arrow_forward</i></a>
                      </div>

                    <div class="card-content">
                      <div class="row">
                      <div class="col s2">
                      <span class="card-text">Date:</span>
                      </div>

                      <div class="col s4">
                      @foreach($event->eventdates as $dates)
                      <span class="card-text">{{$dates->date}}</span><br>
                      @endforeach
                      </div>

                      <div class="col s2">
                      <span class="card-text">Time:</span>
                      </div>

                      <div class="col s4">
                        @foreach($event->eventdates as $dates)
                        <span class="card-text">{{$dates->from_time}} - {{$dates->to_time}} </span><br>
                        @endforeach
                      </div>
                      </div>
                      <div class="col s12">

                      <div class="row">
                      <p class="card-text">Location: {{$event->location}}</p>
                      </div>
                      </div>
                    </div>
                    </div>
                  </div>
            @endforeach

            @foreach($pastEvents as $event)
                  <div class="col s6 searchable equalize">
                    <div class="card main-card">
                      <div class="card-image">

                      <img style="max-height:300px" src="{{ asset('eventimg/' . $event->photos[0]->url) }}"/>
                      <span class="card-title">{{$event->event_name}}</span>
                      <a href="{{route('event.view',['id' => $event->id, 'past' => 1])}}" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">arrow_forward</i></a>
                      </div>

                    <div class="card-content">
                      <div class="row">
                      <div class="col s2">
                      <span class="card-text">Date:</span>
                      </div>

                      <div class="col s4">
                      @foreach($event->eventdates as $dates)
                      <span class="card-text">{{$dates->date}}</span><br>
                      @endforeach
                      </div>

                      <div class="col s2">
                      <span class="card-text">Time:</span>
                      </div>

                      <div class="col s4">
                        @foreach($event->eventdates as $dates)
                        <span class="card-text">{{$dates->from_time}} - {{$dates->to_time}} </span><br>
                        @endforeach
                      </div>
                      </div>
                      <div class="col s12">

                      <div class="row">
                      <p class="card-text">Location: {{$event->location}}</p>
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
