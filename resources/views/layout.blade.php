
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @yield('meta_description')
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>@yield('title')</title>

        <link href='//fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

        <link rel="stylesheet" href="/css/dc.css">

    </head>

    <body>

        <nav class="navbar navbar-expand-md fixed-top not-floating @yield('navClass')">
            
            <a class="navbar-brand" href="/">
                <span class="title white">DAVE COFFIN</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item  @yield('homeActive')">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @yield('musicActive')">
                        <a class="nav-link" href="/music">Music</a>
                    </li>
                    <li class="nav-item @yield('codeActive')">
                        <a class="nav-link" href="/code">Code</a>
                    </li>
                    <li class="nav-item @yield('blogActive')">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li>
                    <li class="nav-item @yield('contactActive')">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div style="background-color: white;">
            @yield('content')
        </div>
        

        
        <footer>
            <div class="container">
                <div class="footer-header row">
                    <div class="col-md-2 text-center text-md-left pb-4 pb-md-0">
                        <span class="title">DAVE COFFIN</span>
                    </div>
                    <div class="col-md-10 text-md-right text-center">
                        <span>207-576-2034 &bull; <a href="mailto:dave@davecoffin.com">dave@davecoffin.com</a></span>
                    </div>    
                </div>
                <div class="footer-content row">
                    <div class="about col-md-6 text-center text-md-left">
                        <span>ABOUT ME</span>
                        <p class="pr-md-5">I am a native mobile app developer, full stack web developer, a musician, and a husband/dad.</p>
                        <p>I am also proud to be a <a href="https://developer-experts-hub.firebaseapp.com/">TELERIK DEVELOPER EXPERT</a>.</p>
                    </div>
                    <div class="links col-md-3">
                        <ul class="text-center text-md-left">
                            <li><a href="/">HOME</a></li>
                            <li><a href="/music">MUSIC</a></li>
                            <li><a href="/code">CODE</a></li>
                            <li><a href="/blog">BLOG</a></li>
                            <li><a href="/contact">CONTACT</a></li>
                        </ul>
                    </div>
                    <div class="links col-md-3">
                        <ul class="text-center text-md-left">
                            <li><a href="https://twitter.com/davecoffin">TWITTER</a></li>
                            <li><a href="https://www.facebook.com/davecoffinmusic/">FACEBOOK</a></li>
                            <li><a href="https://www.instagram.com/davecoffin/">INSTAGRAM</a></li>
                            <li><a href="https://www.linkedin.com/in/davecoffin/">LINKED IN</a></li>
                            <li class="copyright">&copy; 2017 Dave Coffin</li>
                        </ul>
                    </div>
                </div>
            </div> <!-- /container -->
        </footer>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        {{--  <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>  --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="/js/dc.js"></script>
    </body>
</html>
