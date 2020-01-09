<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends Common_Back_Controller {

   
  function __construct() {
    parent::__construct();
    $this->load->model('report_model'); //load membership_model 
    $this->load->library('Ajax_pagination');
   
    
  }

  //INDEX FUNCTION TO LOAD TRAINERS LIST  VIEW
  public function index(){
    $this->check_admin_user_session();
    $data['title'] = "Report";
    $data['back_js'] = array('backend_assets/js/chart.min.js','backend_assets/js/column.js');

    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type1 = array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['level4Same'] = $this->report_model->getAllUserRep($type1);

      $type12 = array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'PlanLevel'=>'5');
      $data['level4Same1'] = $this->report_model->getAllUserRep($type12);
   
    $type = array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $where1 = 'DATE(`pm`.`crd`) = CURDATE()';
    $data['today'] = $this->report_model->getAllUserRep1($type,$where1);

    $where2 =  '`pm.crd` > DATE_SUB(CURDATE(), INTERVAL 7 DAY)';
    $data['week'] = $this->report_model->getAllUserRep1($type,$where2);
  
    $where3  =  '`pm.crd` > DATE_SUB(CURDATE(), INTERVAL 30 DAY)';
    $data['month'] = $this->report_model->getAllUserRep1($type,$where3);

      $hwereTrainer = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      $data['MonthComm'] = $this->report_model->getAllcomm($hwereTrainer);
      $data['MonthDisc'] = $this->report_model->getAllDis($hwereTrainer);
      $data['WeekComm'] = $this->report_model->getAllWeekComm($hwereTrainer);
      $data['WeekDisc'] = $this->report_model->getAllWeekDis($hwereTrainer);

      $data['yearCom'] = $this->report_model->getAllYearComm($hwereTrainer);
      $data['yearDis'] = $this->report_model->getAllYearDis($hwereTrainer);
    $this->load->admin_render('report/reportView',$data,''); 
  
  }
}
  
 // USERS LIST  AJAX FUNCTION 
  function user_List(){
     $type='';
      $mnt= $this->input->post('mnt');
      $mycus= $this->input->post('mycus');
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      
      /*$type = array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $type2 = array('trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);*/

      $type1= array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'commissionTrainerId!='=>0);
      $type2= array('trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);

      $type7= array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'commissionTrainerId!='=>0);
      $type8= array('trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $type9='';
    }
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
      $trainer = $_GET['trainer'];
    }

    if(!empty($mnt)){
      //pr('in');
          $month = $mnt;
          $trainer = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    }

    if(!empty($mycus) AND $mycus==1){
          $customer=$mycus;
    }

