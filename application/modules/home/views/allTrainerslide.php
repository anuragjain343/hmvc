<?php  $frontend_assets = base_url()."frontend_assets/";
?>

   <div id="rs-slider" class="rs-slider rs-slider1 sldr-trainr-page">
    <div id="home-slider" class="owl-carousel owl-theme sldr-trainr-carousel">
      <?php if($allTrainer){
      
        $i=1;
        $J=0;
        foreach ($allTrainer as $key => $value){ 
          //pr($allTrainer);
          if($value->level=='Level 3'){
            $selectlevel =3;
          }else if($value->level=='Level 4'){
             $selectlevel =4;
          }else{
            redirect('/');
          }
          if($i==4){
            $i=1;
          }
         $slide="slide$i.jpg";
          ?>
           <?php if(!empty($value->bannerImage)){ $link = BANNER_IMAGE.$value->bannerImage;}else{ $link = BANNER_DEFAULT;  }?>
        <div class="item <?php echo ($key==0)? "active" : "" ?>">
        <img src="<?php  echo base_url($link); ?>" alt="Slide1" />
        <div class="slide-content trainr-slide">
          <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                            <div class="list-des">
                                <div class="list-artcl mrgn-btm-list trainr-slidr back-tranpnr">
                                    <div class="list-info tnr-list-info">
                                        <div class="media media-res">
                                           <?php if(!empty($value->profileImage)){ ?>
                                 <img class="mr-2 mrt-8" src="<?php echo base_url().TRAINER_PROFILE_THUMB.$value->profileImage;?>">
                                            <?php }else{ ?>

                                  <img class="mr-2 mrt-8" src="<?php echo base_url().DEFAULT_IMAGE;?>">
                                  
                                            <?php } ?>

                                            <div class="media-body maxContent trainr-slidr-text back-tranpnr">
                                              <h2><a href="<?php echo base_url('home/trainers/trainerProfile/').encoding($value->trainerId); ?>"><?php echo $value->fullName;?></a>
                                              <p class="subttle clr-whte">Trainer</p> 
                                            </div>
                                        </div>
                                          <p class="paraText mt-15 clr-whte"><?php echo $value->details;?>
                                          </p>                                                                                              
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                            <div class="pricing-table trainr-slidr-table clr-chnge mb-30">
                              <div class="col-sm-12 planInfo clr-back">
                                <h3 class="pricing-title clr-font"><?php echo $value->level; ?></h3>
                                 <div class="dollarPrice">£<?php 
                                  if(isset($_COOKIE['reffralId'])){
                                    if($J==0){
                                  
                                      echo round($value->price,2);
                                    }else{
                                          echo round($value->price,2);
                                        //echo $value->priceOther;
                                    } 
                                  }else{
                                    echo round($value->price,2);
                                  }
                                  ?>
                                  /<span class="clr-font">Month</span></div>
                                 <div class="listStyle trnr-slder-style">
                            
                             
                                     
                                <ul class="table-list clr-font">
                               
                                <span class="recipesDes"  id="show<?php echo $key;?>" style="display:none;" style="float:left;">
                                    <span class="paraText" style="color:white;"><?php echo $value->description;?></span>
                                    <span id="less<?php echo $key;?>" class="readLess" style="color: #43a4dc; cursor: pointer;">...Read less</span>
                                </span>
                                
                                <span class="recipesDes"  id="hide<?php echo $key;?>">
                                    <span class="paraText" style="color:white;"><?php custom_echo ($value->description,450);?></span>
                                   
                                    <?php if(strlen($value->description)>450){?>
                                    <span id="more<?php echo $key;?>" class="readMore" style="color: #43a4dc; cursor: pointer; position: relative;">Read more</span>
                                   <?php }?>
                                </span>

                                  </ul> 


            

                                 </div>
                              </div>
                              <div class="table-buy clr-back">
                                 <a class="btn btn-theme btn-bg-t btn-round lft-btn" href="<?php echo base_url().'home/membership';?>">Go Back</a>
                                 <?php if(isset($_COOKIE['reffralId'])){ ?>
                                   <?php
                                    if($J==0){ ?>  
                              <a class="btn bplanDis4tn-theme btn-bg-t btn-round rgt-btn"  onclick="isRegister('<?php echo base_url();?>home/users/payment?level=<?php echo $selectlevel; ?>&trainer=<?php echo encoding($value->trainerId);?>&price=<?php echo encoding($value->price);?>&stripPlanId=<?php echo $value->stripPlanId; ?>&commisitionTrainer=<?php echo encoding($commisitionTrainer);?>&couponsId=<?php echo encoding($value->coupan);?>&discountData=<?php echo encoding($value->discountData);?>&duration=<?php echo encoding($value->duration);?>','');">
                              Continue</a>

                              <?php }else{?>
                   
                                  <a class="btn btn-theme btn-bg-t btn-round rgt-btn"  onclick="isRegister('<?php echo base_url();?>home/users/payment?level=<?php echo $selectlevel; ?>&trainer=<?php echo encoding($value->trainerId);?>&price=<?php echo encoding($value->price);?>&stripPlanId=<?php echo $value->stripPlanId;?>&commisitionTrainer=<?php echo encoding($commisitionTrainer);?>&couponsId=<?php echo encoding($value->coupan);?>&discountData=<?php echo encoding($value->discountData);?>&duration=<?php echo encoding($value->duration);?>','');">
                              Continue</a>

                              <?php }?>

                               <?php }else{ ?>
                            
                           <a class="btn btn-theme btn-bg-t btn-round rgt-btn"  onclick="isRegister('<?php echo base_url();?>home/users/payment?level=<?php echo $selectlevel;?>&trainer=<?php echo encoding($value->trainerId);?>&price=<?php echo encoding($value->price);?>&stripPlanId=<?php echo $value->stripPlanId;?>&commisitionTrainer=<?php echo '' ?>&couponsId=<?php echo'';?>&duration=<?php echo encoding($value->duration);?>','');">Continue</a>
                           
                          
                               <?php }?>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
       <?php $i++; 
       $J++;
     }
      } ?>
    </div>
  </div>

<script>
/*function f1(key){

    $(this).hide();
    $('#show'+key).show();
    $('#less'+key).show();
    $('#hide'+key).hide();
}

function f2(key){
    $(this).hide();
    $('#show'+key).hide();
    $('#more'+key).show();
    $('#hide'+key).show();

}*/


$(document).on('click','.readMore',function(){
    let key = $(this).data('key');

    $(this).hide();
    $(this).parent().parent().parent().parent().parent().prev().css('display','block');
    $(this).parent().parent().parent().parent().parent().prev().next().prev().find('.readLess').css('display','block');
    $(this).parent().parent().parent().parent().parent().css('display','none');

});

$(document).on('click','.readLess',function(){
    let key = $(this).data('key');

    $(this).hide();
    $(this).parent().css('display','none');
    $(this).parent().next().find('.readMore').css('display','block');
    $(this).parent().next().css('display','block');

});
</script>


