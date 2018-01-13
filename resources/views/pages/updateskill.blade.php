@extends('layouts.master')

@section('css')

@endsection


@section('title','Update Skill')
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
            <h5>Update Skills</h5>
          </div>
        </div>

      <div class="row">
        <div class="col s12">
          @foreach($skills as $skill)

            @if(!$uskill->first())

              @for($i = 0 ; $i < count($skill) ; $i++)
              <input type="checkbox" value="{{$skill->id}}" id="{{$skill->id}}" name="skills[]" />
                <label for="{{$skill->id}}">{{$skill->skill_name}}</label>
              <br>
              @endfor
            @else
              @for($i = 0 ; $i < count($uskill) ; $i++)
                @if($skill->id == $uskill[$i]->id)
                <input type="checkbox" value="{{$skill->id}}" checked="checked" id="{{$skill->id}}" name="skills[]" />
                  <label for="{{$skill->id}}">{{$skill->skill_name}}</label>
                <br>
                @break
                @endif

                @if($skill->id != $uskill[$i]->id && $i == count($uskill)-1)
                <input type="checkbox" value="{{$skill->id}}" id="{{$skill->id}}" name="skills[]" />
                  <label for="{{$skill->id}}">{{$skill->skill_name}}</label>
                <br>
                @break
                @endif
            @endfor
            @endif
          @endforeach

        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input id="right-btn" type="submit" value="Update Skillset" class="btn btn-primary">
        </div>
      </div>



    </div>
    </form>
</div>
@endsection

@section('scripts')

@endsection
