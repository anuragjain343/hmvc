<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Video_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // COUNT TOTAL TRAINER 
    function videoCount($type){
    	$this->db->select('*')->from(INFORMATIONALVIDEO);
    	if(!empty($type)){
			$this->db->where($type);
		}
		return  $this->db->get()->num_rows();	
    } 
     function videoCountSearch($type,$search){
    	$this->db->select('*')->from(INFORMATIONALVIDEO);
    	if(!empty($type)){
			$this->db->where($type);
			
		}
		$this->db->like($search);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION
       // COUNT TOTAL TRAINER 
    function trainingVideoCount($type){
    	$this->db->select('*')->from(TRAININGVIDEO);
    	if(!empty($type)){
			$this->db->where($type);
		}
		return  $this->db->get()->num_rows();	
    } 

     function trainingVideoCountSearch($type,$search){
    	$this->db->select('*')->from(TRAININGVIDEO);
    	if(!empty($type)){
			$this->db->where($type);
		}
		$this->db->like($search);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION
    

    // FOR TRAINER RECORD  
    function getAllTrainingVideo($limit,$start,$type){
		$res = $this->db->select('*')->from(TRAININGVIDEO);
		if(!empty($type)){
			$this->db->where($type);
		}
		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	  function getAllTrainingVideoSearch($limit,$start,$type,$search){
		$res = $this->db->select('*')->from(TRAININGVIDEO);
		if(!empty($type)){
			$this->db->where($type);
		}
		$this->db->like($search);
		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION
	
    // FOR TRAINER RECORD  
    function getAllVideo($limit,$start,$type){
		$res = $this->db->select('*')->from(INFORMATIONALVIDEO);
		if(!empty($type)){
			$this->db->where($type);
		}
		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	 function getAllVideoSearch($limit,$start,$type,$search){
		$res = $this->db->select('*')->from(INFORMATIONALVIDEO);
		if(!empty($type)){
			$this->db->where($type);
		}
		$this->db->like($search);
		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION


}//End Class
?>