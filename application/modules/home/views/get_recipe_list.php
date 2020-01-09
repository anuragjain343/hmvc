
  <?php $frontend_assets = base_url()."frontend_assets/";?>
<section class="sec-pad-40 upr-heder-sec">
   <div class="shapes-bg-big">
       <div class="container">
            <div class="box_icon">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Recipes</h2>
                        <p>Healthy</p>
                    </div>
                </div>
            </div>
        </div>
   </div>
</section>
<section class="video-sec sec-pad-20 wrapper">
    <div class="container">
        <div class="videoList" id="allVideos">
            <div class="row mb-20">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <h5 class="">Search by category</h5>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 mt-10 mb-10">
                <div class="category-des slidr-tag wrapper-slider">
                  <ul class="cat-tag tab-container">
                    <li class="list" id="resp0" catId="<?php echo '0'; ?>"><?php echo 'All';?></li> 
                    <?php
                        if(!empty($category)){

                        foreach ($category as $k => $cat) {
                            $base_url = base_url();
                             ?>
                            <input type="hidden" id="data" base_url="<?php echo base_url(); ?>">
                            <li class="list" id="resp<?php echo $category[$k]->id; ?>" catId="<?php echo $category[$k]->id; ?>"><?php echo $category[$k]->categoryName;?></li> 

                            <?php  
                            }
                        }
                    ?>
                  </ul>
                    <span class="prev-slide" style="left: -1360px;">&lt;</span>
                    <span class="next-slide" style="right: 0px;">&gt;</span>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        <div class="row">
                    <?php if(!empty($recipeList)){
                        foreach ($recipeList as $k => $recipe) {
                        if(!empty($recipe->image)){
                            //$fileName = 'uploads/profile/thumb/'.$query->profile_image;
                            if(file_exists(RECEPIE_THUMB.$recipe->image)){
                                $fileName = base_url().RECEPIE_THUMB.$recipe->image;
                            }else{
                                $fileName = base_url().DEFAULT_RECEPIE_IMAGE;
                            }
                        }else{
                            $fileName = base_url().DEFAULT_RECEPIE_IMAGE; 
                        }
                    ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="recepie-list transition">
                    <div class="media media-res recepie-media">
                        <img class="mr-3" src="<?php echo $fileName;?>" alt="image">
                        <div class="media-body">
                            <h2 class="mt-0"><?php echo $recipe->title;?></h2>
                            <p class="rec-fix"><?php echo $recipe->description;?></p>
                        </div>
                    </div>
                    <div class="detail-icon">
                        <a href="<?php echo base_url()?>home/recipes/recipeDetail/<?php echo encoding($recipe->recepieId); ?>"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div> 
            <?php }
        }else{?>  
        </div>
        <div id="records">No Records Found</div> 
        <?php }?>       
    </div>
                             <div class="page_link">
                <?php echo $pagination; ?>
               </div>
</section>

<script type="text/javascript">
$(document).ready(function(){
    
    $('.list').on('click',function(){
            $(this).removeClass('active');
            $(this).addClass('active');
        var id = $(this).attr('catId');
        var base_url = $('#data').attr('base_url');
        $.ajax({
            url: base_url + 'home/recipes/recipe_List',

            type: 'GET',
            data: {'id': id},
            beforeSend: function () {
            show_loader()
            },
            success: function (data) {
            hide_loader(); 
            var allData=jQuery.parseJSON(data);
            $("#hash").attr('data-value',allData.hash);
            $("#rList").html(allData.data); 
             $("#cat_id").val(allData.categoryId);

            $('#resp'+allData.categoryId).addClass('active');

            }
        });
    });
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
</script>
<!-- <style type="text/css">
    .pagination{
            position: relative;
    bottom: 25px;
    }
    .row{
            position: relative;
    bottom: 31px;
    }
</style> -->