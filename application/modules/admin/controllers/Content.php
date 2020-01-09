<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Content extends Common_Back_Controller {

    public $data = "";

  function __construct() {
    parent::__construct();
    $this->load->model('image_model');
    // $this->load->model('Notification_model');
    // $this->load->library('Ajax_pagination');
    if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    } 

  }//END OF CONSTRUCT
  function index(){
    $this->check_admin_user_session();
    $data['title']  = "ContentPage";

    $wher_content = array('contentName'=>'content');
    $banner_content = $this->common_model->getsingle(CONTENT, $wher_content, $fld = NULL, $order_by = '', $order = '');

    if(!empty($banner_content)){
    $data['banner_content'] = $banner_content;
    $this->load->admin_render('editContent',$data,'');  
    }else{
    $this->load->admin_render('addContent',$data,'');  
    }


  }//END OF FUNCTION

  function add_content(){
    $this->check_admin_user_session();
    $this->form_validation->set_rules('banner_title1', 'banner title1', 'trim|required');
    $this->form_validation->set_rules('banner_title2', 'banner title2', 'trim|required');
    $this->form_validation->set_rules('banner_title3', 'banner title3', 'trim|required');
    $this->form_validation->set_rules('banner_title4', 'banner title4', 'trim|required');
    $this->form_validation->set_rules('banner_title5', 'banner title5', 'trim|required');
    $this->form_validation->set_rules('about_subtitle', 'about subtitle','trim|required');
    $this->form_validation->set_rules('about_title', 'about title','trim|required');
    $this->form_validation->set_rules('about_info_title', 'about info title','trim|required');
    $this->form_validation->set_rules('about_info_description', 'about info description','trim|required');
    $this->form_validation->set_rules('video_title', 'video title','trim|required');
    $this->form_validation->set_rules('video_description', 'video description','trim|required');
    $this->form_validation->set_rules('video_slider_subtitle', 'video slider subtitle','trim|required');
    $this->form_validation->set_rules('video_slider_title', 'video slider title','trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    $wher_content = array('contentName'=>'content');
    $datas = $this->common_model->getsingle(CONTENT, $wher_content, $fld = NULL, $order_by = '', $order = '');
    if(!empty($datas)){ 
    $data = json_decode($datas->contentValue); 
    $bannerMultiple = $data->banner;
    $response_image1 = $bannerMultiple['0']->b_image;
    $response_image2 = $bannerMultiple['1']->b_image;
    $response_image3 = $bannerMultiple['2']->b_image;
    $response_image4 = $bannerMultiple['3']->b_image;
    $response_image5 = $bannerMultiple['4']->b_image;

    $about = $data->about;
    

    $about_image = $about->image;
    }

//banner images
    $newArray = array();
    if(!empty($_FILES['banner_image2']['name'])){ 
 
            $imageName = 'banner_image2';
            $folder =  "banner";
            $response_image2 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image2['error'])){
              $response = array('status' =>FAIL, 'msg' =>'banner_image2 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }     
      }

      

    if(!empty($_FILES['banner_image3']['name'])){
            $imageName = 'banner_image3';
            $folder =  "banner";
            $response_image3 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image3['error'])){
              $response = array('status' =>FAIL, 'msg' =>'banner_image3 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }
      }


    if(!empty($_FILES['banner_image4']['name'])){   

            $imageName = 'banner_image4';
            $folder =  "banner";
            $response_image4 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image4['error'])){
              $response = array('status' =>FAIL, 'msg' =>'banner_image4 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
      }
    if(!empty($_FILES['banner_image5']['name'])){   
            $imageName = 'banner_image5';
            $folder =  "banner";
            $response_image5 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image5['error'])){
              $response = array('status' =>FAIL, 'msg' =>'banner_image5 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }

      }

    if(!empty($_FILES['banner_image1']['name'])){   
            $imageName = 'banner_image1';
            $folder =  "banner";
            $response_image1 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image1['error'])){
              $response = array('status' =>FAIL, 'msg' =>'banner_image1 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }

      }

      //about image
      if(!empty($_FILES['about_image']['name'])){   
            $imageName = 'about_image';
            $folder =  "about";
            $about_image = $this->image_model->upload_image($imageName,$folder);
            if(!empty($about_image['error'])){
              $response = array('status' =>FAIL, 'msg' =>'about_image should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }
      }

    $array = array(

        'banner' => array(
                       array(
                            'b_title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('banner_title1')))),
                            'b_image'=>$response_image1
                          ),

                        array(
                            'b_title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('banner_title2')))),
                            'b_image'=>$response_image2
                          ),

                        array(
                            'b_title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('banner_title3')))),
                            'b_image'=>$response_image3
                          ),

                        array(
                            'b_title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('banner_title4')))),
                            'b_image'=>$response_image4
                          ),
                       array(

                            'b_title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('banner_title5')))),
                            'b_image'=>$response_image5
                      ),
                ),
        'about'=> array(
                    'subtitle'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('about_subtitle')))),
                    'title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('about_title')))),
                    'infotitle'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('about_info_title')))),
                    'infodesc'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('about_info_description')))),
                    'image'=>$about_image
                ),
        'video1'=> array(
                    'title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('video_title')))),
                    'desc'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('video_description')))),
                ),
        'video2'=> array(
                    'subtitle'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('video_slider_subtitle')))),
                    'title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('video_slider_title'))))
                ),
        'trainer'=> array(
                    'title'=>trim(preg_replace('/\s+/',' ', sanitize_input_text($this->input->post('trainer_title')))),
                ),
    );
    $newArray = json_encode($array);
      $dat['contentValue'] = $newArray;
      $wherecondition = array('contentName'=>'content');
      $update = $this->common_model->updateFields(CONTENT, $dat, $wherecondition);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'Content updated successfully.';
        $res['url'] = base_url().'admin/dashboard';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'already updated';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
       
  }
//END OF FUNCTION


}//END OF CLASS
?>