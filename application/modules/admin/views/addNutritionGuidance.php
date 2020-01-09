
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
        <div class="content-header row"></div>
      <form class="form mt-20" id="addNurti" action="<?php echo base_url();?>admin/nutritionGuidance/add_NutritionGuidance" method="POST">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card back-img">
                    <div class="card-body card-header">
                        <h4 class="card-title brdr-btm-grey">Detail Info Section</h4>
                        <div class="form_ttle_brdr"></div> 
                            <div class="form-body">
                                <div class="row">                                       
                                    <div class="form-group col-12 mb-2">
                                        <input type="text" id="complaintinput1" class="form-control round" placeholder="Enter Title" name="title">
                                    </div>
                                    <div class="form-group col-12 mb-2">
                                        <fieldset class="form-group mb-0">
                                          <select class="custom-select round" id="NutisSelect" name="slectNurti" disabled="true" style="background-color: #f2f3fb;">
                                              <option  value="" selected="">Select Category</option>
                                                <?php foreach($cat as $value){
                                                 if($catid==$value->id){
                                                  ?>
                                              <option  value="<?php echo $value->id;?>" selected><?php echo $value->categoryName;?>
                                                  
                                                </option>
                                      <input type="hidden" name="slectNurti"  value="<?php echo $value->id;?>"/>
                                               <?php } }?>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="form-group col-12 mb-2">
                                        <textarea id="description" rows="5" class="form-control round"  name="description" placeholder="Enter Description"></textarea>
                                    </div>
                                    <div class="col-6">
                                      <span  id="showpdf1"></span>
                                    </div>
                                    <div class="col-6">
                                        <div class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right">
                                            <label for="edit-imgpdf" class="mb-0">
                                                <input class="form-control" id="edit-imgpdf" style="display: none;" type="file" name ="pdfFile" accept="application/pdf,application/vnd.ms-excel" onchange="getfile(document.getElementById('edit-imgpdf').value);">
                                                <div class="crd-icon diet_title">   
                                                    <span class="white" id="showpdf">Upload PDF</span>                                          
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
                                            <input class="form-control" id="edit-img1" style="display: none;" type="file" onchange="document.getElementById('fixpic').src = window.URL.createObjectURL(this.files[0])" name="nutru_image1" accept="image/x-png,image/jpg,image/jpeg">

                                            <div class="crd-icon diet_title">   
                                              <h4>Upload Image</h4>                 
                                              <i class="ft-upload-cloud"></i>
                                            </div>
                                          </label> 
                                        </div>  
                                         <p style="color: gray;font-size: 11px; margin-top: 5px;">Image should be at least 300*300px</p>   
                                    </div>

                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                            <img class="PrintImg" src="" id="fixpic" style="display: none;" / >
                            <img class="close-img" id="cross" src="<?php echo base_url();?>backend_assets/img/close.png" style="display: none;">
                                        </div>     
                                    </div>
                                    <p class="col-12 ttle-baner">Image 2</p>
                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod">
                                          <label for="edit-img2">
                                            <input class="form-control" id="edit-img2" style="display: none;" type="file" onchange="document.getElementById('fixpic2').src = window.URL.createObjectURL(this.files[0])" name="nutru_image2" accept="image/x-png,image/jpg,image/jpeg">
                                            <div class="crd-icon diet_title">   
                                              <h4>Upload Image</h4>                 
                                              <i class="ft-upload-cloud"></i>
                                            </div>
                                          </label> 
                                        </div>
                                          <p style="color: gray;font-size: 11px; margin-top: 5px;">Image should be at least 300*300px</p>      
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                              <img class="PrintImg" src="" id="fixpic2" style="display: none;" / >
                                            <img class="close-img" id="cross2" src="<?php echo base_url();?>backend_assets/img/close.png" style="display: none;">
                                        </div>     
                                    </div>
                                    <p class="col-12 ttle-baner">Image 3</p>
                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod">
                                          <label for="edit-img3">
                                            <input class="form-control" id="edit-img3" style="display: none;" type="file" onchange="document.getElementById('fixpic3').src = window.URL.createObjectURL(this.files[0])" name="nutru_image3"accept="image/x-png,image/jpg,image/jpeg">
                                            <div class="crd-icon diet_title">   
                                              <h4>Upload Image</h4>                 
                                              <i class="ft-upload-cloud"></i>
                                            </div>
                                          </label> 
                                        </div> 
                                          <p style="color: gray;font-size: 11px; margin-top: 5px;">Image should be at least 300*300px</p>     
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                             <img class="PrintImg" src="" id="fixpic3" style="display: none;" / >
                                            <img class="close-img" id="cross3" src="<?php echo base_url();?>backend_assets/img/close.png" style="display: none;">
                                        </div>     
                                    </div>
                                    <p class="col-12 ttle-baner">Image 4</p>
                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod">
                                          <label for="edit-img4">
                                            <input class="form-control" id="edit-img4" style="display: none;" type="file" onchange="document.getElementById('fixpic4').src = window.URL.createObjectURL(this.files[0])" name="nutru_image4" accept="image/x-png,image/jpg,image/jpeg">
                                            <div class="crd-icon diet_title">   
                                              <h4>Upload Image</h4>                 
                                              <i class="ft-upload-cloud"></i>
                                            </div>
                                          </label> 
                                        </div> 
                                          <p style="color: gray;font-size: 11px; margin-top: 5px;">Image should be at least 300*300px</p>     
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                            <img class="PrintImg" src="" id="fixpic4" style="display: none;" / >
                                            <img class="close-img" id="cross4" src="<?php echo base_url();?>backend_assets/img/close.png" style="display: none;">
                                        </div>     
                                    </div>
                                    <p class="col-12 ttle-baner">Image 5</p>
                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod">
                                          <label for="edit-img5">
                                            <input class="form-control" id="edit-img5" style="display: none;" type="file" onchange="document.getElementById('fixpic5').src = window.URL.createObjectURL(this.files[0])" name="nutru_image5" accept="image/x-png,image/jpg,image/jpeg">
                                            <div class="crd-icon diet_title">   
                                              <h4>Upload Image</h4>                 
                                              <i class="ft-upload-cloud"></i>
                                            </div>
                                          </label> 
                                        </div> 
                                          <p style="color: gray;font-size: 11px; margin-top: 5px;">Image should be at least 300*300px</p>
     
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                            <img class="PrintImg" src="" id="fixpic5" style="display: none;" / >
                                            <img class="close-img" id="cross5" src="<?php echo base_url();?>backend_assets/img/close.png" style="display: none;">
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
                     <!--    <form class="form mt-20"> -->
                            <div class="form-body">
                                <div class="row">
                                    <p class="col-12 ttle-baner">Video 1</p>
                                          <div class="form-group col-12 mb-2">
                                                <div class="icon-crd">
                                                    <a href="javascript:void(0);" id="closev1" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo1" controls=""><source  id="video_here1"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img" id="uploadImgs1">
                                                  <label for="edit-video1">
                                            <input class="form-control" name="Video1"  id="edit-video1"  style="display: none;" type="file" accept="video/mp4"> 
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
                                                    <a href="javascript:void(0);" id="closev2" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo2" controls=""><source  id="video_here2"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img" id="uploadImgs2">
                                                  <label for="edit-video2">
                                            <input class="form-control" name="Video2"  id="edit-video2" style="display: none;" type="file" accept="video/mp4"> 
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
                                                    <a href="javascript:void(0);" id="closev3" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo3" controls=""><source  id="video_here3"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img" id="uploadImgs3">
                                                  <label for="edit-video3">
                                            <input class="form-control" name="Video3"  id="edit-video3" style="display: none;" type="file" accept="video/mp4"> 
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
                                                    <a href="javascript:void(0);" id="closev4" class="close-img-icon" style="display: none;"><i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo4" controls=""><source  id="video_here4"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img" id="uploadImgs4">
                                                  <label for="edit-video4">
                                            <input class="form-control" name="Video4"  id="edit-video4" style="display: none;" type="file" accept="video/mp4"> 
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
                                                    <a href="javascript:void(0);" id="closev5" class="close-img-icon" style="display: none;">   <i class="fa fa-times "></i>
                                                    </a>       
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo5" controls=""><source  id="video_here5"></video> 
                                                </div>
                                            
                                            </div> 
                                         <div class="form-group col-12 mb-2">
                                                <div class="upload-imgs pd-img" id="uploadImgs5">
                                                  <label for="edit-video5">
                                          <input class="form-control" name="Video5"  id="edit-video5" style="display: none;" type="file" accept="video/mp4"> 
                                                    <div class="crd-icon diet_title">   
                                                      <h4>Upload Video</h4>                 
                                                      <i class="ft-upload-cloud"></i>
                                                    </div>
                                                  </label> 
                                                </div>  
                                       </div>
                                </div>
                            </div>
                                                                     
                    </div>
                </div> 
                <div class="form-actions frm-btns text-right">
                  <?php  if($catid==1){
                    $cancle= base_url().'admin/dashboard';
                  }else if($catid==2){
                  $cancle= base_url().'admin/dashboard';
                  }else if($catid==3){
                   $cancle= base_url().'admin/dashboard';
                    }else if($catid==4){
                      $cancle= base_url().'admin/dashboard';
                    }else if($catid==5){
                     $cancle= base_url().'admin/dashboard';
                    }
                    else{
                  $cancle= base_url().'admin/dashboard';
                  }
                  ?>
                  <input type="hidden" name="desc" id="desc">
                    <a href="<?php echo $cancle;?>" type="button" class="btn btn-danger mr-1">
                        <i class="ft-x"></i>Cancel
                    </a>
                    <a href="javascript:void(0);"  class="btn btn-primary" id="add_Nurti">
                      <i class="la la-check-square-o" ></i>Submit
                    </a>
                </div>
            </div>                
        </div>
      </form>
  </div>
