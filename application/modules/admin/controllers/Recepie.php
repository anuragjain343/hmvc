<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Recepie extends Common_Back_Controller {

    public $data = "";

  function __construct() {
    parent::__construct();
    $this->load->model('Recepie_model');
    $this->load->library('Ajax_pagination');
    $this->load->model('image_model'); 
    $this->load->model('Media_upload_model'); 
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 

  }
  //INDEX FUNCTION TO LOAD FOURM LIST VIEW
  public function index(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "TrainerRecepieList";
    }else{
      $data['title']  = "AdminRecepieList";
    }
    //$data['title']  = "Article";
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);

   $data['total_recepie']= $this->common_model->get_total_count(RECEPIE);

    $this->load->admin_render('recepie',$data,''); 

  }

    // ADD RECEPIE VIEW LOAD
  function addRecepie(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "trainerAddRecepie";
    }else{
      $data['title']  = "AdminAddRecepie";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $data['category']  = $this->common_model->getAll(RECEPIE_CATEGORY);
    if(!empty($_GET['id'])){
      $id = decoding($_GET['id']);
      $where = array('id'=>$id);
      $data['result'] = $this->common_model->is_data_exists(RECEPIE,$where);
      //pr($data['result']);
      $this->load->admin_render('editDraftRecepie',$data,'');
    }else{

    $this->load->admin_render('addRecepie',$data,''); 
    }
  }
  //END OF FUNCTION

   // RECEPIE LIST  AJAX FUNCTION 
  function recepie_List(){
    $type='0';
    $config['base_url']       = base_url()."admin/recepie/recepie_List";
    $config['total_rows']     = !empty($_GET['id'])?$this->Recepie_model->recepieCount($type,$_GET['id']):$this->Recepie_model->recepieCount($type,$pe='');
    //pr( $config['total_rows'] );
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

    $data=array();


    if(!empty($_GET['id'])){
      $respcat= $_GET['id'];
      $data['recepieList'] = $this->Recepie_model->getAllRecepie($config['per_page'],$page,$respcat);
    }else{
      $respcat='0';
      $data['recepieList'] = $this->Recepie_model->getAllRecepie($config['per_page'],$page,$respcat);
      
    }
    $this->ajax_pagination->initialize($config);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_recepie']= $config['total_rows'];
    $data['category']= $this->Recepie_model->getAllCategory();
    $rr= $this->load->view('get_recepie_list',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash'],'categoryId'=>$respcat));       
  }
  //END OF FUNCTION

  function add_recepie3(){
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('category_name', 'category name', 'trim|required');
    $this->form_validation->set_rules('description', 'Description','trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $title =  sanitize_input_text($this->input->post('title'));
    $strng = trim(preg_replace('/\s+/',' ', $title));

    $where =array('title'=>$strng);
    $check = $this->common_model->is_data_exists(RECEPIE,$where);
    if($check){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }else{
      if(!empty($_FILES['recepie_image']['name'])){   
          $imageName      = 'recepie_image';
          $folder         =  "recepie";
          $response_image = $this->image_model->upload_image($imageName,$folder);
          if(!empty($response_image['error'])){
            $response = array('status' =>'-1', 'msg' =>$response_image['error'],'hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
          }
          $data['image'] =   $response_image;
      }

      if(!empty($_FILES['file']['name'])){   
        $video = 'file';
        $folder =  "video_recepie";
        $response_video = $this->Media_upload_model->upload_video($video, $folder );
        if(!empty($response_video['error'])){
          $response = array('status' =>FAIL, 'msg' =>$response_video['error'],'hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die;
        }
        $data['video'] =   $response_video;
      }

      if(!empty($_FILES['videoThumb']['name'])){
        $_FILES['videoThumb']['name'] = 'vthumb.png';
        $folder = 'recepie_video_thumb'; //Set folder for upload profile image 
        $result = $this->image_model->upload_image('videoThumb', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
        }else{
          $data['videoThumb'] = $result;
        } 
      }
      $data['title']          = $strng;
      $data['categoryId']     = sanitize_input_text($this->input->post('category_name'));
      $disp = trim(preg_replace('/\s+/',' ', $this->input->post('description')));
      $data['description']    = strip_tags(sanitize_input_text($disp));
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/recepie';
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/recepie';
      }
      $data['crd'] =    $data['upd'] = datetime();
      $responseRecepie = $this->common_model->insertData(RECEPIE,$data);
      $map['categoryId'] = sanitize_input_text($this->input->post('category_name'));
      $map['recepieId'] = $responseRecepie;
      $response = $this->common_model->insertData(RECEPIE_CATEGORY_MAP,$map);

      if($responseRecepie){
        $res['status'] = 1;
        $res['msg'] = 'Recipes added successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }
  }
  //END OF FUNCTION
    function add_recepie_v1(){
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('category_name', 'category name', 'trim|required');
    $this->form_validation->set_rules('description', 'Description','trim|required');

    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    
    $articlupd = $this->input->post('upd_articlearticle');
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));

    $where2 =array('title'=>$title);
    $check2 = $this->common_model->is_data_exists(RECEPIE,$where2);
    if(!empty($check2)){
      $res['status'] = 0;
      $res['msg'] = 'Title already exits';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();
    }

    $where =array('id'=>$articlupd);
    $check = $this->common_model->is_data_exists(RECEPIE,$where);

    

     if(!empty($_FILES['recepie_image']['name'])){   
          $imageName      = 'recepie_image';
          $folder         =  "recepie";
          $response_image = $this->image_model->upload_image($imageName,$folder);
          if(!empty($response_image['error'])){
            $response = array('status' =>'-1', 'msg' =>$response_image['error'],'hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
          }
          $data['image'] =   $response_image;
      }
      if(!empty($_FILES['file']['name'])){   
        $video = 'file';
        $folder =  "video_recepie";
        $response_video = $this->Media_upload_model->upload_video($video, $folder );
        if(!empty($response_video['error'])){
          $response = array('status' =>FAIL, 'msg' =>$response_video['error'],'hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die;
        }
        $data['video'] =   $response_video;
      }

      if(!empty($_FILES['videoThumb']['name'])){
        $_FILES['videoThumb']['name'] = 'vthumb.png';
        $folder = 'recepie_video_thumb'; //Set folder for upload profile image 
        $result = $this->image_model->upload_image('videoThumb', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
        }else{
          $data['videoThumb'] = $result;
        } 
      }

    if($check){

        $data['recepieStatus'] = 1;
        $res['url']           = base_url().'admin/recepie';
        $data['upd'] = datetime();
        $response = $this->common_model->updateFields(RECEPIE,$data,$where);
        $res['status'] = 1;
        $res['msg'] = 'Recepie added successfully.';
        echo json_encode($res); die();
    }else{
      $res['status'] = 0;
      $res['msg'] = 'Somting went wrong.';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();
    }
  }

  function add_recepie(){
    //pr($_POST);
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('category_name', 'category name', 'trim|required');
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
    $check2 = $this->common_model->is_data_exists(RECEPIE,$where2);

    if(!empty($check2)){

      $res['status'] = 0;
      $res['msg'] = 'Title already exits';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res); die();
    }

    
    $where =array('id'=>$forumupd,'title'=>$title);
    $check = $this->common_model->is_data_exists(RECEPIE,$where);

     if(!empty($_FILES['recepie_image']['name'])){   
          $imageName      = 'recepie_image';
          $folder         =  "recepie";
          $response_image = $this->image_model->upload_image($imageName,$folder);
          if(!empty($response_image['error'])){
            $response = array('status' =>'-1', 'msg' =>$response_image['error'],'hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
          }
          $data['image'] =   $response_image;
      }
      if(!empty($_FILES['file']['name'])){   
        $video = 'file';
        $folder =  "video_recepie";
        $response_video = $this->Media_upload_model->upload_video($video, $folder );
        if(!empty($response_video['error'])){
          $response = array('status' =>FAIL, 'msg' =>$response_video['error'],'hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die;
        }
        $data['video'] =   $response_video;
      }

      if(!empty($_FILES['videoThumb']['name'])){
        $_FILES['videoThumb']['name'] = 'vthumb.png';
        $folder = 'recepie_video_thumb'; //Set folder for upload profile image 
        $result = $this->image_model->upload_image('videoThumb', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
        }else{
          $data['videoThumb'] = $result;
        } 
      }
    //radio
    if($check){

        $data['recepieStatus'] = 1;
        $res['url']               = base_url().'admin/recepie';
        $data['upd']              = datetime();
       // $data['isDisableComment'] = $this->input->post('radio');
        //$where1 =array('id'=>$check->id);
        $response                 = $this->common_model->updateFields(RECEPIE,$data,$where);
        $res['status']            = 1;
        $res['msg']               = 'Recepie added successfully.';
        echo json_encode($res); die();
    }else{

      if(empty($forumupd)){
        $data['title']          = $title;
        $data['description']    = $this->input->post('description');
         //$data['forumStatus']      = 1;
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/recepie';
      }else{
        $data['addedBy']            = 'admin';
        $data['addedById']          = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']                 = base_url().'admin/recepie';
      }
       // $data['isDisableComment'] = $this->input->post('radio');
        $data['crd'] =    $data['upd'] = datetime();
        $response = $this->common_model->insertData(RECEPIE,$data);
        if($response){
          $res['status'] = 1;
          $res['msg'] = 'Recepie added successfully.';
         //$res['forum_id'] =  $response;
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
  function add_recepie1(){
   //pr($_POST);
    $id       = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    $title    =  sanitize_input_text($this->input->post('title'));
    $discri   =$this->input->post('description');

    if(empty(trim($title)) AND empty(trim($discri))){
        $res['status']      = 0;
        $res['msg']         = 'space are not allowed';
        $res['hash']        = get_csrf_token()['hash'];
        echo json_encode($res); die();
    }

    $strng = trim(preg_replace('/\s+/',' ', $title));
    $articlupd = $this->input->post('upd_articlearticle');
    $cat = $this->input->post('cat');

    if(!empty($articlupd)){
      //$where =array('title'=> $title,'addedById'=>$id,'articleStatus'=>0);
      $where =array('id'=>$articlupd); 
      $check = $this->common_model->is_data_exists(RECEPIE,$where);
    }
    
    //pr($check);
    if(!empty($check)){

      $data['title']          = $strng;
      $data['description']    = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
      $data['categoryId']     = $cat;
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/article';
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/article';
      }
      $data['crd'] =    $data['upd'] = datetime();
      $response = $this->common_model->updateFields(RECEPIE,$data,$where); 
      echo json_encode($response); die; 
      return false;
    }else{
     //pr('dsd');
      $data['title']          = $strng;
      $data['description']    = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
      $data['categoryId']     = $cat;
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
         $data['addedById']   = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url().'admin/article';
      }else{
        $data['addedBy']            = 'admin';
        $data['addedById']          = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']                 = base_url().'admin/article';
      }
      $data['crd'] =    $data['upd'] = datetime();
      $response = $this->common_model->insertData(RECEPIE,$data);
      if($response){
        $res['status']      = 1;
        $res['msg']         = 'Recepie added successfully.';
        $res['article_id']  =  $response;
       
      }else{
        $res['status']      = 0;
        $res['msg']         = 'Somthing went wong';
        $res['hash']        = get_csrf_token()['hash'];
       
      }
      echo json_encode($res);die();
    }
   // pr($res);
     
  }

  function recepieDetail(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "TrainerDetail";
    }else{
      $data['title']  = "AdminDetail";
    }
      $this->check_admin_user_session();
      $recepieId = decoding($this->uri->segment(4));
      //$data['title']='Article Detail';
      $where= array('r.id'=>$recepieId);
      $whereis= array('recepieId'=>$recepieId);
      $data['recepieData'] = $this->Recepie_model->getRecepie($where);
      $data['recepieLike'] = $this->Recepie_model->getRecepieLike($recepieId);
      $data['recipeView'] = $this->common_model->get_total_count(RECEPIEVIEW, $whereis);
      $this->load->admin_render('recepieDetail',$data,''); 
  }//END OF FUNCTION

    function editRecepie(){
      $this->check_admin_user_session();

      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $is_data_exists['title']  = "TrainerEdit";
      }else{
        $is_data_exists['title']  = "AdminEdit";
      }
      $id = decoding($_GET['id']);

      // $id = $_GET['id'];
      $where = array('id'=>$id);
      $is_data_exists['data'] = $this->common_model->is_data_exists(RECEPIE,$where);

      $whereRecId = array('recepieId'=>$id);
      $categoryIdData = $this->common_model->is_data_exists(RECEPIE_CATEGORY_MAP,$whereRecId);
      if(!empty($categoryIdData)){
        $is_data_exists['cat_id'] = $categoryIdData->categoryId;
        
      $whereRec = array('id'=>$is_data_exists['cat_id']);
      $is_data_exists['cat_name'] = $this->common_model->is_data_exists(RECEPIE_CATEGORY,$whereRec)->categoryName;
      }
      


      $is_data_exists['category']  = $this->common_model->getAll(RECEPIE_CATEGORY);

     
      if(!empty($is_data_exists['data'])){
        
        $this->load->admin_render('editRecepie',$is_data_exists,'');
      }else{
        $this->load->admin_render('addRecepie','');
      }
        
    }


  function edit_recepie(){
      //pr($_POST);
      //pr(sanitize_input_text($this->input->post('category_name')));
    $recepieId = $_POST['recId'];
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('category_name', 'category name', 'trim|required');
    $this->form_validation->set_rules('description', 'Description','trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $title = sanitize_input_text($this->input->post('title'));
    // $where =array('title'=>$title);
    // $check = $this->common_model->is_data_exists(RECEPIE,$where);
    $check=$this->_change_check_unique_email($recepieId,$this->input->post('title'),'recepie.title');
    if($check==FALSE){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }else{
      if(!empty($_FILES['recepie_image']['name'])){   
            $imageName = 'recepie_image';
            $folder =  "recepie";
            $response_image = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image['error'])){
              $response = array('status' =>'-1', 'msg' =>$response_image['error'],'hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }
            $data['image'] =   $response_image;
      }
      if(!empty($_FILES['file']['name'])){   
            $video = 'file';
            $folder =  "video_recepie";
            $response_video = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($response_video['error'])){
              $response = array('status' =>FAIL, 'msg' =>$response_video['error'],'hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }
            $data['video'] =   $response_video;
      }
      if(!empty($_FILES['videoThumb']['name'])){
        $_FILES['videoThumb']['name'] = 'vthumb.png';
        $folder = 'recepie_video_thumb'; //Set folder for upload profile image 
        $result = $this->image_model->upload_image('videoThumb', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
        }else{
          $data['videoThumb'] = $result;
        } 
      }
      $data['title']          = sanitize_input_text($this->input->post('title'));
      $data['categoryId']     = sanitize_input_text($this->input->post('category_name'));
      $data['description']    = strip_tags(sanitize_input_text($this->input->post('description')));
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $res['url']           = base_url().'admin/recepie';
      }else{
        $res['url']           = base_url().'admin/recepie';
      }
      $data['crd'] =    $data['upd'] = datetime();
      $whereId = array('id'=>$_POST['recepie_id']);
      $responseRecepie = $this->common_model->updateFields(RECEPIE,$data,$whereId);

      $wheremapId = array('recepieId'=>$_POST['recepie_id']);
      $map['categoryId'] = sanitize_input_text($this->input->post('category_name'));
      $map['recepieId'] = $_POST['recepie_id'];
      //pr('ds');
      $wherecheck = array('postId'=>$map['recepieId'],'refrenceTable'=>RECEPIE);
      $check2 = $this->common_model->is_data_exists('postRevision',$wherecheck);
      if(!empty($check2)){
        $deleteArticle = $this->common_model->deleteData('postRevision',$wherecheck);
       }

      $response = $this->common_model->updateFields(RECEPIE_CATEGORY_MAP,$map,$wheremapId);

      if($responseRecepie){
        $res['status'] = 1;
        $res['msg'] = 'Recipes Updated successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }
  }
  //END OF FUNCTION

    public function delete_recepie(){
      $this->check_admin_user_session();
      $id = $_POST['id'];
      $table = RECEPIE;
      $where = array('id'=>$id);
      $whereDelete = array('id'=>$id);
      $delete = $this->common_model->deleteData($table,$whereDelete);

      if($this->db->affected_rows() > 0){
        $this->load->model('image_model');
        $data=array('status'=>1,'message'=>'Recipes Deleted successfully','url'=>base_url().'admin/recepie');
      }else{
        $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
     
      }  

        echo json_encode($data);
    }//END DELETE FUNCTION

    function deleteRecepieVideo(){

          $videoId        = $this->input->post('id');
          $where          = array('id'=>$videoId);
          $videoData      = $this->common_model->getsingle(RECEPIE,$where);

        if(($_POST['flag']==1) && ($_POST['imageFlag']==1)){

          $thumbPath      = 'uploads/recepie_video_thumb/';
          $isDeleteThumb  = $this->image_model->delete_image($thumbPath,$videoData->videoThumb);

          $videoPath      ='uploads/video_recepie/';
          $isDeleteVideo  = $this->Media_upload_model->delete_media($videoPath,$videoData->video);

          $Path           = 'uploads/recepie/';
          $isDeleteimage  = $this->image_model->delete_image($Path,$imageData->image);

          if($isDeleteThumb==TRUE AND $isDeleteVideo==TRUE){
            $data['video']='';
            $data['videoThumb']='';
            
            $update = $this->common_model->updateFields(RECEPIE,$data,$where);
            
            die();
          }
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wrong';
          $res['hash']= get_csrf_token()['hash'];
          echo json_encode($res);die();
        }

      if($_POST['flag']==1){

        $thumbPath      = 'uploads/recepie_video_thumb/';
        $isDeleteThumb  = $this->image_model->delete_image($thumbPath,$videoData->videoThumb);

        $videoPath      ='uploads/video_recepie/';
        $isDeleteVideo  = $this->Media_upload_model->delete_media($videoPath,$videoData->video);

        if($isDeleteThumb==TRUE AND $isDeleteVideo==TRUE){
          $dataVideo['video']='';
          $dataVideo['videoThumb']='';
          
          $update = $this->common_model->updateFields(RECEPIE,$dataVideo,$where);
          
          die();
        }
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wrong';
          $res['hash']= get_csrf_token()['hash'];
          echo json_encode($res);die();
      }

      if($_POST['imageFlag']==1){
        $Path           = 'uploads/recepie/';
        $isDeleteimage  = $this->image_model->delete_image($Path,$imageData->image);
        if($isDeleteimage == TRUE){
          $dataImage['image']='';
          $update = $this->common_model->updateFields(RECEPIE,$dataImage,$where);
          die();
        }
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wrong';
        $res['hash']= get_csrf_token()['hash'];
        echo json_encode($res);die();
      }
  }//END OF FUNCTION

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

    function checkArticleId(){
//pr($_POST);
      if(!empty($_POST['articlearticle'])){
      $articleId = $_POST['articlearticle'];

      $where =array('postId'=>$articleId,'refrenceTable'=>'recepie');
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'recepie');
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'recepie');
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

     function editRecepie1(){
    //pr($_POST);
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
    $cat = $this->input->post('cat');
    $title = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $description = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('description'))));
    $where =array('postId'=>$articleId,'refrenceTable'=>'recepie'); 
    $check = $this->common_model->is_data_exists('postRevision',$where);
    $cat = $this->input->post('cat');
    if($check){
     /* if($check->postStatus==1){
        $deleteA = $this->common_model->deleteData('postRevision',$where);
        $res['status'] = 1;
        echo json_encode($res);
        return false;
      }*/
      $data['title']           = $title;
      $data['description']     = $description;
      $data['categoryId']      = $cat;
      $data['upd']             = datetime();
      $where                   = array('postId'=>$articleId,'refrenceTable'=>'recepie'); 
      $update                  = $this->common_model->updateFields('postRevision',$data,$where);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'recepie updated successfully.';
        $res['url'] = base_url().'admin/recepie';
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
      $data['categoryId']       = $cat;
      $data['postId']           = $articleId; 
      $data['postStatus']       = 0;
      $data['refrenceTable']    = 'recepie';
      $data['crd'] =$data['upd']= datetime();
      $update = $this->common_model->insertData('postRevision',$data);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'recepie updated successfully.';
        $res['url'] = base_url().'admin/article';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }   
  }

}//END OF CLASS

?>