<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exercise_instrunction_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // COUNT TOTAL TRAINER 
    function exerciseCount($type){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
            $this->db->where('addedById',$id);
        }
        if(!empty($type)){
    		$this->db->where('categoryId',$type);
    	}
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	$this->db->select('*')->from(TRAINING);
		//$this->db->where('userRole',$type);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION

    // FOR TRAINER RECORD  
    function getAllExercise($limit,$start,$categoryId){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);
    	}
		$this->db->select('t.id,t.title,t.description,t.crd,t.addedBy,t.addedById,us.profileImage,us.fullName');
		$this->db->from(TRAINING.' as t');
        $this->db->join(USERS.' as us','us.id = t.addedById','left');
		$this->db->join(TRAINING_CATEGORY.' as tc','tc.id = t.categoryId','left');
		$this->db->order_by('t.crd','DESC');
		$this->db->limit($limit,$start);
        if(!empty($categoryId)){
            $this->db->where('categoryId',$categoryId);
        }
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION
//get data for deatail page
    function getTraining($where){
        $this->db->select('t.id,t.title,t.description,t.pdf,t.image,t.video,t.videoThumb,t.categoryId,t.crd,t.addedBy,t.addedById,us.profileImage,us.fullName');
        $this->db->from(TRAINING.' as t');
        $this->db->join(USERS.' as us','us.id = t.addedById','left');
        $this->db->join(TRAINING_CATEGORY.' as tc','tc.id = t.categoryId','left');
        $this->db->order_by('t.crd','DESC');
        $this->db->where($where);
        $res = $this->db->get();
        if($res->num_rows() > 0){
            $rows = $res->row();
            return $rows ; // TRAINER RECORD FOUND 
        }else{
            return false; // TRAINER RECORD NOT  FOUND 
        }
    }
}
