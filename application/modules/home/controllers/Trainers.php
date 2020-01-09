<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trainers extends Common_Front_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();  
          $this->load->model('image_model');
           $this->load->model('membership_model'); //load membership_model 
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



  //END OF FUNCTION
 function index(){

  $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
  $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');

        if(!empty($_SESSION[USER_SESS_KEY]['userId'])){
        if(isset($_COOKIE['reffralId'])){
            $cookie_name = 'reffralId';
            unset($_COOKIE[$cookie_name]);
            $res = setcookie($cookie_name, ' ', time() - 3600);
           
        }
      }
      


  if(!isset($_COOKIE['reffralId'])){

    if(isset($_GET['level']) && $_GET['level']=='3'){
      $levelt=$this->membership_model->getPlanList2($_GET['level']);
      $data['planDis'] = $levelt;

      $levelt=$this->membership_model->getPlanList2(3);
      //pr($levelt);
      $data['planDis'] = $levelt;
      if(!empty($levelt)){
        $level3=3;
        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3); 
        $or_wher  = array('users.userPlan'=>'3,4'); 
        $data['allTrainer'] = $this->common_model->GetSingleJoinRecordTrainer(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,10,$level3);
        $data['title']="Select Trainer";
        if(!empty( $data['allTrainer'])){
          $this->load->front_render('allTrainer',$data,'');
        }else{
        $this->load->front_render('noTrainer',$data,'');
        }
      }else{
      $this->load->front_render('noTrainer',$data,'');
      }
    }
    else if(isset($_GET['level']) && $_GET['level']=='4'){

       $levelt=$this->membership_model->getPlanList2($_GET['level']);
      $data['planDis'] = $levelt;

      $level4=4;
      $levelt=$this->membership_model->getPlanList2(4);
      $data['planDis'] = $levelt;
      if(!empty($levelt)){
      $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4); 
      $or_wher  = array('users.userPlan'=>'3,4'); 
      $data['allTrainer'] = $this->common_model->GetSingleJoinRecordTrainer(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,10,$level4);
      $data['title']="Select Trainer";
      if(!empty( $data['allTrainer'])){
      $this->load->front_render('allTrainer',$data,'');
      }else{
        $this->load->front_render('noTrainer',$data,'');
      }
      }else{
        $this->load->front_render('noTrainer',$data,'');
      }   
    }else{

       $levelt=$this->membership_model->getPlanList2(4);
       if(!empty($levelt)){
        $data['planDis4'] = $levelt;
       }else{
         $data['planDis4'] = '';
       }
       //pr( $data['planDis4']);
     
       $levelt3=$this->membership_model->getPlanList2(3);
       if(!empty($levelt3)){
        $data['planDis3'] = $levelt3;
       }else{
        $data['planDis3'] = '';
       }
      //pr( $data['planDis3']);

      //print_r($data['planDis3']); die();
      $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3); 
      $wher4 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4); 
      $or_wher  = array('users.userPlan'=>'3,4');

      $level3 = $this->common_model->GetSingleJoinRecordTrainer(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher,10,3);
      $level4 = $this->common_model->GetSingleJoinRecordTrainer(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher4,$or_wher,10,4);
      $new = array();
      //pr($level3);
      if(!empty($level3) AND !empty($level4)){
         //$new = array_merge($level3,$level4);
        $ct = count($level3)+count($level4);
        for ($i=0; $i<$ct; $i++){
           if(!empty($level3[$i])){
            $new[] =$level3[$i];
          }
          if(!empty($level4[$i])){
            $new[] =$level4[$i];
          }
        }
        $data['allTrainer']= $new;
        $data['title']="Select Trainer";
        $this->load->front_render('allTrainer',$data,'');
      }else if(empty($level3) AND empty($level4)){
        $data['title']="Select Trainer";
        $this->load->front_render('noTrainer',$data,'');
      }else if(empty($level4)){
        $data['allTrainer']= $level3;
        $data['title']="Select Trainer";
        $this->load->front_render('allTrainer',$data,'');
      }else{
        $data['allTrainer']= $level4;
        $data['title']="Select Trainer";
        $this->load->front_render('allTrainer',$data,'');
      }
     
    }
  }else{
    
      

       $levelt=$this->membership_model->getPlanList2(4);
       $data['planDis4'] = $levelt;

       $levelt=$this->membership_model->getPlanList2(3);
       $data['planDis3'] = $levelt;

      $tId = $_COOKIE['reffralId'];
      $data['commisitionTrainer']=$tId; 
       $data['title']="Select Trainer";
      $where        = array('users.id'=>$tId,'users.userRole'=>'trainer','users.showSliderTrainer'=>0);
      $field_first  = 'id';
      $Trainer      = $this->common_model->GetSingleJoinRecord(USERS, $field_first,TRAINERMETA,'trainerId',$field_val='*,trainerMeta.showTrainer as show',$where); 

      if($Trainer->discountLevel3Same){
        $wherepln= array('couponId'=>$Trainer->discountLevel3Same);  
        $dis4Other =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
       $discountLevel3Same = $dis4Other->discountData;
       $stripCouponId3Same = $dis4Other->stripCouponId; 
       $data['couponsId3Same'] =  $Trainer->discountLevel3Same;
      }
      if($Trainer->discountLevel3Other){
        $wherepln= array('couponId'=>$Trainer->discountLevel3Other);  
        $dis4Other =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
        $discountLevel3Other = $dis4Other->discountData;
        $stripCouponId3Other    = $dis4Other->stripCouponId; 
        $data['couponsId3Other'] =  $Trainer->discountLevel3Other;
      }
      if($Trainer->discountLevel4Same){
        $wherepln= array('couponId'=>$Trainer->discountLevel4Same);  
        $dis4Other =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
        $discountLevel4Same = $dis4Other->discountData;
        $stripCouponId4Same    = $dis4Other->stripCouponId; 
        $data['couponsId4Same'] =  $Trainer->discountLevel4Same;
      }
      if($Trainer->discountLevel4Other){
        $wherepln= array('couponId'=>$Trainer->discountLevel4Other);  
        $dis4Other =$this->common_model->getsingle('coupons', $wherepln, $fld = NULL, $order_by = '', $order = '');
        $discountLevel4Other = $dis4Other->discountData;
        $stripCouponId4Other    = $dis4Other->stripCouponId;
        $data['couponsId4Other'] =  $Trainer->discountLevel4Other;
      } 

    if(isset($_GET['level']) && $_GET['level']=='3'){

       $levelt=$this->membership_model->getPlanList2($_GET['level']);
       $data['planDis'] = $levelt;
      $level3=3;
      if($Trainer->userPlan==3){
        $discountLevel = $discountLevel3Same;
        $stripCouponId =   $stripCouponId3Same;
      }else if($Trainer->userPlan==4){
        $discountLevel =$discountLevel3Other;
        $stripCouponId = $stripCouponId3Other;
      }else{
        $discountLevel  =  $discountLevel3Same;
        $stripCouponId =   $stripCouponId3Same;
      }
      if($Trainer->userPlan=='3' OR $Trainer->userPlan=='4'){
      
        if(empty($Trainer->show)){
          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id'=>$tId); 

          $or_wher  = array('users.userPlan'=>'3,4'); 
          $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
          $data['allTrainer'] = $allTrainer3;
          $this->load->front_render('allTrainerslide',$data,'');
        }else if($Trainer->show==1){

          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id'=>$tId); 
          $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id!='=>$tId); 

          $or_wher  = array('users.userPlan'=>'3,4'); 
          $or_wher1  = array('users.userPlan'=>'3,4','users.id!='=>'$tId'); 
          $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
         
          $allTrainer4 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher='',4,$level3,$discountLevel3Other,$stripCouponId3Other);
        
         if(!empty($allTrainer3) AND !empty($allTrainer4)){
            $allTrainerfor = array_merge($allTrainer3,$allTrainer4);
             $data['allTrainer']= $allTrainerfor;
              $this->load->front_render('allTrainerslide',$data,'');
          }else if(empty($allTrainer3)){
             $data['allTrainer']= $allTrainer4;
              $this->load->front_render('allTrainerslide',$data,'');
          }
          else{
              $data['allTrainer']= $allTrainer3;
              $this->load->front_render('allTrainerslide',$data,'');
            
          }   
          if(empty($allTrainer3) AND empty($allTrainer4)){
            $this->load->front_render('noTrainer',$data,'');
          }
        }else{
          
          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id'=>$tId); 
          $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id!='=>$tId); 
          $or_wher  = array('users.userPlan'=>'3,4'); 

          $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
         
          $allTrainer4 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher,9,$level3,$discountLevel3Other,$stripCouponId3Other);
          if(!empty($allTrainer3) AND !empty($allTrainer4)){
            $allTrainerfor = array_merge($allTrainer3,$allTrainer4);
            $data['allTrainer']= $allTrainerfor;  
            $this->load->front_render('allTrainerslide',$data,'');
          }else if(empty($allTrainer3)){
             $data['allTrainer']= $allTrainer4;  
            $this->load->front_render('allTrainerslide',$data,'');
          }else{
            //$this->load->front_render('noTrainer',$data,'');
             $data['allTrainer']= $allTrainer3;  
            $this->load->front_render('allTrainerslide',$data,'');
          }
             if(empty($allTrainer3) AND empty($allTrainer4)){
              $this->load->front_render('noTrainer',$data,'');
             }
        }
      }else{
        /*level both */
        //pr('in');
       if(empty($Trainer->show)){
        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId); 
        $or_wher  = array('users.userPlan'=>'3,4');
        $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
        $data['allTrainer'] = $allTrainer3;
        $this->load->front_render('allTrainerslide',$data,'');
        }else if($Trainer->show==1){

        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId); 
        $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id!='=>$tId); 

        $or_wher  = array('users.userPlan'=>'3,4'); 
        $or_wher1  = array('users.userPlan'=>'3,4','users.id!='=>'$tId'); 

        $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
       
        $allTrainer4 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher='',4,$level3,$discountLevel3Other,$stripCouponId3Other);
      
        if(!empty($allTrainer3) AND !empty($allTrainer4)){
          $allTrainerfor = array_merge($allTrainer3,$allTrainer4);
           $data['allTrainer']= $allTrainerfor;
            $this->load->front_render('allTrainerslide',$data,'');
        }else if(empty($allTrainer3)){
          $data['allTrainer']= $allTrainer4;
          $this->load->front_render('allTrainerslide',$data,'');
        }
        else{
          $data['allTrainer']= $allTrainer3;
          $this->load->front_render('allTrainerslide',$data,'');
          //$this->load->front_render('noTrainer',$data,'');
        }
         if(empty($allTrainer3) AND empty($allTrainer4)){
          $this->load->front_render('noTrainer',$data,'');
         }
       }else{
         //pr('in all');
         //pr($tId);
        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId); 

        $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id!='=>$tId); 
        $or_wher  = array('users.userPlan'=>'3,4'); 

        $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher='',1,$level3,$discountLevel,$stripCouponId);
       //pr($allTrainer3);
        $allTrainer4 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher='',9,$level3,$discountLevel3Other,$stripCouponId3Other);
        // pr($allTrainer4);
          if(!empty($allTrainer3) AND !empty($allTrainer4)){
          $allTrainerfor = array_merge($allTrainer3,$allTrainer4);
           $data['allTrainer']= $allTrainerfor;
            $this->load->front_render('allTrainerslide',$data,'');
        }else if(empty($allTrainer3)){
          $data['allTrainer']= $allTrainer4;
          $this->load->front_render('allTrainerslide',$data,'');
        }
        else{
          $data['allTrainer']= $allTrainer3;
          $this->load->front_render('allTrainerslide',$data,'');
          //$this->load->front_render('noTrainer',$data,'');
        }
         if(empty($allTrainer3) AND empty($allTrainer4)){
          $this->load->front_render('noTrainer',$data,'');
         }
      }
      /*end of both*/
    } 
    }else if(isset($_GET['level']) && $_GET['level']=='4'){
       $levelt=$this->membership_model->getPlanList2($_GET['level']);
      $data['planDis'] = $levelt;

      $level3=4;
      if($Trainer->userPlan==3){
        $discountLevel = $discountLevel4Same;
        $stripCouponId =   $stripCouponId4Same;
      }else if($Trainer->userPlan==4){
        $discountLevel = $discountLevel4Same;
        $stripCouponId = $stripCouponId4Same;
      }else{
        $discountLevel = $discountLevel4Same;
        $stripCouponId =   $stripCouponId4Same;
      }
      if($Trainer->userPlan=='3' OR $Trainer->userPlan=='4'){
       
      if(empty($Trainer->show)){
        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id'=>$tId); 

        $or_wher  = array('users.userPlan'=>'3,4'); 
        $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
        $data['allTrainer'] = $allTrainer3;

       $this->load->front_render('allTrainerslide',$data,'');
          
      }else if($Trainer->show==1){
        
        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id'=>$tId); 
        $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id !='=>$tId); 
        $or_wher  = array('users.userPlan'=>'3,4'); 

       $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher1='',1,$level3,$discountLevel,$stripCouponId);
       
        $allTrainer4 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher,4,$level3,$discountLevel4Other,$stripCouponId4Other);
 
          if(!empty($allTrainer3) AND !empty($allTrainer4)){
          $allTrainerfor = array_merge($allTrainer3,$allTrainer4);
           $data['allTrainer']= $allTrainerfor;
            $this->load->front_render('allTrainerslide',$data,'');
        }else if(empty($allTrainer3) AND !empty($allTrainer4)){
          $data['allTrainer']= $allTrainer4;
          $this->load->front_render('allTrainerslide',$data,'');

        }else if(empty(!$allTrainer3) AND empty($allTrainer4)){
          $data['allTrainer']= $allTrainer3;
          $this->load->front_render('allTrainerslide',$data,'');
        }else{
            $this->load->front_render('noTrainer',$data,'');
        }
         
      }else{

        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id'=>$tId); 
        $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id!='=>$tId); 
        $or_wher  = array('users.userPlan'=>'3,4'); 

        $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
        //pr($allTrainer3);
        $allTrainer4 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher,4,$level3,$discountLevel4Other,$stripCouponId4Other);
        // pr($allTrainer4);
         if(!empty($allTrainer3) AND !empty($allTrainer4)){
          $allTrainerfor = array_merge($allTrainer3,$allTrainer4);
          }else if(empty($allTrainer3)){
             $allTrainerfor = $allTrainer4;
          }else{
              $allTrainerfor = $allTrainer3;
          }
        $data['allTrainer']= $allTrainerfor;
       $this->load->front_render('allTrainerslide',$data,'');
      }
      }else{
      /*both */

       if(empty($Trainer->show)){
        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId); 
        $or_wher  = array('users.userPlan'=>'3,4');
        $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
        $data['allTrainer'] = $allTrainer3;
        $this->load->front_render('allTrainerslide',$data,'');
        }else if($Trainer->show==1){

        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId); 
        $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id!='=>$tId); 

        $or_wher  = array('users.userPlan'=>'3,4'); 
        $or_wher1  = array('users.userPlan'=>'3,4','users.id!='=>'$tId'); 

        $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
       
        $allTrainer4 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher='',4,$level3,$discountLevel4Other,$stripCouponId4Other);
      
          if(!empty($allTrainer3) AND !empty($allTrainer4)){
          $allTrainerfor = array_merge($allTrainer3,$allTrainer4);
           $data['allTrainer']= $allTrainerfor;
            $this->load->front_render('allTrainerslide',$data,'');
        }else if(empty($allTrainer3) AND !empty($allTrainer4)){
          $data['allTrainer']= $allTrainer4;
          $this->load->front_render('allTrainerslide',$data,'');

        }else if(empty(!$allTrainer3) AND empty($allTrainer4)){
          $data['allTrainer']= $allTrainer3;
          $this->load->front_render('allTrainerslide',$data,'');
        }else{
            $this->load->front_render('noTrainer',$data,'');
        }

       }else{
        
        $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId); 
        $wher3 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id!='=>$tId); 
        $or_wher  = array('users.userPlan'=>'3,4'); 

        $allTrainer3 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher='',1,$level3,$discountLevel,$stripCouponId);
       
        $allTrainer4 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3,$or_wher='',9,$level3,$discountLevel4Other,$stripCouponId4Other);

        if(!empty($allTrainer3) AND !empty($allTrainer4)){
          $allTrainerfor = array_merge($allTrainer3,$allTrainer4);
           $data['allTrainer']= $allTrainerfor;
            $this->load->front_render('allTrainerslide',$data,'');
        }else if(empty($allTrainer3) AND !empty($allTrainer4)){
          $data['allTrainer']= $allTrainer4;
          $this->load->front_render('allTrainerslide',$data,'');

        }else if(empty(!$allTrainer3) AND empty($allTrainer4)){
          $data['allTrainer']= $allTrainer3;
          $this->load->front_render('allTrainerslide',$data,'');
        }else{
            $this->load->front_render('noTrainer',$data,'');
        }
      }
      /*end of both*/
      }
    }else{

      $or_wher  = array('users.userPlan'=>'3,4');
      $discountLevel1='';
      $stripCouponId1 ='';
      if($Trainer->userPlan==3){
         $discountLevel = $discountLevel3Same;
         $stripCouponId =   $stripCouponId3Same;
      }else if($Trainer->userPlan==4){
        $discountLevel = $discountLevel4Same;
        $stripCouponId = $stripCouponId4Same;
      }else{
        $discountLevel =   $discountLevel3Same;
        $stripCouponId =   $stripCouponId3Same;
      }

      if(empty($Trainer->show)){
        if($Trainer->userPlan=='3'){
          $level3=3;
          $or_wher  = array('users.userPlan'=>'3,4');
          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id'=>$tId);
          $allTrainer = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);

            $data['allTrainer']= $allTrainerfor;
            $this->load->front_render('allTrainerslide',$data,'');

        }else if($Trainer->userPlan=='4'){

          $level3=4;
          $or_wher  = array('users.userPlan'=>'3,4');
          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id'=>$tId);
          $allTrainer = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,$level3,$discountLevel,$stripCouponId);
          if(!empty($allTrainer)){
          $data['allTrainer']= $allTrainer;
          $this->load->front_render('allTrainerslide',$data,'');
          }else{
            $this->load->front_render('noTrainer',$data,'');
          }
        }else{
          $or_wher  = array('users.userPlan'=>'3,4');
          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId);
          $wher1 = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id'=>$tId);
          $allTrainer1 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher='',1,3,$discountLevel3Same,$stripCouponId3Same);

          $allTrainer2 = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,4,$discountLevel4Same,$stripCouponId4Same);

          /*if(!empty($allTrainer1) AND !empty($allTrainer2)){
            $allTrainer = array_merge($allTrainer1,$allTrainer2);
            $data['allTrainer']= $allTrainer;
            $this->load->front_render('allTrainerslide',$data,'');
          }else{
             $this->load->front_render('noTrainer',$data,'');
          }*/
          if(!empty($allTrainer1) AND !empty($allTrainer2)){
          $allTrainerfor = array_merge($allTrainer1,$allTrainer2);
           $data['allTrainer']= $allTrainerfor;
            $this->load->front_render('allTrainerslide',$data,'');
        }else if(empty($allTrainer1) AND !empty($allTrainer2)){
          $data['allTrainer']= $allTrainer2;
          $this->load->front_render('allTrainerslide',$data,'');

        }else if(empty(!$allTrainer1) AND empty($allTrainer2)){
          $data['allTrainer']= $allTrainer1;
          $this->load->front_render('allTrainerslide',$data,'');
        }else{
            $this->load->front_render('noTrainer',$data,'');
        }
        }
      
      }else if($Trainer->show==1){

        if($Trainer->userPlan=='3'){
          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id'=>$tId); 
          $allTrainer3s = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,3,$discountLevel,$stripCouponId);

          $wher3o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id !='=>$tId);
          $allTrainer3o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3o,$or_wher,4,3,$discountLevel3Other,$stripCouponId3Other);

          $wher3o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id !='=>$tId);
          $allTrainer4o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3o,$or_wher,4,4,$discountLevel4Other,$stripCouponId4Other);

          if(!empty($allTrainer3s) AND !empty($allTrainer3o)){
            $allTrainer3 = array_merge($allTrainer3s,$allTrainer3o);
          }else if($allTrainer3s){
             $allTrainer3= $allTrainer3s;
          }else{
            $allTrainer3=$allTrainer3o;
          }

          $new = array();
          
          if(!empty($allTrainer3) AND !empty($allTrainer4o)){
            $ct = count($allTrainer3)+count($allTrainer4o);
            for ($i=0; $i<$ct; $i++){
               if(!empty($allTrainer3[$i])){
                $new[] =$allTrainer3[$i];
              }
              if(!empty($allTrainer4o[$i])){
                $new[] =$allTrainer4o[$i];
              } 
            }
            $data['allTrainer']= $new;
           $this->load->front_render('allTrainerslide',$data,'');
          }else if(empty($allTrainer4o)){
            $data['allTrainer']= $allTrainer3;
           $this->load->front_render('allTrainerslide',$data,'');
          }else{
             $data['allTrainer']= $allTrainer4o;
           $this->load->front_render('allTrainerslide',$data,'');
          }
        }else if($Trainer->userPlan=='4'){

          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id'=>$tId); 
          $allTrainer4s = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,4,$discountLevel,$stripCouponId);

          $wher4o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id !='=>$tId);
          $allTrainer4o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher4o,$or_wher,4,4,$discountLevel4Other,$stripCouponId4Other);

          $wher3o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id !='=>$tId);
          $allTrainer3o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3o,$or_wher,4,3,$discountLevel3Other,$stripCouponId3Other);

          if(!empty($allTrainer4s) AND !empty($allTrainer4o)){
            $allTrainer3 = array_merge($allTrainer4s,$allTrainer4o);
          }else if(empty($allTrainer4s)){
             $allTrainer3 = $allTrainer4o;
          }else{
             $allTrainer3 = $allTrainer4s;
          }
          $new = array();

          if(!empty($allTrainer3) AND !empty($allTrainer3o)){
             $ct = count($allTrainer3)+count($allTrainer3o);
            for ($i=0; $i<$ct; $i++){
               if(!empty($allTrainer3[$i])){
                $new[] =$allTrainer3[$i];
              }
              if(!empty($allTrainer3o[$i])){
                $new[] =$allTrainer3o[$i];
              } 
            }
            $data['allTrainer']= $new;
           $this->load->front_render('allTrainerslide',$data,'');
          }else if(empty($allTrainer3)){
             $data['allTrainer']= $allTrainer3o;
           $this->load->front_render('allTrainerslide',$data,'');
          }else{
             $data['allTrainer']= $allTrainer3;
           $this->load->front_render('allTrainerslide',$data,'');
         }
        }else{
//pr('dd');
          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId); 


          $allTrainer3s = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher='',1,'3',$discountLevel3Same,$stripCouponId3Same);

          $allTrainer4s = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,'4',$discountLevel4Same,$stripCouponId4Same);


          $wher3o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id !='=>$tId);

          $allTrainer3o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3o,$or_wher='',4,3,$discountLevel3Other,$stripCouponId3Other);

           $allTrainer3so = array_merge($allTrainer3s,$allTrainer3o);


          $wher4o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id !='=>$tId);

          $allTrainer4o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher4o,$or_wher='',4,4,$discountLevel4Other,$stripCouponId4Other);

         // pr($allTrainer4o);

          $allTrainer4so = array_merge($allTrainer4s,$allTrainer4o);


          if(!empty($allTrainer3so)AND !empty($allTrainer4so)){
            $allTrainer3 = array_merge($allTrainer3so,$allTrainer4so);
           }else if(empty($allTrainer3so)){
             $allTrainer3 = $allTrainer4so;
           }else{
            $allTrainer3 = $allTrainer3so;
           }
    
          if(!empty($allTrainer4s)AND !empty($allTrainer4o)){
             $allTrainer4 = array_merge($allTrainer4s,$allTrainer4o);
           }else if(empty($allTrainer3s)){
             $allTrainer4 = $allTrainer3;
           }else{
            $allTrainer4 = $allTrainer3s;
           }
         
          $new = array();
          if(!empty($allTrainer3) AND !empty($allTrainer4)){
                $ct = count($allTrainer3)+count($allTrainer4);
            for ($i=0; $i<$ct; $i++){

              if(!empty($allTrainer3[$i])){
                $new[] =$allTrainer3[$i];
              }
              if(!empty($allTrainer4[$i])){
                $new[] =$allTrainer4[$i];
              } 
            }
            $data['allTrainer']= $new;
          }
         $data['allTrainer']= $new;
         $this->load->front_render('allTrainerslide',$data,'');
        }
      }else{ 
         if($Trainer->userPlan=='3'){

          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id'=>$tId); 
          $allTrainer3s = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,3,$discountLevel,$stripCouponId);

          $wher3o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id !='=>$tId);
          $allTrainer3o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3o,$or_wher,4,3,$discountLevel3Other,$stripCouponId3Other);

          $wher3o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id !='=>$tId);
          $allTrainer4o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3o,$or_wher,4,4,$discountLevel4Other,$stripCouponId4Other);

          if(!empty($allTrainer3s)AND !empty($allTrainer3o)){
            $allTrainer3 = array_merge($allTrainer3s,$allTrainer3o);
           }else if(empty($allTrainer3s)){
             $allTrainer3 = $allTrainer3o;
           }else{
            $allTrainer3 = $allTrainer3s;
           }

          $new = array();
          if(!empty($allTrainer3) AND !empty($allTrainer4o)){
              $ct = count($allTrainer3)+count($allTrainer4o);
            for ($i=0; $i<$ct; $i++){
               if(!empty($allTrainer3[$i])){
                $new[] =$allTrainer3[$i];
              }
              if(!empty($allTrainer4o[$i])){
                $new[] =$allTrainer4o[$i];
              } 
            }
            
          }/* remaining else if condition*/

           $data['allTrainer']= $new;
         $this->load->front_render('allTrainerslide',$data,'');
        }else if($Trainer->userPlan=='4'){

          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id'=>$tId); 
          $allTrainer4s = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,4,$discountLevel,$stripCouponId);

          $wher4o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id !='=>$tId);
          $allTrainer4o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher4o,$or_wher,9,4,$discountLevel4Other,$stripCouponId4Other);

          $wher3o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id !='=>$tId);
          $allTrainer3o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3o,$or_wher,9,3,$discountLevel3Other,$stripCouponId3Other);

           if(!empty($allTrainer4s)AND !empty($allTrainer4o)){
            $allTrainer3 = array_merge($allTrainer4s,$allTrainer4o);
           }else if(empty($allTrainer4s)){
             $allTrainer3 = $allTrainer4o;
           }else{
            $allTrainer3 = $allTrainer4s;
           }

          $new = array();
          if(!empty($allTrainer3) AND !empty($allTrainer3o)){
              $ct = count($allTrainer3)+count($allTrainer3o);
            for ($i=0; $i<$ct; $i++){
              if(!empty($allTrainer3[$i])){
                $new[] =$allTrainer3[$i];
              }
              if(!empty($allTrainer3o[$i])){
                $new[] =$allTrainer3o[$i];
              } 
            }
           
          }/*remaining else if condition*/
           $data['allTrainer']= $new;
         $this->load->front_render('allTrainerslide',$data,'');
        }else{
            /*both */
        //pr($tId);
          $wher = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>'3,4','users.id'=>$tId); 
          // $or_wher1  = array('users.userPlan'=>'3,4','users.id'=>$tId);
           $or_wher  = array('users.userPlan'=>'3,4');

          $allTrainer3s = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher='',1,'3',$discountLevel3Same,$stripCouponId3Same);

          $allTrainer4s = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher,$or_wher,1,'4',$discountLevel4Same,$stripCouponId4Same);
          //pr($allTrainer3s);


          $wher3o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>3,'users.id !='=>$tId);

          $allTrainer3o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher3o,$or_wher='',9,3,$discountLevel3Other,$stripCouponId3Other);

           $allTrainer3so = array_merge($allTrainer3s,$allTrainer3o);


          $wher4o = array('users.userRole'=>'trainer','users.promote'=>1,'users.showSliderTrainer'=>0,'users.userPlan'=>4,'users.id !='=>$tId);

          $allTrainer4o = $this->common_model->GetSingleJoinRecordTrainer_link(USERS,'id',TRAINERMETA,'trainerId',$field_val='',$wher4o,$or_wher='',9,4,$discountLevel4Other,$stripCouponId4Other);

          //pr($allTrainer4o);
          if(!empty($allTrainer4o)){
             $allTrainer4so = array_merge($allTrainer4s,$allTrainer4o);
           }else{
            $allTrainer4so = $allTrainer4s;
           }

         


          if(!empty($allTrainer3so)AND !empty($allTrainer4so)){
            $allTrainer3 = array_merge($allTrainer3so,$allTrainer4so);
           }else if(empty($allTrainer3so)){
             $allTrainer3 = $allTrainer4so;
           }else{
            $allTrainer3 = $allTrainer3so;
           }
    
          if(!empty($allTrainer4s)AND !empty($allTrainer4o)){
             $allTrainer4 = array_merge($allTrainer4s,$allTrainer4o);
           }else if(empty($allTrainer3s)){
             $allTrainer4 = $allTrainer3;
           }else{
            $allTrainer4 = $allTrainer3s;
           }
         
          $new = array();
          if(!empty($allTrainer3) AND !empty($allTrainer4)){
              $ct = count($allTrainer3)+count($allTrainer4);   
            for ($i=0; $i<$ct; $i++){
              if(!empty($allTrainer3[$i])){
                $new[] =$allTrainer3[$i];
              }
              if(!empty($allTrainer4[$i])){
                $new[] =$allTrainer4[$i];
              } 
            }
            $data['allTrainer']= $new;
          }
         $data['allTrainer']= $new;
         $this->load->front_render('allTrainerslide',$data,'');
        }
    }
    } 
  }
}


  function membership(){
  
  //pr($_COOKIE);
    $data['title']="Join Our membership";
    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');

    if(isset($_COOKIE['reffralId'])){
      $referralId =  $_COOKIE['reffralId'];
      $where = array('users.id'=>$referralId,'userRole'=>'trainer');
      $field_first='id';
      $trainerData= $this->common_model->GetSingleJoinRecord(USERS, $field_first,TRAINERMETA,'trainerId',$field_val='',$where);
     
      if(!empty($trainerData)){
        $level1   = get_membership_price()['level1'];
        $level2   = get_membership_price()['level2'];
        $level3   = get_membership_price()['level3'];
        $level4   = get_membership_price()['level4'];

        $disLevel1      =$trainerData->discountLevel1;
        $disLevel2      =$trainerData->discountLevel2;
        $disLeve3Same   =$trainerData->discountLevel3Same;
        $disLevel3Other =$trainerData->discountLevel3Other;

        $disLeve4Same   =$trainerData->discountLevel4Same;
        $disLevel4Other =$trainerData->discountLevel4Other;
        
        $data['totalLavel1']      =($level1)-($level1*$disLevel1)/100;
        $data['totalLavel2']      =($level2)-($level2*$disLevel2)/100;
        $data['totalLavel3Same']  =($level3)-($level3*$disLeve3Same)/100;
        $data['totalLavel3Other'] =($level3)-($level3*$disLevel3Other)/100;
        $data['totalLavel4Same']  =($level4)-($level4*$disLeve4Same)/100;
        $data['totalLavel4Other'] =($level4)-($level4*$disLevel4Other)/100;
       /* pr($data['totalLavel3Other']);*/
        $data['trainerId']=$trainerData->trainerId;
      }
    }
   
    $this->load->front_render('membership',$data,'');
  }
  //trainer detail page view on profile page

  function myTrainerProfile(){
    $this->check_user_session();
    $this->load->model('Trainer_model');
    $trainerId =decoding($this->uri->segment(4)); //get trainerId

    $data['trainerDetail'] = $this->Trainer_model->trainerDetail($trainerId);
    $data['recipeCat'] = $this->common_model->getAll(RECEPIE_CATEGORY);
    $data['title']="My Trainer Detail";
    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css','frontend_assets/css/lightgallery.min.css');
    $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/js/lightgallery-all.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
    $this->load->front_render('my-trainer-profile',$data);

  } //End Fn

  //article pagination on my trainer profile page
  public function articlePagination($rowno=0){
    $this->check_ajax_auth();
    $trainerId = $this->input->post('id'); //get trainerId

    $this->load->model('Trainer_model');
    $this->load->library('ajax_pagination');
    $page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;
    // Row per page
    $rowperpage = 10;
    // All records count
    $allcount = $this->Trainer_model->getrecordCount($trainerId);
    // Get records
    $article_record = $this->Trainer_model->getData($rowno,$rowperpage,$trainerId);
    $data['trainerDetail'] = $this->Trainer_model->trainerDetail($trainerId);
   
    // Pagination Configuration        
    $config['base_url'] = base_url().'home/trainers/articlePagination';
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['prev_link'] = '« Prev';
    $config['next_link'] = 'Next »';
    $config['total_rows'] = $allcount;
    $config['uri_segment'] = 4;
    $config['per_page'] = $rowperpage;
    $config['num_links'] = 5;
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

    $this->ajax_pagination->initialize($config); // Initialize
    // Initialize $data Array
    $data['pagination'] = $this->ajax_pagination->create_links();
    if($article_record){
      $data['result'] = $article_record;
    }else{
      $data['result'] = '';
    }
    $data['row'] = $rowno;
    $html = $this->load->view('my_trainer_article_list', $data, TRUE);
    echo json_encode(array('status'=>1, 'html'=>$html)); exit;

  } //End Fn

  //forum pagination on my trainer profile page
  public function forumPagination($rowno=0){
    $this->check_ajax_auth();
    $trainerId = $this->input->post('id'); //get trainerId
    
    $this->load->model('Trainer_model');
    $this->load->library('ajax_pagination');
    $page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;
    // Row per page
    $rowperpage = 10;
    // All records count
    $allcount = $this->Trainer_model->getForumcount($trainerId);
    // Get records
    $forum_record = $this->Trainer_model->getForumData($rowno,$rowperpage,$trainerId);
    $data['trainerDetail'] = $this->Trainer_model->trainerDetail($trainerId);
    // Pagination Configuration        
    $config['base_url'] = base_url().'home/trainers/forumPagination';
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['prev_link'] = '« Prev';
    $config['next_link'] = 'Next »';
    $config['total_rows'] = $allcount;
    $config['uri_segment'] = 4;
    $config['per_page'] = $rowperpage;
    $config['num_links'] = 5;
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
    $config['paginate_call'] = 'ajax_fun_forum';

    $this->ajax_pagination->initialize($config); // Initialize
    // Initialize $data Array
    $data['pagination'] = $this->ajax_pagination->create_links();
    if($forum_record){
      $data['result'] = $forum_record;
    }else{
      $data['result'] = '';
    }
    $data['row'] = $rowno;
    $html = $this->load->view('my_trainer_forum_list', $data, TRUE);
    echo json_encode(array('status'=>1, 'html'=>$html)); exit;

  } //End Fn

  //informational video pagination on my trainer profile page
  public function infovideoPagination($rowno=0){
    $this->check_ajax_auth();
    $trainerId = $this->input->post('id'); //get trainerId
    
    $this->load->model('Trainer_model');
    $this->load->library('ajax_pagination');
    $page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;
    // Row per page
    $rowperpage = 12;
    // All records count
    $allcount = $this->Trainer_model->getInfovideocount($trainerId);
    // Get records
    $video_record = $this->Trainer_model->getInfovideoData($rowno,$rowperpage,$trainerId);
    
    // Pagination Configuration        
    $config['base_url'] = base_url().'home/trainers/infovideoPagination';
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['prev_link'] = '« Prev';
    $config['next_link'] = 'Next »';
    $config['total_rows'] = $allcount;
    $config['uri_segment'] = 4;
    $config['per_page'] = $rowperpage;
    $config['num_links'] = 5;
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
    $config['paginate_call'] = 'ajax_fun_infovideo';

    $this->ajax_pagination->initialize($config); // Initialize
    // Initialize $data Array
    $data['pagination'] = $this->ajax_pagination->create_links();
    if($video_record){
      $data['result'] = $video_record;
    }else{
      $data['result'] = '';
    }
    $data['row'] = $rowno;
    $html = $this->load->view('my_trainer_infoVideo_list', $data, TRUE);
    echo json_encode(array('status'=>1, 'html'=>$html)); exit;

  } //End Fn

  //training video pagination on my trainer profile page
  public function trainingVideoPagination($rowno=0){
    $this->check_ajax_auth();
    $trainerId = $this->input->post('id'); //get trainerId
    
    $this->load->model('Trainer_model');
    $this->load->library('ajax_pagination');
    $page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;
    // Row per page
    $rowperpage = 12;
    // All records count
    $allcount = $this->Trainer_model->getTrainingvideocount($trainerId);
    // Get records
    $trainingVideoRecord = $this->Trainer_model->getTrainingvideoData($rowno,$rowperpage,$trainerId);
    
    // Pagination Configuration        
    $config['base_url'] = base_url().'home/trainers/trainingVideoPagination';
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['prev_link'] = '« Prev';
    $config['next_link'] = 'Next »';
    $config['total_rows'] = $allcount;
    $config['uri_segment'] = 4;
    $config['per_page'] = $rowperpage;
    $config['num_links'] = 5;
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
    $config['paginate_call'] = 'ajax_fun_trainingvideo';

    $this->ajax_pagination->initialize($config); // Initialize
    // Initialize $data Array
    $data['pagination'] = $this->ajax_pagination->create_links();
    if($trainingVideoRecord){
      $data['result'] = $trainingVideoRecord;
    }else{
      $data['result'] = '';
    }
    $data['row'] = $rowno;
    $html = $this->load->view('my_trainer_trainingVideo_list', $data, TRUE);
    echo json_encode(array('status'=>1, 'html'=>$html)); exit;

  } //End Fn

  //Recipe pagination on my trainer profile page
  public function recipePagination($rowno=0){
    $this->check_ajax_auth();
    $trainerId = $this->input->post('id'); //get trainerId
    $search = $this->input->post('search');
    //pr($search);
    $this->load->model('Trainer_model');
    $this->load->library('ajax_pagination');
    $page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;
    // Row per page
    $rowperpage = 10;
    // All records count
    $allcount = $this->Trainer_model->getRecipeCount($trainerId,$search);
    // Get records
    $recipeRecord = $this->Trainer_model->getRecipeData($rowno,$rowperpage,$trainerId,$search);
    // Pagination Configuration        
    $config['base_url'] = base_url().'home/trainers/recipePagination';
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['prev_link'] = '« Prev';
    $config['next_link'] = 'Next »';
    $config['total_rows'] = $allcount;
    $config['uri_segment'] = 4;
    $config['per_page'] = $rowperpage;
    $config['num_links'] = 5;
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
    $config['paginate_call'] = 'ajax_fun_recipe';

    $this->ajax_pagination->initialize($config); // Initialize
    // Initialize $data Array
    $data['pagination'] = $this->ajax_pagination->create_links();
    if($recipeRecord){
      $data['result'] = $recipeRecord;
    }else{
      $data['result'] = '';
    }
    $data['row'] = $rowno;
    $html = $this->load->view('my_trainer_recipe_list', $data, TRUE);
    echo json_encode(array('status'=>1, 'html'=>$html)); exit;

  } //End Fn

  //trainer profile page from homepage & onlinecoaching page
  function trainerProfile(){

    $this->load->model('Trainer_model');
    $trainerId =decoding($this->uri->segment(4)); //get trainerId
    $data['trainerDetail'] = $this->common_model->getsingle(USERS,array('id'=> $trainerId));
    $data['trId']=$trainerId; 
    $data['trainerInfoVideo'] = $this->common_model->getAll(INFORMATIONALVIDEO,'id','desc','','3','0','',array('postedById'=> $trainerId));

    $data['trainerTrainVideo'] = $this->common_model->getAll(TRAININGVIDEO,'id','desc','','3','0','',array('postedById'=> $trainerId));

    $data['trainerRecipe'] = $this->common_model->getAll(RECEPIE,'id','desc','','4','0','',array('addedById'=> $trainerId));

    $data['trainerArticle'] = $this->Trainer_model->trainerArticle($trainerId);
    $data['trainerForum'] = $this->Trainer_model->trainerForum($trainerId);

    $data['title']="Trainer Detail";
    /*$data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css','frontend_assets/css/lightgallery.min.css');*/
    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css','frontend_assets/css/lightgallery.min.css');
    
     $data['front_js']= array('frontend_assets/js/lightgallery-all.min.js','frontend_assets/js/readmore.min.js','frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');

   /* $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/js/lightgallery-all.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');*/
    $this->load->front_render('trainer-profile',$data);

  } //End Fn

  function trainerInfoVideo(){
    if(!empty($_GET['id'])){
      $trainerId= $_GET['id'];
     
     $data['trainerInfoVideo'] = $this->common_model->getAll(INFORMATIONALVIDEO,'id','desc','','3','0','',array('postedById'=> $trainerId));
       $html = $this->load->view('trainer_profile_infoVideo_list', $data, TRUE);
       echo json_encode(array('status'=>1, 'data'=>$html)); exit;
    }
  }

   function trainerTrainingVideo(){

    if(!empty($_GET['id'])){
      $trainerId= $_GET['id'];
      $data['trainerTrainVideo'] = $this->common_model->getAll(TRAININGVIDEO,'id','desc','','3','0','',array('postedById'=> $trainerId));
      $html = $this->load->view('trainer_profile_trainingVideo_list', $data, TRUE);
       echo json_encode(array('status'=>1, 'data'=>$html)); exit;
    }
  }


}//END OF CLASS
