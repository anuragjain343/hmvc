<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Membership extends Common_Front_Controller {

   
  function __construct() {
    parent::__construct();
    $this->load->model('membership_model'); //load membership_model 
    $this->load->library('stripe'); //stripe payment library
    $this->load->library('Ajax_pagination');
   
    
  }

  //INDEX FUNCTION TO LOAD TRAINERS LIST  VIEW
  public function index(){
    
    // $this->check_user_session();

    $data['title']="Join Our membership";
    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');

    // pr($_SERVER);
      //
  if(empty($_SESSION[USER_SESS_KEY])){    
  if(isset($_COOKIE['reffralId'])){
    $referralId =  $_COOKIE['reffralId'];
    $where = array('users.id'=>$referralId,'userRole'=>'trainer','showSliderTrainer'=>0);
    $field_first='id';
    $trainerData= $this->common_model->GetSingleJoinRecord(USERS, $field_first,TRAINERMETA,'trainerId',$field_val='',$where);
    if(!empty($trainerData)){
      $dataplan = $this->membership_model->getPlanList(); 
      foreach ($dataplan as $key => $value) {
        if($value->planLevel==1){
          $level1     =  $value->amount;
          $stripPlanId1   =  $value->stripPlanId;
        }else if($value->planLevel==2){
          $level2   =  $value->amount;
          $stripPlanId2   =  $value->stripPlanId;
        }else if($value->planLevel==3){
          $level3   =  $value->amount;
          $stripPlanId3   =  $value->stripPlanId;
        }else{
          $level4   =  $value->amount;
          $stripPlanId4   =  $value->stripPlanId;
        }
      }
        $cop1       =$trainerData->discountLevel1;
        $cop2       =$trainerData->discountLevel2;
        $cop3       =$trainerData->discountLevel3Same;
        $cop3Other  =$trainerData->discountLevel3Other;
        $cop4       =$trainerData->discountLevel4Same;
        $cop4Other =$trainerData->discountLevel4Other;
      if($cop1){
        $wherepln= array('couponId'=>$cop1);  
        $dis1 =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
        $disLevel1 = $dis1->discountData;
        $copid1 = $dis1->stripCouponId;
      }
      if($cop2){
        $wherepln= array('couponId'=>$cop2);  
        $dis2 =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
        $disLevel2 = $dis2->discountData;
        $copid2 = $dis1->stripCouponId;
      }
      if($cop3){
        $wherepln= array('couponId'=>$cop3);  
        $dis3 =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
         $disLeve3Same = $dis3->discountData;
         $copid3 = $dis1->stripCouponId;
      }
      if($cop3Other){
        $wherepln= array('couponId'=>$cop3Other);  
        $dis3Other =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
        $disLevel3Other = $dis3Other->discountData;
        $copid4 = $dis1->stripCouponId;
      }
      if($cop4){
        $wherepln= array('couponId'=>$cop4);  
        $dis4 =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
        $disLeve4Same = $dis4->discountData;
        $copid5 = $dis1->stripCouponId;
      }
      if($cop4Other){
        $wherepln= array('couponId'=>$cop4Other);  
        $dis4Other =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
        $disLevel4Other = $dis4Other->discountData;
        $copid6 = $dis1->stripCouponId;
      }

      if(!empty($level1)){
        $totalLavel1  =($level1)-($level1*$disLevel1)/100;
      }

      if(!empty($level2)){
        $totalLavel2     =($level2)-($level2*$disLevel2)/100;
      }

      if(!empty($level3)){
        $totalLavel3Same =($level3)-($level3*$disLeve3Same)/100;
        $totalLavel3Other =($level3)-($level3*$disLevel3Other)/100;
      }else{
        $totalLavel3Same='';
        $totalLavel3Other='';
      }
      if(!empty($level4)){
        $totalLavel4Same  =($level4)-($level4*$disLeve4Same)/100;
        $totalLavel4Other =($level4)-($level4*$disLevel4Other)/100;
      }else{
        $totalLavel4Same='';
        $totalLavel4Other='';
      }

      $data['trainerId']= $trainerData->trainerId;
      $data['trainerplans'] = $this->membership_model->getPlanList();
      
      if(!empty($level1)){
       $data['totalLavel1']=$totalLavel1; 
      }

      if(!empty($level2)){
        $data['totalLavel2']=$totalLavel2; 
      }
      if(!empty($level3)){
        $data['totalLavel3Same']=$totalLavel3Same; 
        $data['totalLavel3Other']=$totalLavel3Other;
      }
      if(!empty($level4)){
        $data['totalLavel4Same']=$totalLavel4Same;
        $data['totalLavel4Other']=$totalLavel4Other;
      }
        $data['coupon1']=$copid1;
        $data['coupon2']=$copid2;
        $data['coupon3']=$copid3;
        $data['coupon4']=$copid4;
        $data['coupon5']=$copid5;
        $data['coupon6']=$copid6;

        $data['coupon1Dis']=$disLevel1;
        $data['coupon2Dis']=$disLevel2;
        $data['coupon3Dis']=$disLeve3Same;
        $data['coupon4Dis']=$disLevel3Other;
        $data['coupon5Dis']=$disLeve4Same;
        $data['coupon6Dis']=$disLevel4Other;
        
      }else{
         $data['plan'] = $this->membership_model->getPlanList(); 
      }
    }else{
      $data['plan'] = $this->membership_model->getPlanList(); 
    }
  }else{
     
     $data['plan'] = $this->membership_model->getPlanList(); 
   }
    //if(!empty($data['plan'])){
      $this->load->front_render('membership/membership',$data,'');
   // }

   /* else{
     $this->load->front_render('membership/nomembership',$data,'');
    }*/
  
      
  }
  

  
}//END OF CLASS
 