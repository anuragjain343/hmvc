<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Trainer_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // COUNT TOTAL TRAINER 
    function trainerCount($type){
    	$this->db->select('*')->from(USERS);
		$this->db->where('userRole',$type);
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION
     function trainerCountSearch($type,$search){
    	$this->db->select('*')->from(USERS);
		$this->db->where('userRole',$type);
		$this->db->like($search);
		return  $this->db->get()->num_rows();	
    } 

    // FOR TRAINER RECORD  
    function getAllTrainer($limit,$start,$type){
		$res = $this->db->select('*')->from(USERS);
		$this->db->where('userRole',$type);
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
	    function getAllTrainerSearch($limit,$start,$type,$search){
		$res = $this->db->select('*')->from(USERS);
		$this->db->where('userRole',$type);
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


	// FOR TRAINER RECORD  
    function getAllTrainerJoin($where){
		$this->db->select('*,tm.showTrainer as trainerMetaShow, us.promote as trainerShow,us.id as tId,tm.trainerId as trainerMetaId');
		$this->db->from(USERS.' as us');
		$this->db->join(TRAINERMETA.' as tm','us.id = tm.trainerId','left');
		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->row();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT FOUND 
		}
	}
	//END OF FUNCTION

	// COUNT TOTAL RECEPIE 
function recepieCount($type='',$userId,$catId){
		$this->db->select('*');
		$this->db->from(RECEPIE.' as res');
		$this->db->join(RECEPIE_CATEGORY_MAP.' as rac','res.id = rac.recepieId','left');	
		$this->db->join(RECEPIE_CATEGORY.' as cat','cat.id = rac.categoryId','left');
	if(!empty($userId)){	
		$this->db->where('addedById',$userId);
	}	
	if(!empty($catId)){
		$this->db->where('rac.categoryId',$catId);
	}
	$res = $this->db->get();
	if($res->num_rows()){
		$count = $res->num_rows();
	}else{
		$count = 0;
	}
	return $count;
} 
//END OF FUNCTION

// FOR RECEPIE RECORD 
function getAllRecepie($limit,$start,$categoryId,$userId){
	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
	
		$this->db->select('*,res.id as recepieId,cat.id as catId,rac.id as mapId');
		$this->db->from(RECEPIE.' as res');
		$this->db->join(RECEPIE_CATEGORY_MAP.' as rac','res.id = rac.recepieId','left');	
		$this->db->join(RECEPIE_CATEGORY.' as cat','cat.id = rac.categoryId','left');	
		if(!empty($userId)){
			$this->db->where('addedById',$userId);
		}
		if(!empty($categoryId)){
			$this->db->where('rac.categoryId',$categoryId);
		}
		$this->db->limit($limit,$start);
		$this->db->order_by('res.crd','DESC');
		$res = $this->db->get();
			if($res->num_rows()){
				$result = $res->result();
			return $result;	
			}
			return FALSE;	
}//END OF FUNCTION

function getAllCategory(){
	$this->db->select('*');
	$this->db->from(RECEPIE_CATEGORY);
	$data = $this->db->get();
	if($data->num_rows()>0){
		return $data->result();
	}else{
		return false;
	}

}

// COUNT TOTAL ARTICLE 
    function articleCount($type='',$userId){
    	//pr($userId);
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);
    	}
    	if(!empty($userId)){
		$this->db->where('addedById',$userId);
		}
    	$this->db->select('*')->from(ARTICLE);
		//$this->db->where('userRole',$type);
		if(!empty($userId)){
			$this->db->where('addedById',$userId);
		}
		return  $this->db->get()->num_rows();	
    } 
    //END OF FUNCTION

    // FOR ARTICLE RECORD  
    function getAllArticle($limit,$start,$userId){
    	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    		$this->db->where('addedById',$id);
    	}
		$this->db->select('ar.id,ar.title,ar.description,ar.crd,ar.addedBy,ar.addedById,us.profileImage,us.fullName');
		$this->db->from(ARTICLE.' as ar');
		$this->db->join(USERS.' as us','us.id = ar.addedById','left');
		$this->db->order_by('ar.crd','DESC');
		$this->db->limit($limit,$start);
		if(!empty($userId)){
			$this->db->where('addedById',$userId);
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


}//End Class
?>