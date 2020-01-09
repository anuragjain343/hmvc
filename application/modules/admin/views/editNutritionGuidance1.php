<?php 
if(!empty($data->image)){
    $image_set = json_decode($data->image);
    !empty($image_set[0])?$image1 = $image_set[0]:$image1='';
    !empty($image_set[1])?$image2 = $image_set[1]:$image2='';
    !empty($image_set[2])?$image3 = $image_set[2]:$image3='';
    !empty($image_set[3])?$image4 = $image_set[3]:$image4='';
    !empty($image_set[4])?$image5 = $image_set[4]:$image5='';?>

     <input type="hidden" id="image1" value="<?php echo $image1;?>">
     <input type="hidden" id="image2" value="<?php echo $image2;?>">
     <input type="hidden" id="image3" value="<?php echo $image3;?>">
     <input type="hidden" id="image4" value="<?php echo $image4;?>">
     <input type="hidden" id="image5" value="<?php echo $image5;?>">

<?php }

if(!empty($data->image)){
    $image_set = json_decode($data->image);
    !empty($image1)?$style1 = 'display:block':$style1='display:none';
    !empty($image2)?$style2 = 'display:block':$style2='display:none';
    !empty($image3)?$style3 = 'display:block':$style3='display:none';
    !empty($image4)?$style4 = 'display:block':$style4='display:none';
    !empty($image5)?$style5 = 'display:block':$style5='display:none';
}
if(!empty($data->video)){
    $video_set = json_decode($data->video);
    !empty($video_set[0])?$video1 = $video_set[0]:$video1='';
    !empty($video_set[1])?$video2 = $video_set[1]:$video2='';
    !empty($video_set[2])?$video3 = $video_set[2]:$video3='';
    !empty($video_set[3])?$video4 = $video_set[3]:$video4='';
    !empty($video_set[4])?$video5 = $video_set[4]:$video5='';

    !empty($video1)?$stylev1 = 'display:block':$stylev1='display:none';
    !empty($video2)?$stylev2 = 'display:block':$stylev2='display:none';
    !empty($video3)?$stylev3 = 'display:block':$stylev3='display:none';
    !empty($video4)?$stylev4 = 'display:block':$stylev4='display:none';
    !empty($video5)?$stylev5 = 'display:block':$stylev5='display:none';
    ?>
 <input type="hidden" id="video1" value="<?php echo $video1;?>">
 <input type="hidden" id="video2" value="<?php echo $video2;?>">
 <input type="hidden" id="video3" value="<?php echo $video3;?>">
 <input type="hidden" id="video4" value="<?php echo $video4;?>">
 <input type="hidden" id="video5" value="<?php echo $video5;?>">
 <?php
}

