<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RecommendedProducts  extends Common_Front_Controller {

     public $data = "";

    function __construct() {
        parent::__construct();  
          $this->load->model('RecommendedProducts_model');
          $this->load->library('Ajax_pagination');
    }

    public function index(){
    $cate = decoding($_GET['id']);
  $data['front_styles']= array('frontend_assets/css/lightgallery.min.css','frontend_assets/js/toastr/toastr.min.css','frontend_assets/custom/css/front_custom.css');

      $data['front_js']= array('frontend_assets/js/toastr/toastr.min.js','frontend_assets/custom/js/jquery.validate.min.js','frontend_assets/custom/js/front_custom.js','frontend_assets/js/lightgallery-all.min.js');
    $data['title'] = 'Recommended Products Details';
    $data['catid']=  $cate;
    $this->load->front_render('RecommendedProductsDetails',$data,'');
    
    }
    
   

    function recommendedProductsDetail(){

     // pr('fd');
        $limit = 3;
        $is_next = 0;
        $offset = $this->input->post('offset');
        $articleid = $this->input->post('nId');
        //pr($articleid);
        $new_offset         = $limit+$offset;
        $data['limit']      = $limit;
       // pr($offset);
        $data['offset']     = $offset;
        $where              = array('categoryId'=>$articleid);
        $dataView['total_count']      = $this->RecommendedProducts_model->recommendedProductsCount($where);
        //pr($dataView['total_count']);
        $whereart              = array('categoryId'=>$articleid);
        $dataView['nutritionGuidanceData'] = $this->RecommendedProducts_model->getRecommendedProductsAll($limit,$offset,$whereart);
   
  
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
        $html_view = $this->load->view('recommendedProducts_List',$dataView,true);


        $response = array('status'=>1,'html_view'=>$html_view,'btn_html'=>$btn_html);
        $no_record=1;
        if(empty($dataView['nutritionGuidanceData'])){
            $no_record = 0;
        }

        $response['no_record'] = $no_record;
        $response['hasharticl']= get_csrf_token()['hash'];
         echo json_encode($response);die; 
        // $rr= $this->load->view('articleAnswer_List',$data,true);
        //echo json_encode(array('data'=>$rr));
    }
}

?>