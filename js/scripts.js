jQuery(document).ready(function ($) {
    
    $(document).foundation(); // Initialize Foundation
    /*Turn input[type=submit] into button */
    $('input[type=submit]').addClass('button small');
    
    /* WOW effect with ScrollReveal */
    window.sr = ScrollReveal();
    /*
    sr.reveal('.top-bar li', {
        duration: 1000
    }, 50);
    */
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
        , backDelay: 10*1000
        , typeSpeed: 0.2
        , backSpeed: 0.5
    });
    
    /* Equalizer */
    $(window).resize(function () {
        equalheight('.post-list .post-item .post-item-caption');
    });
    $(window).load(function () {
        equalheight('.post-list .post-item .post-item-caption');
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
     * Thanks to CSS Tricks for pointing out this bit of jQuery
     * http://css-tricks.com/equal-height-blocks-in-rows/
     * 's been modified into a function called at page load and then each time the page 
     * is resized. One large modification was to remove the set height before each new 
     * calculation. 
     */

    function equalheight(container){

    var currentTallest = 0,
         currentRowStart = 0,
         rowDivs = new Array(),
         $el,
         topPosition = 0;
     $(container).each(function() {

       $el = $(this);
       $($el).height('auto')
       topPostion = $el.position().top;

       if (currentRowStart != topPostion) {
         for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
           rowDivs[currentDiv].height(currentTallest);
         }
         rowDivs.length = 0; // empty the array
         currentRowStart = topPostion;
         currentTallest = $el.height();
         rowDivs.push($el);
       } else {
         rowDivs.push($el);
         currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
      }
       for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
         rowDivs[currentDiv].height(currentTallest);
       }
     });
    }
});