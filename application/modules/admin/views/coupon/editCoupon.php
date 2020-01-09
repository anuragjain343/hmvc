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
                            <h4 class="card-title" id="hidden-label-round-controls">Edit Coupon</h4>
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
                                <div class="card-text">
                                    <p></p>
                                </div>
                               <form class="form" id="editCoupon" action="<?php echo base_url()?>admin/coupon/updateCoupon" method="POST">
                                    <div class="form-body">
                                        <div class="row">
                                          <input type="hidden" name="stripCouponId" id="stripCouponId" value="<?php echo $coupon->stripCouponId;?>" >                                       
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput1">Enter Title</label>
                                                <input type="text" id="couponName" class="form-control round" placeholder="Title" name="couponName" value="<?php echo $coupon->couponName;?>">
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="amount">Enter Percentage</label>
                                                <input value="<?php echo $coupon->discountData.'%';?>" type="text" id="percentage" class="form-control round decimal_only" placeholder="Percentage(%)" name="percentage" readonly>
                                            </div>
<!--                                             <div class="form-group col-12 mb-2" hidden>
                                                <label class="sr-only" for="complaintinput1">Enter Duration</label>
                                                <input value="<?php echo $coupon->duration;?>" type="text" id="duration" class="form-control round" placeholder="Duration" name="duration" readonly>
                                            </div> -->

                                            <div class="clearfix"></div>
              <!--                               <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="couponDescription">Enter Description</label>
                                               <textarea id="couponDescription" rows="5" class="form-control round"  placeholder="Description" name="couponDescription"></textarea readonly>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="form-group frm-btns">
                                        <a href="<?php echo base_url().'admin/coupon';?>" type="button" class="btn btn-danger mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="button" id="update_coupon" class="btn btn-primary">
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

</script>
