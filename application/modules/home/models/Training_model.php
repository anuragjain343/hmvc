<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Training_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

function trainingPostCount($where){
		$this->db->select('*')->from(TRAINING);
		$this->db->where($where);
		return  $this->db->get()->num_rows();
	}

	function getTrainingPost($limit,$start,$where){
		$this->db->select('fm.id,fm.title,fm.addedById,fm.addedBy,fm.videoThumb,fm.pdf,fm.categoryId,fm.crd as createdOn,fm.description,fm.crd,fm.id,fm.image,fm.video,us.fullName,us.profileImage');
		$this->db->from(TRAINING.' as fm');
		$this->db->join(USERS.' as us','us.id = fm.addedById','left');
		$this->db->order_by('fm.crd','DESC');
		$this->db->limit($limit,$start);
		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}

}
?>