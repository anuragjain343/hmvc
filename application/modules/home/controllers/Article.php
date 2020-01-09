<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Common_Front_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();  
          $this->load->model('Article_model');
          $this->load->library('Ajax_pagination');
    }
    
    //INDEX FUNCTION TO LOAD LOGIN VIEW

    public function index(){
      //$this->check_user_session();
      $data['title']="Article";
      $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/lightgallery-all.min.js','frontend_assets/js/readmore.min.js','frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
      
      $this->load->front_render('allArticle',$data,'');
    
    }
    
    //END OF FUNCTION

  //INDEX FUNCTION TO LOAD LOGIN VIEW

   function articleList(){
    $orType='';
    if(!empty($_SESSION[USER_SESS_KEY]['userId'])){
      $uid                =$_SESSION[USER_SESS_KEY]['userId'];
      $where              = array('id'=>$uid,'userRole'=>'user');
      $checkAssignTrainr  = $this->common_model->getsingle(USERS, $where, $fld = NULL, $order_by = '', $order = '');
      if(!empty($checkAssignTrainr->assignTrainer)  AND $checkAssignTrainr->assignTrainer!=1){
        $type=array('addedBy'=>'trainer','addedById'=>$checkAssignTrainr->assignTrainer);
         //$orType= array('addedBy'=>'admin');
        $orType='';
      }else{
          $type=array('addedBy'=>'admin');
          $orType= '';
      }
    }else{
        $type=array('addedBy'=>'admin');
        $orType= '';
      
    }

    $config['base_url']         = base_url()."home/article/articleList"; 
    if(!empty($_POST['article'])){
      $search = $_POST['article'];
      $config['total_rows']     = $this->Article_model->articleCountBySeaching($search,$type,$orType);

    }else{  
    $config['total_rows']     = $this->Article_model->articleCount($type,$orType);
    }
    $config['uri_segment']    = 4;
    $config['per_page']       = 3;
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
    if(!empty($_POST['article'])){
      $search = $_POST['article'];
    $data['articalList']    = $this->Article_model->getAllArticleBySearch($config['per_page'],$page,$search,$type,$orType);
      //pr($data['articalList']);
    }else{
    $data['articalList'] = $this->Article_model->getAllArticle($config['per_page'],$page,$type,$orType);
    }
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_fourm']= $config['total_rows'];
    // pr($data['forumList']);
    $rr= $this->load->view('get_Article_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));   
   }
  // END OF FUNCTION
  //ARTICLE DETAIL PAGE LIST
    function articleDetailList(){
      $orType='';
      if(!empty($_SESSION[USER_SESS_KEY]['userId'])){
        $uid                =$_SESSION[USER_SESS_KEY]['userId'];
        $where              = array('id'=>$uid,'userRole'=>'user');
        $checkAssignTrainr  = $this->common_model->getsingle(USERS, $where, $fld = NULL, $order_by = '', $order = '');
         if(!empty($checkAssignTrainr->assignTrainer) AND $checkAssignTrainr->assignTrainer!=1){
           $type=array('addedBy'=>'trainer','addedById'=>$checkAssignTrainr->assignTrainer);
           $orType= '';
          }else{
             $type=array('addedBy'=>'admin');
          }
      }else{
        $type=array('addedBy'=>'admin');
      }

    $config['base_url']         = base_url()."home/article/articleDetailList"; 
    if(!empty($_POST['article'])){
      $search = $_POST['article'];
      $config['total_rows']    = $this->Article_model->articleCountBySeaching($search,$type,$orType);
    }else{  
    $config['total_rows']     = $this->Article_model->articleCount($type,$orType);
    }
    $config['uri_segment']    = 4;
    $config['per_page']       = 4;
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
    if(!empty($_POST['article'])){
      $search = $_POST['article'];
      $data['articalList']    = $this->Article_model->getAllArticleBySearch($config['per_page'],$page,$search,$type,$orType);
    }else{
    $data['articalList'] = $this->Article_model->getAllArticle($config['per_page'],$page,$type,$orType);
    
    }
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $rr= $this->load->view('get_allArticle_List',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));  
   
   }
  //END OF FUNCTION  

    function articleDetail(){
      $this->check_user_session();
        $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
           $data['front_js']= array('frontend_assets/js/lightgallery-all.min.js','frontend_assets/js/readmore.min.js','frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
      $articlid = decoding($this->uri->segment(4));
      $data['title']="Article Details";
      $where = array('ar.id'=>$articlid);
      $data['articalData'] = $this->Article_model->getArticle($where);
  
      $where              = array('id'=>$_SESSION[USER_SESS_KEY]['userId'],'userRole'=>'user');
      $checkAssignTrainr  = $this->common_model->getsingle(USERS, $where, $fld = NULL, $order_by = '', $order = '');
     // if($checkAssignTrainr->assignTrainer != $data['articalData']->addedById){
        //redirect('/');
     // }
      $wherecount = array('articleId'=>$articlid,'userId'=>$_SESSION[USER_SESS_KEY]['userId']);

      $currentusercount = $this->common_model->get_total_count(ARTICLELIKE,$wherecount);
      $data['currentUserLike']=$currentusercount;
      $viewcount = array('articleId'=>$articlid);
      $currentusercount = $this->common_model->get_total_count(ARTICLEVIEW,$viewcount);
      $data['articleViewCount']=$currentusercount;
      $answercount = array('articleId'=>$articlid);
      $articleAnswer = $this->common_model->get_total_count(ARTICLEANSWER,$viewcount);
      $data['articalAnswer']=$articleAnswer;
      $this->load->front_render('articleDetail',$data,'');


    }
  
    // ARTICLE ANSWER LIST  AJAX FUNCTION LOAD MORE
    function articleAnswer(){
        $limit = 3;
        $is_next = 0;
        $offset = $this->input->post('offset');
        $articleid = $this->input->post('articleId');
        $new_offset         = $limit+$offset;
        $data['limit']      = $limit;
        $data['offset']     = $offset;
        $where              = array('articleId'=>$articleid);
        $dataView['total_count']      = $this->Article_model->articleAnswerCount($where);
        $whereart              = array('ar.id'=>$articleid);
        $dataView['articalAnswerData'] = $this->Article_model->getArticleAnswerAll($limit,$offset,$whereart);
       // $dataView['forum_id'] = $forumId;
  
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
        $html_view = $this->load->view('articleAnswer_List',$dataView,true);

        $response = array('status'=>1,'html_view'=>$html_view,'btn_html'=>$btn_html);
        $no_record=1;
        if(empty($dataView['articalAnswerData'])){
            $no_record = 0;
        }

        $response['no_record'] = $no_record;
        $response['hasharticl']= get_csrf_token()['hash'];
         echo json_encode($response);die; 

        // $rr= $this->load->view('articleAnswer_List',$data,true);
        //echo json_encode(array('data'=>$rr));
    }

    function articleAnswerByUser(){
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
    $articleId    = sanitize_input_text($this->input->post('articleId'));

    $checkDisable = array('id'=>$articleId);
    $isDisable= $this->common_model->getsingle(ARTICLE,$checkDisable);
    if(!empty($isDisable)){
      if($isDisable->isDisableComment==1){
        $res['status'] = 0;
        $res['msg'] = 'Disabled By admin';
        $res['hash']= get_csrf_token()['hash'];
        echo json_encode($res);die();
      }
    }

    $data['articleId']   = $articleId;
    $data['answer']      =  $answer; 
    $data['answerBy']    =  $answerBy;
    $data['answerById']  =  $answerById;
    $data['crd'] =    $data['upd'] = datetime();

    $response = $this->common_model->insertData(ARTICLEANSWER,$data);
    if($response){
        $where = array('ara.id'=>$response,'ar.id'=>$articleId);
        $data['articalAnswerData'] = $this->Article_model->getArticleAnswer($where);
        $rr= $this->load->view('articleAnswer_List',$data,true);
        echo json_encode(array('view'=>$rr,'status'=>1)); die();
    }else{
      $res['status'] = 0;
      $res['msg'] = 'Somthing went wong';
      $res['hash']= get_csrf_token()['hash'];
    }
    echo json_encode($res);
  } 

      function articleLike(){
        $this->check_user_session();
        $userId = $_SESSION[USER_SESS_KEY]['userId'];
        $articleId = $_GET['id'];
        $where =array('articleId'=>$articleId,'userId'=>$userId);
        $check = $this->common_model->is_data_exists(ARTICLELIKE,$where);
        $whereLikecount = array('articleId'=>$articleId);
        if(!empty($check)){
        $delete = $this->common_model->deleteData(ARTICLELIKE,$where);
        if($delete){
        $totleLike = $this->common_model->get_total_count(ARTICLELIKE,$whereLikecount);
        $res['status'] = 0;
        $res['likeCount'] = $totleLike;
        $res['currentUserlikeCount'] = '0';
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
        $res['likeCount'] = $totleLike;
        $res['currentUserlikeCount'] = '1';
        echo json_encode($res); die();
        }
        }
      }
  // like article from listing
  function listingArticleLike(){
    $this->check_user_session();
    $userId = $_SESSION[USER_SESS_KEY]['userId'];
    $articleId = $this->input->get('id'); //$_GET['id'];
    $where =array('articleId'=>$articleId,'userId'=>$userId);
    $check = $this->common_model->is_data_exists(ARTICLELIKE,$where);
    $whereLikecount = array('articleId'=>$articleId);
    if(!empty($check)){
      $delete = $this->common_model->deleteData(ARTICLELIKE,$where);
      if($delete == true){
        $totleLike = $this->common_model->get_total_count(ARTICLELIKE,$whereLikecount);
        $res['status'] = 0;
        $res['likeCount'] = $totleLike;
        $res['currentUserlikeCount'] = '0';
        $res['articleId'] = $articleId;
        echo json_encode($res); die();
      }
    }else{
      $data['userId']   =  $userId;
      $data['articleId']  =  $articleId;
      $data['crd']      =  $data['upd'] = datetime();
      $response = $this->common_model->insertData(ARTICLELIKE,$data);
      if($response){
        $totleLike = $this->common_model->get_total_count(ARTICLELIKE,$whereLikecount);
        $res['status'] = 1;
        $res['likeCount'] = $totleLike;
        $res['currentUserlikeCount'] = '1';
        $res['articleId']= $articleId;
        echo json_encode($res); die();
      }
    }
  }

  function articleView(){
      $this->check_user_session();
      $userId         = $_SESSION[USER_SESS_KEY]['userId'];
      $articleId      = $_GET['id'];
      $where          = array('articleId'=>$articleId,'userId'=>$userId);
      $check          = $this->common_model->is_data_exists(ARTICLEVIEW,$where);
      if(!empty($check)){
        $res['status']  = 0;
        echo json_encode($res); die();
       }
      else{
        $data['userId']   =  $userId;
        $data['articleId']  =  $articleId;
        $data['crd']      =  $data['upd'] = datetime();
        $response         = $this->common_model->insertData(ARTICLEVIEW,$data);
        if($response){
          $res['status'] = 1;
          echo json_encode($res); die();
        }
      }
  }
  //END OF FUNCTION 
  function articleAnswerLike(){
    $this->check_user_session();
    $userId = $_SESSION[USER_SESS_KEY]['userId'];
    $articleId = $_GET['articleId'];
    $answerId = $_GET['answerId'];
    $where =array('articleId'=>$articleId,'userId'=>$userId,'answerId'=>$answerId);
    $check = $this->common_model->is_data_exists(ARTICLEANSWERLIKE,$where);
    $whereLikecount = array('articleId'=>$articleId,'answerId'=>$answerId);
    if(!empty($check)){
    $delete = $this->common_model->deleteData(ARTICLEANSWERLIKE,$where);
    if($delete){
    $totleLike = $this->common_model->get_total_count(ARTICLEANSWERLIKE,$whereLikecount);
    $res['status'] = 0;
    $res['likeCount'] = $totleLike;
    $res['currentUserLike'] = 0;
    echo json_encode($res); die();
    }
    }else{
    $data['articleId']  =  $articleId; 
    $data['answerId']   =  $answerId; 
    $data['userId']     =  $userId;
    $data['crd']      =  $data['upd'] = datetime();
    $response = $this->common_model->insertData(ARTICLEANSWERLIKE,$data);
    if($response){
    $totleLike = $this->common_model->get_total_count(ARTICLEANSWERLIKE,$whereLikecount);
    //pr($totleLike);
    $res['status'] = 1;
    $res['likeCount'] = $totleLike;
    $res['currentUserLike'] = 1;
    echo json_encode($res); die();
    }
    }
  }


   
}//END OF CLASS