<?php if(!empty($result)){ ?>
<div class="videoHidden">
<?php foreach($result as $trainingVideo){ ?>
  <div style="display:none;" id="video<?php echo $trainingVideo['id']; ?>">
      <video class="lg-video-object lg-html5" controls preload="none">
          <source src="<?php echo base_url().TRAINING_VIDEO.$trainingVideo['trainingVideo']; ?>" type="video/mp4">
      </video>
  </div>
<?php } ?>
</div>
<div class="videoList" id="allTrainingVideos">
  <div class="row">
  <?php  foreach($result as $video){ ?>
    <div class="col-xl-3 col-lg-4 col-md-4 col-6">
      <div class="videoBlock">
        <div class="videoThumb videoResize-md cstm-vedio-thumb blog-pic-wrap">
          <a style="cursor: pointer;" data-poster="<?php echo base_url().TRAINING_VIDEO_THUMB.$video['videoThumb']; ?>" data-sub-html="<?php echo $video['title'];?>" data-html="#video<?php echo $video['id']; ?>">
            <img src="<?php echo base_url().TRAINING_VIDEO_THUMB.$video['videoThumb']; ?>">
            <div class="videoPlay">
              <span class="far fa-play-circle"></span>
            </div>
          </a>
        </div>
        <div class="videoInfo">
          <h2 class="wordWrap"><?php echo ucwords($video['title']);?></h2>
        </div>
      </div>
    </div>
  <?php } ?>
  </div>
</div>
<?php }else{ ?>
  <div class="even pointer">
    <center><h2 style="font-size: 20px; color: #757575; margin-top: 80px;">No Video Found</h2></td>
  </div>
<?php } ?>
<!-- Paginate -->
<div class="pgination-block"><?php echo $pagination; ?></div>

<script type="text/javascript">
$(document).ready(function(){
  $('#allTrainingVideos').lightGallery({
    selector : ".videoThumb a",
    thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
  });
});