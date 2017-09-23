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
                
            }
        } else {
            if ($('nav').hasClass('floating')) {
                $('nav').removeClass('floating');
                
            }
        }

    });
})