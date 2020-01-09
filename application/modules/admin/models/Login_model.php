<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
   // ADMIN AND TRAINER LOGIN
   function isLogin($data,$password,$table){  
    //login function common 
        $this->db->select("*");
        $this->db->group_start();
        $this->db->where($data);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where('userRole','admin');
        $this->db->or_where('userRole','trainer');
        $this->db->group_end();
        $query = $this->db->get($table);
        if($query->num_rows()>0){
            $user = $query->row();
            $id = $user->id;
            if(password_verify($password, $user->password)){
                $this->session_create($id);
                return TRUE;
            }
            else{
                return FALSE; 
            }
        }
       return FALSE;
    }
    //END OF FUNCTION..

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
            $session_data['allPrivileges'] = $user->allPrivileges;
            $session_data['isLogin'] = TRUE;
            $_SESSION[ADMIN_USER_SESS_KEY] = $session_data;
            return TRUE;  
        }
        return false; 
    }//ENdFunction

}