
<div class="app-content content" id="myID">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
             <form class="form" id="updateTrainer"  action="<?php echo base_url();?>admin/trainers/update_trainer">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Update Trainer</h4>
                            <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                              
                            <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="log_div">
                                                    <?php if(!empty($trainerData->profileImage)){?>
                                                  <img src="<?php echo base_url().ADMIN_PROFILE.$trainerData->profileImage;?>" id="pImg">
                                              <?php }else{?>
                                                <img src="<?php echo base_url().DEFAULT_IMAGE;?>" id="pImg">
                                              <?php }?>
                                                   <div class="text-center upload_pic_in_album">
                                                    <input  accept="images/*" class="inputfile hideDiv input_img2" id="file-1" name="profileImage" onchange="document.getElementById('pImg').src = window.URL.createObjectURL(this.files[0])" style="display: none;" type="file">
                                                        <label for="file-1" class="upload_pic">
                                                            <span class="ft-camera"></span>
                                                        </label>
                                                    </div>
                                                    <div id="profileImage-err"></div>
                                                </div>

                                                 <p style="color: gray;font-size: 11px;">Image should be at least 300*300px</p>
                                            </div>                                        
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput1">Name</label>
                                                <input type="text" id="complaintinput1" class="form-control round" placeholder="Name" name="TrainerName" value="<?php echo $trainerData->fullName;?>">
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput2">Email Id</label>
                                                 <input type="email" id="complaintinput2" class="form-control round" placeholder="Email Id" name="email" value="<?php echo $trainerData->email;?>" readonly>
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput3">Password</label>
                                                 <input type="text" id="complaintinput3" class="form-control round" placeholder="Password" name="password">
                                            </div>
                                            <input type="hidden" name="tid" value="<?php echo $trainerData->tId;?>">
                                            <input type="hidden" name="trainerMetaId" value="<?php echo $trainerData->trainerMetaId;?>">
                                            <!--  <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput3">Password</label>
                                                <input type="password" id="complaintinput3" class="form-control round" placeholder="Password" name="password">
                                            </div> -->
                                           <!--  <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput5">Complaint Details</label>
                                                <textarea id="complaintinput5" rows="5" class="form-control round" name="complaintdetails" placeholder="Details"></textarea>
                                            </div> --> 
                                            <div class="form-group col-12 mb-2">
                                                <fieldset class="form-group mb-0 mt-10">
                                                    <select class="custom-select round"  name="userPlan">
                                                        <option selected="" value="0">Select level</option>

                                        <option value="3" <?php if($trainerData->userPlan=='3'){ echo 'selected'; }?> >Level 3</option>
                                                        <option value="4"  <?php if($trainerData->userPlan=='4'){ echo 'selected'; }?> >Level 4</option>
                                                        <option value="3,4"  <?php if($trainerData->userPlan=='3,4'){ echo 'selected'; }?> >Both Level 3 and Level 4</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                           
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput5">Complaint Details</label>
                                                <textarea id="complaintinput5" rows="5" class="form-control round" name="details" placeholder="Bio" ><?php echo $trainerData->details;?></textarea>
                                            </div>
                                             <!-- <div class="form-group col-12 mb-2 prmte-trnr">
                                                <input type="checkbox" id="switchery2" class="switchery" name="promote" checked/>
                                                <label for="switchery" class="font-medium-2 text-bold-600 ml-1" >Promote Trainer</label>
                                            </div> -->

                                        </div>
                                    </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="form-group prmte-trnr">
                                    <?php if($trainerData->promote==0){
                                    $sh='1';
                                    $unck ="unchecked";
                                    }else{
                                       $sh='';
                                        $unck ="checked";
                                    }?>
                                    <span id="hideme" data-value="<?php echo $sh;?>">
                                    <input type="checkbox" id="switchery" class="switchery"  name="PersonaliseLink" <?php echo $unck;?>/>
                                   </span>
                                    <label for="switchery6" class="font-medium-2 text-bold-600 ml-1">Set Up Personalise link
                                    </label>
                                </div>
                                <?php if($trainerData->showSliderTrainer==0){
                                    $hideonline='unchecked';
                                }else{
                                      $hideonline='checked';
                                }
                                ?>
                                <div class="form-group prmte-trnr">
                                    <span>
                                    <input type="checkbox" id="switc" class="switchery"  name="showSliderTrainer" <?php echo $hideonline; ?>/>
                                   </span>
                                    <label for="switchery2" class="font-medium-2 text-bold-600 ml-1" >Hide for online coaching
                                    </label>
                                </div>
                              <!--   <form class="form"> -->
                                    <div class="form-body" id="personalLinkgh1">
                                        <div class="row">
                                            <?php 
                                            if($trainerData->trainerMetaShow==1){
                                                $sel='selected';
                                            }elseif($trainerData->trainerMetaShow==2){
                                                $sel1='selected';
                                            }else{
                                                $sel2='selected';
                                            }?>
                                            <div class="form-group col-12 mb-2">
                                                <label>Show Trainer in Trainer Online Coaching</label>
                                                <fieldset class="form-group mb-0 mt-10">
                                                    <select class="custom-select round"  name="showTrainer"">
                                                        <option <?php if(!empty($sel2)){ echo $sel2; }?> ="">Only Trainer</option>
                                                        <option <?php  if(!empty($sel)){ echo $sel; }?> value="1">Trainer Of first and 3-4 other</option>
                                                        <option <?php if(!empty($sel1)){ echo $sel1; }?> value="2">Trainer of first and all other</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <p class="col-12 head-bld">Commission</p>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">No Subscription</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionFree" value="<?php  echo $trainerData->commissionFree; ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">£</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 1</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                         <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel1" value="<?php  echo $trainerData->commissionLevel1; ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 2</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                         <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel2" value="<?php  echo $trainerData->commissionLevel2; ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">level 3 with same trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                       <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel3Same" value="<?php  echo $trainerData->commissionLevel3Same; ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 3 with other trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                         <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel3Other" value="<?php  echo $trainerData->commissionLevel3Other; ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">level 4 with same trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                       <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel4Same" value="<?php  echo $trainerData->commissionLevel4Same; ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 4 with other trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                         <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel4Other" value="<?php  echo $trainerData->commissionLevel4Other; ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="col-12 head-bld">Customer Discount</p>
                                           <!--  <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">No Subscription</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="rateperhour">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 1</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                      <!--     <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel1" value="<?php  echo $trainerData->discountLevel1; ?>"> -->
                                                        <select class="form-control round" name="discountLevel1">
                                                           <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                            <option value="<?php echo $value->couponId;?>"<?php if($trainerData->discountLevel1 ==$value->couponId){ echo "selected"; }?> ><?php echo $value->couponName;?></option>
                                                              <?php } }?>
                                                        </select>

                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 2</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                       <!--   <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel2" value="<?php  echo $trainerData->discountLevel2; ?>"> -->
                                                            <select class="form-control round" name="discountLevel2">
                                                            <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                            <option value="<?php echo $value->couponId;?>"<?php if($trainerData->discountLevel2 ==$value->couponId){ echo "selected"; }?> ><?php echo $value->couponName;?></option>
                                                              <?php } }?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">level 3 with same trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                <!--       <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel3Same" value="<?php  echo $trainerData->discountLevel3Same; ?>"> -->
                                                         <select class="form-control round" name="discountLevel3Same">
                                                            <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                            <option value="<?php echo $value->couponId;?>"<?php if($trainerData->discountLevel3Same ==$value->couponId){ echo "selected"; }?> ><?php echo $value->couponName;?></option>
                                                              <?php } }?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 3 with other trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                       <!--  <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel3Other" value="<?php  echo $trainerData->discountLevel3Other; ?>"> -->
                                                        <select class="form-control round" name="discountLevel3Other">
                                                            <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                            <option value="<?php echo $value->couponId;?>"<?php if($trainerData->discountLevel3Other ==$value->couponId){ echo "selected"; }?> ><?php echo $value->couponName;?></option>
                                                              <?php } }?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">level 4 with same trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                   <!--    <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel4Same" value="<?php  echo $trainerData->discountLevel4Same; ?>"> -->
                                                    <select class="form-control round" name="discountLevel4Same">
                                                        <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                            <option value="<?php echo $value->couponId;?>"<?php if($trainerData->discountLevel4Same ==$value->couponId){ echo "selected"; }?> ><?php echo $value->couponName;?></option>
                                                              <?php } }?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 4 with other trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group">
                                                     <!--    <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel4Other" value="<?php  echo $trainerData->discountLevel4Other; ?>"> -->
                                                          <select class="form-control round" name="discountLevel4Other">
                                                       <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                            <option value="<?php echo $value->couponId;?>"<?php if($trainerData->discountLevel4Other ==$value->couponId){ echo "selected"; }?> ><?php echo $value->couponName;?></option>
                                                              <?php } }?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text round">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="form-actions frm-btns mt-0">
                                        <a href="<?php echo base_url().'admin/trainers';?>" id="urlbase"  class="btn btn-danger mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="button" class="btn btn-primary" id="update_trainer"><i class="la la-check-square-o"></i>Update</button>
                                    </div>
                               <!--  </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
     $(document).ready(function(){
         var vr = $('#hideme').attr('data-value');
        // alert(vr);
 // $('#hideme').onload(function(){
    //alert();
    if(vr.length){
    $("#personalLinkgh1").toggle();
}
  });
//});
</script>