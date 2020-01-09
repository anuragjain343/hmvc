<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Membership extends Common_Back_Controller {

   
  function __construct() {
    parent::__construct();
    $this->load->model('membership_model'); //load membership_model 
    $this->load->library('stripe'); //stripe payment library
    $this->load->library('Ajax_pagination'); 
  }

  //INDEX FUNCTION TO LOAD TRAINERS LIST  VIEW
  public function index(){
    $this->check_admin_user_session();
    $data['title'] = "Membership";
    $data['back_js'] = array('backend_assets/js/bootbox.min.js');
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole'] =='trainer'){
           $data['plan'] = $this->membership_model->getPlanList($_SESSION[ADMIN_USER_SESS_KEY]['userId']);  
           // $where = array('createdById'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);    
      }else{
        $data['plan'] = $this->membership_model->membershipList();
      }
  
    $this->load->admin_render('membership/membershipView',$data,''); 
  
  }
  function addMembership(){
      $this->check_admin_user_session();
      $data['title'] = "addMembership";
      $table = USERS;
      $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      //get coupon for "Discount For No Referral Link"
      $data['coupon'] = $this->common_model->getAll(TBL_COUPON);
     // $data['back_js'] = array('backend_assets/custom/ckeditor/ckeditor.js');
      // $data['admin'] = $this->common_model->getsingle($table,$where);
      $this->load->admin_render('membership/addMembership',$data,''); 
  }
  function addPlan(){
    
 
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('planType', 'planType','trim|required');
    $this->form_validation->set_rules('planDescription','description','required');
   

    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
     // $res['hash']= get_csrf_token()['hash']; 
      echo json_encode($res);die();
    }
   
    $productId  = VEGAN_PRODUCT_ID;
    $nickname  = $this->input->post('title');
    $interval_count  = $this->input->post('planType');
    $planLevel  = $this->input->post('planLevel');
    $currency  = 'GBP';
    $amount  = $this->input->post('amount')*100;
    $createdBy = $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];
    $createdById = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    if($interval_count ==1){
       $interval ='month';

    }
    if($interval_count ==3){
       $interval ='3 months';

    }
    if($interval_count ==6){
       $interval ='6 months';

    }
    if($interval_count ==12){
       $interval ='yearly';

    }
    if($interval_count =='day'){
     
       $interval ='day';

    }
    $chekPlanData =$this->membership_model->chekPlan($planLevel,$createdBy,$createdById,$planId ='');
    
   // print_r($planData);die;
    if($chekPlanData ==1){
      $planData = $this->stripe->create_plan($productId,$interval_count,$currency,$amount,$nickname);
     
      $addData = array();
      $addData['stripPlanId'] = $planData['data']['id']; 
      $addData['stripProductId']= $productId;
      $addData['planName']= $nickname;
      $addData['planDuration']= $interval;
      $addData['amount']= $this->input->post('amount');
      $addData['amountType']= $currency;
      $addData['planLevel']= $planLevel;
      $addData['description']= $this->input->post('planDescription');
      $addData['defaultCouponStripeId']= $this->input->post('discountCoupon');
      $addData['createdBy'] =  $createdBy;
      $addData['createdById'] = $createdById;
      $result = $this->common_model->insertData(TBL_PLAN,$addData);
      $res['status'] = 1;
   
    
      $res['msg'] = 'Plan added successfully.';
      $res['url'] =  base_url().'admin/membership';
    }else{
     $res['status'] = 0;
     $res['msg'] = 'Plan already exits. Please inactive existing plan first to create new plan.';
    }
    
     echo json_encode($res);
  }
  function editMembership(){
    /*$planData = $this->stripe->update_plan('plan_EjAmsZ2yOifRf6',$interval='');
    print_r($planData);die;*/
    $this->check_admin_user_session();
     
      $data['title'] = "editMembership";
      $planId =    decoding($this->uri->segment(4));
      $table = TBL_PLAN;
      $where = array('planId'=>$planId);
     // $data['back_js'] = array('backend_assets/custom/ckeditor/ckeditor.js');
      $data['plan'] = $this->common_model->getsingle($table,$where);
      //get coupon for "Discount For No Referral Link"
      $data['coupon'] = $this->common_model->getAll(TBL_COUPON);
      $this->load->admin_render('membership/editMembership',$data,''); 

  }
  function updatePlan(){
   
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('planDescription','description','required');
   

    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
     // $res['hash']= get_csrf_token()['hash']; 
      echo json_encode($res);die();
    }
   
     $nickname     = $this->input->post('title');
     $stripPlanId  = $this->input->post('stripPlanId');
     $desc         = $this->input->post('planDescription');
     $type         = $this->input->post('typ');
     $planLevel  = $this->input->post('planLevel');
     $createdBy    = $this->input->post('createdBy');
     $createdById  = $this->input->post('createdById');
    /* $createdBy = $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];
     $createdById = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];*/
    
    if($type == 'admin'){
      $chekPlanData =$this->membership_model->chekPlan($planLevel,$createdBy,$createdById,$stripPlanId);
      

      if($chekPlanData){
        $planData = $this->stripe->update_plan($stripPlanId,$nickname);
        $where = array();
        $updData = array();
        $updData['planName']= $nickname;
        $updData['description']= $desc;
        $updData['defaultCouponStripeId']= $this->input->post('commonDiscount');
        $updData['status']=$this->input->post('radio');
        $where['stripPlanId'] = $stripPlanId;
        $result = $this->common_model->updateFields(TBL_PLAN,$updData,$where);
         $res['status'] = 1;
         $res['msg'] = 'Plan updated successfully.';
         $res['url'] =  base_url().'admin/membership';
        
      }else{
          $res['status'] = 0;
          $res['msg'] = 'Plan already exits. Please inactive existing plan first to active new plan..';
          $res['hash']= get_csrf_token()['hash'];
      }
    }else{
      $check = $this->membership_model->checkTrainerPlan($stripPlanId,$this->input->post('amount'));
      if($check){
          $productId  = VEGAN_PRODUCT_ID;
          $interval_count  = $this->input->post('planType');

          if($interval_count =='month'){
             $interval ='1';

          }
          if($interval_count =='3 months'){
             $interval ='3';

          }
          if($interval_count =='6 months'){
             $interval ='6';

          }
          if($interval_count =='yearly'){
             $interval ='12';

          }
         
          $currency  = 'GBP';
          $amount  = $this->input->post('amount')*100;
              
          $planData = $this->stripe->create_plan($productId,$interval,$currency,$amount,$nickname);
          
          $addData = array();
          $addData['stripPlanId'] = $planData['data']['id']; 
          $addData['stripProductId']= $productId;
          $addData['planName']= $nickname;
          $addData['planDuration']= $interval_count;
          $addData['amount']= $this->input->post('amount');
          $addData['amountType']= $currency;
          $addData['planLevel']=  $planLevel;
          $addData['description']= $desc;
          $addData['createdBy'] =  $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];
          $addData['createdById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
          $result = $this->common_model->insertData(TBL_PLAN,$addData);
          $res['status'] = 1;
          $res['msg'] = 'Plan updated successfully.';
          $res['url'] =  base_url().'admin/membership';
    
              
      }else{
          $res['status'] = 1;
          $res['msg'] = 'Plan updated successfully.';
          $res['url'] =  base_url().'admin/membership';
      }
    } 
    

    
     echo json_encode($res);die;

  }
  function deletePlan(){
    $data = array();
    $where = array();
    $data['status']  = $this->input->post('status'); 
    $where['stripPlanId'] = $this->input->post('planId');
  
    $planId       = $this->input->post('planId');
    $planLevel    = $this->input->post('planLevel');
    $createdBy    = $this->input->post('createdBy');
    $createdById  = $this->input->post('createdById');
    $chekPlanData = $this->membership_model->chekPlan($planLevel,$createdBy,$createdById,$planId);
    
   // print_r($planData);die;
    if($chekPlanData ==1){
        $result = $this->common_model->updateFields(TBL_PLAN,$data,$where);

        if($result){
          $res['status'] = 1;
          $res['msg'] = 'Status changed successfully.';
        }else{
          $res['status'] = 0;
          $res['msg'] = 'Plan is not deleted !';
          $res['hash']= get_csrf_token()['hash'];
        }
    }else{
          $res['status'] = 0;
          $res['msg'] = 'Plan already exits. Please inactive existing plan first to active new plan..';
          $res['hash']= get_csrf_token()['hash'];
    }


   
    echo json_encode($res);
  }
  

  
}//END OF CLASS