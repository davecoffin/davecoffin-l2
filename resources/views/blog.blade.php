@extends('layout')

@section('title', 'Dave Coffin: Blog')
@section('navClass', 'homenav navbar-dark nav-transtop')
@section('blogActive', 'active')
@section('content')

<div class="container-fluid" style="background-color: #333; background-image: url(https://www.oceanchampions.org/wp-content/uploads/2015/05/light-shining-down-copy-2.jpg); background-size: cover; background-position: center;"><h1 style="text-align: center; font-family: Avenir; font-weight: lighter; color: white; padding: 100px 0px;">Blog</h1></div>
<div class="container floatingnav">
    <!-- Example row of columns -->
    @foreach ($blogs as $blog_id => $blog)
        <div class="row justify-content-md-center">
            <div class="col-md-8 col-lg-6 blog_entry">
                <a href="{{$blog['external_link'] ? $blog['external_link'] : '/blog/'.$blog_id}}" target="{{$blog['external_link'] ? '_blank' : '_self'}}">
                    <span class="avenuir lt upper">{{$blog['date']}} {!! $blog['external_link'] ? '&nbsp;&nbsp;<i class="fa fa-external-link" aria-hidden="true"></i>' : '' !!}</span>
                    <h3>{{$blog['title']}}</h3>
                    <span class="description">{{$blog['brief_description']}}</span><br />
                    <span class="readmore">Read More</span>
                </a>
            </div>
        </div>
    @endforeach
    
    <hr />
</div>

@endsection