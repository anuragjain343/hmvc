<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends Common_Front_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();
        $this->load->model('Training_model');  

    }
    public function index(){
         $data['front_styles']= array('frontend_assets/css/lightgallery.min.css','frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');
      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js','frontend_assets/js/lightgallery-all.min.js','https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js');
      if(!empty(decoding($_GET['catid']))){
        $catid = decoding($_GET['catid']);
        $where = array('categoryId'=>$catid);
        $data['catid'] = $catid;
      }else{
        $data['catid'] = '';
        $catid = '';
        $where = array();
      }
      $data['allData'] = $this->common_model->getAll(TRAINING, $order_fld = '', $order_type = '', $select = 'all', $limit = '', $offset = '',$group_by='',$where);
    	$data['title'] = 'Training Details';
    	$this->load->front_render('Training_detail_page',$data,'');
    
    }
    function training_post_list(){
      $limit = 3;
        $is_next = 0;
        $offset = $this->input->post('offset');
        $catid = $this->input->post('catid');
        $new_offset     = $limit+$offset;
        $data['limit']  = $limit;
        $data['offset'] = $offset;
        $where                        = array('categoryId'=>$catid);
         $dataView['total_count']     = $this->Training_model->trainingPostCount($where);
        $dataView['postList'] = $this->Training_model->getTrainingPost($limit,$offset,$where);
        $dataView['catid'] = $catid;

        if($dataView['total_count']>$new_offset){
            $is_next =1;  
        }
        $btn_html = '';
        if($is_next){
            $id = "btnLoadViewMe1";
           
            $btn_html   = '<center><div class="form-actions">
                  <button type="submit" class="btn btn-theme btn-bg-t mt-2 mb-2" id="'.$id.'" data-offset ="'.$new_offset.'" data-isNext ="'.$is_next.'">
                      See More
                          </button>
                      </div></center>';
        }
        //load view with data
        $html_view = $this->load->view('get_training_post',$dataView,true);

        $response = array('status'=>1,'html_view'=>$html_view,'btn_html'=>$btn_html);
        $no_record=1;
        if(empty($dataView['postList'])){
            $no_record = 0;
        }
        $response['no_record'] = $no_record;
        $response['hash']= get_csrf_token()['hash'];
         echo json_encode($response);die;
    }
}
?>