!empty($data->title)?$title = $data->title:$title = ''; 
 !empty($data->description)?$description = $data->description:$description = ''; ?>

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <form class="form mt-20 form" id="add_exercise" action="<?php echo base_url()?>admin/NutritionGuidance/editNutritionGuidance">
                <!-- flag set for delete video -->
                <input type="hidden" name="flag1" id="flag1" value="">
                <input type="hidden" name="flag2" id="flag2">
                <input type="hidden" name="flag3" id="flag3">
                <input type="hidden" name="flag4" id="flag4">
                <input type="hidden" name="flag5" id="flag5">

                <input type="hidden" name="slag1" id="slag1" value="">
                <input type="hidden" name="slag2" id="slag2">
                <input type="hidden" name="slag3" id="slag3">
                <input type="hidden" name="slag4" id="slag4">
                <input type="hidden" name="slag5" id="slag5">
                <!-- end -->
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Detail Info Section</h4>
                            <div class="form_ttle_brdr"></div> 
                                <div class="form-body">
                                    <div class="row">                                       
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="title" class="form-control round" placeholder="Enter Title" name="title" value="<?php echo $title;?>">
                                        </div>
                                        <div class="form-group col-12 mb-2">
                                            <fieldset class="form-group mb-0">
                                                <select class="custom-select round" id="category_name" name="category_names" disabled="true">
                                                  
                                                    <?php
                                                    if(!empty($categoryList))
                                                     foreach ($categoryList as $k => $value) { 
                                                        if($data->categoryId==$value->id){ ?>
                                                            <option value="<?php echo $value->id;?>" selected ><?php echo $value->categoryName;?></option>
                                                        <?php }else{
                                                      ?>
                                                    <option value="<?php echo $value->id;?>"><?php echo $value->categoryName;?></option>
                                                <?php }
                                            }?>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <input type="hidden" name="category_name" value="<?php echo $data->categoryId;?>"/>
                                        <div class="form-group col-12 mb-2">
                                            <textarea id="description" rows="5" class="form-control round" name="description" placeholder="Enter Description"><?php echo $description;?></textarea>
                                        </div>
                                        <div class="col-6">
                                      <span  id="showpdf1"></span>
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
                                                <input class="form-control" id="edit-img1" style="display: none;" type="file" onchange="return fileValidation('edit-img1','preview1')" name="edit-img1" accept="image/x-png,image/jpeg">
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
                                                <img class="PrintImg" src="<?php echo base_url(NURRITIONGUIDANCE_THUMB).$image1;?>" id="preview1" style="<?php echo $style1;?>">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross1">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="gross1">
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Image 2</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img2">
                                                <input class="form-control" id="edit-img2" style="display: none;" type="file" onchange="return fileValidation('edit-img2','preview2');" name="edit-img2" accept="image/x-png,image/jpeg">
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
                                                <img class="PrintImg" src="<?php echo base_url(NURRITIONGUIDANCE_THUMB).$image2;?>" id="preview2" style="<?php echo $style2;?>">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross2">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="gross2">
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Image 3</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img3">
                                                <input class="form-control" id="edit-img3" style="display: none;" type="file" onchange="return fileValidation('edit-img3','preview3');" name="edit-img3" accept="image/x-png,image/jpeg">
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
                                                <img class="PrintImg" src="<?php echo base_url(NURRITIONGUIDANCE_THUMB).$image3;?>" id="preview3" style="<?php echo $style3;?>">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross3">
                                                 <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="gross3">
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Image 4</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img4">
                                                <input class="form-control" id="edit-img4" style="display: none;" type="file" onchange="return fileValidation('edit-img4','preview4');" name="edit-img4" accept="image/x-png,image/jpeg">
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
                                                <img class="PrintImg" src="<?php echo base_url(NURRITIONGUIDANCE_THUMB).$image4;?>" id="preview4" style="<?php echo $style4;?>">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross4">
                                                 <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="gross4">
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Image 5</p>
                                        <div class="form-group col-6 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img5">
                                                <input class="form-control" id="edit-img5" style="display: none;" type="file" onchange="return fileValidation('edit-img5','preview5');" name="edit-img5" accept="image/x-png,image/jpeg">
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
                                                <img class="PrintImg" src="<?php echo base_url(NURRITIONGUIDANCE_THUMB).$image5;?>" id="preview5" style="<?php echo $style5;?>">
                                                <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="cross5">
                                                 <img class="close-img" src="<?php echo base_url() ?>backend_assets/img/close.png" style="display: none;" id="gross5">
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
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); <?php echo $stylev1;?>" id="showVideo1" controls=""><source  id="video_here1" src="<?php echo base_url(NURRITIONGUIDANCE_VIDEO).$video1;?>"></video> 
                                                    <a href="javascript:void(0);" style="padding:6px; display: none;" class="btn btn-danger float-right" id="deletevideo1">                   
                                                        <i class="ft-trash" title="Delete Video"  ></i>
                                                    </a>
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
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); <?php echo $stylev2;?>" id="showVideo2" controls=""><source  id="video_here2" src="<?php echo base_url(NURRITIONGUIDANCE_VIDEO).$video2;?>"></video> 
                                                    <a href="javascript:void(0);" style="padding:6px; display: none;" class="btn btn-danger float-right" id="deletevideo2" onclick="flagSet();">                   
                                            <i class="ft-trash" title="Delete Video"  ></i>
                                                    </a>
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
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); <?php echo $stylev3;?>" id="showVideo3" controls="" ><source  id="video_here3" src="<?php echo base_url(NURRITIONGUIDANCE_VIDEO).$video3;?>"></video>
                                                 <a href="javascript:void(0);" style="padding:6px; display: none;" class="btn btn-danger float-right" id="deletevideo3" onclick="flagSet();">                   
                                            <i class="ft-trash" title="Delete Video"  ></i>
                                        </a> 
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
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); <?php echo $stylev4;?>" id="showVideo4" controls="" ><source  id="video_here4" src="<?php echo base_url(NURRITIONGUIDANCE_VIDEO).$video4;?>"></video> 
                                                    <a href="javascript:void(0);" style="padding:6px; display: none;" class="btn btn-danger float-right" id="deletevideo4" onclick="flagSet();">                   
                                            <i class="ft-trash" title="Delete Video"  ></i>
                                        </a>
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
                                                 <video style="width: 100%; height: 281px; background-color: rgb(0, 0, 0); border: 1px solid rgba(238, 255, 238, 0.933); <?php echo $stylev5;?>" id="showVideo5" controls=""><source  id="video_here5" src="<?php echo base_url(NURRITIONGUIDANCE_VIDEO).$video5;?>"></video> 
                                                    <a href="javascript:void(0);" style="padding:6px; display: none;" class="btn btn-danger float-right" id="deletevideo5" onclick="flagSet();">                   
                                            <i class="ft-trash" title="Delete Video"  ></i>
                                        </a>
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
                                                                  
                    </div>
                </div> 
                <input type="hidden" name="trainingId" value="<?php echo $data->id;?>">
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
     <input type="hidden" name="ff" id="updimg" value="<?php echo base_url().'admin/nutritionGuidance/uploadImage';?>">
