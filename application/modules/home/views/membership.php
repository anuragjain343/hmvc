<?php if(empty($trainerId)){?>

   <section class="planSec sec-pad-70">
    <div class="container">
       <div class="section-title text-center sec-arrow-dark">
              <h4>Membership</h4>
              <h2>Join Our Membership</h2>  
          </div>
          <div class="pricing-wrapper clearfix">
         <div class="row">
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title">Level 1</h3>
                     <div class="dollarPrice">£<?php echo get_membership_price()['level1'];?>/<span>Month</span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                           <li>Informational videos</li>
                           <li>Training videos</li>
                           <li>Recipe videos</li>
                           <li>Forum (word search)</li>
                           <li>A slide show of online trainers with their individual packages</li>
                        </ul>
                     </div>
                     <div class="planDesc">
                        <p>Members at this level would be emailed every couple of months to be encouraged to sign up for the level 2</p>
                     </div>
                  </div>
                  <div class="table-buy">
                     <?php if(isset($_SESSION[USER_SESS_KEY])){?>
                     <a class="btn btn-theme btn-bg-t btn-round" href="<?php echo base_url();?>home/users/payment?level=<?php echo 'level1';?>">Join Now</a>
                     <p>£<?php echo get_membership_price()['level1'];?><span>/M</span></p>
                     <?php }else{ ?>
                   <a class="btn btn-theme btn-bg-t btn-round"  href="javascript:void(0);" onclick="isRegister('<?php echo base_url();?>home/users/payment?level=level1','');">Join Now</a>
                     <p>£<?php echo get_membership_price()['level1'];?><span>/M</span></p>
                  <?php }?>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title">Level 2</h3>
                     <div class="dollarPrice">£<?php echo get_membership_price()['level2'];?>/<span>Month</span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                           <li>Informational videos</li>
                           <li>Training videos</li>
                           <li>Recipe videos</li>
                           <li>Forum (word search)</li>
                           <li>A slide show of online trainers with their individual packages</li>
                           <li>A weeks individual training program sent to their email every 4 weeks</li>
                           <li>Individual diet plan (1 week menu) sent to their email every 4 weeks</li>
                        </ul>
                     </div>
                     <div class="planDesc">
                        <p>£19.99 + £30 joining fee that includes our specialist assessment
                           (online form with their measurements, 3 pictures and a quick questioner )</p>
                           <p>Members with this membership level would be emailed every couple of months too see how they’re getting on and to incurage them to train with one of our trainers (possibly offers with codes to give them discount)
                           </p>
                     </div>
                  </div>
                  <div class="table-buy">
                     <?php if(isset($_SESSION[USER_SESS_KEY])){?>
                     <a class="btn btn-theme btn-bg-t btn-round" href="<?php echo base_url();?>home/users/payment?level=<?php echo 'level2';?>">Join Now</a>
                     <p>£<?php echo get_membership_price()['level2'];?><span>/M</span></p>
                     <?php }else{ ?>
                      <a class="btn btn-theme btn-bg-t btn-round"  href="javascript:void(0);" onclick="isRegister('<?php echo base_url();?>home/users/payment?level=level2','');">Join Now</a>
                     <p>£<?php echo get_membership_price()['level2'];?><span>/M</span></p>
                  <?php }?>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title">Level 3</h3>
                     <div class="dollarPrice">£<?php echo get_membership_price()['level3'];?>/<span>Month</span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                           <li>Informational videos</li>
                           <li>Training videos</li>
                           <li>Recipe videos</li>
                           <li>Forum (word search)</li>
                           <li>A slide show of online trainers with their individual packages</li>
                           <li>A weeks individual training program sent to their email every 4 weeks</li>
                           <li>Individual diet plan (1 week menu) sent to their email every 4 weeks</li>
                           <li>Online training with one of our trainers</li>
                        </ul>
                     </div>
                     <div class="planDesc">
                        <p>Online training with one of our trainers (set price) including the level 1 or level 2 ei. so if the online training is £150 it’s including access to the website (no level 1 fee)</p>
                        <p>Members signup up for level 1 using their links have to show up in their little panel as active members or none active (each trainer has access to their panel only)</p>
                     </div>
                  </div>
                  <div class="table-buy">
                     <a class="btn btn-theme btn-bg-t btn-round" href="<?php echo base_url();?>home/trainers?level=level3">Join Now</a>
                     <p>£<?php echo get_membership_price()['level3'];?><span>/M </span><br></p>
                     <h6 class="on-txt">Onwards</h6>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title">Level 4</h3>
                     <div class="dollarPrice">£<?php echo get_membership_price()['level4'];?>/<span>Month</span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                           <li>Informational videos</li>
                           <li>Training videos</li>
                           <li>Recipe videos</li>
                           <li>Forum (word search)</li>
                           <li>A slide show of online trainers with their individual packages</li>
                           <li>A weeks individual training program sent to their email every 4 weeks</li>
                           <li>Individual diet plan (1 week menu) sent to their email every 4 weeks</li>
                           <li>Online training with one of our trainers</li>
                        </ul>
                     </div>
                     <div class="planDesc">
                        <p>Online training with one of our trainers (set price) including the level 1 or level 2 ei. so if the online training is £150 it’s including access to the website (no level 1 fee)</p>
                        <p>Members signup up for level 1 using their links have to show up in their little panel as active members or none active (each trainer has access to their panel only)</p>
                     </div>
                  </div>
                  <div class="table-buy">
                     <a class="btn btn-theme btn-bg-t btn-round" href="<?php echo base_url();?>home/trainers?level=level4">Join Now</a>
                     <p>£<?php echo get_membership_price()['level4'];?><span>/M </span><br></p>
                     <h6 class="on-txt">Onwards</h6>
                  </div>
               </div>
            </div>         
         </div>
      </div>  
      <?php if(!isset($_SESSION[USER_SESS_KEY])){?>
      <!--    <div class="row">
            <div class="col-lg-12 mt-3 text-right">
               <a class="SignLink" href="javascript:void(0);" data-toggle="modal" data-target="#rigsterModal" data-dismiss="modal">Signup for free</a>
            </div>
         </div> -->
     
      <?php }?>
    </div>  
   </section>
<!--else part  -->
   <?php } else{?>

      <section class="planSec sec-pad-70">
    <div class="container">
       <div class="section-title text-center sec-arrow-dark">
              <h4>Membership</h4>
              <h2>Join Our Membership</h2>  
          </div>
          <div class="pricing-wrapper clearfix">
         <div class="row">
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title">Level 1</h3>
                     <div class="dollarPrice">£<del><?php echo get_membership_price()['level1'];?></del>/<span>Month</span></div>
                      <div class="dollarPrice">£<?php echo round($totalLavel1,2);?>/<span>Month</span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                           <li>Informational videos</li>
                           <li>Training videos</li>
                           <li>Recipe videos</li>
                           <li>Forum (word search)</li>
                           <li>A slide show of online trainers with their individual packages</li>
                        </ul>
                     </div>
                     <div class="planDesc">
                        <p>Members at this level would be emailed every couple of months to be encouraged to sign up for the level 2</p>
                     </div>
                  </div>
                  <div class="table-buy">
                     <a class="btn btn-theme btn-bg-t btn-round"  href="javascript:void(0);" onclick="isRegister('<?php echo base_url();?>home/users/payment?level=level1&price=<?php echo encoding(round($totalLavel1,2));?>','');">Join Now</a>
                     <p>£<?php echo round($totalLavel1,2);?><span>/M</span></p>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title">Level 2</h3>
                     <div class="dollarPrice">£<del><?php echo get_membership_price()['level2'];?></del>/<span>Month</span></div>
                     <div class="dollarPrice">£<?php echo round($totalLavel2,2);?>/<span>Month</span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                           <li>Informational videos</li>
                           <li>Training videos</li>
                           <li>Recipe videos</li>
                           <li>Forum (word search)</li>
                           <li>A slide show of online trainers with their individual packages</li>
                           <li>A weeks individual training program sent to their email every 4 weeks</li>
                           <li>Individual diet plan (1 week menu) sent to their email every 4 weeks</li>
                        </ul>
                     </div>
                     <div class="planDesc">
                        <p>£19.99 + £30 joining fee that includes our specialist assessment
                           (online form with their measurements, 3 pictures and a quick questioner )</p>
                           <p>Members with this membership level would be emailed every couple of months too see how they’re getting on and to incurage them to train with one of our trainers (possibly offers with codes to give them discount)
                           </p>
                     </div>
                  </div>
                  <div class="table-buy">
                   
                      <a class="btn btn-theme btn-bg-t btn-round"  href="javascript:void(0);" onclick="isRegister('<?php echo base_url();?>home/users/payment?level=level2&price=<?php echo encoding(round($totalLavel2,2));?>','');">Join Now</a>
                     <p>£<?php  echo round($totalLavel2,2);?><span>/M</span></p>
                
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title">Level 3</h3>
                     <div class="dollarPrice">£<del><?php echo get_membership_price()['level3'];?></del>/<span>Month</span></div>
                     <div class="dollarPrice">£<?php echo round($totalLavel3Same,2);?>/<span>Month</span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                           <li>Informational videos</li>
                           <li>Training videos</li>
                           <li>Recipe videos</li>
                           <li>Forum (word search)</li>
                           <li>A slide show of online trainers with their individual packages</li>
                           <li>A weeks individual training program sent to their email every 4 weeks</li>
                           <li>Individual diet plan (1 week menu) sent to their email every 4 weeks</li>
                           <li>Online training with one of our trainers</li>
                        </ul>
                     </div>
                     <div class="planDesc">
                        <p>Online training with one of our trainers (set price) including the level 1 or level 2 ei. so if the online training is £150 it’s including access to the website (no level 1 fee)</p>
                        <p>Members signup up for level 1 using their links have to show up in their little panel as active members or none active (each trainer has access to their panel only)</p>
                     </div>
                  </div>
                  <div class="table-buy">
                     
                      <a class="btn btn-theme btn-bg-t btn-round" href="<?php echo base_url();?>home/trainers?level=level3&price=<?php echo encoding(round($totalLavel3Same,2));?>&totalLavel3Other=<?php echo encoding(round($totalLavel3Other,2));?>">Join Now</a>
                     <p>£<?php echo round($totalLavel3Same,2);?><span>/M </span><br></p>
                     <h6 class="on-txt">Onwards</h6>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="pricing-table pricing-min">
                  <div class="col-sm-12 planInfo">
                     <h3 class="pricing-title">Level 4</h3>
                     <div class="dollarPrice">£<del><?php echo get_membership_price()['level4'];?></del>/<span>Month</span></div>
                      <div class="dollarPrice">£<?php echo round($totalLavel4Same,2);?>/<span>Month</span></div>
                     <div class="listStyle">
                        <ul class="table-list">
                           <li>Informational videos</li>
                           <li>Training videos</li>
                           <li>Recipe videos</li>
                           <li>Forum (word search)</li>
                           <li>A slide show of online trainers with their individual packages</li>
                           <li>A weeks individual training program sent to their email every 4 weeks</li>
                           <li>Individual diet plan (1 week menu) sent to their email every 4 weeks</li>
                           <li>Online training with one of our trainers</li>
                        </ul>
                     </div>
                     <div class="planDesc">
                        <p>Online training with one of our trainers (set price) including the level 1 or level 2 ei. so if the online training is £150 it’s including access to the website (no level 1 fee)</p>
                        <p>Members signup up for level 1 using their links have to show up in their little panel as active members or none active (each trainer has access to their panel only)</p>
                     </div>
                  </div>
                  <div class="table-buy">
                       <a class="btn btn-theme btn-bg-t btn-round" href="<?php echo base_url();?>home/trainers?level=level4&price=<?php echo encoding(round($totalLavel4Same,2));?>&totalLavel4Other=<?php echo encoding(round($totalLavel4Other,2));?>">Join Now</a>
                     <p>£<?php echo round($totalLavel4Same,2);?><span>/M </span><br></p>
                     <h6 class="on-txt">Onwards</h6>
                  </div>
               </div>
            </div>         
         </div>
      </div>
      
         <!-- <div class="row">
            <div class="col-lg-12 mt-3 text-right">
               <a class="SignLink" href="javascript:void(0);" data-toggle="modal" data-target="#rigsterModal" data-dismiss="modal">Signup for free</a>
            </div>
         </div> -->
     
     
    </div>  
   </section>
      <?php }?>