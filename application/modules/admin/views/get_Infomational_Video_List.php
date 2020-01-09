<?php $backend_asset = base_url().'backend_assets';?>


                                <section class="video-sec sec-pad-50">

                                     <?php if(!empty($videoList)){ ?>
                                                                             
                                     <div class="videoHidden">
                                        <?php $i=1; foreach($videoList as $value1){ ?>
                                        <div style="display:none;" id="video<?php echo $i;?>">
                                            <video class="lg-video-object lg-html5" controls preload="none">
                                                <source src="<?php echo base_url().INFORMATIONAL_VIDEO.$value1->informationalVideo?>" type="video/mp4">
                                            </video>
                                        </div>
                                        <?php $i++; } ?>
                                    </div> 
                                    <div class="videoList" id="allVideos1">
                                        <div class="row">
                                     
                                            <?php $j=1; foreach($videoList as $value){
                                               
                                             ?>

                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="videoBlock video-blck-box">
                                                    <div class="videoThumb videoResize-md cstm-vedio-thumb blog-pic-wrap">
                                                      
                                                        <a data-poster="<?php echo base_url().INFORMATIONAL_VIDEO_THUMB.$value->videoThumb;?>" data-sub-html="<?php echo $value->title;?>" data-html="#video<?php echo $j;?>">
                                                            <?php if(!empty($value->videoThumb)){?>
                                                            <img class="" src="<?php echo base_url().INFORMATIONAL_VIDEO_THUMB.$value->videoThumb;?>">
                                                        <?php }else{?>
                                                            <img class="" src="<?php echo base_url().DEFAULT_VIDEO_IMAGE;?>">
                                                        <?php }?>
                                                            <div class="videoPlay cstm-vedio-block vedio-play-icon">
                                                                <span class="fa fa-play"></span>
                                                            </div>                              
                                                        </a>
                                                   
                                                    </div>
                                                    <div class="dlte-edit-block heading-elements heding-elmnt-top">
                                                        <ul class="list-inline mb-0">
                                                            <li>
                                                              <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){?>    
                                                            <a data-action="javascript:void(0)">          
                                                    <i class="ft-trash-2" onclick="deleteVideo('<?php echo $value->id; ?>','<?php echo get_csrf_token()['hash'];?>','video/deleteinfoVideo');"></i>
                                                                </a>
                                                            <?php }else{?>
                                                                 <a data-action="javascript:void(0)">          
                                                    <i class="ft-trash-2" onclick="deleteVideoByTrainer('<?php echo $value->id; ?>','<?php echo get_csrf_token()['hash'];?>','video/deleteinfoVideoByTrainer');"></i>
                                                                </a>
                                                            <?php }?>
                                                            </li>
                                                            <li>
                                                                 <a data-action="" href="<?php echo base_url()?>admin/video/addVideo/<?php echo encoding($value->id);?>" style="color:#ffffff;">
                                                                 
                                                                    <i class="ft-edit-2"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>                                                    
                                                    <div class="absolute-gradient"></div>
                                                    <div class="video-content">
                                                         <?php if($value->isDelete=='1'){?><h3> <?php echo'(Deleted By Trainer)';?></h3><?php }?>

                                                        <h3><?php echo $value->title;?>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                           <?php $j++; }  ?>
                                    </div>
                                     <?php }else{ ?>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                         <div class="card mrgn-tp-crd p-30">
                                            <div class="card-content text-center">                           
                                            <div id="records">No Records Found</div> 
                                        </div>
                                    </div>
                                     </div>
                                <?php }?>
                                </section>
                                   
                            <?php echo $pagination; ?>
                                  


    
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
