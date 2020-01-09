<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function userCount($where,$where2,$where3,$where4,$where5){
    	//pr($where4);
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','left');
		
		if(empty($where3)){
		$this->db->group_start();
		$this->db->where($where);
		$this->db->or_where($where2);
		$this->db->group_end();
		}
		if(!empty($where3)){
			$this->db->group_start();
				$this->db->where($where3);
			$this->db->group_end();
		if(!empty($where4)){
			$this->db->group_start();	
			$this->db->where($where4);
			$this->db->or_where($where5);
			$this->db->group_end();

		}else{
			$this->db->where($where);
		}
		
		}
		

		$res = $this->db->get();
//lq();
		if($res->num_rows()){
			
			return $res->num_rows(); // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT FOUND 
		}
	}

    function userCount1($where1,$where2,$where3,$where4,$where5,$where6,$where9){
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','left');
		
		if(!empty($where1)){
		$this->db->group_start();
		$this->db->where($where1);
		$this->db->or_where($where2);
		$this->db->group_end();
		}else if(!empty($where3)){
			$this->db->group_start();
				$this->db->where($where3);
			$this->db->group_end();
		}	
		else if(!empty($where4)){
			$this->db->group_start();	
			$this->db->where($where4);
			
			$this->db->or_where($where5);
			$this->db->group_end();
		}else{
			$this->db->where($where6);
			
		}
		
		//}
		if(!empty($where9)){
			$this->db->where($where9);
		}

		$condi = array('commissionTrainerId!='=> 0);
		$this->db->where($condi);
		$res = $this->db->get();
  		//lq();
		if($res->num_rows()){	
			return $res->num_rows(); // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT FOUND 
		}
	}
	   function userCountA($where1,$where2,$where3,$where4,$where5,$where6,$where9){
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','right');
		
		if(!empty($where1)){
		$this->db->group_start();
		$this->db->where($where1);
		$this->db->group_end();

		}
		
		if(!empty($where9)){
			$this->db->where($where9);
		}

		$res = $this->db->get();
  	
		if($res->num_rows()){	
			return $res->num_rows(); // TRAINER RECORD FOUND 
		}else{
			return false; // TRAINER RECORD NOT FOUND 
		}
	}


	
	function getAllUser($limit,$start,$type,$type2,$type3,$type4,$type5){
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','left');
		$this->db->limit($limit,$start);
		
		if(empty($type3)){
		$this->db->group_start();
		$this->db->where($type);
		$this->db->or_where($type2);
		$this->db->group_end();
		}
		if(!empty($type3)){
		$this->db->group_start();
			$this->db->where($type3);
		$this->db->group_end();

		if(!empty($type4)){
		$this->db->group_start();	
			$this->db->where($type4);
			$this->db->or_where($type5);
		$this->db->group_end();
		}else{
			$this->db->where($type5);
		}
		}
		$res = $this->db->get();
		//lq();
		$rows = array();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as $key => $value1){
				$rows[$key]->userLevel = $this->getLevel(array('amount'=>floatval($value1->amount))); 	
			}
			$rows[$key]->totalComm = $this->getTrainerComm($type,$type2);
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}

	function getAllUser1($limit,$start,$type1,$type2,$type3,$type4,$type5,$type6,$type7,$type8,$type9){
		//pr($type9);
	$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','left');
		$this->db->limit($limit,$start);
		if(!empty($type1)){

		$this->db->group_start();
		$this->db->where($type1);
		$this->db->or_where($type2);
		$this->db->group_end();

		}else if(!empty($type3)){
		
			$this->db->where($type3);
		
		}else if(!empty($type4)){
			//pr('4');
		$this->db->group_start();	
			$this->db->where($type4);
			$this->db->or_where($type5);
		$this->db->group_end();
		}else{
			$this->db->where($type6);
		}

		if(!empty($type9)){
			$this->db->where($type9);
		}
		$condi = array('commissionTrainerId!='=> 0);
		$this->db->where($condi);
		
		$res = $this->db->get();
		//lq();
		$rows = array();
		if($res->num_rows() > 0){
			$rows = $res->result();
			
			foreach ($rows as $key => $value1){
				$rows[$key]->userLevel = $this->getLevel(array('amount'=>floatval($value1->amount))); 	
			}
			$rows[$key]->totalComm = $this->getTrainerComm($type7,$type8);
			//$rows[$key]->totalComm = 0;
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}
	function getAllUserA($limit,$start,$type1,$type2,$type3,$type4,$type5,$type6,$type7,$type8,$type9){
		//pr($type9);
	$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','right');
		$this->db->limit($limit,$start);
		if(!empty($type1)){
		$this->db->group_start();
		$this->db->where($type1);
		$this->db->group_end();
		}

		if(!empty($type9)){
			$this->db->where($type9);
		}
		
		$res = $this->db->get();
		$rows = array();
		if($res->num_rows() > 0){
			$rows = $res->result();
			foreach ($rows as $key => $value1){
			if(empty($value1->commissionTrainerId)){
				$rows[$key]->trainerLink = 'NA'; 
			}else{
				$rows[$key]->trainerLink = $this->getuser(array('id'=>$value1->commissionTrainerId)); 	
			}
			if(empty($value1->trainerId)){

				$rows[$key]->trainerSelect = 'NA'; 
			}else{
				$rows[$key]->trainerSelect = $this->getuser(array('id'=>$value1->trainerId)); 	
			}	
			}
			$rows[$key]->totalComm = $this->getTrainerCommAll();
			$rows[$key]->totalDiscount = $this->getTrainerDisAll();
		
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}

	function getTrainerComm($type,$type2){
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','left');
		//$this->db->limit($limit,$start);
		$this->db->where($type);
		$this->db->or_where($type2);
		$res = $this->db->get();
		$rows = array();
		if($res->num_rows() > 0){
			$rows = $res->result();
			$totalcom=0;
			foreach ($rows as $key => $value1) {	
			$totalcom = $totalcom+$value1->trainerCommission;

			}
			return $totalcom ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}
		function getTrainerCommAll(){
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','right');
		//$this->db->limit($limit,$start);
		$this->db->where('userRole','user');
		//$this->db->or_where($type2);
		$res = $this->db->get();
		$rows = array();
		if($res->num_rows() > 0){
			$rows = $res->result();
			$totalcom=0;
			foreach ($rows as $key => $value1) {	
			 $totalcom = $totalcom+$value1->trainerCommission;

			}
			return $totalcom ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}
		function getTrainerDisAll(){
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','right');
		//$this->db->limit($limit,$start);
		$this->db->where('userRole','user');
		//$this->db->or_where($type2);
		$res = $this->db->get();
		$rows = array();
		if($res->num_rows() > 0){
			$rows = $res->result();
			$totaldiscount=0;
			foreach ($rows as $key => $value1) {	
			 $totaldiscount = $totaldiscount+$value1->couponDiscount;

			}
			return $totaldiscount ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}

	function getLevel($valu){
		$this->db->select('planLevel');
		$this->db->from('plans');
		$this->db->where($valu);
		$res = $this->db->get();
		if($res->num_rows() > 0){
		   $rows = $res->row();
		   if($rows->planLevel==2){
		   	return 2;
		   }else if($rows->planLevel==3){
		   	return 3;
		   }else if($rows->planLevel==4){
		   	return 4;
		   }else{
		   	return 1;
		   }
		}
		else{
		return false; // USERS RECORD NOT  FOUND 
		}
	}

	function getuser($valu){
		
		$this->db->select('fullName');
		$this->db->from('users');
		$this->db->where($valu);
		$res = $this->db->get();
		if($res->num_rows() > 0){
		    $rows = $res->row();
		   return $name = $rows->fullName;
		}
		else{
		return false; // USERS RECORD NOT  FOUND 
		}
	}

	function getAllUserRep($type){
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','left');
		//$this->db->limit($limit,$start);
		$this->db->where($type);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}
 

	function getAllUserRep1($type,$where){
	
		$this->db->select('*,pm.amount as amt, pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(USERS.' as us');
		$this->db->join(PAYMENT.' as pm','us.id = pm.userId','left');
		$this->db->where($type);
		$this->db->where($where);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}

	 function getAllcomm($where){
	 	$trnid=$where;
	 	$myquery="SELECT  sum(`pm`.`trainerCommission`),
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 1    THEN  `pm`.`trainerCommission` ELSE 0 END) 'jn',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 2    THEN  `pm`.`trainerCommission` ELSE 0 END) 'fb',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 3    THEN  `pm`.`trainerCommission` ELSE 0 END) 'mr',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 4    THEN  `pm`.`trainerCommission` ELSE 0 END) 'ap',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 5    THEN  `pm`.`trainerCommission` ELSE 0 END) 'my',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 6    THEN  `pm`.`trainerCommission` ELSE 0 END) 'ju',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 7    THEN  `pm`.`trainerCommission` ELSE 0 END) 'jl',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 8    THEN  `pm`.`trainerCommission` ELSE 0 END) 'au',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 9    THEN  `pm`.`trainerCommission` ELSE 0 END) 'sp',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 10   THEN  `pm`.`trainerCommission` ELSE 0 END) 'ot',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 11   THEN  `pm`.`trainerCommission` ELSE 0 END) 'no',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 12   THEN  `pm`.`trainerCommission` ELSE 0 END) 'de',
       COUNT(*) as `Total`
  		FROM `payment`AS `pm`
  		WHERE `pm`.`crd` BETWEEN '2019-01-01'  AND '2019-12-31' AND  `pm`.`commissionTrainerId`=$trnid";

	 	 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
	 }

	  function getAllDis($where){
	 	$trnid=$where;
	 	$myquery="SELECT  sum(`pm`.`couponDiscount`),
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 1    THEN  `pm`.`couponDiscount` ELSE 0 END) 'jn',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 2    THEN  `pm`.`couponDiscount` ELSE 0 END) 'fb',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 3    THEN  `pm`.`couponDiscount` ELSE 0 END) 'mr',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 4    THEN  `pm`.`couponDiscount` ELSE 0 END) 'ap',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 5    THEN  `pm`.`couponDiscount` ELSE 0 END) 'my',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 6    THEN  `pm`.`couponDiscount` ELSE 0 END) 'ju',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 7    THEN  `pm`.`couponDiscount` ELSE 0 END) 'jl',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 8    THEN  `pm`.`couponDiscount` ELSE 0 END) 'au',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 9    THEN  `pm`.`couponDiscount` ELSE 0 END) 'sp',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 10   THEN  `pm`.`couponDiscount` ELSE 0 END) 'ot',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 11   THEN  `pm`.`couponDiscount` ELSE 0 END) 'no',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 12   THEN  `pm`.`couponDiscount` ELSE 0 END) 'de',
       COUNT(*) as `Total`
  		FROM `payment`AS `pm`
  		WHERE `pm`.`crd` BETWEEN '2019-01-01'  AND '2019-12-31' AND  `pm`.`commissionTrainerId`=$trnid";

	 	 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
	 }

