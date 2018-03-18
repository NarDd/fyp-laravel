@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href=" {{ asset('css/slick/slick.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css') }}">
@endsection


@section('title','Edit Event')
@section("container")
<form class="col s12" id="event.create" method="POST" enctype="multipart/form-data">
  <div class="row">
          <div class="col s12">
            <!-- Errors upon submit -->
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                {{ $error }}<br>
              @endforeach
            </div>
            @endif
            <!-- Errors upon submit -->

              <h5>Edit Event Images</h5>
              <div class="row">
              <div class="col s12">
              <div class="container">
                <div class="slickdiv">
                  @foreach($photos as $ph)
                  <div><img src="{{ asset('eventimg') }}/{{$ph->url}}" style="max-height:500px;max-width:500px" /></div>
                  @endforeach
                </div>
              </div>
              </div>
              </div>

              <div class="row">
              <div class="col s12">
              <!-- <input type="file" name="image" /> -->

                <div class="file-field input-field col s12">
                <div class="btn">
                  <span>File</span>
                  <input type="file" name="image">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload one or more files">
                </div>
                </div>
              </div>
              </div>

          </div>
    </div>
<!-- Create event  -->
<div class="row">

      <div class="card">
      <h5>Edit Event Details</h5>
      <div class="row">
        <div class="col s12">
        <div class="input-field col s12">
          <input id="event_name" placeholder="e.g Fun Run" value="{{$event->event_name}}" name="event_name" type="text" class="validate">
          <label for="event_name">Event Name</label>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
        <div class="input-field col s12">
          <input id="location"  placeholder="e.g Changi Airport" value="{{$event->location}}" name="location" type="text" class="validate">
          <label for="location">Location</label>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
        <div class="input-field col s12">
          <select name="contact_id">
            <option value="{{$contact->id}}" selected>{{$contact->name}}</option>
            @foreach($admin as $contact)
            @if($contact->id != $event->contact_id)
            <option value="{{$contact->id}}">{{$contact->name}}</option>
            @endif
            @endforeach
          </select>
          <label for="contact_id">Contact Person</label>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
        <div class="input-field col s12">
          <textarea id="desc" name="desc" data-length="300" placeholder="e.g This is a fundraiser for the elderly" class="materialize-textarea">{{$event->desc}}</textarea>
          <label for="desc">Event Description</label>
        </div>
        </div>
      </div>
      <!-- here -->

      <div class="row" id="date_rows" data-ids=[{{ implode(",", range(0,count($dates)-1)) }}]>
          <div class="col s12">
              <h5>Event Time and Date</h5>
          </div>

            @for($i = 0 ; $i < count($dates) ; $i++)
              <article class="date_cluster" data-index={{$i}}>
              <div class="input-field col s4">
                <input id="date{{ $i }}" placeholder="e.g 22/7/1992" value="{{$dates[$i]->date}}" name="date[]" type="text" class="validate datepicker">
                <label for="date{{ $i }}">Date</label>
              </div>

              <div class="input-field col s3">
                <input id="start_time{{ $i }}" placeholder="e.g 12:00" value="{{$dates[$i]->from_time}}" name="start_time[]" type="text" class="validate timepicker">
                <label for="start_time{{ $i }}">Start Time</label>
              </div>
              <div class="input-field col s3">
                <input id="end_time{{ $i }}" placeholder="e.g 13:00" name="end_time[]" value="{{$dates[$i]->to_time}}" type="text" class="validate timepicker">
                <label for="end_time{{ $i }}">End Time</label>
              </div>
              <div class="col s1">
                <a id="add_date" href="#!" class="btn-floating btn-medium scale-transition right add_date">
                   <i class="material-icons">add</i>
                </a>
              </div>
              <div class="col s1">
                <a id="remove_date" href="#!" class="btn-floating btn-medium scale-transition right remove_date">
                 <i class="material-icons">remove</i>
               </a>
              </div>
            </article>
            @endfor
    </div>


      <div class="row" id="skill_rows">
        <div class="col s12">
        <h5>Special Skills Needed</h5>

        <div class="input-field col s11">
            @if(isset($skills))
              @foreach($skills as $i=>$sk)
              <select id="special_skills{{$i}}" name="special_skills[]">
                <option value="{{$sk->id}}" selected>{{$sk->skill_name}}</option>
                @foreach($special_skills as $ss)
                <option value="{{$ss->id}}" selected>{{$ss->skill_name}}</option>
                @endforeach
              </select>
              @endforeach
            @else
              <select id="special_skills{{$i}}" name="special_skills[]">
              @foreach($special_skills as $ss)
              <option value="{{$ss->id}}" selected>{{$ss->skill_name}}</option>
              @endforeach
              </select>
            @endif



        <label for="special_skills{{$i}}">Special Skills</label>
        </div>
        <div class="col s1">
          <a id="add_skills" href="#!" class="btn-floating btn-medium scale-transition right">
             <i class="material-icons">add</i>
          </a>
        </div>

        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <div class="input-field col s12">
            <textarea id="msg" name="msg" data-length="300" placeholder="e.g Please Proceed To Level 2" class="materialize-textarea">{{$event->msg}}</textarea>
            <label for="msg">After Authentication Message</label>
          </div>
        </div>
      </div>
      <input name="id" type="hidden" value="{{$event->id}}">
      <div class="row">
        <div class="col s12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input id="right-btn" type="submit" value="Update Event" class="btn btn-primary">
        </div>
      </div>

    </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
