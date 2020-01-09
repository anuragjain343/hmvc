<?php $array = json_decode($banner_content->contentValue);
  $bannerMultiple = $array->banner;
?>

<?php $frontend_assets = base_url()."frontend_assets/";
if(!empty($_SESSION[USER_SESS_KEY]['userId']) AND ($session_user->userPlan=='level3' OR $session_user->userPlan=='level4')){
      // pr($session_user[$key]->assignTrainer);
       if(!empty($banner->bannerImage)){ $link = BANNER_IMAGE.$banner->bannerImage;}else{ $link = BANNER_DEFAULT;  }
       
  ?>
    <div id="rs-slider" class="rs-slider rs-slider1">
      <div id="home-slider" class="owl-carousel owl-theme">
        <div class="item active">
          <img src="<?php echo base_url($link); ?>" alt="Slide1" />
          <div class="slide-content">
            <div class="display-table">
              <div class="display-table-cell">
                <div class="container text-center">
                  <h1 class="slider-title" data-animation-in="fadeInLeft" data-animation-out="animate-out"><span class="next-step primary-color">Step Up Your</span> Fitness Challenge With Us </h1>
                   
                 <!--  <a href="#" class="transfarent-btn mr-30" data-animation-in="lightSpeedIn" data-animation-out="animate-out" >Join With Us</a>  -->
                  
                  <!-- <a href="#" class="primary-btn" data-animation-in="lightSpeedIn" data-animation-out="animate-out">Read More</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php 
}
else{
if(!empty($bannerMultiple)){
  //pr($bannerMultiple);
  
    //pr($value);
  ?>

<div id="rs-slider" class="rs-slider rs-slider1">
      <div id="home-slider" class="owl-carousel owl-theme">
        <?php foreach ($bannerMultiple as $key => $value) {?>
        <div class="item <?php if($key==0){echo 'active';}?>">
          <img src="<?php echo base_url(BANNER_IMAGE.$value->b_image); ?>" alt="Slide1" />
          <div class="slide-content">
            <div class="display-table">
              <div class="display-table-cell">
                <div class="container text-center">
                  <h1 class="slider-title" data-animation-in="fadeInLeft" data-animation-out="animate-out"><span class="next-step primary-color">Step Up Your</span> <?php echo $value->b_title ?> </h1>
                   
                  <!-- <a href="#" class="transfarent-btn mr-30" data-animation-in="lightSpeedIn" data-animation-out="animate-out" >Join With Us</a>  -->
                  
                 <!--  <a href="#" class="primary-btn" data-animation-in="lightSpeedIn" data-animation-out="animate-out">Read More</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  <?php 
}?>

<?php }
  $about = $array->about;
  $trainer = $array->trainer;
?>
  <section id="rs-about" class="about-sec sec-pad-70">
    <div class="container">
      <div class="section-title text-center sec-arrow-dark">
        <h4><?php echo $about->title;?></h4>
        <h2><?php echo $about->subtitle;?></h2>
      </div>
      <div class="row">
        <div class="col-lg-7 col-md-6">
          <div class="about-details">
            <h2><?php echo $about->infotitle;?></h2>
            <p class="paraText"><?php echo $about->infodesc;?></p>
          </div>
        </div>
        <div class="col-lg-5 col-md-6">
          <div class="about-left mmt-40">
            <img src="<?php echo base_url(ABOUT_IMAGE.$about->image); ?>" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="onlne-coachng" class="sec-pad-70">
    <div class="container">
      <div class="section-title text-center sec-arrow-dark">
        <h2><?php echo $trainer->title;?></h2>
      </div>
        <div class="videoBlockHome img-tranr-sec">
          <?php if(!empty($letestTrainer)){
            foreach ($letestTrainer as $key => $value){ ?>
    
            <div class="wdth-blck-prt">
                <div class="videoBlock">
                    <div class="videoThumb ImgeClass">
                      <?php if(!empty($value->profileImage)){ ?>
                        <img src="<?php echo base_url().TRAINER_PROFILE_THUMB.$value->profileImage;?>">
                      <?php }else{?>
                         <img src="<?php echo base_url().DEFAULT_IMAGE;?>">
                      <?php }?>
                    </div>
                    <div class="videoInfo lst-hgt">
                        <h2><a href="<?php echo base_url('home/trainers/trainerProfile/').encoding($value->id); ?>"><?php echo $value->fullName; ?></a></h2>
                    </div>
                </div>
            </div>
           <?php }}?>
          
        </div>
    </div>
  </section>
  <?php $video1 = $array->video1;
  $video2 = $array->video2;
  ?>
  <div class="clearfix"></div>
    <section class="articleSec sec-pad-70">
    <div class="container">
      <div class="articleCnt">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="articleBlock">
              <div class="articleLeft">
                <h2><?php echo $video1->title;?></h2>
                <p><?php echo $video1->desc;?></p>
              </div>
              <div class="articleRight">
                <!-- <a href="" class="btn btn-outline btn-outline-bg-w btn-round mt-20">View More</a> -->
                <a href="javaScript:void(0)" onclick="isRegisterLogin('','<?php echo base_url();?>home/video/informationalVideo')" class="btn btn-outline btn-outline-bg-w btn-round mt-20" >View More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="videoSec sec-pad-70">
    <div class="container">
      <div class="section-title text-center sec-arrow-dark">
        <h4><?php echo $video2->subtitle;?></h4>
        <h2><?php echo $video2->title;?></h2>
      </div>
      <div class="videoBlockHome">
        <div class="row">
          <div class="col-md-12 col-lg-12">
            <div id="videoSlide" class="owl-carousel owl-theme csSlider">
              <div class="item">
                <video controls>
                  <source src="<?php echo $frontend_assets;?>video/video.mp4" type="video/mp4">
                </video>
              </div>
              <div class="item">
                <video controls>
                  <source src="<?php echo $frontend_assets;?>video/video.mp4" type="video/mp4">
                </video>
              </div>
              <div class="item">
                <video controls>
                  <source src="<?php echo $frontend_assets;?>video/video.mp4" type="video/mp4">
                </video>
              </div>
              <div class="item">
                <video controls>
                  <source src="<?php echo $frontend_assets;?>video/video.mp4" type="video/mp4">
                </video>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="forumsSec sec-pad-70 gray-bg">
    <div class="container">
      <div class="section-title text-center sec-arrow-dark">
        <h4>Articles</h4>
        <h2>Articles & Training Logs</h2>
      </div>
      <div class="forumsBlock">
        <div class="row justify-content-md-center">
          <div class="col-md-10 col-lg-10">
            <div class="text-center">
              <form class="find-cand" id="articleSearch" action="<?php echo base_url();?>home/article/articleList" method="POST">
                <div class="job-field">
                  <input placeholder="Search Articles" type="text" name="article" id="srh">
                  <input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >
                </div>
                <button type="submit" id="articleSearch"><i class="fa fa-search"></i></button>
              </form>
            </div>
           <span id="artiList"></span>
          </div>
        </div>
      </div>
    </div>
  </section>

   <script type="text/javascript">
      var data = $("#hash");
    articleList('home/article/articleList');
    function articleList(url)
    { 
      var baseurl        = '<?php base_url();?>'+url;
      var csrf_test_name  = data.attr('data-name');
      var value           = data.attr('data-value');
      var dataObject      = {page:baseurl};
      
  

      $.ajax({
        type:'POST',
        url:baseurl,
        data:dataObject,
        beforeSend: function () { 
             //show_loader(); 
         },              
        success: function(data){ 
           // hide_loader(); 
            var allData=jQuery.parseJSON(data);
           $("#hash").attr('data-value',allData.hash);
            $("#artiList").html(allData.data);
        }
    });
    }

   </script>
   <script type="text/javascript">

               
              
   </script>