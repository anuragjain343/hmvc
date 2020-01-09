<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recepie_model extends CI_Model {

function __construct()
{
// Call the Model constructor
parent::__construct();
}

// COUNT TOTAL TRAINER 
function recepieCount($type='',$recepie_id){

	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
		$this->db->select('*');
		$this->db->from(RECEPIE.' as res');
		$this->db->join(RECEPIE_CATEGORY_MAP.' as rac','res.id = rac.recepieId','left');	
		$this->db->join(RECEPIE_CATEGORY.' as cat','cat.id = rac.categoryId','left');	
	if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole'] == 'trainer'){
		$this->db->where('addedById',$id);
	}
	if(!empty($recepie_id)){
		$this->db->where('res.categoryId',$recepie_id);
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

// FOR TRAINER RECORD 
function getAllRecepie($limit,$start,$categoryId){
	$id = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
	
		$this->db->select('*,res.id as recepieId,cat.id as catId,rac.id as mapId');
		$this->db->from(RECEPIE.' as res');
		$this->db->join(RECEPIE_CATEGORY_MAP.' as rac','res.id = rac.recepieId','left');	
		$this->db->join(RECEPIE_CATEGORY.' as cat','cat.id = rac.categoryId','left');	
		if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
			$this->db->where('addedById',$id);
		}
		if(!empty($categoryId)){
			$this->db->where('res.categoryId',$categoryId);
		}
		$this->db->limit($limit,$start);
		$this->db->order_by('res.crd','DESC');
		$res = $this->db->get();
			if($res->num_rows()){
				$result = $res->result();
			return $result;	
			}
			return FALSE;
}
//END OF FUNCTION
// FOR TRAINER RECORD 
function getRecepie($where){
	$this->db->select('* ,us.id as userId,r.id as rId,r.crd as created');
	$this->db->from(RECEPIE.' as r');
	$this->db->join(USERS.' as us','us.id = r.addedById','left');

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
		return false; // TRAINER RECORD NOT FOUND 
	}
}
//END OF FUNCTION

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

	function getRecepieLike($id){
		$this->db->select('*')->from(RECEPIELIKE);
		$this->db->where('recepieId',$id);
		return  $this->db->get()->num_rows();
	}


}//End Class
?>