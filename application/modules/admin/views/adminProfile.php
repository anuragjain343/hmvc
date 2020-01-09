<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before">
        </div>
        <div class="content-header row mt-10"></div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-head">
                        <div class="align-self-center text-center p-1">
                            <span class="avatar avatar-lg avatar-online rounded-circle">
                                <?php 
                                if(!empty( $trainer->profileImage)){
                                        $fileName = base_url().TRAINER_PROFILE_THUMB.$trainer->profileImage;
                                    }else{
                                        $fileName =  base_url(). DEFAULT_IMAGE;
                                    }
                                 ?>
                                <img src="<?php echo $fileName; ?>">
                            </span>
                        </div>
                        <div class="text-center">
                            <span class="font-medium-3 text-uppercase admin-prfle-style"><?php echo $trainer->fullName;?></span>
                            <p class="blue-grey font-small-3"><?php echo $trainer->email;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="card">
                        <!-- <div class="card-header cstm-crd-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Edit Your Profile</h4>
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
                        </div> -->
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <ul class="nav cstm-nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Basic-tab" data-toggle="pill" href="#Basic" aria-expanded="true">Basic Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Videos-tab" data-toggle="pill" href="#Videos" aria-expanded="false">Change Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Recipes-tab" data-toggle="pill" href="#Recipes" aria-expanded="true">Settings</a>
                                    </li>
                                </ul>
                                <div class="tab-content px-1 pt-1">
                                    <div role="tabpanel" class="tab-pane active" id="Basic" aria-labelledby="Basic-tab" aria-expanded="true">
                                        <form class="form" action="<?php echo base_url('admin/editProfile')?>" method="post" id="editAdminProfile">
                                            <div class="form-body">
                                                <div class="row">  
                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align:center;">
                                                        <div class="log_div">
                                                            <img src="<?php echo $fileName;?>" id="pImg">
                                                            <div class="text-center upload_pic_in_album">
                                                                <input accept="image/*" class="inputfile hideDiv" id="file-1" name="profileImage" onchange="document.getElementById('pImg').src = window.URL.createObjectURL(this.files[0])" style="display: none;" type="file">
                                                                <label for="file-1" class="upload_pic">
                                                                    <span class="fa fa-camera"></span>
                                                                </label>
                                                            </div>
                                                            <div id="profileImage-err"></div>
                                                        </div>
                                                    </div>                                     
                                                    <div class="form-group col-12 mb-2">
                                                        <label class="sr-only" for="complaintinput1">Name</label>
                                                        <input type="text" id="complaintinput1" class="form-control round" placeholder="Name" name="name" value="<?php echo ucfirst($trainer->fullName);?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions frm-btns">
                                                <a href="<?php echo base_url('admin/adminProfile');?>" class="btn btn-danger mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
                                                <button type="button" class="btn btn-primary" id="updateAdminProfile">
                                                    <i class="la la-check-square-o"></i> Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="Videos" role="tabpanel" aria-labelledby="Videos-tab" aria-expanded="false">
                                        <form class="form" action="<?php echo base_url('admin/changePassword'); ?>" method="post" id="changePasswordForm">
                                            <div class="form-body">
                                                <!-- <div class="card-header cstm-crd-header3">
                                                    <h4 class="card-title" id="hidden-label-round-controls">Change Your Password</h4>
                                                </div> -->
                                                <div class="form-group mb-2">
                                                    <label class="sr-only" for="complaintinput">Old Password</label>
                                                    <input type="password" id="complaintinput" class="form-control round" placeholder="Old Password" name="oldPassword">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="sr-only" for="password">New Password</label>
                                                    <input type="password" id="password" class="form-control round" placeholder="New Password" name="newPassword">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="sr-only" for="complaintinput2">Confirm Password</label>
                                                    <input type="password" id="complaintinput2" class="form-control round" placeholder="Confirm Password" name="cNewPassword">
                                                </div>
                                            </div>
                                            <div class="form-actions frm-btns">
                                                <a href="<?php echo base_url('admin/adminProfile'); ?>" class="btn btn-danger mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </a>
                                                <button type="button" class="btn btn-primary updatePassword">
                                                    <i class="la la-check-square-o"></i> Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane " id="Recipes" role="tabpanel" aria-labelledby="Recipes-tab" aria-expanded="false">
                                        This Page is Under Working
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
            </div>
        </div>
      </div>
</div>