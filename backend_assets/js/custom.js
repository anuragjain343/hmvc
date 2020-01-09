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
})
$('#allVideos1').lightGallery({
  selector : ".videoThumb a",
  thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
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
//recepie slider
var element = $('.tab-container li');
var slider = $('.tab-container');
var sliderWrapper = $('.wrapper-slider');
var totalWidth = sliderWrapper.innerWidth();
var elementWidth = element.outerWidth();
var sliderWidth = 0;
var positionSlideX = slider.position().left;
var newPositionSlideX = 0;

sliderWrapper.append('<span class="prev-slide"><</span><span class="next-slide">></span>');

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

function check() {;
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

 $('#Basic-tab').click();

//add input fields 
$(document).ready(function() {
  $(".delete").hide();
  $("#add").click(function(e) {
    $(".delete").fadeIn("1500");
    $("#items").append(
      '<div class="next-referral col-4"><input id="textinput" name="textinput" type="text" placeholder="Enter name of referral" class="form-control input-md"></div>'
    );
  });
  $("body").on("click", ".delete", function(e) {
    $(".next-referral").last().remove();
  });
});

