<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Common_Front_Controller {

    public $data = "";
    function __construct() {
      parent::__construct(); 
        $this->load->library('check_subscription'); 
    }

    function setCookies(){
      if(empty($_SESSION[USER_SESS_KEY]['userId'])){
      if(!empty($_GET['referralLink'])){ 
      $id    =  decoding($_GET['referralLink']);
      $where = array('id'=>$id,'userRole'=>'trainer','showSliderTrainer'=>0);
      $check = $this->common_model->is_data_exists(USERS,$where);
        if($check){
          $data['id'] = $id;
          $cookie_name = "reffralId";
          $cookie_value =  $id;
          $cookie = array(
          'name'   => 'reffralId',
          'value'  => $id,
          'expire' => time()+86500,
          );
          setcookie($cookie_name,  $cookie_value , time()+60*30);
          return $_COOKIE['reffralId'] =  $cookie_value;
        }
      }else{
        $_COOKIE['reffralId'] = "";
           unset($_COOKIE['reffralId']);
             $res = setcookie('reffralId', '', time() - 3600);
        return FALSE;
      }
    }
    }

    //INDEX FUNCTION TO LOAD LOGIN VIEW
    public function index(){
     // pr($_SESSION);
      $getCookiesData = $this->setCookies();
      $this->check_user_session(); 
      $data['cookies'] = $getCookiesData;
      $wher                  = array('userRole'=>'trainer','showSliderTrainer'=>0);
      $order_fld              ='crd';
      $order_type             ='DESC';
      $limit                  =12;
      $data['letestTrainer']  = $this->common_model->getAll(USERS, $order_fld , $order_type, $select = 'all', $limit , $offset = '',$group_by='',$wher);

      $wher1                  = array();
      $order_fld1              ='crd';
      $order_type1             ='DESC';
      $limit1                  =4;
      $data['letestVideo']  = $this->common_model->getAll(INFORMATIONALVIDEO, $order_fld1 , $order_type1, $select1 = 'all', $limit1 , $offset1 = '',$group_by1='',$wher1);

      if(!empty($_SESSION[USER_SESS_KEY]['userId'])){
      $whers   = array('id'=>$_SESSION[USER_SESS_KEY]['userId']);
      $data['session_user']  = $this->common_model->getsingle(USERS, $whers, $fld = NULL, $order_by = '', $order = '');
      
      $trainerId = $data['session_user']->assignTrainer;
      if(!empty($trainerId) AND $trainerId!=1){
      $wher_banner                 = array('id'=>$trainerId);
      $data['banner'] = $this->common_model->getsingle(USERS, $wher_banner, $fld = NULL, $order_by = '', $order = '');
      }
    }
       //$data['articalList'] = $this->common_model->GetJoinRecord(USERS, 'id', ARTICLE, 'addedById',$field_val='',$where="",$group_by='',$order_fld='article.crd',$order_type='DESC', $limit = '3', $offset = '');
    //by sachin
    $wher_content = array('contentName'=>'content');
    $data['banner_content'] = $this->common_model->getsingle(CONTENT, $wher_content, $fld = NULL, $order_by = '', $order = '');
    //

      $data['title'] = "Home";
      $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
      //pr($data);
      $this->load->front_render('home',$data,''); 

    }
    //END OF FUNCTION

  function userLogout(){
    $this->logout();
  }

 //END OF FUNCTION 
  function isUserLogin(){
    if(!empty($_SESSION[USER_SESS_KEY])){
      $res['status'] = 1;
      echo json_encode($res);die();
    }else{
       $res['status'] = 0;
        echo json_encode($res);die();
    }
  }

   function isUserLoginAndCheckMemberShip(){
    //pr($_GET);
    if(!empty($_SESSION[USER_SESS_KEY])){
      
      if(!empty($_GET['id'])){
        $addby= $_GET['id'];

      }else{
        $addby= '';
      }
     /* $id= $_SESSION[USER_SESS_KEY]['userId'];
      $where = array('id'=>$id,'userRole'=>'user');
      $check = $this->common_model->getsingle(USERS, $where, $fld = NULL, $order_by = '', $order = '');*/
      $check = $this->check_subscription->checkSsubscription();
      if($check){
        /* if($check->assignTrainer!== $addby){
          $res['status'] = 4;
          echo json_encode($res);die(); 
        }*/
       $res['status'] = 1;
       echo json_encode($res);die(); 
      }
      else{
        $res['status'] = 2;
       echo json_encode($res);die(); 
      }
    }else{
      $res['status'] = 0;
      echo json_encode($res);die();
    }
  }
    

   function isUserCheckMemberShip(){
    if(!empty($_GET['plan'])){
      $levelVideos= $_GET['plan'];
      $ById= $_GET['postedBy'];
      $level = explode(',',$levelVideos);
    }
    if(!empty($_SESSION[USER_SESS_KEY])){
      $id= $_SESSION[USER_SESS_KEY]['userId'];
      $where = array('id'=>$id,'userRole'=>'user');
      $check = $this->common_model->getsingle(USERS, $where, $fld = NULL, $order_by = '', $order = '');
      if(!empty($check) AND ($check->userPlan!='free')){
         if($ById == $check->assignTrainer){
          foreach($level as $key => $val){

            if($check->userPlan==$val[$key] OR $check->userPlan >= $val[$key]) {
            $res['status'] = 3;
              echo json_encode($res);die(); 
            }else{
              $res['status'] = 1;
              echo json_encode($res);die(); 
          }
        }
      }else{
        $res['status'] = 4;
       echo json_encode($res);die();
      }

      }else {
        $res['status'] = 2;
       echo json_encode($res);die(); 
      }
    }else{
      $res['status'] = 0;
      echo json_encode($res);die();
    }
  }

}//END OF CLASS
