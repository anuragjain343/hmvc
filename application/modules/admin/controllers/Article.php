<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends Common_Back_Controller {

    public $data = "";

  function __construct() {
    parent::__construct();
    $this->load->model('Article_model');
    $this->load->model('Notification_model');
    $this->load->library('Ajax_pagination');
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 

  }

  //INDEX FUNCTION TO LOAD FOURM LIST VIEW
  public function index(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "TrainerArticleList";
    }else{
      $data['title']  = "AdminArticleList";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $type=0;
    $data['total_article']  = $this->Article_model->articleCount($type);
    $this->load->admin_render('article',$data,''); 
  }
  //END OF FUNCTION

  // ADD FORUM VIEW LOAD
  function addArticle(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "trainerAddArticle";
    }else{
      $data['title']  = "AdminAddArticle";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
  
     if(!empty($_GET['id'])){
        $id = decoding($_GET['id']);
        $where = array('id'=>$id);
        $is_data_exists['data'] = $this->common_model->is_data_exists(ARTICLE,$where);
        //pr($is_data_exists['data']);
       $this->load->admin_render('editDraft',$is_data_exists,''); 
     }else{
    $this->load->admin_render('addArticle',$data,''); 
    }
  }
  //END OF FUNCTION


  //ADD ARTICLE 
  function add_article_v1(){
    //pr($_POST);
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('description', 'Description','trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $articlupd = $this->input->post('upd_articlearticle');
    $title =  trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $where = array('id'=>$articlupd);
  // if(empty($articlupd)){

     $where2 =array('title'=>$title);
     $check2 = $this->common_model->is_data_exists(ARTICLE,$where2);

    if(!empty($check2)){
      $res['status'] = 0;
      $res['msg'] = 'Title already exits';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();
    }

   // }

    $check = $this->common_model->is_data_exists(ARTICLE,$where);
    if($check){
        $data['articleStatus'] = 1;
        $res['url']           = base_url().'admin/article';
        $data['upd'] = datetime();
        $response = $this->common_model->updateFields(ARTICLE,$data,$where);
        $res['status'] = 1;
        $res['msg'] = 'Article added successfully.';
        echo json_encode($res); die();
    }else{
      $res['status'] = 0;
      $res['msg'] = 'Somthing went wong';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();
    }
  }
  //END OF FUNCTION

    function add_article(){
    //pr($_POST);
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('description', 'Description','trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $forumupd = $this->input->post('upd_articlearticle');
      //$articlupd = $this->input->post('upd_articlearticle');
   // $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    //if(empty($forumupd)){

    $where2 =array('id!='=>$forumupd,'title'=>$title);
    $check2 = $this->common_model->is_data_exists(ARTICLE,$where2);
    if(!empty($check2)){
      
      $res['status'] = 0;
      $res['msg'] = 'Title already exits';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();

    }

    
    $where =array('id'=>$forumupd,'title'=>$title);
    $check = $this->common_model->is_data_exists(ARTICLE,$where);
  
    //radio
    if($check){

        $data['articleStatus'] = 1;
        $res['url']               = base_url().'admin/article';
        $data['upd']              = datetime();
        $data['isDisableComment'] = $this->input->post('radio');
        //$where1 =array('id'=>$check->id);
        $response                 = $this->common_model->updateFields(ARTICLE,$data,$where);
        $res['status']            = 1;
        $res['msg']               = 'Article added successfully.';
        echo json_encode($res); die();
    }else{

      if(empty($forumupd)){
        $data['title']          = $title;
        $data['description']    = $this->input->post('description');
         //$data['forumStatus']      = 1;
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/article';
      }else{
        $data['addedBy']            = 'admin';
        $data['addedById']          = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']                 = base_url().'admin/article';
      }
        $data['isDisableComment'] = $this->input->post('radio');
        $data['crd'] =    $data['upd'] = datetime();
        $response = $this->common_model->insertData(ARTICLE,$data);
        if($response){
          $res['status'] = 1;
          $res['msg'] = 'Article added successfully.';
         $res['forum_id'] =  $response;
         echo json_encode($res); die();
        }else{
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wong';
          $res['hash']= get_csrf_token()['hash'];
          echo json_encode($res); die();
        }
      }

      $res['status'] = 0;
      $res['msg'] = 'Somthing went wong';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();
    }
  }

  // add article auto save 
   function add_article1(){
    $id= $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $articlupd = $this->input->post('upd_articlearticle');
    if(empty($articlupd)){
    $where =array('title'=> $title,'addedById'=>$id,'articleStatus'=>0);
    }else{
      $where =array('id'=>$articlupd); 
    }
    $check = $this->common_model->is_data_exists(ARTICLE,$where);
    if($check){
      $data['title']          = $title;
      $data['description']    = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['isDisableComment']      = $this->input->post('radio');
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/article';
      }else{
        $data['addedBy']      = 'admin';
        $data['isDisableComment']      = $this->input->post('radio');
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/article';
      }
      $data['crd'] =    $data['upd'] = datetime();
      $response = $this->common_model->updateFields(ARTICLE,$data,$where); 
      echo json_encode($response); die; 
      return false;
    }else{
      $data['title']          = $title;
      $data['description']    = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['isDisableComment']      = $this->input->post('radio');
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/article';
      }else{
        $data['addedBy']            = 'admin';
        $data['isDisableComment']   = $this->input->post('radio');
        $data['addedById']          = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']                 = base_url().'admin/article';
      }
        $data['crd'] =    $data['upd'] = datetime();
        $response = $this->common_model->insertData(ARTICLE,$data);
      if($response){
        $res['status'] = 1;
        $res['msg'] = 'Article added successfully.';
        $res['article_id'] =  $response;
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }
  }
//end if function

  // ARTICLE LIST  AJAX FUNCTION 
  function article_List(){
    $type='0';
    $config['base_url']       = base_url()."admin/article/article_List";
     if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('title'=>$search1,'articleStatus'=>1);
      $config['total_rows']     = $this->Article_model->articleCountSearch($search);
    }else{
    $config['total_rows']     = $this->Article_model->articleCount($type);
    }
    $config['uri_segment']    = 4;
    $config['per_page']       = 6;
    $config['num_links']      = 5;
    $config['first_link']     = FALSE;
    $config['last_link']      = FALSE;
    $config['full_tag_open']  = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link']      = '&raquo;';
    $config['next_tag_open']  = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class']   = '';
    $config['prev_link']      = '&laquo;';
    $config['prev_tag_open']  = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open']   = '<li class="active1"><a>';
    $config['cur_tag_close']  = '</a></li>';
    $config['num_tag_open']   = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('title'=>$search1);
      $data['articleList'] = $this->Article_model->getAllArticleSearch($config['per_page'],$page,$search);
     }else{ 
    $data['articleList'] = $this->Article_model->getAllArticle($config['per_page'],$page);
    }
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_article']= $config['total_rows'];
    $rr= $this->load->view('get_article_list',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));       
  }
  //END OF FUNCTION

  //ARTICLE DETAILS
  function articleDetail(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "TrainerDetail";
    }else{
      $data['title']  = "AdminDetail";
    }
      $this->check_admin_user_session();
      $forumId = decoding($this->uri->segment(4));
      //$data['title']='Article Detail';
      $where= array('ar.id'=>$forumId);
      $data['articleData'] = $this->Article_model->getArticle($where);
      $data['totalLike']= $this->common_model->get_total_count(ARTICLELIKE,array('articleId'=>$forumId));
      $data['totalView']= $this->common_model->get_total_count(ARTICLEVIEW,array('articleId'=>$forumId));
      $this->load->admin_render('articleDetail',$data,''); 
  }
  //END OF FUNCTION


  public function delete_article(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
        $id = $_GET['id'];
        $whereart = array('referenceId'=>$id);
        $article_info  = $this->common_model->getsingle(NOTIFICATIONS,$whereart);
        $table = ARTICLE;
        $where = array('id'=>$id);
        $whereDelete = array('id'=>$id);
        $delete = $this->common_model->deleteData($table,$whereDelete);
        if($delete){
          $title      = "Delete article";
          $body_save  = '[UNAME] is  Deleted article';
          $notif_type = 'delete_article';
          $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
          $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=> $article_info->notificationBy, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
           $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
          $data=array('status'=>1,'message'=>'Deleted successfully','url'=>base_url().'admin/article');
        }else{
          $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
        }  
        echo json_encode($data);
      }else{
        $id = $_GET['id'];
        $where = array('id'=>$id);
        $article_info  = $this->common_model->getsingle(ARTICLE,$where);
        $whereExits    = array('referenceId'=>$id,'notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
        $article_info_exits  = $this->common_model->is_data_exists(NOTIFICATIONS,$whereExits);
        $whereExitsNxt    = array('referenceId'=>$id,'notificationFor'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
        $article_info_exits_again  = $this->common_model->is_data_exists(NOTIFICATIONS,$whereExitsNxt);
        if($article_info_exits_again){
          $deletepriviosReq= $this->common_model->deleteData(NOTIFICATIONS,$whereExitsNxt);
          if($deletepriviosReq){
            $title      = "Delete article";
            $body_save  = '[UNAME] is interested in Delete article';
            $notif_type = 'delete_article';
            $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
            $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=>1, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
             $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
            if($notif_msg){
              $response = array('status' => 1, 'message' => 'Request sent successfully to admin',  'url' => base_url('admin/article')); 
             echo json_encode($response);die();
            }
          }
        }
        if($article_info_exits){
          $response = array('status' => 0, 'message' => 'You already sent Request to admin','url'=>base_url('admin/article')); 
          echo json_encode($response);die();
        }
        if(!empty($article_info)){
          $title      = "Delete article";
          $body_save  = '[UNAME] is interested in Delete article';
          $notif_type = 'delete_article';
          $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
          $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=>1, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
           $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
          if($notif_msg){
            $response = array('status' => 1, 'message' => 'Request sent successfully to admin',  'url' => base_url('admin/article')); 
           echo json_encode($response);die();
          }
        }
      }  
    }
  //END DELETE FUNCTION

  //DELETE ARTICLE BY ADMIN ON LISING PAGE
  public function delete_article_by_admin(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      $id = $_GET['id'];
      $whereart = array('referenceId'=>$id);
      $table = ARTICLE;
      $where = array('id'=>$id);
      $whereDelete = array('id'=>$id);
      $delete = $this->common_model->deleteData($table,$whereDelete);
      if($delete){
        $data=array('status'=>1,'message'=>'Deleted successfully','url'=>base_url().'admin/article');
      }else{
        $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
      }  
      echo json_encode($data);
    }  
  }
  //END OF FUNCTION

