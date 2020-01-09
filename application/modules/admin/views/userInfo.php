  <?php $backend = base_url()."backend_assets/";?>
<?php if(!empty($user)){?>  
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card ">
                        <div class="card-header bg-hexagons">
                            <h4 class="card-title ">Basic Info</h4>
                        </div>
                        <div class="card-content collapse show bg-hexagons">
                            <div class="card-body pt-0 pb-1">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <?php if(!empty($user->profileImage)){?>
                                        <img class="media-object user-dtl-prfle rounded-circle donutShadow" src="<?php echo base_url().USER_PROFILE_THUMB.$user->profileImage;?>" alt="Avatar">
                                        <?php }else{?>
                                         <img class="media-object user-dtl-prfle rounded-circle donutShadow" src="<?php echo base_url().DEFAULT_IMAGE.$user->profileImage;?>" alt="Avatar">
                                        <?php }?>
                                    </div>
                                    <div class="media-body text-right mt-2">
                                        <h3 class=" font-large-1 blue-grey lighten-1 "><?php echo $user->fullName;?>
                                        </h3>
                                        <h6 class="mt-1">
                                            <span class="text-muted"><?php echo $user->email;?>
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-card card border-grey border-lighten-2">
                        <div class="card-header">
                          <h4 class="card-title">
                            <a href="#">Trainer Info</a>
                          </h4>                                                    
                        </div>
                        <?php if(!empty($assignTrainer)){?>
                        <div class="card-content">
                            <div class="row m-1 pb">
                                <div class="align-self-center trainr-pic">
                                    <?php if(!empty($assignTrainer->profileImage)){ ?>
                                    <img class="img-fluid" src="<?php echo base_url().TRAINER_PROFILE_THUMB.$assignTrainer->profileImage;?>" alt="Timeline Image 1">
                                    <?php }else{ ?>
                                     <img class="img-fluid" src="<?php echo base_url().DEFAULT_IMAGE.$assignTrainer->profileImage;?>" alt="Timeline Image 1">
                                    <?php } ?>
                                </div> 
                                <div class="text-center ml-30 name-hed-top trainr-hed-algn">
                                    <h3 class="font-large-1"><?php echo $assignTrainer->fullName;?></h3>
                                    <div class="row">
                                          <div class="col-sm-12 col-12 text-center">
                                            <p class="blue-grey lighten-2 mb-0"> Trainer</p>
                                          </div>
                                    </div>
                                    <div class="heading-elements my-1">
                                        <ul class="list-inline d-block mb-0">
                                            <li> <?php $tid = encoding($assignTrainer->id);?>

                                             <!--  <a href="" href="#"> -->
                                                    <!-- <span class="white">View Details</span> -->
                                                <!-- </a>  -->
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p class="line-height-2 p-1"> <?php echo $assignTrainer->details;?></p>
                        </div>
                          <?php }else{ ?>
                          <div class="card-content">
                            <div class="row m-1 pb">  
                                <h3>No Trainer selected</h3>
                            </div>
                        </div>
                          <?php }?>
                    </div>
                </div>
                
                <?php  if($plan) {
                    //pr($plan);
                    foreach( $plan as $val ){
                    if($val->planLevel==$uplan AND $uplan!='free'){
                 ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <section id="blockquotes-styling-default" class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card">

                                 <div class="card-header pb">
                                    <h4 class="card-title fnt-sze-ttle">£<?php echo $val->amount;?>/<small class="text-muted"><?php echo $val->planDuration;?>-<b><?php echo limit_text($val->planName,30);?></b></small>
                                    </h4>
                                    
                                </div>

                                 <div class="card-content">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <?php echo $val->description;?>

                                    </div>
                                </div> 
               
                            <?php } } }else{?>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                    <section id="blockquotes-styling-default" class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card">
                                FREE
                            </div>
                        </div>
                    </section>
                            <?php }?>
                            </div>
                        </div>

                    </section>
                </div>  
               
                      
            </div>
      </div>
</div>
<?php } ?>