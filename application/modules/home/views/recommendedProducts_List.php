
   <?php if(!empty($nutritionGuidanceData)){?>

    <?php  foreach($nutritionGuidanceData as $key => $value) {      
              ?>
    <div class="recipies-details  p-40">
            <div class="container">
                <div class="row">
                                       
                   <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="recipeInfo">                        
                            <div class="prdct-value-info">
                                <div class="prdct-value-name">
                                    <h2><?php echo $value->title;?></h2>
                                </div>
                                <div class="prdct-value-prc">
                                    <p>Posted on <span><?php echo time_elapsed_string($value->crd);?></span></p>
                                </div>
                                
                                <div class="recipesDes">
                                    <p class="paraText"><?php echo $value->description;?></p>
                                </div> 
                                
                               
                                 <?php if(!empty($value->pdf)){?>
                                <a href="<?php echo base_url().RECOMMENDEDPRODUCTS_PDF.$value->pdf;?>"  target="_blank"  class="btn btn-theme btn-bg-t">Download PDF</a>
                            <?php } ?>
                                                     
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

<style type="text/css">
   .ad-gallery .ad-image-wrapper {
    z-index: 1 !important;
}
</style>