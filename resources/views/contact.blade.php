@extends('layout')

@section('title', 'Dave Coffin: Contact')
@section('navClass', 'homenav navbar-dark nav-transtop')
@section('contactActive', 'active')
@section('content')

<div class="container-fluid" style="background-color: #333; background-image: url(http://loves-animals.com/wp-content/uploads/2013/01/animals-landscape-20.jpg); background-size: cover; background-position: center;"><h1 style="text-align: center; font-family: Avenir; font-weight: lighter; color: white; padding: 100px 0px;">Contact</h1></div>
<div class="container floatingnav contact">
    <center>
        <i class="fa fa-phone" aria-hidden="true"></i><br />
        (207) 576-2034<br />

        <br /><br /><br /><br />
        <a href="mailto:dave@davecoffin.com">
            <i class="fa fa-envelope-o" aria-hidden="true"></i><br />
            dave@davecoffin.com
        </a>

        <br /><br /><br /><br />
        <a href="http://twitter.com/davecoffin">
            <i class="fa fa-twitter" aria-hidden="true"></i><br />
            @davecoffin
        </a>

        <br /><br /><br /><br />
        <a href="http://facebook.com/davecoffinmusic">
            <i class="fa fa-facebook" aria-hidden="true"></i><br />
            davecoffinmusic
        </a>

        <br /><br /><br /><br />
        <a href="https://www.linkedin.com/in/davecoffin/">
            <i class="fa fa-linkedin-square" aria-hidden="true"></i><br />
            davecoffin
        </a>
        <br /><br /><br /><br />

    </center>
</div>

@endsection