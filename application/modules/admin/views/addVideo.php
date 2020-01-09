

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Add Video</h4>
                            <!-- <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">
                                
                            </div> -->
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form" id="postVideo" action="<?php echo base_url();?>admin/video/add_Video" method="POST" autocomplete="off">
                                    <div class="form-body">
                                        <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                        <div class="row">                                       
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput1">Title</label>
                                                <input type="text" id="complaintinput1" class="form-control round" placeholder="Title" name="title">
                                            </div>
                                             <fieldset class="form-group round MultiSelect col-12 mb-2">
                                                 <select class="select2 form-control" id="sel" multiple="multiple" id="id_h5_multi" name="levelName[]">
                                                    <optgroup label="Select Level">
                                                      <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){?>
                                                      <option value="1">Level 1</option>
                                                      <option value="2">Level 2</option>
                                                      <option value="3">Level 3</option>
                                                      <option value="4">Level 4</option>
                                                    <?php }else{ 
                                                      ?>
                                                      <?php 
                                                       if($admin->userPlan == '3'){ ?>
                                                         <option value="3"  selected="">Level 3</option>
                                                    <?php  } else if($admin->userPlan=='4'){ ?>
                                                      <option value="4" selected="">Level 4</option>
                                                     <?php  }else{ ?>
                                                      <option value="3"  selected="">Level 3</option>
                                                      <option value="4"  selected="">Level 4</option>
                                                       <?php }?>
                                                      
                                                    <?php } ?>
                                                    </optgroup>
                                                  </select>
                                            </fieldset>
                                            <div class="form-group col-12 mb-2 crd-icon ">
                                                <div class="icon-crd">
                                                    <a href="javascript:void(0);" id="close" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo" controls=""><source  id="video_here"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img">
                                                  <label for="edit-img">
                                            <input class="form-control" name="informationalVideo"  id="edit-img" style="display: none;" type="file" accept="video/mp4"> 
                                                    <div class="crd-icon diet_title">   
                                                      <h4>Upload Video</h4>                 
                                                      <i class="ft-upload-cloud"></i>
                                                    </div>
                                                  </label> 
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions border-0 frm-btns mt-0">
                                        <a href="<?php echo base_url()?>admin/video"  class="btn btn-danger mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <a class="btn btn-primary" id="post_Video">
                                            <i class="la la-check-square-o"></i> Add
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
 
 $("#edit-img").change(function(){
   priview_video(this);
   
});

function priview_video(input){
    if (input.files) {
    var filesAmount = input.files.length;
    var fileType = input.files[0]['type'];
    var fileSize = input.files[0]['size'];
    //alert(fileSize); 
    if(fileSize <= 10000000){
    if(fileType == 'video/mp4' || fileType == 'video/3gp'){
          var $source = $('#video_here');
          $("#showVideo").show();
           $("#close").show();
          $(".upload-imgs").hide();
          $source[0].src = URL.createObjectURL(input.files[0]);
          $source.parent()[0].load();  
          
    }else{
      toastr.error('Please select only MP4 and 3GP video.');
      //$("#add-video").val('');
    }
    }else{
      
        $('#video_here').val('');
        $('#edit-img').val('');// Reset the video input fields
        $('.upload-imgs').show();
        $('#showVideo').hide();
        $('#close').hide();
      toastr.error('Video size should not be greater than 10MB.');

     // $("#add-video").val('');
    }
  }
}

    // Referesh the canvas
    $('#close').click(function(){
       //Reset the selected video name 
       //$('#video_here').html('');
       // $('#showVideo').html('');
        $('#video_here').val('');
        $('#edit-img').val('');// Reset the video input fields
        $('.upload-imgs').show();
        $('#showVideo').hide();
        $('#close').hide();

    });// End


    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });

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
















                       




























