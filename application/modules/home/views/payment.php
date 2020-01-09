   <?php  $frontend_assets = base_url()."frontend_assets/"; ?>
<div class="wrapper">
   <section id="rs-about" class="about-sec sec-pad-50">
      <div class="container">
          <!-- <div class="section-title text-center sec-arrow-dark">
              <h4>About My Vegan Trainer</h4>
              <h2>Welcome to MyVeganTrainer.com</h2>  
          </div> -->
          <div class="membershipPayment">
            <div class="paymentBlock">
              <div class="paymentLeft">
                <div class="SplanInfo">
                  <div class="planImg">
                    <img src="<?php echo $frontend_assets; ?>img/bill_b.png">
                  </div>
                  <?php if($_GET['level']=='1'OR $_GET['level']=='2' OR $_GET['level']=='3' OR $_GET['level']=='4'){?>
                  <h3 class="pricing-title"><?php $lvl=$_GET['level']; if($lvl){ echo get_plan_level()[$lvl];}  ?></h3>
                 <?php if(empty($_GET['price'])){?>

                  <div class="dollarPrice">£<?php echo get_membership_price()[$lvl];?>/<span>Month</span></div>
                  <?php }else{?>
                     <div class="dollarPrice">£<?php 
                     echo round(decoding($_GET['price']),2);
                     ?>/<span><?php echo decoding($_GET['duration']);?></span></div>
                  <?php }?>
                <?php }else{?>
                  <?php redirect('/');}?>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
                <div class="backPlan">
                  <?php if(empty($trainer) OR $trainer=='z1'){ ?>
                  <a   href="<?php echo base_url();?>home/membership"><i class="fas fa-arrow-left"></i> Back to Plan</a>
                  <?php } else{?>
                   <a   href="<?php echo base_url();?>home/membership/<?php echo encoding($trainer);?>"><i class="fas fa-arrow-left backdis"></i> Back to Plan</a> 
                  <?php }?>
                </div>
              </div>
              <div class="paymentRight">
                <div class="panel panel-default credit-card-box">
                  <div class="panel-heading display-table" >
                      <div class="row display-tr" >
                          <h3 class="panel-title display-td" >Payment Details</h3>
                          <div class="display-td cardImg">                            
                             <!--  <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png"> -->
                          </div>
                      </div>                    
                  </div>
                  <div class="panel-body csForm">
                      <div class="paymnt_dtl_list mb-25">
                        <ul>
                            <li>
                                <div class="dsplay_block_prt brdr_btm">
                                    <h3 class="lft_sec">Membership</h3>
                                    <h2 class="rgt_sec"><?php $lvl=$_GET['level']; if($lvl){ echo get_plan_level()[$lvl];}  ?></h2>
                                </div>
                            </li>
                            <li>
                                <div class="dsplay_block_prt brdr_btm mt-10">
                                    <h3 class="lft_sec">Cost</h3>
                                    <h2 class="rgt_sec">£<?php echo $planPrice->amount;?></h2>
                                </div>
                            </li>
                            <li>
                                <div class="dsplay_block_prt brdr_btm_blue mt-10">
                                   
                                    <?php if($_GET['couponsId']){ 
                                           $dis = decoding($_GET['discountData']);
                                          }else{
                                            $dis = COUPON_DISCOUNT; 
                                          }
                                          $amt = $planPrice->amount;
                                          $total =  ($amt -($amt*$dis/100));
                                    ?>
                                    <h3 class="lft_sec">Discount(<?php echo $dis;?>%)</h3>
                                    <h2 class="rgt_sec"><?php echo ($amt-$total);?></h2>
                                </div>
                            </li>
                            <li>
                                <div class="dsplay_block_prt mt-10">
                                    <h3 class="lft_sec totl">TOTAL</h3>
                                    <h2 class="rgt_sec">£<?php echo $total;?></h2>
                                </div>
                            </li>
                        </ul>                            
                    </div>
                   
                      <?php if(!empty($_GET['trainer'])){?>
                      <input type="hidden" name="trainer" value="<?php echo decoding($_GET['trainer']);?>">
                      <?php } ?>
                      <input type="hidden" name="user" value="<?php echo $_SESSION[USER_SESS_KEY]['userId'];?>">
                   
                      <div class="form-group">
                          <?php 
                              $strId  = $this->input->get('stripPlanId');
                              $cupId = $this->input->get('couponsId');
                              if($cupId){
                                $cupId = decoding($cupId);
                              }else{
                                $cupId = '';
                              }
                              $trId = $this->input->get('trainer');

                              if($trId){
                                 $trId = decoding($trId);
                              }else{
                                 $trId = '';
                              }

                              $trcumId = $this->input->get('commisitionTrainer');

                              if($trcumId){
                                $trcumId = decoding($trcumId);
                              }else{
                                $trcumId = '';
                              }

                          ?>

                          <button type="button" onclick="payData('<?php echo $strId;?>','<?php echo $cupId;?>','<?php echo $trId;?>','<?php echo $trcumId;?>','','<?php echo $this->input->get('level');?>')" class="subscribe btn btn-theme btn-bg-t btn-block" id="try_now">Pay Now</button>
                      </div>
                   <!--   stripPlanId,couponId,trainerId,trainerCommissionId,commission</form> -->
                  </div>
                </div> 
              </div>
            </div>
          </div>
      </div>
   </section>
