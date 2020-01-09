<?php  $lev = get_plan_level(); ?>

<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before">
        </div>
            <div class="content-header row mt-10"></div>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Edit Membership</h4>
                            <a class="heading-elements-toggle">
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
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <!-- <div class="card-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                </div> -->
                               <form class="form" id="editPlan" action="<?php echo base_url()?>admin/membership/updatePlan" method="POST">
                                    <div class="form-body">
                                        <div class="row">  
                                           <input type="hidden" name="stripPlanId" id="stripPlanId" value="<?php echo $plan->stripPlanId;?>">                                     
                                           <input type="hidden" name="createdBy" id="createdBy" value="<?php echo $plan->createdBy;?>">                                     
                                           <input type="hidden" name="createdById" id="createdById" value="<?php echo $plan->createdById;?>">                                     
                                           <input type="hidden" name="planLevel" id="planLevel" value="<?php echo $plan->planLevel;?>">                                     
                                           <input type="hidden" name="typ" id="typ" value="<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];?>">                                     
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput1">Enter Title</label>
                                                <input type="text" id="title" maxlength="50" class="form-control round" placeholder="Title" name="title" value="<?php echo $plan->planName;?>" <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){ echo 'readonly'; }?>   >
                                            </div>
                                           <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput1">Select Level</label>
                                                <input  value="<?php echo $lev[$plan->planLevel];?>" type="text" id="planLevel1" class="form-control round" placeholder="plan" name="planLevel1" readonly>
                                            </div>
                                             <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput1">Select Plan</label>
                                                <input  value="<?php echo $plan->planDuration;?>" type="text" id="planType" class="form-control round" placeholder="plan" name="planType" readonly>
                                            </div>
                                           
                                             <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="amount">Enter Amount</label>
                                                <input value="<?php echo $plan->amount;?>"  type="text" id="amount" class="form-control round decimal_only" placeholder="Amount" name="amount" <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ echo 'readonly'; }?>  >
                                            </div>

                                            <div class="form-group col-12 mb-2">
                                                <fieldset class="form-group mb-0">
                                                    <select class="custom-select round" id="commonDiscount" name="commonDiscount">
                                                        <option value="">Discount For No Referral Link </option>
                                                        <?php if(!empty($coupon)){
                                                            foreach($coupon as $coupons){ ?>
                                                            <option value="<?php echo $coupons->stripCouponId; ?>" <?php if($coupons->stripCouponId == $plan->defaultCouponStripeId){ echo 'selected'; } ?> ><?php echo $coupons->couponName; ?></option>
                                                        <?php } 
                                                        } ?>
                                                    </select>
                                                </fieldset>
                                            </div>


                                            <div class="clearfix"></div>
                                              <?php ?>
                                            <div class="<?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){echo 'hidden'; } ?>">
                                                <div class="form-group col-12 mb-2">
                                                    <label class="sr-only" for="planDescription">Enter Description</label>
                                                   <textarea id="planDescription" rows="5" class="form-control round"  placeholder="Description" name="planDescription"><?php echo $plan->description;?></textarea>
                                                </div>
                                               <div class="clearfix"></div>
                                                <div class="form-group col-12 mb-2">
                                                    <label class="mr-1" for="complaintinput6">Status</label>
                                                    <label class="radio-inline"><input type="radio" name="radio" value="1" <?php if($plan->status=='1'){ echo "checked"; }?> >Active</label>
                                                    <label class="radio-inline"><input type="radio" name="radio" value="0" <?php if($plan->status=='0'){ echo "checked"; }?>  >Inactive</label>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="form-group frm-btns">
                                        <a href="<?php echo base_url().'admin/membership';?>" type="button" class="btn btn-danger mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="button" id="update_plan" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Update
                                        </button>
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
    CKEDITOR.replace('planDescription',{
        removePlugins: ','
    });
</script>