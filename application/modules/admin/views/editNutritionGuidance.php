<?php 

!empty($data->title)?$title = $data->title:$title = ''; 
 !empty($data->description)?$description = $data->description:$description = '';
  ?>
 

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <form class="form mt-20 form" id="add_exercise" action="<?php echo base_url()?>admin/NutritionGuidance/editNutritionGuidance">
                <!-- flag set for delete video -->
               
                <!-- end -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <input type="hidden" name="arid" id="checkid" value="2">
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Detail Info Section</h4>
                            <div class="form_ttle_brdr"></div> 
                                <div class="form-body">
                                    <div class="row">                                       
                                        <div class="form-group col-12 mb-2">
                                            <input type="hidden" name="arid" id="checkid" value="2">
                                            <input type="text" id="title" class="form-control round autoSaveElement" placeholder="Enter Title" name="title" moduleType="nutritionGuidance" value="<?php echo $title;?>">
                                        </div>
                              
                                        <input type="hidden" name="category_name" id="cat_id" value="<?php echo $data->categoryId;?>"/>
                                        <div class="form-group col-12 mb-2">
                                            <textarea id="description" rows="5" class="form-control round" name="description" moduleType="nutritionGuidance" placeholder="Enter Description"><?php echo $description;?></textarea>
                                        </div>
                                        <div class="col-6">
                                      <span  id="showpdf1">
                                            <?php if(!empty($data->pdf)) {
                                             echo $data->pdf; ?>
                            <input type="hidden" name="pdfname" id="pdfId" value="<?php echo $data->pdf; ?>" multiple />

                            <a href="javascript:void(0);" onclick="deletePdf('<?php echo $data->pdf; ?>','nutritionGuidance','<?php echo $data->categoryId; ?>');">
                                                <span class="fa fa-close btn_clse"></span></a>
                                      </span>
                                       <?php } ?>
                                    </div>
                                        <div class="col-6">
                                          
                                            <div class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right">
                                                <label for="edit-pdf" class="mb-0">
                                                    <input class="form-control" id="edit-pdf" style="display: none;" type="file" name="edit-pdf"  accept="application/pdf,application/vnd.ms-excel" onchange="getfile(document.getElementById('edit-pdf').value);">
                                                    <div class="crd-icon diet_title">   
                                                        <span class="white">Upload PDF</span>

                                                        <i class="ft-upload pl-1 white"></i> 

                                                    </div>

                                                </label> 

                                            </div> 

                                        </div>
                                       
                                    </div>
                                </div>
                    <input type="hidden" name="trainingId" id="nutId" value="<?php echo $data->id;?>">
                    <div class="form-actions frm-btns text-right">

                    <?php if($data->categoryId==1){
                    $can= 'admin/dashboard';
                    }else if($data->categoryId==2){
                     $can= 'admin/dashboard';
                    }else if($data->categoryId==3){
                     $can= 'admin/dashboard';
                    }else if($data->categoryId==4){
                    $can= 'admin/dashboard';
                    }else if($data->categoryId==5){
                    $can= 'admin/dashboard';
                    }else{
                    $can= 'admin/dashboard';
                    }

                    ?>
                    <input type="hidden" name="desc" id="desc">
                    <a href="<?php echo base_url().$can;?>" class="btn btn-danger mr-1">

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

 <script type="text/javascript" src="<?php echo base_url();?>backend_assets/ckeditor/ckeditor.js">
</script> 
<style type="text/css">
    #category_name{
        background-color: #f2f3fb;
    }
</style>
<!--  <script type="text/javascript" src="<?php echo base_url();?>backend_assets/ckeditor/ckfinder/ckfinder.js"></script>  -->
  
<script type="text/javascript">
     var baseur = $('#updimg').attr('value');
      CKEDITOR.replace('description',{
      height: 300,
      //filebrowserUploadUrl: baseur,
    });

//$('$cke_31_label').onchange('src');
/*jQuery('body').on('click', '#cke_31_label', function (){
var im =   $('.ad-image').attr('src');
alert(im);
});
*/    
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


//no enter key press action
$(document).ready(function(){
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
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

function fileValidation(id,pvr){
    var fileInput = document.getElementById(id);
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
         toastr.error('Please upload file having extensions .jpeg/.jpg/.png/.');
        fileInput.value = '';
        $('#'+pvr).attr('src',' ');
        $('.close-img').css('display',' ');

        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {

            var reader = new FileReader();
            reader.onload = function(e) {
             document.getElementById(pvr).src = window.URL.createObjectURL(fileInput.files[0]);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

 function deletePdf(name,ctr,id){
    toastr.remove();    
   f_action = '<?php echo base_url()?>admin/nutritionGuidance/deletePdf?pdfName='+name+'&cat='+id;
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

window.onload=my_code();

function my_code(){
  var id_ack = $('#cat_id').val();
    formData = {articlearticle:id_ack},
    f_action = '<?php echo base_url();?>admin/nutritionGuidance/checkutritionGuidanceId',
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
     f_action ='<?php echo base_url();?>admin/nutritionGuidance/getRevitionData',
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
     f_action ='<?php echo base_url();?>admin/nutritionGuidance/DeleteRevition',
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
            case 'nutritionGuidance':
            var title_a       = $('#title').val();
            var id_a          = $('#cat_id').val();     
            var description_a = CKEDITOR.instances.description.getData();

            var formData = {title:title_a,description:description_a,articleStatus:0,upd_articlearticle:id_a},  
            f_action = '<?php echo base_url();?>admin/nutritionGuidance/editNutritionGuidance1'; 
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
