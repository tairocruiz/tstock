

$(function () {

    // ----------------------------- the home slider

    var currentSlide = $('.slide:first-child').addClass('active').css({'z-index':3}), nextSlide;

    function rotateSlides(nextSlide) {

        nextSlide = currentSlide.next().addClass('active').css({'z-index':2,'display':'block'});
        if (nextSlide.length === 0) {
            nextSlide = $('.slide:first-child').addClass('active').css({'z-index':2,'display':'block'});
        }

        currentSlide.fadeOut(function () {
            $(this).removeClass('active');
            currentSlide = nextSlide.css({'z-index':3});
        });
    }

    setInterval(rotateSlides, 6000);

    // ----------------------------- for all sizes

    function homeAccordion() {
        var homeAccordion = $('.home-accordion'), homeAccordionList = homeAccordion.find('ul li');
        homeAccordion.find('ul li:first-child').addClass('active').find('p').show();
        homeAccordionList.find('h4').on('click', function () {
            homeAccordion.find('ul li.active').toggleClass('active').find('p').slideToggle();
            $(this).parent().toggleClass('active').find('p').slideToggle();
        })
    }

    // ----------------------------- for desktops & mobiles too

    function resizeTopMainMargin()
    {
        var mainContainer = $('.main');
        getImageSize($('.header_img_container img'), function(width, height){
            mainContainer.css({'margin-top':height+'px'}).delay(500).fadeIn();
        });
    }

    // ----------------------------- for desktops

    function animateNav()
    {
        $(window).on('scroll', function () {
            var theScrollValue = $(window).scrollTop(), nav = $('nav'),
                mainContents = $('.main'), mobileMenuOpen = $('.mobile-menu-open'), slideDetails = $('.slide-details');
            if (theScrollValue) {
                nav.addClass('scrolled');
                mainContents.addClass('main_raised');
                $('.header_top_overlay').fadeOut('slow');
                slideDetails.fadeIn().css({'top':(180-(theScrollValue/3))+'px'});
            }
            else {
                nav.removeClass('scrolled');
                mainContents.removeClass('main_raised');
                $('.header_top_overlay').fadeIn('slow');
                slideDetails.fadeOut();
            }
        })
    }

    function showDropDownMenu()
    {
        var mainNav = $('nav ul.center');
        mainNav.find('li').on('mouseover', function () {
            $(this).find('ul.dropdown').slideDown(150);
        });
        mainNav.find('li').on('mouseleave', function () {
            $(this).find('ul.dropdown').delay(10).slideUp(150)
        })
    }

    //------------------------------ for mobiles

    function mobileMenuShowHide() {
        $('.mobile-menu-open').on('click', function (e) {
            e.preventDefault();
            $('ul.center').css({'right':'0'}); $(this).fadeOut();
            $('.mobile-logo').fadeOut(100);
        });
        $('.mobile-menu-close').on('click', function (e) {
            e.preventDefault();
            $('ul.center').css({'right':'-300px'}); $('.mobile-menu-open, .mobile-logo').delay(300).fadeIn();
        });
    }
    function mobileMenuSubmenusDropdown() {
        $('nav ul.center > li > a').on('click', function (e) {
            if ($(this).siblings('ul.dropdown').length > 0) {
                $(this).parent().toggleClass('active');
                e.preventDefault();
                $(this).siblings('ul.dropdown').slideToggle();
            }
        });
    }
    function animateMobileNav()
    {
        $(window).on('scroll', function () {
            var theScrollValue = $(window).scrollTop(), mainContents = $('.main'), mobileMenuOpen = $('.mobile-menu-open');
            if (theScrollValue) {
                mobileMenuOpen.css({'background':'rgba(0,0,0,.5)'});
                mobileMenuOpen.find('.word-menu').hide('slow');
                mainContents.addClass('main_raised');
            }
            else {
                mobileMenuOpen.css({'background':'transparent'});
                mobileMenuOpen.find('.word-menu').show('slow');
                mainContents.removeClass('main_raised');
            }
        })
    }

    // only load the functions for screen over 768px
    if ($('.nav').width() > 768) {
        showDropDownMenu();
        animateNav();
    } else {
        mobileMenuSubmenusDropdown();
        mobileMenuShowHide();
        animateMobileNav();
    }

    homeAccordion();
    resizeTopMainMargin();


    // getting image size before loading

    function getImageSize(img, callback){
        img = $(img);

        var wait = setInterval(function(){
            var w = img.width(),
                h = img.height();

            if(w && h){
                done(w, h);
            }
        }, 0);

        var onLoad;
        img.on('load', onLoad = function(){
            done(img.width(), img.height());
        });


        var isDone = false;
        function done(){
            if(isDone){
                return;
            }
            isDone = true;

            clearInterval(wait);
            img.off('load', onLoad);

            callback.apply(this, arguments);
        }
    }

    // scroll to top
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 400) {
            $('#scroll-to-top').css({'opacity':1})
        } else {
            $('#scroll-to-top').css({'opacity':0})
        }
    });

    $('#scroll-to-top').on('click', function () {
        window.scroll({
            top: 0,
            behavior: "smooth"
        })
    });

});