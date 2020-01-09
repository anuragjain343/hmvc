<?php $getId = decoding($getCatId); ?>
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row">
           
            </div>
            <form class="form mt-20 form" id="add_exercise" action="<?php echo base_url()?>admin/Training/add_exercise">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Detail Info Section</h4>
                            <div class="form_ttle_brdr"></div> 
                                <div class="form-body">
                                    <div class="row">                                       
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="title" class="form-control round" placeholder="Enter Title" name="title">
                                        </div>
                                        <div class="form-group col-12 mb-2">
                                            <fieldset class="form-group mb-0">
                                                <select class="custom-select round" id="category_name" name="category_names" disabled="true">
                                                    <option value="" selected="">Select Category</option>
                                                    <?php
                                                    if(!empty($categoryList))
                                                     foreach ($categoryList as $k => $value) { 
                                                        if($getId==$value->id){ ?>
                                                            <option value="<?php echo $value->id;?>" selected ><?php echo $value->CategoryName;?></option>
                                                        <?php }else{
                                                      ?>
                                                    <option value="<?php echo $value->id;?>"><?php echo $value->CategoryName;?></option>
                                                <?php }
                                            }?>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <input type="hidden" name="category_name" value="<?php echo $getId;?>"/>
                                        <div class="form-group col-12 mb-2">
                                            <textarea id="description" rows="5" class="form-control round" name="description" placeholder="Enter Description"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <span id="showpdf1"></span>
                                        </div>
                                        <div class="col-6">
                                            <!-- <span class="tags float-right">
                                                <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right" href="#">
                                                    <span class="white">Upload PDF</span>
                                                    <i class="ft-upload pl-1 white"></i>
                                                </a>
                                            </span> -->
                                            <div class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right">
                                                <label for="edit-pdf" class="mb-0">
                                                    <input class="form-control" id="edit-pdf" style="display: none;" type="file" name="edit-pdf" accept="application/pdf" onchange="getfile(document.getElementById('edit-pdf').value);">
                                                    <div class="crd-icon diet_title">   
                                                        <span class="white">Upload PDF</span>
                                                        <i class="ft-upload pl-1 white"></i>       
                                                    </div>
                                                </label> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                                                         
                        </div>
                    </div>
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Image Slider Section</h4>
                            <div class="form_ttle_brdr"></div> 
                                <div class="form-body">
                                    <div class="row">
                                        <p class="col-12 ttle-baner">Image 1</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img1">
                                                <input class="form-control" id="edit-img1" style="display: none;" type="file" onchange="document.getElementById('preview1').src = window.URL.createObjectURL(this.files[0])" name="edit-img1" accept="image/x-png,image/jpeg">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div> 
                                            <p style="color: gray;font-size: 11px; margin-top: 10px;">Image should be at least 300*300px</p>    
                                        </div>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="" id="preview1" style="display: none;">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross1">
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Image 2</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img2">
                                                <input class="form-control" id="edit-img2" style="display: none;" type="file" onchange="document.getElementById('preview2').src = window.URL.createObjectURL(this.files[0])" name="edit-img2" accept="image/x-png,image/jpeg">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div> 
                                            <p style="color: gray;font-size: 11px; margin-top: 10px;">Image should be at least 300*300px</p>    
                                        </div>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="" id="preview2" style="display: none;">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross2">
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Image 3</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img3">
                                                <input class="form-control" id="edit-img3" style="display: none;" type="file" onchange="document.getElementById('preview3').src = window.URL.createObjectURL(this.files[0])" name="edit-img3" accept="image/x-png,image/jpeg">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div> 
                                            <p style="color: gray;font-size: 11px; margin-top: 10px;">Image should be at least 300*300px</p>    
                                        </div>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="<?php echo base_url() ?>backend_assets/img/slide-image1.png" id="preview3" style="display: none;">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross3">
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Image 4</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img4">
                                                <input class="form-control" id="edit-img4" style="display: none;" type="file" onchange="document.getElementById('preview4').src = window.URL.createObjectURL(this.files[0])" name="edit-img4" accept="image/x-png,image/jpeg">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div>
                                            <p style="color: gray;font-size: 11px; margin-top: 10px;">Image should be at least 300*300px</p>     
                                        </div>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="<?php echo base_url() ?>backend_assets/img/banner1.jpg" id="preview4" style="display: none;">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross4">
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Image 5</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img5">
                                                <input class="form-control" id="edit-img5" style="display: none;" type="file" onchange="document.getElementById('preview5').src = window.URL.createObjectURL(this.files[0])" name="edit-img5" accept="image/x-png,image/jpeg">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div> 
                                            <p style="color: gray;font-size: 11px; margin-top: 10px;">Image should be at least 300*300px</p>    
                                        </div>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="" id="preview5" style="display: none;">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross5">
                                            </div>     
                                        </div>
                                    </div>
                                </div>
                                                                         
                        </div>
                    </div>  
                </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card back-img">
                    <div class="card-body card-header">
                        <h4 class="card-title brdr-btm-grey">Video Slider Section</h4>
                        <div class="form_ttle_brdr"></div> 
                        
                            <div class="form-body">
                                <div class="row">
                                    <p class="col-12 ttle-baner">Video 1</p>
                                          <div class="form-group col-12 mb-2" id="far">
                                                <div class="icon-crd">
                                                    <a href="javascript:void(0);" id="close1" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo1" controls=""><source  id="video_here1"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2" id="near">
                                                <div class="upload-imgs pd-img" id="vid1">
                                                  <label for="edit-video1">
                                            <input class="form-control" name="edit-video1"  id="edit-video1" style="display: none;" type="file" accept="video/mp4"> 
                                                    <div class="crd-icon diet_title">   
                                                      <h4>Upload Video</h4>                 
                                                      <i class="ft-upload-cloud"></i>
                                                    </div>
                                                  </label> 
                                                </div>  
                                       </div>
                                    <p class="col-12 ttle-baner">Video 2</p>
                                      <div class="form-group col-12 mb-2">
                                                <div class="icon-crd">
                                                    <a href="javascript:void(0);" id="close2" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo2" controls=""><source  id="video_here2"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img" id="vid2">
                                                  <label for="edit-video2">
                                            <input class="form-control" name="edit-video2"  id="edit-video2" style="display: none;" type="file" accept="video/mp4"> 
                                                    <div class="crd-icon diet_title">   
                                                      <h4>Upload Video</h4>                 
                                                      <i class="ft-upload-cloud"></i>
                                                    </div>
                                                  </label> 
                                                </div>  
                                       </div>
                                    <p class="col-12 ttle-baner">Video 3</p>
                                      <div class="form-group col-12 mb-2">
                                                <div class="icon-crd">
                                                    <a href="javascript:void(0);" id="close3" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo3" controls=""><source  id="video_here3"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img" id="vid3">
                                                  <label for="edit-video3">
                                            <input class="form-control" name="edit-video3"  id="edit-video3" style="display: none;" type="file" accept="video/mp4"> 
                                                    <div class="crd-icon diet_title">   
                                                      <h4>Upload Video</h4>                 
                                                      <i class="ft-upload-cloud"></i>
                                                    </div>
                                                  </label> 
                                                </div>  
                                       </div>
                                    <p class="col-12 ttle-baner">Video 4</p>
                                     <div class="form-group col-12 mb-2">
                                                <div class="icon-crd">
                                                    <a href="javascript:void(0);" id="close4" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo4" controls=""><source  id="video_here4"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img"id="vid4">
                                                  <label for="edit-video4">
                                            <input class="form-control" name="edit-video4"  id="edit-video4" style="display: none;" type="file" accept="video/mp4"> 
                                                    <div class="crd-icon diet_title">   
                                                      <h4>Upload Video</h4>                 
                                                      <i class="ft-upload-cloud"></i>
                                                    </div>
                                                  </label> 
                                                </div>  
                                       </div>
                                    <p class="col-12 ttle-baner">Video 5</p>
                                       <div class="form-group col-12 mb-2">
                                                <div class="icon-crd">
                                                    <a href="javascript:void(0);" id="close5" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo5" controls=""><source  id="video_here5"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img" id="vid5">
                                                  <label for="edit-video5">
                                            <input class="form-control" name="edit-video5"  id="edit-video5" style="display: none;" type="file" accept="video/mp4"> 
                                                    <div class="crd-icon diet_title">   
                                                      <h4>Upload Video</h4>                 
                                                      <i class="ft-upload-cloud"></i>
                                                    </div>
                                                  </label> 
                                                </div>  
                                       </div>
                                </div>
                            </div>
                            <input type="hidden" name="desc" id="desc">
                                                                  
                    </div>
                </div> 
                <div class="form-actions frm-btns text-right">
                    <a href="<?php echo base_url()?>admin/dashboard" class="btn btn-danger mr-1">
                        <i class="ft-x"></i>Cancel
                    </a>
                    <a href="javascript:void(0);"  class="btn btn-primary" id="addExercise">
                        <i class="la la-check-square-o"></i>Submit
                    </a>
                </div>
            </div>  
                          
            </div>
      </div>
