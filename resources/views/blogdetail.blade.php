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
    <div class="blog_details">
        @include('blogs.'.$blog_id)
    </div>
    <br /><br />
    <hr />
    <br /><br />
    <div id="comments">
        <div id="disqus_thread"></div>
        <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        
        var disqus_config = function () {
        this.page.url = 'http://davecoffin.com/blog/<?=$blog_id?>';  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = '<?=$blog_id?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://dave-coffin.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <br /><br /><br />                   
    </div>
</div>

@endsection