</div>
<script type="text/javascript" src="<?php echo base_url();?>/backend_assets/ckeditor/ckeditor.js"></script>
<!--  <script type="text/javascript" src="<?php echo base_url();?>/backend_assets/kcfinder/kcfinder.js"></script>  -->


<!-- <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script> -->
<script type="text/javascript">

     /*CKEDITOR.replace('description',{
        removePlugins: ','
     });*/
     var baseur = $('#updimg').attr('value');
    // alert(baseur);
        CKEDITOR.replace('description',{
        height: 300,

      // Configure your file manager integration. This example uses CKFinder 3 for PHP.
     // filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
      //filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
      //filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
       filebrowserUploadUrl: baseur,

     // filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'

    });
        CKEDITOR.config.extraPlugins = 'slideshow';

/*CKEDITOR.plugins.add( 'slideshow', {
    icons: 'slideshow',
    init: function( editor ) {
        //Plugin logic goes here.
    }
});*/
/*CKEDITOR.replace( 'slideshow', {
    language: 'er',
    //uiColor: '#9AB8F3'
});*/
 

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
   // $(this).parent().parent().hide();
    });

    $("#edit-video2").change(function() {
    priview_video2(this);
    //$(this).parent().parent().hide();
    });

    $("#edit-video3").change(function() {
    priview_video3(this);
    var classes = $(this).parent().closest('div').attr('class').split(' ');
    //$(this).parent().parent().hide();
    });

    $("#edit-video4").change(function() {
    priview_video4(this);
    var classes = $(this).parent().closest('div').attr('class').split(' ');
    //$(this).parent().parent().hide();
    });

    $("#edit-video5").change(function() {
    priview_video5(this);
    var classes = $(this).parent().closest('div').attr('class').split(' ');
    //$(this).parent().parent().hide();
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

<script>

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
</script> 