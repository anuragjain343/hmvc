<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

    function __construct(){
        
    	parent::__construct();
    }

    //get user subscription plan detail
    function userPlan($userId){
    	$this->db->select('u.userPlan, p.*');
		$this->db->from(USERS.' as u');
		$this->db->join(TBL_PLAN.' as p','u.userPlan = p.planId');
		$this->db->where('u.id', $userId);
		//$this->db->where('planLevel', $userId);
		$res = $this->db->get(); //lq();
		if($res->num_rows() > 0){
			$rows = $res->row(); 
			return $rows ; //  RECORD FOUND 
		}else{
			//for free plan 
			$this->db->select('id,userPlan');
			$this->db->from(USERS);
			$this->db->where('id', $userId);
			$res = $this->db->get(); //lq();
			$rows = $res->row(); 
			return $rows ; //  RECORD FOUND 
		}
    }


        function userPlan1($pln){
    	$this->db->select('*');
		$this->db->from(TBL_PLAN);
		$this->db->where('planLevel', $pln);
		$this->db->where('status', 1);
		$res = $this->db->get(); //lq();
		if($res->num_rows() > 0){
			$rows = $res->row(); 
			return $rows ; //  RECORD FOUND 
		}
    }

   function user_Plan($pln){
    	$this->db->select('*');
		$this->db->from(TBL_PLAN);
		$this->db->where('planLevel', $pln);
		$this->db->where('status', 1);
		$res = $this->db->get(); //lq();
		if($res->num_rows() > 0){
			$rows = $res->row(); 
			return $rows ; //  RECORD FOUND 
		}
    }

    function user_Plan_info($pln){
    	$this->db->select('*');
		$this->db->from(TBL_PLAN);
		$this->db->where('planId', $pln);
		//$this->db->where('status', 1);
		$res = $this->db->get(); //lq();
		if($res->num_rows() > 0){
			$rows = $res->row(); 
			return $rows ; //  RECORD FOUND 
		}
    }

    function user_Plan_day(){
    	$uid = $_SESSION[USER_SESS_KEY]['userId'];
	 	$myquery="SELECT * FROM `userSubscription` WHERE userId = $uid ";
	 	 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
    }

    //get other user/admin detail
    function otherUserDetail($userId){
    	$this->db->select('u.id,u.fullName,u.email,u.profileImage,u.userPlan,
    		u.userRole,p.planId,p.planLevel,p.planName,count(f.id) As forumCount,(select count(id) from article where addedById = u.id) As articleCount');
		$this->db->from(USERS.' as u');
		$this->db->join(TBL_PLAN.' as p','u.userPlan = p.planId', 'left');
		$this->db->join(FOURM.' as f','f.addedById = u.id','left');
		$this->db->where('u.id', $userId);
		//$this->db->group_by('u.id');
		$res = $this->db->get(); //lq();
		if($res->num_rows() > 0){
			$rows = $res->row(); 
			return $rows ; //  RECORD FOUND 
		}
		return false;
    }
}//End Class