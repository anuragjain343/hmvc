<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Membership_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


 function getPlanList(){
    
   $query = 'SELECT planId,stripPlanId,planLevel,planName,planDuration,description, MIN(amount) as amount,createdBy FROM (select * from plans WHERE status = 1 order by amount) as t GROUP by planLevel';    
   $query = $this->db->query($query);
   $result = $query->result();  
   return $result;
    
       
     
 }

 function getPlanListByLevel($cons){
    
   $query = 'SELECT planId,stripPlanId,planLevel,planName,planDuration,description, MIN(amount) as amount,createdBy FROM (select * from plans WHERE status = 1 order by amount) as t GROUP by planLevel'; 
   $this->db->where($cons);    
   $query = $this->db->query($query);
   $result = $query->result();  
   return $result;
    
       
     
 }


 function getPlanList2($cons){
    
   $query = 'SELECT planId,stripPlanId,planLevel,planName,planDuration,description, MIN(amount) as amount,createdBy FROM (select * from plans WHERE status = 1 AND planLevel= "'.$cons.'" order by amount) as t GROUP by planLevel';
  // $this->db->where($cons);    
   $query = $this->db->query($query);
   $result = $query->row();  
   return $result;
           
 }

}//End Class
?>
