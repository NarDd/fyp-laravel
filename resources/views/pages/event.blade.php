@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href=" {{ asset('css/slick/slick.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css') }}">
@endsection


@section('title','Event')
@section("container")
<div class="row">
  <div class="col s12">
      <div class="card">
        @if($user != 0)
          <div class="row">
            @if($past != 1)
              <div class="col s10">
                @if($isadmin == 1)
                <a href="{{route('admin.event.edit',$event->id)}}"><input type="button" value="Edit Event" class="btn btn-primary right"></a>
                @endif
              </div>
              <div class="col s2">
                <form method="POST" action="{{route('event.volunteers')}}">
                  {{ Form::hidden('id', $event->id) }}
                  {{ Form::hidden('user', $user) }}
                @if($status == 1)
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" name="submit" value="Withdraw" class="btn btn-primary right">
                @else
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" name="submit" value="Volunteer" class="btn btn-primary right">
                @endif
                </form>
              </div>
           @endif
          </div>
        @else
        <div class="row">
            <div class="col s12">
              <a class="modal-trigger waves-effect waves-light btn blue right" href="#loginModal"><i class="material-icons left">assignment_ind</i>Click here to Login/Register to volunteer for this event</a>
            </div>
        </div>
        @endif


        <div class="row">
            <div class="col s12">

              <div class="slickdiv">
                @foreach($photo as $ph)
                <div><img src="{{ asset('eventimg') }}/{{$ph->url}}" style="max-height:500px;max-width:500px" /></div>
                @endforeach
              </div>


            </div>
        </div>
        <div class="row">
          <div class="col s12">
            <h5>{{ $event->event_name }}</h5>

            <h6>Date of Event:</h6>
            @for($i = 0; $i < count($dates); $i++)
            {{$dates[$i]->date}}  &nbsp &nbsp &nbsp  {{$dates[$i]->from_time}} - {{$dates[$i]->to_time}} <br>
            @endfor
            <br>
            <h6>Description:</h6>
            {{$event->desc}}<br>
            <br>
            @if(!$skill)
              <h6>Special skill required: None </h6>
            @else
            <h6>Special skill required:</h6>
            @if(count($skill) == 0)
            None
            @endif
            @foreach($skill as $sk)
            {{$sk->skill_name}}
            <br>
            @endforeach
            @endif
          </div>
        </div>

      </div>
  </div>
</div>




@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/slick/slick.min.js') }}"></script>

<script>
$(document).ready(function(){
  $('.slickdiv').slick({
  dots:true,
  infinite: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  centerMode: true,
  autoplaySpeed: 2000,
});

});

</script>

@endsection
