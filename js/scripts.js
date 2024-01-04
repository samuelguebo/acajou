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
    // Slick slider
    slideshow(
            sliderSelector = ".carousel-inner",
            nextSelector = ".carousel-control-next",
            prevSelector = ".carousel-control-prev",
            autoChangeTime = 5000
    );

})



jQuery.htmlPrefilter = function( html ) {
	return html;
};

const toggleHamburgerMenu = () =>  {
    let x = document.querySelector('#main-menu');
    if (!x.classList.contains('responsive')) {
        x.classList.add('responsive');
        // Handle dropdown menus
        toggleDropDownMenus();
    } else {
        x.classList.remove('responsive');
    }
}

const toggleDropDownMenus = () => {

    // Prevent registering event too many times
    if(document.hasToggleDropDownMenus){
        return;
    }

    const submenus = document.querySelectorAll(".responsive .has-dropdown");
    for (let i = 0; i < submenus.length; i++) {

        submenus[i].addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            let child = this.closest('ul').querySelector('.dropdown')
            child.classList.toggle("visible");
            this.classList.toggle("open");
        });
    }

    document.hasToggleDropDownMenus = true;
}
