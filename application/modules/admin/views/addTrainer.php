
<div class="app-content content" id="myID">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
             <form class="form" id="addTrainer" action="<?php echo base_url();?>admin/trainers/add_trainer" autocomplete="off">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Add New Trainer</h4>
                            <!-- <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <!-- <form class="form"> -->
                                    <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>"  >
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="log_div">
                                                  <img src="<?php echo base_url().DEFAULT_IMAGE;?>" id="pImg">
                                                   <div class="text-center upload_pic_in_album">
                                <input  accept="images/*" class="inputfile hideDiv input_img2" id="file-1" name="profileImage" onchange="return fileValidation();" style="display: none;" type="file">
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
                                                <input type="text" id="complaintinput1" class="form-control round" placeholder="Name" name="TrainerName"  autocomplete="off">
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput2">Email Id</label>
                                                 <input type="email" id="complaintinput2" class="form-control round" placeholder="Email Id" style="background: white;"name="email"readonly onfocus="this.removeAttribute('readonly');">
                                            </div>
                                             <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput3">Password</label>
                                                <input type="password" id="complaintinput3" class="form-control round" placeholder="Password" name="password"  autocomplete="off">
                                            </div>
                                           <!--  <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput5">Complaint Details</label>
                                                <textarea id="complaintinput5" rows="5" class="form-control round" name="complaintdetails" placeholder="Details"></textarea>
                                            </div> --> 
                                            <div class="form-group col-12 mb-2">
                                                <fieldset class="form-group mb-0 mt-10">
                                                    <select class="custom-select round"  name="userPlan">
                                                        <option selected value="0">Select level</option>
                                                        <option value="3">Level 3</option>
                                                        <option value="4">Level 4</option>
                                                        <option value="3,4">Both Level 3 and Level 4</option>
                                                    </select>
                                                </fieldset>
                                            </div>
 
                                          


                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput5">Complaint Details</label>
                                                <textarea id="complaintinput5" rows="5" class="form-control round" name="details" placeholder="Bio"></textarea>
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
                                    <span id="hideme">
                                    <input type="checkbox" id="switchery1" class="switchery"  name="PersonaliseLink" checked/>
                                   </span>
                                    <label for="switchery" class="font-medium-2 text-bold-600 ml-1">Set Up Personalise link
                                    </label>
                                </div>
                                <div class="form-group prmte-trnr">
                                    <span>
                                    <input type="checkbox" id="switc" class="switchery"  name="showSliderTrainer"/>
                                   </span>
                                    <label for="switchery" class="font-medium-2 text-bold-600 ml-1" >Hide for online coaching
                                    </label>

                                </div>
                                  <div class="form-group prmte-trnr">
                                    <span>
                                    <input type="checkbox" id="switc1" class="switchery"  name="privileges" checked/>
                                   </span>
                                    <label for="switchery" class="font-medium-2 text-bold-600 ml-1" > All privileges
                                    </label>
                                    
                                </div>
                              <!--   <form class="form"> -->
                                    <div class="form-body" id="personalLinkgh1">
                                        <div class="row">
                                            <div class="form-group col-12 mb-2">
                                                <label>Show Trainer in Trainer Online Coaching</label>
                                                <fieldset class="form-group mb-0 mt-10">
                                                    <select class="custom-select round"  name="showTrainer"">
                                                        <option selected="">Only Trainer</option>
                                                        <option value="1">Trainer Of first and 3-4 other</option>
                                                        <option value="2">Trainer of first and all other</option>
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
                                                        <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionFree">
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
                                                         <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel1">
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
                                                         <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel2">
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
                                                       <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel3Same">
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
                                                         <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel3Other">
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
                                                       <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel4Same">
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
                                                         <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="commissionLevel4Other">
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
                                                    <div class="input-group Inpfnt">
                                                        <!--   <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel1"> -->
                                                        <select class="form-control round" name="discountLevel1">
                                                           <option>Select Coupons</option>

                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                                    <option value="<?php echo $value->couponId;?>">

                        <?php echo $value->couponName.' ('.$value->discountData.'%)';?></option>
                                                              <?php } }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 2</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group Inpfnt">
                                                        <!--  <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel2"> -->
                                                         <select class="form-control round" name="discountLevel2">
                                                           <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                                                            <option value="<?php echo $value->couponId;?>"><?php echo $value->couponName .' ('.$value->discountData.'%)';?></option>
                                                              <?php } }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">level 3 with same trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group Inpfnt">
                                                     <!--  <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel3Same"> -->
                                                      <select class="form-control round" name="discountLevel3Same">
                                                           <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                                                            <option value="<?php echo $value->couponId;?>"><?php echo $value->couponName .' ('.$value->discountData.'%)';?></option>
                                                              <?php } }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 3 with other trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group Inpfnt">
                                                     <!--    <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel3Other"> --> <!--  <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel4Other"> -->
                                                      <select class="form-control round" name="discountLevel3Other">
                                                            <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                                                            <option value="<?php echo $value->couponId;?>"><?php echo $value->couponName .' ('.$value->discountData.'%)';?></option>
                                                              <?php } }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">level 4 with same trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group Inpfnt">
                                                     <!--  <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel4Same"> -->
                                                      <select class="form-control round" name="discountLevel4Same">
                                                            <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                                                            <option value="<?php echo $value->couponId;?>"><?php echo $value->couponName .' ('.$value->discountData.'%)';?></option>
                                                              <?php } }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 form-group">
                                                <div class="col-lg-7">
                                                    <label class="label-control lne-hgt-lbl">Level 4 with other trainer</label>
                                                </div>
                                                <div class="col-lg-5 pr-0">
                                                    <div class="input-group Inpfnt">
                                                       <!--  <input type="text" class="form-control round" placeholder="Enter" aria-label="Amount (to the nearest dollar)" name="discountLevel4Other"> -->
                                                        <select class="form-control round" name="discountLevel4Other">
                                                            <option>Select Coupons</option>
                                                            <?php if(!empty($allCoupons)){ foreach($allCoupons as $value){?>
                                                            <option value="<?php echo $value->couponId;?>"><?php echo $value->couponName.' ('.$value->discountData.'%)';?></option>
                                                            <?php } }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="form-actions frm-btns mt-0">
                                        <a href="<?php echo base_url().'admin/trainers';?>" id="urlbase"  class="btn btn-danger mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                            <button type="button" class="btn btn-primary" id="add_trainer"><i class="la la-check-square-o"></i>Add</button>
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
   

 
function fileValidation(){
    var fileInput = document.getElementById('file-1');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
         toastr.error('Please upload file having extensions .jpeg/.jpg/.png/.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {

            var reader = new FileReader();
            reader.onload = function(e) {
             document.getElementById('pImg').src = window.URL.createObjectURL(fileInput.files[0]);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

</script>