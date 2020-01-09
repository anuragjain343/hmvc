   <?php if(!empty($postList)){?>
    <?php  foreach($postList as $key => $value) {
                                $image = json_decode($value->image);
                                $image = array_values(array_filter($image, 'strlen'));
?>
        <div class="recipies-details brdr-btm-clr p-40">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="">
                            <section class="videoSec">
                                <div class="container">
                                    <div class="videoBlockHome product-slider">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div id="imgSlide" class="owl-carousel owl-theme csSlider imgSlider mb-15">
                                               <?php  foreach($image as $key => $value1) {
                                               if(!empty($value1)){ 
                                                ?>
                                                    <div class="item imgSlide">
                                                        <a class="pic" data-src="<?php echo base_url(TRAINING_MEDIUM).$value1;?>"><img src="<?php echo base_url(TRAINING_MEDIUM).$value1;?>" /></a>
                                                    </div>
                                              <?php } }?>
                                              


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                        <?php 
                                $video      = json_decode($value->video);
                                $videoThumb = json_decode($value->videoThumb);
                                 $video = array_values(array_filter($video, 'strlen'));
                                 $videoThumb = array_values(array_filter($videoThumb, 'strlen'));
                         ?>
              
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="recipeInfo">                        
                            <div class="prdct-value-info">
                                <div class="prdct-value-name">
                                    <h2><?php  custom_echo($value->title,20);?></h2>
                                </div>
                                <div class="prdct-value-prc">
                                    <p>Posted on <span><?php echo time_elapsed_string($value->crd);?></span></p>
                                </div>
                                  
                                <div class="recipesDes"  id="show<?php echo $value->id;?>" style="display:none;" style="float:left;">
                                    <span class="paraText"><?php echo $value->description;?></span>
                                    <span id="less<?php echo $value->id;?>"onclick="f2('<?php echo $value->id;?>')" style="color: #43a4dc; cursor: pointer;">...Read less</span>
                                </div>
                                
                                <div class="recipesDes"  id="hide<?php echo $value->id;?>">
                                    <span class="paraText" ><?php custom_echo ($value->description,250);?></span><?php if(strlen($value->description)>250){?>
                                    <span id="more<?php echo $value->id;?>"onclick="f1('<?php echo $value->id;?>')" style="color: #43a4dc; cursor: pointer;">Read more</span>
                            <?php }?>
                                </div>

                                  <?php if(!empty($value->pdf)){?>
                                <a href="<?php echo base_url().TC_PDF.$value->pdf;?>"  target="_blank"  class="btn btn-theme btn-bg-t">Download PDF</a>
                            <?php }?>

                         
                                <section class="video-sec">
                                    <div class="videoHidden">
                                         <?php $i=1; foreach($video as $key => $valuevideo){?>
                                        <div style="display:none;" id="video<?php echo $i;?>">
                                            <?php if(!empty($valuevideo)){?>
                                            <video class="lg-video-object lg-html5" controls preload="none">
                                                <source src="<?php echo base_url().TRAINING_CATEGORY_VIDEO.$valuevideo;?>" type="video/mp4">
                                            </video>
                                        <?php }?>
                                        </div>
                                    <?php $i++;} ?>
                                      
                                      </div>
                                        <div class="videoList allVideos1" id="allVideos1">
                                            <div class="videoBlockHome video-slider-box mt-20">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <div id="videoSlide3" class="owl-carousel owl-theme csSlider">
                                                            <?php $j=1; foreach($videoThumb as $key => $valuevideoT){?>
                                                            <div class="item">
                                                                <div class="videoBlock cstm-vdio-block video-blck-box mb-0 ">
                                                                    <div class="videoThumb videoResize-sm cstm-vedio-thumb blog-pic-wrap">
                                                                        <a href="" data-poster="<?php echo base_url().TRAINING_CATEGORY_THUMB.$valuevideoT;?>" data-sub-html="Full Body Workout In The Gym" data-html="#video<?php echo $j;?>">
                                                                          <img class="" src="<?php echo base_url().TRAINING_CATEGORY_THUMB.$valuevideoT;?>">
                                                                          <div class="videoPlay cstm-vedio-block vedio-play-icon">
                                                                                <span class="fa fa-play"></span>
                                                                            </div>                        
                                                                        </a>
                                                                    </div>
                                                                    <div class="absolute-gradient cst-absolute-grdnt"></div>         
                                                                </div>
                                                            </div>
                                                         <?php $j++; }?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                </section>                          
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
         <?php } ?>
      <?php }else{ ?>
   
                    
                    <center>
                    <h3 style="padding-top: 50px;"> NO RECORD FOUND</h3>
                    </center>
               
        

    <?php }?>
    <script type="text/javascript">
    $('.allVideos1').lightGallery({
      selector : ".videoThumb a",
      thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
}); 
</script>
  <script type="text/javascript">
$('#videoSlide').owlCarousel({
    loop:false,
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
    loop:false,
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
    loop:false,
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
    loop:false,
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

var length = $('#length').val().length;
    if(length < 250){
        $(this).hide();
    }

function f1(key){
    $(this).hide();
    $('#show'+key).show();
    $('#less'+key).show();
    $('#hide'+key).hide();

    
}

function f2(key){
    $(this).hide();
    $('#show'+key).hide();
    $('#more'+key).show();
    $('#hide'+key).show();
}

</script>