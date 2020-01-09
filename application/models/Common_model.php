<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Common Model
 * version: 2.0 (14-08-2018)
 * Common DB queries used in app
 */
class Common_model extends CI_Model {
    
    /* INSERT RECORD FROM SINGLE TABLE */
    function insertData($table, $dataInsert) {
        $this->db->insert($table, $dataInsert);
        return $this->db->insert_id();
    }

    /* UPDATE RECORD FROM SINGLE TABLE */
    function updateFields($table, $data, $where){
        $this->db->update($table, $data, $where);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    /* UPDATE RECORD FROM TABLE */
    function deleteData($table,$where){
        $this->db->where($where);
        $this->db->delete($table); 
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }   
    }
    
    /* GET SINGLE RECORD 
     * Modified in ver 2.0
     */
    function getsingle($table, $where = '', $fld = NULL, $order_by = '', $order = '') {
        if ($fld != NULL) {
            $this->db->select($fld);
        }
        $this->db->limit(1);

        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }
        if ($where != '') {
            $this->db->where($where);
        }

        $q = $this->db->get($table);
        return $q->row();
    }
    
    /* GET MULTIPLE RECORD 
     * Modified in ver 2.0
     */
    function getAll($table, $order_fld = '', $order_type = '', $select = 'all', $limit = '', $offset = '',$group_by='',$where='') {
        $data = array();
        if ($select == 'all') {
            $this->db->select('*');
        } else {
            $this->db->select($select);
        }
        if($group_by !=''){
            $this->db->group_by($group_by);
        }
        $this->db->from($table);

        if ($limit != '' && $offset != '') {
            $this->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->db->limit($limit);
        }
        if ($order_fld != '' && $order_type != '') {
            $this->db->order_by($order_fld, $order_type);
        }
        if ($where != '') {
            $this->db->where($where);
        }
        $q = $this->db->get();
        return $q->result(); //return multiple records
    }
    
    /* get single record using join 
     * Modified in ver 2.0
     */
    function GetSingleJoinRecord($table, $field_first, $tablejointo, $field_second,$field_val='',$where="") {
        $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
        $q = $this->db->get();
        //lq();
        return $q->row();  //return only single record
    }
    function GetSingleJoinRecordLeft($table, $field_first, $tablejointo, $field_second,$field_val='',$where="") {
        $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","left");
        if(!empty($where)){
            $this->db->where($where);
        }
        $q = $this->db->get();
        return $q->row();  //return only single record
    }

    function GetSingleJoinRecord1($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$limit){
      $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
         $this->db->order_by('rand()');
        if(!empty($limit)){
        $this->db->limit($limit);
        }
        $q = $this->db->get();
        return $q->result();  //return only single record   
    }
      function GetSingleJoinRecordlink3($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$limit,$discountLevel3Same,$discountLevel3Other,$discountLevel4Same,$discountLevel4Other,$amt,$link3,$link3other,$link4,$link4other){
      $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
        //$this->db->order_by('rand()');
        if(!empty($limit)){
        $this->db->limit($limit);
        }
        $q = $this->db->get();
        if($q->num_rows()){
          $result = $q->result();
          foreach ($result as $key => $value){
              $value->level= 'Level 3';

                $levl=3;
                $pln = $this->getPlan_List($value->trainerId,$levl);
                $amt1 =$pln->amount;

               $value->price =($amt1)-($amt1)*($discountLevel3Same)/100;  
               $value->coupan =$link3;
               $value->discountData =$discountLevel3Same;
               $value->stripPlanId = $pln->stripPlanId;
               $value->duration = $pln->planDuration;

          }
          return $result;
        } else {
          return false;
        }
        //return $q->result();  //return only single record   
    }

       function GetSingleJoinRecordlink4($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$limit,$discountLevel3Same,$discountLevel3Other,$discountLevel4Same,$discountLevel4Other,$amt,$link3,$link3other,$link4,$link4other){
      $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
        //$this->db->order_by('rand()');
        if(!empty($limit)){
        $this->db->limit($limit);
        }
        $q = $this->db->get();
        if($q->num_rows()){
          $result = $q->result();
          foreach ($result as $key => $value) {
              $value->level= 'Level 4';

                $levl=4;
                $pln = $this->getPlan_List($value->trainerId,$levl);
                $amt1 =$pln->amount;
               $value->price =($amt1)-($amt1)*($discountLevel4Same)/100;
               $value->coupan =$link4;
               $value->discountData =$discountLevel4Same;
              $value->stripPlanId = $pln->stripPlanId;
              $value->duration = $pln->planDuration;
          }
          return $result;
        } else {
          return false;
        }
        //return $q->result();  //return only single record   
    }

    function GetSingleJoinRecordlink3other($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$limit,$discountLevel3Same,$discountLevel3Other,$discountLevel4Same,$discountLevel4Other,$amt,$link3,$link3other,$link4,$link4other){
      $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
        //$this->db->order_by('rand()');
        if(!empty($limit)){
        $this->db->limit($limit);
        }
        $q = $this->db->get();
        if($q->num_rows()){
          $result = $q->result();
          foreach ($result as $key => $value) {
              $value->level= 'Level 3';
          $levl=3;
          $pln = $this->getPlan_List($value->trainerId,$levl);
          $amt1 =$pln->amount;
          $value->priceOther = ($amt1)-($amt1)*($discountLevel3Other)/100;
          $value->coupan =$link3other;
          $value->discountData =$discountLevel3Other;
            $value->stripPlanId = $pln->stripPlanId;
            $value->duration = $pln->planDuration;
              
          }
          return $result;
        } else {
          return false;
        }
        //return $q->result();  //return only single record   
    }

     function GetSingleJoinRecordlink4other($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$limit,$discountLevel3Same,$discountLevel3Other,$discountLevel4Same,$discountLevel4Other,$amt,$link3,$link3other,$link4,$link4other){
      $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
        //$this->db->order_by('rand()');
        if(!empty($limit)){
        $this->db->limit($limit);
        }
        $q = $this->db->get();
        if($q->num_rows()){
          $result = $q->result();
          foreach ($result as $key => $value) {
              $value->level= 'Level 4';

          $levl=4;
          $pln = $this->getPlan_List($value->trainerId,$levl);
          $amt1 =$pln->amount;

              $value->priceOther = ($amt1)-($amt1)*($discountLevel4Other)/100;
               $value->coupan =$link4other;
                $value->discountData =$discountLevel4Other;
                $value->stripPlanId = $pln->stripPlanId;
                $value->duration = $pln->planDuration;
              
          }
          return $result;
        } else {
          return false;
        }
        //return $q->result();  //return only single record   
    }
    
    function getPlan_List($userid,$levl){

        $query = 'SELECT planId,stripPlanId,planLevel,planName,planDuration,description, MIN(amount) as amount,createdBy FROM (select * from plans WHERE status = 1 AND planLevel='.$levl.'  AND createdById="'.$userid.'" order by amount) as t GROUP by planLevel';
        // $this->db->where($cons);    
        $query = $this->db->query($query);
        $result = $query->row();  
        if($result){ 
        return $result;
        }else{
           return  $this->getPlan_List2($levl);
        }     
    }
    
    function getPlan_List2($levl){
        $query = 'SELECT planId,stripPlanId,planLevel,planName,planDuration,description, MIN(amount) as amount,createdBy FROM (select * from plans WHERE status = 1 AND  planLevel='.$levl.' AND  createdById=1 order by amount) as t GROUP by planLevel';
        // $this->db->where($cons);    
        $query = $this->db->query($query);
        $result = $query->row();  
        return $result;     
    }

    function GetSingleJoinRecord3($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$limit,$amt){
      $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
         //$this->db->order_by('rand()');
        if(!empty($limit)){
        $this->db->limit($limit);
        }
    $q = $this->db->get();
    if($q->num_rows()){
      $result = $q->result();
     // pr($result);
      foreach ($result as $key => $value) {
          $value->level= 'Level 3';
          $levl=3;
          $pln = $this->getPlan_List($value->trainerId,$levl);
          $value->price =$pln->amount; 
          $value->stripPlanId = $pln->stripPlanId;
          $value->duration = $pln->planDuration;
          //$value->price= $amt;
      }
      return $result;
    } else {
      return false;
    }
       
    }

    function GetSingleJoinRecord4($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$limit,$amt){
      $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
         //$this->db->order_by('rand()');
        if(!empty($limit)){
        $this->db->limit($limit);
        }
    $q = $this->db->get();
    if($q->num_rows()){
      $result = $q->result();
      foreach ($result as $key => $value) {
          $value->level= 'Level 4';
          //$value->price= $amt;
          $levl=4;
          $pln = $this->getPlan_List($value->trainerId,$levl);
          $value->price =$pln->amount;
          $value->stripPlanId = $pln->stripPlanId;
          $value->duration = $pln->planDuration;
      }
      return $result;
    } else {
      return false;
    }
       
    }

    /* Get mutiple records using join 
     * Modified in ver 2.0
     */ 
    function GetJoinRecord($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$group_by='',$order_fld='',$order_type='', $limit = '', $offset = '') {
       // pr($field_second);
        $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($group_by)){
            $this->db->group_by($group_by);
        }

        if ($limit != '' && $offset != '') {
            $this->db->limit($limit, $offset);
        } else if ($limit != '') {
            $this->db->limit($limit);
        }
        if(!empty($order_fld) && !empty($order_type)){
            $this->db->order_by($order_fld, $order_type);
        }
        $q = $this->db->get();
        return $q->result();
    }
    
    /* Get records joining 3 tables 
     * Modified in ver 2.0
     */
    function GetJoinRecordThree($table, $field_first, $tablejointo, $field_second,$tablejointhree,$field_three,$table_four,$where="") {
      //pr($where);
        $data = array();
        if(!empty($field_val)){
            $this->db->select("$field_val");
        }else{
            $this->db->select("*");
        }
        $this->db->from("$table");
        $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first",'inner');
        $this->db->join("$tablejointhree", "$tablejointhree.$field_three = $table.$field_first",'inner');
       if(!empty($where)){
          $this->db->where($where);
       }

        if(!empty($group_by)){
            $this->db->group_by($group_by);
        }
        
        if(!empty($limit) != '' && !empty($offset) != '') {
            $this->db->limit($limit, $offset);
        } else if (!empty($limit) != '') {
            $this->db->limit($limit);
        }
        
        if(!empty($order_fld) && !empty($order_type)){
            $this->db->order_by($order_fld, $order_type);
        }
        $q = $this->db->get();
       
        return $q->row();
    }

    
    /* Exceute a custom build query by query binding- Useful when we are not able to build queries using CI DB methods
     * Prefreably to be used in SELECT queries
     * The main advantage of building query this way is that the values are automatically escaped which produce safe queries.
     * See example here: https://www.codeigniter.com/userguide3/database/queries.html#query-bindings
     * Modified in ver 2.0
     */
    public function custom_query($myquery, $bind_data=array()){
        $query = $this->db->query($myquery, $bind_data);
        return $query->result();
    }

    /* check if any value exists in and return row if found */
    public function is_id_exist($table,$key,$value){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($key,$value);
        $ret = $this->db->get()->row();
        if(!empty($ret)){
            return $ret;
        }
        else
            return FALSE;
    }
    
    /* Get single value based on table field */
    public function get_field_value($table, $where, $key){ 
        $this->db->select($key);
        $this->db->from($table);
        $this->db->where($where);
        $ret = $this->db->get()->row();
        if(!empty($ret)){
            return $ret->$key;
        }
        else
            return FALSE;
    }
    /* Get total records of any table */
    function get_total_count($table, $where=''){
        $this->db->from($table);
        if(!empty($where))
            $this->db->where($where);
        
        $query = $this->db->get();
        return $query->num_rows(); //total records
    }
    
    /* Check if given data exists in table and return record if exist- Very useful fn
     * Modified in ver 2.0
     */

    function is_data_exists($table, $where){
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
         if($query->num_rows()){
          $rowcount = $query->num_rows();
            if($rowcount==0){
              return FALSE; //record not found
            }
            else{
            return $query->row(); 
            }
          }else{
             return FALSE; 
          } 
    }
 

    function get_total_counts($table, $where){
        $this->db->from($table);
        if(!empty($where))
            $this->db->where($where);
        
        $query = $this->db->get();
        return $query->num_rows(); //total records
    } 

    function get_rendome_user($table,$where,$limit){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by('rand()');
        if(!empty($limit)){
        $this->db->limit($limit);
        }
        $query = $this->db->get();
        return  $query->result(); 
    }

   



    
    function  getDiscount($cop){
        $this->db->select('*');
        $this->db->where('couponId',$cop);
        $q = $this->db->get('coupons');
        return $q->row();
    }

  function GetSingleJoinRecordTrainer($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$or_where="",$limit,$level){
    $data = array();
    if(!empty($field_val)){
        $this->db->select("$field_val");
    }else{
        $this->db->select("*");
    }
    $this->db->from("$table");
    $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
    if(!empty($where)){
        $this->db->where($where);
    }
     if(!empty($or_where)){
        $this->db->or_where($or_where);
    }
         
    if(!empty($limit)){
      $this->db->limit($limit);
    }
    $this->db->order_by('users.crd DESC');
    $q = $this->db->get();
    if($q->num_rows()){
      $result = $q->result();
      if($level==3){
        $showLevel='Level 3';
      }else{
        $showLevel='Level 4';
      }
      foreach ($result as $key => $value) {
          $value->level=$showLevel;
          $levl= $level;
          $pln = $this->getPlan_List($value->trainerId,$levl);
          //pr($pln);
          if(!empty($pln->amount)){
          $value->price =$pln->amount;
          $value->stripPlanId = $pln->stripPlanId;
          $value->duration = $pln->planDuration;
          $value->description = $pln->description;
          }else{
            return false;
          } 
             
      }
      return $result;
    } else {
      return false;
    }   
  }
   function GetSingleJoinRecordTrainer_link($table, $field_first, $tablejointo, $field_second,$field_val='',$where="",$or_where="",$limit,$level,$discountLevel3Same,$stripCouponId3Same){
   
    $data = array();
    if(!empty($field_val)){
        $this->db->select("$field_val");
    }else{
        $this->db->select("*");
    }
    $this->db->from("$table");
    $this->db->join("$tablejointo", "$tablejointo.$field_second = $table.$field_first","inner");
    if(!empty($where)){
        $this->db->where($where);
    }
     if(!empty($or_where)){
        $this->db->or_where($or_where);
    }
         
    if(!empty($limit)){
      $this->db->limit($limit);
    }
      $this->db->order_by('users.crd DESC');
    $q = $this->db->get();
    if($q->num_rows()){
      $result = $q->result();
      if($level==3){
        $showLevel='Level 3';
         $level1=$level;
      }else{
        $showLevel='Level 4';
      }
      foreach ($result as $key => $value) {
          $value->level=$showLevel;
          $levl= $level;
          $pln = $this->getPlan_List($value->trainerId,$levl);
       
          if(!empty($pln->amount)){
          $value->price =($pln->amount-($pln->amount*$discountLevel3Same)/100); 
          $value->stripPlanId = $pln->stripPlanId;
          $value->duration = $pln->planDuration; 
          $value->description = $pln->description; 

          }else{
           return false;
          } 
          $value->discountData =$discountLevel3Same;
          $value->coupan =$stripCouponId3Same;  
      }
      return $result;
    } else {
      return false;
    }   
  }

  
} //end of class
/* Do not close php tags */
/* IMP: Do not add any new method in this file */