function getAllWeekDis($where){
	 	$trnid=$where;
	 	$current_date  =  date('Y-m-d');
        
        $previus_date =     date('Y-m-d', strtotime('-6 day', strtotime($current_date)));
    $where = array('date(`pm`.`crd`) <='=>$current_date,'date(`pm`.`crd`) >='=>$previus_date);
	 	$myquery="


SELECT SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Monday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'mo',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Tuesday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'tu',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Wednesday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'we',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Thursday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'th',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Friday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'fr',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Saturday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'st',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Sunday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'su',
DAYNAME(`pm`.`crd`) FROM payment as `pm` WHERE `pm`.`commissionTrainerId`=$trnid AND date(`pm`.`crd`) <= '$current_date' AND date(`pm`.`crd`) >='$previus_date' ";
 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
}



function getAllWeekComm($where){
	 	$trnid=$where;
	 	$current_date  =  date('Y-m-d');
        
        $previus_date =     date('Y-m-d', strtotime('-6 day', strtotime($current_date)));
    $where = array('date(`pm`.`crd`) <='=>$current_date,'date(`pm`.`crd`) >='=>$previus_date);
	 	$myquery="
	 SELECT SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Monday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'mo',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Tuesday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'tu',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Wednesday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'we',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Thursday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'th',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Friday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'fr',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Saturday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'st',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Sunday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'su',
DAYNAME(`pm`.`crd`) FROM payment as `pm` WHERE  `pm`.`commissionTrainerId`=$trnid AND date(`pm`.`crd`) <= '$current_date' AND date(`pm`.`crd`) >='$previus_date' ";
 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
}
 
 function getAllYearComm($where){
	 	$trnid=$where;
	 	$myquery="
SELECT SUM(CASE WHEN YEAR(`pm`.`crd`) = '2013' THEN  `pm`.`trainerCommission` ELSE 0 END) 'mo',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2014' THEN  `pm`.`trainerCommission` ELSE 0 END) 'tu',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2015' THEN  `pm`.`trainerCommission` ELSE 0 END) 'we',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2016' THEN  `pm`.`trainerCommission` ELSE 0 END) 'th',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2017' THEN  `pm`.`trainerCommission` ELSE 0 END) 'fr',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2018' THEN  `pm`.`trainerCommission` ELSE 0 END) 'st',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2019' THEN  `pm`.`trainerCommission` ELSE 0 END) 'su',
YEAR(`pm`.`crd`) FROM payment as `pm` WHERE `pm`.`commissionTrainerId`=$trnid";
 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
}

 function getAllYearDis($where){
	 	$trnid=$where;
	 	$myquery="
SELECT SUM(CASE WHEN YEAR(`pm`.`crd`) = '2013' THEN  `pm`.`couponDiscount` ELSE 0 END) 'mo',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2014' THEN   `pm`.`couponDiscount` ELSE 0 END) 'tu',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2015' THEN  `pm`.`couponDiscount` ELSE 0 END) 'we',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2016' THEN  `pm`.`couponDiscount` ELSE 0 END) 'th',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2017' THEN  `pm`.`couponDiscount` ELSE 0 END) 'fr',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2018' THEN  `pm`.`couponDiscount` ELSE 0 END) 'st',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2019' THEN  `pm`.`couponDiscount` ELSE 0 END) 'su',
YEAR(`pm`.`crd`) FROM payment as `pm` WHERE `pm`.`commissionTrainerId`=$trnid";
 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
}

	 function getAllUserByDay($type){
		$where =  '`pm.crd` > DATE_SUB(CURDATE(), INTERVAL 7 DAY)';
		$this->db->select('pm.couponDiscount as dis,pm.trainerCommission as comm');
		$this->db->from(PAYMENT.' as pm');
		$this->db->where($where);
		$this->db->where($type);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->result();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}

	
	function getTotalUser1(){
		
	$myquery="
	SELECT(CASE WHEN `pm`.`PlanLevel` = 0 THEN  COUNT(`pm`.`userId`) ELSE 0 END) 'free',
		(CASE WHEN `pm`.`PlanLevel` = '1' THEN  COUNT(`pm`.`userId`) ELSE 0 END) 'level1',
		(CASE WHEN `pm`.`PlanLevel` = '2' THEN COUNT(`pm`.`userId`) ELSE 0 END) 'level2',
		(CASE WHEN `pm`.`PlanLevel` = '3' THEN  COUNT(`pm`.`userId`) ELSE 0 END) 'level3',
		(CASE WHEN `pm`.`PlanLevel` = '4' THEN  COUNT(`pm`.`userId`) ELSE 0 END) 'level4'
		FROM payment as `pm`";
		$query = $this->db->query($myquery, $bind_data='');
		return $query->row();
	}

	function getTotaluser(){

  $myquery = "SELECT
	(SELECT count(`pm0`.`PlanLevel`) FROM `payment` as `pm0` WHERE `pm0`.`PlanLevel`='5' GROUP BY `pm0`.`PlanLevel`) AS `free`,

	(SELECT count(`pm1`.`PlanLevel`) FROM `payment` as `pm1` WHERE `pm1`.`PlanLevel`='1' GROUP BY `pm1`.`PlanLevel`) AS `level1`,

	(SELECT count(`pm2`.`PlanLevel`) FROM `payment` as `pm2` WHERE `pm2`.`PlanLevel`='2' GROUP BY `pm2`.`PlanLevel`) AS `level2`,

	(SELECT count(`pm3`.`PlanLevel`) FROM `payment` as `pm3` WHERE `pm3`.`PlanLevel`='3' GROUP BY `pm3`.`PlanLevel`) AS `level3`,

	(SELECT count(`pm4`.`PlanLevel`) FROM `payment` as `pm4` WHERE `pm4`.`PlanLevel`='4' GROUP BY `pm4`.`PlanLevel`) AS `level4`

	FROM payment as `pm` GROUP BY `free`,`level1`,`level2`,`level3`,`level4`";
	$query = $this->db->query($myquery, $bind_data='');
		return $query->row();

	}


	function todayAllUserDiscountComm(){
		 //$type =  DATE(`pm`.`crd`) = CURDATE();
		 $where1 = 'DATE(`pm`.`crd`) = CURDATE()';
		$this->db->select('sum(pm.couponDiscount) as totaldis,sum(pm.trainerCommission) as totalCom');
		$this->db->from(PAYMENT.' as pm');
		$this->db->where($where1);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->row();
			//lq();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}


	function weekAllUserDiscountComm(){
		 //$type =  DATE(`pm`.`crd`) = CURDATE();
		 $where1 =  '`pm.crd` > DATE_SUB(CURDATE(), INTERVAL 7 DAY)';
		$this->db->select('sum(pm.couponDiscount) as totaldisw,sum(pm.trainerCommission) as totalComw');
		$this->db->from(PAYMENT.' as pm');
		$this->db->where($where1);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->row();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}


	function monthAllUserDiscountComm(){
	   //$type =  DATE(`pm`.`crd`) = CURDATE();
		$where1  =  '`pm.crd` > DATE_SUB(CURDATE(), INTERVAL 30 DAY)';
		$this->db->select('sum(pm.couponDiscount) as totaldism,sum(pm.trainerCommission) as totalComm');
		$this->db->from(PAYMENT.' as pm');
		$this->db->where($where1);
		$res = $this->db->get();
		if($res->num_rows() > 0){
			$rows = $res->row();
			return $rows ; // USERS RECORD FOUND 
		}else{
			return false; // USERS RECORD NOT  FOUND 
		}
	}


	 function getAllcomm1(){
	 	
	 	$myquery="SELECT  sum(`pm`.`trainerCommission`),
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 1    THEN  `pm`.`trainerCommission` ELSE 0 END) 'jn',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 2    THEN  `pm`.`trainerCommission` ELSE 0 END) 'fb',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 3    THEN  `pm`.`trainerCommission` ELSE 0 END) 'mr',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 4    THEN  `pm`.`trainerCommission` ELSE 0 END) 'ap',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 5    THEN  `pm`.`trainerCommission` ELSE 0 END) 'my',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 6    THEN  `pm`.`trainerCommission` ELSE 0 END) 'ju',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 7    THEN  `pm`.`trainerCommission` ELSE 0 END) 'jl',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 8    THEN  `pm`.`trainerCommission` ELSE 0 END) 'au',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 9    THEN  `pm`.`trainerCommission` ELSE 0 END) 'sp',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 10   THEN  `pm`.`trainerCommission` ELSE 0 END) 'ot',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 11   THEN  `pm`.`trainerCommission` ELSE 0 END) 'no',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 12   THEN  `pm`.`trainerCommission` ELSE 0 END) 'de',
       COUNT(*) as `Total`
  		FROM `payment`AS `pm`
  		WHERE `pm`.`crd` BETWEEN '2019-01-01'  AND '2019-12-31'";

	 	 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
	 }

	  function getAllDis1(){
	 	
	 	$myquery="SELECT  sum(`pm`.`couponDiscount`),
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 1    THEN  `pm`.`couponDiscount` ELSE 0 END) 'jn',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 2    THEN  `pm`.`couponDiscount` ELSE 0 END) 'fb',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 3    THEN  `pm`.`couponDiscount` ELSE 0 END) 'mr',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 4    THEN  `pm`.`couponDiscount` ELSE 0 END) 'ap',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 5    THEN  `pm`.`couponDiscount` ELSE 0 END) 'my',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 6    THEN  `pm`.`couponDiscount` ELSE 0 END) 'ju',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 7    THEN  `pm`.`couponDiscount` ELSE 0 END) 'jl',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 8    THEN  `pm`.`couponDiscount` ELSE 0 END) 'au',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 9    THEN  `pm`.`couponDiscount` ELSE 0 END) 'sp',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 10   THEN  `pm`.`couponDiscount` ELSE 0 END) 'ot',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 11   THEN  `pm`.`couponDiscount` ELSE 0 END) 'no',
       SUM(CASE WHEN MONTH(`pm`.`crd`) = 12   THEN  `pm`.`couponDiscount` ELSE 0 END) 'de',
       COUNT(*) as `Total`
  		FROM `payment`AS `pm`
  		WHERE `pm`.`crd` BETWEEN '2019-01-01'  AND '2019-12-31' ";

	 	 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
	 }

