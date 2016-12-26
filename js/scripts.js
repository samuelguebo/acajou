jQuery(document).ready(function ($) {
    
    $(document).foundation(); // Initialize Foundation
    /*Turn input[type=submit] into button */
    $('input[type=submit]').addClass('button small');
    
    /* WOW effect with ScrollReveal */
    window.sr = ScrollReveal();
    sr.reveal('.top-bar li', {
        duration: 1000
    }, 50);
    sr.reveal('.reveal', {
        duration: 1000
    }, 200);
    sr.reveal('.category-row .post-item');
    sr.reveal('footer .widget', {
        duration: 1500
    }, 300);
    sr.reveal('aside .widget', {
        duration: 2000
    }, 150);
    
    sr.reveal('form input', {
        duration: 2000
    }, 50);
    
    /* Typed animation text */
    $("#typed").typed({
        // Waits 1000ms after typing "First
        stringsElement: $('.strings')
        , loop: true
        , backDelay: 3000
        , typeSpeed: 0.2
        , backSpeed: 0.5
    });
    
    /* Equalizer */
    $(window).resize(function () {
        equalheight('.post-list .post-item');
    });
    $(window).load(function () {
        equalheight('.post-list .post-item');
    });
    
    /* Back to Top */
    if ($('#back-to-top').length) {
        var scrollTrigger = 700, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').fadeIn(800); //show 
                }
                else {
                    $('#back-to-top').fadeOut(800);
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
    
    /*
     *  Lazy loading for images
     * 
     */
    setTimeout(function () {
       jQuery('.delay').each(function () {
          var imagex = jQuery(this);
          var imgOriginal = imagex.data('src');
            jQuery(imagex).css('padding',0);
            jQuery(imagex).attr('src', imgOriginal);
            jQuery(imagex).removeClass('placeholder'); /*added this*/
       });
    }, 1000);
});