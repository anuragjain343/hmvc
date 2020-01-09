<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends Common_Back_Controller {

    public $data = "";


  function __construct() {
    parent::__construct();
    $this->load->model('image_model');
    $this->load->model('User_model');
    $this->load->library('Ajax_pagination');
    $this->load->model('membership_model'); 
  }

  //INDEX FUNCTION TO LOAD TRAINERS LIST  VIEW
  public function index(){
    $this->check_admin_user_session();
    $data['title'] = "Users";
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['back_js'] = array('backend_assets/js/bootbox.min.js');
    $data['admin'] = $this->common_model->getsingle($table,$where);

    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'userRole'=>'user');
    }else{
     $type= array('userRole'=>'user');
    }
    $like='';
    $data['total_rows'] = $this->User_model->userCount($type,$like);
    //pr($data['total_rows']);
    $this->load->admin_render('user',$data,''); 
  
  }
  //END OF FUNCTION


  // USERS LIST  AJAX FUNCTION 
  function user_List1(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'userRole'=>'user');
    }else{
     $type= array('userRole'=>'user');
    }

    if(isset($_POST['id'])){
      $userlevel = $_POST['id'];
    }
    if(!empty($_POST['search'])){
      $search =$_POST['search'];
    }
    //pr($trainerlevel);
    $config['base_url'] = base_url()."admin/users/user_List";
    if(!empty($userlevel)){
      $where = array('userPlan'=>$userlevel);
      $config['total_rows'] = $this->User_model->userCountByLevele($type,$where);
    }else if(!empty($search)){
      $where4 = array('fullName'=>$search);
      $config['total_rows'] = $this->User_model->userCountBySearch($type,$where4);
     //pr($config['total_rows']);
    }else{
    $config['total_rows'] = $this->User_model->userCount($type);
    }

    $config['uri_segment'] =4;
    $config['per_page'] = 6;
    $config['num_links'] = 5;
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class'] = '';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active1"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    if(!empty($userlevel)){
      $where1 = array('userPlan'=>$userlevel);
    $data['userList'] = $this->User_model->getAllUserByLevel($config['per_page'],$page,$type,$where1);
    }else if(!empty($search)){
      $where4 = array('fullName'=>$search);
      $data['userList'] = $this->User_model->getAllUserBySearch($config['per_page'],$page,$type,$where4);
     // pr( $config['userList']);
    }else{
       $data['userList'] = $this->User_model->getAllUser($config['per_page'],$page,$type);
    }
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    if(isset($_POST['id'])){

       $data['cat']= $_POST['id'];
    }else{
       $data['cat']= '';
    }
  // pr($data['userList']);
    $rr= $this->load->view('get_User_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));    
  }
  //END OF FUNCTION
    function user_List(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'userRole'=>'user');
    }else{
     $type= array('userRole'=>'user');
    }
     $like='';
    if(!empty($_POST['id']) AND empty($_POST['search'])){
      $userlevel = $_POST['id'];
       $type= array('userRole'=>'user','userPlan'=>$userlevel);

    }else if(!empty($_POST['search']) AND empty($_POST['id'])){
      $search =$_POST['search'];
      $like= $search;
      //$like= array('fullName'=>$search);
       //pr('in srdc');

    }else if(!empty($_POST['id']) AND !empty($_POST['search'])){
      // pr('in src');
      $userlevel = $_POST['id'];
      $type= array('userRole'=>'user','userPlan'=>$userlevel);
      $like= $_POST['search'];   

    }else{
     // pr('in def');
     $type= array('userRole'=>'user'); 
     $like='';
    }
   // pr($userlevel);
    $config['base_url'] = base_url()."admin/users/user_List";
    $config['total_rows'] = $this->User_model->userCount($type,$like);
  
    $config['uri_segment'] =4;
    $config['per_page'] = 6;
    $config['num_links'] = 5;
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class'] = '';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active1"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
       $config['paginate_call'] = 'ajax_fun';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);

    if(!empty($_POST['id']) AND empty($_POST['search'])){
      $userlevel = $_POST['id'];
       $type= array('userRole'=>'user','userPlan'=>$userlevel);

    }else if(!empty($_POST['search']) AND empty($_POST['id'])){
      $search =$_POST['search'];
      $like= $search;
       //pr('in srdc');

    }else if(!empty($_POST['id']) AND !empty($_POST['search'])){
      // pr('in src');
      $userlevel = $_POST['id'];
      $type= array('userRole'=>'user','userPlan'=>$userlevel);
      $like= $_POST['search'];   

    }else{
     // pr('in def');
     $type= array('userRole'=>'user'); 
     $like='';
    }

    $data['userList'] = $this->User_model->getAllUser($config['per_page'],$page,$type,$like);
    
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    if(isset($_POST['id'])){

       $data['cat']= $_POST['id'];
    }else{
       $data['cat']= '';
    }
  // pr($data['userList']);
    $rr= $this->load->view('get_User_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));    
  }


  //INDEX FUNCTION TO LOAD inactive LIST  VIEW
  public function inactiveUsers(){
    $this->check_admin_user_session();
    $data['title'] = "inactiveUsers";
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['back_js'] = array('backend_assets/js/bootbox.min.js');
    $data['admin'] = $this->common_model->getsingle($table,$where);
    $this->load->admin_render('inacriveUsers',$data,''); 
  
  }
  //END OF FUNCTION
    // USERS LIST  AJAX FUNCTION 
  function inactiveUser_List(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'userRole'=>'user','status'=>'0');
    }else{
     $type= array('userRole'=>'user','status'=>'0');
    }
    $like='';
    if(!empty($_POST['id']) AND empty($_POST['search'])){
      $userlevel = $_POST['id'];
       $type= array('userRole'=>'user','userPlan'=>$userlevel,'status'=>'0');

    }else if(!empty($_POST['search']) AND empty($_POST['id'])){
      $search =$_POST['search'];
      $like= $search;
      //$like= array('fullName'=>$search);
       //pr('in srdc');

    }else if(!empty($_POST['id']) AND !empty($_POST['search'])){
      // pr('in src');
      $userlevel = $_POST['id'];
      $type= array('userRole'=>'user','userPlan'=>$userlevel,'status'=>'0');
      $like= $_POST['search'];   

    }else{
     // pr('in def');
     $type= array('userRole'=>'user','status'=>'0'); 
     $like='';
    }
  
    $config['total_rows'] = $this->User_model->userCount($type,$like);
    

    $config['uri_segment'] =4;
    $config['per_page'] = 6;
    $config['num_links'] = 5;
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class'] = '';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active1"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    $like='';
    if(!empty($_POST['id']) AND empty($_POST['search'])){
      $userlevel = $_POST['id'];
       $type= array('userRole'=>'user','userPlan'=>$userlevel,'status'=>'0');
    }else if(!empty($_POST['search']) AND empty($_POST['id'])){
      $search =$_POST['search'];
      $like= $search;
      //$like= array('fullName'=>$search);
       //pr('in srdc');

    }else if(!empty($_POST['id']) AND !empty($_POST['search'])){
     
      $userlevel = $_POST['id'];
      $type= array('userRole'=>'user','userPlan'=>$userlevel,'status'=>'0');
      $like= $_POST['search'];   

    }else{
     // pr('in def');
     $type= array('userRole'=>'user','status'=>'0'); 
     $like='';
    }

    $data['userList'] = $this->User_model->getAllUser($config['per_page'],$page,$type,$like);
    
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    if(isset($_POST['id'])){
      $data['cat']= $_POST['id'];
    }else{
       $data['cat']= '';
    }
   
    $rr= $this->load->view('get_inactiveUser_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));    
  }
  //END OF FUNCTION
  function guestUser(){
    $this->check_admin_user_session();
     if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
    $data['title'] = "Guest Users";
    $table = 'guestUser';
    $where = array();
    $data['back_js'] = array('backend_assets/js/bootbox.min.js');
    $data['admin'] = $this->common_model->getsingle($table,$where);
    $search='';
    $data['total_user'] = $this->User_model->gusteUserCount($search);
    $this->load->admin_render('guestUsers',$data,''); 
    }
  }

  function guestUser_List(){

    $config['base_url'] = base_url()."admin/users/guestUser_List";
    if(!empty($_POST['search'])){
      $search = $_POST['search'];
    }else{
      $search='';
    }
    $config['total_rows'] = $this->User_model->gusteUserCount($search);
  
    $config['uri_segment'] =4;
    $config['per_page'] = 6;
    $config['num_links'] = 5;
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class'] = '';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active1"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
   
    if(!empty($_POST['search'])){
      $search = $_POST['search'];
    }else{
      $search='';
    } 
    $data['userList'] = $this->User_model->getAllGusteUser($config['per_page'],$page,$search);

    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    
    $rr= $this->load->view('get_guestUser_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash'])); 
  }

  // DELETE USER 
  function deleteUser(){
    $id = $this->input->post('userId');
    $where = array('id'=>$id,'userRole'=>'user');
    $response = $this->common_model->deleteData(USERS,$where);

    if($response){
      $res['status'] = 1;
      $res['msg'] = 'User deleted successfully.';
    }else{
      $res['status'] = 0;
      $res['msg'] = 'User is not deleted !';
      $res['hash']= get_csrf_token()['hash'];
    }
    echo json_encode($res);
  }
  //END OF FUNCTION
  
  //USER DETALIS 
  function userDetails(){
    $this->check_admin_user_session();
    $data['title']='User Details';
    $data['back_css'] = array('backend_assets/css/lightgallery.min.css','backend_assets/css/owl.carousel.min.css','backend_assets/css/owl.theme.default.min.css');
    $data['back_js'] = array('backend_assets/js/lightgallery-all.min.js','backend_assets/js/owl.carousel.min.js','backend_assets/css/owl.theme.default.min.css','backend_assets/js/custom.js');
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin'] = $this->common_model->getsingle(USERS,$where);
    $id =decoding($this->uri->segment(4));
    $whereUser= array('id'=>$id,'userRole'=>'user');
    $data['user'] = $this->common_model->getsingle(USERS,$whereUser);
    $userid = $data['user'];
    if($userid->assignTrainer!=0){
    $assignTrainer = array('id'=>$userid->assignTrainer,'userRole'=>'trainer');
    $data['assignTrainer'] = $this->common_model->getsingle(USERS,$assignTrainer);
    }
    if(!empty($userid->userPlan)){
      $data['uplan']=$userid->userPlan;
      $data['plan'] = $this->membership_model->getPlanListForUser($_SESSION[ADMIN_USER_SESS_KEY]['userId']);
     
    }

    $this->load->admin_render('userDetail',$data,''); 
  }
  //END OF FUNCTION
    function userInfo(){
    $this->check_admin_user_session();
    $data['title']='User Details';
    $data['back_css'] = array('backend_assets/css/lightgallery.min.css','backend_assets/css/owl.carousel.min.css','backend_assets/css/owl.theme.default.min.css');
    $data['back_js'] = array('backend_assets/js/lightgallery-all.min.js','backend_assets/js/owl.carousel.min.js','backend_assets/css/owl.theme.default.min.css','backend_assets/js/custom.js');
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin'] = $this->common_model->getsingle(USERS,$where);
    $id =decoding($this->uri->segment(4));
    //pr($id);
    $whereUser= array('id'=>$id,'userRole'=>'user');
    $data['user'] = $this->common_model->getsingle(USERS,$whereUser);
    $userid = $data['user'];
    if($userid->assignTrainer!=0){
    $assignTrainer = array('id'=>$userid->assignTrainer,'userRole'=>'trainer');
    $data['assignTrainer'] = $this->common_model->getsingle(USERS,$assignTrainer);
    }
    if(!empty($userid->userPlan)){
      $data['uplan']=$userid->userPlan;

      $data['plan'] = $this->membership_model->getPlanListForUser(1);
     
    }

    $this->load->admin_render('userInfo',$data,''); 
  }

    function userStatus(){
    if($_GET['userId']){  
      $userId = $_GET['userId'];
      $where = array('id'=>$userId);
      $status = $this->common_model->is_data_exists(USERS,$where)->status;
      //pr($status);
      if($status==1 || $status==0){
        if($status == 1){
          $statusChange = 0;
        }else{
          $statusChange = 1;
        }
        $data = array('status'=>$statusChange);
        $this->common_model->updateFields(USERS, $data, $where);
        $res['status'] = 1;
        $res['msg'] = 'Status changed successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'problem !';
      }
    }
    echo json_encode($res);
  }//END OF FUNCTION

   // DELETE TRAINRE 
  function deleteInactiveUser(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 
    $id = $this->input->post('userId');
    $where = array('id'=>$id,'userRole'=>'user','status'=>'0');
    $response = $this->common_model->deleteData(USERS,$where);

    if($response){
      $res['status'] = 1;
      $res['msg'] = 'User deleted successfully.';
    }else{
      $res['status'] = 0;
      $res['msg'] = 'User is not deleted !';
      $res['hash']= get_csrf_token()['hash'];
    }
    echo json_encode($res);
  }
  
}//END OF CLASS