function getAllWeekDis1(){
	 
	 	$current_date  =  date('Y-m-d');
        
        $previus_date =     date('Y-m-d', strtotime('-6 day', strtotime($current_date)));
    $where = array('date(`pm`.`crd`) <='=>$current_date,'date(`pm`.`crd`) >='=>$previus_date);
	 	$myquery="


SELECT SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Monday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'mo',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Tuesday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'tu',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Wednesday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'we',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Thursday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'th',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Friday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'fr',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Saturday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'st',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Sunday' THEN  `pm`.`couponDiscount` ELSE 0 END) 'su',
DAYNAME(`pm`.`crd`) FROM payment as `pm` WHERE  date(`pm`.`crd`) <= '$current_date' AND date(`pm`.`crd`) >='$previus_date' ";
 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
}



function getAllWeekComm1(){
	 
	 	$current_date  =  date('Y-m-d');
        
        $previus_date =     date('Y-m-d', strtotime('-6 day', strtotime($current_date)));
    $where = array('date(`pm`.`crd`) <='=>$current_date,'date(`pm`.`crd`) >='=>$previus_date);
	 	$myquery="
	 SELECT SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Monday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'mo',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Tuesday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'tu',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Wednesday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'we',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Thursday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'th',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Friday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'fr',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Saturday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'st',
SUM(CASE WHEN DAYNAME(`pm`.`crd`) = 'Sunday' THEN  `pm`.`trainerCommission` ELSE 0 END) 'su',
DAYNAME(`pm`.`crd`) FROM payment as `pm` WHERE  date(`pm`.`crd`) <= '$current_date' AND date(`pm`.`crd`) >='$previus_date' ";
 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
}
 
 function getAllYearComm1(){
	 	
	 	$myquery="
SELECT SUM(CASE WHEN YEAR(`pm`.`crd`) = '2013' THEN  `pm`.`trainerCommission` ELSE 0 END) 'mo',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2014' THEN  `pm`.`trainerCommission` ELSE 0 END) 'tu',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2015' THEN  `pm`.`trainerCommission` ELSE 0 END) 'we',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2016' THEN  `pm`.`trainerCommission` ELSE 0 END) 'th',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2017' THEN  `pm`.`trainerCommission` ELSE 0 END) 'fr',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2018' THEN  `pm`.`trainerCommission` ELSE 0 END) 'st',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2019' THEN  `pm`.`trainerCommission` ELSE 0 END) 'su',
YEAR(`pm`.`crd`) FROM payment as `pm` ";
 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
}

 function getAllYearDis1(){
	 	
	 	$myquery="
SELECT SUM(CASE WHEN YEAR(`pm`.`crd`) = '2013' THEN  `pm`.`couponDiscount` ELSE 0 END) 'mo',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2014' THEN   `pm`.`couponDiscount` ELSE 0 END) 'tu',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2015' THEN  `pm`.`couponDiscount` ELSE 0 END) 'we',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2016' THEN  `pm`.`couponDiscount` ELSE 0 END) 'th',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2017' THEN  `pm`.`couponDiscount` ELSE 0 END) 'fr',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2018' THEN  `pm`.`couponDiscount` ELSE 0 END) 'st',
SUM(CASE WHEN YEAR(`pm`.`crd`) = '2019' THEN  `pm`.`couponDiscount` ELSE 0 END) 'su',
YEAR(`pm`.`crd`) FROM payment as `pm`";
 $query = $this->db->query($myquery, $bind_data='');
	 	  return $query->row();
}

}//End Class
?>
