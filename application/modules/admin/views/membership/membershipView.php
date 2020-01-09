<?php  $lev = get_plan_level(); ?>
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before">
            <h2 class="ml-2">Membership Plans  (<?php if(!empty($plan)){ echo count($plan);  }else{ echo '0'; } ?>)</h2>
            <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
            <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right mr-2" href="<?php echo base_url().'admin/membership/addMembership';?>">
                <span class="white">Add New</span>
                <i class="ft-users pl-1 white"></i>
            </a>
             <?php }?>
        </div>
            <div class="content-header row mt-10"></div>
            <div class="row">
                <?php   if($plan){ foreach( $plan as $val ){ ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <section id="blockquotes-styling-default" class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card mrgn-tp-crd">
                                <div class="card-header pb">
                                    <h4 class="card-title fnt-sze-ttle">£<?php echo $val->amount;?>/<small class="text-muted"><?php echo $val->planDuration;?> -<b><?php echo limit_text($val->planName,10);?></b></small>
                                   <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
                                   <small class="text-muted">Added By -<b><?php echo limit_text($val->fullName,10);?></b></small>
                                   <?php }?>
                                    </h4>
                                    <h4 class="card-title fnt-sze-ttle">
                                      <small>Default Coupon:</small>
                                      <span class="text-muted"><small><?php if(!empty($val->couponName)){ echo $val->couponName; }else{ echo 'N/A'; } ?></small></span>
                                    </h4>
                                    <h4 class="card-title fnt-sze-ttle"><small class="text-muted"><?php echo $lev[$val->planLevel];?> </small>
                                    </h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                               <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
                                                <a  href="<?php echo base_url().'admin/membership/editMembership/'.encoding($val->planId);?>">
                                                    <i class="ft-edit-2"></i>
                                                </a>
                                              <?php }?>
                                            </li>
                                            <li>
                                                <!-- <a data-action="" onclick="deleteData('<?php echo $val->planId; ?>','<?php echo get_csrf_token()['hash'];?>','plan')">
                                                    <i class="ft-trash-2"></i>
                                           </a> -->
                   <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
                        if($val->status==0){ ?>
                      <a ><i class="la la-check text-success" onclick="deleteData('<?php echo $val->stripPlanId; ?>','<?php echo get_csrf_token()['hash'];?>','activePlan','<?php echo $val->planLevel;?>','<?php echo $val->createdBy;?>','<?php echo $val->createdById;?>')"></i></a>
                    <?php }else{?>
                      <a ><i class="la la-times text-danger" onclick="deleteData('<?php echo $val->stripPlanId; ?>','<?php echo get_csrf_token()['hash'];?>','inactivePlan','<?php echo $val->planLevel;?>','<?php echo $val->createdBy;?>','<?php echo $val->createdById;?>')"></i></a>
                    <?php } } ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <?php echo $val->description;?>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php } }else{   ?>
<!--                     <div class="col-lg-6 col-md-6 col-sm-12">
                        
                    <section id="blockquotes-styling-default" class="row">
                         <div class="col-sm-12 col-md-12">
                            <div class="card mrgn-tp-crd">
                                <div class="card-header pb">
                        <p>
                         <?php // echo 'No record found.'; ?>
                       </p>
                   </div>
               </div>
           </div>
                    </section>
                    </div> -->
                    <?php }?>
                         
            </div>
      </div>
</div>
