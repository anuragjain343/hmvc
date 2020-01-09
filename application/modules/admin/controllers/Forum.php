<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Forum extends Common_Back_Controller {

    public $data = "";

  function __construct() {
    parent::__construct();
    $this->load->model('image_model');
    $this->load->model('Forum_model');
    $this->load->library('Ajax_pagination');
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 
  }

  //INDEX FUNCTION TO LOAD FOURM LIST VIEW
  public function index(){
  $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
    $data['title']  = "Forum List";
    }else{
       $data['title']  = "TrainerForumList";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $data['total_fourm']= $this->common_model->get_total_count(FOURM);
    $type=0;
    $data['total_rows']     = $this->Forum_model->forumCount($type);
    $this->load->admin_render('forum',$data,''); 
  }
  //END OF FUNCTION

  // ADD FORUM VIEW LOAD
  function addforumff(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
    $data['title']  = "Add Fourm";
    }else{
     $data['title']  = "Trainer Add Fourm";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('addForum',$data,''); 
  }

  function addforum(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "Add Fourm";
    }else{
    $data['title']  = "Trainer Add Fourm";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
  
     if(!empty($_GET['id'])){
        $id = decoding($_GET['id']);
        $where = array('id'=>$id);
        $is_data_exists['data'] = $this->common_model->is_data_exists(FOURM,$where);
        //pr($is_data_exists['data']);
       $this->load->admin_render('editForumDraft',$is_data_exists,''); 
     }else{
    $this->load->admin_render('addForum',$data,''); 
    }
  }


  //END OF FUNCTION

  //ADD FORUM 
  /*function add_forum(){
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('description', 'Description','trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $title = sanitize_input_text($this->input->post('title'));
    $where =array('title'=>$title);
    $check = $this->common_model->is_data_exists(FOURM,$where);
    if($check){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }else{
      $data['title']          = sanitize_input_text($this->input->post('title'));
      $data['description']    = sanitize_input_text($this->input->post('description'));
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/forum';
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/forum';
      }
      $data['crd'] =    $data['upd'] = datetime();
      $response = $this->common_model->insertData(FOURM,$data);
      if($response){
        $res['status'] = 1;
        $res['msg'] = 'Fourm added successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }
  }*/
  //END OF FUNCTION

   //ADD ARTICLE 
/*  function add_forum(){
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
    $forumupd = $this->input->post('frm');
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    //if(empty($forumupd)){

    $where2 =array('id!='=>$forumupd,'title'=>$title);
    $check2 = $this->common_model->is_data_exists(FOURM,$where2);
    if(!empty($check2)){
      
      $res['status'] = 0;
      $res['msg'] = 'Title already exits';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();

    }

    
    $where =array('id'=>$forumupd,'title'=>$title);
    $check = $this->common_model->is_data_exists(FOURM,$where);
  
    //radio
    if($check){

        $data['forumStatus']      = 1;
        $res['url']               = base_url().'admin/forum';
        $data['upd']              = datetime();
        $data['isDisableComment'] = $this->input->post('radio');
        //$where1 =array('id'=>$check->id);
        $response                 = $this->common_model->updateFields(FOURM,$data,$where);
        $res['status']            = 1;
        $res['msg']               = 'Forum added successfully.';
        echo json_encode($res); die();
    }else{

      if(empty($forumupd)){
        $data['title']          = $title;
        $data['description']    = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
         //$data['forumStatus']      = 1;
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/forum';
      }else{
        $data['addedBy']            = 'admin';
        $data['addedById']          = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']                 = base_url().'admin/forum';
      }
        $data['isDisableComment'] = $this->input->post('radio');
        $data['crd'] =    $data['upd'] = datetime();
        $response = $this->common_model->insertData(FOURM,$data);
        if($response){
          $res['status'] = 1;
          $res['msg'] = 'Forum added successfully.';
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
  }*/
  //END OF FUNCTION
     function add_forum(){
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
    $forumupd = $this->input->post('frm');
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    //if(empty($forumupd)){

    $where2 =array('id!='=>$forumupd,'title'=>$title,'forumStatus'=>1);
    $check2 = $this->common_model->is_data_exists(FOURM,$where2);
    if(!empty($check2)){
      
      $res['status'] = 0;
      $res['msg'] = 'Title already exits';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();

    }

    
    $where =array('id'=>$forumupd,'title'=>$title);
    $check = $this->common_model->is_data_exists(FOURM,$where);
  
    //radio
    if($check){

        $data['forumStatus']      = 1;
        $res['url']               = base_url().'admin/forum';
        $data['upd']              = datetime();
        $data['isDisableComment'] = $this->input->post('radio');
        //$where1 =array('id'=>$check->id);
        $response                 = $this->common_model->updateFields(FOURM,$data,$where);
        $res['status']            = 1;
        $res['msg']               = 'Forum added successfully.';
        echo json_encode($res); die();
    }else{

      if(empty($forumupd)){
        $data['title']          = $title;
        $data['description']    = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
         $data['forumStatus']      = 1;
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/forum';
      }else{
        $data['addedBy']            = 'admin';
        $data['addedById']          = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']                 = base_url().'admin/forum';
      }
        $data['isDisableComment'] = $this->input->post('radio');
        $data['crd'] =    $data['upd'] = datetime();
        $response = $this->common_model->insertData(FOURM,$data);
        if($response){
          $res['status'] = 1;
          $res['msg'] = 'Forum added successfully.';
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

   // add forum auto save 
   function add_forumAutoSave(){
    $id= $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $forumupd = $this->input->post('upd_forum');
    if(empty($forumupd)){
    $where =array('title'=> $title,'addedById'=>$id,'forumStatus'=>0);
    }else{
      $where =array('id'=>$forumupd); 
    }
    $check = $this->common_model->is_data_exists(FOURM,$where);
    //pr($check);

    if($check){

     /*   $res['status'] = 0;
        $res['msg'] = 'Title Already exits';
        $res['hash']= get_csrf_token()['hash'];
        echo json_encode($res);die();*/

      $data['title']          = $title;
      $data['description']    = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/article';
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/forum';
      }
      $data['crd'] =    $data['upd'] = datetime();
      $response = $this->common_model->updateFields(FOURM,$data,$where); 
      echo json_encode($response); die; 
      return false;
    }else{
      $data['title']          = $title;
      $data['description']    = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/forum';
      }else{
        $data['addedBy']            = 'admin';
        $data['addedById']          = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']                 = base_url().'admin/forum';
      }
        $data['crd'] =    $data['upd'] = datetime();
        $response = $this->common_model->insertData(FOURM,$data);
      if($response){
        $res['status'] = 1;
        $res['msg'] = 'Forum added successfully.';
        $res['forum_id'] =  $response;
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }
  }
//end if function

  // FOURM LIST  AJAX FUNCTION 
  function forum_List(){
    $type='0';
    $config['base_url']       = base_url()."admin/forum/forum_List";
    
    if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('title'=>$search1);
      $config['total_rows']     = $this->Forum_model->forumCountSearch($search);
    }else{
    $config['total_rows']     = $this->Forum_model->forumCount($type);
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
    $config['paginate_call'] = 'ajax_fun';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('title'=>$search1); 
     $data['forumList'] = $this->Forum_model->getAllForumSearch($config['per_page'],$page,$search);  
    }else{
    $data['forumList'] = $this->Forum_model->getAllForum($config['per_page'],$page);
    }  
                  
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_fourm']= $config['total_rows'];
    $rr= $this->load->view('get_Forum_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));       
  }
  //END OF FUNCTION
  
  //FORUM DETAIL
   function forumDetail(){
       $this->check_admin_user_session();
      $forumId = decoding($this->uri->segment(4));
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      $data['title']='Forum Details';
      }else{
      $data['title']='Trainer Forum Details';
      }
      $where= array('fm.id'=>$forumId);
      $data['forumData'] = $this->Forum_model->getForum($where);
      //pr($data['forumData'] );
      $this->load->admin_render('forumDetail',$data,''); 
   }
  //END OF FUNCTION

  //FORUM ANSWER BY TRAINER
  function forumAnswer(){
    $this->form_validation->set_rules('answer', 'Answer', 'trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }

    $answer     = sanitize_input_text($this->input->post('answer'));
    $answerBy   = sanitize_input_text($this->input->post('answerBy'));
    $answerById = sanitize_input_text($this->input->post('answerById'));
    $forumId    = sanitize_input_text($this->input->post('forumId'));

    $data['forumId']     =  $forumId;
    $data['answer']      =  $answer; 
    $data['answerBy']    =  $answerBy;
    $data['answerById']  =  $answerById;
    $data['crd'] =    $data['upd'] = datetime();

    $response = $this->common_model->insertData(FOURMANSWER,$data);
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

   // FOURM LIST  AJAX FUNCTION LOAD MORE
    function ansList2(){
        //$this->load->model('home_model');
        $limit = 3;
        $is_next = 0;
        $offset = $this->input->post('offset');
        $forumId = $this->input->post('forumId');
        
        $new_offset     = $limit+$offset;
        $data['limit']  = $limit;
        $data['offset'] = $offset;
        $where                        = array('forumId'=>$forumId);
         $dataView['total_count']     = $this->Forum_model->forumAnswerCount($where);
        $dataView['answerList'] = $this->Forum_model->getForumAnswer($limit,$offset,$where);
        $dataView['forum_id'] = $forumId;
  
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
        $html_view = $this->load->view('get_forum_answer',$dataView,true);

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

    function delete_comment(){
      $this->check_admin_user_session();
      //$forumId = decoding($this->uri->segment(5));
      $answerId = $_GET['answerId'];
      // pr($answerId);
      $forumId = encoding($_GET['forumId']);
      $table = FOURMANSWER;
      $where = array('id'=>$answerId);
      $Disabled = $this->common_model->deleteData($table,$where);

      if($this->db->affected_rows() > 0){
        $this->load->model('image_model');
        $data=array('status'=>1,'message'=>'Delete comment successfully','url'=>base_url().'admin/forum/forumDetail/'.$forumId);
      }else{
        $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
      }

        echo json_encode($data);
    }

    public function delete_forum(){
      $this->check_admin_user_session();
      $id = $_GET['id'];
      $table = FOURM;
      $where = array('id'=>$id);
      $whereDelete = array('id'=>$id);
      $delete = $this->common_model->deleteData($table,$whereDelete);

      if($this->db->affected_rows() > 0){
        $this->load->model('image_model');
        $data=array('status'=>1,'message'=>'Deleted successfully','url'=>base_url().'admin/forum');
      }else{
        $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
     
      }  

        echo json_encode($data);
    }//END DELETE FUNCTION

    function edit_forum(){
      $this->check_admin_user_session();

      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $is_data_exists['title']  = "TrainerEdit";
      }else{
        $is_data_exists['title']  = "AdminEdit";
      }
      $id = decoding($_GET['id']);

      // $id = $_GET['id'];
      $where = array('id'=>$id);
      $is_data_exists['data'] = $this->common_model->is_data_exists(FOURM,$where);
      if(!empty($is_data_exists['data'])){
        $this->load->admin_render('editForum',$is_data_exists,'');
      }else{
        $this->load->admin_render('addforum','');
      }
        
    }

    function editForum_v1(){
      $this->check_admin_user_session();
      $forumId = $_POST['fId'];
      //pr($articleId);
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
      $check=$this->_change_check_unique_email($forumId,$title,'forum.title');
      if($check==FALSE){
        $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die; 
        return false;
      }else{
        $data['title']          = $title;
        $data['description']    = $description;
        $data['crd'] =    $data['upd'] = datetime();
        $wherecondition = array('id'=>$_POST['fId']);
        $update = $this->common_model->updateFields(FOURM, $data, $wherecondition);
        if($update){
          $res['status'] = 1;
          $res['msg'] = 'Forum updated successfully.';
          $res['url'] = base_url().'admin/forum';
        }else{
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wong';
          $res['hash']= get_csrf_token()['hash'];
        }
        echo json_encode($res);
      }   
    }

    function editForum(){
      //pr($_POST);
    $this->check_admin_user_session();
     $forumId = $_POST['fId'];
    //$articleId = $_POST['artId'];
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
    $check=$this->_change_check_unique_email($forumId,$title,'forum.title');
    //pr($check);
    if($check==FALSE){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }else{
     // pr($title);
      $data['title']            = $title;
      $data['description']      = $description;
      $data['isDisableComment'] = $this->input->post('radio');
      $data['crd'] =    $data['upd'] = datetime();
      $wherecondition = array('id'=>$_POST['fId']);
      $wherecheck = array('postId'=>$_POST['fId'],'refrenceTable'=>'forum');
      $check2 = $this->common_model->is_data_exists('postRevision',$wherecheck);
     // pr($check2);
      if(!empty($check2)){
        $deleteArticle = $this->common_model->deleteData('postRevision',$wherecheck);
      }
        $update = $this->common_model->updateFields(FOURM, $data, $wherecondition);
        //$update=true;
      if($update){

        $res['status'] = 1;
        $res['msg'] = 'Forum updated successfully.';
        $res['url'] = base_url().'admin/forum';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    
    }   
  }




    function editForumRevision(){
    //pr($_POST);
    $this->check_admin_user_session();
    $articleId = $this->input->post('upd_articlearticle');
    $isexits = $this->input->post('isexits');
    if($isexits==1){
        $res['status'] = 3;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];  
        echo json_encode($res);
        return false;
    }
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $description = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
    $where =array('postId'=>$articleId,'refrenceTable'=>'forum'); 
    $check = $this->common_model->is_data_exists('postRevision',$where);
    if($check){

      /*if($check->postStatus==1){
        $deleteA = $this->common_model->deleteData('postRevision',$where);
        $res['status'] = 1;
        echo json_encode($res);
        return false;
      }*/
      $data['title']           = $title;
      $data['description']     = $description;
      $data['upd'] = datetime();
      $data['crd'] = $check->crd;
      $where =array('postId'=>$articleId,'refrenceTable'=>'forum'); 
      $update = $this->common_model->updateFields('postRevision',$data,$where);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'Forum updated successfully.';
        $res['url'] = base_url().'admin/forum';
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
      //$data['isDisableComment'] = $this->input->post('radio');
      $data['postStatus']       = 0;
      $data['refrenceTable']    = 'forum';
      $data['crd'] =$data['upd'] = datetime();
      $update = $this->common_model->insertData('postRevision',$data);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'Forum updated successfully.';
        $res['url'] = base_url().'admin/forum';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }   
    }

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
      }//END OF FUNCTION


  function answerLike(){
    $this->check_admin_user_session();
    $userId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];

    $ansId = $_GET['id'];
    $where =array('answerId'=>$ansId,'userId'=>$userId);
    $check = $this->common_model->is_data_exists(ANSWERLIKE,$where);
    // $whereLikecount = array('id'=>$ansId);
      $whereis =array('answerId'=>$ansId);
    if(!empty($check)){
     $delete = $this->common_model->deleteData(ANSWERLIKE,$where);
     if($delete){
      $like = $this->common_model->get_total_count(ANSWERLIKE,$whereis);
      $res['html'] = '<span id="pasteLike">'.$like.'  Likes</span>';
      $res['status'] = 0;
      //$res['likeCount'] = $totleLike;
      echo json_encode($res); die();
     }
    }else{
      $data['userId']   =  $userId;
      $data['answerId']  =  $ansId;
      $data['crd']      =  $data['upd'] = datetime();
      $response = $this->common_model->insertData(ANSWERLIKE,$data);
      if($response){
        $like = $this->common_model->get_total_count(ANSWERLIKE,$whereis);
        $res['html'] = '<span id="pasteLike">'.$like.'  Likes</span>';
        $res['status'] = 1;
       // $res['likeCount'] = $totleLike;
        echo json_encode($res); die();
      }
    }
   }

  function forumLike(){
    $this->check_admin_user_session();
    $userId = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    $forumId = $_GET['id'];
    $where =array('forumId'=>$forumId,'userId'=>$userId);
    $check = $this->common_model->is_data_exists(FOURMLIKE,$where);
     $whereLikecount = array('id'=>$forumId);
    if(!empty($check)){
     $delete = $this->common_model->deleteData(FOURMLIKE,$where);
     if($delete){
      $totleLike = $this->common_model->get_total_count(FOURMLIKE,$whereLikecount);
      $whereis =array('fm.id'=>$forumId);
      $like = $this->Forum_model->getForum($whereis)->totalLike;
      //pr($like);

      $wherecount = array('forumId'=>$forumId,'userId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $currentusercount = $this->common_model->get_total_count(FOURMLIKE,$wherecount);
      //lq();

      $res['html'] = '<span id="likeCount"> '.$like.'

                    Likes</span>';
      $res['status'] = 0;
      $res['likeCount'] = $totleLike;
      echo json_encode($res); die();
     }
    }else{
      $data['userId']   =  $userId;
      $data['forumId']  =  $forumId;
      $data['crd']      =  $data['upd'] = datetime();
      $response = $this->common_model->insertData(FOURMLIKE,$data);
      if($response){
        $totleLike = $this->common_model->get_total_count(FOURMLIKE,$whereLikecount);
        $whereis =array('fm.id'=>$forumId);
        $like = $this->Forum_model->getForum($whereis)->totalLike;
        //pr($like);
        $wherecount = array('forumId'=>$forumId,'userId'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
        $currentusercount = $this->common_model->get_total_count(FOURMLIKE,$wherecount);
        $res['html'] = '<span id="likeCount"> '.$like.'

                    Likes</span>';
      
        $res['status'] = 1;
        $res['likeCount'] = $totleLike;
        echo json_encode($res); die();
      }
    }
   }

//END OF FUNCTON
    function checkForumId(){
      if(!empty($_POST['articlearticle'])){
      $articleId = $_POST['articlearticle'];
      $where =array('postId'=>$articleId,'refrenceTable'=>'forum');
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'forum');
      $check = $this->common_model->is_data_exists('postRevision',$where);
      //pr($check);
      if(!empty($check)){
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'forum');
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

}//END OF CLASS
