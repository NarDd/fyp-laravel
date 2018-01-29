@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href=" {{ asset('css/slick/slick.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css') }}">

@endsection


@section('title','Home')
@section("content")
<div class="row">
  <div class="col s12">
      <div class="card">
        <div class="row">
            <div class="col s12">
              <h5>Join our upcoming events</h5>
              <div class="slickdiv">
                @foreach($slickphotos as $ph)
                <div>
                  <img src="{{ asset('eventimg') }}/{{$ph->photos[0]->url}}" style="max-height:200px;max-width:300px" />
                </div>
                @endforeach
              </div>
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
  slidesToShow: 2,
  slidesToScroll: 1,
  autoplay: true,
  centerMode: true,
  autoplaySpeed: 2000,
});

});
</script>

@endsection