</div>
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script type="text/javascript">

     CKEDITOR.replace('description',{
        removePlugins: ','
     });
     $('#addExercise').on('click',function(){
        var textbox= CKEDITOR.instances.description.getData(); 
        $('#desc').val(textbox);

     });

     $(document).ready(function(){
  $('#title').keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
    //for image preview
    $('#edit-img5').on('change', function(){
        $("#preview5").attr("style", "display:block");
        $('#cross5').show();
    });
    $('#edit-img4').on('change', function(){
        $("#preview4").attr("style", "display:block");
        $('#cross4').show();
    });
    
    $('#edit-img3').on('change', function(){
        $("#preview3").attr("style", "display:block");
        $('#cross3').show();
    });

    $('#edit-img2').on('change', function(){
        $("#preview2").attr("style", "display:block");
        $('#cross2').show();
    });

    $('#edit-img1').on('change', function(){
        $("#preview1").attr("style", "display:block");
        $('#cross1').show();
    });



//for video preview
    $("#edit-video1").change(function() {
    priview_video1(this);
    
    });

    $("#edit-video2").change(function() {
    priview_video2(this);
    
    });

    $("#edit-video3").change(function() {
    priview_video3(this);
    var classes = $(this).parent().closest('div').attr('class').split(' ');
    
    });

    $("#edit-video4").change(function() {
    priview_video4(this);
    var classes = $(this).parent().closest('div').attr('class').split(' ');
    
    });

    $("#edit-video5").change(function() {
    priview_video5(this);
    var classes = $(this).parent().closest('div').attr('class').split(' ');
    
    });


//remove preview video
    $('#close1').click(function(){
        $(this).hide(); 
        $('#video_here1').val('');
        $('#edit-video1').val('');// Reset the video input fields
        $('#vid1').show();
        $('#showVideo1').hide();
    });
    $('#close2').click(function(){
        $(this).hide(); 
        $('#video_here2').val('');
        $('#edit-video2').val('');// Reset the video input fields
        $('#vid2').show();
        $('#showVideo2').hide();
    });
    $('#close3').click(function(){
        $(this).hide(); 
        $('#video_here3').val('');
        $('#edit-video3').val('');// Reset the video input fields
        $('#vid3').show();
        $('#showVideo3').hide();
    });
    $('#close4').click(function(){
        $(this).hide(); 
        $('#video_here4').val('');
        $('#edit-video4').val('');// Reset the video input fields
        $('#vid4').show();
        $('#showVideo4').hide();
    });
    $('#close5').click(function(){
        $(this).hide(); 
        $('#video_here5').val('');
        $('#edit-video5').val('');// Reset the video input fields
        $('#vid5').show();
        $('#showVideo5').hide();
    });

    function priview_video1(input,vid,classes){
        if (input.files) {
            var filesAmount = input.files.length;
            var fileType = input.files[0]['type'];
            var fileSize = input.files[0]['size'];
            if(fileSize <= 10000000){
                if(fileType == 'video/mp4' || fileType == 'video/3gp'){
                    $("#close1").show();
                    var $source = $('#video_here1');
                    $("#showVideo1").show();
                    $("#vid1").hide();

                    $source[0].src = URL.createObjectURL(input.files[0]);
                    $source.parent()[0].load();

                }else{
                    $('#edit-video1').val('');// Reset the video input fields
                    toastr.error('Please select only MP4 and 3GP video.');
                    $("#edit-video1").val('');
                }
            }else{
                toastr.error('Video size should not be greater then 10MB.');
                $('#edit-video1').val('');// Reset the video input fields
                $("#edit-video1").val('');
            }
        }
    }
    function priview_video2(input,vid,classes){
        if (input.files) {
            var filesAmount = input.files.length;
            var fileType = input.files[0]['type'];
            var fileSize = input.files[0]['size'];
            if(fileSize <= 10000000){
                if(fileType == 'video/mp4' || fileType == 'video/3gp'){
                    $("#close2").show();
                    var $source = $('#video_here2');
                    $("#showVideo2").show();
                    $("#vid2").hide();

                    $source[0].src = URL.createObjectURL(input.files[0]);
                    $source.parent()[0].load();

                }else{
                    $('#edit-video2').val('');// Reset the video input fields
                    toastr.error('Please select only MP4 and 3GP video.');
                    $("#edit-video2").val('');
                }
            }else{
                toastr.error('Video size should not be greater then 10MB.');
                $('#edit-video2').val('');// Reset the video input fields
                $("#edit-video2").val('');
            }
        }
    }
function priview_video3(input,vid,classes){
        if (input.files) {
            var filesAmount = input.files.length;
            var fileType = input.files[0]['type'];
            var fileSize = input.files[0]['size'];
            if(fileSize <= 10000000){
                if(fileType == 'video/mp4' || fileType == 'video/3gp'){
                    $("#close3").show();
                    var $source = $('#video_here3');
                    $("#showVideo3").show();
                    $("#vid3").hide();

                    $source[0].src = URL.createObjectURL(input.files[0]);
                    $source.parent()[0].load();

                }else{
                    $('#edit-video3').val('');// Reset the video input fields
                    toastr.error('Please select only MP4 and 3GP video.');
                    $("#edit-video3").val('');
                }
            }else{
                toastr.error('Video size should not be greater then 10MB.');
                $('#edit-video3').val('');// Reset the video input fields
                $("#edit-video3").val('');
            }
        }
    }
function priview_video4(input,vid,classes){
        if (input.files) {
            var filesAmount = input.files.length;
            var fileType = input.files[0]['type'];
            var fileSize = input.files[0]['size'];
            if(fileSize <= 10000000){
                if(fileType == 'video/mp4' || fileType == 'video/3gp'){
                    $("#close4").show();
                    var $source = $('#video_here4');
                    $("#showVideo4").show();
                    $("#vid4").hide();

                    $source[0].src = URL.createObjectURL(input.files[0]);
                    $source.parent()[0].load();

                }else{
                    $('#edit-video4').val('');// Reset the video input fields
                    toastr.error('Please select only MP4 and 3GP video.');
                    $("#edit-video4").val('');
                }
            }else{
                toastr.error('Video size should not be greater then 10MB.');
                $('#edit-video4').val('');// Reset the video input fields
                $("#edit-video4").val('');
            }
        }
    }
function priview_video5(input,vid,classes){
        if (input.files) {
            var filesAmount = input.files.length;
            var fileType = input.files[0]['type'];
            var fileSize = input.files[0]['size'];
            if(fileSize <= 10000000){
                if(fileType == 'video/mp4' || fileType == 'video/3gp'){
                    $("#close5").show();
                    var $source = $('#video_here5');
                    $("#showVideo5").show();
                    $("#vid5").hide();

                    $source[0].src = URL.createObjectURL(input.files[0]);
                    $source.parent()[0].load();

                }else{
                    $('#edit-video5').val('');// Reset the video input fields
                    toastr.error('Please select only MP4 and 3GP video.');
                    $("#edit-video5").val('');
                }
            }else{
                toastr.error('Video size should not be greater then 10MB.');
                $('#edit-video5').val('');// Reset the video input fields
                $("#edit-video5").val('');
            }
        }
    }

//onclick remove preview
    $('#cross1').click(function(){
        $(this).hide(); 
        $('#edit-img1').val('');
        $('#preview1').hide();
    });
    $('#cross2').click(function(){
        $(this).hide(); 
        $('#edit-img2').val('');
        $('#preview2').hide();
    });

    $('#cross3').click(function(){
        $(this).hide(); 
        $('#edit-img3').val('');
        $('#preview3').hide();
    });

    $('#cross4').click(function(){
        $(this).hide(); 
        $('#edit-img4').val('');
        $('#preview4').hide();
    });

    $('#cross5').click(function(){
        $(this).hide(); 
        $('#edit-img5').val('');
        $('#preview5').hide();
    });

    $(document).ready(function(){
        $("#add_exercise").validate({
        ignore: [],
        rules:{
            title:{
                required: true,
                minlength:2,
                maxlength:200
            },
            category_name:{
                required: true
            }
        },

        errorPlacement: function(error, element) 
        {
            if (element.attr("name") == "addContent") 
            {
            error.insertBefore("#addContent");
            } else {
            error.insertBefore(element);
            }
        }

        })

    });

function getfile(fil){
    var fileExtension = ['pdf'];
    if ($.inArray($('#edit-pdf').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        console.log('sachin');
    }else{
        str = fil.replace(/\\/g, '')
        var newstr = str.split('C:fakepath');
        $('#showpdf1').html(newstr);
    }
}


</script>
<style type="text/css">
    #category_name{
        background-color: #f2f3fb;
    }
</style>