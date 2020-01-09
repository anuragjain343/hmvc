<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recipes extends Common_Front_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();  
          
          $this->load->library('Ajax_pagination');
          $this->load->model('Recipe_model');
           $this->load->library('check_subscription');
    }
    
    function index(){
      //pr($_SESSION[USER_SESS_KEY]);
      $this->check_user_session();
     $data['title']="Recipe";
     $data['front_styles']= array('frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
     $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js');
     /*$userId = $_SESSION[USER_SESS_KEY]['userId']; 
     $where = array('id'=>$userId,'userRole'=>'user');
     $userData = $this->common_model->getsingle(USERS,$where);*/
     $res = $this->check_subscription->checkSsubscription();
     //pr($data);

     if(!empty($res)){
      $this->load->front_render('recipe',$data,'');
     }else{
      $data['pagetitle']='RECIPES';
       $this->load->front_render('defaultPage',$data,'');
     }
    }
    //END OF FUNCTION 

    // RECEPIE LIST  AJAX FUNCTION 
  function recipe_List(){
    $userId = $_SESSION[USER_SESS_KEY]['userId']; 
    $whereis = array('id'=>$userId,'userRole'=>'user');
    $userData = $this->common_model->getsingle(USERS,$whereis);
      
    if(!empty($userData->userPlan)){
      if($userData->userPlan=='level1' OR $userData->userPlan=='level2'){
        $type = array('addedBy'=>'admin');
      }else{
        $type ="(addedByid='$userData->assignTrainer' OR addedBy='admin')";
      }
    }

    $config['base_url']       = base_url()."home/recipes/recipe_List";
    $config['total_rows']     = !empty($_GET['id'])?$this->Recipe_model->recipeCount($type,$_GET['id']):$this->Recipe_model->recipeCount($type,$pe='');
    $config['uri_segment']    = 4;
    $config['per_page']       = 6;
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
//echo $config['total_rows'];

    //$data['recepieList'] = $this->Recepie_model->getAllRecepie($config['per_page'],$page,$gg='');

    $data=array();


    if(!empty($_GET['id'])){
      $respcat= $_GET['id'];
      $data['recipeList'] = $this->Recipe_model->getAllRecipe($config['per_page'],$page,$respcat,$type);
    }else{
      $respcat='0';
      $data['recipeList'] = $this->Recipe_model->getAllRecipe($config['per_page'],$page,$respcat,$type);
      
    }
    $this->ajax_pagination->initialize($config);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_recipe']= $config['total_rows'];
    $data['category']= $this->Recipe_model->getAllCategory();
    //pr($data);
    $rr= $this->load->view('get_recipe_list',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash'],'categoryId'=>$respcat));       
  }
  //END OF FUNCTION

    function recipeDetail(){
    $this->check_user_session();
    $data['front_styles']= array('frontend_assets/custom/css/front_custom.css');
    $data['front_js']= array('frontend_assets/custom/js/front_custom.js');
    $data['title']  = "Recipe Detail";
    $userId = $_SESSION[USER_SESS_KEY]['userId'];
      $recipeId = decoding($this->uri->segment(4));
      $wherecount = array('recepieId'=>$recipeId,'userId'=>$userId);
      $data['currentUserLike'] = $this->common_model->get_total_count(RECEPIELIKE,$wherecount);
      //$data['title']='Article Detail';
      $where= array('r.id'=>$recipeId);
      $whereis= array('recepieId'=>$recipeId);
      $data['recipeData'] = $this->Recipe_model->getRecipe($where);
      $data['recipeLike'] = $this->Recipe_model->getRecipeLike($recipeId);
      $data['recipeView'] = $this->common_model->get_total_count(RECEPIEVIEW, $whereis);
      $this->load->front_render('recipeDetail',$data,''); 
  }//END OF FUNCTION

  function recipeLike(){
    $this->check_user_session();
    $userId = $_SESSION[USER_SESS_KEY]['userId'];

    $recepieId = $_GET['id'];
    $where =array('recepieId'=>$recepieId,'userId'=>$userId);
    $check = $this->common_model->is_data_exists(RECEPIELIKE,$where);
    // $whereLikecount = array('id'=>$ansId);
      $whereis =array('recepieId'=>$recepieId);
    if(!empty($check)){
     $delete = $this->common_model->deleteData(RECEPIELIKE,$where);
     if($delete){
      $like = $this->common_model->get_total_count(RECEPIELIKE,$whereis);
      $res['html'] = '<div id="pasteRecLike">'.$like.' Likes</div>';
      $res['status'] = 0;
      //$res['likeCount'] = $totleLike;
      echo json_encode($res); die();
     }
    }else{
      $data['userId']   =  $userId;
      $data['recepieId']  =  $recepieId;
      $data['crd']      =  $data['upd'] = datetime();
      $response = $this->common_model->insertData(RECEPIELIKE,$data);
      if($response){
        $like = $this->common_model->get_total_count(RECEPIELIKE,$whereis);

        if($like > 1){
          $likeCount = $like-1;
          $likeThis = 'You and  '.$likeCount.' other like this';
        }else{
            $likeThis = 'You like this';
        }
        $res['html'] = $likeThis;
        $res['status'] = 1;
       // $res['likeCount'] = $totleLike;
        echo json_encode($res); die();
      }
    }
   }

//function for reciepe view
  function recipeView(){
    $this->check_user_session();
    $userId         = $_SESSION[USER_SESS_KEY]['userId'];
    $recipeId        = $_GET['id'];
    $where          = array('recepieId'=>$recipeId,'userId'=>$userId);
    $check          = $this->common_model->is_data_exists(RECEPIEVIEW,$where);
    if(!empty($check)){
      $res['status']  = 0;
      echo json_encode($res); die();
     }
    else{
      $data['userId']   =  $userId;
      $data['recepieId']  =  $recipeId;
      $data['crd']      =  $data['upd'] = datetime();
      $response         = $this->common_model->insertData(RECEPIEVIEW,$data);
      if($response){
        $res['status'] = 1;
        echo json_encode($res); die();
      }
    }
  }



   
}//END OF CLASS