/*
    $type3='';
    $type4='';
    $type5='';



    if(!empty($month) AND !empty($customer)){
    $type3 = array('MONTH(`pm`.`crd`)'=>$month);
    $type5 = array('trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    }*/

     $type3 ='';  $type4 =''; $type5 =''; $type6 ='';

    if(!empty($month) AND !empty($customer)){
        $type1=''; $type2=''; $type3=''; $type4=''; $type5='';
      $type6= array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
       $type9= array('MONTH(`pm`.`crd`)'=>$month);
    }

  /*  if(empty($month) AND $month=='0' AND !empty($customer)){
        if($month=='0'){
          $month='';
        }
        $type = array('MONTH(`pm`.`crd`)'=>$month);
        $type1 = array('trainerId'=>$trainer);
        //$type = array('commissionTrainerId'=>$trainer);

    } */

    /*  if($customer!=1 AND !empty($month)){
        // pr('in');
        $type3 = array('MONTH(`pm`.`crd`)'=>$month);
        $type4 = array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
        $type5 = array('trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
        
    }*/
      if(!empty($customer) AND empty($month)){
      //$type3 = array('pm.trainerId'=>$id,'trainerId'=>$id);
  
      $type1=''; $type2='';  $type4=''; $type5='';$type6='';
      $type3= array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      }
      if(empty($customer) AND !empty($month)){
         //pr('ds');
      // $type3 = array('MONTH(`pm`.`crd`)'=>$month);
      $type1=''; $type2=''; $type3='';$type6='';
      $type4= array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $type5= array('commissionTrainerId!='=>0,'trainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $type9= array('MONTH(`pm`.`crd`)'=>$month);

      }

    //pr($type);
    $config['base_url'] = base_url()."admin/report/user_List";
    $config['total_rows'] = $this->report_model->userCount1($type1,$type2,$type3,$type4,$type5,$type6,$type9);
    //pr($config['total_rows']);
    $config['uri_segment']    = 4;
    $config['per_page']       = 2;
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
    //$data['trId']= $id;
    $data['cat']= $month;
    $rr= $this->load->view('report/sub_user_trainer',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));    
  }
  //END OF FUNCTION
  function reportData(){

    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type1 = array('commissionTrainerId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    }
    $data1 = $this->report_model->getAllUserRep1($type1);
    //pr($data1);
  }
   function UserReport(){
    //echo 'in';
     $data['back_js'] = array('backend_assets/js/chart.min.js','backend_assets/js/column.js');
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
    $data['title']  = "User Report";
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $type=0;
    $data['Totlleveluser'] = $this->report_model->getTotalUser();

    $data['TotllDis'] = $this->report_model->todayAllUserDiscountComm();
    $data['TotllDisw'] = $this->report_model->weekAllUserDiscountComm();
    $data['TotllDism'] = $this->report_model->monthAllUserDiscountComm();

    $data['MonthDisc'] = $this->report_model->getAllDis1();
    $data['MonthComm'] = $this->report_model->getAllcomm1();

    $data['WeekDisc'] = $this->report_model->getAllWeekDis1();
    $data['WeekComm'] = $this->report_model->getAllWeekComm1();

    $data['yearCom'] = $this->report_model->getAllYearComm1();
    $data['yearDis'] = $this->report_model->getAllYearDis1();
   
    $this->load->admin_render('userReport',$data,''); 
   }

 }
  
    function alluser_List(){
      $type='';
      $mnt= $this->input->post('mnt');
      $mycus= $this->input->post('mycus');
     $type3 ='';  $type4 =''; $type5 =''; $type6 =''; $type9=''; $type2='';  $type7='';  $type8='';
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      $type1= array('userRole'=>'user');
    }
    if(!empty($_GET['month'])){
        $month = $_GET['month'];
    }
    $customer='';
    if(!empty($_GET['customer'])){
      $customer = $_GET['customer'];
     
    }

    if(!empty($mnt)){
      $month = $mnt;
    }

    if(!empty($mycus)){
       $customer = $mycus;
    }
   

    if(!empty($month) AND !empty($customer)){
      $type1= array('userRole'=>'user','PlanLevel'=>$customer,'MONTH(`pm`.`crd`)'=>$month);
    }

    if(empty($customer) AND !empty($month)){
      $type1= array('userRole'=>'user','MONTH(`pm`.`crd`)'=>$month); 

    }
     if(empty($month) AND !empty($customer)){
      $type1= array('userRole'=>'user','PlanLevel'=>$customer);
    }
    
    $config['base_url'] = base_url()."admin/report/alluser_List";
    $config['total_rows'] = $this->report_model->userCountA($type1,$type2,$type3,$type4,$type5,$type6,$type9);
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
    $data['userList'] = $this->report_model->getAllUserA($config['per_page'],$page,$type1,$type2,$type3,$type4,$type5,$type6,$type7,$type8,$type9);
    //pr($data['userList']);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_user']= $config['total_rows'];
    //$data['trId']= $id;
   // pr($data['userList']);
    if(!empty($month)){
     $data['cat']= $month;  
    }else{
      $data['cat']= '';
    }
    if(!empty($customer)){
    $data['cat1']= $customer;
    }else{
      $data['cat1']='';
    }
    $rr= $this->load->view('report/all_user_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));    
  }


}//END OF CLASS
