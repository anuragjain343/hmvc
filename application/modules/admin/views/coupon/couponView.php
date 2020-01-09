<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before">
			<h2 class="ml-2">Coupons  (<?php if(!empty($coupon)){ echo count($coupon);  }else{ echo '0'; } ?>)</h2>
            <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right mr-2" href="<?php echo base_url().'admin/coupon/addCoupon';?>">
                <span class="white">Add New</span>
                <i class="ft-bookmark pl-1 white"></i>
            </a>
        </div>
            <div class="content-header row mt-10"></div>
            <div class="row">
                <?php   if($coupon){ foreach( $coupon as $val ){ ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <section id="blockquotes-styling-default" class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card mrgn-tp-crd">
                                <div class="card-header pb">
                                    <h4 class="card-title fnt-sze-ttle"><?php echo $val->couponName;?><small class="text-muted"><?php //echo $val->planDuration;?> -<b><?php echo $val->duration;?></b></small></h4>
                                      <h4 class="card-title fnt-sze-ttle"><small class="text-muted"><?php echo $val->discountData.'%';?> <b>Off</b></small></h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a  href="<?php echo base_url().'admin/coupon/editCoupon/'.encoding($val->stripCouponId);?>">
                                                    <i class="ft-edit-2"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <!-- <a data-action="" onclick="deleteData('<?php echo $val->planId; ?>','<?php echo get_csrf_token()['hash'];?>','plan')">
                                                    <i class="ft-trash-2"></i>
                                           </a> -->
                <!--    <?php if($val->status==0){?>
                      <a ><i class="la la-check text-success" onclick="deleteData('<?php echo $val->stripCouponId; ?>','<?php echo get_csrf_token()['hash'];?>','activePlan','<?php echo $val->couponName;?>')"></i></a>
                    <?php }else{?>
                      <a ><i class="la la-times text-danger" onclick="deleteData('<?php echo $val->stripCouponId; ?>','<?php echo get_csrf_token()['hash'];?>','inactivePlan','<?php echo $val->couponName;?>')"></i></a>
                    <?php }?> -->
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
