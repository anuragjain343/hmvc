<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Common_Front_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();  
          $this->load->model('image_model');
          $this->load->model('Login_model');

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
  
	//LOGIN FUNCION 
    public function login(){  
  
        $res =array();
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run() == FALSE){
            foreach($_POST as $key =>$value){
              $res['messages'][$key] = form_error($key);
              $res['messages']['hash1'] =   get_csrf_token()['hash'];
            }
        }
        else{ 
            $password = sanitize_input_text($this->input->post('password'));
            $userName = sanitize_input_text($this->input->post('email'));
            $redirecturl = $this->input->post('redirecturl');
            $rememberMe = $this->input->post('rememberMe');
            $email = $userName;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $where = array('userName'=>$email,'userRole'=>'user');
            }else{
                 $where = array('email'=>$email,'userRole'=>'user');
            }
            $this->load->model('login_model');
            $where1 = array('email'=>$email,'userRole'=>'user','status'=>1);
            
            $isLogin = $this->login_model->isLogin($where,$password,USERS,$rememberMe);
            //pr($isLogin);
            if($isLogin == 'login'){
                if(isset($_COOKIE['reffralId'])){
                  $cookie_name = 'reffralId';
                  $_COOKIE['reffralId']='';
                  unset($_COOKIE[$cookie_name]);
                  $re = setcookie($cookie_name, ' ', time() - 3600);
                  //pr($_COOKIE['reffralId']);
                  
                }
               $res['messages']['success']  = 'Logged in successfully. Redirecting...';
               $res['messages']['redirecturl']  =  $redirecturl;
            }else if($isLogin == 'inactive'){
              $res['messages']['unsuccess'] = 'You are account is temporary diactivate';
              $res['messages']['hash1'] =   get_csrf_token()['hash'];
            }
            else{
              $res['messages']['unsuccess'] = 'Invalid email address or password';
              $res['messages']['hash1'] =   get_csrf_token()['hash'];
            }

    	}
    	//echo !empty($res) ?json_encode($res): redirect('home'); //USED JSON ENCODE TO SHOW ERROR THROUGH AJAX.
      echo json_encode($res);
    }
    //END OF FUNCTION

    // ADD USER[Customer] FUNCTION
    function addUser(){

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');
        if($this->form_validation->run() == FALSE){
          $res['status'] = 0;
          $res['msg'] = validation_errors();
           $res['hash']= get_csrf_token()['hash'];
          echo json_encode($res);die();
        }
        $email = sanitize_input_text(strtolower($this->input->post('email')));
        $where =array('email'=>$email);
        $check = $this->common_model->is_data_exists(USERS,$where);
        if($check){
            $response = array('status' =>FAIL, 'msg' =>'Email already exists','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die; 
            return false;
        }else{
        if(!empty($_FILES['profileImage']['name'])) {
          $folder = 'userProfile'; //Set folder for upload  profile image   
          $result = $this->image_model->upload_image('profileImage', $folder);
          if (is_array($result) && array_key_exists('error', $result)){
            $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
          }else{
            $data['profileImage'] =$result;
          }   
        }
       
        $data['fullName'] = sanitize_input_text($this->input->post('name'));
        $data['email']    = sanitize_input_text(strtolower($this->input->post('email')));
        $pass             = sanitize_input_text($this->input->post('password'));
        $newurl             = sanitize_input_text($this->input->post('newurl'));

        $freeuser         = $this->input->post('freeuser');
        $data['password'] =  password_hash($pass,PASSWORD_DEFAULT);
        $data['userRole'] =  'user';
        $data['userPlan'] =  'free';
        $data['crd']      =    $data['upd'] = datetime();
        $rememberMe = $this->input->post('rememberMe');
        $signupIdLink = $this->input->post('signupId');
        
        /*if(!empty($signupIdLink)){
          $data['signupId'] = $signupIdLink;
          $data['signupPlan'] = 'free';
        }
        */
        $response = $this->common_model->insertData(USERS,$data);

        if(!empty($_COOKIE['reffralId']) AND !empty($freeuser)){
            $getTrainerId= $_COOKIE['reffralId'];

          $sqldata['trainerInfo'] = $this->common_model->getsingle('trainerMeta',array('trainerId' => $getTrainerId));   
          // pr($sqldata);
          $datapay['userId']=$response;
          $datapay['PlanId']='';
          $datapay['PlanLevel']='5';
          $datapay['commissionTrainerId']= $getTrainerId;
          $datapay['trainerCommission']= $sqldata['trainerInfo']->commissionFree;
          $datapay['paymentType']='once';
          $datapay['fromSignup']=1;
          $datapay['paymentStatus']='succeeded';
          $datapay['crd'] = datetime();
          $datapay['upd'] = datetime();
          $responsepay = $this->common_model->insertData(PAYMENT,$datapay);
          $newurl= base_url();

         }
         if(empty($_COOKIE['reffralId']) AND !empty($freeuser)){
            $getTrainerId=0;
            $datapay['userId']=$response;
            $datapay['PlanId']='';
            $datapay['PlanLevel']='5';
            $datapay['commissionTrainerId']= $getTrainerId;
            $datapay['trainerCommission']=0;
            $datapay['paymentType']='once';
            $datapay['fromSignup']=1;
            $datapay['paymentStatus']='succeeded';
            $datapay['crd'] = datetime();
            $datapay['upd'] = datetime();
            $responsepay = $this->common_model->insertData(PAYMENT,$datapay);
            $newurl= base_url();
         }

        if(!empty($rememberMe)){
          $cookie_name    = 'mvt_remember_me_token';
          $random_token   = generate_random_token();
          $token_value    = generate_auth_token($random_token);
          $cookie_value  = $token_value;
          $domain = '/';
          setcookie($cookie_name, $cookie_value, time() + (86400 * 14), $domain); 
          $token_hash = password_hash($random_token, PASSWORD_DEFAULT);
          $arra = explode(':',$token_value);
          $dataIns['selector']        = $arra[0];
          $dataIns['hashedValidator'] = $token_hash;
          $dataIns['user_id']         = $response;
          $rememberm = $this->common_model->insertData('auth_token',$dataIns); 
        }

     if($response){
        $sql = $this->db->select('*')->where(array('id'=>$response))->get(USERS);
        if($sql->num_rows()){
            $user= $sql->row();
            $session_data['userId']     = $user->id ;
            $session_data['emailId']    = $user->email;
            $session_data['name']       = $user->fullName;
            $session_data['image']      = $user->profileImage;
            $session_data['userPlan']   = $user->userPlan;
            $session_data['isLogin']    = TRUE;
            $session_data['UserRole']   = 'user';
            $_SESSION[USER_SESS_KEY]    = $session_data;
           // pr($_SESSION[USER_SESS_KEY]);

          $userData['firstName']= $user->fullName;
          $userData['email']    = $user->email;
          $userData['password'] = $pass;

          $message     = $this->load->view('emails/welcome_email',$userData,TRUE); 
          $subject     = "My Vegan Trainer -User credentials ";
          $this->load->library('smtp_email');
          $sen_email = $this->smtp_email->send_mail($user->email,$subject,$message);
          //$sen_email=TRUE;
          if($sen_email!=TRUE){
            $res['status'] = 0;
            $res['msg'] = 'Eamil is not sent!';
            $res['hash']= get_csrf_token()['hash']; 
            echo json_encode($res);die();
          }

         }else{
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wrong!';
          $res['hash']= get_csrf_token()['hash'];
         }
          if(!empty($this->input->post('refralId'))){

              $trainerId = $this->input->post('refralId');
 /*              $comis =   $this->common_model->getsingle(TRAINERMETA,$where = array('trainerId'=>$trainerId,$fld='totalCommission');
                  if($comis){
                      if($level == 1 ){
                          $commission =$comis->commissionLevel1;
      
                      }
                      if($level == 2){
                           $commission =$comis->commissionLevel2;
                      }
      
                      if($level == 3){
      
                        $commission =$comis->commissionLevel3Same;
                         
                      }
                      if($level == 4){
      
                          $commission =$comis->commissionLevel4Same;
                        
                      }
                  }*/
            $res['status'] = 2;
            $res['refralId'] = $this->input->post('refralId');
            $res['msg'] = 'Account created successfully. Redirecting...';
          }else{
            $res['status'] = 1;
            $res['msg'] = 'Account created successfully. Redirecting...';
            if(!empty($newurl)){
            $res['newurl']=$newurl;  
            }
          }

       
          
        }else{
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wrong!';
          $res['hash']= get_csrf_token()['hash'];
        }
        //pr($res);
      echo json_encode($res);
    }
  }

/*  function selectTrainer(){
    $this->check_user_session();
    $where = array('userRole'=>'trainer');
    $data['allTrainer'] = $this->common_model->getAll(USERS, $order_fld = 'crd', $order_type = 'DESC', $select = 'all',$limit = '10', $offset = '',$group_by='',$where);
    $data['title']="Select Trainer";
    $this->load->front_render('allTrainer',$data,'');
  }

  function membership(){
    $this->check_user_session();
    $data['title']="Join Our membership";
    $this->load->front_render('membership',$data,'');
  }*/
   
  function payment(){
   //pr($_SESSION);
    $this->check_user_session();
    if(isset($_GET['id'])){
      $data['trainer'] = decoding($_GET['id']);
    }
    
    if(isset($_GET['referrallink'])){
      $referrallink    = decoding($_GET['referrallink']);
    }

    if(isset($_GET['plan'])){ 
      $data['plan']   = $_GET['plan']; 
    }        
    
    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
    $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js','frontend_assets/js/bootbox/bootbox.min.js');
   // $data['trainerId'] =decoding($this->uri->segment(3));
    $data['title']="Payment";
    $data['planPrice']=$this->common_model->getsingle(TBL_PLAN,$where = array('stripPlanId'=>$_GET['stripPlanId']),$fld='amount');
    $this->load->front_render('payment',$data,'');
  }
  
  function paymentUser(){
    return true;
/*    $trainer                 = sanitize_input_text($this->input->post('trainer'));
    $user                    = sanitize_input_text($this->input->post('user'));
    $level                    = sanitize_input_text($this->input->post('level'));
    if(empty($trainer) OR $trainer =='z1'){
     $data['assignTrainer']   = 1; 
     $data['userPlan']   =   $level; 
    }else{
    $data['assignTrainer']   = $trainer;
     $data['userPlan']      =  $level; 
    }
    $where =array('id'=>$user,'assignTrainer !='=>'0');
    $check = $this->common_model->is_data_exists(USERS, $where);
    if($check){
      $res['status']    =   2;
      $res['msg']       =  'You allready buy this plan!';
      $res['hash']      =  get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $where                   = array('id'=>$user);
    $response                = $this->common_model->updateFields(USERS, $data, $where);
    if($response){
      $res['status'] = 1;
      $res['msg'] = 'Payment successfully done!.';
      $issset = $this->Login_model->session_create($user);
      $this->load->helper('cookie');
      delete_cookie("reffralId");
    }else{
      $res['status']    =   0;
      $res['msg']       =   'Somthing went wrong!';
      $res['hash']     =   get_csrf_token()['hash'];

    }
     echo json_encode($res);*/
  }
  //FORGOT PASSWORD USERS
  function forgotPassword(){
    $this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      echo json_encode($res);die();
    }
    $email = sanitize_input_text($this->input->post('email'));
    $where =array('email'=>$email,'userRole'=>'user');
    $check = $this->common_model->is_data_exists(USERS,$where);
    //pr($check);status
    if(!$check){
        $response = array('status'=> 0, 'msg' =>'Email does not  exists','hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die; 
    }else{
      if($check->status ==1){
      $userData['password']  = mt_rand(10000000, 99999999);
      $userData['email']    = $email;
      $message   = $this->load->view('emails/user_forgot_password',$userData,TRUE); 
      $subject   = "MyVeganTrainer - Reset password";
      $this->load->library('smtp_email');
      $sen_email = $this->smtp_email->send_mail($userData['email'],$subject,$message);
      if($sen_email!=TRUE){
        $res['status'] = 0;
        $res['msg'] = 'Eamil is not sent!';
        $res['hash']= get_csrf_token()['hash']; 
        echo json_encode($res);die();
      }else{
        $pass             =   $userData['password'];
        $where            =   array('email'=>$email);
        $data['password'] =   password_hash($pass,PASSWORD_DEFAULT);
        $update           = $this->common_model->updateFields(USERS, $data, $where);
        if($update!=TRUE){
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wong';
          $res['hash']= get_csrf_token()['hash']; 
          echo json_encode($res);die();
        }else{
          $res['status'] = 1;
          $res['msg'] = 'We have sent you an email with reset password instructions. Please check your inbox or spam folder.';  
        }
      }
    }else{
       $response = array('status'=> 0, 'msg' =>'You are account is temporary diactivate','hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die; 
    }
    }
    echo json_encode($res);
  }
  //END OF FUNCTION 

  // user profile view load
  function userProfile(){
                                                                       //pr($_SESSION);
    $this->check_user_session();
    $data['title']="User Profile";
    $data['userDetail'] = $this->common_model->getsingle(USERS,array('id' => get_user_session_data()['userId']));
    $trainerId = $data['userDetail']->assignTrainer;
    $data['trainerInfo'] = $this->common_model->getsingle(USERS,array('id'=>$trainerId));
    $this->load->model('User_model');
      $user = $_SESSION[USER_SESS_KEY]['userId'];
      $field_first= 'subscriptionId';
      $field_second= 'stripeSubscriptionId';
      $field_three='referenceId';
      $sid =0;

    if(!empty($data['userDetail']->subscriptionId)){
      $sid = $data['userDetail']->subscriptionId;
      //pr($sid );
      $where1 = array('userSubscription.stripeSubscriptionId'=>$sid);
      $joindata = $this->common_model->GetJoinRecordThree('users',$field_first,'userSubscription', $field_second, 'payment',$field_three,$field_val='',$where1);
      //pr($joindata);
      if(!empty($joindata)){
        $data['planInfo'] = $this->User_model->user_Plan_info($joindata->PlanId);
        $jsonData = json_decode($joindata->subscriptionJson);
        $end_time='';
        if(!empty($jsonData->data->current_period_end)){
          $endDate= $jsonData->data->current_period_end;
          $end_time = date('Y-m-d H:i:s', $endDate);
          $current_time = datetime();
          $date1 = new DateTime($current_time);
          $date2 = new DateTime($end_time);
          $interval = $date1->diff($date2);
          $data['remaning_days'] = $interval->days;
        }
      }
    }

    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
    $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');

    $this->load->front_render('profile',$data);
  }
  //Edit user Profile

  function updateProfile(){
    $this->check_ajax_auth();
    $userData = get_user_session_data();
    //pr($userData);
    $this->form_validation->set_rules('fullName', 'fullName', 'trim|required|min_length[2]|max_length[20]');
    // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

    // $where = array('id !=' => $userData['userId'], 'email' => $this->input->post('email'));
    // $user = $this->common_model->getsingle(USERS, $where);
    // if(!empty($user)){
    //   if($this->input->post('email') == $user->email){
    //     $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',array('is_unique' => 'This email address is already exists.'));
    //   }
    // }

    if($this->form_validation->run() == FALSE){ 
        $response = array('status' => 0, 'message' => validation_errors()); //error msg
        echo json_encode($response); die;
    }
    if(!empty($this->input->post('fullName')))
    $data['fullName'] = sanitize_input_text($this->input->post('fullName'));
    // if(!empty($this->input->post('email')))
    // $data['email'] = sanitize_input_text($this->input->post('email'));
    $update =  $this->common_model->updateFields(USERS, $data, array('id' => $userData['userId']));
    $where_in = array('id' => $userData['userId']);
    $updated_session = $this->common_model->getsingle(USERS,$where_in);
    $_SESSION[USER_SESS_KEY]['name'] = $updated_session->fullName ;
    //$_SESSION[USER_SESS_KEY]['emailId']  = $updated_session->email ;
    $response = array('status' => 1,'message' =>'Your profile updated successfully', 'url' => base_url('home/users/userProfile'));    
  
    echo json_encode($response);
  }//End Function

  // update user profile image
  function uploadUserImage(){
    $this->check_ajax_auth();
    $userData = get_user_session_data();
    if(!empty($_FILES['profileImage']['name'])){
      //if image not empty set it for store image 
      $upload = $this->image_model->upload_image('profileImage', 'userProfile');
      //check for error
      if(!empty($upload['error']) && array_key_exists("error", $upload)){
        $response = array('status' => 0, 'message' =>strip_tags($upload['error']));
        echo json_encode($response); die;
      }
      $data['profileImage'] = $upload;
    }
    $update =  $this->common_model->updateFields(USERS, $data, array('id' => $userData['userId']));

      $_SESSION[USER_SESS_KEY]['image']=$upload;
   

    $response = array('status' => 1,'message' =>'Your profile image updated successfully', 'url' => base_url('home/users/userProfile'));    
  
    echo json_encode($response);
  } //End function

  //change password
  function changeUserPassword(){
     
     $this->check_ajax_auth();
    $userData = get_user_session_data();
    $this->form_validation->set_rules('oldPassword', 'Old password', 'required');
    $this->form_validation->set_rules('newPassword', 'New password', 'required|min_length[6]|max_length[32]');
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
  }

  // other user/admin profile view load
  function otherUserProfile(){
    $this->check_user_session();
    $this->load->model('User_model');
    $data['title']="Other User Profile";
    $id =decoding($this->uri->segment(4)); //get userId
    $data['userDetail'] = $this->User_model->otherUserDetail($id);
    //pr($data['userDetail']);
    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
    $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
    $this->load->front_render('other-user-profile',$data);
  } //End Function

  function test(){
   
    $this->load->library('check_subscription');
    $res = $this->check_subscription->checkSsubscription();
    echo $res;
     
  }
   
}//END OF CLASS
