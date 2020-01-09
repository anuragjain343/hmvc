
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-wrapper-before"></div>
		<div class="content-header row"></div>
		<div class="row">
			<div class="col-lg-3 col-md-2"></div>
			<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title" id="hidden-label-round-controls">Add Recipes</h4>
						<!-- <a class="heading-elements-toggle">
							<i class="la la-ellipsis-v font-medium-3"></i>
						</a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li>
								<a data-action="reload">
								<i class="ft-rotate-cw"></i>
								</a>
								</li>
							</ul>
						</div> -->
					</div>
					<div class="card-content collpase show">
						<div class="card-body">
							<form class="form" id="add_Recepie" action="<?php echo base_url()?>admin/recepie/add_recepie">
								<div class="form-body">
									<div class="row"> 
										 <input type="hidden" name="upd_articlearticle" id="articalId" value="<?php echo $result->id;?>"> 
										<input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" > 
										<div class="form-group col-12 mb-2">
											<label class="sr-only" for="complaintinput1">Title</label>
											<input type="text" id="complaintinput1" class="form-control round autoSaveElement" placeholder="Title" name="title" moduleType="recepie" value="<?php echo $result->title;?>">
										</div>
										<div class="form-group col-12 mb-2">
											<fieldset class="form-group mb-0">
												<select class="custom-select round" id="customSelect" name="category_name">
													<option value="">Select Category</option>
													<?php
													if(!empty($category)){
													foreach ($category as $k => $cat) { ?>
											
<option value="<?php echo $cat->id;?> " <?php if($result->categoryId ==$cat->id){ echo 'selected'; }?> >
				<?php  echo $cat->categoryName;?> 
		</option>
													<?php  } 
													}?>
												</select>
											</fieldset>
										</div>

										<div class="form-group col-12 mb-2">
											<label class="sr-only" for="complaintinput5">Enter Description</label>
											<textarea id="complaintinput5" rows="5" class="form-control round autoSaveElement" name="description" placeholder="Description" moduleType="recepie"><?php echo $result->description;?></textarea>
										</div>
										<div class="form-group col-6 mb-2">
											<div class="upload-imgs pd-img">
												<label for="edit-img">
													<input accept="image/x-png,image/gif,image/jpeg" class="form-control" id="edit-img" style="display: none;" type="file" name="recepie_image" onchange="return fileValidation();">
													<div class="crd-icon diet_title"> 
														<h4>Upload Image</h4> 
														<i class="ft-upload-cloud"></i>
													</div>
												</label> 
											</div> 
										</div>
										<div class="form-group col-6 mb-2">
											<div class="preview_img">
												<span id="close-image"><i class="ft-x"></i></span>
												<img id="output">
											</div> 
										</div>
										<p style="color: gray;font-size: 11px; position: relative;
    left: 17px;">Image should be at least 300*300px</p>
										<div class="form-group col-12 mb-2">
											<div class="upload-imgs pd-img" id="vid">
												<label for="edit-video">
													<input class="form-control" id="edit-video" style="display: none;" type="file" name="file" accept="video/mp4">
													<div class="crd-icon diet_title"> 
														<h4>Upload Video</h4> 
														<i class="ft-upload-cloud"></i>
													</div>
												</label> 
											</div> 
										</div>
										<div class="form-group col-12 mb-2 crd-icon">
											<a href="javascript:void(0);" id="close" style="display: none; color:red;">
												<div class="img-icon-close"> 
													<i class="fa fa-times"></i>
												</div>
											</a> 
											<video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); display: none;" id="showVideo" controls=""><source id="video_here"></video> 


										</div>
									</div>
								</div>
								<div class="form-actions border-0 frm-btns mt-0">
									<a href="<?php echo base_url() ?>admin/recepie"  class="btn btn-danger mr-1">
										<i class="ft-x"></i> Cancel
									</a>
									<button type="button" class="btn btn-primary" id="addRecepie"><i class="la la-check-square-o"></i>Add</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
$(window).keydown(function(event){
if(event.keyCode == 13) {
event.preventDefault();
return false;
}
});
});
	$(document).ready(function(){

		$("#addRecepie").validate({
		ignore: [],
		rules:{
		title:{
			required: true,
			minlength:2,
			maxlength:200
		},
		description:{
			required: true,
			minlength:2
		},
		category_name:{
			required: true
		}
		},

		errorPlacement: function(error, element) 
		{
			if (element.attr("name") == "addRecepie") 
			{
			error.insertBefore("#addRecepie");
			} else {
			error.insertBefore(element);
			}
		}

		})

	});

