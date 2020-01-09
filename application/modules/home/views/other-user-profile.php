<div class="wrapper">
  <section class="profileSec sec-pad-50">
    <div class="container">
      <div class="profileBlock">
        <div class="row justify-content-center">
          <div class="col-md-5 col-lg-5 col-sm-12">
            <div class="prInfo OtherInfo">
              <div class="prImg">
                <img src="<?php if(empty($userDetail->profileImage)){ echo base_url().DEFAULT_IMAGE; }else if($userDetail->userRole == 'admin'){ echo base_url().TRAINER_PROFILE_THUMB.$userDetail->profileImage; }else if($userDetail->userRole == 'user'){ echo base_url().USER_PROFILE_THUMB.$userDetail->profileImage; }else if($userDetail->userRole == 'trainer'){ echo base_url().TRAINER_PROFILE_THUMB.$userDetail->profileImage; } ?>">
              </div>
              <h2><?php if(!empty($userDetail->fullName)){ echo ucwords($userDetail->fullName); }else{ echo 'N/A'; } ?></h2>

              <?php if($userDetail->userRole == 'admin' ){ ?>

                <small> Admin </small>
                <div class="forumicon mt-10">
                  <div class="reciepIcons othertxt">
                    <span><p>Forum Posts</p><h4><?php echo $userDetail->forumCount; ?></h4></span>
                    <span><p>Article Posts</p><h4><?php echo $userDetail->articleCount; ?></h4></span>
                  </div>
                </div>

              <?php }else if($userDetail->userRole == 'trainer'){ ?>

                <div class="forumicon mt-10">
                  <div class="reciepIcons othertxt">
                    <span><p>Forum Posts</p><h4><?php echo $userDetail->forumCount; ?></h4></span>
                    <span><p>Article Posts</p><h4><?php echo $userDetail->articleCount; ?></h4></span>
                  </div>
                </div>

              <?php }else{ ?>

                <div class="forumicon mt-10">
                  <div class="reciepIcons othertxt">
                      <span><p>Membership</p><h4><?php if(!empty($userDetail->planId)){ echo $userDetail->planName; }else if(empty($userDetail->planId) && $userDetail->userPlan == 'free'){ echo 'Free'; } ?></h4></span>
                    <span><p>Forum Posts</p><h4><?php echo $userDetail->forumCount; ?></h4></span>
                  </div>
                </div>

              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>   
