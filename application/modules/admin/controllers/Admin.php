<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends Common_Back_Controller {

    public $data = "";


  function __construct() {
    parent::__construct();
   $this->load->model('image_model');

  }

  //INDEX FUNCTION TO LOAD LOGIN VIEW
  public function index(){
    $data['title'] ='Admin';
    $this->check_admin_user_session();
    $this->load->view('login',$data);   

  }
  //END OF FUNCTION

  //LOGIN FUNCION 
  public function login(){  
    $res =array();
    $this->form_validation->set_rules('userName', 'Username/Email', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if($this->form_validation->run() == FALSE){
      foreach($_POST as $key =>$value){
        $res['messages'][$key] = form_error($key);
        $res['messages']['hash'] =   get_csrf_token()['hash'];
      }
    }else{ 
      $userName = sanitize_input_text($this->input->post('userName'));
      $password = sanitize_input_text($this->input->post('password'));
      $email    = $userName;
      $where = array('email'=>$email);
      $this->load->model('login_model');
      $isLogin = $this->login_model->isLogin($where,$password,USERS);
      if($isLogin == TRUE){
        $usertyp = $this->common_model->getsingle(USERS,$where);
        if($usertyp->userRole=='admin'){
         $res['messages']['successU']  =  'Logged in successfully. Redirecting...';
         $res['url']= base_url().'admin/dashboard';
        }else{

          if($usertyp->allPrivileges=='1'){
            $res['messages']['successT']  =  'Logged in successfully. Redirecting...';
            $res['url']= base_url().'admin/trainers/dashboard';
          }else{
            $res['messages']['successT']  =  'Logged in successfully. Redirecting...';
            $res['url']= base_url().'admin/trainers/specialTrainerDeshboard';
          }

        }
       
      }else{
        $res['messages']['unsuccess']  ='Invalid email address or password' ;
        $res['messages']['hash'] =   get_csrf_token()['hash'];
      }
    }
    echo !empty($res) ?json_encode($res): redirect('admin'); //USED JSON ENCODE TO SHOW ERROR THROUGH AJAX.
  }
  //END OF FUNCTION

  // DASHBOARD FUNCTION 
  function dashboard(){
      $this->check_admin_user_session();
       if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/dashboard');
      }
      $data['total_recepie']= $this->common_model->get_total_count(RECEPIE);
      $data['title'] = "Dashboard";
      $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['admin'] = $this->common_model->getsingle(USERS,$where);
      $whereCount = array('userRole'=>'trainer');
      $data['total_trainer']= $this->common_model->get_total_count(USERS,$whereCount);
      $whereCount = array('userRole'=>'user');
      $data['total_user']= $this->common_model->get_total_count(USERS,$whereCount);
      $total_infovideo = $this->common_model->get_total_count(INFORMATIONALVIDEO);
      $total_trainvideo = $this->common_model->get_total_count(TRAININGVIDEO);
       $data['total_video'] =$total_infovideo+$total_trainvideo;
      $data['total_article']= $this->common_model->get_total_count(ARTICLE);
      $data['total_forum']= $this->common_model->get_total_count(FOURM);
      $data['total_training']= $this->common_model->get_total_count(TRAINING);
      $data['total_nutrition']= $this->common_model->get_total_count(NURRITIONGUIDANCE);
      $data['total_recommended']= $this->common_model->get_total_count(RECOMMENDEDPRODUCTS);
      $this->load->admin_render('dashboard',$data,'');
  }
  //END OF FUNCTION

  //NOTIFICATION LIST
  function notifictionList(){
    $this->check_admin_user_session();
    $userId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    $where = array('notificationFor'=>$userId,'webNotify'=>'0');
    $count = $this->common_model->get_total_count(NOTIFICATIONS, array('notificationFor'=>$userId,'isRead'=>'0'));
    $notifiList = $this->common_model->getsingle(NOTIFICATIONS, $where);
    if(!empty($notifiList)){
    $userdata = $this->common_model->getsingle(USERS, array('id'=>$notifiList->notificationBy));
    }
    if(!empty($userdata)){
      $userName= $userdata->fullName;
    }
    if($notifiList){
      $updateData = array('webNotify'=>'1');
      $whereUpdate = array('id'=>$notifiList->id);
      $this->common_model->updateFields(NOTIFICATIONS,$updateData,$whereUpdate);
      $uid = encoding($notifiList->referenceId);

      if($notifiList->notificationType=='delete_article'){
        $url=  base_url().'admin/article/deleteAticle/'.$uid;
      }elseif($notifiList->notificationType=='delete_training_video'){
        $url=  base_url().'admin/video/deleteTrVideoByAdmin/'.$uid;
      }
      else{
        $url=  base_url().'admin/video/deleteVideoByAdmin/'.$uid;
      }

      $msg = json_decode($notifiList->notificationMessage);
      $msgSend = str_replace("[UNAME]",$userName,$msg->body);
      $title = $msg->title; //set title for show 
      echo json_encode(array('status'=>1,'html'=>$msgSend,'title'=>$title,'url'=>$url,'count'=>$count));die;
    }
    echo json_encode(array('status'=>0,'count'=>$count));die;
  }
  //END OF FUNCTION

  //USER NOTIFICATION LIST DROPDOWN
   function userNotificationList(){
     $this->check_admin_user_session();
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
        $userid = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $where = array('notificationFor'=>$userid);
        $field_first ='notificationBy';
        $field_second ='id';
        $field_val ='*';
        $limit=20;
        $data['notifiList'] = $this->common_model->GetJoinRecord(NOTIFICATIONS, $field_first,USERS,$field_second,$field_val='',$where,$group_by='',$order_fld='createdOn',$order_type='DESC',$limit);
        $res =$this->load->view('notificationList',$data,true);
        echo json_encode(array('data'=>$res,'status'=>1));die();
      }else{
        $userid = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $where = array('notificationFor'=>$userid);
        $field_first ='notificationFor';
        $field_second ='id';
        $field_val ='*';
        $limit=20;

       $data['notifiList'] = $this->common_model->GetJoinRecord(NOTIFICATIONS, $field_first,USERS,$field_second,$field_val='',$where,$group_by='',$order_fld='createdOn',$order_type='DESC',$limit);
        $res =$this->load->view('notificationList',$data,true);
        echo json_encode(array('data'=>$res,'status'=>1));die();   
      }
    }
    //END OF FUNCTION

    //UPDATE NOTIFICATION  WHEN USER READ NOTIFICATION
    function updateNotification(){
      $id= $_GET['id'];
      $userid = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      $where = array('referenceId'=>$id,'notificationFor'=>$userid);
      $data = array('isRead'=>1); 
      $update = $this->common_model->updateFields(NOTIFICATIONS, $data, $where);
      if($update){
       echo json_encode(array('status'=>1));die();    
      }
    }
    //END OF FUNCTION 

  //ADMIN/TRAINER LOGOUT FUNCCTION
  function adminLogout($is_redirect=TRUE){
    $this->admin_logout();
  }
  //END OF FUNCTION

  //Admin profile view load
  function adminProfile(){
    $this->check_admin_user_session();
    //pr(get_admin_session_data());
    $data['title']='Admin Profile';
    $data['trainer'] = $this->common_model->getsingle(USERS,array('id' => get_admin_session_data()['userId']));
    $this->load->admin_render('adminProfile',$data);
  } //end

  //Edit Admin Profile
  function editProfile(){

    $this->check_admin_ajax_auth();
    $userData = get_admin_session_data();
    //pr($userData);
    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[20]');

    if($this->form_validation->run() == FALSE){ 
        $response = array('status' => 0, 'message' => validation_errors()); //error msg
        echo json_encode($response); die;
    }
    if(!empty($_FILES['profileImage']['name'])){
      //if image not empty set it for store image 
      $upload = $this->image_model->upload_image('profileImage', 'profile');
      //check for error
      if(!empty($upload['error']) && array_key_exists("error", $upload)){
        $response = array('status' => 0, 'message' =>strip_tags($upload['error']));
        echo json_encode($response); die;
      }
      $data['profileImage'] = $upload;
    }
    if(!empty($this->input->post('name')))
    $data['fullName'] = sanitize_input_text($this->input->post('name'));
    $update =  $this->common_model->updateFields(USERS, $data, array('id' => $userData['userId']));
    $where_in = array('id' => $userData['userId']);
    $updated_session = $this->common_model->getsingle(USERS,$where_in);
    $_SESSION[ADMIN_USER_SESS_KEY]['name'] = $updated_session->fullName ;
    $_SESSION[ADMIN_USER_SESS_KEY]['image']  = $updated_session->profileImage ;
    $response = array('status' => 1,'message' =>'Your profile updated successfully', 'url' => base_url('admin/adminProfile'));    
  
    echo json_encode($response);
  }//End Function

  //change admin password
  function changePassword(){
    $this->check_admin_ajax_auth();
    $userData = get_admin_session_data();
    $this->form_validation->set_rules('oldPassword', 'Old password', 'required');
    $this->form_validation->set_rules('newPassword', 'New password', 'required|min_length[4]|max_length[32]');
    $this->form_validation->set_rules('cNewPassword', 'Confirm password', 'required|matches[newPassword]');
    if($this->form_validation->run() == FALSE){ 
          $response = array('status' => 0, 'message' => validation_errors()); //error msg
          echo json_encode($response); die;
    }
    $oldPassword =$this->input->post('oldPassword');
      $newPassword =$this->input->post('newPassword');
      $userPassword = $this->common_model->getsingle(USERS,array('id'=>$userData['userId']),'password');
      
      if(password_verify($oldPassword, $userPassword->password)){

        //check curent and new password are same
            if(password_verify($newPassword, $userPassword->password)){
                //set msg for new password are same 
                $response = array('status'=>0,'message'=>'Current password and New Password are same');
                echo json_encode($response); die;
            }
          $set = password_hash($newPassword, PASSWORD_DEFAULT);
          $data['password'] = $set;
            $update = $this->common_model->updateFields(USERS, $data, array('id'=>$userData['userId'])); 
            $response = array('status' => 1, 'message' => 'Password updated successfully'); //error msg
          echo json_encode($response); die;
          
      }else{
          $response = array('status' => 0, 'message' => 'Please enter correct old password'); //error msg
          echo json_encode($response); die;  
      }

  } //end Fn

}//END OF CLASS
