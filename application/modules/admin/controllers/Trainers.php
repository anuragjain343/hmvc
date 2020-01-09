<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Trainers extends Common_Back_Controller {

    public $data = "";


  function __construct() {
    parent::__construct();
    $this->load->model('image_model');
    $this->load->model('Trainer_model');
    $this->load->model('User_model');
    $this->load->model('Recepie_model');
    $this->load->model('Forum_model');
    $this->load->model('Article_model');
    $this->load->library('Ajax_pagination');
    $this->load->model('report_model');
    $this->load->model('Video_model');
    $this->load->model('membership_model'); 
  }

  //INDEX FUNCTION TO LOAD TRAINERS LIST  VIEW
  public function index(){

    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      redirect('admin/dashboard');
    }
    $this->check_admin_user_session();
    $data['parent'] = "Trainer";
    $data['title'] = "Trainer";
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['back_js'] = array('backend_assets/js/bootbox.min.js');
    $data['admin'] = $this->common_model->getsingle($table,$where);
    $type = 'trainer';
    $data['total_trainer'] = $this->Trainer_model->trainerCount($type);
    
    $this->load->admin_render('trainer',$data,''); 
  
  }
  //END OF FUNCTION
  function dashboard(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin' ){
        redirect('admin/dashboard');
      }
      if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0'){
        redirect('admin/trainers/specialTrainerDeshboard');
      }
      $trainerId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      $this->check_admin_user_session();
      $data['title'] = "TrinerDashboard";
      $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['admin'] = $this->common_model->getsingle(USERS,$where);
      $tId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      $whereCountCustomer = array('assignTrainer'=>$tId);
      $data['total_customer']= $this->common_model->get_total_count(USERS,$whereCountCustomer);

      $whereCountVideo = array('postedBy'=>'trainer','postedByid'=>$trainerId);
     $total_video_ir= $this->common_model->get_total_count(INFORMATIONALVIDEO,$whereCountVideo);

      $whereCountVideotraing = array('postedBy'=>'trainer','postedByid'=>$trainerId);
      $total_video_tr= $this->common_model->get_total_count(TRAININGVIDEO,$whereCountVideotraing);
      $data['total_video']= $total_video_ir+$total_video_tr;

      $whereArticle =array('addedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['total_article']= $this->common_model->get_total_count(ARTICLE,$whereArticle);

      $whereTrainig =array('addedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['total_training']= $this->common_model->get_total_count(TRAINING,$whereTrainig);

      $whereNutrition =array('addedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['total_nutrition']= $this->common_model->get_total_count(NURRITIONGUIDANCE,$whereNutrition);

      $whereProduct =array('addedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['total_recommended']= $this->common_model->get_total_count(RECOMMENDEDPRODUCTS,$whereProduct);

      $whereRecepie =array('addedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['total_recepie']= $this->common_model->get_total_count(RECEPIE,$whereRecepie);
      $data['total_forum']= $this->common_model->get_total_count(FOURM);  
      $this->load->admin_render('dashboard',$data,'');
  }
    function specialTrainerDeshboard(){
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin' ){
        redirect('admin/dashboard');
      }
      $trainerId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      $this->check_admin_user_session();
      $data['title'] = "TrinerDashboard";
      $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['admin'] = $this->common_model->getsingle(USERS,$where);
     $data['back_js'] = array('backend_assets/js/chart.min.js','backend_assets/js/column.js');
    $this->load->admin_render('specialTrainerDeshboard',$data,'');
  }

  // TRAINER LIST  AJAX FUNCTION 
  function trainer_List(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 
   
    $type = 'trainer';
    $config['base_url'] = base_url()."admin/trainers/trainer_List";
    if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('fullName'=>$search1);
      $config['total_rows']  =$this->Trainer_model->trainerCountSearch($type,$search);
    }else{
    $config['total_rows'] = $this->Trainer_model->trainerCount($type);
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
     if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('fullName'=>$search1);
       $data['trainerList'] = $this->Trainer_model->getAllTrainerSearch($config['per_page'],$page,$type,$search);
     
    }else{
    $data['trainerList'] = $this->Trainer_model->getAllTrainer($config['per_page'],$page,$type);
   }

    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_trainer']= $config['total_rows'];
    $rr= $this->load->view('get_Trainer_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));
         
  }
  //END OF FUNCTION

  // ADD TRAINER VIEW  FUNCTION
  function addTrainer(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      redirect('admin/dashboard');
    }
    $this->check_admin_user_session();
    $data['parent']       = "Add Trainer";
    $data['title']        = "Add Trainer";
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin'] = $this->common_model->getsingle($table,$where);
    $data['allCoupons'] = $this->common_model->getAll('coupons', $order_fld = '', $order_type = '', $select = 'all', $limit = '', $offset = '',$group_by='',$where='');
    $this->load->admin_render('addTrainer',$data,''); 
  }
  // END OF FUNCTION
   
  // ADD TRAINER FUNCTION
  function add_trainer(){
    //pr($_POST);
    $this->form_validation->set_rules('TrainerName', 'Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
    $this->form_validation->set_rules('password','Password','trim|required');
    $this->form_validation->set_rules('details','Details','trim|required');
   // $this->form_validation->set_rules('userPlan','User Plan','trim|required');
    $link = $this->input->post('PersonaliseLink');

    if(!empty($link)){
      $this->form_validation->set_rules('commissionFree', 'Commission Free', 'trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel1', 'Commission Level 1','trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel2','Commission Level 2','trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel3Same','Commission Level 3 Same','trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel3Other','Commission Level 3 Other','trim|numeric|required');

      $this->form_validation->set_rules('commissionLevel4Same','Commission Level 4 Same','trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel4Other','Commission Level 4 Other','trim|numeric|required');

      $this->form_validation->set_rules('discountLevel1','DiscountLevel1','trim|numeric|required');
      $this->form_validation->set_rules('discountLevel2','DiscountLevel2','trim|numeric|required');
      $this->form_validation->set_rules('discountLevel3Same','Discount Level 3 Same','trim|numeric|required');
      $this->form_validation->set_rules('discountLevel3Other','Discount Level 3 Other','trim|numeric|required');

      $this->form_validation->set_rules('discountLevel4Same','Discount Level 4 Same','trim|numeric|required');
      $this->form_validation->set_rules('discountLevel4Other','Discount Level 4 Other','trim|numeric|required');
    }
    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash']; 
      echo json_encode($res);die();
    }
      $commissionFree         = $this->check_commission($this->input->post('commissionFree'));
      $commissionLevel1       = $this->check_commission($this->input->post('commissionLevel1'));
      $commissionLevel2       = $this->check_commission($this->input->post('commissionLevel2'));
      $commissionLevel3Same   = $this->check_commission($this->input->post('commissionLevel3Same'));
      $commissionLevel3Other  = $this->check_commission($this->input->post('commissionLevel3Other'));

      $commissionLevel4Same   = $this->check_commission($this->input->post('commissionLevel4Same'));
      $commissionLevel4Other  = $this->check_commission($this->input->post('commissionLevel4Other'));

      $discountLevel1         = $this->check_commission($this->input->post('discountLevel1'));

      $where          = array('couponId'=>$discountLevel1);
      $d1  = $this->common_model->getsingle('coupons',$where);


      $discountLevel2         = $this->check_commission($this->input->post('discountLevel2'));
      $where          = array('couponId'=>$discountLevel2);
      $d2  = $this->common_model->getsingle('coupons',$where);

      $discountLevel3Same     = $this->check_commission($this->input->post('discountLevel3Same'));
      $where          = array('couponId'=>$discountLevel3Same);
      $d3  = $this->common_model->getsingle('coupons',$where);

    

      $discountLevel3Other    = $this->check_commission($this->input->post('discountLevel3Other'));

      $where          = array('couponId'=>$discountLevel3Other);
      $d4  = $this->common_model->getsingle('coupons',$where);

      $discountLevel4Same     = $this->check_commission($this->input->post('discountLevel4Same'));

      $where          = array('couponId'=>$discountLevel4Same);
      $d5  = $this->common_model->getsingle('coupons',$where);

      $discountLevel4Other    = $this->check_commission($this->input->post('discountLevel4Other'));

      $where          = array('couponId'=>$discountLevel4Other);
      $d6  = $this->common_model->getsingle('coupons',$where);


      if(!empty($link) AND ($commissionLevel1 == 'FALSE' OR $commissionFree == 'FALSE' OR  $commissionLevel2 == 'FALSE' OR $commissionLevel3Same =='FALSE' OR $commissionLevel3Other == 'FALSE' OR $commissionLevel4Same=='FALSE' OR $commissionLevel4Other=='FALSE'  OR $discountLevel1 == 'FALSE' OR $discountLevel2 =='FALSE' OR $discountLevel3Same =='FALSE' OR $discountLevel3Other =='FALSE' OR  $discountLevel4Same=='FALSE' OR $discountLevel4Other=='FALSE')){

          $res['status'] = 0;
          $res['msg'] = 'Commission and  discount field value between 0-100';
          $res['hash']= get_csrf_token()['hash']; 
          echo json_encode($res);die(); 
      }
    $email = sanitize_input_text($this->input->post('email'));
    $where =array('email'=>$email);
    $check = $this->common_model->is_data_exists(USERS,$where);
    if($check){
      $response = array('status' =>FAIL, 'msg' =>'Email already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }else{
      if(!empty($_FILES['profileImage']['name'])){
        $folder = 'profile'; //Set folder for upload  profile image   
        $result = $this->image_model->upload_image('profileImage', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => '-1','msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
           echo json_encode($response); exit;
        }else{
          $data['profileImage'] =$result;
        }   
      }
      $data['fullName'] = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('TrainerName'))));
      $data['email']    = sanitize_input_text($this->input->post('email'));
      $data['details']  = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('details'))));
      $pass             = sanitize_input_text($this->input->post('password'));

      $uPlan            = $this->input->post('userPlan');
     // pr($uPlan);
      if(empty($uPlan)){
          $res['status'] = 0;
          $res['msg'] = 'User plan field required';
          $res['hash']= get_csrf_token()['hash']; 
          echo json_encode($res);die();
      }else{
      $data['userPlan'] = $uPlan;
      }
     
      $isShow           = $this->input->post('showSliderTrainer');
      $privileges       = $this->input->post('privileges');

      if(!empty($link)){
        if($isShow=='on'){
          $data['showSliderTrainer']  = 1;
        }else{
          $data['showSliderTrainer']  = 0;
        }
      }

      if($privileges=='on'){
        $data['allPrivileges']  = 1;
      }else{
        $data['allPrivileges']  = 0;
      }
      
      if(!empty($link)){
        $data['promote']=1;
      }else{
        $data['promote']=0;
      }
     

      $data['password'] =  password_hash($pass,PASSWORD_DEFAULT);
      $data['userRole'] =  'trainer';
      $data['crd'] =    $data['upd'] = datetime();
      $response = $this->common_model->insertData(USERS,$data);
      if($response AND !empty($link)){
        $trainerMeta['trainerId']             = $response;
        $trainerMeta['showTrainer']           =sanitize_input_text($this->input->post('showTrainer'));
        $trainerMeta['commissionFree']        =round($commissionFree,3);
        $trainerMeta['commissionLevel1']      =round($commissionLevel1,3);
        $trainerMeta['commissionLevel2']      =round($commissionLevel2,3);
        $trainerMeta['commissionLevel3Same']  =round($commissionLevel3Same,3);
        $trainerMeta['commissionLevel3Other'] =round($commissionLevel3Other,3);

        $trainerMeta['commissionLevel4Same']  =round($commissionLevel4Same,3);
        $trainerMeta['commissionLevel4Other'] =round($commissionLevel4Other,3);

        $trainerMeta['discountLevel1']      =  $discountLevel1;
        $trainerMeta['discountLevel2']       = $discountLevel2;
        $trainerMeta['discountLevel3Same']    =$discountLevel3Same;
        $trainerMeta['discountLevel3Other']   =$discountLevel3Other;

        $trainerMeta['discountLevel4Same']    =$discountLevel4Same;
        $trainerMeta['discountLevel4Other']   =$discountLevel4Other;

        $trainerMeta['crd']                   = $trainerMeta['upd']=datetime();
        $trainerMetaResponce = $this->common_model->insertData(TRAINERMETA,$trainerMeta);

        if(empty($trainerMetaResponce)){
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wrong!';
          $res['hash']= get_csrf_token()['hash']; 
         echo json_encode($res);die();
        }
      }

      $userData['firstName']    =  $data['fullName'];
      $userData['email']        =  $data['email'];
      $userData['password']     =  $pass;
      $userData['details']      =  $data['details'];

      $userData['commissionFree']         =  $trainerMeta['commissionFree'];
      $userData['commissionLevel1']       =  $trainerMeta['commissionLevel1'];
      $userData['commissionLevel2']       =  $trainerMeta['commissionLevel2'];
      $userData['commissionLevel3Same']   =  $trainerMeta['commissionLevel3Same'];
      $userData['commissionLevel3Other']  =  $trainerMeta['commissionLevel3Other'];
      $userData['commissionLevel4Same']   =  $trainerMeta['commissionLevel4Same'];
      $userData['commissionLevel4Other']  =  $trainerMeta['commissionLevel4Other'];

      $userData['discountLevel1']         =  $d1->discountData;
     
      $userData['discountLevel2']         =  $d2->discountData;
      

      $userData['discountLevel3Same']     =  $d3->discountData;
     
      $userData['discountLevel3Other']    = $d4->discountData;
      
      $userData['discountLevel4Same']     =  $d5->discountData;
     
      $userData['discountLevel4Other']    =  $d6->discountData;
     

      if(!empty($link)){
      $userData['referralLink'] =  base_url().'?referralLink='.encoding($response); 
      }
      $message                  = $this->load->view('emails/trainer_details',$userData,TRUE); 
      $subject                  = "My Vegan Trainer -Trainer credentials ";
      $this->load->library('smtp_email');
      $sen_email = $this->smtp_email->send_mail($userData['email'],$subject,$message);
      //$sen_email =TRUE;
      if($sen_email!=TRUE){
       $res['status'] = 0;
        $res['msg'] = 'Eamil is not sent!';
        $res['hash']= get_csrf_token()['hash']; 
        echo json_encode($res);die();
      }
      if($response){
        $res['status'] = 1;
        $res['msg'] = 'Trainer added successfully and an email has been sent.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Trainer is not added successfully!';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }
  }
  //END OF FUNCTION 
  function check_commission($comm){
    if($comm>=0 AND $comm<=100){
     return $comm; 
    }
    else{
      return 'FALSE';
    }
  }

  // DELETE TRAINRE 
  function deleteTrainer(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 
    $id = $this->input->post('userId');
    $where = array('id'=>$id,'userRole'=>'trainer');
    $response = $this->common_model->deleteData(USERS,$where);

    if($response){
      $res['status'] = 1;
      $res['msg'] = 'Trainer deleted successfully.';
    }else{
      $res['status'] = 0;
      $res['msg'] = 'Trainer is not deleted !';
      $res['hash']= get_csrf_token()['hash'];
    }
    echo json_encode($res);
  }
  //END OF FUNCTION
  
  //TRAINER DETALIS 
  function trainerDetails(){
    $this->check_admin_user_session();

     if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
      }
    $data['title']='Trainer  Details';
    $data['back_css'] = array('backend_assets/css/lightgallery.min.css','backend_assets/css/owl.carousel.min.css','backend_assets/css/owl.theme.default.min.css');
    
    $data['back_js'] = array('backend_assets/js/lightgallery-all.min.js','backend_assets/js/owl.carousel.min.js','backend_assets/css/owl.theme.default.min.css','backend_assets/js/custom.js','backend_assets/js/chart.min.js','backend_assets/js/column.js');

    $id =decoding($this->uri->segment(4));
    $wheretrainer = array('id'=>$id);
    $data['trainer'] = $this->common_model->getsingle(USERS,$wheretrainer);
    $data['tnrId']=$id;
    if($this->uri->segment(5) == 'admin' AND $this->uri->segment(6) == 'admin'){
      $data['title']='Admin Profile';
      $this->load->admin_render('adminProfile',$data,'');
    }else{
      $type1 = array('commissionTrainerId'=>$id);
      $data['level4Same'] = $this->report_model->getAllUserRep($type1);

      $type2 = array('commissionTrainerId'=>$id,'PlanLevel'=>'5');
      $data['level4Same2'] = $this->report_model->getAllUserRep($type2);
   
      $type = array('commissionTrainerId'=>$id);
      $where1 = 'DATE(`pm`.`crd`) = CURDATE()';
      $data['today'] = $this->report_model->getAllUserRep1($type,$where1);

      $where2 =  '`pm.crd` > DATE_SUB(CURDATE(), INTERVAL 7 DAY)';
      $data['week'] = $this->report_model->getAllUserRep1($type,$where2);
  
      $where3  =  '`pm.crd` > DATE_SUB(CURDATE(), INTERVAL 30 DAY)';
      $data['month'] = $this->report_model->getAllUserRep1($type,$where3);
     //$this->load->admin_render('report/reportView',$data,''); 
      $hwereTrainer = $id;
      $data['MonthComm'] = $this->report_model->getAllcomm($hwereTrainer);
      $data['MonthDisc'] = $this->report_model->getAllDis($hwereTrainer);
      $data['WeekComm'] = $this->report_model->getAllWeekComm($hwereTrainer);
      $data['WeekDisc'] = $this->report_model->getAllWeekDis($hwereTrainer);

      $data['yearCom'] = $this->report_model->getAllYearComm($hwereTrainer);
      $data['yearDis'] = $this->report_model->getAllYearDis($hwereTrainer);


      //pr($data['level4Same']);
      //$data['yearComm'] = $this->report_model->getAllDis($hwereTrainer);
      $this->load->admin_render('trainerDetail',$data,''); 
   }
  }
  //END OF FUNCTION
    function report_user_List_V1(){
      $type='';
      $id= $this->input->post('userId');
      $mnt= $this->input->post('mnt');
      $mycus= $this->input->post('mycus');
      //print_r('ff');
     // pr($mnt);
      $type = array('commissionTrainerId'=>$id);
      $type2 = array('trainerId'=>$id);
      $trainer= $id;
      if(!empty($_GET['month'])){
        $month = $_GET['month'];
      }else{
        $month='0';
      }
      $customer='';
      if(!empty($_GET['customer'])){
         $customer = $_GET['customer'];
        // pr($customer);
      }
       if(!empty($_GET['trainer'])){
           $trainer = $_GET['trainer'];
      }
      if(!empty($mnt)){
        //pr('ij');
          $month = $mnt;
          $trainer = $id;
      }
      if(!empty($mycus) AND $mycus==1){
          $customer=$mycus;
      }
       // pr($customer);
      /*$month= $this->input->post('month');
      $customer= $this->input->post('customer');*/
     
      $type3 ='';
      $type4='';
      $type5='';
     
      if(!empty($month) AND !empty($customer)){

        $type3 = array('MONTH(`pm`.`crd`)'=>$month);
        //$type4 = array('commissionTrainerId'=>$trainer);
        
        $type5 = array('trainerId'=>$trainer);

      } 

      if(empty($month) AND $month=='0' AND !empty($customer)){
        if($month=='0'){
          $month='';
        }
        $type = array('MONTH(`pm`.`crd`)'=>$month);
        $type1 = array('trainerId'=>$trainer);
        //$type = array('commissionTrainerId'=>$trainer);

      } 


      /*if(!empty($customer) AND empty($month)){
          $type3 = array('pm.trainerId'=>$id,'trainerId'=>$id);
      }*/
      if($customer!=1 AND !empty($month)){
       //pr('in');
          $type3 = array('MONTH(`pm`.`crd`)'=>$month);
          $type4 = array('commissionTrainerId'=>$trainer);
          $type5 = array('trainerId'=>$trainer);
      }


    $config['base_url'] = base_url()."admin/trainers/report_user_List";
    $config['total_rows'] = $this->report_model->userCount($type,$type2,$type3,$type4,$type5);
    //pr($config['total_rows']);
    $config['uri_segment']    = 4;
    $config['per_page']       = 6;
    $config['num_links']      = 5;
    $config['first_link']     = FALSE;
    $config['last_link']      = FALSE;
    $config['full_tag_open']  = '<ul class="pagination">';
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
    $config['paginate_call'] = 'ajax_fun33';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

    $this->ajax_pagination->initialize($config);
    $data['userList'] = $this->report_model->getAllUser($config['per_page'],$page,$type,$type2,$type3,$type4,$type5);
    //pr($data['userList']);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    $data['trId']= $id;
    $data['cat']= $month;
  
    $rr= $this->load->view('report/sub_user',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));    
  }
  //end of report 


   function report_user_List(){

     
      $mnt = $this->input->post('mnt');
      $mycus = $this->input->post('mycus');

      $id= $this->input->post('userId');

      $type1= array('commissionTrainerId'=>$id,'commissionTrainerId!='=>0);
      $type2= array('trainerId'=>$id);

      $type7= array('commissionTrainerId'=>$id,'commissionTrainerId!='=>0);
      $type8= array('trainerId'=>$id);
      $type9='';
      $month= $this->input->post('month');
      $customer= $this->input->post('customer');

      if(!empty($_GET['month'])){
        $month = $_GET['month'];
      }else{
        $month='0';
      }

      $customer='';
      if(!empty($_GET['customer'])){
         $customer = $_GET['customer'];
      }

      if(!empty($_GET['trainer'])){
        $id = $_GET['trainer'];
      }

      if(!empty($mnt)){
        $month = $mnt;
      }
      if(!empty($mycus) AND $mycus==1){
          $customer=$mycus;
      }
     
      $type3 ='';  $type4 =''; $type5 =''; $type6 ='';

      if(!empty($month) AND !empty($customer)){

        $type1=''; $type2=''; $type3=''; $type4=''; $type5='';

        $type6= array('commissionTrainerId'=>$id,'trainerId'=>$id);
        $type9= array('MONTH(`pm`.`crd`)'=>$month);
      }

      if(!empty($customer) AND empty($month)){
      //$type3 = array('pm.trainerId'=>$id,'trainerId'=>$id);
      $type1=''; $type2='';  $type4=''; $type5='';$type6='';
      $type3= array('commissionTrainerId'=>$id,'trainerId'=>$id);
      }
      if(empty($customer) AND !empty($month)){
      //pr('ds');
      // $type3 = array('MONTH(`pm`.`crd`)'=>$month);
      $type1=''; $type2=''; $type3='';$type6='';
      $type4= array('commissionTrainerId'=>$id);
      $type5= array('trainerId'=>$id);
      $type9= array('MONTH(`pm`.`crd`)'=>$month);

      }

      //pr($trainerlevel);
      $config['base_url'] = base_url()."admin/trainers/report_user_List";
      $config['total_rows'] = $this->report_model->userCount1($type1,$type2,$type3,$type4,$type5,$type6,$type9);
      //pr($config['total_rows']);
      $config['uri_segment']    = 4;
      $config['per_page']       = 6;
      $config['num_links']      = 5;
      $config['first_link']     = FALSE;
      $config['last_link']      = FALSE;
      $config['full_tag_open']  = '<ul class="pagination">';
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
      $config['paginate_call'] = 'ajax_fun33';
      $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

      $this->ajax_pagination->initialize($config);
      $data['userList'] = $this->report_model->getAllUser1($config['per_page'],$page,$type1,$type2,$type3,$type4,$type5,$type6,$type7,$type8,$type9);
      //pr($data['userList']);
      $data['pagination'] = $this->ajax_pagination->create_links();
      $data['hash'] =   get_csrf_token()['hash'];
      $data['total_user']= $config['total_rows'];
      $data['trId']= $id;
       $data['cat']= $month;
      $rr= $this->load->view('report/sub_user',$data,true);
      echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));    

  }


  //forum list
    function forum_List(){
    $id= $this->input->post('userId');  
    $type= array('addedById'=>$id);
    $config['base_url']       = base_url()."admin/trainers/forum_List";
    $config['total_rows']     = $this->Forum_model->forumCountInTrainerDetails($type);
    $config['uri_segment']    = 4;
    $config['per_page']       = 6;
    $config['num_links']      = 5;
    $config['first_link']     = FALSE;
    $config['last_link']      = FALSE;
    $config['full_tag_open']  = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link']      = '&raquo;';
    $config['next_tag_open']  = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class']   = '';
    $config['prev_link']      = '&laquo;';
    $config['prev_tag_open']  = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open']   = '<li class="active1"><a>';
    $config['cur_tag_close']  = '</a></li>';
    $config['num_tag_open']   = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $config['paginate_call'] = 'ajax_fu44';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    $data['forumList'] = $this->Forum_model->getAllForumInTrainerDetails($config['per_page'],$page,$type);  
                  
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_fourm']= $config['total_rows'];
    $rr= $this->load->view('get_Forum_List_in_trainerdetails',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));       
  }
  //end of function
   //CUSTMER LIST
   function customers(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      redirect('admin/dashboard');
    }
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0'){
      redirect('admin/trainers/specialTrainerDeshboard');
    }
    $data['title'] = "Customers";
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['back_js'] = array('backend_assets/js/bootbox.min.js');
    $data['admin'] = $this->common_model->getsingle($table,$where);
    
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'userRole'=>'user');
    }
    $like='';
    $data['total_user'] = $this->User_model->userCount($type,$like);
    $this->load->admin_render('customers',$data,''); 
   }
   //END OF FUNCTION

  // USERS LIST  AJAX FUNCTION 
  function customer_List(){
    
     if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0'){
        redirect('admin/trainers/specialTrainerDeshboard');
      }

    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'userRole'=>'user');
    }
    

   /*if(isset($_POST['id'])){
      $userlevel = $_POST['id'];
    }

    if(!empty($userlevel)){
      $where = array('userPlan'=>$userlevel);
      $config['total_rows'] = $this->User_model->userCountByLevele($type,$where);
    }else{
    $config['total_rows'] = $this->User_model->userCount($type,$like);
    }*/
    $like='';
    if(!empty($_POST['id']) AND empty($_POST['search'])){
      $userlevel = $_POST['id'];
       $type= array('userRole'=>'user','userPlan'=>$userlevel,'assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);

    }else if(!empty($_POST['search']) AND empty($_POST['id'])){
      $search =$_POST['search'];
      $like= $search;
      //$like= array('fullName'=>$search);
       //pr('in srdc');

    }else if(!empty($_POST['id']) AND !empty($_POST['search'])){
      // pr('in src');
      $userlevel = $_POST['id'];
      $type= array('userRole'=>'user','userPlan'=>$userlevel,'assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $like= $_POST['search'];   

    }else{
     // pr('in def');
     $type= array('userRole'=>'user','assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']); 
     $like='';
    }
    $config['base_url'] = base_url()."admin/trainers/customer_List";
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

    /* if(!empty($userlevel)){
      $where1 = array('userPlan'=>$userlevel);
    $data['userList'] = $this->User_model->getAllUserByLevel($config['per_page'],$page,$type,$where1);
    }else{
       $data['userList'] = $this->User_model->getAllUser($config['per_page'],$page,$type,$like);
    }
    if(isset($_POST['id'])){

       $data['cat']= $_POST['id'];
    }else{
       $data['cat']= '';
    }*/
      $like='';
    if(!empty($_POST['id']) AND empty($_POST['search'])){
      $userlevel = $_POST['id'];
       $type= array('userRole'=>'user','userPlan'=>$userlevel,'assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);

    }else if(!empty($_POST['search']) AND empty($_POST['id'])){
      $search =$_POST['search'];
      $like= $search;
      //$like= array('fullName'=>$search);
       //pr('in srdc');

    }else if(!empty($_POST['id']) AND !empty($_POST['search'])){
      // pr('in src');
      $userlevel = $_POST['id'];
      $type= array('userRole'=>'user','userPlan'=>$userlevel,'assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $like= $_POST['search'];   

    }else{
     // pr('in def');
     $type= array('userRole'=>'user','assignTrainer'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']); 
     $like='';
    }
    $data['userList'] = $this->User_model->getAllUser($config['per_page'],$page,$type,$like);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    $rr= $this->load->view('get_Customer_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));    
  }
  //END OF FUNCTION

  //CUSTOMER DETALIS 
  function customerDetail(){
    $this->check_admin_user_session();
    /*if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
        redirect('admin/dashboard');
    }*/
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      redirect('admin/trainers/specialTrainerDeshboard');
    }
    $data['title']='Customer  Details';
    $data['back_css'] = array('backend_assets/css/lightgallery.min.css','backend_assets/css/owl.carousel.min.css','backend_assets/css/owl.theme.default.min.css');
    $data['back_js'] = array('backend_assets/js/lightgallery-all.min.js','backend_assets/js/owl.carousel.min.js','backend_assets/css/owl.theme.default.min.css','backend_assets/js/custom.js');
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin'] = $this->common_model->getsingle(USERS,$where);
    $id =decoding($this->uri->segment(4));
    $whereUser= array('id'=>$id,'userRole'=>'user');
    $userid = $this->common_model->getsingle(USERS,$whereUser);
    //pr( $userid);
    $data['user'] =  $userid;
    $userid = $data['user'];
    if($userid->assignTrainer!=0){
    $assignTrainer = array('id'=>$userid->assignTrainer,'userRole'=>'trainer');
    $data['assignTrainer'] = $this->common_model->getsingle(USERS,$assignTrainer);
    }
    if(!empty($userid->userPlan)){
      $data['uplan']=$userid->userPlan;
      $data['plan'] = $this->membership_model->getPlanListForUser(1);
    }
   // pr( $data['plan']);
    $this->load->admin_render('userDetail',$data,''); 
  }
  //END OF FUNCTION
   function trainerRecListing(){
    //pr($_GET['id']);
    //    listing of recepie
    if(!empty($_POST['userId'])){
     $id = $_POST['userId'];
    }else{
     $id = $_GET['userId'];
    }
    $type='0';
    $config['base_url']       = base_url()."admin/trainers/trainerRecListing";
    if(!empty($_GET['id'])){
      $catId = $_GET['id'];
      $config['total_rows']     = $this->Trainer_model->recepieCount($type,$id,$catId);
    }else{
      $catId = 0;
      $config['total_rows']     = $this->Trainer_model->recepieCount($type,$id,$catId);
    }
    $config['uri_segment']    = 4;
    $config['per_page']       = 6;
    $config['num_links']      = 5;
    $config['first_link']     = FALSE;
    $config['last_link']      = FALSE;
    $config['full_tag_open']  = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link']      = '&raquo;';
    $config['next_tag_open']  = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class']   = '';
    $config['prev_link']      = '&laquo;';
    $config['prev_tag_open']  = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open']   = '<li class="active1"><a>';
    $config['cur_tag_close']  = '</a></li>';
    $config['num_tag_open']   = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $config['paginate_call'] = 'ajax_fun';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    //--------------------------------------------------------------
        if(!empty($_GET['id'])){
      $respcat= $_GET['id'];
        //$data['categoryId']=$_GET['id'];
      $data['recepieList'] = $this->Trainer_model->getAllRecepie($config['per_page'],$page,$respcat,$id);
    }else{
      $respcat='0';
      $data['recepieList'] = $this->Trainer_model->getAllRecepie($config['per_page'],$page,$respcat,$id);
    }
    //-------------------------------------------------------------
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_recepie']= $config['total_rows'];
    $data['category']= $this->Trainer_model->getAllCategory();
    $rr= $this->load->view('trainer_recepie_list',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash'],'categoryId'=>$respcat));die();
    //END OF RECEPIE LIST
    //END OF ARTICLE LIST
  }

  function trainerArtList(){
    $id = $_POST['userId'];
    $types='0';
    $config['base_url']       = base_url()."admin/trainers/trainerArtList";
    $config['total_rows']     = $this->Article_model->articleCountTrainer($type='',$id);
    $config['uri_segment']    = 4;
    $config['per_page']       = 6;
    $config['num_links']      = 5;
    $config['first_link']     = FALSE;
    $config['last_link']      = FALSE;
    $config['full_tag_open']  = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link']      = '&raquo;';
    $config['next_tag_open']  = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class']   = '';
    $config['prev_link']      = '&laquo;';
    $config['prev_tag_open']  = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open']   = '<li class="active1"><a>';
    $config['cur_tag_close']  = '</a></li>';
    $config['num_tag_open']   = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $config['paginate_call'] = 'ajax_fun1';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    $data['articleList'] = $this->Article_model->getAllArticleTrainer($config['per_page'],$page,$id);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_article']= $config['total_rows'];
    $rr= $this->load->view('trainer_article_list',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));
  }
  //trainner user list
  
  function trainerCustomerList(){
    $id = $_POST['userId'];
    $type = array('assignTrainer'=>$id);
    $config['base_url'] = base_url().'admin/trainers/trainerCustomerList';
    $like='';
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
    $config['paginate_call'] = 'ajax_fun2';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    $data['userList'] = $this->User_model->getAllUser($config['per_page'],$page,$type,$like);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    $rr= $this->load->view('trainer_customer_list',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));
  }
  //END OF FUNCTION

  function trainingVideo_List(){
    $id = $_POST['userId'];
    $type = array('postedById'=>$id);
    $config['base_url'] = base_url().'admin/trainers/trainingVideo_List';
    $config['total_rows'] = $this->Video_model->trainingVideoCount($type);
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
    $config['paginate_call'] = 'ajax_fun55';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    $data['trainingVideo'] = $this->Video_model->getAllTrainingVideo($config['per_page'],$page,$type);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    $rr= $this->load->view('trainerProfileTrainingVideo',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash'])); 
  }
  // End of Function.

   function infoVideo_List(){
    $id = $_POST['userId'];
    $type = array('postedById'=>$id);
    $config['base_url'] = base_url().'admin/trainers/infoVideo_List';
    $config['total_rows'] = $this->Video_model->videoCount($type);
   // pr($config['total_rows']);
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
    $config['paginate_call'] = 'ajax_fun66';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    $data['infoVideo'] = $this->Video_model->getAllVideo($config['per_page'],$page,$type);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    $rr= $this->load->view('trainerPofileInfoVideo',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash'])); 
  }
  // UPDATE TRAINER
  function updateTrainer(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 
   $trainerId   =   decoding($this->uri->segment(4));
   $where       =   array('us.id'=> $trainerId,'us.userRole'=>'trainer');
   $data['trainerData'] =   $this->Trainer_model->getAllTrainerJoin($where);
  //pr( $data['trainerData']);
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      redirect('admin/dashboard');
    }
    $this->check_admin_user_session();
    $data['title']        = "Update Trainer";
    $table = USERS;
    $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin'] = $this->common_model->getsingle($table,$where);
    $data['allCoupons'] = $this->common_model->getAll('coupons', $order_fld = '', $order_type = '', $select = 'all', $limit = '', $offset = '',$group_by='',$where='');
    $this->load->admin_render('updateTrainer',$data,''); 
  }
  //END OF FUNCTION
  //UPDATE TRAINER CTRL
  function update_trainer(){
    //pr($_POST);
    
    $this->form_validation->set_rules('TrainerName', 'Name', 'trim|required');
    //$this->form_validation->set_rules('password', 'Password', 'trim|required');
    //$this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
    // $this->form_validation->set_rules('password','Password','trim|required');
    $this->form_validation->set_rules('details','Details','trim|required');
     $this->form_validation->set_rules('userPlan[]','User Plan','trim|required');
    $link = $this->input->post('PersonaliseLink');

    if(!empty($link)){
      $this->form_validation->set_rules('commissionFree', 'Commission Free', 'trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel1', 'Commission Level 1','trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel2','Commission Level 2','trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel3Same','Commission Level 3 Same','trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel3Other','Commission Level 3 Other','trim|numeric|required');

      $this->form_validation->set_rules('commissionLevel4Same','Commission Level 4 Same','trim|numeric|required');
      $this->form_validation->set_rules('commissionLevel4Other','Commission Level 4 Other','trim|numeric|required');

      $this->form_validation->set_rules('discountLevel1','DiscountLevel1','trim|numeric|required');
      $this->form_validation->set_rules('discountLevel2','DiscountLevel2','trim|numeric|required');
      $this->form_validation->set_rules('discountLevel3Same','Discount Level 3 Same','trim|numeric|required');
      $this->form_validation->set_rules('discountLevel3Other','Discount Level 3 Other','trim|numeric|required');

      $this->form_validation->set_rules('discountLevel4Same','Discount Level 4 Same','trim|numeric|required');
      $this->form_validation->set_rules('discountLevel4Other','Discount Level 4 Other','trim|numeric|required');
    }
    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash']; 
      echo json_encode($res);die();
    }
      $commissionFree         = $this->check_commission($this->input->post('commissionFree'));
      $commissionLevel1       = $this->check_commission($this->input->post('commissionLevel1'));
      $commissionLevel2       = $this->check_commission($this->input->post('commissionLevel2'));
      $commissionLevel3Same   = $this->check_commission($this->input->post('commissionLevel3Same'));
      $commissionLevel3Other  = $this->check_commission($this->input->post('commissionLevel3Other'));

      $commissionLevel4Same   = $this->check_commission($this->input->post('commissionLevel4Same'));
      $commissionLevel4Other  = $this->check_commission($this->input->post('commissionLevel4Other'));

   $discountLevel1         = $this->check_commission($this->input->post('discountLevel1'));

      $where          = array('couponId'=>$discountLevel1);
      $d1  = $this->common_model->getsingle('coupons',$where);


      $discountLevel2         = $this->check_commission($this->input->post('discountLevel2'));
      $where          = array('couponId'=>$discountLevel2);
      $d2  = $this->common_model->getsingle('coupons',$where);

      $discountLevel3Same     = $this->check_commission($this->input->post('discountLevel3Same'));
      $where          = array('couponId'=>$discountLevel3Same);
      $d3  = $this->common_model->getsingle('coupons',$where);

    

      $discountLevel3Other    = $this->check_commission($this->input->post('discountLevel3Other'));

      $where          = array('couponId'=>$discountLevel3Other);
      $d4  = $this->common_model->getsingle('coupons',$where);

      $discountLevel4Same     = $this->check_commission($this->input->post('discountLevel4Same'));

      $where          = array('couponId'=>$discountLevel4Same);
      $d5  = $this->common_model->getsingle('coupons',$where);

      $discountLevel4Other    = $this->check_commission($this->input->post('discountLevel4Other'));

      $where          = array('couponId'=>$discountLevel4Other);
      $d6  = $this->common_model->getsingle('coupons',$where);
      

      if(!empty($link) AND ($commissionLevel1 == 'FALSE' OR $commissionFree == 'FALSE' OR  $commissionLevel2 == 'FALSE' OR $commissionLevel3Same =='FALSE' OR $commissionLevel3Other == 'FALSE' OR $commissionLevel4Same=='FALSE' OR $commissionLevel4Other=='FALSE'  OR $discountLevel1 == 'FALSE' OR $discountLevel2 =='FALSE' OR $discountLevel3Same =='FALSE' OR $discountLevel3Other =='FALSE' OR  $discountLevel4Same=='FALSE' OR $discountLevel4Other=='FALSE')){

          $res['status'] = 0;
          $res['msg'] = 'Commission and  discount field value between 0-100';
          $res['hash']= get_csrf_token()['hash']; 
          echo json_encode($res);die(); 
      }

      if(!empty($_FILES['profileImage']['name'])) {
        $folder = 'profile'; //Set folder for upload  profile image   
        $result = $this->image_model->upload_image('profileImage', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => '-1','msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
           echo json_encode($response);
            exit;
        }else{
          $data['profileImage'] =$result;
        }   
      }
      $pass = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('password'))));
      $data['fullName'] = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('TrainerName'))));
      if(!empty($pass)){
        $data['password'] =  password_hash($pass,PASSWORD_DEFAULT);
       }

      $data['details']  = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('details'))));
     // $pass             = sanitize_input_text($this->input->post('password'));
      $promoteUser      = sanitize_input_text($this->input->post('promote'));
      $isShow           = $this->input->post('showSliderTrainer');
      $trainer_id       = $this->input->post('tid');
      $trainerMetaId    = $this->input->post('trainerMetaId');
      $uPlan = $this->input->post('userPlan');
      if(empty($uPlan)){
          $res['status'] = 0;
          $res['msg'] = 'User plan field required';
          $res['hash']= get_csrf_token()['hash']; 
          echo json_encode($res);die();
      }else{
      $data['userPlan'] = $uPlan;
      }

      if(!empty($link)){
        if($isShow=='on'){
          $data['showSliderTrainer']  = 1;
        }else{
          $data['showSliderTrainer']  = 0;
        }
      }
      //if(empty($promoteUser)){ 
        if(!empty($link)){
          $data['promote']=1;
        }else{
          $data['promote']=0;
        }
      
      $data['userRole'] =  'trainer';
      $data['upd'] = datetime();
      $wher = array('id'=>$trainer_id,'userRole'=>'trainer');
   
      $response = $this->common_model->updateFields(USERS,$data,$wher);

      if($response AND !empty($link)){
        $trainerMeta['trainerId']             = $trainer_id;
        $trainerMeta['showTrainer']           =sanitize_input_text($this->input->post('showTrainer'));
        $trainerMeta['commissionFree']        =round($commissionFree,3);
        $trainerMeta['commissionLevel1']      =round($commissionLevel1,3);
        $trainerMeta['commissionLevel2']      =round($commissionLevel2,3);
        $trainerMeta['commissionLevel3Same']  =round($commissionLevel3Same,3);
        $trainerMeta['commissionLevel3Other'] =round($commissionLevel3Other,3);

        $trainerMeta['commissionLevel4Same']  =round($commissionLevel4Same,3);
        $trainerMeta['commissionLevel4Other'] =round($commissionLevel4Other,3);

        $trainerMeta['discountLevel1']        =round($discountLevel1,3);
        $trainerMeta['discountLevel2']        =round($discountLevel2,3);
        $trainerMeta['discountLevel3Same']    =round($discountLevel3Same,3);
        $trainerMeta['discountLevel3Other']   =round($discountLevel3Other,3);

        $trainerMeta['discountLevel4Same']    =round($discountLevel4Same,3);
        $trainerMeta['discountLevel4Other']   =round($discountLevel4Other,3);
       
        if(!empty($trainerMetaId)){
          $trainerMeta['upd']=datetime();
        $wheretrain = array('trainerId'=>$trainer_id);
        $trainerMetaResponce = $this->common_model->updateFields(TRAINERMETA,$trainerMeta,$wheretrain);
        }else{
          $trainerMeta['crd']      = $trainerMeta['upd']=datetime();
          $trainerMetaResponce = $this->common_model->insertData(TRAINERMETA,$trainerMeta);
        }
        if(empty($trainerMetaResponce)){
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wrong!';
          $res['hash']= get_csrf_token()['hash']; 
         echo json_encode($res);die();
        }
      }
      //$sen_email = $this->smtp_email->send_mail($userData['email'],$subject,$message);
      $sen_email =TRUE;
      if($sen_email!=TRUE){
       $res['status'] = 0;
        $res['msg'] = 'Eamil is not sent!';
        $res['hash']= get_csrf_token()['hash']; 
        echo json_encode($res);die();
      }
      if($response){
        $res['status'] = 1;
        $res['msg'] = 'Trainer update successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Trainer is not update successfully!';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    
  }

  //END OF FUNCTION 

