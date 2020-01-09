<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <?php
            $array = json_decode($banner_content->contentValue);
            $bannerMultiple = $array->banner;
            $about = $array->about;
            $video1 = $array->video1;
            $video2 = $array->video2;
            $trainer = $array->trainer;
            if(!empty($bannerMultiple['0']->b_image)){
             $link1 =  base_url(BANNER_IMAGE).$bannerMultiple['0']->b_image;
            }else{
                $link1 =  BANNER_DEFAULT;
            }
            if(!empty($bannerMultiple['1']->b_image)){
             $link2 =  base_url(BANNER_IMAGE).$bannerMultiple['1']->b_image;
            }else{
                $link2 =  BANNER_DEFAULT;
            }
            if(!empty($bannerMultiple['2']->b_image)){
             $link3 =  base_url(BANNER_IMAGE).$bannerMultiple['2']->b_image;
            }else{
                $link3 =  BANNER_DEFAULT;
            }
            if(!empty($bannerMultiple['3']->b_image)){
             $link4 =  base_url(BANNER_IMAGE).$bannerMultiple['3']->b_image;
            }else{
                $link4 =  BANNER_DEFAULT;
            }
            if(!empty($bannerMultiple['4']->b_image)){
             $link5 =  base_url(BANNER_IMAGE).$bannerMultiple['4']->b_image;
            }else{
                $link5 =  BANNER_DEFAULT;
            }
            //pr($bannerMultiple['2']->b_image);
