<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends Common_Front_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();  
    $this->load->model('Forum_model');
    $this->load->library('Ajax_pagination');

       
    }
    
    //INDEX FUNCTION TO LOAD LOGIN VIEW

  /*  public function index(){
      $this->check_user_session();
      $data['title'] = "Home";
      $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
      $this->load->front_render('home',$data,''); 
    }*/
    //END OF FUNCTION

  //INDEX FUNCTION TO LOAD LOGIN VIEW


  function index(){
    $this->check_user_session();
    $data['title']="Forum";
    $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
    $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
    $this->load->front_render('allForum',$data,'');
  }

  function add_forum(){
    $this->check_user_session();
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
      if($_SESSION[USER_SESS_KEY]){
        $data['addedBy']      ='user';
        $data['addedById']    = $_SESSION[USER_SESS_KEY]['userId'];
        $data['forumStatus']    = 1;
        $res['url']           = base_url().'home/forum';
      }
      $data['crd']            =    $data['upd'] = datetime();
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
  }

  // FOURM LIST  AJAX FUNCTION 

  function forum_List(){

    $this->check_user_session();
    $type='0';
    $config['base_url']       = base_url()."home/forum/forum_List"; 
    if(!empty($_POST['search'])){
      $search = $_POST['search'];
      $config['total_rows']     = $this->Forum_model->forumCountBySeaching($search);
     //echo $config['total_rows'];
    }
    else{  
    $config['total_rows']     = $this->Forum_model->forumCount($type);
   // pr(  $config['total_rows'] );
    }
    $config['uri_segment']    = 4;
    $config['per_page']       = 8;
    $config['num_links']      = 5;
    $config['first_link']     = FALSE;
    $config['last_link']      = FALSE;
    $config['full_tag_open']  = '<ul class="pagination NewPage csPagination justify-content-end">';
    $config['full_tag_close'] = '</ul>';
    $config['next_link']      = '&raquo;';
    $config['next_tag_open']  = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['anchor_class']   = 'class="page-link"';
    $config['prev_link']      = '&laquo;';
    $config['prev_tag_open']  = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open']   = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close']  = '</a></li>';
    $config['num_tag_open']   = '<li class="page page-item">';
    $config['num_tag_close'] = '</li>';
    $page =  ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $this->ajax_pagination->initialize($config);
    if(!empty($_POST['search'])){
      $search = $_POST['search'];
      $data['forumList']    = $this->Forum_model->getAllForumBySearch($config['per_page'],$page,$search);
      //print_r($data['forumList']);
    }else{
    $data['forumList'] = $this->Forum_model->getAllForum($config['per_page'],$page);
    }
    //pr($data['forumList']);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_fourm']= $config['total_rows'];
   // pr($data['forumList']);
    $rr= $this->load->view('get_Forum_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));       
  }

   //FORUM DETAIL
   function forumDetail(){
    $this->check_user_session();
      $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
    
      $forumId = decoding($this->uri->segment(4));
      $data['title']='Forum Detail';
        $wher =array('id'=>$forumId);
       $checkfrm = $this->common_model->is_data_exists(FOURM,$wher);
       if(empty($checkfrm)){
        redirect('home/forum');
       }
      $where= array('fm.id'=>$forumId);
      $data['forumData'] = $this->Forum_model->getForum($where);
    
      $wherecount = array('forumId'=>$forumId,'userId'=>$_SESSION[USER_SESS_KEY]['userId']);
      $wherecounts = array('forumId'=>$forumId);
      $currentusercount = $this->common_model->get_total_count(FOURMLIKE,$wherecount);
      $answerCount = $this->common_model->get_total_count(FOURMANSWER,$wherecounts);
      $data['currentUserLike']=$currentusercount;
      $data['answerCount']=$answerCount;
      //pr($data);
      $this->load->front_render('forumDetail',$data,''); 
   }
   //END OF FUNCTION 

   // FORUM LIKE
   function forumLike(){
    $this->check_user_session();
    $userId = $_SESSION[USER_SESS_KEY]['userId'];
    $forumId = $_GET['id'];
    //pr($forumId);
     $wher =array('id'=>$forumId);
       $checkfrm = $this->common_model->is_data_exists(FOURM,$wher);
       if(empty($checkfrm)){
      $res['status'] = 3;
      echo json_encode($res); die();
       }

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

      $wherecount = array('forumId'=>$forumId,'userId'=>$_SESSION[USER_SESS_KEY]['userId']);
      $currentusercount = $this->common_model->get_total_count(FOURMLIKE,$wherecount);
      //lq();

      $res['html'] = '<span id="likeCount"> '.$like.'

                    Like</span>';
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
        $wherecount = array('forumId'=>$forumId,'userId'=>$_SESSION[USER_SESS_KEY]['userId']);
        $currentusercount = $this->common_model->get_total_count(FOURMLIKE,$wherecount);
        if($like > 1){
          $likeCount = $like-1;
          $likeThis = 'You and  '.$likeCount.' others ';
        }else{
            $likeThis = 'You liked';
        }
        $res['html'] = '<span id="likeCount"> '.$likeThis.'

                    </span>';
      
        $res['status'] = 1;
        $res['likeCount'] = $totleLike;
        echo json_encode($res); die();
      }

    }
    $res['status'] = 3;
    echo json_encode($res); die();

   }
   //END OF FUNCTION 

  function forumView(){
    $this->check_user_session();
    $userId         = $_SESSION[USER_SESS_KEY]['userId'];
    $forumId        = $_GET['id'];
    $where          = array('forumId'=>$forumId,'userId'=>$userId);
    $check          = $this->common_model->is_data_exists(FOURMVIEW,$where);
    if(!empty($check)){
      $res['status']  = 0;
      echo json_encode($res); die();
     }
    else{
      $data['userId']   =  $userId;
      $data['forumId']  =  $forumId;
      $data['crd']      =  $data['upd'] = datetime();
      $response         = $this->common_model->insertData(FOURMVIEW,$data);
      if($response){
        $res['status'] = 1;
        echo json_encode($res); die();
      }
    }
  }

  function answerList(){
    $this->check_user_session();
  // pr($this->uri->segment(4));
        $limit = 3;
        $is_next = 0;
        $offset = $this->input->post('offset');
        $forumId = $this->input->post('forumId');
        $new_offset     = $limit+$offset;
        $data['limit']  = $limit;
        $data['offset'] = $offset;
        $where                        = array('forumId'=>$forumId);
         $dataView['total_count']     = $this->Forum_model->forumAnswerCount($where);
        $dataView['ansList'] = $this->Forum_model->getForumAnswer($limit,$offset,$where);
        $dataView['fmId'] = $forumId;
        if($dataView['total_count']>$new_offset){
            $is_next =1;  
        }
        $btn_html = '';
        if($is_next){
            $id = "btnLoadViewMe1";
           
             $btn_html   = '<center><div class="form-actions">
                  <button type="submit" class="btn btn-theme btn-bg-t mt-2" id="'.$id.'" data-offset ="'.$new_offset.'" data-isNext ="'.$is_next.'">
                      See More
                          </button>
                      </div></center>';
        }
        //load view with data
        $html_view = $this->load->view('get_forum_answer_list',$dataView,true);

        $response = array('status'=>1,'html_view'=>$html_view,'btn_html'=>$btn_html);
        $no_record=1;
        if(empty($dataView['ansList'])){
            $no_record = 0;
        }
        $response['no_record'] = $no_record;
        $response['hash']= get_csrf_token()['hash'];
         echo json_encode($response);die; 
  }

   
  function answerLike(){
    $this->check_user_session();
    $wherefm = array('forumId'=>$_GET['fmId']);
    $userId = $_SESSION[USER_SESS_KEY]['userId'];
    $ansId = $_GET['id'];
    $where =array('answerId'=>$ansId,'userId'=>$userId);
    $whereis =array('answerId'=>$ansId);
    $check = $this->common_model->is_data_exists(ANSWERLIKE,$where);
    // $whereLikecount = array('id'=>$ansId);
    if(!empty($check)){
     $delete = $this->common_model->deleteData(ANSWERLIKE,$where);
     if($delete){
      $like = $this->common_model->get_total_count(ANSWERLIKE,$whereis);
      $res['status'] = 0;
      //$res['likeCount'] = $totleLike;
      $res['html'] = $like.' Like';
      echo json_encode($res); die();
     }
    }else{
      $data['userId']   =  $userId;
      $data['answerId']  =  $ansId;
      $data['crd']      =  $data['upd'] = datetime();
      $response = $this->common_model->insertData(ANSWERLIKE,$data);
      if($response){
        $like = $this->common_model->get_total_count(ANSWERLIKE,$whereis);
        if($like > 1){
          $likeCount = $like-1;
          $likeThis = 'You and  '.$likeCount.' others ';
        }else{
            $likeThis = 'You liked';
        }
        $res['html'] = $likeThis;
        $res['status'] = 1;
       // $res['likeCount'] = $totleLike;
        echo json_encode($res); die();
      }
    }
   }

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
    $where         = array('forumId'=>$forumId);
      $wher =array('id'=>$forumId);
      $checkfrm = $this->common_model->is_data_exists(FOURM,$wher);
      if(empty($checkfrm)){
        $res['status'] = 3;
        echo json_encode($res); die();
      }

    $response = $this->common_model->insertData(FOURMANSWER,$data);
    $answerCount = $this->common_model->get_total_count(FOURMANSWER,$where);
    $where = array('fa.id'=>$response,'f.id'=>$forumId);
    $data['ansList'] = $this->Forum_model->getForumAnswers($where);

    $res['html_view']= $this->load->view('get_forum_answer_list',$data,true);
    //$var = $this->answerList();
    if($response){
      $res['status'] = 1;
      $res['msg'] = 'Answer added successfully.';
      $res['answerCount']= '<span id="ans-count"> '.$answerCount.' Answers</span>';
      //$res['html'] = $this->answerList();
    }else{
      $res['status'] = 0;
      $res['msg'] = 'Somthing went wong';
      $res['hash']= get_csrf_token()['hash'];
    }
    echo json_encode($res);
  } 
 
}//END OF CLASS
