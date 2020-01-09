<?php if((isset($trainerplans))){ 
 ?>
      <section class="planSec sec-pad-70">
    <div class="container">
       <div class="section-title text-center sec-arrow-dark">
              <h4>Membership</h4>
              <h2>Join Our Membership</h2>  
          </div>
          <div class="pricing-wrapper clearfix">
         <div class="row">
             <?php   if($trainerplans){ foreach($trainerplans as $val){ ?>
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title"><?php echo get_plan_level()[$val->planLevel];?></h3>
                
                   <div class="dollarPrice"><del>£<?php echo $val->amount;?>/</del>
                    <span><?php echo $val->planDuration;?></span></br> 

                  <?php if($val->planLevel=='1'){?>
                  £<?php echo round($totalLavel1,2);?>/ 
                  <span><?php echo $val->planDuration;?></span>
                  <?php }?>

                   <?php if($val->planLevel=='2'){?>
                  £<?php echo round($totalLavel2,2);?>/ 
                  <span><?php echo $val->planDuration;?></span>
                  <?php }?>

                  <?php if($val->planLevel=='3'){?>
                  £<?php echo round($totalLavel3Same,2);?>/ 
                  <span><?php echo $val->planDuration;?></span>
                  <?php }?>

                  <?php if($val->planLevel=='4'){?>
                  £<?php echo round($totalLavel4Same,2);?>/ 
                  <span><?php echo $val->planDuration;?></span>
                  <?php }?>
                  


                  </div>
                     <div class="listStyle">
                       <?php echo $val->description;?>
                     </div> 
                  </div>
                  <div class="table-buy">

                     <?php if($val->planLevel=='1' OR $val->planLevel=='2'){ ?>
         
                    <?php if($val->planLevel=='1'){?>
                       
                     <p>£<?php echo round($totalLavel1,2);?><span>/M</span></p>
                     <a class="btn btn-theme btn-bg-t btn-round" href="javascript:void(0);" onclick="isRegister('<?php echo base_url();?>home/users/payment?level=<?php echo $val->planLevel;?>&price=<?php echo encoding($totalLavel1);?>&trainer=<?php echo encoding(1);?>&stripPlanId=<?php echo $val->stripPlanId;?>&commisitionTrainer=<?php echo encoding($trainerId);?>&couponsId=<?php echo encoding($coupon1);?>&discountData=<?php echo encoding($coupon1Dis);?>&duration=<?php echo encoding($val->planDuration);?>','');">Join Now</a>
                  <?php }?>
                  <?php if($val->planLevel=='2'){?>
                     
                     <p>£<?php echo round($totalLavel2,2);?><span>/M</span></p>
                     <a class="btn btn-theme btn-bg-t btn-round" href="javascript:void(0);" onclick="isRegister('<?php echo base_url();?>home/users/payment?level=<?php echo $val->planLevel;?>&price=<?php echo encoding($totalLavel2);?>&trainer=<?php echo encoding(1);?>&stripPlanId=<?php echo $val->stripPlanId;?>&commisitionTrainer=<?php echo encoding($trainerId);?>&couponsId=<?php echo encoding($coupon2);?>&discountData=<?php echo encoding($coupon1Dis);?>&duration=<?php echo encoding($val->planDuration);?>','');">Join Now</a>
                  <?php }?>
                     <?php }else{ ?>

                      <div class="priceBlock">
                      <?php if($val->planLevel=='3'){?>
                         <p>£<?php echo round($totalLavel3Same,2);?><span>/<?php echo $val->planDuration;?></span></p>

                      <?php }?>

                      <?php if($val->planLevel=='4'){?>
                         <p>£<?php echo round($totalLavel4Same,2);?><span>/<?php echo $val->planDuration;?></span></p>
                      <?php }?>
                    
                      <h6 class="on-txt">Onwards</h6>
                      </div>
                   <a class="btn btn-theme btn-bg-t btn-round"  href="<?php echo base_url();?>home/trainers?level=<?php echo $val->planLevel;?>">Join Now</a>
              
                  <?php }?>


                  </div>
               </div>
            </div>
           <?php } }else{ ?>

     <div class="wrapper">
      <h3>No Plan Found</h3> 
    </div>
           <?php }?>
         </div>
      </div>
      <?php if(empty($_SESSION[USER_SESS_KEY]['userId'])){?>
          <div class="row">
            <div class="col-lg-12 mt-3 text-right">
               <!-- <a class="SignLink" href="javascript:void(0);" data-toggle="modal" data-target="#rigsterModal" data-dismiss="modal">Signup for free</a> -->
                 <a class="SignLink" onclick="signupForFree();" href="javascript:void(0);">Signup for free</a>

            </div>
         </div> 
       <?php } ?>
    </div>  
   </section>
   <?php } else{ ?>
      
      <section class="planSec sec-pad-70">
    <div class="container">
       <div class="section-title text-center sec-arrow-dark">
              <h4>Membership</h4>
              <h2>Join Our Membership</h2>  
          </div>
          <div class="pricing-wrapper clearfix">
         <div class="row">
             <?php   if($plan){ foreach( $plan as $val ){  ?>
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title"><?php echo get_plan_level()[$val->planLevel];?></h3>
                     <div class="dollarPrice">£<?php echo $val->amount;?>/<span><?php echo $val->planDuration;?></span></div>
                     <div class="listStyle">
                       <?php echo $val->description;?>
                     </div>
                   
                  </div>
                  <div class="table-buy">
                     <?php if($val->planLevel=='1' OR $val->planLevel=='2'){ ?>

                    

                     <p>£<?php echo $val->amount;?><span>/ <?php echo $val->planDuration;?> </span></p>
                     <a class="btn btn-theme btn-bg-t btn-round" href="javascript:void(0);" onclick="isRegister('<?php echo base_url();?>home/users/payment?level=<?php echo $val->planLevel;?>&price=<?php echo encoding($val->amount);?>&trainer=<?php echo encoding(1);?>&stripPlanId=<?php echo $val->stripPlanId;?>&commisitionTrainer=<?php echo '' ?>&couponsId=<?php echo'';?>&duration=<?php echo encoding($val->planDuration);?>','');">Join Now</a>

                     <?php }else{ ?>

                   <div class="priceBlock">
                    <p>£<?php echo $val->amount;?>/<span><?php echo $val->planDuration;?></span></p>
                      <h6 class="on-txt">Onwards</h6>
                    </div>
                      <a class="btn btn-theme btn-bg-t btn-round"  href="<?php echo base_url();?>home/trainers?level=<?php echo $val->planLevel;?>">Join Now</a>
                  <?php }?>
                  </div>
               </div>
            </div>
           <?php } }else{ ?>
       <div class="wrapper">
      <h3>No Plan Found</h3> 
    </div>
           <?php }?>
         </div>
      </div>
      <?php if(empty($_SESSION[USER_SESS_KEY]['userId'])){?>
          <div class="row">
            <div class="col-lg-12 mt-3 text-right">
             <!--   <a class="SignLink" href="javascript:void(0);" data-toggle="modal" data-target="#rigsterModal" data-dismiss="modal">Signup for free</a> -->
               <a class="SignLink" onclick="signupForFree();" href="javascript:void(0);">Signup for free</a>
            </div>
         </div>
       <?php }?>
    </div>  
   </section>
      <?php }?>