</div>


<!-- modal for stripes -->

 <div class="modal fade lsModal" id="stripePaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="modal-title" id="exampleModalLabel"><i class=""></i> Payment Information </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="lsForm">
            <input type="hidden" name="stripId" id="stripId">
            <input type="hidden" name="couponId" id="couponId">
            <input type="hidden" name="trainerId" id="trainerId">
            <input type="hidden" name="commissionTrainerId" id="commissionTrainerId">
            <input type="hidden" name="commission" id="commission">
            <input type="hidden" name="levels" id="levels">
             
            <script src="https://js.stripe.com/v3/"></script>
            <form id="payment-form" action=""  method="post">
<!--               <div class="form-group">
                <p class="paraText">Enter your registerd email id to forgot your password.</p>
              </div>
              <input type="hidden" id ="hash4" name="<?php //echo get_csrf_token()['name'];?>" value="<?php //echo get_csrf_token()['hash'];?>">
                 <div class="text-danger error font_12" id="unsuccess3" ></div>
              <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email">
              </div> -->
              <div class="row">

                <div class="col-xl-12">
                  <div class="form-group">
                    <label for="card-element">
                       Credit or debit card 
                    </label>
                    <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert">
                    </div>
                  </div>                            
                </div>
              </div>

              <div class="form-group mt-30">
                <button class="btn btn-theme btn-bg-t btn-block">Submit Payment</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Payment success modal -->
<div class="modal fade popup_modal" id="paymentSuccessModal" tabindex="-1" role="dialog" aria-labelledby="productDetailModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered cascading-modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Congratulations!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
          <p style="font-size: 18px">Success! Your subscription starts immediately, and you will be billed monthly</p>
      </div>
<!--      <div class="modal-footer">
          <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close">Close</a>
      </div>-->
    </div>
  </div>
</div>

<script type="text/javascript">
  

  $("#try_now").click(function(){

     // check user privios plan is exit or not if exits then confirm pop( are you sure want to change plan)
    <?php
     if(!empty($_SESSION[USER_SESS_KEY]['userId'])){
       $usid=  $_SESSION[USER_SESS_KEY]['userId']; ?>
      var result = checkPrivios_plan('<?php echo $usid; ?>','<?php echo $_GET['level']; ?>'); 
    <?php  }
     ?>
    if(result== true){
      // plan exit then show popup then payment
    }else{
      // only payment
    }
   
   // $('#stripePaymentModal').modal('show'); //show payment modal

  });

  function payData(stripPlanId,couponId,trainerId,trainerCommissionId,commission,level){

   /* $('#stripePaymentModal').modal('show'); */
   //show payment modal
    $('#stripId').val(stripPlanId);
    $('#couponId').val(couponId);
    $('#trainerId').val(trainerId);
    $('#commissionTrainerId').val(trainerCommissionId);
    $('#commission').val(commission);
    $('#levels').val(level);

  }

  // Create a Stripe client.
var stripe = Stripe('<?php echo STRIPE_PUBLISABLE_KEY ?>');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});
//console.log(card);
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
     
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
 // form.submit();
  var url = '<?php echo base_url()?>home/subscription/process_payment';
 
    $.ajax({
        type: "POST",
        url: url,
        data: {'stripeToken':token.id,'stripPlanId':$('#stripId').val(),'stripCouponId':$('#couponId').val(),'trainerId':$('#trainerId').val(),'commissionTrainerId':$('#commissionTrainerId').val(),'commission':$('#commission').val(),'level':$('#levels').val()}, //only input
        dataType: "json",
        beforeSend: function () {
          show_loader(); 
        },
        complete:function(){
           
        },
        success: function (data, textStatus, jqXHR) {
                  
            if (data.status == 1){
                $('#stripePaymentModal').modal('hide');  //hide payment modal
                //$('#paymentSuccessModal').modal('show'); //show success modal
                card.clear(); //clear card values
                //toastr.success(data.msg);
                if(data.url){
                    hide_loader();
                     $("#try_now").attr("disabled", true);
                     $(".backdis").attr("disabled", true);
                    window.location = data.url;
                }
                
            } else {
               toastr.error(data.msg);
               hide_loader();
            }
        },
        error: function (jqXHR, textStatus, errorThrown){
            toastr.error(data.msg);
        }
    });
}


  function checkPrivios_plan(uid,pln){
    //alert(uid);
    var url = '<?php echo base_url()?>home/subscription/checkPriviosPlan';
    $.ajax({
        type: "POST",
        url: url,
        data: {'userId':uid,'userPlan':pln}, //only input
        dataType: "json",
        beforeSend: function () {
          show_loader(); 
        },
        complete:function(){
           
        },
        success: function (data, textStatus, jqXHR){   
         hide_loader();  
         if(data.status == 1){
          bootbox.confirm(data.msg, function (isTrue){
            //var link =  base_url+'admin/logout';
            if(isTrue) {
              $('#stripePaymentModal').modal('show');

            }
        });//
            }else if(data.status == 2){
              bootbox.alert(data.msg, function() {
             ///Example.show("Hello world callback");
             });
              // 
            }else{
              // toastr.error(data.msg);
              // hide_loader();
               $('#stripePaymentModal').modal('show');
            }
        },
        error: function (jqXHR, textStatus, errorThrown){
            toastr.error(data.msg);
        }
    });

  }
</script>