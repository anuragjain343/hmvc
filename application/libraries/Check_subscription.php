<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Send an SMS using Twilio's REST API and PHP
class Check_subscription  {

    public function __construct(){
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
         $this->CI->load->model('common_model');

    }
    
   
    // cehck free or paid membership
    public function check_membership(){

         $userId = $_SESSION[USER_SESS_KEY]['userId'];
         $where = array('id'=>$userId,'userRole'=>'user');
         $userData = $this->CI->common_model->getsingle(USERS,$where);
         if($userData->userPlan=='free'){
            return  FALSE;
         }else{
            return TRUE;
         }
    }

    // check subscription level 1,2,3,4 
    public function checkPlan(){

       $userId = $_SESSION[USER_SESS_KEY]['userId'];
       $where = array('id'=>$userId,'userRole'=>'user');
       $userData = $this->CI->common_model->getsingle(USERS,$where);
        if($userData->userPlan!='free'){
            return $userData->userPlan;
         }else{
            return FALSE;
         }

    }

  
    public function checkSsubscription(){
        //pr('fa');
        $res = $this->check_membership();
        //pr($res);
        if($res==TRUE){
            return $plan = $this->checkPlan();
        }else{
            return FALSE;
        }

    }

    

    //END OF FUNCTION


}
?>