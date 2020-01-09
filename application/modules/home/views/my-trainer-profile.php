<div class="wrapper">
<section class="profileSec sec-pad-50">
   <div class="container">
    <div class="profileBlock trainerPrBlock">
      <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12">
          <div class="prInfo">
            <div class="prImg">
              <img src="<?php if(!empty($trainerDetail->profileImage)){ echo base_url().TRAINER_PROFILE_THUMB.$trainerDetail->profileImage;}else{ echo base_url().DEFAULT_IMAGE; } ?>">
            </div>
            <h2><?php if(!empty($trainerDetail->fullName)){ echo ucwords($trainerDetail->fullName); }else{ echo 'N/A'; } ?></h2>
            <p><?php echo $trainerDetail->email; ?></p> 
          </div>
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12">
          <div class="prCnt">
            <div class="menuTab">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="exercise-tab" data-toggle="tab" href="#exercise" role="tab" aria-controls="exercise" aria-selected="false">Informational Videos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="trainingVideo-tab" data-toggle="tab" href="#trainingVideo" role="tab" aria-controls="trainingVideo" aria-selected="false">Training Videos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="ditePlan-tab" data-toggle="tab" href="#ditePlan" role="tab" aria-controls="ditePlan" aria-selected="false">Recipes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="training-tab" data-toggle="tab" href="#training" role="tab" aria-controls="training" aria-selected="false">Articles</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="forum-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">Forums</a>
                </li>
              </ul>
            </div>
            <div class="menuCnt">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="basicInfo" aria-labelledby="basicInfo-tab">
                  <div class="BasicInfo formField">
                    <div class="infoBlock">
                      <label>Full Name</label>
                      <p><?php if(!empty($trainerDetail->fullName)){ echo ucwords($trainerDetail->fullName); }else{ echo 'N/A'; } ?></p>
                    </div>
                    <div class="infoBlock">
                      <label>Email</label>
                      <p><?php echo $trainerDetail->email; ?></p>
                    </div>
                    <div class="infoBlock">
                      <label>Bio</label>
                      <p><?php echo ucfirst($trainerDetail->details); ?></p>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="exercise" aria-labelledby="exercise-tab">
                  <div class="mt-30">
                    <div id="infoVideoList"> </div>
                    <input type="hidden" name="trainerId" id="trainerId" value="<?php echo $trainerDetail->id; ?>">
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="trainingVideo" aria-labelledby="trainingVideo-tab">
                  <div class="mt-30">
                    <div id="trainingVideoList"> </div>
                    <input type="hidden" name="trainerId" id="trainerId" value="<?php echo $trainerDetail->id; ?>">
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade show" id="ditePlan" aria-labelledby="ditePlan-tab">
                  <div class="mt-30">
                    <div class="dielList">
                      <div class="row mb-30">
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-10 mb-10">
                          <div class="category-des slidr-tag wrapper-slider">
                            <ul class="cat-tag tab-container">
                              <li value="0">All</li> 
                              <?php foreach($recipeCat as $cat){ ?>
                                <li value="<?php echo $cat->id; ?>"><?php echo $cat->categoryName;?></li>
                              <?php } ?>
                            </ul>
                            <span class="prev-slide" style="left: -1360px;">&lt;</span>
                            <span class="next-slide" style="right: 0px;">&gt;</span>
                          </div>
                        </div>
                      </div>
                      <div id="recipeList"></div>
                      <input type="hidden" name="trainerId" id="trainerId" value="<?php echo $trainerDetail->id; ?>">
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="training" aria-labelledby="training-tab">
                  <div class="mt-30">
                    <div id="articleList"> </div>
                    <input type="hidden" name="trainerId" id="trainerId" value="<?php echo $trainerDetail->id; ?>">
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="forum" aria-labelledby="forum-tab">
                  <div class="mt-30">
                    <div id="forumList"></div>
                    <input type="hidden" name="trainerId" id="trainerId" value="<?php echo $trainerDetail->id; ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   </div>
</section>
</div>
<script type="text/javascript">

/*-------------------------------------
      Recipe  Horizontal tab
     -------------------------------------*/
 $('#ditePlan-tab').on('click',function(){
  setTimeout(function(){
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
        sliderWidth = sliderWidth + $(this).outerWidth() + 10;
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
          console.log(newPositionSlideX);
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
  },0);
});
  /*-------------------------------------
        End Recipe Horizontal Tab
     -------------------------------------*/



// Load pagination for article list
var page_url = "<?php echo base_url().'home/trainers/articlePagination/0' ?>";
$(document).ready(function(){

  ajax_fun(page_url); 

  $('#training-tab').on('click',function(){
    ajax_fun(page_url); 
  });

});

