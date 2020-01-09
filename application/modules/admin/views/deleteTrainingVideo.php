<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Delete Video</h4>
                            <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">   
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form" id="" action="" method="POST">
                                    <div class="form-body">
                                        <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                        <div class="row">                                       
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput1">Title</label>
                                                <input type="text" id="complaintinput1" class="form-control round" placeholder="Title" name="title" value= "<?php echo $videoData->title;?>" readonly>
                                            </div>
                                            <fieldset class="form-group col-12 mb-2">
                                                <select class="custom-select round" id="customSelect" name="levelName"  style="background: white;" disabled>
                                                <option value="" >Select Level</option>

                                                <option <?php if($videoData->videoLevelType=='level1'){  echo "selected"; }?> value="level1">Level 1</option>

                                                <option <?php if($videoData->videoLevelType=='level2'){ echo"selected"; } ?> value="level2">Level 2</option>

                                                <option <?php if($videoData->videoLevelType=='level13'){ echo"selected"; } ?> value="level3">Level 3</option>

                                                <option <?php if($videoData->videoLevelType=='level4'){ echo"selected"; } ?> value="level4">Level 4</option>
                                                </select>
                                            </fieldset>
                                            <div class="form-group col-12 mb-2 crd-icon">
                                            <div class="icon-crd">
                                                    <a href="javascript:void(0);" id="close" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>
                                                </div>
                                                <input type="hidden" name="flag" id="flag">
                                        <input type="hidden" name="hidden" id="hidden" value="<?php echo $videoData->trainingVideo;?>">

                                            <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933);display:none;" id="updateVideo" controls=""><source  id="video_here" src="<?php echo base_url().'uploads/trainingVideo/'.$videoData->trainingVideo;?>"></video>
                                            </div>
                                         <div class="form-group col-12 mb-2">
                                            <div id="vdo" class="upload-imgs pd-img">
                                                <label for="edit-img">
                                                    <input class="form-control" name="trainingVideo" id="edit-img" style="display:none;" type="file"  accept="video/mp4" value="<?php echo $videoData->trainingVideo;?>"> "> 
                                                        <div class="crd-icon diet_title">   
                                                            <h4>Upload Video</h4>                 
                                                            <i class="ft-upload-cloud"></i>
                                                        </div>
                                                </label> 
                                            </div>    
                                            </div>
                                            <input type="hidden" name="vId" value="<?php echo $videoData->id;?>">
                                        </div>
                                    </div>
                                    <div class="form-actions frm-btns mt-0">
                                        <a href="javascript:void(0);"  class="btn btn-danger mr-1" onclick="deleteReject('<?php echo $videoData->id;?>','<?php echo base_url();?>admin/video/deleteTrainingvideoReject')">
                                            <i class="ft-x"></i> Reject
                                        </a>
                                        <a class="btn btn-primary" onclick="deleteVideo('<?php echo $videoData->id;?>','','video/deleteTraVideo');">
                                            <i class="la la-check-square-o"></i> Accept
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<style> .pac-container{ z-index:2000;} </style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuEJjb_-knzxl69RX-8hm4_EuCGaNZ7Ao&libraries=places&callback" async defer></script>
<script type="text/javascript">
    //use only numbers and desimal value 
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
            return false;
        }else{
            return true;
        }
    }
 
 $("#edit-img").change(function() {
   priview_video(this);
   
});

     if($('#hidden').val()!=''){
        $('.upload-imgs').hide();
        $('#updateVideo').show();
        $('#deletevideo').show();
    }else{
        $('#deletevideo').hide();
        $('#showVideo').hide();
    }

//$(".upload-imgs").hide();
//$("#updateVideo").show();

function priview_video(input){
    if (input.files) {
    var filesAmount = input.files.length;
    var fileType = input.files[0]['type'];
    var fileSize = input.files[0]['size'];
    if(fileSize <= 10000000){
    if(fileType == 'video/mp4' || fileType == 'video/3gp'){
          var $source = $('#video_here');
          $("#updateVideo").show();
          $(".upload-imgs").hide();
         $("#close").show();
          
          $source[0].src = URL.createObjectURL(input.files[0]);
          $source.parent()[0].load();  
          
    }else{
      toastr.error('Please select only MP4 and 3GP video.');
      $("#add-video").val('');
    }
    }else{
      toastr.error('Video size should not be greater then 10MB.');
      $("#add-video").val('');
    }
  }
}

    // Referesh the canvas
    $('#close').click(function(){
       //Reset the selected video name 
        $('#video_here').val('');
        $('#edit-img').val('');// Reset the video input fields
        $('.upload-imgs').show();
        $('#updateVideo').hide();
        $('#close').hide();

    });// End


    function flagChange(){
        $('#flag').val(1);
        $('#video_here').show();
        $('#updateVideo').hide();
        $('#deletevideo').hide();
       $('#edit-img').attr('value','');
       $('#video_here').attr('src','');
        $('#vdo').show();
    }

</script>
<style type="text/css">
.vieolimit{
    margin-top: 2px;
    font-size: 15px;
}
.upload-video {
    display: inline-block;
 
}   
label.videoname{
    padding-left: 11px;
}


</style>
