<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // COUNT TOTAL TRAINER 
    function articleCount($type=''){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);
    		//$this->db->where('articleStatus',1);
    	}
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	$this->db->select('*')->from(ARTICLE);
		//$this->db->where('userRole',$type);
		return  $this->db->get()->num_rows();	
    } 
       function articleCountSearch($type=''){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);
    	}
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	$this->db->select('*')->from(ARTICLE);
		$this->db->like($type);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION


    // COUNT TOTAL TRAINER by perticule trainer 
    function articleCountTrainer($type='',$id){
    	$this->db->select('*')->from(ARTICLE);
		$this->db->where('addedById',$id);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION

    // FOR TRAINER RECORD  
    function getAllArticle($limit,$start){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);

    	}
    	//$this->db->where('articleStatus',1);
		$this->db->select('ar.id,ar.title,ar.description,ar.crd,ar.addedBy,ar.addedById,us.profileImage,us.fullName,ar.articleStatus');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		$this->db->order_by('ar.crd','DESC');
		//$this->db->where('articleStatus',1);
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {	

			$rows[$key]->totalArticlelike 	=	$this->getArticleLikesCount($value->id);
			
			}
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	    function getAllArticleSearch($limit,$start,$type){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);
    	}
		$this->db->select('ar.id,ar.title,ar.description,ar.crd,ar.addedBy,ar.addedById,us.profileImage,us.fullName,ar.articleStatus');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		$this->db->like($type);
		$this->db->order_by('ar.crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {	

			$rows[$key]->totalArticlelike 	=	$this->getArticleLikesCount($value->id);
			
			}
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION

    // FOR TRAINER RECORD  
    function getAllArticleTrainer($limit,$start,$id){
		$this->db->select('ar.id,ar.title,ar.description,ar.crd,ar.addedBy,ar.addedById,us.profileImage,us.fullName');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		$this->db->order_by('ar.crd','DESC');
		$this->db->limit($limit,$start);
		$this->db->where('addedById',$id);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {	

			$rows[$key]->totalArticlelike 	=	$this->getArticleLikesCount($value->id);
			
			}
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION

	// FOR TRAINER RECORD  
    function getArticle($where){
		$this->db->select('ar.id,ar.title,ar.description,ar.isDisableComment,ar.crd,ar.addedBy,us.profileImage,us.fullName,ar.addedById,ar.articleStatus');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		/*$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);*/
		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->row();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION
		    // FOR TRAINER RECORD  
    function getArticleDetails($where){
		$this->db->select('us.id,ar.id,us.UserRole,ar.title,ar.description,ar.crd,ar.addedBy,us.profileImage,us.fullName');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		/*$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);*/
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

		function ArticleAnswerCount($where){
		$this->db->select('*')->from(ARTICLEANSWER);
		$this->db->where($where);
		return  $this->db->get()->num_rows();
	}


		function getArticleAnswer($limit,$start,$where){
		$userId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
		$whereUserLike = array('id'=>$userId);
		$this->db->select('ar.id as answerId,ar.answer,ar.crd,ar.answerBy,ar.id,us.fullName,us.profileImage,us.id as userId,ar.articleId as article_id');
		$this->db->from(ARTICLEANSWER.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.answerById','left');
		$this->db->order_by('ar.crd','DESC');
		$this->db->limit($limit,$start);
		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			
			foreach ($rows as  $key => $value) {	

			$rows[$key]->totalanslike 		=	$this->getArticleAnswerLikes($value->answerId,$value->article_id);
			$rows[$key]->currentUserLike 	=	$this->getArticleAnswerUserLike($value->answerId,$whereUserLike);
			
			}
			
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	function getArticleAnswerLikes($id,$articleId){
		$this->db->select('*')->from(ARTICLEANSWERLIKE);
		$this->db->where('answerId',$id);
		$this->db->where('articleId',$articleId);
		return  $this->db->get()->num_rows();
	}

	function getArticleAnswerLike($id){
		$this->db->select('*')->from(ARTICLEANSWER);
		$this->db->where('id',$id);
		return  $this->db->get()->num_rows();
	}
	
	function getArticleLikesCount($id){
		$this->db->select('*')->from(ARTICLELIKE);
		$this->db->where('articleId',$id);
		return  $this->db->get()->num_rows();
	}

	function getArticleAnswerUserLike($id,$where){
		$this->db->select('*')->from(ARTICLEANSWER);
		$this->db->where('id',$id);
		$this->db->where($where);
		return  $this->db->get()->num_rows();
	}
	

}//End Class
?>