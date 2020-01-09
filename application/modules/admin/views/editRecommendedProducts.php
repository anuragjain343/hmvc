<?php 

!empty($data->title)?$title = $data->title:$title = ''; 
 !empty($data->description)?$description = $data->description:$description = ''; ?>

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <form class="form mt-20 form" id="add_exercise" action="<?php echo base_url()?>admin/recommendedProducts/editRecommendedProducts">
                <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Detail Info Section</h4>
                            <div class="form_ttle_brdr"></div> 
                                <div class="form-body">
                                    <div class="row">                                       
                                        <div class="form-group col-12 mb-2">
                                             <input type="hidden" name="arid" id="checkid" value="2">
                                            <input type="text" id="title" class="form-control round autoSaveElement" placeholder="Enter Title" name="title" value="<?php echo $title;?>" moduleType="recommendedProducts">
                                        </div>
                                 <!--        <div class="form-group col-12 mb-2">
                                            <fieldset class="form-group mb-0">
                                                <select class="custom-select round" id="category_name" name="category_names" disabled="true">
                                                    <option value="" selected="">Select Category</option>
                                                    <?php
                                                    if(!empty($categoryList))
                                                     foreach ($categoryList as $k => $value) { 
                                                        if($data->categoryId==$value->id){ ?>
                                                            <option value="<?php echo $value->id;?>" selected ><?php echo $value->CategoryName;?></option>
                                                        <?php }else{
                                                      ?>
                                                    <option value="<?php echo $value->id;?>"><?php echo $value->CategoryName;?></option>
                                                <?php }
                                            }?>
                                                </select>
                                            </fieldset>
                                        </div> -->
                                        <input type="hidden" name="category_name" id="cat_id" value="<?php echo $data->categoryId;?>"/>
                                        <div class="form-group col-12 mb-2">
                                            <textarea id="description" rows="5" class="form-control round" name="description" moduleType="recommendedProducts" placeholder="Enter Description"><?php echo $description;?></textarea>
                                        </div>
                                        <div class="col-6">
                                            <span id="showpdf1">
                                                 <?php if(!empty($data->pdf)) { echo $data->pdf; ?>
                                         <a href="javascript:void(0);" onclick="deletePdf('<?php echo $data->pdf; ?>','recommendedProducts','<?php echo $data->categoryId; ?>');">
                                            <span class="fa fa-close btn_clse"></span></a>
                                            </span>
                                             <?php } ?>
                                        </div>
                                        <div class="col-6">
                                          
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
                               
                <input type="hidden" name="trainingId" value="<?php echo $data->id;?>">
                <input type="hidden" name="desc" id="desc">
                <div class="form-actions frm-btns text-right">
                    <a href="<?php echo base_url()?>admin/dashboard" class="btn btn-danger mr-1">
                        <i class="ft-x"></i>Cancel
                    </a>
                    <a href="javascript:void(0);"  class="btn btn-primary" id="addExercise">
                        <i class="la la-check-square-o"></i>Update
                    </a>
                </div>                                          
                        </div>
                    </div>
                    
                </div>
               
            </div>  
                          
            </div>
      </div>
      
<input type="hidden" name="ff" id="updimg" value="<?php echo base_url().'admin/nutritionGuidance/uploadImage';?>">
</div>
<div class="modal fade lsModal" id="nurtieModel" tabindex="-1" role="dialog" aria-labelledby="errorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form>
          <div class="modal-body">
            <div class="form-group">
              <h6> A previous unsaved version of this post exist. Do you want to restore it?(Chosing Yes will override your current post and chosing No will have no effect on your current post.)           
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger mr-1" data-dismiss="modal" id="deleterevition">No</button>
             <button type="button" class="btn btn-success mr-1" data-dismiss="modal" id="updateRevision">Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript" src="<?php echo base_url();?>backend_assets/ckeditor/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

   var baseur = $('#updimg').attr('value');
        CKEDITOR.replace('description',{
        height: 300,
      // filebrowserUploadUrl: baseur,
    });
        CKEDITOR.config.extraPlugins = 'slideshow';
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

    //onclick on gross event occure
    $('#gross1').click(function(){
        $(this).hide(); 
        $('#slag1').val(1);
        $('#edit-img1').val('');
        $('#preview1').hide();
    });
    $('#gross2').click(function(){
        $(this).hide();
        $('#slag2').val(1); 
        $('#edit-img2').val('');
        $('#preview2').hide();
    });

    $('#gross3').click(function(){
        $(this).hide(); 
        $('#slag3').val(1);
        $('#edit-img3').val('');
        $('#preview3').hide();
    });

    $('#gross4').click(function(){
        $(this).hide(); 
        $('#slag4').val(1);
        $('#edit-img4').val('');
        $('#preview4').hide();
    });

    $('#gross5').click(function(){
        $(this).hide(); 
        $('#slag5').val(1);
        $('#edit-img5').val('');
        $('#preview5').hide();
    });
    //===================


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

//for show video which already exist
if($('#video1').val()!=''){
    $("#vid1").hide();
    $("#deletevideo1").show();
}
if($('#video2').val()!=''){
    $("#vid2").hide();
    $("#deletevideo2").show();
}
if($('#video3').val()!=''){
    $("#vid3").hide();
    $("#deletevideo3").show();
}
if($('#video4').val()!=''){
    $("#vid4").hide();
    $("#deletevideo4").show();
}
if($('#video5').val()!=''){
    $("#vid5").hide();
    $("#deletevideo5").show();
}
//for show image which already exist
if($('#image1').val()!=''){
    $("#gross1").show();
}
if($('#image2').val()!=''){
    $("#gross2").show();
}
if($('#image3').val()!=''){
    $("#gross3").show();
}
if($('#image4').val()!=''){
    $("#gross4").show();
}
if($('#image5').val()!=''){
    $("#gross5").show();
}

