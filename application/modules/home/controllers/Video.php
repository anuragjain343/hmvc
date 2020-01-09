<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends Common_Front_Controller {

    public $data = "";

    function __construct() {
      parent::__construct();  
          $this->load->model('Video_model');
          $this->load->library('Ajax_pagination');
          $this->load->library('check_subscription');
           $this->check_user_session();
    }
    
   
    //INDEX FUNCTION TO LOAD LOGIN VIEW

  /*  public function index(){
      $this->check_user_session();
      $data['title'] = "Home";
      $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
      $this->load->front_render('home',$data,''); 
    }*/
    //END OF FUNCTION

  //INDEX FUNCTION TO LOAD LOGIN VIEW

    function informationalVideo(){
      //pr($_SESSION[USER_SESS_KEY]);
     $data['title']="informational video";
     $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css','frontend_assets/css/lightgallery.min.css');
       $data['front_js']= array('frontend_assets/js/lightgallery-all.min.js','frontend_assets/js/readmore.min.js','frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');

     $userId = $_SESSION[USER_SESS_KEY]['userId']; 
     $where = array('id'=>$userId,'userRole'=>'user');
     $userData = $this->common_model->getsingle(USERS,$where);
     $data['userId']=$userId;
      $res = $this->check_subscription->checkSsubscription();
     if($res){
       $data['userPlan']=$res;
      $this->load->front_render('informationalVideo',$data,'');
     }else{
      $data['pagetitle']='INFORMATIONAL VIDEOS';
      $this->load->front_render('defaultPage',$data,'');
     }
    }
    //END OF FUNCTION 

    // TRAINING VIDEO
    function trainingVideo(){
    $data['title']="training video";
    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css','frontend_assets/css/lightgallery.min.css');
    $data['front_js']= array('frontend_assets/js/lightgallery-all.min.js','frontend_assets/js/readmore.min.js','frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
     if(!empty($_SESSION[USER_SESS_KEY])){
      $userId = $_SESSION[USER_SESS_KEY]['userId']; 
      $where = array('id'=>$userId,'userRole'=>'user');
      $userData = $this->common_model->getsingle(USERS,$where);
      $data['userId']=$userId;
      //$data['userPlan']=$userData->userPlan;
      $res = $this->check_subscription->checkSsubscription();
        if($res){
          $data['userPlan']= $res;
          $this->load->front_render('trainingVideo',$data,'');
        }else{
          $data['pagetitle']='TRAINING VIDEOS';
          $this->load->front_render('defaultPage',$data,'');
        }
    }
  }

  function videoList(){
     $userId = $_SESSION[USER_SESS_KEY]['userId']; 
     $where = array('id'=>$userId,'userRole'=>'user');
     $userData = $this->common_model->getsingle(USERS,$where);
//pr($userData);
    if(!empty($userData->userPlan)){
      if($userData->userPlan=='1'){
        $like = array('videoLevelType'=>$userData->userPlan);
        $like1='';
        $like2=''; 
        $like3=''; 
        $like4=''; 
        $and = '';
        $where = array('postedById'=>$userData->assignTrainer);
        $where_or = array('postedById'=>'1');
      }else if($userData->userPlan=='2'){
        $like = array('videoLevelType'=>$userData->userPlan);
        $like1= array('videoLevelType'=>1);
        $and = '';
        $like2=''; 
        $like3='';
        $like4='';
        $where = array('postedById'=>$userData->assignTrainer);
        $where_or = array('postedById'=>'2');
      }
      else if($userData->userPlan=='3'){
        $like = array('videoLevelType'=>$userData->userPlan,'postedById'=>$userData->assignTrainer);
        $like1= array('videoLevelType'=>2);
        $like2= array('videoLevelType'=>1);
        $and = '';
        $like3= array('videoLevelType'=>3);
        $like4='';
        $where = array('postedById'=>$userData->assignTrainer);
        $where_or = array('postedById'=>'1');
      }else{
        $like = array('videoLevelType'=>$userData->userPlan,'postedById'=>$userData->assignTrainer);
        $like1= array('videoLevelType'=>2);
        $like2= array('videoLevelType'=>1);
        $like3= array('videoLevelType'=>3);
        $and = array('postedById'=>$userData->assignTrainer);
        $like4=array('videoLevelType'=>4);
        $where = array('postedById'=>$userData->assignTrainer);
        $where_or = array('postedById'=>'1');
      }
    }
    
    $config['base_url']       = base_url()."home/video/videoList"; 
    $config['total_rows']     = $this->Video_model->videoCount(INFORMATIONALVIDEO,$like,$where,$where_or,$like1,$like2,$like3,$like4,$and);

    $config['uri_segment']    = 4;
    $config['per_page']       = 6;
    $config['num_links']      = 5;
    $config['first_link']     = FALSE;
    $config['last_link']      = FALSE;
    $config['full_tag_open']  = '<ul class="pagination NewPage csPagination justify-content-end">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link']      = '&raquo;';
    $config['next_tag_open']  = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class']   = 'class="page-link"';
    $config['prev_link']      = '&laquo;';
    $config['prev_tag_open']  = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open']   = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close']  = '</a></li>';
    $config['num_tag_open']   = '<li class="page page-item">';
    $config['num_tag_close'] = '</li>';

    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
      $data['pagination'] = $this->ajax_pagination->create_links();
    $data['videoData'] = $this->Video_model->getAllVideo(INFORMATIONALVIDEO,$config['per_page'],$page,$like,$where,$where_or,$like1,$like2,$like3,$like4,$and);
   //pr( $config['total_rows']);
    
 //pr($data['videoData']);
    $rr= $this->load->view('get_InformationalVideo_List',$data,true);
      echo json_encode(array('data'=>$rr)); 
  
  }

  function videoTrainingList(){
     $userId = $_SESSION[USER_SESS_KEY]['userId']; 
     $where = array('id'=>$userId,'userRole'=>'user');
     $userData = $this->common_model->getsingle(USERS,$where);
    
    if(!empty($userData->userPlan)){
         if(!empty($userData->userPlan)){
      if($userData->userPlan=='1'){
        $like = array('videoLevelType'=>$userData->userPlan);
        $like1='';
        $like2=''; 
        $like3=''; 
        $like4=''; 
        $where = array('postedById'=>$userData->assignTrainer);
        $where_or = array('postedById'=>'1');
      }else if($userData->userPlan=='2'){
        $like = array('videoLevelType'=>$userData->userPlan);
        $like1= array('videoLevelType'=>1);
        $like2=''; 
        $like3='';
         $like4='';
        $where = array('postedById'=>$userData->assignTrainer);
        $where_or = array('postedById'=>'2');
      }
      else if($userData->userPlan=='3'){
        $like = array('videoLevelType'=>$userData->userPlan,'postedById'=>$userData->assignTrainer);
        $like1= array('videoLevelType'=>2);
        $like2= array('videoLevelType'=>1);
        $like3='';
         $like4='';
        $where = array('postedById'=>$userData->assignTrainer);
         $where_or = array('postedById'=>'1');
      }else{
        $like = array('videoLevelType'=>$userData->userPlan,'postedById'=>$userData->assignTrainer);
        $like1= array('videoLevelType'=>2);
        $like2= array('videoLevelType'=>1);
        $like3= array('videoLevelType'=>3);
         $like4='';
        $where = array('postedById'=>$userData->assignTrainer);
        $where_or = array('postedById'=>'1');
      }
    }
    }
    $config['base_url']       = base_url()."home/video/videoTrainingList"; 
    $config['total_rows']     = $this->Video_model->videoCount(TRAININGVIDEO, $like,$where,$where_or,$like1,$like2,$like3,$like4);
    $config['uri_segment']    = 4;
    $config['per_page']       = 6;
    $config['num_links']      = 5;
    $config['first_link']     = FALSE;
    $config['last_link']      = FALSE;
    $config['full_tag_open']  = '<ul class="pagination NewPage csPagination justify-content-end">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link']      = '&raquo;';
    $config['next_tag_open']  = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class']   = 'class="page-link"';
    $config['prev_link']      = '&laquo;';
    $config['prev_tag_open']  = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open']   = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close']  = '</a></li>';
    $config['num_tag_open']   = '<li class="page page-item">';
    $config['num_tag_close'] = '</li>';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    $data['videoData'] = $this->Video_model->getAllVideo(TRAININGVIDEO,$config['per_page'],$page, $like,$where,$where_or,$like1,$like2,$like3,$like4);
   
    $data['pagination'] = $this->ajax_pagination->create_links();
    $rr= $this->load->view('get_TrainingVideo_List',$data,true);
      echo json_encode(array('data'=>$rr)); 
  }
  


   
}//END OF CLASS
