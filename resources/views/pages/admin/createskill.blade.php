@extends('layouts.master')

@section('css')

@endsection


@section('title','Create Skill')
@section("container")
<form class="col s12" id="skill.create" method="POST" enctype="multipart/form-data">
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
      <h5>Create Skill</h5>

      <div class="row" id="skill_rows">
        <div class="col s12">
        <h5>Special Skills Needed</h5>
        <div class="input-field col s11">
          <input id="skill" placeholder="Typing" name="skill_name[]" type="text">
          <label for="skill">Skill Name</label>
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
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input id="right-btn" type="submit" value="Add Skills" class="btn btn-primary">
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <h5>All Skills</h5>
          @foreach($skills as $sk)
              {{$sk->skill_name}}
              <br>
          @endforeach
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