//ARTICLE REJECT REQUEST
  public function deleteReject(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      $id = $_GET['id'];
      $whereart = array('referenceId'=>$id);
      $article_info  = $this->common_model->getsingle(NOTIFICATIONS,$whereart);
      if($article_info){
        $title      = "Article delete request rejected by admin";
        $body_save  = '[UNAME] is rejected deleted article';
        $notif_type = 'delete_article';
        $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
        $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=> $article_info->notificationBy, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
         $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
        if($notif_msg){
          $whereDeletereq= array('referenceId'=>$id,'notificationBy'=>$article_info->notificationBy);
          $requtRej= $this->common_model->deleteData(NOTIFICATIONS,$whereDeletereq);
          if($requtRej){
            $data=array('status'=>1,'message'=>'Request rejected successfully','url'=>base_url().'admin/article');
          }
        }  
      }else{
        $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
      }  
      echo json_encode($data);
    }
  }
// END DOF FUNCTION


//EDIT  ARTICLE VIEW LOAD
  function edit_article(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $is_data_exists['title']  = "TrainerEdit";
    }else{
      $is_data_exists['title']  = "AdminEdit";
    }
    $id = decoding($_GET['id']);
    $where = array('id'=>$id);
    $is_data_exists['data'] = $this->common_model->is_data_exists(ARTICLE,$where);
    if(!empty($is_data_exists['data'])){
      $this->load->admin_render('editArticle',$is_data_exists,'');
    }else{
      $this->load->admin_render('addArticle','');
    }   
  }

