<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends Common_Front_Controller {
    
    public function __construct() {
        parent::__construct();
        
        
        
        $this->user_data = get_user_session_data(); //get user session data
        $this->load->model('subscription_model'); //load subscription model
        $this->load->library('stripe'); //stripe payment library
        
       // $this->session_data['user_data'] = $this->user_data; //get user session data
        //$this->data['plan'] = $this->stripe->get_plan(STRIPE_PLAN_ID); //get stripe plan detail

    }
    
    
    //customer billing details page
    public function billing_details(){
      
        $this->check_user_session(); //check user session
        
        $this->data['page_title'] =  'Billing details';
        
       
        $subscription_id = $this->subscription_model->get_subscription_id(); //get current user subscription ID
        
        $this->data['customer_subscription'] = '';
        
        if(!empty($subscription_id)){
            $subscription = $this->stripe->get_subscription($subscription_id);
            if($subscription['status'] !== false){
                $this->data['customer_subscription'] = $subscription['data'];
            }
        }
        
        //get payment history of user
        $this->data['payment_history'] = $this->subscription_model->get_user_payment_history(); 
        
        //load views
      
       // $this->load->view($this->biz_inc.'/profile_section',$this->data);
       
    }
   public function payment_success(){
        $this->check_user_session(); //check user session
        if(isset($_COOKIE['reffralId'])){
            $cookie_name = 'reffralId';
            unset($_COOKIE[$cookie_name]);
            $res = setcookie($cookie_name, ' ', time() - 3600);
        }
        $uid =$_SESSION[USER_SESS_KEY]['userId'];
        // $userDetails = $this->db->select('*')->where(array('id'=>$uid,'userRole'=>'user'))->get(USERS);
        $where = array('id'=>$uid,'userRole'=>'user');
        $userDetails  = $this->common_model->getsingle(USERS, $where, $fld = NULL, $order_by = '', $order = '');
       // pr($userDetails);

        if(!empty($userDetails->userPlan) AND $userDetails->userPlan!='free'){
        if($userDetails->userPlan=='1'){
            $userData['userPlan']= 'Level 1';
        }else if ($userDetails->userPlan=='2') {
            $userData['userPlan']= 'Level 2';
        }else if ($userDetails->userPlan=='3') {
            $userData['userPlan']= 'Level 3';
        }else{
            $userData['userPlan']= 'Level 4';
        }
       
        $userData['userName']= $userDetails->fullName;

        if(!empty($userDetails->subscriptionId)){

            $where1= array('userId'=>$uid,'referenceId'=>$userDetails->subscriptionId);

            $userPayment  = $this->common_model->getsingle('payment', $where1, $fld = NULL, $order_by = '', $order = '');
            $userData['price']= $userPayment->payAmount;
            $userData['actualPrice']= $userPayment->amount;
            $userData['couponDiscount']= $userPayment->couponDiscount;
            
            $strpdata = json_decode($userPayment->subscriptionJson);
            $s = $strpdata->data;
             //pr($strpdata['plan']);
        
            $dt = new DateTime();
            //$dt->setTimezone(new DateTimeZone('America/New_York'));
            $dt->setTimestamp($s->current_period_end);

            $userData['endDate']= $dt->format('Y-m-d');

            $dtt = new DateTime();
            $dtt->setTimestamp($s->current_period_start);
            $userData['startDate']= $dtt->format('Y-m-d');
            //pr($userDetails);
            $this->load->model('User_model');
            $data['planInfo1'] =  $this->User_model->userPlan1($userDetails->userPlan);
           // pr($data['planInfo1']);

            $dur = $data['planInfo1']->planDuration;
            $userData['duration']= $dur;
       
            
        }

        if(!empty($userDetails->assignTrainer) AND $userDetails->assignTrainer!=1){ 

            

            $where2= array('id'=>$userDetails->assignTrainer,'userRole'=>'trainer');
            $trainerData  = $this->common_model->getsingle(USERS, $where2, $fld = NULL, $order_by = '', $order = '');

            $userData['fullName']= $trainerData->fullName;
            $userData['profileImage']=$trainerData->profileImage;
         }

          $message     = $this->load->view('emails/payment_email',$userData,TRUE); 
          $subject     = "My Vegan Trainer-User Plan Details";
          $this->load->library('smtp_email');
         $sen_email = $this->smtp_email->send_mail($userDetails->email,$subject,$message);
         //pr($sen_email);
         } 

       $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
       $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');       
    
       $data['title'] =  'payment status';
       $this->load->front_render('membership/success',$data,'');
       
    }
    
    
    //process stripe card payment- Create customer, charge customer and make subscription
    public function process_payment(){
       // print_r($_POST);die;
        $this->check_ajax_auth(); //authentication for ajax
        $coupon_code = COUPON_DATA;
        $res=array();
        extract($_POST);
        $stripeToken;
        $stripPlanId;
        $stripCouponId;
        $trainerId;
        $commissionTrainerId;
        $commission;
        $level;

        if(empty($stripCouponId)){
           $stripCouponId = $coupon_code;
        }
        
        if($commissionTrainerId){
            if($level ==1 || $level ==2){
              $comis = $this->common_model->getsingle(TRAINERMETA, $where =array('trainerId'=>$commissionTrainerId));
            }else{
              $comis = $this->common_model->getsingle(TRAINERMETA, $where =array('trainerId'=>$trainerId));
            } 
            
            if( $comis){
                if($level == 1 ){
                    $commission =$comis->commissionLevel1;

                }
                if($level == 2){
                     $commission =$comis->commissionLevel2;
                }

                if($level == 3){

                    if($trainerId == $commissionTrainerId){

                        $commission =$comis->commissionLevel3Same;
                    }else{
                        $commission =$comis->commissionLevel3Other;
                    }
                }
                if($level == 4){

                    if($trainerId == $commissionTrainerId){

                        $commission =$comis->commissionLevel4Same;
                    }else{
                        $commission =$comis->commissionLevel4Other;
                    }
                }
            }
        }
        
        $amt = $this->common_model->getsingle(TBL_PLAN, $where =array('stripPlanId'=>$stripPlanId), $fld = 'amount,planId,planLevel', $order_by = '', $order = '');
       $coup = $this->common_model->getsingle(TBL_COUPON, $where =array('stripCouponId'=>$stripCouponId), $fld = 'discountData', $order_by = '', $order = '');

  
        //check if user is already subscribed
        //1:Yes(need to pay), 0:No(no need to pay)
        $paywall = $this->subscription_model->get_paywall_status(); //get user paywall status

        /*if($paywall==0){
            $res['status'] = 0; $res['msg'] = 'You are already subscribed to plan. Please check your billing details.';
            echo json_encode($res); exit;
        }*/
        
        //get user stripe customer ID
        $customer_id = $this->subscription_model->get_stripe_customer_id();
        
        if($customer_id === FALSE){
            $res['status'] = 0; $res['msg'] = 'Something went wrong. Please try again.';
            echo json_encode($res); exit;
        }
        
        
        if(empty($customer_id)){
            //create customer if ID not found
           $stripe_res = $this->stripe->create_customer($_SESSION[USER_SESS_KEY]['emailId'],$stripeToken); //create a customer
            
            if($stripe_res['status'] == false){
                $res['status'] = 0; $res['msg'] = $stripe_res['message'];
                echo json_encode($res); exit;
            }
            
            $customer_id = $stripe_res['data']->id;  //customer ID
            
            //save customer ID in our DB for future use
            $update = $this->subscription_model->save_customer_id($customer_id);
            
            //some problem in updating customer ID
            if(!$update){
                $res['status'] = 0; $res['msg'] = 'Something went wrong. Please try again.';
                echo json_encode($res); exit;
            }
        }else{
               //update stripe token 
               $updataData['description'] =  $_SESSION[USER_SESS_KEY]['emailId'];
               $updataData['source']      = $stripeToken;
               $stripe_res_upd = $this->stripe->update_customer($customer_id,$updataData); 
        }
          
        
        //plan details
       // $plan_detail = $this->data['plan'];
       // $plan = $plan_detail['data'];
        //echo $plan->amount.' -- '.$customer_id; die;
        /*$charge = $this->stripe->charge_customer($plan->amount, $customer_id); //charge a customer
        
        if($charge['status'] == false){
            $res['status'] = 0; $res['msg'] = $charge['message'];
            echo json_encode($res); exit;  //fail
        }*/
        
        //subscribe customer to a plan

        $subscription = $this->stripe->create_subscription($customer_id,$stripPlanId,$stripCouponId);
        
        // delete old subscription id (by anurag)
        $userSubid = $this->common_model->getsingle(USERS, $where =array('id'=>$_SESSION[USER_SESS_KEY]['userId']), $fld = '*', $order_by = '', $order = '');
        if(!empty($userSubid->subscriptionId)){
            $sec=false;
            $this->stripe->cancel_subscription($userSubid->subscriptionId,$sec);
        }

        //end of function

        if($subscription['status'] == false){
            $res['status'] = 0; $res['msg'] = $subscription['message'];
            echo json_encode($res); exit;  //fail
        }
        
        $subscription_id = $subscription['data']->id;  //subscription ID
        
        //save subscription ID in our DB
        $update_sub = $this->subscription_model->save_subscription_id($subscription_id,$level,$trainerId);
        $sub_status = 'succeeded';
        //some problem in updating customer ID
        if(!$update_sub){
            $res['status'] = 0; $res['msg'] = 'Something went wrong. Please try again.'; 
            $sub_status = 'failed';
            echo json_encode($res); exit;
        }

       $couponDiscount = ($amt->amount*$coup->discountData)/100;
       
       if($commissionTrainerId){
          //$commissionData = (($amt->amount*$commission)/100);
          //$amt= $amt->amount/1.2;
          //$commissionData = (($amt*$commission)/100);
        $commissionData = ((($amt->amount/1.2)*$commission)/100);

       }else{
          $commissionData = '';
       }
       $payAmount =    ($amt->amount-($amt->amount*$coup->discountData)/100);
        //save payment data in DB
        $payment_data['referenceId'] = $subscription_id;
        $payment_data['userId'] = $_SESSION[USER_SESS_KEY]['userId'];
        //$payment_data['amount'] = $plan->amount; //in cents
        $payment_data['PlanLevel'] = $amt->planLevel; //in cents
        $payment_data['PlanId'] = $amt->planId; //in cent
        $payment_data['amount'] = $amt->amount; //in cents
        $payment_data['payAmount'] = $payAmount; //in cents
        $payment_data['couponDiscount'] = $couponDiscount;
        $payment_data['trainerId'] = $trainerId;
        $payment_data['commissionTrainerId'] = $commissionTrainerId;
        $payment_data['trainerCommission'] = $commissionData;
        $payment_data['subscriptionJson'] = json_encode($subscription);
        $payment_data['paymentStatus'] = $sub_status;
        $payment_data['crd'] = datetime();
        $payment_data['upd'] = datetime();
        if(empty($commissionTrainerId)){
           $payment_data['fromSignup'] =  0; 
        }
        //pr($payment_data);
        $payment_id = $this->subscription_model->save_payment($payment_data);

        $_SESSION[USER_SESS_KEY]['userPlan']= $payment_data['PlanLevel'];
        $where =array('userId'=>$payment_data['userId']);
        $check = $this->common_model->is_data_exists('userSubscription',$where);

        $paymentDetails = $this->common_model->getsingle('payment', $where =array('paymentId'=>$payment_id), $fld = '*', $order_by = '', $order = '');

     $jsonData = json_decode($paymentDetails->subscriptionJson);
     $subscribedOnTimestamp = $jsonData->data->created;
     $subscribedOnDate = date('Y-m-d H:i:s', $subscribedOnTimestamp);

     $StartTimestamp = $jsonData->data->current_period_start;
     $startDate = date('Y-m-d H:i:s', $StartTimestamp);

     $EndTimestamp = $jsonData->data->current_period_end;
     $EndDate = date('Y-m-d H:i:s', $EndTimestamp);
    
         if($check){
            //pr('sdfdsf');
            $where = array('userId'=>$payment_data['userId']);
            $data['stripeSubscriptionId']   =  $paymentDetails->referenceId;
            $data['paymentId']              =  $payment_id;
            $data['subscribedOnDate']       =  $subscribedOnDate; 
            $data['subscribedOnTimestamp']  =  $subscribedOnTimestamp;
            $data['startDate']              =  $startDate; 
            $data['EndDate']                =  $EndDate; 
            $data['StartTimestamp']         =  $StartTimestamp;
            $data['EndTimestamp']           =  $EndTimestamp; 
            $data['subscriptionResponse']   =  $paymentDetails->subscriptionJson;
            $data['upd']                    =  datetime();
            $Updatedata = $this->common_model->updateFields('userSubscription',$data, $where);
        }else{

            $dataInsert['userId']               = $_SESSION[USER_SESS_KEY]['userId'];
            $dataInsert['stripeSubscriptionId'] = $paymentDetails->referenceId;
            $dataInsert['paymentId']            = $payment_id;
            $dataInsert['subscribedOnDate']     = $subscribedOnDate;
            $dataInsert['subscribedOnTimestamp']= $subscribedOnTimestamp;
            $dataInsert['startDate']            = $startDate;
            $dataInsert['EndDate']              = $EndDate;
            $dataInsert['StartTimestamp']       = $StartTimestamp;
            $dataInsert['EndTimestamp']         = $EndTimestamp;
            $dataInsert['subscriptionResponse'] = $paymentDetails->subscriptionJson;
            $dataInsert['crd']                  = datetime();
            $dataInsert['upd']                  = datetime();
            $insertdata = $this->common_model->insertData('userSubscription',$dataInsert);
        }
        
        //some problem in updating payment info
        if(!$payment_id){
            $res['status'] = 0; $res['msg'] = 'Something went wrong. Please try again.';
            echo json_encode($res); exit;
        }
        
        $this->subscription_model->update_paywall($status=0); //1:Yes(need to pay), 0:No(no need to pay)
        
        $res['status'] = 1; $res['msg'] = 'Your payment is successfully placed. You will be billed as per you plan.';
        $res['url'] =  base_url('home/subscription/payment_success');
        echo json_encode($res); exit;  //success
        //$charge['data'] ;
    }
    
    //cancel subscription ajax request
    function cancel_subscription_request(){
        
        $this->check_ajax_auth(); //authentication for ajax
        extract($_POST);
        $res=array();
        
        if($subscriptionType != 'all_access'){
            $res['status'] = 0; $res['msg'] = 'Invalid request.';
            echo json_encode($res); exit;
        }
        
        $subscription_id = $this->subscription_model->get_stripe_subscription_id(); //get subscription ID
        
        if($subscription_id === FALSE){
            $res['status'] = 0; $res['msg'] = 'No active subscription found';
            echo json_encode($res); exit;
        }
        
        //cancel customer's subscription
        //to cancel the subscription at the end of the current billing period(not immediately), provide $at_period_end = true
        $subscription = $this->stripe->cancel_subscription($subscription_id, true);
        //pr($subscription);
        if($subscription['status'] == false){
            $res['status'] = 0; $res['msg'] = $subscription['message'];
            echo json_encode($res); exit;  //fail
        }
        
        /* //update subscription (subscription field will be cleared)
        $update_sub = $this->subscription_model->save_subscription_id(); 
        //some problem in updating customer ID
        if(!$update_sub){
            $res['status'] = 0; $res['msg'] = 'Something went wrong. Please try again.'; 
            echo json_encode($res); exit;
        }*/
        
        $res['status'] = 1; $res['msg'] = 'Subscription cancelled successfully. You will be downgraded to Free plan at the end of current billing cycle';
        $res['url'] =  base_url('subscription/billing_details');
        echo json_encode($res); exit;  //success
    }
    
    //check if subscription(paywall) is active for user
    function check_subscription(){
        
        $this->check_ajax_auth(); //authentication for ajax
        extract($_POST);
        $res=array();
        
        //1:Yes(need to pay), 0:No(no need to pay)
        $paywall = $this->subscription_model->get_paywall_status(); //get user paywall status
        
        $res['is_active'] = 0; $res['status'] = 1;
        if($paywall==0){
            $res['is_active'] = 1;
        }
        
        echo json_encode($res); exit;  //success
    }
    
    //Stripe webhook handler- For caputring behind the scenes events like subscription payment fail or subscription ended
     function stripe_web_hook(){
        $file_name = 'stripe_logs.txt';
        /*$msg = 'Manish- Hello world- today';
        log_event($msg, $file_name);*/
        // Retrieve the request's body and parse it as JSON:
        //echo "string"; die();
        $input = @file_get_contents('php://input');
         // pr($input);
        $event_json = json_decode($input);
        //print_r($event_json);
        // Do something with $event_json
        //log_event($input, $file_name);
        switch ($event_json->type){
            
            /* Occurs whenever a customer's subscription ends. */
            case "customer.subscription.deleted": 
                
                $cutomer_id     = $event_json->data->object->customer;
                $subscription_id = $event_json->data->object->id;
                $this->subscription_model->cancelSubscription($subscription_id); 
                //make relevant cancel actions in our DB
                log_event($cutomer_id, $file_name);
                break;
            
            /* Occurs whenever a subscription changes (e.g., switching from one plan to another, 
               or changing the status from trial to active). 
               Here we will only listen to status, if it is canceled or unpaid or past_due 
            */
            case "customer.subscription.updated":
                
                //usually canceled state will trigger subscription.delete event so we don't really need to check here
                //but we are putting this anyway just to be double sure
                //in past_due event the script could email the customer directly, asking them to update their payment details.
                //after past_due state Stripe will retry to charge again before changing state to unpaid or canceled
                //unpaid or canceled state occurs when Stripe has exhausted all payment retry attempts.
                //but for now we are not taking past_due state into consideration
                
                $sub_status = $event_json->data->object->status;
                if($sub_status == 'canceled' || $sub_status == 'unpaid'){
                  $this->subscription_model->cancelSubscription($subscription_id); //make relevant cancel actions in our DB
                }
                log_event($status, $file_name);
                break;
              
        }
        
        //return response to stripe
        http_response_code(200); // PHP 5.4 or greater
    }
    function stopRecurring(){
     $userSubid = $this->common_model->getsingle(USERS, $where =array('id'=>$_SESSION[USER_SESS_KEY]['userId']), $fld = '*', $order_by = '', $order = '');
    // pr($userSubid);
        if(!empty($userSubid->subscriptionId)){
           // $sec=TRUE;
            $result = $this->stripe->cancel_mysubscription($userSubid->subscriptionId,TRUE);
            //pr($result);
            if(!empty($result)){
                $res['status'] = 1;
                $res['msg']    = 'Stop recurring successfully.';
                $res['url']    = base_url().'home/users/userProfile';
                echo json_encode($res);die();
            }else{
                $res['status'] = 1;
                $res['msg']    = 'Something went wrong.';
                $res['url']    = base_url().'home/users/userProfile';
                echo json_encode($res);die();
            }   
        }
    }


/*    function cancelSubscription($subscription_id){

        $this->db->select('userId,subscriptionId,bizSubscriptionId');
        $this->db->where(array('subscriptionId'=>$subscription_id));
        $this->db->or_where(array('bizSubscriptionId'=>$subscription_id));
        $req = $this->db->get(USERS);

        $isUpdated = '';
        if($req->num_rows()){ 
            $res = $req->row();
            if($res->subscriptionId == $subscription_id){
                $where = array('userId'=>$res->userId);
                $isUpdated = $this->common_model->updateFields(USERS, array('subscriptionId'=>'','subscriptionStatus'=>0),$where);
            }elseif($res->bizSubscriptionId == $subscription_id){

                $where = array('userId'=>$res->userId);
                $isUpdated = $this->common_model->updateFields(USERS, array('bizSubscriptionId'=>'','bizSubscriptionStatus'=>0),$where);
            }
        }
        if($isUpdated){
            return TRUE;
        }else{
            return FALSE;
        }
        
    } // End of function
*/


    function checkPriviosPlan(){
      $userplan = $_POST['userPlan'];
      $userSubid = $this->common_model->getsingle(USERS, $where =array('id'=>$_SESSION[USER_SESS_KEY]['userId']), $fld = '*', $order_by = '', $order = '');
     //pr($userSubid);
      if($userSubid->userPlan!='free'){
      $paymntData = $this->common_model->getsingle(PAYMENT, $where =array('referenceId'=>$userSubid->subscriptionId), $fld = '*', $order_by = '', $order = '');
      //calculate the time of plan 
      $jsonData = json_decode($paymntData->subscriptionJson);
      $end_time='';
      if(!empty($jsonData->data->current_period_end)){
      $endDate= $jsonData->data->current_period_end;
      $end_time = date('Y-m-d H:i:s', $endDate);
      $current_time = datetime();
      $date1 = new DateTime($current_time);
      $date2 = new DateTime($end_time);
      $interval = $date1->diff($date2);
      $res['remaning_days'] = $interval->days;
      if($userSubid->userPlan!= $userplan AND $res['remaning_days']>1){
        $res['remaning_days'] = $interval->days;
        $res['status'] = 1;
        $res['msg'] = 'You are already subscribed to Level ' .$userSubid->userPlan. ' plan. Are you sure you want to change your subscription plan ?';
        echo json_encode($res);die();
       }else if($userSubid->userPlan == $userplan AND $res['remaning_days'] >=1){
        $res['remaning_days'] = $interval->days;
        $res['status'] = 2;
        $res['msg'] = 'You are already subscribed to Level ' .$userSubid->userPlan. ' plan.';
        echo json_encode($res);die();
       }else{
         $res['status'] = 3;
         echo json_encode($res);die();
       }
      }
    }else{
      $res['status'] = 3;
      echo json_encode($res);die();
    } 
    }

     //Stripe webhook handler- For caputring behind the scenes events like subscription payment fail or subscription ended
    

    // to cancel subscription
   /*  function cancelSubscription(){

        $auth_res = $this->check_ajax_auth();
        if($auth_res!==TRUE){
            echo $auth_res;  //auth failed redirect user to home/login
            exit;
        }

        $userId = $this->session->userdata('userId');
        $subsId = $this->Subscription_model->getSubscriptionId();

        if($subsId === false){
            $res['status'] = 0; $res['msg'] = lang('something_wrong');
            echo json_encode($res); exit;
        }

        $subsDetail = $this->stripe->cancel_subscription($subsId,TRUE);

        if(!empty($subsDetail['data']) && $subsDetail['data']['cancel_at_period_end'] == true){

            $isCancel = $this->common_model->updateFields(USERS,array('subscriptionStatus'=>0),array('userId'=>$userId));

            //some problem in updating payment info
            if(!$isCancel){
                $res['status'] = 0; $res['msg'] = lang('something_wrong');
                echo json_encode($res); exit;
            }
            
            $res['status'] = 1; 
            $res['msg'] = lang('biz_subs_canceled');
            $res['url'] = base_url('home/user/userProfile');
            echo json_encode($res); exit;  //success
        }
    }*/

// if subdcription is cancelled then set blank value in subscription id and status cancel
   /* function cancelSubscription($subscription_id){
        $this->db->select('userId,subscriptionId,bizSubscriptionId');
        $this->db->where(array('subscriptionId'=>$subscription_id));
        $this->db->or_where(array('bizSubscriptionId'=>$subscription_id));
        $req = $this->db->get(USERS);
       
        $isUpdated = '';
        if($req->num_rows()){ 

            $res = $req->row();
            if($res->subscriptionId == $subscription_id){

                $where = array('userId'=>$res->userId);
                $isUpdated = $this->common_model->updateFields(USERS, array('subscriptionId'=>'','subscriptionStatus'=>0),$where);

            }elseif($res->bizSubscriptionId == $subscription_id){

                $where = array('userId'=>$res->userId);
                $isUpdated = $this->common_model->updateFields(USERS, array('bizSubscriptionId'=>'','bizSubscriptionStatus'=>0),$where);

            }
        }

        if($isUpdated){
            return TRUE;
        }else{
            return FALSE;
        }
        
    } */
    
    // End of function

}