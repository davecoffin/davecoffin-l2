@extends('layout')

@section('title', 'Dave Coffin: Developer & Musician')
@section('navClass', 'homenav navbar-light lighttop')
@section('homeActive', 'active')

@section('meta_description')
    <meta name="description" content="I am a native mobile app developer, full stack web developer, a musician, and a husband/dad.">
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
        <img src="https://dailynannyapp.com/images/family.png" style="width: 400px; max-width: 100%; border-radius: 10px;"><br /><br />
        <span>I design, develop, launch and manage custom websites from scratch, including complicated API integrations, ecommerce, and CMS (content management) if needed. I also create cross platform mobile applications. Here are some of my projects:</span><br />
        
    </div>

    <div class="container callout" style="text-align: left; max-width: 800px; margin: auto;">
        <a href="http://dailynannyapp.com">Daily Nanny</a>: A native mobile application used by parents and nannies to communicate better. I designed and created the website and the mobile app.<br />
        <a href="http://cubbynotes.com">Cubby Notes</a>: An application used by Daycares to keep in touch with parents. I designed and created the web application.<br />
        <a href="http://nannyshifts.com">Nanny Shifts</a>: A native mobile application that helps nannies track their hours. I created the website and the mobile app, which will be launching soon.<br />
        <a href="https://shads.com">Shads Advertising</a>: This is a custom site built for a promotional products vendor, including custom integration with Authorize.net for accepting invoice payments.<br />
        <a href="https://smittyscinema.com">Smittys Cinema</a>: I built the website as well as a CMS system for staff to manage all content including integrating a movie database API to automatically gather movie information by a single ID.<br />
        <a href="https://www.berklee.edu/academics/programs?return_title=Berklee%20Homepage&return_url=http://www.berklee.edu/&filter=210511,210531,210586">Berklee College of Music</a>: I created a filtering mechanism for their programs site. It dynamically filters programs based on your selected criteria.<br />
        <a href="https://nimbit.com">Nimbit</a>: An application that helps musicians manage their careers. I created the website and the front end of the web application.<br />
        <a href="https://my.presonus.com">MyPreSonus</a>: I created the user portal for all user's of PreSonus Audio software and hardware.<br />

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