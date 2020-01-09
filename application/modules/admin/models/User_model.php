<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // COUNT TOTAL TRAINER 
    function userCount($type,$like){
    	$this->db->select('*')->from(USERS);
		$this->db->where($type);
		if(!empty($like)){
		 $this->db->group_start();	
		 $this->db->like('fullName',$like);	
		 $this->db->or_like('email',$like);	
		 $this->db->group_end();
		}
		
		return  $this->db->get()->num_rows();	
    }
    function userCount1($type){
    	$this->db->select('*')->from(USERS);
		$this->db->where($type);
		/*if(!empty($like)){
		 $this->db->group_start();	
		 $this->db->like('fullName',$like);	
		 $this->db->or_like('email',$like);	
		 $this->db->group_end();
		}*/
		
		return  $this->db->get()->num_rows();	
    }

    //END OF FUNCTION
    
    function userCountByLevele($type,$where){
    	$this->db->select('*')->from(USERS);
		$this->db->where($type);
		$this->db->where($where);
		return  $this->db->get()->num_rows();	
    } 

      function userCountBySearch($type,$where){
    	$this->db->select('*')->from(USERS);
		$this->db->where($type);
		$this->db->like($where);
		return  $this->db->get()->num_rows();	
    } 


    // FOR USERS RECORD  
    function getAllUser($limit,$start,$type,$like){
		$this->db->select('*,(CASE
            WHEN status = 1 THEN "Active"
            ELSE "Inactive"
            END) as status');
		$this->db->from(USERS);
		$this->db->where($type);
		if(!empty($like)){
		 $this->db->group_start();		
		 $this->db->like('fullName',$like);	
		 $this->db->or_like('email',$like);
		  $this->db->group_end();
		}
		
		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		//lq();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION
	    // FOR USERS RECORD  
    function getAllUserByLevel($limit,$start,$type,$where){
		$res = $this->db->select('*,(CASE
            WHEN status = 1 THEN "Active"
            ELSE "Inactive"
            END) as status')->from(USERS);
		$this->db->where($type);
		$this->db->where($where);
		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}
	 function getAllUserBySearch($limit,$start,$type,$where){
		$res = $this->db->select('*,(CASE
            WHEN status = 1 THEN "Active"
            ELSE "Inactive"
            END) as status')->from(USERS);
		$this->db->where($type);
		$this->db->like($where);
		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}
	function gusteUserCount($search){
    	$this->db->select('*')->from('guestUser');
    	if(!empty($search)){
		$this->db->like('email',$search);
    	}		
		return  $this->db->get()->num_rows();	
    } 
	//END OF FUNCTION
	 function getAllGusteUser($limit,$start,$search){
		$this->db->select('*');
		$this->db->from('guestUser');
		//$this->db->where($type);
		if(!empty($search)){
		$this->db->like('email',$search);
    	}
		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}

}//End Class
?>