?>
<form class="form mt-20" id="addContent" action="<?php echo base_url()?>admin/content/add_content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Banner Section</h4>
                            <div class="form_ttle_brdr"></div> 
                                <div class="form-body">
                                    <div class="row">
                                        <p class="col-12 ttle-baner">Banner 1</p>
                                        <div class="form-group col-12 mb-2">
                                            <label class="sr-only" for="complaintinput1">Enter Title</label>
                                            <input type="text" id="banner_title1" class="form-control round" placeholder="Title" name="banner_title1" value="<?php echo $bannerMultiple['0']->b_title; ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img1">
                                                <input class="form-control" id="edit-img1" style="display: none;" type="file" onchange="document.getElementById('fixpic').src = window.URL.createObjectURL(this.files[0])" name="banner_image1" value="<?php echo $bannerMultiple['0']->b_image; ?>" accept="image/jpeg,image/x-png">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div>     
                                            <p style="color: gray;font-size: 11px;margin-top:5px; ">Image should be at least 1400*550px</p>
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="<?php echo $link1;?>" id="fixpic" />
                                                <img class="close-img" id="cross" src="<?php echo base_url()?>backend_assets/img/close.png" style="display: none;"/>
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Banner 2</p>
                                        <div class="form-group col-12 mb-2">
                                            <label class="sr-only" for="complaintinput1">Enter Title</label>
                                            <input type="text" id="banner_title2" class="form-control round" placeholder="Title"  name="banner_title2" value="<?php echo $bannerMultiple['1']->b_title; ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img2">
                                                <input class="form-control" id="edit-img2" style="display: none;" type="file" name="banner_image2" value="<?php echo $bannerMultiple['1']->b_image; ?>" onchange="document.getElementById('fixpic1').src = window.URL.createObjectURL(this.files[0])" accept="image/jpeg,image/x-png">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div>   
                                            <p style="color: gray;font-size: 11px;margin-top:5px; ">Image should be at least 1400*550px</p>  
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="<?php echo $link2;?>" id="fixpic1" />
                                                <img id="cross1" class="close-img" src="<?php echo base_url()?>backend_assets/img/close.png" style="display: none;"/>
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Banner 3</p>
                                        <div class="form-group col-12 mb-2">
                                            <label class="sr-only" for="complaintinput1">Enter Title</label>
                                            <input type="text" id="banner_title3" class="form-control round" placeholder="Title" name="banner_title3" value="<?php echo $bannerMultiple['2']->b_title; ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img3">
                                                <input class="form-control" id="edit-img3" style="display: none;" type="file" name="banner_image3" value="<?php echo $bannerMultiple['2']->b_image; ?>" onchange="document.getElementById('fixpic2').src = window.URL.createObjectURL(this.files[0])" accept="image/jpeg,image/x-png">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div> 
                                            <p style="color: gray;font-size: 11px;margin-top:5px; ">Image should be at least 1400*550px</p>    
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="<?php echo $link3;?>" id="fixpic2" />
                                                <img id="cross2" class="close-img" src="<?php echo base_url()?>backend_assets/img/close.png" style="display: none;"/>
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Banner 4</p>
                                        <div class="form-group col-12 mb-2">
                                            <label class="sr-only" for="complaintinput1">Enter Title</label>
                                            <input type="text" id="banner_title4" class="form-control round" placeholder="Title"  name="banner_title4" value="<?php echo $bannerMultiple['3']->b_title; ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img4">
                                                <input class="form-control" id="edit-img4" style="display: none;" type="file" name="banner_image4" value="<?php echo $bannerMultiple['3']->b_image; ?>" onchange="document.getElementById('fixpic3').src = window.URL.createObjectURL(this.files[0])" accept="image/jpeg,image/x-png">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div>   
                                            <p style="color: gray;font-size: 11px;margin-top:5px; ">Image should be at least 1400*550px</p>  
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="<?php echo $link4;?>" id="fixpic3" />
                                                <img id="cross3" class="close-img" src="<?php echo base_url()?>backend_assets/img/close.png" style="display: none;"/>
                                            </div>     
                                        </div>
                                        <p class="col-12 ttle-baner">Banner 5</p>
                                        <div class="form-group col-12 mb-2">
                                            <label class="sr-only" for="complaintinput1">Enter Title</label>
                                            <input type="text" id="banner_title5" class="form-control round" placeholder="Title"  name="banner_title5" value="<?php echo $bannerMultiple['4']->b_title; ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod">
                                              <label for="edit-img5">
                                                <input class="form-control" id="edit-img5" style="display: none;" type="file" name="banner_image5" value="<?php echo $bannerMultiple['4']->b_image; ?>" onchange="document.getElementById('fixpic4').src = window.URL.createObjectURL(this.files[0])" accept="image/jpeg,image/x-png">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div> 
                                            <p style="color: gray;font-size: 11px;margin-top:5px; ">Image should be at least 1400*550px</p>    
                                        </div>
                                        <div class="form-group col-lg-6 col-xs-12 mb-2">
                                            <div class="upload-imgs pd-img index-pge-uplod bck-image">
                                                <img class="PrintImg" src="<?php echo $link5;?>" id="fixpic4" />
                                                <img id="cross4" class="close-img" src="<?php echo base_url()?>backend_assets/img/close.png" style="display: none;" />
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
                            <h4 class="card-title brdr-btm-grey">About Us Section</h4>
                            <div class="form_ttle_brdr"></div> 
                            
                                <div class="form-body">
                                    <div class="row">                                       
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="about_subtitle" class="form-control round" placeholder="Enter Subtitle"  name="about_subtitle" value="<?php echo $about->subtitle;?>">
                                        </div>
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="about_title" class="form-control round" placeholder="Enter Title"  name="about_title" value="<?php echo $about->title;?>">
                                        </div>
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="about_info_title" class="form-control round" placeholder="Enter Info Title" name="about_info_title" value="<?php echo $about->infotitle;?>">
                                        </div>
                                        <div class="form-group col-12 mb-2">
                                            <textarea id="about_info_description" rows="5" class="form-control round"  placeholder="Enter Info Description" name="about_info_description"><?php echo $about->infodesc;?></textarea>
                                        </div>
                                        <div class="form-group col-12 mb-2">
                                            <img id="cross7" class="close-img" src="<?php echo base_url()?>backend_assets/img/close.png" style="display: none;" />
                                            <div class="upload-imgs pd-img" id="test">
                                              <label for="edit-img6">
                                                <input onchange="document.getElementById('about_img').src = window.URL.createObjectURL(this.files[0])" class="form-control" id="edit-img6" style="display: none;" type="file" name="about_image" accept="image/jpeg,image/x-png">
                                                <div class="crd-icon diet_title">   
                                                  <h4>Upload Info Image</h4>                 
                                                  <i class="ft-upload-cloud"></i>
                                                </div>
                                              </label> 
                                            </div> 
                                                <img class="" src="" id="about_img" style="display: none;">
                                            <p style="color: gray;font-size: 11px;margin-top:5px; ">Image should be at least 400*400px</p>        
                                        </div>                                        
                                    </div>
                                </div>
                                                                          
                        </div>
                    </div> 
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Video Text Section</h4>
                            <div class="form_ttle_brdr"></div> 
                            
                                <div class="form-body">
                                    <div class="row">                                       
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="video_title" class="form-control round" placeholder="Enter Title"  name="video_title" value="<?php echo $video1->title;?>">
                                        </div>
                                        <div class="form-group col-12 mb-2">
                                            <textarea id="video_description" rows="5" class="form-control round" placeholder="Enter Description" name="video_description"><?php echo $video1->desc;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                                                         
                        </div>
                    </div>
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Trainers Images Section</h4>
                            <div class="form_ttle_brdr"></div> 
                            
                                <div class="form-body">
                                    <div class="row">                                       
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="trainer_title" class="form-control round" placeholder="Enter Title" name="trainer_title" value="<?php echo $trainer->title;?>">
                                        </div>
                                    </div>
                                </div>
                                                                         
                        </div>
                    </div>
                    <div class="card back-img">
                        <div class="card-body card-header">
                            <h4 class="card-title brdr-btm-grey">Video Slider Section</h4>
                            <div class="form_ttle_brdr"></div> 
                            
                                <div class="form-body">
                                    <div class="row">                                       
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="video_slider_subtitle" class="form-control round" placeholder="Enter Subtitle"  name="video_slider_subtitle" value="<?php echo $video2->subtitle;?>">
                                        </div>
                                        <div class="form-group col-12 mb-2">
                                            <input type="text" id="video_slider_title" class="form-control round" placeholder="Enter Title" name="video_slider_title" value="<?php echo $video2->title;?>">
                                        </div>
                                    </div>
                                </div>
                                                                        
                        </div>
                    </div>
                    <div class="form-actions frm-btns border-0 p-0 text-right">
                        <a href="<?php echo base_url()?>admin/dashboard" class="btn btn-danger mr-1">
                            <i class="ft-x"></i>Cancel
                        </a>
                        <a href="javascript:void(0);" id="contentSubmit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i>Submit
                        </a>
                    </div>
                </div>                
            </div>
        </form>
      </div>