//onclick on delete icon
    $('#deletevideo1').click(function(){
        $(this).hide(); 
        $('#flag1').val(1);
        $('#video_here1').val('');
        $('#edit-video1').val('');// Reset the video input fields
        $('#vid1').show();
        $('#showVideo1').hide();
    });// End
    $('#deletevideo2').click(function(){
        $(this).hide(); 
        $('#flag2').val(1);
        $('#video_here2').val('');
        $('#edit-video2').val('');// Reset the video input fields
        $('#vid2').show();
        $('#showVideo2').hide();
    });// End
    $('#deletevideo3').click(function(){
        $(this).hide(); 
        $('#flag3').val(1);
        $('#video_here3').val('');
        $('#edit-video3').val('');// Reset the video input fields
        $('#vid3').show();
        $('#showVideo3').hide();
    });

    $('#deletevideo4').click(function(){
        $(this).hide(); 
        $('#flag4').val(1);
        $('#video_here4').val('');
        $('#edit-video4').val('');// Reset the video input fields
        $('#vid4').show();
        $('#showVideo4').hide();
    });// End

    $('#deletevideo5').click(function(){
        $(this).hide(); 
        $('#flag5').val(1);
        $('#video_here5').val('');
        $('#edit-video5').val('');// Reset the video input fields
        $('#vid5').show();
        $('#showVideo5').hide();
    });// End
//no enter key press action
$(document).ready(function(){
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

 function deletePdf(name,ctr,id){
    toastr.remove();    
   f_action = '<?php echo base_url()?>admin/recommendedProducts/deletePdf?pdfName='+name+'&cat='+id;
    $.ajax({
            type: "POST",
            url: f_action,
            data: {}, //only input
            processData: false,
            contentType: false,
            dataType: "JSON", 
            beforeSend: function () { 
                //show_loader(); 
            },
            success: function (data, textStatus, jqXHR){  
               // hide_loader(); 
            if(data.status==1){
                toastr.success(data.msg);
                window.setTimeout(function () {
                window.location.reload();
                }, 1000); 
            } 
            else {
                    toastr.error(data.message); 
                    window.setTimeout(function (){
                    window.location.reload();
                }, 700); 
            }  
        },
    });   
 }


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

window.onload=my_code();

function my_code(){
  var id_ack = $('#cat_id').val();
    formData = {articlearticle:id_ack},
    f_action = '<?php echo base_url();?>admin/recommendedProducts/checkutritionGuidanceId',
    $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        $('#nurtieModel').modal();
        $('#checkid').attr('value',1);
       }
     }
     });
}


$('body').on('click','#updateRevision', function(){
  var id_ack = $('#cat_id').val();
   formData = {articleId:id_ack},
     f_action ='<?php echo base_url();?>admin/recommendedProducts/getRevitionData',
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        $('#title').attr('value',res.article.title);
        $('#checkid').attr('value',2);
        CKEDITOR.instances['description'].setData(res.article.description);

        $('#cat_id').attr('value',res.article.postId); 
       }
      }
     }); 
    });
//

$('body').on('click','#deleterevition', function(){
  var id_ack = $('#cat_id').val();
   formData = {articleId:id_ack},
     f_action ='<?php echo base_url();?>admin/recommendedProducts/DeleteRevition',
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        $('#checkid').attr('value',2); 
       }
     }
     }); 
    });

  var autosaveOn = false,
        timeoutId;
    $('.autoSaveElement').each(function(){
        var elem = $(this);
        var oldVal = elem.val();
        elem.data('oldVal', elem.val());
        elem.bind("propertychange change keyup input paste", function(event){
            newVal = elem.val();
           // newVal.trim().replace(/\s+/g, " ");
            //remove extra whitespace if any
           if(newVal == '' || oldVal == newVal){
                return;
            }
            var oldVal = newVal;
            compareData(oldVal, newVal, elem);
        });
    });


var descOldVal = CKEDITOR.instances.description.getData();
CKEDITOR.instances.description.on('change', function(){ 
    var elem =CKEDITOR.instances.description;
    var newVal= elem.getData();
    //alert(newVal);
    //newVal.trim().replace(/\s+/g, " "); 
    if (newVal == '' || descOldVal == newVal) {
        return;
    }
    descOldVal = newVal;
    compareData(descOldVal, newVal, elem);
});

function compareData(oldVal,newVal,elem){
 if (timeoutId) clearTimeout(timeoutId);
   timeoutId = setTimeout(function () {
    autoSaveData(elem);
    }, 750);
}
//auto save ajax call
    function autoSaveData(elem) {
        console.log(CKEDITOR.instances.description);
        if(autosaveOn){
            return; //return when previous ajax is in process
        }
        autosaveOn = true;
        var moduleType =  $('.autoSaveElement').attr('moduleType'); //get module type from elem
            switch(moduleType) {
            case 'recommendedProducts':
            var title_a       = $('#title').val();
            var id_a          = $('#cat_id').val();     
            var description_a = CKEDITOR.instances.description.getData();

            var formData = {title:title_a,description:description_a,articleStatus:0,upd_articlearticle:id_a},  
            f_action = '<?php echo base_url();?>admin/recommendedProducts/editNutritionGuidance1'; 
            break;
            case 'forum':
            break;
            default:

            }

     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
        autosaveOn = false; 
        var res = JSON.parse(data);
       if(res.status == 1){
        //$("#articalId").val(res.article_id);
        }
        }
        });
    }
</script>
<style type="text/css">
    #category_name{
        background-color: #f2f3fb;
    }
</style>