function ajax_fun(url){
  var trainerId = $('#trainerId').val();
  toastr.remove();
  $.ajax({
    url: url,
    type: 'post',
    data:{id:trainerId}, 
    dataType: 'json',
    beforeSend: function() {
      show_loader();
    },
    success: function(response){
      if(response.status==-1){
        toastr.error(response.msg);
        window.setTimeout(function () {
          window.location.href = response.url;
        }, 1000); 
      }else if(response.status ==1) {
        $('#articleList').html(response.html);
      } 
    },
    complete: function () {
      
      hide_loader();
    }
  });
} //End

// Load pagination for article list
var url = "<?php echo base_url().'home/trainers/forumPagination/0' ?>";
$(document).ready(function(){

  ajax_fun_forum(url); 

  $('#forum-tab').on('click',function(){
    ajax_fun_forum(url); 
  });

});
function ajax_fun_forum(url){
  var trainerId = $('#trainerId').val();
  toastr.remove();
  $.ajax({
    url: url,
    type: 'post',
    data:{id:trainerId}, 
    dataType: 'json',
    beforeSend: function() {
      show_loader();
    },
    success: function(response){
      if(response.status==-1){
        toastr.error(response.msg);
        window.setTimeout(function () {
          window.location.href = response.url;
        }, 1000); 
      }else if(response.status ==1) {
        $('#forumList').html(response.html);
      } 
    },
    complete: function () {
      
      hide_loader();
    }
  });
} //End

// Load pagination for informational video list
var videourl = "<?php echo base_url().'home/trainers/infovideoPagination/0' ?>";
$(document).ready(function(){

  ajax_fun_infovideo(videourl); 

  $('#exercise-tab').on('click',function(){
    ajax_fun_infovideo(videourl); 
  });

});

function ajax_fun_infovideo(url){
  var trainerId = $('#trainerId').val();
  toastr.remove();
  $.ajax({
    url: url,
    type: 'post',
    data:{id:trainerId}, 
    dataType: 'json',
    beforeSend: function() {
      show_loader();
    },
    success: function(response){
      if(response.status==-1){
        toastr.error(response.msg);
        window.setTimeout(function () {
          window.location.href = response.url;
        }, 1000); 
      }else if(response.status ==1) {
        $('#infoVideoList').html(response.html);
      } 
    },
    complete: function () {
      
      hide_loader();
    }
  });
} //End

// Load pagination for training video list
var videosurl = "<?php echo base_url().'home/trainers/trainingVideoPagination/0' ?>";
$(document).ready(function(){

  ajax_fun_trainingvideo(videosurl); 

  $('#trainingVideo-tab').on('click',function(){
    ajax_fun_trainingvideo(videosurl); 
  });

});

function ajax_fun_trainingvideo(url){
  var trainerId = $('#trainerId').val();
  toastr.remove();
  $.ajax({
    url: url,
    type: 'post',
    data:{id:trainerId}, 
    dataType: 'json',
    beforeSend: function() {
      show_loader();
    },
    success: function(response){
      if(response.status==-1){
        toastr.error(response.msg);
        window.setTimeout(function () {
          window.location.href = response.url;
        }, 1000); 
      }else if(response.status ==1) {
        $('#trainingVideoList').html(response.html);
      } 
    },
    complete: function () {
      
      hide_loader();
    }
  });
} //End

// Load pagination for recipe list
var recipeurl = "<?php echo base_url().'home/trainers/recipePagination/0' ?>";
$(document).ready(function(){
  var selctcat = $('.cat-tag li').val();
  $( ".cat-tag li:first-child" ).addClass('active');
  ajax_fun_recipe(recipeurl,selctcat); 

  $('#ditePlan-tab').on('click',function(){
    $('.cat-tag li').removeClass('active');
    $( ".cat-tag li:first-child" ).addClass('active');
    ajax_fun_recipe(recipeurl,selctcat); 
  });

});

// search recipe
$(".cat-tag li").each(function(i){
  $(this).on('click',function(e){

      e.preventDefault();
      $('.cat-tag li').removeClass('active');
      $(this).addClass('active');
      var selctcat = $(this).val();
      var  recipesurl = "<?php echo base_url().'home/trainers/recipePagination/0' ?>";
      ajax_fun_recipe(recipesurl,selctcat);    
  });
});
function ajax_fun_recipe(url,selctcat){
  var trainerId = $('#trainerId').val();
  var search = selctcat;
  //console.log(search);
  toastr.remove();
  $.ajax({
    url: url,
    type: 'post',
    data:{id:trainerId, search:search}, 
    dataType: 'json',
    beforeSend: function() {
      show_loader();
    },
    success: function(response){
      if(response.status==-1){
        toastr.error(response.msg);
        window.setTimeout(function () {
          window.location.href = response.url;
        }, 1000); 
      }else if(response.status ==1) {
        $('#recipeList').html(response.html);
      } 
    },
    complete: function () {
      
      hide_loader();
    }
  });
} //End
</script>