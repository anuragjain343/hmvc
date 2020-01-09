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
		$this->db->where('forumStatus',1);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION
    function forumCountBySeaching($search){
    	$this->db->select('*')->from(FOURM);
    	$this->db->where('forumStatus',1);
    	$this->db->like('title', $search);
    	$this->db->or_like('description', $search);
		return  $this->db->get()->num_rows();	
    }

    // FOR TRAINER RECORD  
    function getAllForum($limit,$start){
		$this->db->select('fm.id,fm.title,fm.description,fm.crd,fm.addedBy,us.profileImage,us.fullName,(us.id) As userId,fm.forumStatus');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		$this->db->where('forumStatus',1);
		$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		//pr($res->result());
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as $ke => $value) {
				$wherecounts = array('forumId'=>$value->id);
				$rows[$ke]->ansCoun = $this->common_model->get_total_count(FOURMANSWER,$wherecounts);
			}
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION
	function getAllForumBySearch($limit,$start,$search){
		$this->db->select('fm.id,fm.title,fm.description,fm.crd,fm.addedBy,us.profileImage,us.fullName,(us.id) As userId,fm.forumStatus');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		$this->db->where('forumStatus',1);
		$this->db->order_by('fm.crd','DESC');
		$this->db->like('title', $search);
    	$this->db->or_like('description', $search);
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as $ke => $value) {
				$wherecounts = array('forumId'=>$value->id);
				$rows[$ke]->ansCoun = $this->common_model->get_total_count(FOURMANSWER,$wherecounts);
			}
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}

	}

    function getForum($where){
		$this->db->select('fm.id,fm.title,fm.description,fm.isDisableComment,fm.crd,fm.addedBy,fm.addedById,us.profileImage,us.fullName,COUNT(DISTINCT `fl`.`id`) as totalLike,COUNT(DISTINCT `fv`.`id`) as totalView');
		$this->db->from(FOURM.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		$this->db->join(FOURMLIKE.' as fl','fl.forumId = fm.id','left');
		$this->db->join(FOURMVIEW.' as fv','fv.forumId = fm.id','left');
		$this->db->where($where);
		$this->db->where('forumStatus',1);
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
		/*$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);*/
		$this->db->where($where);
		$this->db->where('forumStatus',1);
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
		//$this->db->where('forumStatus',1);
		return  $this->db->get()->num_rows();
	}

	function getForumAnswer($limit,$start,$where){
		$userId = $_SESSION[USER_SESS_KEY]['userId'];
		$whereUserLike = array('userId'=>$userId);
		$this->db->select('fm.id as answerId ,fm.answer,fm.crd,fm.id,us.fullName,us.profileImage,fm.answerBy,fm.answerById');
		$this->db->from(FOURMANSWER.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.answerById','left');
		//$this->db->where('forumStatus',1);
		$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);
		$this->db->where($where);
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
		//$whr = array('answerId'=>$where);
		$this->db->select('*')->from(ANSWERLIKE);
		$this->db->where('answerId',$id);
		return  $this->db->get()->num_rows();
		//->num_rows();
	}

	function getForumAnswerUserLike($id,$where){
		$this->db->select('*')->from(ANSWERLIKE);
		$this->db->where('answerId',$id);
		$this->db->where($where);
		return  $this->db->get()->num_rows();
	}

	  	function getForumAnswers($where){
  		$userId = $_SESSION[USER_SESS_KEY]['userId'];
  		$this->db->select('*,f.id as forumid,fa.crd,fa.answerBy as ansAddedBy,fa.id as answerId');
		$this->db->from(FOURMANSWER.' as fa');
		$this->db->join(USERS.' as us','us.id = fa.answerById','left');
		$this->db->join(FOURM.' as f','f.id = fa.forumId','left');
		
		//$this->db->join(FOURMVIEW.' as fv','fv.forumId = fm.id','left');
		$this->db->where($where);
		$this->db->order_by('fa.crd','DESC');
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {
			$rows[$key]->totalanslike 	=	$this->getArticleAnswerLike($value->forumId,$value->answerId);
			$rows[$key]->currentUserLike 	=	$this->getArticleAnswerLikeByCurrentUser($value->forumId,$value->answerId,$userId);
			$rows[$key]->totalAnswerCount 	=	$this->getArticleTotalAnswer($value->forumId);
			}
			return $rows ; // FORUM RECORD FOUND 
		}else{
			return false; // FORUM RECORD NOT  FOUND 
		}	
  	}

  	function getArticleAnswerLike($id,$ansid){
		$this->db->select('*')->from(ANSWERLIKE);
		$this->db->where('answerId',$ansid);
		return  $this->db->get()->num_rows();
	}

	function getArticleAnswerLikeByCurrentUser($id,$ansid,$userid){
    	$this->db->select('*')->from(ANSWERLIKE);
		$this->db->where('answerId',$ansid);
		$this->db->where('userId',$userid);
		return  $this->db->get()->num_rows();
    }

   	function getArticleTotalAnswer($id){
		$this->db->select('*')->from(FOURMANSWER);
		$this->db->where('forumId',$id);
		return  $this->db->get()->num_rows();
	}
	

}//End Class
?>