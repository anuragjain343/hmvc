<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Subscription Model
 * 
 */
class Subscription_model extends CI_Model {
    
    var $tbl_biz_users = 'tbl_venue_owner',
        $tbl_venue = 'tbl_venue',
        $tbl_payments = 'payment',
        $paywall_yes = 1, // 1:Yes(need to pay)
        $paywall_no = 0;  // 0:No(no need to pay)
        
    function __construct() {
        parent::__construct();
        //$this->user_data = $_SESSION[USER_SESS_KEY]; //get current user session data;
       
    }
    
    //get customer ID of user by user ID
    function get_stripe_subscription_id(){
        
        $where = array('id'=>$_SESSION[USER_SESS_KEY]['userId']);
        $user_detail = $this->common_model->getsingle(USERS
, $where, 'subscriptionId');
        
        if($user_detail)
            return $user_detail->subscription_id;
        
        return FALSE;
    }
    
    //get customer ID of user by user ID
function get_stripe_customer_id(){
       
   $where = array('id'=>$_SESSION[USER_SESS_KEY]['userId']);
   $user_detail = $this->common_model->getsingle(USERS,$where,'stripeCustomerId');
   
   if($user_detail)
      return $user_detail->stripeCustomerId;
      return FALSE;
}
    
  //save/update customer ID of user by user ID
function save_customer_id($customer_id){
        $data_update = array('stripeCustomerId
'=>$customer_id);
        $where = array('id'=>$_SESSION[USER_SESS_KEY]['userId']
);
        return $this->common_model->updateFields(USERS
, $data_update, $where);
    }
    
    //save/update customer subscription for later reference
    function save_subscription_id($subscription_id='',$planId ='',$trainerId){
        $data_update = array('subscriptionId'=>$subscription_id,'userPlan'=>$planId,'assignTrainer'=>$trainerId);
        $where = array('id'=>$_SESSION[USER_SESS_KEY]['userId']);
       return $this->common_model->updateFields(USERS,$data_update, $where);
    }
    
    //save payment data
    function save_payment($payment_data){
        $this->db->insert($this->tbl_payments, $payment_data);
        return $this->db->insert_id();
    }
    
    //get subscription ID of a user
    function get_subscription_id($user_id=''){
        
        if(empty($user_id))
            $user_id = $_SESSION[USER_SESS_KEY]['userId']
; //get current user ID
        
        $where = array('id'=>$user_id);    
        $this->db->select('subscriptionId');
        $this->db->from(USERS
);
        $this->db->where($where);
        $ret = $this->db->get()->row();
        return $ret->subscriptionId;
    }
    
    function get_paywall_status($user_id=''){
        
        if(empty($user_id))
        $user_id =  $_SESSION[USER_SESS_KEY]['userId']; //get current user ID
        
        $where = array('id'=>$user_id);    
        $this->db->select('paywall'); // 1:Yes(need to pay), 0:No(no need to pay)
        $this->db->from(USERS);
        $this->db->where($where);
        $ret = $this->db->get()->row();
        return $ret->paywall;
    }
    
    //update paywall flag
    function update_paywall($status){
        $data_update = array('paywall'=>$status);
        $where = array('id'=>$_SESSION[USER_SESS_KEY]['userId']);
        $ret  = $this->common_model->updateFields(USERS, $data_update, $where);
      /*  $res         = $this->db->select('*')->where($where)->get(USERS);
        $result      = $res->row();*/
        $this->load->model('login_model'); 
        //$this->login_model->session_create($_SESSION[USER_SESS_KEY]['userId']); //set user data in session
        return $ret;
    }
    
    //get payment history of user
    function get_user_payment_history(){
    $user_id = $_SESSION[USER_SESS_KEY]['userId']; //get current user ID
        $where = array('user_id'=>$user_id);    
        $this->db->select('*');
        $this->db->from($this->tbl_payments);
        $this->db->where($where);
        $this->db->order_by('payment_id', 'DESC');
        $this->db->limit(100, 0); //get only last 50 payments for now
        return $this->db->get()->result();
    }
    
    //when it is confirmed that user subscription is canceled
    //clear existing subscription ID and change paywall status
    function cancel_subscription($customer_id){
        $data_update = array('subscriptionId'=>'', 'paywall'=>$this->paywall_yes);
        $where = array('stripeCustomerId'=>$customer_id);
        $this->common_model->updateFields(USERS,$data_update,$where);
    }

    function cancelSubscription($subscription_id){

        $this->db->select('id,subscriptionId');
        $this->db->where(array('subscriptionId'=>$subscription_id));
        //$this->db->or_where(array('bizSubscriptionId'=>$subscription_id));
        $req = $this->db->get(USERS);
        $isUpdated = '';
        if($req->num_rows()){ 
            $res = $req->row();
            if($res->subscriptionId == $subscription_id){
                $where = array('id'=>$res->id);
                $isUpdated = $this->common_model->updateFields(USERS, array('assignTrainer'=>'0','subscriptionId'=>'','paywall'=>0,'userPlan'=>'free'),$where);
            }
        }

        if($isUpdated){
            return TRUE;
        }else{
            return FALSE;
        }
    } 
    
}