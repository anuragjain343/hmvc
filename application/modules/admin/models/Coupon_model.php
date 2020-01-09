<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coupon_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

 function chekCoupon($name){
 	
 	$where = array();
    
    $where['couponName'] = $name;
    $where['status'] = 1;
 	
 	$check = $this->db->select('couponId')->get_where('coupons',$where)->row();
    if(empty($check)){
     return 1;


    }
    return 0;

 }

}//End Class
?>
