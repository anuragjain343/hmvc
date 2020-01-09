<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Coupon extends Common_Back_Controller {

   
  function __construct() {
    parent::__construct();
    $this->load->model('coupon_model'); //load membership_model 
    $this->load->library('stripe'); //stripe payment library
    $this->load->library('Ajax_pagination');
   
    
  }

  //INDEX FUNCTION TO LOAD TRAINERS LIST  VIEW
  public function index(){
    $this->check_admin_user_session();
    $data['title'] = "Coupon";
    $table = TBL_COUPON;

    $where ='';
   
    $where = array('status'=>1);    
    
    $data['coupon'] = $this->common_model->getAll($table,$order_fld = '', $order_type = '', $select = 'all',$limit = '', $offset = '',$group_by='',$where);
   
    $this->load->admin_render('coupon/couponView',$data,''); 
  
  }
  function addCoupon(){
      $this->check_admin_user_session();
      $data['title'] = "addCoupon";
      $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
       $this->load->admin_render('coupon/addCoupon',$data,''); 
  }
  function createCoupon(){
   
    $this->form_validation->set_rules('couponName', 'title', 'trim|required');
    $this->form_validation->set_rules('percentage', 'percentage','trim|required');
   // $this->form_validation->set_rules('duration','duration','required');
   

    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
     // $res['hash']= get_csrf_token()['hash']; 
      echo json_encode($res);die();
    }
   
    $productId     =  VEGAN_PRODUCT_ID;
    $nickname      =  $this->input->post('couponName');
    //$interval      =  $this->input->post('duration');
    $interval      =  'once';
    $percentage     =  $this->input->post('percentage');
    if(empty($percentage) OR $percentage==0.0){
        $res['status'] = 0;
        $res['msg'] = 'Please provide valid data.';
        echo json_encode($res);die();
    }
  
    $chekPlanData  =  $this->coupon_model->chekCoupon($nickname);
    
   // print_r($planData);die;
    if($chekPlanData ==1){
      $couponData = $this->stripe->create_coupon($nickname,$percentage,$interval);
     
      $addData = array();
      $addData['stripCouponId'] = $couponData['data']['id']; 
      $addData['couponName']= $nickname;
      $addData['discountData']= $percentage;
      $addData['duration']= $interval;
      $addData['description']= $this->input->post('couponDescription');
      $result = $this->common_model->insertData(TBL_COUPON,$addData);
      $res['status'] = 1;
   
    
      $res['msg'] = 'Coupon added successfully.';
      $res['url'] =  base_url().'admin/coupon';
    }else{
     $res['status'] = 0;
     $res['msg'] = 'Coupon already exits. Please inactive existing Coupon first to create new coupon.';
    }
    
     echo json_encode($res);
  }
  function editCoupon(){
    /*$planData = $this->stripe->update_plan('plan_EjAmsZ2yOifRf6',$interval='');
    print_r($planData);die;*/
    $this->check_admin_user_session();
     
      $data['title'] = "editCoupon";
      $stripCouponId =    decoding($this->uri->segment(4));
      $table = TBL_COUPON;
      $where = array('stripCouponId'=>$stripCouponId);
     // $data['back_js'] = array('backend_assets/custom/ckeditor/ckeditor.js');
      $data['coupon'] = $this->common_model->getsingle($table,$where);
     
      $this->load->admin_render('coupon/editCoupon',$data,''); 

  }
  function updateCoupon(){

    $this->form_validation->set_rules('couponName', 'title', 'trim|required');
    
    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
     // $res['hash']= get_csrf_token()['hash']; 
      echo json_encode($res);die();
    }
   
     $nickname     = $this->input->post('couponName');
     $stripCouponId  = $this->input->post('stripCouponId');
     $planData = $this->stripe->update_coupon($stripCouponId,$nickname);
    
    if($planData){
      $where = array();
      $updData = array();
      $updData['couponName']= $nickname;
      $where['stripCouponId'] = $stripCouponId;
      $result = $this->common_model->updateFields(TBL_COUPON,$updData,$where);
      $res['status'] = 1;
      $res['msg'] = 'Coupon updated successfully.';
      $res['url'] =  base_url().'admin/coupon';
    }
    
     echo json_encode($res);

  }
  function deletePlan(){
    $data = array();
    $where = array();
    $data['status']  = $this->input->post('status'); 
    $where['planId'] = $this->input->post('planId');
  
    $planLevel  = $this->input->post('planLevel');
    $createdBy = $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];
    $createdById = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    $chekPlanData =$this->membership_model->chekPlan($planLevel,$createdBy,$createdById);
    
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
