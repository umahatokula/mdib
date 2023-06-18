/*-----------------------------------------------------------
* Template Name    : Andrea - Creative Portfolio Template
* Author           : gtomdesign
* Version          : 1.0
* Created          : May 2020
* File Description : Main Js file of the template
*------------------------------------------------------------
*/

! function($) {
    "use strict";

    /* ---------------------------------------------- /*
    * Preloader
    /* ---------------------------------------------- */

    $(window).on('load', function() {
        $('#preloader').addClass("loaded");
    });

    /* ---------------------------------------------- /*
    * Section Scroll - Navbar
    /* ---------------------------------------------- */
    

    $('.navbar-toggler').on('click', function(){
        $("body").toggleClass('aside-open');
        $(".ham").toggleClass('active');
        $("body, html").toggleClass('overflow-hidden');
    });

    /* ---------------------------------------------- /*
    * Scroll Spy - init
    /* ---------------------------------------------- */

    $("#navbarCollapse").scrollspy({
        offset:20
    });

    /* ---------------------------------------------- /*
    * Swipper - Init
    /* ---------------------------------------------- */

    // Testimony init

    var swipertest = new Swiper('.swiper-testimony', {
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    /* ---------------------------------------------- /*
    * Initialize shuffle plugin
    /* ---------------------------------------------- */

    var $portfolioContainer = $('.list-items-container');

    $('#filter li').on('click', function (e) {
        e.preventDefault();

        $('#filter li').removeClass('active');
        $(this).addClass('active');

        var group = $(this).attr('data-group');
        var groupName = $(this).attr('data-group');

        $portfolioContainer.shuffle('shuffle', groupName );
    });

    
    /* ---------------------------------------------- /*
    * Parallax - Init
    /* ---------------------------------------------- */

    $(".js-height-full").height($(window).height());

    $(window).resize(function(){
        $(".js-height-full").height($(window).height());
    });

}(window.jQuery);

