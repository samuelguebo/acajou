jQuery(document).ready(function ($) {

    $(document).foundation(); // Initialize Foundation
    /*Turn input[type=submit] into button */
    $('input[type=submit]').addClass('button small');

    /* Wow effect with ScrollReveal */
    window.sr = ScrollReveal();

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


    /* Back to Top */
    if ($("#back-to-top").length) {
        const scrollTrigger = 700, // px
            backToTop = function () {
                const scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').fadeIn(800); //show
                } else {
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

})

jQuery.htmlPrefilter = function( html ) {
	return html;
};
