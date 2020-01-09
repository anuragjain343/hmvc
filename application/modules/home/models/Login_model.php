<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
   // ADMIN AND TRAINER LOGIN
   function isLogin($data,$password,$table,$rem){  
    //login function common 
        $this->db->select("*");
        $this->db->where($data);
        $query = $this->db->get($table);
        if($query->num_rows()>0){
            $user = $query->row();
            $id = $user->id;
            if($user->status==1){
            if(password_verify($password, $user->password)){
                $this->session_create($id);
                 if(!empty($rem)){
                    $this->isLoginRememberMe($id);
                }

                return 'login';
            }
            else{
                return FALSE; 
            }
        }else{
            return 'inactive';

        }
        }
       return FALSE;
    }
    //END OF FUNCTION..
    function isLoginUserInactive($data,$password,$table){
        $this->db->select("*");
        $this->db->where($data);
        $query = $this->db->get($table);
        if($query->num_rows()>0){
            $user = $query->row();
            return TRUE;
            
        }
       return FALSE;
    }

    // Create sesion for checking user login or not
    function session_create($id){
        $sql = $this->db->select('*')->where(array('id'=>$id))->get(USERS);
        if($sql->num_rows()){
            $user= $sql->row();
            $session_data['userId'] = $user->id ;
            $session_data['emailId'] = $user->email;
            $session_data['name'] = $user->fullName;
            $session_data['image'] = $user->profileImage;
            $session_data['UserRole'] = $user->userRole;
            $session_data['userPlan'] = $user->userPlan;
            $session_data['isLogin'] = TRUE;
            $_SESSION[USER_SESS_KEY] = $session_data;
            return TRUE;
        }
        return false; 
    }//ENdFunction 315360000

    function isLoginRememberMe($id){
        $cookie_name    = 'mvt_remember_me_token';
        $random_token   = generate_random_token();
        $token_value    = generate_auth_token($random_token);
        $cookie_value  = $token_value;
        $domain = '/';
        setcookie($cookie_name, $cookie_value, time() + (86400 * 14), $domain); 
        //setcookie($cookie_name, $cookie_value, time() + (10*365 *24 *60 *60), $domain);
        $token_hash = password_hash($random_token, PASSWORD_DEFAULT);
        $arra = explode(':',$token_value);
        $dataIns['selector']        = $arra[0];
        $dataIns['hashedValidator'] = $token_hash;
        $dataIns['user_id']         = $id;
        $rememberm = $this->common_model->insertData('auth_token',$dataIns); 
    }


}