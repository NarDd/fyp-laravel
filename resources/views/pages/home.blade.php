@extends('layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href=" {{ asset('css/slick/slick.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css') }}">

@endsection


@section('title','Home')
@section("content")
<div class="row">
  <div class="col s12">
      <div class="card" style="padding:25px">
        <h5>About Us</h5>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nec arcu vel purus ultrices pretium. Vivamus vitae vulputate nisi. Nullam ut neque sit amet dui consectetur lobortis vel vehicula nulla. Phasellus eget metus malesuada tellus efficitur tristique ut et sapien. Proin sit amet purus tellus. Morbi vitae turpis velit. Aliquam nec urna venenatis, sagittis diam non, suscipit purus. Ut scelerisque sapien in nibh pharetra aliquam. Etiam pharetra ex eu pellentesque suscipit. Sed ac
        hendrerit leo.
        <br>
        <br>
        Praesent pretium rutrum leo, in tincidunt arcu condimentum et. Nam sem nunc, pharetra id pellentesque id, blandit ut libero. Quisque semper vel tellus sed ornare. Nulla scelerisque fermentum nulla. Pellentesque malesuada nec erat id dignissim. Ut eu nisi fringilla, viverra lectus sed, aliquet velit. Duis tempus vehicula augue nec convallis. Fusce feugiat interdum hendrerit. Nullam tempus nibh at purus accumsan, tempus finibus nisi pulvinar. Nam dui ipsum, ornare ac sem eu, iaculis gravida
        <br>
        massa. Quisque sed rhoncus dui, eu rutrum risus. Aliquam a faucibus mi. Vivamus aliquam, arcu eget molestie euismod, dui nisi ultrices lacus, vel consectetur ligula metus eu purus. Morbi sagittis nulla vehicula, consectetur elit ut, tempor lectus. Nunc luctus malesuada mi, sed pretium urna.
        <br>
        <br>
        Praesent vel laoreet odio, id cursus leo. Nullam sollicitudin dolor quis nisl tempor, non gravida eros viverra. Sed commodo tristique lacinia. Proin quis eros pretium, rutrum mauris vitae, lacinia justo. Etiam dolor velit, congue sed sagittis at, elementum a lorem. Maecenas id ex vel nisi varius tincidunt. Pellentesque tempor est nec dui consequat tristique. Nam eleifend ullamcorper vehicula. Quisque porta gravida dolor nec volutpat. Etiam congue urna vel commodo lobortis.
        <br>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non augue quis velit pulvinar rutrum. Praesent tortor turpis, imperdiet a lobortis et, semper non enim. Nunc dui turpis, dictum vel lacinia mattis, viverra a erat. Etiam semper, dolor quis iaculis dapibus, massa sem laoreet neque, nec sodales lectus arcu ut nisi. Duis at ultricies tellus. Aenean eget eros dapibus tortor tristique malesuada. Cras placerat dolor sed vulputate pretium. Etiam tincidunt condimentum tellus nec
        <br>
        <br>
        facilisis. In posuere at lorem vitae faucibus. Cras a lacus sit amet purus convallis egestas id id erat. Nam tristique et elit eget blandit. Quisque sagittis elit a ipsum faucibus sollicitudin in in metus. Phasellus vel tortor velit.
        <br>
        Maecenas sit amet lacus at dolor suscipit egestas. Praesent elementum orci sed nisi iaculis, quis ultrices urna imperdiet. Nulla volutpat, tellus non blandit lacinia, tortor leo eleifend mi, nec maximus justo neque eget ante. Maecenas feugiat eget felis sit amet consequat. Vestibulum condimentum dui ac consequat pulvinar. Mauris cursus diam in ex dictum, id maximus tortor maximus. Integer sit amet velit ac ligula pulvinar lacinia sit amet sed dolor. Aliquam nibh velit, tincidunt ac mollis
        at, auctor non lorem. Donec neque erat, porta eget rhoncus at, condimentum a lorem.
      </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
      <div class="card">
        <div class="row">
            <div class="col s12">
              <a href="{{ route('upcoming.events') }}"><h5>Join our upcoming events</h5></a>
              <div class="slickdiv">


                @foreach($slickphotos as $ph)

                    <div class="field-item even slick-slide slick-active">
                      <a href="{{route('event.view',['id' => $ph->id, 'past' => 0])}}">
                      <img src="{{ asset('eventimg') }}/{{$ph->photos[0]->url}}" style="max-height:300px;max-width:500px" />
                      <div class="caption">{{$ph->event_name}}</div>
                      </a>
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
@if(count($slickphotos) == 1){
  $(document).ready(function(){
  $('.slickdiv').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    centerMode: true,
    autoplaySpeed: 2000,
  });
  
  });
}
@elseif(count($slickphotos) == 2)
$(document).ready(function(){
$('.slickdiv').slick({
  infinite: true,
  slidesToShow: 2,
  slidesToScroll: 1,
  autoplay: true,
  centerMode: true,
  autoplaySpeed: 2000,
});

});
@else
$(document).ready(function(){
$('.slickdiv').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  centerMode: true,
  autoplaySpeed: 2000,
});

});
@endif

</script>

@endsection
