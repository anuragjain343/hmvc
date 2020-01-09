<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Membership_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

 function chekPlan($planLevel,$createdBy,$createdById,$planId){
 	
 	$where = array();
    
    $where['createdBy'] = $createdBy;
    $where['status'] = 1;
 	$where['planLevel'] = $planLevel;
    $where['createdById'] = $createdById;
    if($planId){
    $where['stripPlanId !='] = $planId;
    }
 	$check = $this->db->select('planId')->get_where('plans',$where)->row();
     //echo $this->db->last_query();die;
    if(empty($check)){
      return 1;
    }
    return 0;

 }
 function checkTrainerPlan($stripPlanId,$amount){
    $where = array();
    
    $where['stripPlanId'] = $stripPlanId;
    $check = $this->db->select('*')->get_where('plans',$where)->row();
    
    if($check->amount==$amount){

       return 0;

    }else{
         if($check->createdBy=='trainer'){
             $this->db->where($where)->update('plans',array('status'=>0));
         }
        return 1;
    }
    
 }  
 function getPlanList($id){
    
    $where = array();
    $where2 = array();
    
    
    $where['plans.createdById'] = $id;
    $where['plans.status'] = 1; 
    $this->db->select('plans.*,users.fullName')->from('plans');
    $this->db->join('users','users.id = plans.createdById');
    $this->db->where($where);
    
    $result = $this->db->get()->result();
    if(empty($result)){
        $where2['plans.createdBy'] = 'admin';
        $where2['plans.status'] = 1; 
        $where2['plans.planLevel >'] = 2; 
       
       $this->db->select('plans.*,users.fullName')->from('plans');
       $this->db->join('users','users.id = plans.createdById');
       $this->db->where($where2);
       $result = $this->db->get()->result();
       return $result;
    }else{
           if(count($result)==2){
             return $result;
           }else{
               
                $where3 = array();
                 $where3['plans.createdBy'] = 'admin';
                 $where3['plans.status'] = 1; 
                 $where3['plans.planLevel >'] = 2; 
                 $where3['plans.planLevel !='] = $result[0]->planLevel; 

                $this->db->select('plans.*,users.fullName')->from('plans');
                $this->db->join('users','users.id = plans.createdById');
                $this->db->where($where3);
                $result2 = $this->db->get()->row();
                if($result2){
                  array_push($result,$result2);
                }
                return $result;
           }
    }    
     
 }
  function getPlanListForUser($id){
    
    $where = array();
    $where2 = array();
    
    
    $where['plans.createdById'] = $id;
    $where['plans.status'] = 1; 
    $this->db->select('plans.*,users.fullName')->from('plans');
    $this->db->join('users','users.id = plans.createdById');
    $this->db->where($where);
   return  $result = $this->db->get()->result();

 /*   if(empty($result)){
        $where2['plans.createdBy'] = 'admin';
        $where2['plans.status'] = 1; 
        $where2['plans.planLevel >'] = 2; 
       
       $this->db->select('plans.*,users.fullName')->from('plans');
       $this->db->join('users','users.id = plans.createdById');
       $this->db->where($where2);
       $result = $this->db->get()->result();
       return $result;
    }else{
           if(count($result)==2){
             return $result;
           }else{
               
                $where3 = array();
                 $where3['plans.createdBy'] = 'admin';
                 $where3['plans.status'] = 1; 
                 $where3['plans.planLevel >'] = 2; 
                 $where3['plans.planLevel !='] = $result[0]->planLevel; 

                $this->db->select('plans.*,users.fullName')->from('plans');
                $this->db->join('users','users.id = plans.createdById');
                $this->db->where($where3);
                $result2 = $this->db->get()->row();
                if($result2){
                  array_push($result,$result2);
                }
                return $result;
           }
    }  */  
     
 }
//used for membership list page
function membershipList(){
    $this->db->select("p.*,u.fullName,c.couponName");
    $this->db->from(TBL_PLAN.' as p');
    $this->db->join(USERS.' as u','u.id = p.createdById');    
    $this->db->join(TBL_COUPON.' as c','c.stripCouponId = p.defaultCouponStripeId','left');
    $this->db->order_by('p.planId','DESC');   
    $query = $this->db->get();
    if($query->num_rows() > 0){
        $result = $query->result();
        return $result;
    }
    return FALSE;      
}// End

}//End Class

?>