//END OF FUNCTION 
/*  function update_article(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $is_data_exists['title']  = "TrainerEdit";
    }else{
      $is_data_exists['title']  = "AdminEdit";
    }
    $id = decoding($_GET['id']);
    $where = array('id'=>$id);
    $is_data_exists['data'] = $this->common_model->is_data_exists(ARTICLE,$where);
    if(!empty($is_data_exists['data'])){
      $this->load->admin_render('editDraft',$is_data_exists,'');
    }else{
      $this->load->admin_render('addArticle','');
    }   
  }*/

   //EDIT ARTICLE 
  function editArticle(){
   // pr($_POST);
    $this->check_admin_user_session();
    $articleId = $_POST['artId'];
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('description', 'Description','trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $description = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
    $check=$this->_change_check_unique_email($articleId,$title,'article.title');
    //pr($check);
    if($check==FALSE){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }else{
      $data['title']            = $title;
      $data['description']      = $description;
      $data['isDisableComment'] = $this->input->post('radio');
      $data['crd'] =    $data['upd'] = datetime();
      $wherecondition = array('id'=>decoding($_POST['id']));

      $wherecheck = array('postId'=>$_POST['artId'],'refrenceTable'=>'article');
      $check2 = $this->common_model->is_data_exists('postRevision',$wherecheck);
      if(!empty($check2)){
        $deleteArticle = $this->common_model->deleteData('postRevision',$wherecheck);
       }
        $update = $this->common_model->updateFields(ARTICLE, $data, $wherecondition);
        
      if($update){

        $res['status'] = 1;
        $res['msg'] = 'Article updated successfully.';
        $res['url'] = base_url().'admin/article';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    
    }   
  }
//END OF FUNCTION

 // edit article with revision  
  function editArticle1(){
    
    $this->check_admin_user_session();
    $articleId = $this->input->post('upd_articlearticle');
    //$isexits = $this->input->post('isexits');
   /* if($isexits==1){
        $res['status'] = 3;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];  
        echo json_encode($res);
        return false;
    }
*/  

    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $description = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
    $where =array('postId'=>$articleId,'refrenceTable'=>'article'); 
    $check = $this->common_model->is_data_exists('postRevision',$where);
    if($check){
     /* if($check->postStatus==1){
        $deleteA = $this->common_model->deleteData('postRevision',$where);
        $res['status'] = 1;
        echo json_encode($res);
        return false;
      }*/
      $data['title']           = $title;
      $data['description']     = $description;
      $data['isDisableComment']= $this->input->post('radio');
      $data['upd'] = datetime();
      $where =array('postId'=>$articleId,'refrenceTable'=>'article'); 
      $update = $this->common_model->updateFields('postRevision',$data,$where);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'Article updated successfully.';
        $res['url'] = base_url().'admin/article';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
      return false;
    }else{
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']        ='trainer';
        $data['addedById']      = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }else{
        $data['addedBy']        ='admin';
        $data['addedById']      = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }
      $data['title']            = $title;
      $data['description']      = $description;
      $data['postId']           = $articleId; 
      $data['isDisableComment'] = $this->input->post('radio');
      $data['postStatus']       = 0;
      $data['refrenceTable']    = ARTICLE;
      $data['crd'] =$data['upd'] = datetime();
      $update = $this->common_model->insertData('postRevision',$data);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'Article updated successfully.';
        $res['url'] = base_url().'admin/article';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }   
  }
//end of function

  function _change_check_unique_email($id,$str, $tb_data){
    $tb_arr = explode(".",$tb_data);
    $where = array($tb_arr[1]=>$str);
    $result = $this->common_model->getsingle($tb_arr[0], $where, $fld = NULL, $order_by = '', $order = '');
    if(!empty($result)){
      if($result->id!=$id){  
        $this->form_validation->set_message('_change_check_unique_email','title already exists');
          return FALSE;
      }else{
        return TRUE;
      }
    }
    else{
      return TRUE;
    }     
   }
  //END OF FUNCTION

  function artAns(){
    $limit = 3;
    $is_next = 0;
    $offset = $this->input->post('offset');
    $articleId = $this->input->post('articleId');
    $new_offset     = $limit+$offset;
    $data['limit']  = $limit;
    $data['offset'] = $offset;
    $where                        = array('articleId'=>$articleId);
     $dataView['total_count']     = $this->Article_model->articleAnswerCount($where);
    $dataView['answerList'] = $this->Article_model->getArticleAnswer($limit,$offset,$where);
    $dataView['article_id'] = $articleId;
    if($dataView['total_count']>$new_offset){
        $is_next =1;  
    }
    $btn_html = '';
    if($is_next){
      $id = "btnLoadViewMe1";
      $btn_html   = '<center><div class="form-actions">
      <button type="submit" class="btn btn-primary" id="'.$id.'" data-offset ="'.$new_offset.'" data-isNext ="'.$is_next.'">
        See More
      </button>
     </div></center>';
    }
    //load view with data
    $html_view = $this->load->view('get_article_answer',$dataView,true);
    $response = array('status'=>1,'html_view'=>$html_view,'btn_html'=>$btn_html);
    $no_record=1;
    if(empty($dataView['answerList'])){
        $no_record = 0;
    }
    $response['no_record'] = $no_record;
    $response['hash']= get_csrf_token()['hash'];
     echo json_encode($response);die; 
    }
  //END OF FUNCTION
     //ARTICLE COMMENT BY TRAINER
  function articleAnswer(){
    $this->form_validation->set_rules('answer', 'Answer', 'trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $answer     = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('answer'))));
    $answerBy   = sanitize_input_text($this->input->post('answerBy'));
    $answerById = sanitize_input_text($this->input->post('answerById'));
    $articleId    = sanitize_input_text($this->input->post('articleId'));

    $data['articleId']     =  $articleId;
    $data['answer']      =  $answer; 
    $data['answerBy']    =  $answerBy;
    $data['answerById']  =  $answerById;
    $data['crd'] =    $data['upd'] = datetime();

    $response = $this->common_model->insertData(ARTICLEANSWER,$data);
    if($response){
      $res['status'] = 1;
      $res['msg'] = 'Answer added successfully.';
    }else{
      $res['status'] = 0;
      $res['msg'] = 'Somthing went wong';
      $res['hash']= get_csrf_token()['hash'];
    }
    echo json_encode($res);
  } 
  //END OF FUNCTION 

  //DELETE ARTICLE ANSWER
  function deleteArticleAnswer(){
    $this->check_admin_user_session();
    $answerId = $_GET['answerId'];
    $articleId = encoding($_GET['articleId']);
    $table = ARTICLEANSWER;
    $where = array('id'=>$answerId);
    $Disabled = $this->common_model->deleteData($table,$where);
    if($this->db->affected_rows() > 0){
      $this->load->model('image_model');
      $data=array('status'=>1,'message'=>'Delete comment successfully','url'=>base_url().'admin/article/articleDetail/'.$articleId);
    }else{
      $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
    }
    echo json_encode($data);
  }
  //END OF FUNCTION

  // LOAD VIEW WEHN REQUEST GENERATE THROUGH THE NOTIFICATION 
  function deleteAticle(){  
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      $data['title']  = "TrainerDetail";
      $id = decoding($this->uri->segment(4));
      $where = array('id'=>$id);
      $is_data_exists['data'] = $this->common_model->is_data_exists(ARTICLE,$where);
      if(!empty($is_data_exists['data'])){
        $this->load->admin_render('articleDetailDelete',$is_data_exists,''); 
      }else{
      redirect('admin/article');
    }
    }else{
      redirect('admin/article');
    }
  }
  //END OF FUNCTION

  //ARTICLE LIKE 
    function articleLike(){
      $this->check_admin_user_session();
      $userId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      $articleId = $_GET['id'];
      $where =array('articleId'=>$articleId,'userId'=>$userId);
      $check = $this->common_model->is_data_exists(ARTICLELIKE,$where);
      $whereLikecount = array('articleId'=>$articleId);
      if(!empty($check)){
      $delete = $this->common_model->deleteData(ARTICLELIKE,$where);
      if($delete){
      $totleLike = $this->common_model->get_total_count(ARTICLELIKE,$whereLikecount);
      $res['status'] = 0;
      $res['html'] = $totleLike;
      echo json_encode($res); die();
      }
      }else{
      $data['userId']   =  $userId;
      $data['articleId']  =  $articleId;
      $data['crd']      =  $data['upd'] = datetime();
      $response = $this->common_model->insertData(ARTICLELIKE,$data);
      if($response){
      $totleLike = $this->common_model->get_total_count(ARTICLELIKE,$whereLikecount);
      //pr($totleLike);
      $res['status'] = 1;
      $res['html'] = $totleLike;
      echo json_encode($res); die();
      }
      }
    }
  //END OF FUNCTION

  //ARTICLE ANSWER LIKE
    function articleAnswerLike(){
      $this->check_admin_user_session();
      $userId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      $answerId = $_GET['aId'];
      $articleId = $_GET['artiId'];
      $where =array('articleId'=>$articleId,'answerId'=>$answerId,'userId'=>$userId);
      $check = $this->common_model->is_data_exists(ARTICLEANSWERLIKE,$where);
      $whereLikecount = array('articleId'=>$articleId,'answerId'=>$answerId);
      if(!empty($check)){
      $delete = $this->common_model->deleteData(ARTICLEANSWERLIKE,$where);
      if($delete){
      $totleLike = $this->common_model->get_total_count(ARTICLEANSWERLIKE,$whereLikecount);
      $res['status'] = 0;
      $res['html'] = $totleLike;
      echo json_encode($res); die();
      }
      }else{
      $data['userId']     =  $userId;
      $data['articleId']  =  $articleId;
      $data['answerId']   =  $answerId;
      $data['crd']        =  $data['upd'] = datetime();
      $response = $this->common_model->insertData(ARTICLEANSWERLIKE,$data);
      if($response){
      $totleLike = $this->common_model->get_total_count(ARTICLEANSWERLIKE,$whereLikecount);
      //pr($totleLike);
      $res['status'] = 1;
      $res['html'] = $totleLike;
      echo json_encode($res); die();
      }
      }

    }
  //END OF FUNCTON
    function checkArticleId(){
      if(!empty($_POST['articlearticle'])){
      $articleId = $_POST['articlearticle'];
      $where =array('postId'=>$articleId,'refrenceTable'=>'article');
      $check = $this->common_model->is_data_exists('postRevision',$where);
      if($check){
        $res['status'] = 1;
        echo json_encode($res); die();
      }else{
         $res['status'] = 0;
        echo json_encode($res); die();
      }
      }else{
        $res['status'] = 0;
        echo json_encode($res); die();
      }
    }

    function getRevitionData(){
      if(!empty($_POST['articleId'])){
      $articleId = $_POST['articleId'];
      $where =array('postId'=>$articleId,'refrenceTable'=>'article');
      $check = $this->common_model->is_data_exists('postRevision',$where);

      if($check){
        $res['status']  = 1;
        $res['article'] = $check;
        echo json_encode($res); die();
      }else{
         $res['status'] = 0;
         echo json_encode($res); die();
      }
    }
   }
    function DeleteRevition(){
      if(!empty($_POST['articleId'])){
      $articleId = $_POST['articleId'];
      $where =array('postId'=>$articleId,'refrenceTable'=>'article');
      $delete = $this->common_model->deleteData('postRevision',$where);
      //$delete=1;
      if($delete){
        $res['status']  = 1;
        echo json_encode($res); die();
      }else{
         $res['status'] = 0;
         echo json_encode($res); die();
      }

     }
   }

}
//END OF CLASS
