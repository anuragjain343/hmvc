<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }

    // COUNT TOTAL TRAINER 
    function articleCount($type='',$ortype=''){
    	$this->db->select('*')->from(ARTICLE);
    	if(!empty($type)){
			$this->db->where($type);
		}
		if(!empty($ortype)){
			$this->db->or_where($ortype);
		}
		$this->db->where('articleStatus',1);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION.
    function articleAnswerCount($type){
    	$this->db->select('*')->from(ARTICLEANSWER);
    	if(!empty($type)){
			$this->db->where($type);
		}
		return  $this->db->get()->num_rows();		
    }

    function articleCountBySeaching($search,$type='',$ortype=''){
    	$this->db->select('*,ar.id as articleId');
    	$this->db->from(ARTICLE.' as ar');
    	$this->db->group_start();
    	if(!empty($type)){
    	$this->db->where($type);
    	}
    	if(!empty($ortype)){
			$this->db->or_where($ortype);
		}
		$this->db->where('articleStatus',1);
		$this->db->group_end();
    	$this->db->like('title',$search);
    	$this->db->or_like('description',$search);
		return  $this->db->get()->num_rows();	
    }

    function getAllArticle($limit,$start,$type,$ortype){
		$this->db->select('*,ar.id as articleId');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		//$this->db->join(ARTICLELIKE.' as arl','arl.articleId = ar.id','left');
		//$this->db->join(ARTICLEVIEW.' as arv','arv.articleId = ar.id','left');
		$this->db->where('articleStatus',1);
		$this->db->group_start();
		if(!empty($type)){
			$this->db->where($type);
		}
		if(!empty($ortype)){
			$this->db->or_where($ortype);
		}
		$this->db->group_end();
		$this->db->order_by('ar.crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {
				
			$rows[$key]->totalLike 		=	$this->getArticleLike($value->articleId);
			$rows[$key]->totalView 		=	$this->getArticleView($value->articleId);
			$rows[$key]->totalAnswer 	=	$this->getArticleTotalAnswer($value->articleId);
			
			}
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}

	function getArticleLike($id){
		$this->db->select('*')->from(ARTICLELIKE);
		$this->db->where('articleId',$id);
		return  $this->db->get()->num_rows();
	}

	function getArticleView($id){
		$this->db->select('*')->from(ARTICLEVIEW);
		$this->db->where('articleId',$id);
		return  $this->db->get()->num_rows();
	}

	function getArticleTotalAnswer($id){
		$this->db->select('*')->from(ARTICLEANSWER);
		$this->db->where('articleId',$id);
		return  $this->db->get()->num_rows();
	}
	function getArticleAnswerLike($id,$ansid){
		$this->db->select('*')->from(ARTICLEANSWERLIKE);
		$this->db->where('articleId',$id);
		$this->db->where('answerId',$ansid);
		return  $this->db->get()->num_rows();
	}
    function getArticleAnswerLikeByCurrentUser($id,$ansid,$userid){
    	$this->db->select('*')->from(ARTICLEANSWERLIKE);
		$this->db->where('articleId',$id);
		$this->db->where('answerId',$ansid);
		$this->db->where('userId',$userid);
		return  $this->db->get()->num_rows();
    }


	function getAllArticleBySearch($limit,$start,$search,$type='',$ortype=''){
		$this->db->select('*,ar.id as articleId');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		$this->db->group_start();
		$this->db->where('articleStatus',1);
		if(!empty($type)){
		$this->db->where($type);
		}
		if(!empty($ortype)){
			$this->db->or_where($ortype);
		}
		$this->db->group_end();
		$this->db->order_by('ar.crd','DESC');
		$this->db->like('title', $search);
    	$this->db->or_like('description', $search);
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {
				
			$rows[$key]->totalLike 		=	$this->getArticleLike($value->articleId);
			$rows[$key]->totalView 		=	$this->getArticleView($value->articleId);		
			$rows[$key]->totalAnswer 	=	$this->getArticleTotalAnswer($value->articleId);
			

			}
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}

	function getArticle($where){
		$this->db->select('*,ar.id as articleId,ar.crd as articleCreate,COUNT(DISTINCT `al`.`id`) as totalLike');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		$this->db->join(ARTICLELIKE.' as al','al.articleId = ar.id','left');
		//$this->db->join(FOURMLIKE.' as fl','fl.forumId = fm.id','left');
		//$this->db->join(FOURMVIEW.' as fv','fv.forumId = fm.id','left');
		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->row();
			return $rows ; // FORUM RECORD FOUND 
		}else{
			return false; // FORUM RECORD NOT  FOUND 
		}
	}
  	function getArticleAnswer($where){
  		$userId = $_SESSION[USER_SESS_KEY]['userId'];
  		$this->db->select('*,ar.id as articleid,ara.crd as articleAnsweCreate,ara.answerBy as ansAddedBy,ara.id as answerId');
		$this->db->from(ARTICLEANSWER.' as ara');
		$this->db->join(USERS.' as us','us.id = ara.answerById','left');
		$this->db->join(ARTICLE.' as ar','ar.id = ara.articleId','left');
		
		//$this->db->join(FOURMVIEW.' as fv','fv.forumId = fm.id','left');
		$this->db->where($where);
		$this->db->order_by('ara.crd','DESC');
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {
			$rows[$key]->totalAnswerLike 	=	$this->getArticleAnswerLike($value->articleid,$value->answerId);
			$rows[$key]->currentUserLike 	=	$this->getArticleAnswerLikeByCurrentUser($value->articleid,$value->answerId,$userId);
			$rows[$key]->totalAnswerCount 	=	$this->getArticleTotalAnswer($value->articleid);
			}
			return $rows ; // FORUM RECORD FOUND 
		}else{
			return false; // FORUM RECORD NOT  FOUND 
		}	
  	} 

  	function getArticleAnswerAll($limit,$start,$where){
  		$userId = $_SESSION[USER_SESS_KEY]['userId'];
  		$this->db->select('*,ar.id as articleid,ara.crd as articleAnsweCreate,ara.answerBy as ansAddedBy,ara.id as answerId');
		$this->db->from(ARTICLEANSWER.' as ara');
		$this->db->join(USERS.' as us','us.id = ara.answerById','left');
		$this->db->join(ARTICLE.' as ar','ar.id = ara.articleId','left');
		$this->db->limit($limit,$start);
		$this->db->where($where);
		$this->db->order_by('ara.crd','DESC');
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as  $key => $value) {
			$rows[$key]->totalAnswerLike 	=	$this->getArticleAnswerLike($value->articleid,$value->answerId);
			$rows[$key]->currentUserLike 	=	$this->getArticleAnswerLikeByCurrentUser($value->articleid,$value->answerId,$userId);
			$rows[$key]->totalAnswerCount 	=	$this->getArticleTotalAnswer($value->articleid);
			}
			return $rows ; // FORUM RECORD FOUND 
		}else{
			return false; // FORUM RECORD NOT  FOUND 
		}	
  	} 
	

}//End Class
?>