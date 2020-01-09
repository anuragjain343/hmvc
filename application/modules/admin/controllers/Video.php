<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Video extends Common_Back_Controller {

    public $data = "";

  function __construct() {
 
    parent::__construct();
    $this->load->model('Media_upload_model');
    $this->load->model('image_model');
    $this->load->model('Video_model');
    $this->load->library('Ajax_pagination');
      if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    }
  }

  //INDEX FUNCTION TO LOAD VIDEO LIST VIEW
  public function index(){
  $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
     $data['title']  = "Infomational Video trainer";
    }else{
    $data['title']  = "Infomational Video";
    }
    $data['back_css']  = array('backend_assets/custom/js/jquery.validate.min.js','backend_assets/css/owl.carousel.min.css', 'backend_assets/css/lightgallery.min.css');
    $data['back_js']  = array('backend_assets/js/owl.carousel.min.js','backend_assets/js/lightgallery-all.min.js');
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
     if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('postedBy'=>'trainer','postedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'isDelete'=>'0');
    }else{
      $type ='';
    }
  $data['total_video'] = $this->Video_model->videoCount($type);
    $this->load->admin_render('informationalVideo',$data,''); 
  }
  //END OF FUNCTION

  //ADD VIDEO BY ADMIN/TRAINER AND UPDATE VIEW <script src="assets/js/select2.full.min.js" type="text/javascript"></script>

  function addVideo(){

    $data['back_css']  = array('backend_assets/css/select2.min.css');
    $data['back_js']  = array('backend_assets/js/select2.full.min.js','backend_assets/js/form-select2.min.js');
    $this->check_admin_user_session();
     if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
     $data['title']  = "AddInfomationalVideoTrainer";
    }else{
    $data['title']  = "AddInfomationalVideoAdmin";
      }
    $videoId = $this->uri->segment(4);
    if(!empty($videoId)){
      $id = decoding($videoId);
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['title']      = "Trainer Update Video";
       }
      $data['title']      = "Update Video";
      $wher              = array('id'=>$id);
      $data['videoData']  = $this->common_model->getsingle(INFORMATIONALVIDEO,$wher);
     
      $where              = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['admin']      = $this->common_model->getsingle(USERS,$where);
      //pr($data['admin']);
      $this->load->admin_render('updateVideo',$data,''); 
    }else{
     
      $where              = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['admin']      = $this->common_model->getsingle(USERS,$where);
     // pr($data['admin']);
      $this->load->admin_render('addVideo',$data,''); 
    }
  }
  //END OF FUNCTION

    //DELETE VIDEO BY ADMIN/TRAINER AND UPDATE VIEW 
  function deleteVideoByAdmin(){
    $this->check_admin_user_session();
    $data['title']  = "AddInfomationalVideoTrainer";
     if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
    $videoId = $this->uri->segment(4);
    if(!empty($videoId)){
      $id = decoding($videoId);
      $wher              = array('id'=>$id);
      $data['videoData']  = $this->common_model->getsingle(INFORMATIONALVIDEO,$wher);
     if(!empty($data['videoData'])){
      $where              = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['admin']      = $this->common_model->getsingle(USERS,$where);
      $this->load->admin_render('deleteVideo',$data,''); 
     }else{
      redirect('admin/video');
     }
    }
  }else{
    redirect('admin/video');
  }
  }
  //END OF FUNCTION

  //DELETE TRAINING VIDEO VIEW
  function deleteTrVideoByAdmin(){
    $this->check_admin_user_session();
    $data['title']  = "AddInfomationalVideoTrainer";
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      $videoId = $this->uri->segment(4);
      if(!empty($videoId)){
        $id = decoding($videoId);
        $wher              = array('id'=>$id);
        $data['videoData']  = $this->common_model->getsingle(TRAININGVIDEO,$wher);
        if(!empty($data['videoData'])){
        $where              = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
        $data['admin']      = $this->common_model->getsingle(USERS,$where);
        $this->load->admin_render('deleteTrainingVideo',$data,''); 
        }else{
        redirect('admin/video/trainingVideo');
        }
      }
    }else{
      redirect('admin/video/trainingVideo');
    }
  }
  //END OF FUNCTION

  //ADD TRAINING VIDEO BY ADMIN/TRAINER AND UPDATE VIEW 
  function addTrainingVideo(){
    $this->check_admin_user_session();
     $data['back_css']  = array('backend_assets/css/select2.min.css');
    $data['back_js']  = array('backend_assets/js/select2.full.min.js','backend_assets/js/form-select2.min.js');
     if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
     $data['title']  = "AddTrainingVideoTrainer";
    }else{
    $data['title']  = "AddTrainingVideoAdmin";
      }
    $videoId = $this->uri->segment(4);
    if(!empty($videoId)){
      $id = decoding($videoId);
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['title']      = "Trainer Update Video";
       }

      $data['title']      = "Update Training Video";
      $wher              = array('id'=>$id);
      $data['videoData']  = $this->common_model->getsingle(TRAININGVIDEO,$wher);
      $where              = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['admin']      = $this->common_model->getsingle(USERS,$where);
      $this->load->admin_render('updateTrainingVideo',$data,''); 
    }else{
     
      $where              = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
      $data['admin']      = $this->common_model->getsingle(USERS,$where);
      $this->load->admin_render('addTrainingVideo',$data,''); 
    }
  }
  //END OF FUNCTION

  //ADD VIDEO BY ADMIN/TRAINER  
  function add_Video(){
   
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('levelName[]', 'Select Level', 'trim|required');
    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      echo json_encode($res);die();
    }

    $data['title'] = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
  
    $newsel = $this->input->post('levelName');
    

    $data['videoLevelType']= implode(",",$newsel);
    
    //$data['videoLevelType']= sanitize_input_text($this->input->post('levelName'));

    $where =array('title'=>$data['title']);
    $check = $this->common_model->is_data_exists('informationalVideo',$where);
    if($check){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }else{
      if(!empty($_FILES['informationalVideo']['name'])){
        $folder = 'informationalVideo'; //Set folder for upload  profile image   
        $result = $this->Media_upload_model->upload_video('informationalVideo', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
           echo json_encode($response); exit;
        }else{
          $data['informationalVideo'] =$result;
        }   
      }
      else{
        $response = array('status' =>FAIL, 'msg' =>'Select Video','hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die; 
        return false;
      }
      if(!empty($_FILES['videoThumb']['name'])){
        $_FILES['videoThumb']['name'] = 'vthumb.png';
        $folder = 'video_thumb'; //Set folder for upload profile image 
        $result = $this->image_model->upload_image('videoThumb', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
        }else{
          $data['videoThumb'] = $result;
        } 
      }
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['postedBy'] = 'trainer';
        $data['postedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }else{
        $data['postedBy'] = 'admin';
        $data['postedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }
      $data['crd'] =    $data['upd'] = datetime();
      $response = $this->common_model->insertData('informationalVideo',$data);
      if($response){
        $res['status'] = 1;
        $res['msg'] = 'Informational video added successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wrong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }     
  }
  //END OF FUNCTION

  //VIDEO LIST 
  function video_List(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('postedBy'=>'trainer','postedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'isDelete'=>'0');
    }else{
      $type ='';
    }

    $config['base_url'] = base_url()."admin/video/video_List";
    if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('title'=>$search1);
     $config['total_rows'] = $this->Video_model->videoCountSearch($type,$search);
     //pr($config['total_rows']);
    }else{
    $config['total_rows'] = $this->Video_model->videoCount($type);
    }
    $config['uri_segment'] =4;
    $config['per_page'] = 9;
    $config['num_links'] = 5;
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class'] = '';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active1"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('title'=>$search1);
      $data['videoList'] = $this->Video_model->getAllVideoSearch($config['per_page'],$page,$type,$search);
    }else{  
    $data['videoList'] = $this->Video_model->getAllVideo($config['per_page'],$page,$type);
    }
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_video']= $config['total_rows'];
    $rr = $this->load->view('get_Infomational_Video_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));
         
  }
  //END OF FUNCTION

  // DELETE VIDEO 
  function deleteVideo(){
    $flag = $_POST['flag'];
    $videoId        = $this->input->post('id');
    $where          = array('id'=>$videoId);
    $videoData      = $this->common_model->getsingle(INFORMATIONALVIDEO,$where);
    if($flag == 1){

      $thumbPath      = 'uploads/video_thumb/';
      $isDeleteThumb  = $this->image_model->delete_image($thumbPath,$videoData->videoThumb);

      $videoPath      ='uploads/informationalVideo/';
      $isDeleteVideo  = $this->Media_upload_model->delete_media($videoPath,$videoData->informationalVideo);
      if($isDeleteThumb==TRUE AND $isDeleteVideo==TRUE){
        $data['informationalVideo']='';
        $data['videoThumb']='';
        $update = $this->common_model->updateFields(INFORMATIONALVIDEO, $data, $where);
        die();
      }
      $res['status'] = 0;
      $res['msg'] = 'Somthing went wrong';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
  }

  //END OF FUNCTION
  function deleteinfoVideo(){
    $videoId        = $this->input->post('id');
    $where          = array('id'=>$videoId);
    $videoData      = $this->common_model->getsingle(INFORMATIONALVIDEO,$where);
    $thumbPath      = 'uploads/video_thumb/';
    $isDeleteThumb  = $this->image_model->delete_image($thumbPath,$videoData->videoThumb);
    $videoPath      ='uploads/informationalVideo/';
    $isDeleteVideo  = $this->Media_upload_model->delete_media($videoPath,$videoData->informationalVideo);
    if($isDeleteThumb==TRUE AND $isDeleteVideo==TRUE){
    
    $id = $videoId;   
    $whereExits    = array('referenceId'=>$id,'notificationFor'=>1,'notificationType'=>'delete_informational_video');
    $article_info_exits  = $this->common_model->getsingle(NOTIFICATIONS,$whereExits);
   // pr($article_info_exits);

    /*if($article_info_exits){
      $response = array('status' => 0, 'message' => 'Video already deleted.',  'url' => base_url('admin/video')); 
        echo json_encode($response);die();
    }*/
    //else{
        $deletevideo  = $this->common_model->deleteData(INFORMATIONALVIDEO,$where);
        if($article_info_exits){
        $title      = "Delete video";
        $body_save  = '[UNAME] is deleted video';
        $notif_type = 'delete_informational_video';

        $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);

        $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=>$article_info_exits->notificationBy, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
        $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
       
        if($notif_msg){
          $response = array('status' => 1, 'message' => 'Video deleted successfully.',  'url' => base_url('admin/video')); 
             echo json_encode($response);die();
        }
    }
    $response = array('status' => 1, 'message' => 'Video deleted successfully.',  'url' => base_url('admin/video')); 
             echo json_encode($response);die();
      
  }
}
  //END OF FUNCTION


  function deleteTraVideo(){
    $videoId        = $this->input->post('id');
    $where          = array('id'=>$videoId);
    $videoData      = $this->common_model->getsingle(TRAININGVIDEO,$where);
    $thumbPath      = 'uploads/video_thumb/';
    $isDeleteThumb  = $this->image_model->delete_image($thumbPath,$videoData->videoThumb);
    $videoPath      ='uploads/trainingVideo/';
    $isDeleteVideo  = $this->Media_upload_model->delete_media($videoPath,$videoData->trainingVideo);
    if($isDeleteThumb==TRUE AND $isDeleteVideo==TRUE){
    
    $id = $videoId;   
    $whereExits    = array('referenceId'=>$id,'notificationFor'=>1,'notificationType'=>'delete_training_video');
    $article_info_exits  = $this->common_model->getsingle(NOTIFICATIONS,$whereExits);
   // pr($article_info_exits);

    /*if($article_info_exits){
      $response = array('status' => 0, 'message' => 'Video already deleted.',  'url' => base_url('admin/video')); 
        echo json_encode($response);die();
    }*/
    //else{
        $deletevideo  = $this->common_model->deleteData(TRAININGVIDEO,$where);
        if($article_info_exits){
        $title      = "Delete video";
        $body_save  = '[UNAME] is deleted video';
        $notif_type = 'delete_informational_video';

        $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);

        $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=>$article_info_exits->notificationBy, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
        $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
       
        if($notif_msg){
        $response = array('status' => 1, 'message' => 'Video deleted successfully.',  'url' => base_url('admin/video/trainingVideo')); 
        echo json_encode($response);die();
        }
    }
    $response = array('status' => 1, 'message' => 'Video deleted successfully.',  'url' => base_url('admin/video/trainingVideo')); 
    echo json_encode($response);die();
      
  }
}
  //END OF FUNCTION
  
  //DELETE INFO VIDEO BY TRRAINER
   function deleteinfoVideoByTrainer(){
    $videoId        = $this->input->post('id');
    $where          = array('id'=>$videoId);
    $videoData      = $this->common_model->getsingle(INFORMATIONALVIDEO,$where);
    $id             = $videoId;

    $whereExits     = array('referenceId'=>$id,'notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationType'=>'delete_informational_video');
    $article_info_exits  = $this->common_model->is_data_exists(NOTIFICATIONS,$whereExits);

     if($article_info_exits){
      $response = array('status' => 0, 'message' => 'You already sent Request to admin','url'=>base_url('admin/article')); 
      echo json_encode($response);die();
    }

     $whereExitsNxt    = array('referenceId'=>$id,'notificationFor'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationType'=>'delete_informational_video');
     $article_info_exits_again  = $this->common_model->is_data_exists(NOTIFICATIONS,$whereExitsNxt);

    if($article_info_exits_again){
      $deletepriviosReq= $this->common_model->deleteData(NOTIFICATIONS,$whereExitsNxt);
      if($deletepriviosReq){
        $title      = "Delete video";
        $body_save  = '[UNAME] is interested in Delete informational video';
        $notif_type = 'delete_informational_video';

        $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);

        $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=>1, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());

        $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
        if($notif_msg){
          $response = array('status' => 1, 'message' => 'Request sent successfully to admin',  'url' => base_url('admin/video')); 
             echo json_encode($response);die();
        }
      }
    }
    
      $title      = "Delete video";
      $body_save  = '[UNAME] is interested in Delete informational video';
      $notif_type = 'delete_informational_video';
      $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
      $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=>1, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
       $notif_msgg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
      if($notif_msgg){
        $response = array('status' => 1, 'message' => 'Request sent successfully to admin',  'url' => base_url('admin/video')); 
       echo json_encode($response);die();
      } 
  } 
  //END OF FUCNTION 
 
  //DELETE VIDEO BY TRRAINER
   function deleteTrainingVideoByTrainer(){
    $videoId        = $this->input->post('id');
    $where          = array('id'=>$videoId);
    $videoData      = $this->common_model->getsingle(TRAININGVIDEO,$where);
    $id             = $videoId;
    $whereExits     = array('referenceId'=>$id,'notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationType'=>'delete_training_video');
    $article_info_exits  = $this->common_model->is_data_exists(NOTIFICATIONS,$whereExits);

    $whereExitsNxt    = array('referenceId'=>$id,'notificationFor'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationType'=>'delete_training_video');
    $article_info_exits_again  = $this->common_model->is_data_exists(NOTIFICATIONS,$whereExitsNxt);

    if($article_info_exits_again){
      $deletepriviosReq= $this->common_model->deleteData(NOTIFICATIONS,$whereExitsNxt);
      if($deletepriviosReq){
        $title      = "Delete video";
        $body_save  = '[UNAME] is interested in Delete training video';
        $notif_type = 'delete_training_video';
        $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
        $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=>1, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());

        $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
        if($notif_msg){
         $response = array('status' => 1, 'message' => 'Request sent successfully to admin','url' => base_url('admin/video/deleteTrVideoByAdmin')); 
          echo json_encode($response);die();
        }
      }
    }

    if($article_info_exits){
      $response = array('status' => 0, 'message' => 'You already sent Request to admin','url'=>base_url('admin/video/trainingVideo')); 
      echo json_encode($response);die();
    }

      $title      = "Delete video";
      $body_save  = '[UNAME] is interested in Delete training video';
      $notif_type = 'delete_training_video';
      $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
      $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=>1, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
       $notif_msgg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
      if($notif_msgg){
        $response = array('status' => 1, 'message' => 'Request sent successfully to admin',  'url' => base_url('admin/video')); 
       echo json_encode($response);die();
      }
    
  } 
  //END OF FUCNTION 

  //END OF FUNCTION
    function delete_trainingVideo(){
    $videoId        = $this->input->post('id');
    $where          = array('id'=>$videoId);
    $videoData      = $this->common_model->getsingle(TRAININGVIDEO,$where);
    $thumbPath      = 'uploads/video_thumb/';
    $isDeleteThumb  = $this->image_model->delete_image($thumbPath,$videoData->videoThumb);
    $videoPath      ='uploads/trainingVideo/';
    $isDeleteVideo  = $this->Media_upload_model->delete_media($videoPath,$videoData->trainingVideo);
    if($isDeleteThumb==TRUE AND $isDeleteVideo==TRUE){
      $data['informationalVideo']='';
      $data['videoThumb']='';
      $update = $this->common_model->deleteData(TRAININGVIDEO,$where);
      if($update==TRUE){
        $res['status']=1;
        $res['msg']='Video deleted successfully';
        echo json_encode($res);die();
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wrong';
        $res['hash']= get_csrf_token()['hash'];
        echo json_encode($res);die();
      }
    }
    $res['status'] = 0;
    $res['msg'] = 'Somthing went wrong';
    $res['hash']= get_csrf_token()['hash'];
    echo json_encode($res);die();
  }
  //END OF FUNCTION 
  //DELETE TRAINERING VIDEO BY TRAINER

  function delete_trainingVideoByTraoner(){
    $videoId        = $this->input->post('id');
    $where          = array('id'=>$videoId);
    $videoData      = $this->common_model->getsingle(TRAININGVIDEO,$where);
    if($videoData){
      $data['isDelete']='1';
      $update = $this->common_model->updateFields(TRAININGVIDEO, $data, $where);
      if($update==TRUE){
        $res['status']=1;
        $res['msg']='Video deleted successfully';
        echo json_encode($res);die();
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wrong';
        $res['hash']= get_csrf_token()['hash'];
        echo json_encode($res);die();
      }
    }
    $res['status'] = 0;
    $res['msg'] = 'Somthing went wrong';
    $res['hash']= get_csrf_token()['hash'];
    echo json_encode($res);die();
  }
  //END OF FUNCTION
  
  //UPDATE VIDEO BY ADMIN/TRAINER  
  function update_Video(){
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
     $this->form_validation->set_rules('levelName[]', 'Select Level', 'trim|required');
    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      echo json_encode($res);die();
    }
    $newsel = $this->input->post('levelName');
    $videoId        = sanitize_input_text($this->input->post('vId'));
    $data['title'] = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $data['videoLevelType']= implode(",",$newsel);
    $where =array('title'=>$data['title'],'id !='=>$videoId);
    $check = $this->common_model->is_data_exists('informationalVideo',$where);
    if($check){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }
    else{

      $whr =array('id'=>$videoId);
      $checkData = $this->common_model->is_data_exists('informationalVideo',$whr);

      //if(empty($checkData->informationalVideo) AND empty($checkData->videoThumb)){


      if(!empty($_FILES['informationalVideo']['name'])){
        $folder = 'informationalVideo'; //Set folder for upload  profile image   
        $result = $this->Media_upload_model->upload_video('informationalVideo', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
           echo json_encode($response); exit;
        }else{
          $data['informationalVideo'] =$result;
        }   
      }
     /* else{
        $response = array('status' =>FAIL, 'msg' =>'Select Video','hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die; 
      }*/

      if(!empty($_FILES['videoThumb']['name'])){
        $_FILES['videoThumb']['name'] = 'vthumb.png';
        $folder = 'video_thumb'; //Set folder for upload profile image 
        $result = $this->image_model->upload_image('videoThumb', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
        }else{
          $data['videoThumb'] = $result;
        } 
      }
    //}
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['postedBy'] = 'trainer';
        $data['postedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }else{
        $data['postedBy'] = 'admin';
        $data['postedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }
      $data['upd'] = datetime();
      $wherecon = array('id'=>$videoId);
     // pr($data);
        $response = $this->common_model->updateFields('informationalVideo', $data, $wherecon);
        if($response){
          $res['status'] = 1;
          $res['msg'] = 'Informational video update successfully.';
        }else{
          $res['status'] = 0;
          $res['msg'] = 'Somthing went wrong';
          $res['hash']= get_csrf_token()['hash'];
        }
      echo json_encode($res);
    }     
  }
  //END OF FUNCTION

  function trainingVideo(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
     $data['title']  = "Training Video trainer";
    }else{
    $data['title']  = "Training Video";
    }
    $data['back_css']  = array('backend_assets/css/owl.carousel.min.css', 'backend_assets/css/lightgallery.min.css');
    $data['back_js']  = array('backend_assets/js/owl.carousel.min.js','backend_assets/js/lightgallery-all.min.js');
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
     if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('postedBy'=>'trainer','postedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'isDelete'=>'0','isDelete'=>'0');
    }else{
      $type ='';
    }
    $data['total_rows'] = $this->Video_model->trainingVideoCount($type);
    $this->load->admin_render('trainingVideos',$data,''); 
  }

  //ADD VIDEO BY ADMIN/TRAINER  
  function add_tainingVideo(){
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
    $this->form_validation->set_rules('levelName[]', 'Select Level', 'trim|required');
    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      echo json_encode($res);die();
    }
    $data['title'] = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));

    $newsel = $this->input->post('levelName');
    $data['videoLevelType']= implode(",",$newsel);
    //$data['videoLevelType'] = sanitize_input_text($this->input->post('levelName'));

    $where =array('title'=>$data['title']);
    $check = $this->common_model->is_data_exists(TRAININGVIDEO,$where);
    if($check){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }else{
      if(!empty($_FILES['trainingVideo']['name'])){
        $folder = 'trainingVideo'; //Set folder for upload  profile image   
        $result = $this->Media_upload_model->upload_video('trainingVideo', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
           echo json_encode($response); exit;
        }else{
          $data['trainingVideo'] =$result;
        }   
      }
      else{
        $response = array('status' =>FAIL, 'msg' =>'Select Video','hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die; 
        return false;
      }
      if(!empty($_FILES['videoThumb']['name'])){
        $_FILES['videoThumb']['name'] = 'vthumb.png';
        $folder = 'video_thumb'; //Set folder for upload profile image 
        $result = $this->image_model->upload_image('videoThumb', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
        }else{
          $data['videoThumb'] = $result;
        } 
      }
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['postedBy'] = 'trainer';
        $data['postedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }else{
        $data['postedBy'] = 'admin';
        $data['postedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }
      $data['crd'] =    $data['upd'] = datetime();
      $response = $this->common_model->insertData(TRAININGVIDEO,$data);
      if($response){
        $res['status'] = 1;
        $res['msg'] = 'Training video added successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wrong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }     
  }
  //END OF FUNCTION
    //VIDEO LIST 
  function trainingVideo_List(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $type = array('postedBy'=>'trainer','postedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'isDelete'=>'0','isDelete'=>'0');
    }else{
      $type ='';
    }
    $config['base_url'] = base_url()."admin/video/trainingVideo_List";
     if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('title'=>$search1);
       $config['total_rows'] = $this->Video_model->trainingVideoCountSearch($type,$search);
    }else{
    $config['total_rows'] = $this->Video_model->trainingVideoCount($type);
    }
    $config['uri_segment'] =4;
    $config['per_page'] = 9;
    $config['num_links'] = 5;
    $config['first_link'] = FALSE;
    $config['last_link'] = FALSE;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class'] = '';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active1"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    if(!empty($_POST['search'])){
      $search1 =$_POST['search'];
      $search = array('title'=>$search1);
       $data['videoList'] = $this->Video_model->getAllTrainingVideoSearch($config['per_page'],$page,$type,$search);
     }else{ 
    $data['videoList'] = $this->Video_model->getAllTrainingVideo($config['per_page'],$page,$type);
    }
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_video']= $config['total_rows'];
    $rr = $this->load->view('get_Training_Video_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));
         
  }
  //END OF FUNCTION
    //UPDATE VIDEO BY ADMIN/TRAINER  
  function update_trainingVideo(){
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'Title', 'trim|required');
     $this->form_validation->set_rules('levelName[]', 'Select Level', 'trim|required');
    //check validations
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      echo json_encode($res);die();
    }
    $newsel =  $this->input->post('levelName');
    
    $videoId        = sanitize_input_text($this->input->post('vId'));
    $data['title'] = trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('title'))));
    $data['videoLevelType']= implode(",",$newsel);

    $where =array('title'=>$data['title'],'id !='=>$videoId);
    $check = $this->common_model->is_data_exists(TRAININGVIDEO,$where);
    if($check){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }
    else{

      $whr =array('id'=>$videoId);
      $checkData = $this->common_model->is_data_exists(TRAININGVIDEO,$whr);

      //if(empty($checkData->trainingVideo) AND empty($checkData->videoThumb)){


      if(!empty($_FILES['trainingVideo']['name'])){
        $folder = 'trainingVideo'; //Set folder for upload  profile image   
        $result = $this->Media_upload_model->upload_video(TRAININGVIDEO, $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
           echo json_encode($response); exit;
        }else{
          $data['trainingVideo'] =$result;
        }   
      }
      /*else{
        $response = array('status' =>FAIL, 'msg' =>'Select Video','hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die; 
        return false;
      }*/

      if(!empty($_FILES['videoThumb']['name'])){
        $_FILES['videoThumb']['name'] = 'vthumb.png';
        $folder = 'video_thumb'; //Set folder for upload profile image 
        $result = $this->image_model->upload_image('videoThumb', $folder);
        if (is_array($result) && array_key_exists('error', $result)){
          $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); exit;
        }else{
          $data['videoThumb'] = $result;
        } 
      }
    //}
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['postedBy'] = 'trainer';
        $data['postedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }else{
        $data['postedBy'] = 'admin';
        $data['postedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      }
      $data['upd'] = datetime();
      $wherecon = array('id'=>$videoId);
     // pr($data);
      $response = $this->common_model->updateFields(TRAININGVIDEO,$data, $wherecon);
      if($response){
        $res['status'] = 1;
        $res['msg'] = 'Training video update successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wrong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }     
  }
  //END OF FUNCTION
   // DELETE VIDEO 
    function deleteTrainingVideo(){
    $flag = $_POST['flag'];
    $videoId        = $this->input->post('id');
    $where          = array('id'=>$videoId);
    $videoData      = $this->common_model->getsingle(TRAININGVIDEO,$where);
    if($flag==1){

      $thumbPath      = 'uploads/video_thumb/';
      $isDeleteThumb  = $this->image_model->delete_image($thumbPath,$videoData->videoThumb);
      $videoPath      ='uploads/trainingVideo/';
      $isDeleteVideo  = $this->Media_upload_model->delete_media($videoPath,$videoData->informationalVideo);
      if($isDeleteThumb==TRUE AND $isDeleteVideo==TRUE){
        $data['trainingVideo']='';
        $data['videoThumb']='';
        $update = $this->common_model->updateFields(TRAININGVIDEO,$data,$where);
      }
      die();
      $res['status'] = 0;
      $res['msg'] = 'Somthing went wrong';
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
  }
  //END OF FUNCTION
  function deleteReject(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      $id = $_GET['id'];
      $whereart = array('referenceId'=>$id);
      $article_info  = $this->common_model->getsingle(NOTIFICATIONS,$whereart);
      if($article_info){
        $title      = "Video delete request rejected by admin";
        $body_save  = '[UNAME] is rejected deleted video';
        $notif_type = 'delete_informational_video';
        $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
        $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=> $article_info->notificationBy, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
         $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
        if($notif_msg){
          $whereDeletereq= array('referenceId'=>$id,'notificationBy'=>$article_info->notificationBy);
          $requtRej= $this->common_model->deleteData(NOTIFICATIONS,$whereDeletereq);
          if($requtRej){
            $data=array('status'=>1,'message'=>'Request rejected successfully','url'=>base_url().'admin/video');
          }
        }  
      }else{
        $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
      }  
      echo json_encode($data);
    }
  }
    function deleteTrainingvideoReject(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
      $id = $_GET['id'];
      $whereart = array('referenceId'=>$id);
      $article_info  = $this->common_model->getsingle(NOTIFICATIONS,$whereart);
      if($article_info){
        $title      = "Video delete request rejected by admin";
        $body_save  = '[UNAME] is rejected deleted video';
        $notif_type = 'delete_training_video';
        $notif_msg  = array('title'=>$title,'body'=> $body_save, 'notificationType'=>$notif_type,'referenceId'=>$id);
        $insertdata = array('notificationBy'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId'],'notificationFor'=> $article_info->notificationBy, 'notificationMessage'=>json_encode($notif_msg), 'notificationType'=>$notif_type,'referenceId'=>$id,'isRead'=>0,'webNotify'=>0 ,'createdOn'=>datetime());
         $notif_msg = $this->common_model->insertData(NOTIFICATIONS,$insertdata);
        if($notif_msg){
          $whereDeletereq= array('referenceId'=>$id,'notificationBy'=>$article_info->notificationBy);
          $requtRej= $this->common_model->deleteData(NOTIFICATIONS,$whereDeletereq);
          if($requtRej){
            $data=array('status'=>1,'message'=>'Request rejected successfully','url'=>base_url().'admin/video/trainingVideo');
          }
        }  
      }else{
        $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
      }  
      echo json_encode($data);
    }
  }



}//END OF CLASS
