
<style type="text/css">
  .morecontent span {
  display: none;
}
</style>

<div class="wrapper">
<section class="profileSec sec-pad-50">
   <div class="container">
    <div class="profileBlock">
      <div class="row">
        <div class="col-md-4 col-sm-12">
          <div class="prInfo">
            <div class="editIcon"><a id="profileEdit" href="javascript:void(0);"><i class="fa fa-edit"></i></a></div>
            <div class="log_div prImg">
            <?php if(!empty($userDetail->profileImage)){ ?>
              <img src="<?php echo base_url().USER_PROFILE_THUMB.$userDetail->profileImage; ?>">
            <?php }else{ ?>
              <img src="<?php echo base_url().DEFAULT_IMAGE; ?>">
            <?php } ?>
            <div class="text-center upload_pic_in_album"> 
                <input accept="image/*" class="inputfile hideDiv" id="file-1" name="profileImage"  style="display: none;" type="file" >
                <label for="file-1" class="upload_pic">
                <span class="fa fa-camera"></span></label>
            </div>
            </div>
            <h2><?php if(!empty($userDetail->fullName)) echo ucwords($userDetail->fullName); ?></h2>
            <p><?php if(!empty($userDetail->email)) echo $userDetail->email; ?></p>
            <a href="<?php echo base_url();?>home/userLogout" class="btn btn-theme btn-bg-t mt-10">Logout</a>
          </div>
        </div>
        <div class="col-md-8 col-sm-12">
          <div class="prCnt">
            <div class="menuTab">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="chnagePassword-tab" data-toggle="tab" href="#changePassword" aria-expanded="false">Change Password</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="membership-tab" data-toggle="tab" href="#membership" role="tab" aria-controls="membership" aria-selected="false">Membership</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="myTrainer-tab" data-toggle="tab" href="#myTrainer" role="tab" aria-controls="myTrainer" aria-selected="false">My Trainer Info</a>
                </li>
               <!--  <li class="nav-item">
                  <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                </li> -->
              </ul>
            </div>
            <div class="menuCnt">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="basicInfo" aria-labelledby="basicInfo-tab">
                  <div class="BasicInfo formField">
                    <form action="<?php echo base_url('home/users/updateProfile'); ?>" method="post" class="form" id="editUserProfile">
                      <div class="infoBlock lsForm">
                        <label>Full Name</label>
                        <p><?php if(!empty($userDetail->fullName)) echo ucwords($userDetail->fullName); ?></p>
                        <div class="form-group editField">
                          <input type="text" name="fullName" class="form-control" value="<?php if(!empty($userDetail->fullName)) echo ucwords($userDetail->fullName); ?>">
                        </div>
                      </div>
                      <div class="infoBlock lsForm">
                        <label>Email</label>
                        <p><?php if(!empty($userDetail->email)) echo ucwords($userDetail->email); ?></p>
                        <div class="form-group editField">
                          <input type="email" name="email" class="form-control" value="<?php if(!empty($userDetail->email)) echo ucwords($userDetail->email); ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group mt-20 editField">
                        <button type="button" id="updateUser" class="btn btn-theme btn-bg-t">Update</button>
                        <button id="cancelEdit" type="button" class="btn btn-theme btn-bg-b">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab" aria-expanded="false">
                <div class="BasicInfo formField">
                  <form class="form" action="<?php echo base_url('home/users/changeUserPassword'); ?>" method="post" id="changePasswordform">
                      <div class="form-body">
                          <!-- <div class="card-header cstm-crd-header3">
                              <h4 class="card-title" id="hidden-label-round-controls">Change Your Password</h4>
                          </div> -->
                          <div class="form-group mt-20 ">
                              <label class="sr-only" for="complaintinput">Old Password</label>
                              <input type="password" id="complaintinput" class="form-control round" placeholder="Old Password" name="oldPassword">
                          </div>
                          <div class="form-group mt-20">
                              <label class="sr-only" for="password">New Password</label>
                              <input type="password" id="password" class="form-control round" placeholder="New Password" name="newPassword">
                          </div>
                          <div class="form-group mt-20">
                              <label class="sr-only" for="complaintinput2">Confirm Password</label>
                              <input type="password" id="complaintinput2" class="form-control round" placeholder="Confirm Password" name="cNewPassword">
                          </div>
                      </div>
                      <div class="form-group mt-20">
                          <button type="button" class="btn btn-theme btn-bg-t updateUserPassword">Update</button>
                          <a href="<?php echo base_url('home/users/userProfile'); ?>" class="btn btn-theme btn-bg-b changePswdcan">Cancel</a>
                      </div>
                      
                  </form>
                </div>
                </div>
                
                <div role="tabpanel" class="tab-pane fade" id="membership" aria-labelledby="membership-tab">
                  <?php if(!empty($planInfo->planId)){ ?>
                  <div class="activatedPlan">
                    <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title"><?php echo ucfirst($planInfo->planName); ?></h3>
                     <div class="dollarPrice">£<?php echo $planInfo->amount; ?>/<span><?php echo ucfirst($planInfo->planDuration); ?></span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                        <div class="more">
                          <?php
                          echo $planInfo->description; ?>
                          </div>
                        </ul>
                     </div>
                      <h3 class="pricing-title"><?php if(!empty($planInfo->userPlan)){ echo ucfirst($planInfo->userPlan); } ?></h3>
                     <div class="planMeta">
                        <div class="float-right">
                          <!-- <a href="javascript:void(0);" onclick="myFunction()" id="myBtn">Read More</a> -->
                          <a href="javascript:void(0);" id='next'>Read More</a>
                        </div>
                     </div>
                    </div>
                  </div>                  
                  <div class="planMeta planMetaTxt">
                    <div class="float-left">
                      <?php if($remaning_days=='1'){?>
                      <p><?php echo $remaning_days; ?> day are remaining to expire</p>
                    <?php }else{?>
                       <p><?php echo $remaning_days; ?> days are remaining to expire</p>
                    <?php }?>
                    </div>
                    <div class="float-right">
                      <a href="javascript:void(0);" class="textLinkbtn btn btn-theme btn-bg-t" id="stopRecurring">Stop Recurring</a>
                    </div>
                   </div>
                  <?php }else{?>
                    
                  <div class="col-lg-12 text-center"><br>
                  <h5>You are free user please upgrade your plan.</h3>  
                  <a href="<?php echo base_url();?>home/membership" class="btn btn-theme btn-bg-t mt-3" type="button">Upgrade</a>
                  </div>
                  <?php }?>
                </div>
                 
                 
                <div role="tabpanel" class="tab-pane fade" id="myTrainer" aria-labelledby="myTrainer-tab">
                  <div class="mytrainer mt-30">
                    <div class="row">
                      <div class="col-lg-12">

                      <?php if(!empty($trainerInfo) AND !empty($trainerInfo->id AND $trainerInfo->id!=1)){ ?>
                        <div class="media myTrainerBlock">
                        
                      <?php if(!empty($trainerInfo->profileImage)){ ?>
                          <img class="mr-3" src="<?php echo base_url().TRAINER_PROFILE_THUMB.$trainerInfo->profileImage; ?>" alt="">
                        <?php }else{ ?>
                          <img class="mr-3" src="<?php echo base_url().DEFAULT_IMAGE; ?>" alt="">
                        <?php } ?>
                          <div class="media-body myTrainerinfo">
                          
                            <h2><a href="#"><?php if(!empty($trainerInfo->fullName)) echo ucwords($trainerInfo->fullName); ?></a></h2>
                            <p class="jobTitle">Trainer</p>
                            <p class="paraText"><?php if(!empty($trainerInfo->details)){ echo ucwords($trainerInfo->details); }else{ echo 'N/A'; } ?></p>
                            <div class="text-right">
                              <a href="<?php echo base_url('home/trainers/myTrainerProfile/').encoding($trainerInfo->id) ?>" class="btn btn-theme btn-bg-t">View Details</a>
                            </div>
                          </div>
                        </div><?php }else{ ?>
                          <center><h2 style="font-size: 20px;color: #757575;margin-top: 65px">No Trainer Selected</h2></center>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings" aria-labelledby="settings-tab">
                  <div class="text-center">
                    <h2 style="font-size: 20px; color: #757575; margin-top: 80px;">This Page is Under Working</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   </div>
</section>
</div>
<script>
 $(document).ready(function(){
  $("#profileEdit").click(function(){
      $(".BasicInfo").addClass("editProfile");
  });
  $("#cancelEdit").click(function(){
      $(".BasicInfo").removeClass("editProfile");
  });

  $("#profileEdit").click(function() {
  $('html,body').animate({
    scrollTop: $(".BasicInfo").offset().top - 80},
  'slow');
  });

  // For profile pic uploading
    $('#file-1').change(function(){
      toastr.remove();
      var file_data = $('#file-1')[0].files[0];
      var imgSrc=window.URL.createObjectURL(this.files[0])

      var form_data = new FormData();
      form_data.append("profileImage", file_data);
      $.ajax({
        url:base_url+"home/users/uploadUserImage",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
      error: function(){
        hide_loader(); 
        toastr.error("Request timeout");
        },
      beforeSend: function () { 
          show_loader(); 
        },
        success: function(data){
          hide_loader(); 

          var res =JSON.parse(data);
          if(res.status==-1){
              toastr.error(res.msg);
              window.setTimeout(function () {
                    window.location.href = res.url;
              }, 1000); 
          }  
          if (res.status == 1){ 
            $('#files').val("");
            //$('#pImg').attr('src',imgSrc);
            toastr.success(res.message); 
            window.setTimeout(function () {
              window.location.href = res.url;
            }, 500);
          }else if(res.status== 0){
            toastr.error(res.message); 
          }else{
            toastr.error(res.message); 
         }
        }
      });

    });

  //read more
    var Count = $(".more").children().length;
    var $lis = $(".more").children().hide();
    $lis.slice(0, 2).show();
    var size_li = $lis.length;
    console.log(size_li);
    var x = 2,
    start = 0;
    if(size_li <= x){
      $("#next").hide();
    }
    $('#next').click(function () {
      if($("#next").hasClass('read-less')){
        var $lis = $(".more").children().hide();
        $lis.slice(0, 2).show();
        $("#next").text('Read More');
        $("#next").removeClass('read-less');
      }else{
        if (start + x < size_li) {
            $(".more").children().show();
            $("#next").text('Read Less');
            $("#next").addClass('read-less');
        }
      }
    });
    
});

  $('#stopRecurring').click(function(){
      toastr.remove();
      $.ajax({
        url:base_url+"home/subscription/stopRecurring",
        cache: false,
        contentType: false,
        processData: false,
        //data: form_data,
        type: 'post',
      error: function(){
        hide_loader(); 
        toastr.error("Request timeout");
        },
      beforeSend: function () { 
          show_loader(); 
        },
        success: function(data){
          hide_loader(); 
          var res =JSON.parse(data);
         // alert(res);
          if(res.status==0){
              toastr.error(res.msg);
              window.setTimeout(function () {
                    window.location.href = res.url;
              }, 1000); 
          }else { 
            toastr.success(res.msg); 
            //$('#stopRecurring').hide();
            window.setTimeout(function () {
              window.location.href = res.url;
            }, 500);
          }
        }
      });
    });
</script>
  