public function editTrainerProfile(){
  $this->check_admin_user_session();
  $data['title'] = 'editTrainerProfile' ;
  $where = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
  $data['trainer'] = $this->common_model->getsingle(USERS,$where);
  $this->load->admin_render('editTrainerProfile',$data,'');

}//END OF FUNCTION

function edit_trainer_profile(){
    $this->check_admin_user_session();
      $userId = $_POST['userId'];
      $this->form_validation->set_rules('name', 'name', 'trim|required');
      $this->form_validation->set_rules('details', 'bio','trim|required');
      if($this->form_validation->run() == FALSE){
        $res['status'] = 0;
        $res['msg'] = validation_errors();
        $res['hash']= get_csrf_token()['hash'];
        echo json_encode($res);die();
      }
      $name = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('name'))));
      $details = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('details'))));
      if(!empty($_FILES['banner_image']['name'])){   
            $imageName = 'banner_image';
            $folder =  "banner";
            $response_image = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image['error'])){
              $response = array('status' =>'-1', 'msg' =>'The banner image resolution should be greater than 1380x590','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }
            $data['bannerImage'] =   $response_image;
      }
      
      if(!empty($_FILES['profileImage']['name'])){   
            $imageName = 'profileImage';
            $folder =  "profile";
            $response_image = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image['error'])){
              $response = array('status' =>'-1', 'msg' =>'The profile Image should be at least 300*300px','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }
            $data['profileImage'] =   $response_image;
      }
      $data['fullName']          = $name;
      $data['details']    = $details;
      $data['crd'] =    $data['upd'] = datetime();
      $wherecondition = array('id'=>$userId);
      $update = $this->common_model->updateFields(USERS, $data, $wherecondition);
      if($update){
        if(!empty($_FILES['profileImage']['name'])){
          $_SESSION[ADMIN_USER_SESS_KEY]['image']=$response_image;
        }  
        $res['status'] = 1;
        $res['msg'] = 'Trainer profile updated successfully.';
        $res['url'] = base_url().'admin/dashboard';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
       
}

    function _change_check_unique_email($id,$str, $tb_data){
          $tb_arr = explode(".",$tb_data);
          $where = array($tb_arr[1]=>$str);

          $result = $this->common_model->getsingle($tb_arr[0], $where, $fld = NULL, $order_by = '', $order = '');
          if(!empty($result)){

            
              if($result->id!=$id){
                
              $this->form_validation->set_message('_change_check_unique_email','title already exists');
                return FALSE;
              }else{
                return TRUE;
              }

          }
          else{

              return TRUE;
          }     
      }//END OF FUNCTION

     
  
}//END OF CLASS