</script>
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

$("#edit-video").change(function() {
priview_video(this);

});

function priview_video(input){
	if (input.files) {
		var filesAmount = input.files.length;
		var fileType = input.files[0]['type'];
		var fileSize = input.files[0]['size'];
		if(fileSize <= 10000000){
			if(fileType == 'video/mp4' || fileType == 'video/3gp'){
			var $source = $('#video_here');
			$("#showVideo").show();
			$("#close").show();
			$("#vid").hide();
			$source[0].src = URL.createObjectURL(input.files[0]);
			$source.parent()[0].load(); 

			}else{
			$('#edit-video').val('');// Reset the video input fields
			toastr.error('Please select only MP4 and 3GP video.');
			$("#add-video").val('');
			}
		}else{
			toastr.error('Video size should not be greater than 10MB.');
			$("#add-video").val('');
			$('#edit-video').val('');// Reset the video input fields
		}
	}
}

// Referesh the canvas
	$('#close').click(function(){
	$('#video_here').val('');
	$('#edit-video').val('');// Reset the video input fields
	$('#vid').show();
	$('#showVideo').hide();
	$('#close').hide();

	});// End


	$('#close-image').click(function(){
	$('#edit-img').val('');// Reset the video input fields
	$('#output').hide();
	$('#close-image').hide();

	});// End
	$('#edit-img').on('change', function() {
	  	$('#output').show();
		$('#close-image').show();
	});

	if( document.getElementById("edit-img").files.length == 0 ){
	    $('#close-image').hide();
	}

function fileValidation(){
    var fileInput = document.getElementById('edit-img');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
         toastr.error('Please upload file having extensions .jpeg/.jpg/.png/.');
        fileInput.value = '';
       $('.preview_img').show();
    	$('#close-image').hide();
    	//$('#output').hide();
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {

            var reader = new FileReader();
            reader.onload = function(e) {
             document.getElementById('output').src = window.URL.createObjectURL(fileInput.files[0]);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}


var autosaveOn = false,
    timeoutId;
//all elements that needs to be checked need to have autoSaveElement class
    $('.autoSaveElement').each(function(){
        var elem = $(this);
        // Save current value of element
        var oldVal = elem.val();
        //alert(oldVal);
        elem.data('oldVal', elem.val());
        // Look for changes in the value
        elem.bind("propertychange change keyup input paste", function(event){
            newVal = elem.val();
            newVal.trim().replace(/\s+/g, " "); //remove extra whitespace if any
            // If value is same...
            if(newVal == '' || oldVal == newVal){
                return;
            }
            // Update stored value with new one
            var oldVal = newVal;
            compareData(oldVal, newVal, elem);
        });
    });

function compareData(oldVal,newVal,elem){
    // If a timer was already started, clear it.
    if (timeoutId) clearTimeout(timeoutId);
        //trigger AJAX after the user stops writing for more than 750 milliseconds
    timeoutId = setTimeout(function () {
     // call auto save ajax here
     autoSaveData(elem);
    }, 750);
}


   //auto save ajax call
    function autoSaveData(elem){
       
        //alert(elem);
        if(autosaveOn){
            return; //return when previous ajax is in process
        }
        autosaveOn = true;
        var moduleType =  $('.autoSaveElement').attr('moduleType'); //get module type from elem
       //alert(moduleType);
        switch(moduleType) {
            case 'recepie':

                var title_a     	= $('#complaintinput1').val();
                var id_cat        	= $('#customSelect').val();
               // alert(title_a);
                var id_a        = $('#articalId').val();
                var description_a  	= $('#complaintinput5').val();
            
                var formData = {title:title_a,description:description_a,articleStatus:0,upd_articlearticle:id_a,cat:id_cat},   
                f_action = '<?php echo base_url();?>admin/recepie/add_recepie1'; 
                break;
              case 'forum':
                // prepare your data accordingly
                break;
            default:
                // prepare your data accordingly
        }

     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
        autosaveOn = false; 
        var res = JSON.parse(data);
       if(res.status == 1){
        $("#articalId").val(res.article_id);
        }
        }
        });
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

