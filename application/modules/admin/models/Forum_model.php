<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forum_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // COUNT TOTAL TRAINER 
    function forumCount($type=''){
    	$this->db->select('*')->from(FOURM);

         if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$condi = array('forumStatus'=>1,'addedById'=>1);
      		$this->db->where($condi);
      		$condi2 = array('addedById!='=>1);
      		$this->db->or_where($condi2);
      		
         }
		return  $this->db->get()->num_rows();	
    } 

     function forumCountSearch($type=''){
    	$this->db->select('*')->from(FOURM);
    	
		//$this->db->where('userRole',$type);
		$this->db->like($type);
		if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$condi = array('forumStatus'=>1,'addedById'=>1);
      		$this->db->or_like($condi);
      		
         }
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION
      function forumCountInTrainerDetails($type=''){
    	$this->db->select('*')->from(FOURM);
		$this->db->where($type);
		return  $this->db->get()->num_rows();	
    }
    

    // FOR TRAINER RECORD  
    function getAllForum($limit,$start){
		$this->db->select('fm.id,fm.title,fm.description,fm.crd,fm.addedBy,fm.addedById,us.profileImage,us.fullName,us.id as userId,fm.forumStatus');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$condi = array('forumStatus'=>1,'addedById'=>1);
      		$this->db->where($condi);
      		$condi2 = array('addedById!='=>1);
      		$this->db->or_where($condi2);
      		
         }
		$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		//lq();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {	
            $whr = array('forumId'=>$value->id);
			$rows[$key]->totalans	=	$this->forumAnswerCount($whr);
			
			}

			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION
	 function getAllForumSearch($limit,$start,$type){
		$this->db->select('fm.id,fm.title,fm.description,fm.crd,fm.addedBy,fm.addedById,us.profileImage,us.fullName,us.id as userId,fm.forumStatus');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$condi = array('forumStatus'=>1,'addedById'=>1);
      		$this->db->or_like($condi);
      		
         }
		$this->db->like($type);
		$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {	
            $whr = array('forumId'=>$value->id);
			$rows[$key]->totalans	=	$this->forumAnswerCount($whr);
			
			}

			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//
	function getAllForumInTrainerDetails($limit,$start,$type){
		$this->db->select('fm.id,fm.title,fm.description,fm.crd,fm.addedBy,us.profileImage,us.fullName,us.id as userId,fm.forumStatus');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		//$this->db->join(FOURMANSWER.' as fa','fa.forumId = fm.id','left');
		$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);
		$this->db->where($type);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {	
            $whr = array('forumId'=>$value->id);
			$rows[$key]->totalans	=	$this->forumAnswerCount($whr);
			
			}

			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	    // FOR TRAINER RECORD  
   /* function getForum($where){
		$this->db->select('fm.id,fm.title,fm.description,fm.crd,fm.addedBy,us.profileImage,us.fullName');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);
		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->row();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}*/
	function getForum($where){
		$this->db->select('fm.id,fm.title,fm.description,fm.isDisableComment,fm.addedById,fm.crd,fm.forumStatus,fm.addedBy,us.profileImage,us.fullName,COUNT(DISTINCT `fl`.`id`) as totalLike,COUNT(DISTINCT `fv`.`id`) as totalView,COUNT(DISTINCT `fa`.`id`) as totalAnswer');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		$this->db->join(FOURMLIKE.' as fl','fl.forumId = fm.id','left');
		$this->db->join(FOURMVIEW.' as fv','fv.forumId = fm.id','left');
		$this->db->join(FOURMANSWER.' as fa','fa.forumId = fm.id','left');

		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->row();
			return $rows ; // FORUM RECORD FOUND 
		}else{
			return false; // FORUM RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION
		    // FOR TRAINER RECORD  
    function getForumDetails($where){
		$this->db->select('us.id,fm.id,us.UserRole,fm.title,fm.description,fm.crd,fm.addedBy,us.profileImage,us.fullName,fm.forumStatus');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		
		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}

	//END OF FUNCTION
	function forumAnswerCount($where){
		$this->db->select('*')->from(FOURMANSWER);
		$this->db->where($where);
		return  $this->db->get()->num_rows();
	}

	function getForumAnswer($limit,$start,$where){
		$userId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
		$whereUserLike = array('userId'=>$userId);
		$this->db->select('fm.id as answerId,fm.answer,fm.crd,fm.id,fm.answerBy,us.fullName,us.profileImage,us.id as user_id');
		$this->db->from(FOURMANSWER.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.answerById','left');
		$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);
		$this->db->where($where);
		// $this->db->where('isDisable',0);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			
			foreach ($rows as  $key => $value) {	

			$rows[$key]->totalanslike 		=	$this->getForumAnswerLike($value->answerId);
			$rows[$key]->currentUserLike 	=	$this->getForumAnswerUserLike($value->answerId,$whereUserLike);
			
			}
			
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}

	function getForumAnswerLike($id){
		$this->db->select('*')->from(ANSWERLIKE);
		$this->db->where('answerId',$id);
		return  $this->db->get()->num_rows();
	}

	function getForumAnswerUserLike($id,$where){
		$this->db->select('*')->from(ANSWERLIKE);
		$this->db->where('answerId',$id);
		$this->db->where($where);
		return  $this->db->get()->num_rows();
	}

}//End Class
?>