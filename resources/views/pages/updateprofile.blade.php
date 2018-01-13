@extends('layouts.master')

@section('css')

@endsection


@section('title','Update Profile')
@section("container")
<form class="col s12" id="profile.update" method="POST" enctype="multipart/form-data">
<!-- Create event  -->
<div class="row">
      <div class="card">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
        </div>
        @endif
      <div class="row">
        <div class="col s12">
          <h5>Update Profile</h5>
          <label for="name">Name</label>
          <input id="name" name="name" value="{{$user->name}}" type="text">
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <label for="email">Email</label>
          <input id="email" name="email" value="{{$user->email}}" type="text">
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <label for="event_name">Password</label>
          <input id="password" name="password" placeholder="Enter password" type="password" class="validate">
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input id="password_confirmation" name="password_confirmation" placeholder="Re-enter password" type="password" class="validate">
          <label for="password_confirmation">Confirm Password</label>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input id="right-btn" type="submit" value="Update Profile" class="btn btn-primary">
        </div>
      </div>



    </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
 var skill_template = '<div class="row" id="more_skills">'+
 '<div class="col s12">'+
 '<div class="input-field col s11">'+
' <input id="skill" placeholder="Typing" name="skill_name[]" type="text">'+

'</div>'+
 '<div class="col s1">'+
   '<a id="remove_skill" href="#!" class="btn-floating btn-medium scale-transition right">'+
      '<i class="material-icons">remove</i>'+
   '</a>'+
 '</div>'+
 '</div>'+
 '</div>'


 $('#add_skills').on('click',function(e) {
   e.preventDefault();
   $(skill_rows).after(skill_template);
   $('select').material_select();
 });

 $(document).on('click','#remove_skill',function(e){
     e.preventDefault();
    $(this).parents('#more_skills').remove();
  });

</script>
@endsection
