<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Trainer_model extends CI_Model {

    function __construct(){
        
    	parent::__construct();
    }

    //get trainer detail and their recipes,articles,informational video
    function trainerDetail($trainerId){
    	$this->db->select('u.id, u.profileImage,u.fullName,u.email,u.details');
		$this->db->from(USERS.' as u');
		$this->db->where('u.id', $trainerId);
		$res = $this->db->get(); //lq();
		if($res->num_rows() > 0){
			$rows = $res->row(); 
			return $rows ; //  RECORD FOUND 
		}
		return false;
    }

    //get trainer article for trainer profile page
    function trainerArticle($trainerId){
    	$this->db->select('art.*, (select count(articleId) from articleLike where articleId = art.id) As TotalLike, (select count(articleId) from articleView where articleId = art.id) As totalView, (select count(articleId) from articleAnswer where articleId = art.id) As totalAnswer');
		$this->db->from(ARTICLE.' as art');
		$this->db->where('art.addedById', $trainerId);
		$this->db->where('art.articleStatus',1);

		$this->db->limit(3);
		$this->db->order_by('art.id', 'desc');
		$res = $this->db->get(); //lq();
		if($res->num_rows() > 0){
			$rows = $res->result(); 
			return $rows ; //  RECORD FOUND 
		}
		return false;
    }

    //get trainer forum for trainer profile page
    function trainerForum($trainerId){
    	$this->db->select('f.*, (select count(forumId) from '.FOURMANSWER.' where forumId = f.id) As totalAnswer');
		$this->db->from(FOURM.' as f');
		$this->db->where('f.addedById', $trainerId);
		$this->db->where('f.forumStatus',1);
		$this->db->limit(3);
		$this->db->order_by('f.id', 'desc');
		$res = $this->db->get(); //lq();
		if($res->num_rows() > 0){
			$rows = $res->result(); 
			return $rows ; //  RECORD FOUND 
		}
		return false;
    }

    // Select total records of trainer article on mytrainer page
	public function getrecordCount($trainerId) {
	    $this->db->select('count(*) as allcount');
	    $this->db->from(ARTICLE);
	    $this->db->where('addedById', $trainerId);
	    $query = $this->db->get();
	    if($query){
		    $result = $query->result_array();	 
		    return $result[0]['allcount'];
	    }else{
	    	return False;
	    }
	}
	//get data of trainer article on mytrainer page
    public function getData($rowno,$rowperpage,$trainerId) {
    	$this->db->select('art.*, (select count(articleId) from articleLike where articleId = art.id) As TotalLike, (select count(articleId) from articleView where articleId = art.id) As totalView,(select count(articleId) from articleAnswer where articleId = art.id) As totalAnswer');
	    $this->db->from(ARTICLE.' as art');
	    $this->db->where('addedById', $trainerId);
	    $this->db->limit($rowperpage, $rowno);  
	    $query = $this->db->get();
	    if($query){	
	    	return $query->result_array();
	    }else{
	    	return False;
	    }
	}
	// Select total records of trainer forum on mytrainer page
	public function getForumcount($trainerId) {
	    $this->db->select('count(*) as allcount');
	    $this->db->from(FOURM);
	    $this->db->where('addedById', $trainerId);
	    $query = $this->db->get();
	    if($query){
		    $result = $query->result_array();	 
		    return $result[0]['allcount'];
	    }else{
	    	return False;
	    }
	}
	//get data of trainer forum on mytrainer page
    public function getForumData($rowno,$rowperpage,$trainerId) {
    	$this->db->select('frm.*,(select count(forumId) from forumAnswer where forumId = frm.id) As totalAns');
	    $this->db->from(FOURM.' as frm');
	    $this->db->where('addedById', $trainerId);
	    $this->db->limit($rowperpage, $rowno);  
	    $query = $this->db->get();
	    if($query){	
	    	return $query->result_array();
	    }else{
	    	return False;
	    }
	}
	// Select total records of trainer informational video on mytrainer page
	public function getInfovideocount($trainerId) {
	    $this->db->select('count(*) as allcount');
	    $this->db->from(INFORMATIONALVIDEO);
	    $this->db->where('postedById', $trainerId);
	    $query = $this->db->get();
	    if($query){
		    $result = $query->result_array();	 
		    return $result[0]['allcount'];
	    }else{
	    	return False;
	    }
	}
	//get data of trainer informational video on mytrainer page
    public function getInfovideoData($rowno,$rowperpage,$trainerId) {
    	$this->db->select('infov.*');
	    $this->db->from(INFORMATIONALVIDEO.' as infov');
	    $this->db->where('postedById', $trainerId);
	    $this->db->limit($rowperpage, $rowno);  
	    $query = $this->db->get();
	    if($query){	
	    	return $query->result_array();
	    }else{
	    	return False;
	    }
	}
	// Select total records of trainer training video on mytrainer page
	public function getTrainingvideocount($trainerId) {
	    $this->db->select('count(*) as allcount');
	    $this->db->from(TRAININGVIDEO);
	    $this->db->where('postedById', $trainerId);
	    $query = $this->db->get();
	    if($query){
		    $result = $query->result_array();	 
		    return $result[0]['allcount'];
	    }else{
	    	return False;
	    }
	}
	//get data of trainer training video on mytrainer page
    public function getTrainingvideoData($rowno,$rowperpage,$trainerId) {
    	$this->db->select('tVideo.*');
	    $this->db->from(TRAININGVIDEO.' as tVideo');
	    $this->db->where('postedById', $trainerId);
	    $this->db->limit($rowperpage, $rowno);  
	    $query = $this->db->get();
	    if($query){	
	    	return $query->result_array();
	    }else{
	    	return False;
	    }
	}
	// Select total records of trainer recipe on mytrainer page
	public function getRecipeCount($trainerId,$search) {
	    $this->db->select('count(*) as allcount');
	    $this->db->from(RECEPIE. ' as recp');
	    $this->db->join(RECEPIE_CATEGORY. ' as recpcat', ' recp.categoryId = recpcat.id');
	    $this->db->group_start();
	    $this->db->where('addedById', $trainerId);
	    $this->db->group_end();
	    if($search <> 0 ){
	    	$this->db->where('recpcat.id', $search);
	    }
	    $query = $this->db->get(); //lq();
	    if($query){
		    $result = $query->result_array();	 
		    return $result[0]['allcount'];
	    }else{
	    	return False;
	    }
	}
	//get data of trainer recipe on mytrainer page
    public function getRecipeData($rowno,$rowperpage,$trainerId,$search) {
    	$this->db->select('recp.*,(recpcat.id) as catId');
	    $this->db->from(RECEPIE.' as recp');
	    $this->db->join(RECEPIE_CATEGORY. ' as recpcat', ' recp.categoryId = recpcat.id');
	    $this->db->group_start();
	    $this->db->where('addedById', $trainerId);
	    $this->db->group_end();
	    if($search <> 0 ){
	    	$this->db->where('recpcat.id', $search);
	    }
	    $this->db->limit($rowperpage, $rowno);  
	    $query = $this->db->get();
	    if($query){	
	    	return $query->result_array();
	    }else{
	    	return False;
	    }
	}


}//End Class