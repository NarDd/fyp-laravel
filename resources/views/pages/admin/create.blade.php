@extends('layouts.master')

@section('css')

@endsection


@section('title','Create Event')
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

              <h5>Add Event Images</h5>
              <div class="row">
              <div class="col s12">
                <div class="file-field input-field col s12">
                <div class="btn">
                  <span>File</span>
                  <input type="file" name="image[]" value="{{ old('image') }}"multiple>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text"placeholder="Upload one or more files">
                </div>
                </div>
              </div>
              </div>

          </div>
        </div>
<!-- Create event  -->
<div class="row">
      <div class="card">
      <h5>Event Details</h5>
      <div class="row">
        <div class="col s12">
          <div class="col s12">
          <br>
          <input type="checkbox" name="corporate" id="corporate" />
          <label for="corporate">Corporate Event</label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col s12" id="actions" hidden>
            <div class="input-field col s12">
              <select name="company" id="company">
                <option value="" disabled selected>Select your company</option>
                @foreach($companies as $company)
                <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
              </select>
              <label for="company">Select Company</label>
            </div>
          </div>

      </div>

      <div class="row">
        <div class="col s12">
        <div class="input-field col s12">
          <input id="event_name" value="{{ old('event_name') }}" placeholder="e.g Fun Run" name="event_name" type="text" class="validate">
          <label for="event_name">Event Name</label>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
        <div class="input-field col s12">
          <input id="location" value="{{ old('location') }}" placeholder="e.g Changi Airport" name="location" type="text" class="validate">
          <label for="location">Location</label>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
        <div class="input-field col s12">
          <select name="contact_id">
            <option value="" disabled selected>Please choose a contact person</option>
            @foreach($contact_id->all() as $contact)
            <option value="{{$contact->id}}">{{$contact->name}}</option>
            @endforeach
          </select>
          <label for="contact_id">Contact Person</label>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
        <div class="input-field col s12">
          <textarea id="desc" name="desc" data-length="300" placeholder="e.g This is a fundraiser for the elderly" class="materialize-textarea">{{ old('desc') }}</textarea>
          <label for="desc">Event Description</label>
        </div>
        </div>
      </div>
      <div class="row" id="date_rows">
        <div class="col s12">
          <h5>Event Time and Date</h5>
        <div class="input-field col s4">
          <input id="date" placeholder="e.g 22/7/1992" name="date[]" type="text" class="validate datepicker">
          <label for="date">Date</label>
        </div>
        <div class="input-field col s3">
          <input id="start_time" placeholder="e.g 12:00" name="start_time[]" type="text" class="validate timepicker">
          <label for="start_time">Start Time</label>
        </div>
        <div class="input-field col s3">
          <input id="end_time" placeholder="e.g 13:00" name="end_time[]" type="text" class="validate timepicker">
          <label for="end_time">End Time</label>
        </div>
        <div class="col s2">
          <a id="add_date" href="#!" class="btn-floating btn-medium scale-transition right">
             <i class="material-icons">add</i>
          </a>
        </div>
        </div>
      </div>

      <div class="row" id="skill_rows">
        <div class="col s12">
        <h5>Special Skills Needed</h5>
        <div class="input-field col s11">
          <select id="special_skills" name="special_skills[]">
            <option value="0" selected>None</option>
            @foreach($special_skills->all() as $skill)
            <option value="{{$skill->id}}">{{$skill->skill_name}}</option>
            @endforeach
          </select>
          <label for="special_skills">Special Skills</label>
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
            <textarea id="msg" name="msg" data-length="300" placeholder="e.g Please Proceed To Level 2" class="materialize-textarea">{{ old('msg') }}</textarea>
            <label for="msg">After Authentication Message</label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input id="right-btn" type="submit" value="Create Event" class="btn btn-primary">
        </div>
      </div>

    </div>
    </form>
</div>
@endsection

@section('scripts')

<script>
 var date_template = '<div class="row" id="more_dates">'+
  '<div class="col s12">'+
   '<div class="input-field col s4">'+
     '<input id="date" name="date[]" type="text" class="validate datepicker">'+
     '<label for="date">Date</label>'+
   '</div>'+
   '<div class="input-field col s3">'+
     '<input id="start_time" name="start_time[]" type="text" class="validate timepicker">'+
     '<label for="start_time">Start Time</label>'+
  '</div>'+
   '<div class="input-field col s3">'+
     '<input id="end_time" name="end_time[]" type="text" class="validate timepicker">'+
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
   '<select id="special_skills" name="special_skills[]">'+
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

 $('#add_date').on('click',function(e) {
   e.preventDefault();
   $(date_rows).after(date_template);
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
   $(this).parents('#more_dates').remove();
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
     format: 'hh:mm'
   });
}


 $(document).ready(function() {
    $('select').material_select();
    $('input#input_text, textarea#textarea1').characterCounter();
    datePicker();
    timePicker();

    var checkboxes = $("input[type='checkbox']"),
    actions = $("#actions");
    checkboxes.click(function() {
    actions.attr("hidden", !checkboxes.is(":checked"))
    });
});

</script>
@endsection
