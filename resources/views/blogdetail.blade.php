@extends('layout')

@section('title', 'Dave Coffin: Blog')
@section('navClass', 'homenav navbar-dark nav-transtop')
@section('blogActive', 'active')
@section('content')

<div class="container-fluid" style="text-align: center; font-family: Avenir; font-weight: lighter; color: white; background-color: #333; background-image: url('{{$blogs[$blog_id]['image']}}'); padding: 100px 0px; background-size: cover; background-position: center;">
    <h1 style="">{{$blogs[$blog_id]['title']}}</h1>
    <h5>{{$blogs[$blog_id]['date']}}</h5>
</div>
<div class="container floatingnav">
    <!-- Example row of columns -->
    <div class="row blog_details">
        @include('blogs.'.$blog_id)
    </div>
    <br /><br />
    <hr />
</div>

@endsection