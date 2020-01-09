<?php // print_r();die;?>
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
                            <h4 class="card-title" id="hidden-label-round-controls">Add Membership</h4>
                            <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                       <!--  <a data-action="reload">
                                            <i class="ft-rotate-cw"></i>
                                        </a> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="card-text">
                                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> -->
                                </div>
                               <form class="form" id="addPlan" action="<?php echo base_url()?>admin/membership/addPlan" method="POST" autocomplete="off">
                                    <div class="form-body">
                                        <div class="row">                                       
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput1">Enter Title</label>
                                                <input type="text" id="title" class="form-control round" placeholder="Title" name="title" maxlength="50">
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <fieldset class="form-group mb-0">
                                                    <select class="custom-select round" id="planLevel" name="planLevel">
                                                        <option value="">Select Level</option>
                                                         <?php
                                                          $lev = get_plan_level();
                                                           if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole'] =='trainer'){
                                                                unset($lev[1]);             
                                                                unset($lev[2]);            
                                                           }
                                                          
                                                         foreach($lev as $k=>$v){ 
                                                        echo '<option value="'.$k.'">'.$v.'</option>';
                                                        }?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <fieldset class="form-group mb-0">
                                                    <select class="custom-select round" id="planType" name="planType">
                                                        <option value="">Select Plan</option>
                                                        <?php foreach(get_membership_month() as $k=>$v){ 
                                                        echo '<option value="'.$k.'">'.$v.'</option>';
                                                        }?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <fieldset class="form-group mb-0">
                                                    <select class="custom-select round" id="discountCoupon" name="discountCoupon">
                                                        <option value="">Discount For No Referral Link </option>
                                                        <?php if(!empty($coupon)){
                                                            foreach($coupon as $coupons){ 
                                                            echo '<option value="'.$coupons->stripCouponId.'">'.$coupons->couponName.'</option>';
                                                            } 
                                                        } ?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                             <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="amount">Enter Amount</label>
                                                <input type="text" id="amount" class="form-control round decimal_only" placeholder="Amount" name="amount">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="planDescription">Enter Description</label>
                                               <textarea id="planDescription" rows="5" class="form-control round"  placeholder="Description" name="planDescription"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group frm-btns">
                                        <a href="<?php echo base_url().'admin/membership';?>" type="button" class="btn btn-danger mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="button" id="add_plan" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Save
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
