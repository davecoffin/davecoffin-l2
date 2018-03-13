@extends('layout')

@section('title', 'Dave Coffin: Code')
@section('navClass', 'homenav navbar-dark nav-transtop')
@section('codeActive', 'active')
@section('content')

<div class="container-fluid" style="background-color: #333; background-image: url(https://i.ytimg.com/vi/MLX2wLdHrYU/maxresdefault.jpg); background-size: cover; background-position: center;"><h1 style="text-align: center; font-family: Avenir; font-weight: lighter; color: white; padding: 100px 0px;">Code</h1></div>
<div class="container floatingnav">
    <!-- Example row of columns -->
    <div class="row justify-content-md-center">
        <div class="col-sm-12 col-lg-8">
            I do a lot of things, here are a few:
            <br /><br />
            <div class="pb-5">
                <center><h1 class="avenir lt">Daily Nanny</h1></center>
                Daily Nanny is a cross platform app I created with NativeScript. It helps parents keep in touch with their kids nanny during the day, receive photos,
                group message, track daily info and more. You can learn more about it at <a href="https://dailynannyapp.com" target="_blank">dailynannyapp.com</a>.
            </div>
        </div>
    </div>
    
    <div class="row justify-content-md-center screenshots">
        <div  class="col-sm-6 col-md-2 p-1"><a href="/images/iphone_add.png" target="_blank"><img src="/images/iphone_add.png" /></div></a>
        <div  class="col-sm-6 col-md-2 p-1"><a href="/images/iphone_feed.png" target="_blank"><img src="/images/iphone_feed.png" /></div></a>
        <div  class="col-sm-6 col-md-2 p-1"><a href="/images/iphone_messages.png" target="_blank"><img src="/images/iphone_messages.png" /></div></a>
        <div  class="col-sm-6 col-md-2 p-1"><a href="/images/iphone_photos.png" target="_blank"><img src="/images/iphone_photos.png" /></div></a>
        <div  class="col-sm-6 col-md-2 p-1"><a href="/images/iphone_shifts.png" target="_blank"><img src="/images/iphone_shifts.png" /></div></a>
        <div  class="col-sm-6 col-md-2 p-1"><a href="/images/iphone_tracker.png" target="_blank"><img src="/images/iphone_tracker.png" /></div></a>
    </div>

    <div class="row justify-content-md-center pt-5">
        <div class="col-sm-12 col-lg-8">
            <div class="pb-5">
                <center><a href="http://nstudio.io" target="_blank"><img src="https://nstudio.io/assets/nstudio-logo.svg" width="300" style="background-color: #f75930; border-radius: 10px;"></a></center><br />
                I work with an amazing team of developers on a wide range of projects, mainly focusing on cross platform native app development, but we do projects of all kinds.
                
                <br /><br />
                Visit <a href="http://nstudio.io" target="_blank">nstudio.io</a> to learn more.
            </div>
        </div>
    </div>

    <div class="row justify-content-md-center pt-5">
        <div class="col-sm-12 col-lg-8">
            <div class="pb-5">
                <center><h1 class="avenir lt">PreSonus</h1></center>
                I work for PreSonus, an awesome company that manufactures audio recording equipment. I am responsible for their user portal, called MyPreSonus
                and built the front end application, used by thousands of PreSonus customers to register products, learn how to use them, manage profile information
                and more.
                <br /><br />
                I also built a native cross platform mobile app for MyPreSonus, check it out on <a href="https://itunes.apple.com/us/app/mypresonus/id1282534772?mt=8" target="_blank">iOS</a> or <a href="https://play.google.com/store/apps/details?id=com.presonus.mypresonus&hl=en" target="_blank">Android</a>!
                <br /><br />
                Visit <a href="http://presonus.com" target="_blank">presonus.com</a> to learn more.
            </div>
        </div>
    </div>

    <div class="row justify-content-md-center pt-5">
        <div class="col-sm-12 col-lg-8">
            <div class="pb-5">
                <center><h1 class="avenir lt">Loud Canvas</h1></center>
                I also freelance for a New Hampshire web development company called Loud Canvas, working on complicated web applications for customers all over the country.
                <br /><br />
                Visit <a href="http://loudcanvas.com" target="_blank">loudcanvas.com</a> to learn more.
            </div>
        </div>
    </div>
    
    <div class="row justify-content-md-center pt-5">
        <div class="col-sm-12 col-lg-8">
            <div class="pb-5">
                <center><h1 class="avenir lt">NativeScript, Progress & Telerik</h1></center>
                I am proud to have been invited to particpate in Telerik's Developer Expert program, focusing on NativeScript, a cross platform mobile app framework.
                I build cross platform apps using NativeScript, and also mentor members of the community, participate in thought leadership on many mobile 
                related subjects, and help others new to mobile development get ramped up with the framework.
                <br /><br />
                Learn about NativeScript <a href="http://nativescript.org" target="_blank">here</a>, and the Telerik Developer Expert program <a href="https://developer-experts-hub.firebaseapp.com/" target="_blank">here</a>.
            </div>
        </div>
    </div>

</div>

@endsection