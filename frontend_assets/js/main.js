(function($) {
    "use strict";
    $(".preloader").hide();
    /* No Need to show preloader on page load everytime
    $(window).on('load', function(){
        // PRELOADER
        $(".preloader").fadeOut(500);
    });*/



/* smooth-scrolling */
// $(function() {
// $('a[href*="#"]:not([href="#"])').on('click',function() {
//   if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
//     var target = $(this.hash);
//     target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
//     if (target.length) {
//     if($(window).width() > 1169){
//         $('html, body').animate({
//           scrollTop: target.offset().top - 72
//         }, 1000);
//         return false;
//     } else {
//       $('html, body').delay(200).animate({
//           scrollTop: target.offset().top - 72
//         }, 1000);
//         return false;
//     }
//     }
//   }
// });
// });

/*-------------------------------------
   Home page Slider 
-------------------------------------*/
var owl = $('#home-slider');
owl.owlCarousel({
  loop:true,
  margin:0,
  items:1,
  autoplay:true,
  navSpeed: 2000,
  smartSpeed: 1500, 
  autoplayHoverPause: true,
  dots: false,
  nav:true,
  navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
});
// add animate.css class(es) to the elements to be animated
function setAnimation ( _elem, _InOut ) {
// Store all animationend event name in a string.
// cf animate.css documentation
var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

_elem.each ( function () {
  var $elem = $(this);
  var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );
  $elem.addClass($animationType).one(animationEndEvent, function () {
    $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
  });
});
}

// Fired before current slide change
owl.on('change.owl.carousel', function(event) {
  var $currentItem = $('.owl-item', owl).eq(event.item.index);
  var $elemsToanim = $currentItem.find("[data-animation-out]");
  setAnimation ($elemsToanim, 'out');
});


// Fired after current slide has been changed
owl.on('changed.owl.carousel', function(event) {
  var $currentItem = $('.owl-item', owl).eq(event.item.index);
  var $elemsToanim = $currentItem.find("[data-animation-in]");
  setAnimation ($elemsToanim, 'in');
});

$(".mobileSubmenu").click(function () {
  $(this).toggleClass("Menuopen");
  $(this).parent().find(".dropdown-menu").slideToggle("slow");
});

$(document).ready(function () {
  $('.navbar-toggler').on('click', function () {
    $('.animated-icon3').toggleClass('open');
  });
});

// $('#loginModal').on('hidden.bs.modal', function() {
//     $('#rigsterModal').on('shown.bs.modal', function() {
//         $('body').addClass('modal-open');
//     });
//     $('#forgotpwdModal').on('shown.bs.modal', function() {
//         $('body').addClass('modal-open');
//     });
// });

$('.modal').on('hidden.bs.modal', function () {
    if($(".modal:visible").length > 0) {
        $('body').addClass('modal-open');
        $('body').css({"padding-right": "17px"});
    }else{
      $('body').removeClass('modal-open');
      $('body').css({"padding-right": "0"});
    }
});


// function getScrollbarWidth() {
//   return window.innerWidth - document.documentElement.clientWidth;
// }
// console.log(getScrollbarWidth());
// $('.modal').on('shown.bs.modal', function (e) {
//     $(".Header .navbar").css("margin-right","17px");
// });
// $('.modal').on('hidden.bs.modal', function (e) {
//     $(".Header .navbar").css("margin-right","0");
// });
// $(".selectOption .radio input").on('click', function(){
//      // $(this).find().parent("trainerBlock").toggleClass("selected");
//      $(this).closest(".trainerBlock").toggleClass('selected', this.checked);
// });
$('#videoSlide').owlCarousel({
    loop:true,
    margin:10,
    dots: false,
    nav:true,
    autoplay:true,
    navSpeed: 2000,
    smartSpeed: 1500,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        992:{
            items:2
        }
    }
});
$('#videoSlide2').owlCarousel({
    loop:true,
    margin:10,
    dots: false,
    nav:true,
    autoplay:true,
    navSpeed: 2000,
    smartSpeed: 1500,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        992:{
            items:1
        }
    }
});
$('#videoSlide3,#videoSlide4,#videoSlide5,#videoSlide6,#videoSlide7').owlCarousel({
    loop:true,
    margin:10,
    dots: false,
    nav:true,
    autoplay:true,
    navSpeed: 2000,
    smartSpeed: 1500,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        992:{
            items:3
        }
    }
});
$('#imgSlide,#imgSlide2,#imgSlide3,#imgSlide4,#imgSlide5,#imgSlide6').owlCarousel({
    loop:true,
    margin:10,
    dots: true,
    nav:true,
    autoplay:true,
    navSpeed: 2000,
    smartSpeed: 1500,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        992:{
            items:1
        }
    }
});

