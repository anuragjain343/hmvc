<div class="app-content content">
    <div class="content-wrapper">        
        <div class="content-wrapper-before Hedtxt">
            <h2 class="ml-2"><?php echo $titleN->categoryName;?> (<?php echo $total_nutri_count;?>)</h2>
            <?php if($id==1){
                $ctrl='admin/NutritionGuidance';
                $ctrl1='admin/nutritionGuidance/What_Can_I_Eat?';

            }else if($id==2){
                 $ctrl='admin/NutritionGuidance/addProtein';
                  $ctrl1='admin/nutritionGuidance/Protein';
            }else if($id==3){
            $ctrl='admin/NutritionGuidance/addSupplements';
             $ctrl1='admin/nutritionGuidance/supplements';
            }else if($id==4){
                 $ctrl='admin/NutritionGuidance/addMacroTracking';
                  $ctrl1='admin/nutritionGuidance/macro_Tracking';
            }else if($id==5){
            $ctrl='admin/NutritionGuidance/addDigestiveDisorders';
             $ctrl1='admin/nutritionGuidance/digestive_Disorders';
            }else if($id==6){
            $ctrl='admin/NutritionGuidance/addSpecialDietaryRequirements';
             $ctrl1='admin/nutritionGuidance/special_Dietary_Requirements';
            }
            else{
            $ctrl='admin/NutritionGuidance/addFluids';
             $ctrl1='admin/nutritionGuidance/fluids';
            }
            ?>
            
            <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right mr-2" href="<?php echo base_url().$ctrl;?>">
                <span class="white">Add New</span>
                <i class="ft-file-text white"></i>
            </a>
        </div>
        <div class="content-header row mt-10"></div> 
            <div class="row match-height">
              <?php if(!empty($nutritionGuidanceList)){  ?>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card mrgn-tp-crd">            
                        <div class="card-content">
                            <div id="recent-projects" class="media-list position-relative">
                                <div class="table-responsive">
                                    <table class="table table-padded table-xl mb-0 user-list-tble" id="recent-project-table">
                                        <thead>
                                            <tr>
                                               <th class="border-top-0">Heading</th>
                                                <th class="border-top-0">Posted By</th>                                               
                                               <!--  <th class="border-top-0">LIKES</th> -->
                                                <th class="border-top-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($nutritionGuidanceList as $value){
                                                
                                                    if($value->addedBy == 'trainer'){
                                                        $path = TRAINER_PROFILE_THUMB;   
                                                    }else{
                                                        $path = ADMIN_PROFILE_THUMB;   
                                                    }
                                                ?>
                                            <tr>
                                                <td class="text-truncate wdth-fix">
                                                    <a href="<?php echo base_url()?>admin/nutritionGuidance/nutritionGuidanceDetail/<?php echo encoding($value->id);?>">
                                                    <h4 class="card-title mrb-5" id="fixTitle"><?php echo strip_tags($value->title);?></h4></a>
                                                    <p class="mrb-0"><?php echo strip_tags($value->description);?></p>
                                                </td>
                                                <td class="text-truncate align-middle media">
                                                    <ul class="list-unstyled users-list m-0 mr-1">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="" class="avatar avatar-sm width-cstm pull-up">
                                                        <?php if(!empty($value->profileImage)){?>
                                                        <img class="media-object rounded-circle" src="<?php echo base_url().TRAINER_PROFILE_THUMB.$value->profileImage; ?>" alt="Avatar">
                                                            <?php }else{?>
                                                        <img class="media-object rounded-circle" src="<?php echo base_url().DEFAULT_IMAGE; ?>" alt="Avatar">
                                                            <?php }?>
                                                        </li>
                                                    </ul>
                                                    <?php
                                                   $userId = encoding($value->addedById);
                                                    ?>
                                                    <?php
                                                        $baseurl = base_url();
                                                        $ctl = base_url().$ctrl1;  
                                                        $nutritionGuidanceId = $value->id;
                                                        if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){   
                                                        $clickDelete ="deleteNutritionGuidance('$nutritionGuidanceId','$ctl','$baseurl')" ;
                                                    }else{
                                                         $clickDelete ="deleteNutritionGuidance('$nutritionGuidanceId','$ctl','$baseurl')" ;
                                                    }
                                                    ?>
                                                    <div class="media-body psted-by-text">
                                                        <h5 class="mt-0"><?php echo time_elapsed_string($value->crd);?> By <a href="<?php echo base_url()?>admin/trainers/trainerDetails/<?php echo $userId;?>/<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];?>/<?php echo $value->addedBy;?>"><?php echo $value->fullName;?></a></h5>
                                                    </div>
                                                </td>                                                
                                               
                                                <?php
                                                    $csrf = get_csrf_token()['hash'];?>
                                                    <input type="hidden" id="hashCsrf" data-values="<?php echo $csrf;?>"  data-keys="<?php echo get_csrf_token()['name'];?>">
                                                    <td class="align-middle eye-style">
                                                    <a href="<?php echo base_url()?>admin/nutritionGuidance/nutritionGuidanceDetail/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>
                                                    <a href="#" onclick="<?php echo $clickDelete; ?>">
                                                    <i class="ft-trash-2"></i></a>
                                                    <a href="<?php echo base_url()?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding($value->id);?>">
                                                    <i class="ft-edit-2"></i>
                                                    </a>
                                                </td>
                                            </tr>                                
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                         <div class="page_link">
                                    <?php echo $pagination; ?>
                                   </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php }else{ ?>
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card mrgn-tp-crd p-30">
                            <div class="card-content text-center">                           
                                <div id="records">No Records Found</div> 
                            </div>
                        </div>
                    </div>
            </div>
            </div>  
            
      </div>

  <?php }?>
     
  </div>


