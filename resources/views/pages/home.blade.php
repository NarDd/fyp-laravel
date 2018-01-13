@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/slick/slick-theme.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ asset('css/slick/slick.css') }}"/>
@endsection


@section('title','Home')
@section("content")


@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/slick/slick.js') }}"></script>
@endsection
