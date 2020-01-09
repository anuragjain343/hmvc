<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class RecommendedProducts extends Common_Back_Controller {

    public $data = "";

  function __construct() {
    parent::__construct();
    $this->load->model('RecommendedProducts_model');
    $this->load->model('image_model');
    $this->load->model('Pdf_model');
    $this->load->model('Media_upload_model');
    $this->load->library('Ajax_pagination');
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 

  }

  //INDEX FUNCTION TO LOAD FOURM LIST VIEW
  public function index(){
  $this->check_admin_user_session();
    
    if(!empty($_GET['categoryId'])){

      $categoryId = decoding($_GET['categoryId']);
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        if($categoryId==1){
           $data['title']  = "Trainer-Supplementation & Food";
        }else{
           $data['title']  = "Trainer-Discounts & offers";
        }
      }else{
        if($categoryId==1){
           $data['title']  = "Admin-Supplementation & Food";
        }else{
           $data['title']  = "Admin-Discounts & offers";
        }

      }
     // pr($categoryId);
      $data['categoryIdMenu'] = $categoryId;
    }

    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('preferredSuppliers',$data,''); 
  }
  //END OF FUNCTION



    // EXERCISE LIST  AJAX FUNCTION 
  function preferredSuppliers_list(){
    if(!empty($_POST['categoryIdMenu'])){
      $categoryIdMenu = $_POST['categoryIdMenu'];
      //pr($categoryIdMenu);
    }else{
      $categoryIdMenu = '';
    }
    $data['categoryIdMenu'] = $categoryIdMenu;
    $type='0';
    $config['base_url']       = base_url()."admin/RecommendedProducts/preferredSuppliers_list";
    $config['total_rows']     = $this->RecommendedProducts_model->preferredSuppliersCount($categoryIdMenu);
    //pr($config['total_rows']);
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
    $data['exerciseList'] = $this->RecommendedProducts_model->getAllPreferredSuppliers($config['per_page'],$page,$categoryIdMenu);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_article']= $config['total_rows'];
    $rr= $this->load->view('get_preferredSuppliers_list',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash']));       
  }
  //END OF FUNCTION

  function addRecommendedProducts(){
    $this->check_admin_user_session();
    if($_GET['catTrainId']){
    $data['getCatId'] = $_GET['catTrainId'];
    $cat = decoding($data['getCatId']);
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      if($cat==1){
           $data['title']  = "Trainer-Add Supplementation & Food";
        }else{
           $data['title']  = "Trainer-Add Discounts & offers";
        }
    }else{
      if($cat==1){
           $data['title']  = "Admin-Add Supplementation & Food";
        }else{
           $data['title']  = "Admin-Add Discounts & offers";
        }
    }
    }else{
      $data['getCatId'] = '';
    }
   
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $data['categoryList'] = $this->common_model->getAll(RECOMMENDEDPRODUCTSCATEGORIES);
    $this->load->admin_render('addPreferredSuppliers',$data,''); 
  }
  //END OF FUNCTION

  function add_PreferredSuppliers(){
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $categoryId = sanitize_input_text($this->input->post('category_name'));
    $title = sanitize_input_text($this->input->post('title'));
    //$where =array('categoryId'=>$categoryId,'addedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $where =array('categoryId'=>$categoryId);
    $check = $this->common_model->is_data_exists(RECOMMENDEDPRODUCTS,$where);
    if(!empty($check)){
      $response = array('status' =>FAIL, 'msg' =>'Already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
    }
    $newArray = array();
    $videoArray = array();
    $newArrayVideoThumb = array();
    //for pdf
    if(!empty($_FILES['edit-pdf']['name'])){ 
 
            $imageName = 'edit-pdf';
            $folder =  "RecommendedProducts_pdf";
            $pdf = $this->Pdf_model->upload_image($imageName,$folder);
            if(!empty($pdf['error'])){
              $response = array('status' =>FAIL, 'msg' =>'pdf select a valid file type ','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            $data['pdf'] = $pdf['image_name'];   
      }
      //for picture
      if(!empty($_FILES['edit-img1']['name'])){ 
 
            $imageName = 'edit-img1';
            $folder =  "RecommendedProducts";
            $image1 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image1['error'])){
              $response = array('status' =>-1, 'msg' =>'image 1 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image1);   
      }
      if(!empty($_FILES['edit-img2']['name'])){ 
 
            $imageName = 'edit-img2';
            $folder =  "RecommendedProducts";
            $image2 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image2['error'])){
              $response = array('status' =>-1, 'msg' =>'image 2 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image2);   
      }
      if(!empty($_FILES['edit-img3']['name'])){ 
 
            $imageName = 'edit-img3';
            $folder =  "RecommendedProducts";
            $image3 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image3['error'])){
              $response = array('status' =>-1, 'msg' =>'image 3 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image3);   
      }
      if(!empty($_FILES['edit-img4']['name'])){ 
 
            $imageName = 'edit-img4';
            $folder =  "RecommendedProducts";
            $image4 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image4['error'])){
              $response = array('status' =>-1, 'msg' =>'image 4 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image4);   
      }
      if(!empty($_FILES['edit-img5']['name'])){ 
 
            $imageName = 'edit-img5';
            $folder =  "RecommendedProducts";
            $image5 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image5['error'])){
              $response = array('status' =>-1, 'msg' =>'image 5 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image5);   
      }
//for video insert
      if(!empty($_FILES['edit-video1']['name'])){ 
 
            $video = 'edit-video1';
            $folder =  "RecommendedProducts_video";
            $video1 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video1['error'])){
              $response = array('status' =>FAIL, 'msg' =>'video1 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video1);   
      }
      if(!empty($_FILES['edit-video2']['name'])){ 
 
            $video = 'edit-video2';
            $folder =  "RecommendedProducts_video";
            $video2 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video2['error'])){
              $response = array('status' =>FAIL, 'msg' =>'video2 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video2);   
      }
      if(!empty($_FILES['edit-video3']['name'])){ 
 
            $video = 'edit-video3';
            $folder =  "RecommendedProducts_video";
            $video3 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video3['error'])){
              $response = array('status' =>FAIL, 'msg' =>'video3 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video3);   
      }
      if(!empty($_FILES['edit-video4']['name'])){ 
 
            $video = 'edit-video4';
            $folder =  "RecommendedProducts_video";
            $video4 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video4['error'])){
              $response = array('status' =>FAIL, 'msg' =>'video4 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video4);   
      }
      if(!empty($_FILES['edit-video5']['name'])){ 
 
            $video = 'edit-video5';
            $folder =  "RecommendedProducts_video";
            $video5 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video5['error'])){
              $response = array('status' =>FAIL, 'msg' =>'video5 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video5);   
      }

      //for video thumb
      if(!empty($_FILES['edit-video1']['name'])){
        if(!empty($_FILES['videoThumb1']['name'])){
          $_FILES['videoThumb1']['name'] = 'vthumb1.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result1 = $this->image_model->upload_image('videoThumb1', $folder);
          if (is_array($result1) && array_key_exists('error', $result1)){
            $response = array('status' => FAIL,'msg' => strip_tags($result9['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result1);
          } 
        }
       }

       if(!empty($_FILES['edit-video2']['name'])){
        if(!empty($_FILES['videoThumb2']['name'])){
          $_FILES['videoThumb2']['name'] = 'vthumb2.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result2 = $this->image_model->upload_image('videoThumb2', $folder);
          if (is_array($result2) && array_key_exists('error', $result2)){
            $response = array('status' => FAIL,'msg' => strip_tags($result2['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result2);
          } 
        }
       }

       if(!empty($_FILES['edit-video3']['name'])){
        if(!empty($_FILES['videoThumb3']['name'])){
          $_FILES['videoThumb3']['name'] = 'vthumb3.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result3 = $this->image_model->upload_image('videoThumb3', $folder);
          if (is_array($result3) && array_key_exists('error', $result3)){
            $response = array('status' => FAIL,'msg' => strip_tags($result3['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result3);
          } 
        }
       }

       if(!empty($_FILES['edit-video4']['name'])){
        if(!empty($_FILES['videoThumb4']['name'])){
          $_FILES['videoThumb4']['name'] = 'vthumb4.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result4 = $this->image_model->upload_image('videoThumb4', $folder);
          if (is_array($result4) && array_key_exists('error', $result4)){
            $response = array('status' => FAIL,'msg' => strip_tags($result4['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result4);
          } 
        }
       }

       if(!empty($_FILES['edit-video5']['name'])){
        if(!empty($_FILES['videoThumb5']['name'])){
          $_FILES['videoThumb5']['name'] = 'vthumb5.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result5 = $this->image_model->upload_image('videoThumb5', $folder);
          if (is_array($result5) && array_key_exists('error', $result5)){
            $response = array('status' => FAIL,'msg' => strip_tags($result5['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result5);
          } 
        }
       } 


      //check for if any image is not selected
      if(empty($newArray)){
        $response = array('status' =>FAIL, 'msg' =>'Please select at least one image','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;

      }

      $videoThumbInsert = json_encode($newArrayVideoThumb);
      $videoInsert = json_encode($videoArray);
      $imageInsert = json_encode($newArray);

      $data['videoThumb']     = $videoThumbInsert;
      $data['image']          = $imageInsert;
      $data['video']          = $videoInsert;
      $data['title']          = sanitize_input_text($this->input->post('title'));
      $data['categoryId']     = sanitize_input_text($this->input->post('category_name'));
      //$disp = trim(preg_replace('/\s+/',' ', $this->input->post('description')));
      $disp = trim(preg_replace('/\s+/',' ', $this->input->post('desc')));
      $data['description']    = sanitize_input_text($disp);
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        //recommendedProducts/preferredSuppliers?categoryId=eNrLtDK0BlwwAvMBEA..
        $res['url']           = base_url()."admin/recommendedProducts/edit_recommendedProducts?id". encoding($this->input->post('category_name'));
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url()."admin/recommendedProducts/edit_recommendedProducts?id". encoding($this->input->post('category_name'));
      }
      $data['crd'] =    $data['upd'] = datetime();
      $responseInsertion = $this->common_model->insertData(RECOMMENDEDPRODUCTS,$data);

      if($responseInsertion){
        $res['status'] = 1;
        $res['msg'] = 'Recommended Products added successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);

  }

  function recommendedProducts_detail(){

    $this->check_admin_user_session();
    $trainingId = decoding($this->uri->segment(4));

    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      
           $data['title']  = "Trainer-Recommended Products Details";
      
    }else{
     
      $data['title']  = "Admin-Recommended Products Details";
    
    }
    $where= array('t.id'=>$trainingId);
    $data['trainingData'] = $this->RecommendedProducts_model->getPreferredSuppliers($where);
    $this->load->admin_render('preferredSuppliersDetail',$data,''); 
    }




  function delete_recommendedProducts(){
    $this->check_admin_user_session();
      $id = $_GET['id'];
      $table = RECOMMENDEDPRODUCTS;
      $where = array('id'=>$id);
      $whereDelete = array('id'=>$id);
      $exists = $this->common_model->is_data_exists($table,$whereDelete);
      if(!empty($exists)){
        $categoryId = encoding($exists->categoryId);
      }else{
        $categoryId = '';
      }
      $delete = $this->common_model->deleteData($table,$whereDelete);

      if($this->db->affected_rows() > 0){
        $this->load->model('image_model');
        $data=array('status'=>1,'message'=>'Deleted successfully','url'=>base_url()."admin/recommendedProducts?categoryId=".$categoryId);
      }else{
        $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
     
      }  

        echo json_encode($data);

  }//END OF FUNCTION

  //EDIT  TRAINING VIEW LOAD
  function edit_recommendedProducts(){

    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $is_data_exists['title']  = "Trainer-Edit Recommended Products";
    }else{
      $is_data_exists['title']  = "Admin-Edit Recommended Products";
    }
    $id = decoding($_GET['id']);
    $where = array('id'=>$id);
    $is_data_exists['data'] = $this->common_model->is_data_exists(RECOMMENDEDPRODUCTS,$where);
    $is_data_exists['categoryList'] = $this->common_model->getAll(RECOMMENDEDPRODUCTSCATEGORIES);
    if(!empty($is_data_exists['data'])){
      $this->load->admin_render('editRecommendedProducts',$is_data_exists,'');
    }else{
      $this->load->admin_render('addPreferredSuppliers','');
    }   
  }
//END OF FUNCTION 

  //UPDATE FUNCTION START
  function editRecommendedProducts(){
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    //-----------------------------------------------------------------------------------
    //get data which are already exist
    $trainingId = $this->input->post('trainingId');
    $whereId = array('id'=>$trainingId);
    $existData = $this->common_model->is_data_exists(RECOMMENDEDPRODUCTS,$whereId);
  
    $categoryId = $existData->categoryId;
    $title = sanitize_input_text($this->input->post('title'));
    $whereCheck =array('title'=>$title,'id !='=>$trainingId,'categoryId'=>$categoryId);
    $check=$this->common_model->is_data_exists(TRAINING,$whereCheck);

     $wherecheck = array('postId'=>$categoryId,'refrenceTable'=>RECOMMENDEDPRODUCTS);
      $check2 = $this->common_model->is_data_exists('postRevision',$wherecheck);
      if(!empty($check2)){
        $deleteArticle = $this->common_model->deleteData('postRevision',$wherecheck);
       }
    
    if(!empty($check)){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
    }

    $newArray = array();
    $videoArray = array();
    $newArrayVideoThumb = array();
    //for pdf
    if(!empty($_FILES['edit-pdf']['name'])){ 
 
            $imageName = 'edit-pdf';
            $folder =  "RecommendedProducts_pdf";
            $pdf = $this->Pdf_model->upload_image($imageName,$folder);
            if(!empty($pdf['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Please select a valid file type ','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            $data['pdf'] = $pdf['image_name'];   
      }




      $data['videoThumb']     = '';
      $data['image']          = '';
      $data['video']          = '';
      $data['title']          = sanitize_input_text($this->input->post('title'));
      $data['categoryId']     = sanitize_input_text($this->input->post('category_name'));
      //pr(sanitize_input_text($this->input->post('category_name')));
     // $disp = trim(preg_replace('/\s+/',' ', $this->input->post('desc')));
      $disp = $this->input->post('desc');
      $data['description']    = $disp;
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url()."admin/recommendedProducts/edit_recommendedProducts?id=". encoding(sanitize_input_text($this->input->post('category_name')));
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url()."admin/recommendedProducts/edit_recommendedProducts?id=". encoding(sanitize_input_text($this->input->post('category_name')));
      }
      $data['crd'] =    $data['upd'] = datetime();
      $whereUpadate = array('id'=>$trainingId);
      $responseUpdate = $this->common_model->updateFields(RECOMMENDEDPRODUCTS, $data, $whereUpadate);

      if($responseUpdate){
        $res['status'] = 1;
        $res['msg'] = 'Recommended Products update successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
  }
  //END OF FUNCTION
  function editRecommendedProducts_v1(){
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    //-----------------------------------------------------------------------------------
    //get data which are already exist
    $trainingId = $this->input->post('trainingId');
    $whereId = array('id'=>$trainingId);
    $existData = $this->common_model->is_data_exists(RECOMMENDEDPRODUCTS,$whereId);
    if(!empty($existData)){
      //image data
      $image_set = json_decode($existData->image);
      !empty($image_set[0])?$imagev1 = $image_set[0]:$imagev1='';
      !empty($image_set[1])?$imagev2 = $image_set[1]:$imagev2='';
      !empty($image_set[2])?$imagev3 = $image_set[2]:$imagev3='';
      !empty($image_set[3])?$imagev4 = $image_set[3]:$imagev4='';
      !empty($image_set[4])?$imagev5 = $image_set[4]:$imagev5='';

      //video data
      $video_set = json_decode($existData->video);
      !empty($video_set[0])?$videov1 = $video_set[0]:$videov1='';
      !empty($video_set[1])?$videov2 = $video_set[1]:$videov2='';
      !empty($video_set[2])?$videov3 = $video_set[2]:$videov3='';
      !empty($video_set[3])?$videov4 = $video_set[3]:$videov4='';
      !empty($video_set[4])?$videov5 = $video_set[4]:$videov5='';

      //for thumb image
      $videoThumb_set = json_decode($existData->videoThumb);
      !empty($videoThumb_set[0])?$videovt1 = $videoThumb_set[0]:$videovt1='';
      !empty($videoThumb_set[1])?$videovt2 = $videoThumb_set[1]:$videovt2='';
      !empty($videoThumb_set[2])?$videovt3 = $videoThumb_set[2]:$videovt3='';
      !empty($videoThumb_set[3])?$videovt4 = $videoThumb_set[3]:$videovt4='';
      !empty($videoThumb_set[4])?$videovt5 = $videoThumb_set[4]:$videovt5='';
    }

    //------------------------------------------------------------------------------------
    //check if title exist or not
    $categoryId = $existData->categoryId;
    $title = sanitize_input_text($this->input->post('title'));
    $whereCheck =array('title'=>$title,'id !='=>$trainingId,'categoryId'=>$categoryId);
    $check=$this->common_model->is_data_exists(TRAINING,$whereCheck);
    if(!empty($check)){
      $response = array('status' =>FAIL, 'msg' =>'Title already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
    }

    $newArray = array();
    $videoArray = array();
    $newArrayVideoThumb = array();
    //for pdf
    if(!empty($_FILES['edit-pdf']['name'])){ 
 
            $imageName = 'edit-pdf';
            $folder =  "RecommendedProducts_pdf";
            $pdf = $this->Pdf_model->upload_image($imageName,$folder);
            if(!empty($pdf['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Please select a valid file type ','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            $data['pdf'] = $pdf['image_name'];   
      }
      //for picture
      if(!empty($_FILES['edit-img1']['name'])){ 
 
            $imageName = 'edit-img1';
            $folder =  "RecommendedProducts";
            $image1 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image1['error'])){
              $response = array('status' =>-1, 'msg' =>'Image 1 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image1);   
      }else{
        if(!empty($this->input->post('slag1'))){
          $imagev1 = '';
        }
        array_push($newArray,$imagev1);
      }

      if(!empty($_FILES['edit-img2']['name'])){ 
 
            $imageName = 'edit-img2';
            $folder =  "RecommendedProducts";
            $image2 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image2['error'])){
              $response = array('status' =>-1, 'msg' =>'Image 2 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image2);   
      }else{
        if(!empty($this->input->post('slag2'))){
          $imagev2 = '';
        }
        array_push($newArray,$imagev2);
      }

      if(!empty($_FILES['edit-img3']['name'])){ 
 
            $imageName = 'edit-img3';
            $folder =  "RecommendedProducts";
            $image3 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image3['error'])){
              $response = array('status' =>-1, 'msg' =>'Image 3 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image3);   
      }else{
        if(!empty($this->input->post('slag3'))){
          $imagev3 = '';
        }
        array_push($newArray,$imagev3);
      }

      if(!empty($_FILES['edit-img4']['name'])){ 
 
            $imageName = 'edit-img4';
            $folder =  "RecommendedProducts";
            $image4 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image4['error'])){
              $response = array('status' =>-1, 'msg' =>'Image 4 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image4);   
      }else{
        if(!empty($this->input->post('slag4'))){
          $imagev4 = '';
        }
        array_push($newArray,$imagev4);
      }

      if(!empty($_FILES['edit-img5']['name'])){ 
 
            $imageName = 'edit-img5';
            $folder =  "RecommendedProducts";
            $image5 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($image5['error'])){
              $response = array('status' =>-1, 'msg' =>'Image 5 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($newArray,$image5);   
      }else{
        if(!empty($this->input->post('slag5'))){
          $imagev5 = '';
        }
        array_push($newArray,$imagev5);
      }
//for video insert
      if(!empty($_FILES['edit-video1']['name'])){ 
 
            $video = 'edit-video1';
            $folder =  "RecommendedProducts_video";
            $video1 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video1['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Video1 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video1);   
      }else{
        //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag1'))){
          $videov1 = '';
        }
        array_push($videoArray,$videov1);
        //to unset the particular array
        // if(!empty($this->input->post('flag1'))){
        //  unset($videoArray[0]);
        // }
      }

      if(!empty($_FILES['edit-video2']['name'])){ 
 
            $video = 'edit-video2';
            $folder =  "RecommendedProducts_video";
            $video2 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video2['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Video2 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video2);   
      }else{
        //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag2'))){
          $videov2 = '';
        }
        array_push($videoArray,$videov2);
      }
      if(!empty($_FILES['edit-video3']['name'])){ 
 
            $video = 'edit-video3';
            $folder =  "RecommendedProducts_video";
            $video3 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video3['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Video3 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video3);   
      }else{
        //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag3'))){
          $videov3 = '';
        }
        array_push($videoArray,$videov3);
      }

      if(!empty($_FILES['edit-video4']['name'])){ 
 
            $video = 'edit-video4';
            $folder =  "RecommendedProducts_video";
            $video4 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video4['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Video4 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video4);   
      }else{
        //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag4'))){
          $videov4 = '';
        }
        array_push($videoArray,$videov4);
      }

      if(!empty($_FILES['edit-video5']['name'])){ 
 
            $video = 'edit-video5';
            $folder =  "RecommendedProducts_video";
            $video5 = $this->Media_upload_model->upload_video($video, $folder );
            if(!empty($video5['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Video5 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            array_push($videoArray,$video5);   
      }else{
        //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag5'))){
          $videov5 = '';
        }
        array_push($videoArray,$videov5);
      }

      //for video thumb
      if(!empty($_FILES['edit-video1']['name'])){
        
          $_FILES['videoThumb1']['name'] = 'vthumb1.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result1 = $this->image_model->upload_image('videoThumb1', $folder);
          if (is_array($result1) && array_key_exists('error', $result1)){
            $response = array('status' => FAIL,'msg' => strip_tags($result9['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result1);
          } 
        }else{
          //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag1'))){
          $videovt1 = '';
        }
        array_push($newArrayVideoThumb,$videovt1);
        }
      

       if(!empty($_FILES['edit-video2']['name'])){
       
          $_FILES['videoThumb2']['name'] = 'vthumb2.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result2 = $this->image_model->upload_image('videoThumb2', $folder);
          if (is_array($result2) && array_key_exists('error', $result2)){
            $response = array('status' => FAIL,'msg' => strip_tags($result2['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result2);
          } 
        }else{
          //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag2'))){
          $videovt2 = '';
        }
        array_push($newArrayVideoThumb,$videovt2);
        }
     

       if(!empty($_FILES['edit-video3']['name'])){
        
          $_FILES['videoThumb3']['name'] = 'vthumb3.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result3 = $this->image_model->upload_image('videoThumb3', $folder);
          if (is_array($result3) && array_key_exists('error', $result3)){
            $response = array('status' => FAIL,'msg' => strip_tags($result3['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result3);
          } 
        }else{
          //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag3'))){
          $videovt3 = '';
        }
        array_push($newArrayVideoThumb,$videovt3);
        }
      

       if(!empty($_FILES['edit-video4']['name'])){
       
          $_FILES['videoThumb4']['name'] = 'vthumb4.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result4 = $this->image_model->upload_image('videoThumb4', $folder);
          if (is_array($result4) && array_key_exists('error', $result4)){
            $response = array('status' => FAIL,'msg' => strip_tags($result4['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result4);
          } 
        }else{
          //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag4'))){
          $videovt4 = '';
        }
        array_push($newArrayVideoThumb,$videovt4);
        }
      
       if(!empty($_FILES['edit-video5']['name'])){
       
          $_FILES['videoThumb5']['name'] = 'vthumb5.png';
          $folder = 'RecommendedProducts_video_thumb'; //Set folder for upload profile image 
          $result5 = $this->image_model->upload_image('videoThumb5', $folder);
          if (is_array($result5) && array_key_exists('error', $result5)){
            $response = array('status' => FAIL,'msg' => strip_tags($result5['error']),'hash'=> get_csrf_token()['hash']);
            echo json_encode($response); die();
          }else{
            array_push($newArrayVideoThumb,$result5);
          } 
        }else{
          //its conditione done when click on delete icon 
        if(!empty($this->input->post('flag5'))){
          $videovt5 = '';
        }
        array_push($newArrayVideoThumb,$videovt5);
        }
       


      //check for if any image is not selected
      if($newArray[0]=='' AND $newArray[1]=='' AND  $newArray[2]=='' AND  $newArray[3]=='' AND  $newArray[4]==''){
        $response = array('status' =>FAIL, 'msg' =>'Please select at least one image','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;

      }

      $videoThumbInsert = json_encode($newArrayVideoThumb);
      $videoInsert = json_encode($videoArray);
      $imageInsert = json_encode($newArray);

      $data['videoThumb']     = $videoThumbInsert;
      $data['image']          = $imageInsert;
      $data['video']          = $videoInsert;
      $data['title']          = sanitize_input_text($this->input->post('title'));
      $data['categoryId']     = sanitize_input_text($this->input->post('category_name'));
      //pr(sanitize_input_text($this->input->post('category_name')));
      $disp = trim(preg_replace('/\s+/',' ', $this->input->post('desc')));
      $data['description']    = sanitize_input_text($disp);
      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url()."admin/recommendedProducts/edit_recommendedProducts?id=". encoding(sanitize_input_text($this->input->post('category_name')));
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        $res['url']           = base_url()."admin/recommendedProducts/edit_recommendedProducts?id=". encoding(sanitize_input_text($this->input->post('category_name')));
      }
      $data['crd'] =    $data['upd'] = datetime();
      $whereUpadate = array('id'=>$trainingId);
      $responseUpdate = $this->common_model->updateFields(RECOMMENDEDPRODUCTS, $data, $whereUpadate);

      if($responseUpdate){
        $res['status'] = 1;
        $res['msg'] = 'Recommended Products update successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
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
   }

  //END OF FUNCTION
      function deletePdf(){
     $pdgname= $this->input->get('pdfName'); 
     $cat= $this->input->get('cat'); 
     $whe = array('pdf'=>$pdgname,'categoryId'=>$cat);
     $check = $this->common_model->is_data_exists(RECOMMENDEDPRODUCTS,$whe);
     if($check){
      $data['pdf']='';
      $where =array('categoryId'=>$cat);
      $upd = $this->common_model->updateFields(RECOMMENDEDPRODUCTS,$data,$where);
      $response = array('status' =>1, 'msg' =>'Pdf Deleted successfully');  
      echo json_encode($response); die; 
      //return false;
    }
   }
     function checkutritionGuidanceId(){
      if(!empty($_POST['articlearticle'])){

      $articleId = $_POST['articlearticle'];
      $where =array('postId'=>$articleId,'refrenceTable'=>'recommendedProducts');
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'recommendedProducts');
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'recommendedProducts');
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

    function editNutritionGuidance1(){
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
    $description = $this->input->post('description');
    $where =array('postId'=>$articleId,'refrenceTable'=>'recommendedProducts'); 
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
      $data['upd'] = datetime();
      $where =array('postId'=>$articleId,'refrenceTable'=>'recommendedProducts'); 
      $update = $this->common_model->updateFields('postRevision',$data,$where);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'Nutritionguidance updated successfully.';
        $res['url'] = base_url().'admin/article';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
      return false;
    }else{
     
      $data['addedBy']        ='admin';
      $data['addedById']      = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
      $data['title']            = $title;
      $data['description']      = $description;
      $data['postId']           = $articleId; 
      $data['isDisableComment'] = 0;
      $data['postStatus']       = 0;
      $data['refrenceTable']    = 'recommendedProducts';
      $data['crd'] =$data['upd'] = datetime();
      $update = $this->common_model->insertData('postRevision',$data);
      if($update){
        $res['status']  = 1;
        $res['msg']     = 'Nutritionguidance updated successfully.';
        $res['url']     = base_url().'admin/article';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }   
  }

}
?>