console.log($("#date_rows").data("ids"));
 var date_template = '<div class="row" id="more_dates">'+
  '<div class="col s12">'+
   '<div class="input-field col s3">'+
     '<input id="datefrom" type="text" class="validate datepicker">'+
     '<label for="datefrom">Date From</label>'+
   '</div>'+
  ' <div class="input-field col s3">'+
    ' <input id="dateto" name="date" type="text" class="validate datepicker">'+
    ' <label for="dateto">Date To</label>'+
   '</div>'+
   '<div class="input-field col s2">'+
     '<input id="start_time" type="text" class="validate timepicker">'+
     '<label for="start_time">Start Time</label>'+
  '</div>'+
   '<div class="input-field col s2">'+
     '<input id="end_time" type="text" class="validate timepicker">'+
     '<label for="end_time" class="bmd-label-floating">End Time</label>'+
   '</div>'+
   '<div class="col s2">'+
     '<a id="remove_date" href="#!" class="btn-floating btn-medium scale-transition right">'+
      '<i class="material-icons">remove</i>'+
    '</a>'+
   '</div>'+
 '</div>'+
 '</div>'

 var skill_template = '<div class="row" id="more_skills">'+
 '<div class="col s12">'+
 '<div class="input-field col s11">'+
   '<select id="special_skills" name="special_skills">'+
    ' <option value="" disabled selected>None</option>'+
     '@foreach($special_skills->all() as $skill)'+
     '<option value="{{$skill->id}}">{{$skill->skill_name}}</option>'+
     '@endforeach'+
   '</select>'+
   '<label for="special_skills">Special Skills</label>'+
'</div>'+
 '<div class="col s1">'+
   '<a id="remove_skill" href="#!" class="btn-floating btn-medium scale-transition right">'+
      '<i class="material-icons">remove</i>'+
   '</a>'+
 '</div>'+
 '</div>'+
 '</div>'

 $(document).on('click', '.add_date', function(e) {
   e.preventDefault();

   console.log($("#date_rows"));
   $(".date_cluster").last().clone().appendTo("#date_rows");
   // $(date_rows).after(date_template);
   datePicker();
   timePicker();
 });

 $('#add_skills').on('click',function(e) {
   e.preventDefault();
   $(skill_rows).after(skill_template);
   $('select').material_select();
 });

$(document).on('click','#remove_date',function(e){
    e.preventDefault();
    $(e.target).parents(".date_cluster").remove();
   // $(this).parents('#more_dates').remove();
 });

 $(document).on('click','#remove_skill',function(e){
     e.preventDefault();
    $(this).parents('#more_skills').remove();
  });

  function datePicker(){
    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year,
      today: 'Today',
      clear: 'Clear',
      close: 'Ok',
      format: 'yyyy-mm-dd',
      closeOnSelect: false // Close upon selecting a date,
    });
  }

function timePicker(){
  $('.timepicker').pickatime({
     default: 'now', // Set default time: 'now', '1:30AM', '16:30'
     fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
     twelvehour: false, // Use AM/PM or 24-hour format
     donetext: 'OK', // text for done-button
     cleartext: 'Clear', // text for clear-button
     canceltext: 'Cancel', // Text for cancel-button
     autoclose: false, // automatic close timepicker
     ampmclickable: true, // make AM PM clickable
     format: 'hh:mm',
     aftershow: function(){} //Function for after opening timepicker
   });
}


 $(document).ready(function() {
    $('select').material_select();
    $('input#input_text, textarea#textarea1').characterCounter();
    datePicker();
    timePicker();
    $('.slickdiv').slick({
    dots:true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
  });
});

</script>
<script type="text/javascript" src="{{ asset('js/slick/slick.min.js') }}"></script>
@endsection
