<?php if(!empty($nutritionData)){
 ?>
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card-body back-crd-body">
                        <div id="carousel-example-generic" class="carousel slide mb-1" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php 
                                    $image = json_decode($nutritionData->image);
                                    $image = array_values(array_filter($image, 'strlen'));
                                foreach ($image as $k => $val) { if(!empty($val[$k])){
                                    ?>
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                 <?php } } 
                                    ?>

                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php 
                                    $image = json_decode($nutritionData->image);
                                    $image = array_values(array_filter($image, 'strlen'));
                                    foreach ($image as $k => $val) {?>
                                        <?php if(!empty($val[$k])){?>
                                        <div class="carousel-item <?php if($k==0) { echo 'active';}?>">
                                            <img src="<?php echo base_url(NURRITIONGUIDANCE_MEDIUM).$val;?>" class="d-block w-100" alt="First slide">
                                        </div>
                                    <?php } ?>
                            <?php } 
                        ?>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="la la-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!-- <h4 class="card-title">Card title</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-info">Button</a>   -->  
                    </div>
                </div>
                <?php
                 if($nutritionData->categoryId==1){
                $ctrl='admin/NutritionGuidance';
                $ctrl1='admin/nutritionGuidance/How_Does_MyVegan_Trainer_Diet_Works';

                 }else if($nutritionData->categoryId==2){
                 $ctrl='admin/NutritionGuidance/AddwhichDietStyle';
                  $ctrl1='admin/nutritionGuidance/which_Diet_Style';
                }else if($nutritionData->categoryId==3){
                $ctrl='admin/NutritionGuidance/addSupplements';
                 $ctrl1='admin/nutritionGuidance/supplements';
                }else if($nutritionData->categoryId==4){
                 $ctrl='admin/NutritionGuidance/addMacroTracking';
                  $ctrl1='admin/nutritionGuidance/macro_Tracking';
                }else if($nutritionData->categoryId==5){
                $ctrl='admin/NutritionGuidance/addDigestiveDisorders';
                 $ctrl1='admin/nutritionGuidance/digestive_Disorders';
                }else{
                $ctrl='admin/NutritionGuidance/addSpecialDietaryRequirements';
               $ctrl1='admin/nutritionGuidance/special_Dietary_Requirements';
             }

                $baseurl = base_url();
                $ctl = base_url().$ctrl1;  
                $clickDelete ="deleteNutritionGuidance('$nutritionData->id','$ctl','$baseurl')" ;
                ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card blck-sec">
                        <div class="card-body nutrtin-ttle EditSec">
                            <div class="EditLeft">
                            <h4 class="card-title pr-1"><?php echo $nutritionData->title; ?></h4>
                            </div>
                            <!-- <h6 class="card-subtitle text-muted">Video Embed Card With Header & Footer</h6> -->
                            <div class="EditRight">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a href="javascript:void(0);" onclick="<?php echo $clickDelete; ?>">
                                            <i class="ft-trash-2"></i>
                                        </a>
                                    </li>
                                    <li>
                                       <a href="<?php echo base_url()?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding($nutritionData->id);?>">
                                            <i class="ft-edit-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php  if(!empty($nutritionData->video)){ ?>
                        <div id="carousel-area" class="carousel slide vedio-slde" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php 
                                    $video = json_decode($nutritionData->video);
                                    $video = array_values(array_filter($video, 'strlen'));
                                    foreach ($video as $k => $val) { 
                                        if(!empty($val[$k])){
                                        ?>
                                <li data-target="#carousel-area" data-slide-to="0" class="active"></li>
                            <?php } }?>

                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php 
                                    $video = json_decode($nutritionData->video);
                                    $video = array_values(array_filter($video, 'strlen'));
                                    foreach ($video as $k => $val) { ?>
                                  <?php if(!empty($val[$k])){ ?>       
                                <div class="carousel-item <?php if($k==0){ echo 'active';}?>">
                                    <video controls="" class="VideoHeight">
                                    <source src="<?php echo base_url(NURRITIONGUIDANCE_VIDEO).$val;?>" type="video/mp4">
                                    </video>
                                </div>
                            <?php } ?>
                            <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-area" role="button" data-slide="prev">
                                <span class="la la-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-area" role="button" data-slide="next">
                                <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    <?php }?>
                        <div class="card-body">
                            <p class="card-text"><?php echo $nutritionData->description; ?></p>
                        </div>
                        <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                            <span class="float-left"><?php echo time_elapsed_string($nutritionData->crd); ?></span>
                            <span class="tags float-right">
                                <?php if(!empty($nutritionData->pdf)){?>
                                <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right" target="_blank" href="<?php if(!empty($nutritionData->pdf)){ echo base_url().NURRITIONGUIDANCE_PDF.$nutritionData->pdf;}?>">
                                    <span class="white">Download PDF</span>
                                   
                                    <i class="ft-download pl-1 white"></i>

                                <?php }?>
                                </a>
                                
                            </span>

                        </div>
                    </div>
                </div>
            </div>
      </div>
</div>
<?php }?>