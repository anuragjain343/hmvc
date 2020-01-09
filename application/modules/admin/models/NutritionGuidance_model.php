<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NutritionGuidance_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // COUNT TOTAL TRAINER 
    function nutritionGuidanceCount($type=''){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);
    	}else{
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	}
    	$this->db->select('*')->from(NURRITIONGUIDANCE);
		$this->db->where($type);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION


    // COUNT TOTAL TRAINER by perticule trainer 
    function articleCountTrainer($type='',$id){
    	$this->db->select('*')->from(NURRITIONGUIDANCE);
		$this->db->where('addedById',$id);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION

    // FOR TRAINER RECORD  
    function getAllnutritionGuidance($limit,$start,$type){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);
    	}else{
    		$this->db->where('addedById',$id);
    	}
		$this->db->select('ar.id,ar.title,ar.description,ar.crd,ar.addedBy,ar.addedById,us.profileImage,us.fullName');
		$this->db->from(NURRITIONGUIDANCE.' as ar');
		$this->db->where($type);
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		$this->db->order_by('ar.crd','DESC');
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
        function getDetails($where){
        $this->db->select('t.id,t.title,t.description,t.pdf,t.image,t.video,t.videoThumb,t.categoryId,t.crd,t.addedBy,t.addedById,us.profileImage,us.fullName');
        $this->db->from(NURRITIONGUIDANCE.' as t');
        $this->db->join(USERS.' as us','us.id = t.addedById','left');
        $this->db->join(NURRITIONGUIDANCECATEGORY.' as tc','tc.id = t.categoryId','left');
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

 
		


	

	

}//End Class
?>