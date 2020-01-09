<?php if(!empty($videoData)){ ?>
<div class="container">

  <?php foreach($videoData as  $key => $value){?>
          <div class="videoHidden">
            <div style="display:none;" id="video<?php echo $key+1;?>">
                <video class="lg-video-object lg-html5" controls preload="none">
                    <source src="<?php echo base_url().TRAINING_VIDEO.$value->trainingVideo;?>" type="video/mp4">
                </video>
            </div>
          </div>
        <?php }?>

          <div class="videoList" id="allVideos1">
            <div class="row">
              <?php foreach($videoData as  $key => $value){?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="videoBlock video-blck-box">
                        <div class="videoThumb videoResize-md cstm-vedio-thumb blog-pic-wrap">
                            <a href="" data-poster="<?php echo base_url().TRAINING_VIDEO_THUMB.$value->videoThumb;?>" data-sub-html="<?php echo $value->title;?>" data-html="#video<?php echo $key+1;?>">
                              <img class="" src="<?php echo base_url().TRAINING_VIDEO_THUMB.$value->videoThumb;?>"> 
                              <div class="videoPlay cstm-vedio-block vedio-play-icon">
                                  <span class="fa fa-play"></span>
                              </div>                             
                            </a>
                        </div>
                        <div class="absolute-gradient"></div>                        
                        <div class="video-content">
                            <h3><?php echo $value->title;?></h3>
                        </div>
                    </div>
                </div>  
                <?php }?>            
            </div>
           
          </div>
           <?php echo $pagination;?> 
      </div>
<?php  }else{?>
  <center>No training Videos Found</center>
  <?php }?>
  
    <script type="text/javascript">
    $('#allVideos1').lightGallery({
      selector : ".videoThumb a",
      thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
}); 
</script>