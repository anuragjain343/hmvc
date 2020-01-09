                        
                              <?php if(!empty($trainingVideo)){ ?>
                                                     <?php foreach ($trainingVideo as $key => $value){?>
                                                    <div class="videoHidden">
                                                        <div style="display:none;" id="video1<?php echo$key;?>">
                                                            <video class="lg-video-object lg-html5" controls preload="none">
                                                        <source src="<?php echo base_url().TRAINING_VIDEO.$value->trainingVideo?>">
                                                            </video>
                                                        </div>
                                                     
                                                    </div>
                                                     <?php }?>
                                                    <div class="videoList" id="allVideos">

                                                    <div class="row">
                                                        <?php foreach ($trainingVideo as $key => $value) {?>
                                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="videoBlock video-blck-box">
                                                        <div class="videoThumb videoResize-md cstm-vedio-thumb blog-pic-wrap">
                                                                    <a href="" data-poster="<?php echo base_url().TRAINING_VIDEO_THUMB.$value->videoThumb?>" data-sub-html="<?php echo $value->title;?>" data-html="#video1<?php echo$key;?>">
                                                                        <img class="" src="<?php echo base_url().TRAINING_VIDEO_THUMB.$value->videoThumb?>">
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
                                                          <?php }
                                                       ?>         
                                                    </div>
                                                </div>
<?php }else{?>

                                              <div>  No training Videos Found</div>
        <?php }?>

<script type="text/javascript">
$(document).ready(function(){
  $('#allVideos').lightGallery({
    selector : ".videoThumb a",
    thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
  });
});