(function ($) {
	"use strict";

    jQuery(document).ready(function($){
        /*Accordian Management*/
        var toogleAccordian = $(".toggle-accordion")
        toogleAccordian.on("click", function() {
            var accordionId = $(this).attr("accordion-id"),
              numPanelOpen = $(accordionId + ' .collapse.in').length;

            $(this).toggleClass("active");

          })
        $('.video-play-btn').magnificPopup({ type: 'video' });
        /*--project counter activation--*/
          var projectCounter = $('.counter');
          projectCounter.each(function() {
          var $this = $(this),
              countTo = $this.attr('data-count');
          $({ countNum: $this.text()}).animate({
            countNum: countTo
          },
          {
            duration: 5000,
            easing:'linear',
            step: function() {
              $this.text(Math.floor(this.countNum));
            },
            complete: function() {
              $this.text(this.countNum);
            }
              });  
            });
         /*--testimonial carousel slider activation--*/
          var testimonialCaoursel = $('.slider-activation');
          testimonialCaoursel.owlCarousel({
            loop:true,
            dots:true,
            nav:true,
            navText:['<i class="fa fa-caret-left"></i>','<i class="fa fa-caret-right"></i>'],
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive : {
              0 : {
                  items: 1
              },
              768 : {
                  items: 1
              },
              960 : {
                  items: 1
              },
              1200 : {
                  items: 1
              },
              1920 : {
                  items: 1
              }
            }
        });
          /*--product image carousel slider activation--*/
          var productImageCaoursel = $('.product-image-slider');
        productImageCaoursel.owlCarousel({
            loop:true,
            dots:true,
            nav:true,
            navText:['<i class="fa fa-caret-left"></i>','<i class="fa fa-caret-right"></i>'],
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive : {
              0 : {
                  items: 1
              },
              768 : {
                  items: 1
              },
              960 : {
                  items: 1
              },
              1200 : {
                  items: 1
              },
              1920 : {
                  items: 1
              }
            }
        });
          /*--Header carousel slider activation--*/
          var headerCaoursel = $('.head-slider');
          headerCaoursel.owlCarousel({
            loop:true,
            dots:true,
            nav:true,
            navText:['<i class="fa fa-caret-left"></i>','<i class="fa fa-caret-right"></i>'],
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive : {
              0 : {
                  items: 1
              },
              768 : {
                  items: 1
              },
              960 : {
                  items: 1
              },
              1200 : {
                  items: 1
              },
              1920 : {
                  items: 1
              }
            }
        });     
        headerCaoursel.on("translate.owl.carousel", function () {
            $(".single-header h1, .single-header p").removeClass("animated fadeInUp").css("opacity", "0");
            //$(".single-slide-item .slide-btn").removeClass("animated fadeInDown").css("opacity", "0");
        });

        headerCaoursel.on("translated.owl.carousel", function () {
            $(".single-header h1, .single-header p").addClass("animated fadeInUp").css("opacity", "1");
            //$(".single-slide-item .slide-btn").addClass("animated fadeInDown").css("opacity", "1");
        });
        });
        
       /*--slick Nav Responsive Navbar activation--*/
          var SlicMenu = $('#menu-bar');
         SlicMenu.slicknav();
        /*--scroll to top activation--*/
        $(document).on('click', '.scroll-to-top a', function (e) {
            e.preventDefault();
            $("html,body").animate({
                scrollTop: 0
            }, 3000);
            
        });
        
        
       

        /*--window Scroll functions--*/
        $(window).on('scroll', function () {
            /*--show and hide scroll to top --*/
            var ScrollTop = $('.scroll-to-top a');
            if ($(window).scrollTop() > 1000) {
                ScrollTop.css('display','inline-block');
            } else {
                ScrollTop.fadeOut(1000);
            }
            /*--sticky menu activation--*/
            var mainMenuTop = $('.main-menu');
            if ($(window).scrollTop() > 300) {
                mainMenuTop.addClass('nav-fixed');
            } else {
                mainMenuTop.removeClass('nav-fixed');
            }
            /*--sticky menu activation--*/
            var slickNavTop = $('.slicknav_menu');
            var logoFixed = $('.mobile-logo')
            if ($(window).scrollTop() > 300) {
                slickNavTop.addClass('nav-fixed');
                logoFixed.addClass('fixed');
            } else {
                slickNavTop.removeClass('nav-fixed');
                logoFixed.removeClass('fixed');
            }
        });
           
/*--window load functions--*/
    jQuery(window).load(function(){
        var preLoder = $(".preloader");
        preLoder.fadeOut(1000);
    });


}(jQuery));	