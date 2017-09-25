$('document').ready(function() {
    if ($(document).scrollTop() > 150 && !$('nav').hasClass('floating')) {
        $('nav').addClass('floating');
        
    }
    $( window ).scroll(function(e) {
        var scrollPos = $(document).scrollTop();
        console.log(scrollPos);
        if (scrollPos > 150) {
            if (!$('nav').hasClass('floating')) {
                $('nav').addClass('floating');
                if (!$('nav').hasClass('lighttop')) {
                    $('nav').addClass('navbar-light');
                    $('nav').removeClass('navbar-dark');
                }
                
            }
        } else {
            if ($('nav').hasClass('floating')) {
                $('nav').removeClass('floating');
                if (!$('nav').hasClass('lighttop')) {
                    $('nav').addClass('navbar-dark');
                    $('nav').removeClass('navbar-light');
                }
                
            }
        }

    });
})