</div>

<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script type="text/javascript">

 CKEDITOR.replace('description',{
        removePlugins: ','
     });

 $('#add_Nurti').on('click',function(){
        var textbox= CKEDITOR.instances.description.getData(); 
        $('#desc').val(textbox);

     });
 
  $(document).ready(function(){
  $('#complaintinput1').keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
    $('#edit-img1').on('change', function(){
    $('#fixpic').attr('style', 'display:block');
    $('#cross').show();
    });

	$('#cross').click(function(){
        $(this).hide(); 
        $('#nutru_image1').val('');
        $('#fixpic').hide();
    });

    $('#edit-img2').on('change', function(){
    $('#fixpic2').attr('style', 'display:block');
    $('#cross2').show();
    });

	$('#cross2').click(function(){
        $(this).hide(); 
        $('#nutru_image2').val('');
        $('#fixpic2').hide();
    });

    $('#edit-img3').on('change', function(){
    $('#fixpic3').attr('style', 'display:block');
    $('#cross3').show();
    });

	$('#cross3').click(function(){
        $(this).hide(); 
        $('#nutru_image3').val('');
        $('#fixpic3').hide();
    });

   $('#edit-img4').on('change', function(){
    $('#fixpic4').attr('style', 'display:block');
    $('#cross4').show();
    });

	$('#cross4').click(function(){
        $(this).hide(); 
        $('#nutru_image4').val('');
        $('#fixpic4').hide();
    });

 	$('#edit-img5').on('change', function(){
    $('#fixpic5').attr('style', 'display:block');
    $('#cross5').show();
    });

	$('#cross5').click(function(){
	    $(this).hide(); 
	    $('#nutru_image5').val('');
	    $('#fixpic5').hide();
    });

$("#edit-video1").change(function(){
   priview_video(this); 
});

function priview_video(input){
    if (input.files) {
    var filesAmount = input.files.length;
    var fileType = input.files[0]['type'];
    var fileSize = input.files[0]['size'];
    if(fileSize <= 10000000){
    if(fileType == 'video/mp4' || fileType == 'video/3gp'){
      var $source = $('#video_here1');
		$("#showVideo1").show();
		$("#closev1").show();
		$("#uploadImgs1").hide();
		$source[0].src = URL.createObjectURL(input.files[0]);
		$source.parent()[0].load();     
    }else{
      toastr.error('Please select only MP4 and 3GP video.');
    }
    }else{
      toastr.error('Video size should not be greater than 10MB.');
    }
  }
}

$('#closev1').click(function(){
    $('#video_here1').val('');
    $('#edit-video1').val('');
    $('#uploadImgs1').show();
    $('#showVideo1').hide();
    $('#closev1').hide();
});

/*2*/
$("#edit-video2").change(function(){
   priview_video2(this); 
});
function priview_video2(input){
    if (input.files) {
    var filesAmount = input.files.length;
    var fileType = input.files[0]['type'];
    var fileSize = input.files[0]['size'];
    if(fileSize <= 10000000){
    if(fileType == 'video/mp4' || fileType == 'video/3gp'){
        var $source = $('#video_here2');
    $("#showVideo2").show();
    $("#closev2").show();
    $("#uploadImgs2").hide();
    $source[0].src = URL.createObjectURL(input.files[0]);
    $source.parent()[0].load();     
    }else{
      toastr.error('Please select only MP4 and 3GP video.');
    }
    }else{
      toastr.error('Video size should not be greater than 10MB.');
    }
  }
}

$('#closev2').click(function(){
    $('#video_here2').val('');
    $('#edit-video2').val('');
    $('#uploadImgs2').show();
    $('#showVideo2').hide();
    $('#closev2').hide();
});
/*3*/

$("#edit-video3").change(function(){
   priview_video3(this); 
});
function priview_video3(input){
    if (input.files) {
    var filesAmount = input.files.length;
    var fileType = input.files[0]['type'];
    var fileSize = input.files[0]['size'];
    if(fileSize <= 10000000){
    if(fileType == 'video/mp4' || fileType == 'video/3gp'){
        var $source = $('#video_here3');
    $("#showVideo3").show();
    $("#closev3").show();
    $("#uploadImgs3").hide();
    $source[0].src = URL.createObjectURL(input.files[0]);
    $source.parent()[0].load();     
    }else{
      toastr.error('Please select only MP4 and 3GP video.');
    }
    }else{
      toastr.error('Video size should not be greater than 10MB.');
    }
  }
}

$('#closev3').click(function(){
    $('#video_here3').val('');
    $('#edit-video3').val('');
    $('#uploadImgs3').show();
    $('#showVideo3').hide();
    $('#closev3').hide();
});
/*4*/

$("#edit-video4").change(function(){
   priview_video4(this); 
});
function priview_video4(input){
    if (input.files) {
    var filesAmount = input.files.length;
    var fileType = input.files[0]['type'];
    var fileSize = input.files[0]['size'];
    if(fileSize <= 10000000){
    if(fileType == 'video/mp4' || fileType == 'video/3gp'){
        var $source = $('#video_here4');
    $("#showVideo4").show();
    $("#closev4").show();
    $("#uploadImgs4").hide();
    $source[0].src = URL.createObjectURL(input.files[0]);
    $source.parent()[0].load();     
    }else{
      toastr.error('Please select only MP4 and 3GP video.');
    }
    }else{
      toastr.error('Video size should not be greater than 10MB.');
    }
  }
}

$('#closev4').click(function(){
    $('#video_here4').val('');
    $('#edit-video4').val('');
    $('#uploadImgs4').show();
    $('#showVideo4').hide();
    $('#closev4').hide();
});
/*5*/

$("#edit-video5").change(function(){
   priview_video5(this); 
});
function priview_video5(input){
    if (input.files) {
    var filesAmount = input.files.length;
    var fileType = input.files[0]['type'];
    var fileSize = input.files[0]['size'];
    if(fileSize <= 10000000){
    if(fileType == 'video/mp4' || fileType == 'video/3gp'){
        var $source = $('#video_here5');
    $("#showVideo5").show();
    $("#closev5").show();
    $("#uploadImgs5").hide();
    $source[0].src = URL.createObjectURL(input.files[0]);
    $source.parent()[0].load();     
    }else{
      toastr.error('Please select only MP4 and 3GP video.');
    }
    }else{
      toastr.error('Video size should not be greater than 10MB.');
    }
  }
}

$('#closev5').click(function(){
    $('#video_here5').val('');
    $('#edit-video5').val('');
    $('#uploadImgs5').show();
    $('#showVideo5').hide();
    $('#closev5').hide();
});


function getfile(fil){
    var fileExtension = ['pdf'];
    if ($.inArray($('#edit-imgpdf').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        console.log('sachin');
    }else{
        str = fil.replace(/\\/g, '')
        var newstr = str.split('C:fakepath');
        $('#showpdf1').html(newstr);
    }
}


</script>