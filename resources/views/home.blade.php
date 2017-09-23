@extends('layout')

@section('title', 'Dave Coffin: Developer & Musician')
@section('navClass', 'homenav navbar-light')
@section('homeActive', 'active')

@section('meta_description')
    <meta name="description" content="Shads has been doing this for a long time.">
@endsection

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <center><h4 class="display-4" style="font-family: monospace; text-shadow: 0px 0px 15px white; margin-right: 250px; color: orange;">Hello.</h4></center>
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="container callout center">
        <span>Hi there.<br /><br />I am a native mobile app developer, full stack web developer, a musician, and a husband/dad.</span><br /><br />
        <img src="https://scontent.fbed1-1.fna.fbcdn.net/v/t31.0-8/20507799_10103730241333279_6464260542939352229_o.jpg?oh=c2aff219f6b68d9c3034cfd17d87d098&oe=59F3E70C" style="width: 400px; max-width: 100%; border-radius: 200px;"><br /><br />
        <span>I do mainly cross platform native mobile development, and also full stack web development.</span>
    </div>

    <div class="offwhite_pad features" style="background-image: url(https://static.pexels.com/photos/3888/landscape-seascape-dark-clouds.jpg); background-size: cover; background-position: bottom center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left text-md-right">
                    <br />
                    <h4>NATIVE MOBILE</h4>
                    <ul>
                        <li>iOS</li>
                        <li>Android</li>
                        <li>Firebase</li>
                        <li>Onesignal</li>
                    </ul>
                </div>
                <div class="col-md-6 text-left">
                    <br />
                    <h4>WEB FULL STACK</h4>
                    <ul>
                        <li>PHP: Codeigniter, Laravel, Composer</li>
                        <li>MySql</li>
                        <li>HTML, CSS</li>
                        <li>JavaScript/TypeScript: Angular 1 & 2, Vue.js, node.js, npm</li>
                        <li>Cloud Services/APIs: Firebase, Cloudinary, OneSignal</li>
                        <li>Version Control: Git, SVN</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>


    <div class="container padtop callout text-left">
        
        <div class="row">
            <div class="col-md-12">
                <p>My passion lately is <a href="http://nativescript.org" target="_blank">NativeScipt</a>, a cross platform mobile development framework.</p>
                <p>With it I have developed a <a href="https://dailynannyapp.com" target="_blank">fully fledged (and deployed) app</a>, and have a few others in the works.</p>
                <p>I regularly hang out in the NativeScript Slack channel both answering and asking questions, so come say here there!</p>
                <p>I do freelance, so <router-link v-bind:to="'/contact'">reach out</router-link> if you have any web/mobile needs!</p>
            </div>
        </div>
        <br />
    </div>
@endsection