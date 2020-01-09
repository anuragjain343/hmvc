
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10 col-md-12">
                    <div class="card back-img">
                        <form id="editTrainerProfile" class="form" action="<?php echo base_url()?>admin/trainers/edit_trainer_profile" method="post">
                        <div class="card-body">
                            <div class="heading-elements uload-bnr-pic">
                                <div class="bannerImage">
                                    <?php if(!empty($trainer->bannerImage)){ $link = BANNER_IMAGE.$trainer->bannerImage;}else{ $link = BANNER_DEFAULT;  }?>
                                    <img src="<?php echo base_url($link);?>" id="bannerImg">
                                </div>
                                <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right btnCs" >
                                    <label id="banner_lable" class="white">Upload Banner Picture</lable>
                                <input id="banner_image" name="banner_image" accept="image/jpeg,image/x-png" style="display:none;" type="file" onchange="document.getElementById('bannerImg').src = window.URL.createObjectURL(this.files[0])">
                                    <i class="ft-image pl-1 white"></i>
                                </a>
                            </div>
                            <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                            <?php if(!empty($trainer->profileImage)){ $plink = TRAINER_PROFILE_THUMB.$trainer->profileImage;}else{ $plink = DEFAULT_IMAGE;  }?>
                            <div class="TrainerInfo">
                            <div class="card-head my-1">
                                <div class="log_div" id="logo_pic">
                                    <img src="<?php echo base_url($plink)?>" id="pImg">
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
                            <div class="list-group">
                                <!-- <a href="#" class="list-group-item trainr-prfle active">Basic Info</a> -->
                                <div class="infoBlock form-group">
                                  <label>Full Name</label>
                                  <input type="text" id="complaintinput1" class="form-control round" placeholder="Name" name="name" value="<?php echo $trainer->fullName; ?>">
                                </div>
                                <div class="infoBlock">
                                  <label>Email</label>
                                  <input type="text" id="email" class="form-control round" placeholder="Name" name="email" value="<?php echo $trainer->email; ?>" readonly>
                                </div>
                                <div class="infoBlock">
                                  <label>Bio</label>
                                  <textarea id="complaintinput5" rows="5" class="form-control round"  placeholder="Description" name="details" ><?php echo $trainer->details; ?></textarea>
                                </div>
                            </div>                           
                            </div>        
                            <input type="hidden" name="userId" value="<?php echo $trainer->id;?>">                   
                        <div class="form-actions frm-btn">
                            <a href="<?php echo base_url();?>admin/dashboard" class="btn btn-danger mr-1">
                                <i class="ft-x"></i> Cancel
                                        </a>
                            <button type="button" class="btn btn-primary" id="editTrainer"> <i class="la la-check-square-o"></i>Update</button>
                        </div>
                        </div>
                    </form>
                    </div>
                    
                </div>
            </div>
      </div>
</div>