$('#slideInfo').owlCarousel({
    loop:true,
    margin:10,
    dots: false,
    nav:true,
    autoplay:true,
    navSpeed: 2000,
    smartSpeed: 1500,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        992:{
            items:1
        }
    }
});

$('#outer-carousel').owlCarousel({
    loop:true,
    margin:10,
    dots: false,
    nav:true,
    autoplay:true,
    mouseDrag: false,
    navSpeed: 2000,
    autoplayHoverPause: true,
    smartSpeed: 1500,
    navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        992:{
            items:1
        }
    }
});

//var innerCarousel = $('.inner-carousel,.inner-carousel2');
// $('.inner-carousel,.inner-carousel2').owlCarousel({
//     loop: true,
//     center: true,
//     items: 1,
//     nav: true,
//     dots: false,
//     mouseDrag: false,
//     autoplayHoverPause: true,
//     touchDrag: false,
//     navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
//     pullDrag: false
// });

//var innerCarousel = $('.inner-carousel-list');
// $('.inner-carousel-list').owlCarousel({
//     loop: true,
//     center: true,
//     items: 3,
//     nav: true,
//     dots: false,
//     mouseDrag: false,
//     autoplayHoverPause: true,
//     touchDrag: false,
//     navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
//     pullDrag: false
// });


$(document).ready(function () {
    $('.selectOption .radio input').click(function () {
        $('input:not(:checked)').closest(".trainerBlock").removeClass("selected");
        $('input:checked').closest(".trainerBlock").addClass("selected");
    });
    $('input:checked').closest(".trainerBlock").addClass("selected");
});


$('#allVideos').lightGallery({
  selector : ".dataValue",
  thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    items:5,
    zoom:false,
    download:false
});

$('#allVideos1').lightGallery({
  selector : ".videoThumb a",
  thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
});
$('#allVideos2').lightGallery({
  selector : ".videoThumb a",
  thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
});

$(document).ready(function(){
 $('#searchInput').keyup(function(){
 
  // Search text
  var text = $(this).val();
 
  // Hide all content class element
  $('.frlistItem').hide();

  // Search and show
  $('.frlistItem:contains("'+text+'")').show();
 
 });
});


$('article').readmore({
  speed: 150,
  collapsedHeight: 50,
  moreLink: '<a href="#" class="readBtn">Read More</a>',
  lessLink: '<a href="#" class="readBtn">Less</a>'

});

  /*-------------------------------------
        Horizontal tab
     -------------------------------------*/

 var element = $('.cat-tag li');
    var slider = $('.cat-tag');
    var sliderWrapper = $('.category-des');
    var totalWidth = sliderWrapper.innerWidth();
    var elementWidth = element.outerWidth();
    var sliderWidth = 0;
    var positionSlideX = slider.position().left;
    var newPositionSlideX = 0;

    sliderWrapper.append('<span class="prev-slide"><i class="fas fa-arrow-left"></i></span><span class="next-slide"><i class="fas fa-arrow-right"></i></span>');

    element.each(function(){
      sliderWidth = sliderWidth + $(this).outerWidth() + 1;
    });

    slider.css({
      'width': sliderWidth
    });

    $('.next-slide').click(function(){
      if(newPositionSlideX>(totalWidth-sliderWidth)){
        newPositionSlideX = newPositionSlideX - elementWidth;
        slider.css({
          'left' : newPositionSlideX
       }, check());
      };
    });

    $('.prev-slide').click(function(){
      if(newPositionSlideX>=-sliderWidth){
        newPositionSlideX = newPositionSlideX + elementWidth;
        slider.css({
          'left' : newPositionSlideX
       }, check());
      };
    });

    function check() {
      if( sliderWidth >= totalWidth && newPositionSlideX > (totalWidth-sliderWidth)){
         $('.next-slide').css({
          'right' : 0
        });
      } else {
         $('.next-slide').css({
          'right' : -$(this).width()
        });
      };

      if( newPositionSlideX < 0){
         $('.prev-slide').css({
          'left' : 0
        });
      } else {
        $('.prev-slide').css({
          'left' : -$(this).width()
        });
      };
    };

    $(window).resize(function(){
      totalWidth = sliderWrapper.innerWidth();
      check();
    });
    check();

  /*-------------------------------------
        End Horizontal Tab
     -------------------------------------*/

 $('#basicInfo-tab').click();
})(jQuery);


//light gallery product list
$('#imgSlide,#imgSlide2,#imgSlide3,#imgSlide4,#imgSlide5,#imgSlide6').lightGallery({
  selector: '.product-slider .item a.pic',
  loop:true,
  zoom:false,
  fullScreen:false,
  share:false,
  download:false,
  autoplayControls:false
});