</div>
<script src="//cdn.ckeditor.com/4.11.3/full/ckeditor.js"></script>
<script type="text/javascript">
    //cke editor
    CKEDITOR.replace( 'video_description' );
    CKEDITOR.replace( 'about_info_description' );

    $(document).ready(function(){
        $("#addContent").validate({
        ignore: [],
        rules:{
            banner_title1:{
                required: true,
                minlength:2,
                maxlength:50
            },
            banner_title2:{
                required: true,
                minlength:2,
                maxlength:50
            },
            banner_title3:{
                required: true,
                minlength:2,
                maxlength:50
            }, 
            banner_title4:{
                required: true,
                minlength:2,
                maxlength:50
            },
            banner_title5:{
                required: true,
                minlength:2,
                maxlength:50
            },
            about_subtitle:{
                required: true,
                minlength:2,
                maxlength:50
            },
            about_title:{
                required: true,
                minlength:2,
                maxlength:50
            },
            about_info_title:{
                required: true,
                minlength:2,
                maxlength:50
            },
            video_title:{
                required: true,
                minlength:2,
                maxlength:50
            },
            trainer_title:{
                required: true,
                minlength:2,
                maxlength:50
            },

            video_slider_title:{
                required: true,
                minlength:2,
                maxlength:50
            },

            video_slider_subtitle:{
                required: true,
                minlength:2,
                maxlength:100
            },
            about_info_description:{
                required: function() 
                        {
                         CKEDITOR.instances.about_info_description.updateElement();
                        },
                minlength:2
            },
            video_description:{
               required: function() 
                        {
                         CKEDITOR.instances.video_description.updateElement();
                        },
                minlength:2
            },
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
    $('#cross').click(function(){
        $(this).hide(); 
        $('#banner_image1').val('');
        $('#fixpic').hide();
    });

    $('#cross1').on('click',function(){
        $(this).hide(); 
        $('#banner_image2').val('');
        $('#fixpic1').hide();
    });

    $('#cross2').on('click',function(){
        $(this).hide(); 
        $('#banner_image3').val('');
        $('#fixpic2').hide();
    });

    $('#cross3').on('click',function(){
        $(this).hide(); 
        $('#banner_image4').val('');
        $('#fixpic3').hide();
    });

    $('#cross4').on('click',function(){
        $(this).hide(); 
        $('#banner_image5').val('');
        $('#fixpic4').hide();
    });


    $('#edit-img5').on('change', function(){
        $("#fixpic4").attr("style", "display:block");
        $('#cross4').show();
    });
    $('#edit-img4').on('change', function(){
        $("#fixpic3").attr("style", "display:block");
        $('#cross3').show();
    });
    
    $('#edit-img3').on('change', function(){
        $("#fixpic2").attr("style", "display:block");
        $('#cross2').show();
    });

    $('#edit-img2').on('change', function(){
        $("#fixpic1").attr("style", "display:block");
        $('#cross1').show();
    });

    $('#edit-img1').on('change', function(){
        $("#fixpic").attr("style", "display:block");
        $('#cross').show();
    });
     $('#edit-img6').on('change', function(){
        $('#cross7').show();
        $('#test').attr("style", "display:none");
        $("#about_img").attr("style", "display:block");
    });

    $('#cross7').on('click',function(){
        $(this).hide(); 
        $('#about_img').hide('');
        $('#test').show();
        $('#edit-img6').val('');
    });

</script>

