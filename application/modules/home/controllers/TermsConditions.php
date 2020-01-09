<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TermsConditions extends Common_Front_Controller {

    public $data = "";
    function __construct() {
      parent::__construct(); 
        $this->load->library('check_subscription'); 
    }
    //INDEX FUNCTION TO LOAD LOGIN VIEW
    public function index(){
     

      if(!empty($_SESSION[USER_SESS_KEY]['userId'])){
      $whers   = array('id'=>$_SESSION[USER_SESS_KEY]['userId']);
      $data['session_user']  = $this->common_model->getsingle(USERS, $whers, $fld = NULL, $order_by = '', $order = '');
      $trainerId = $data['session_user']->assignTrainer;
      if(!empty($trainerId) AND $trainerId!=1){
      $wher_banner                 = array('id'=>$trainerId);
      $data['banner'] = $this->common_model->getsingle(USERS, $wher_banner, $fld = NULL, $order_by = '', $order = '');
      }
    }
      $data['title'] = "Terms Conditions";
      $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
      //pr($data);
      $this->load->front_render('Terms_Conditions',$data,''); 
 
  }

}//END OF CLASS
