<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Video_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // COUNT TOTAL TRAINER 
    function videoCount($table,$like,$type='',$where_or,$like1,$like2,$like3,$like4,$and){
    	$this->db->select('*');
    	$this->db->from($table);
		$this->db->like($like);
		if(!empty($like1)){
		$this->db->or_like($like1);
		}
		if(!empty($like2)){
		$this->db->or_like($like2);
		}
		if(!empty($like3)){
		$this->db->or_like($like3);
		if(!empty($and)){
		$this->db->like($and);
		}
		}
		if(!empty($like4)){
		$this->db->or_like($like4);
		}
		$this->db->group_start();
		$this->db->where($type);
		$this->db->or_where($where_or);
		$this->db->group_end();
		$res = $this->db->get();
		return $res->num_rows();	
    } 
    //END OF FUNCTION
 
    function getAllVideo($table,$limit,$start,$like,$type,$where_or,$like1,$like2,$like3,$like4, $and){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->like($like);
		if(!empty($like1)){
		$this->db->or_like($like1);
		}
		if(!empty($like2)){
		$this->db->or_like($like2);
		}
		if(!empty($like3)){
		$this->db->or_like($like3);
		if(!empty($and)){
		$this->db->like($and);
		}
		
		}
		if(!empty($like4)){
		$this->db->or_like($like4);
		}
		$this->db->group_start();
		$this->db->where($type);
		$this->db->or_where($where_or);
		$this->db->group_end();

		$this->db->order_by('crd','DESC');
		$this->db->limit($limit,$start);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			//lq();
			return $rows ; // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT  FOUND 
		}
	}
	//END OF FUNCTION


	

}//End Class
?>