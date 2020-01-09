<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class NutritionGuidance extends Common_Back_Controller {

    public $data = "";

  function __construct() {
 
    parent::__construct();
    $this->load->model('Media_upload_model');
    $this->load->model('image_model');
    $this->load->model('NutritionGuidance_model');
    $this->load->library('Ajax_pagination');
    $this->load->model('Pdf_model');

      if($_SESSION[ADMIN_USER_SESS_KEY]['allPrivileges']=='0' AND $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        redirect('admin/trainers/specialTrainerDeshboard');
    }
  }

  function index(){
    $data['title']='How Does MyVegan Trainer Diet Works';
    $where='';
    $data['catid']=1;
    $data['cat']= $this->common_model->getAll(NURRITIONGUIDANCECATEGORY,$where);
    $this->load->admin_render('addNutritionGuidance',$data);
  }

  function addProtein(){
    $data['title']='Protein';
    $where='';
     $data['catid']=2;
    $data['cat']= $this->common_model->getAll(NURRITIONGUIDANCECATEGORY,$where);
    $this->load->admin_render('addNutritionGuidance',$data);
  }

  function addFluids(){
    $data['title']='Admin - Add fluids';
    $where='';
     $data['catid']=7;
    $data['cat']= $this->common_model->getAll(NURRITIONGUIDANCECATEGORY,$where);
    $this->load->admin_render('addNutritionGuidance',$data);
  }


  function addSupplements(){
     $data['title']='Add Supplements';
   
    $where='';
     $data['catid']=3;
    $data['cat']= $this->common_model->getAll(NURRITIONGUIDANCECATEGORY,$where);
    $this->load->admin_render('addNutritionGuidance',$data);
  }

  function addMacroTracking(){
    $data['title']='Add MacroTracking';
    $where='';
    $data['catid']=4;
    $data['cat']= $this->common_model->getAll(NURRITIONGUIDANCECATEGORY,$where);
    $this->load->admin_render('addNutritionGuidance',$data);
  }

  function addDigestiveDisorders(){
    $data['title']='Add Digestive Disorders';
    $where='';
    $data['catid']=5;
    $data['cat']= $this->common_model->getAll(NURRITIONGUIDANCECATEGORY,$where);
    $this->load->admin_render('addNutritionGuidance',$data);
  }

  function addSpecialDietaryRequirements(){
    $data['title']='Add Special Dietary Requirements';
    $where='';
    $data['catid']=6;
    $data['cat']= $this->common_model->getAll(NURRITIONGUIDANCECATEGORY,$where);
    $this->load->admin_render('addNutritionGuidance',$data);
  }

  function add_NutritionGuidance(){
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    //$this->form_validation->set_rules('description', 'Description', 'trim|required');
    $this->form_validation->set_rules('slectNurti', 'Category name', 'trim|required');

    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    if(empty($_FILES['nutru_image1']['name']) AND empty($_FILES['nutru_image2']['name']) AND empty($_FILES['nutru_image3']['name']) AND empty($_FILES['nutru_image4']['name']) AND empty($_FILES['nutru_image5']['name'])){
      $response = array('status' =>'-1', 'msg' =>'Please select atlest one image','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
    }
    $titl = sanitize_input_text($this->input->post('title'));
    $cId= $this->input->post('slectNurti');
    //$whe = array('categoryId'=>$cId,'addedById'=>$_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $whe = array('categoryId'=>$cId);
    $check = $this->common_model->is_data_exists(NURRITIONGUIDANCE,$whe);
    if($check){
      $response = array('status' =>FAIL, 'msg' =>'already exists','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die; 
      return false;
    }
    $newArray = array();
    if(!empty($_FILES['nutru_image1']['name'])){ 
            $imageName = 'nutru_image1';
            $folder =  "NutritionGuidance";
            $response_image1 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image1['error'])){
              $response = array('status' =>'-1', 'msg' =>'banner_image1 should be proper in size','hash'=> get_csrf_token()['hash'],'nutru_image'=>'nutru_image1');  
            echo json_encode($response); die;
            }
           $dataImge = array_push($newArray,$response_image1);     
    }
    if(!empty($_FILES['nutru_image2']['name'])){ 
            $imageName = 'nutru_image2';
            $folder =  "NutritionGuidance";
            $response_image2 = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response_image2['error'])){
              $response = array('status' =>'-1', 'msg' =>'banner_image2 should be proper in size','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }
           $dataImge = array_push($newArray,$response_image2);     
    }
    if(!empty($_FILES['nutru_image3']['name'])){ 
      $imageName = 'nutru_image3';
      $folder =  "NutritionGuidance";
      $response_image3 = $this->image_model->upload_image($imageName,$folder);
      if(!empty($response_image3['error'])){
        $response = array('status' =>'-1', 'msg' =>'banner_image3 should be proper in size','hash'=> get_csrf_token()['hash']);  
        echo json_encode($response); die;
      }
      $dataImge = array_push($newArray,$response_image3);     
    }
    if(!empty($_FILES['nutru_image4']['name'])){ 
      $imageName = 'nutru_image4';
      $folder =  "NutritionGuidance";
      $response_image4 = $this->image_model->upload_image($imageName,$folder);
      if(!empty($response_image4['error'])){
        $response = array('status' =>'-1', 'msg' =>'banner_image4 should be proper in size','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die;
      }
     $dataImge = array_push($newArray,$response_image4);     
    }
    if(!empty($_FILES['nutru_image5']['name'])){ 
      $imageName = 'nutru_image5';
      $folder =  "NutritionGuidance";
      $response_image5 = $this->image_model->upload_image($imageName,$folder);
      if(!empty($response_image5['error'])){
        $response = array('status' =>'-1', 'msg' =>'banner_image5 should be proper in size','hash'=> get_csrf_token()['hash']);  
      echo json_encode($response); die;
      }
     $dataImge = array_push($newArray,$response_image5);     
    }  
     //$dataimg = json_encode($newArray);
     /*video*/
      $newArrayVideo = array();
      $newArrayVideoThumb = array();
    if(!empty($_FILES['Video1']['name'])){
      $folder = 'NutritionGuidanceVideo'; //Set folder for upload  profile image   
      $result11 = $this->Media_upload_model->upload_video('Video1', $folder);
      if (is_array($result11) && array_key_exists('error',$result11)){
        $response = array('status' => FAIL,'msg' => strip_tags($result11['error']),'hash'=> get_csrf_token()['hash']);
         echo json_encode($response); exit;
      }else{
        array_push($newArrayVideo,$result11);
      }   
    }
      
    if(!empty($_FILES['videoThumb']['name'])){
      $_FILES['videoThumb']['name'] = 'vthumb1.png';
      $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
      $result = $this->image_model->upload_image('videoThumb', $folder);
      if (is_array($result) && array_key_exists('error', $result)){
        $response = array('status' => FAIL,'msg' => strip_tags($result['error']),'hash'=> get_csrf_token()['hash']);
          echo json_encode($response); exit;
      }else{
         array_push($newArrayVideoThumb,$result);
      } 
    }
    /*2*/
    if(!empty($_FILES['Video2']['name'])){
      $folder = 'NutritionGuidanceVideo'; //Set folder for upload  profile image   
      $result2 = $this->Media_upload_model->upload_video('Video2', $folder);
      if (is_array($result2) && array_key_exists('error', $result2)){
        $response = array('status' => FAIL,'msg' => strip_tags($result2['error']),'hash'=> get_csrf_token()['hash']);
       echo json_encode($response); exit;
      }else{
        array_push($newArrayVideo,$result2);
      }   
    }
      

    if(!empty($_FILES['videoThumb2']['name'])){
      $_FILES['videoThumb2']['name'] = 'vthumb2.png';
      $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
      $result3 = $this->image_model->upload_image('videoThumb2', $folder);
      if (is_array($result3) && array_key_exists('error', $result3)){
        $response = array('status' => FAIL,'msg' => strip_tags($result3['error']),'hash'=> get_csrf_token()['hash']);
          echo json_encode($response); exit;
      }else{
         array_push($newArrayVideoThumb,$result3);
      } 
    }
        /*3*/
    if(!empty($_FILES['Video3']['name'])){
      $folder = 'NutritionGuidanceVideo'; //Set folder for upload  profile image   
      $result4 = $this->Media_upload_model->upload_video('Video3', $folder);
      if (is_array($result4) && array_key_exists('error', $result4)){
        $response = array('status' => FAIL,'msg' => strip_tags($result4['error']),'hash'=> get_csrf_token()['hash']);
         echo json_encode($response); exit;
      }else{
        array_push($newArrayVideo,$result4);
      }   
    }
        
    if(!empty($_FILES['videoThumb3']['name'])){
      $_FILES['videoThumb3']['name'] = 'vthumb3.png';
      $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
      $result5 = $this->image_model->upload_image('videoThumb3',$folder);
      if (is_array($result5) && array_key_exists('error', $result5)){
        $response = array('status' => FAIL,'msg' => strip_tags($result5['error']),'hash'=> get_csrf_token()['hash']);
          echo json_encode($response); exit;
      }else{
         array_push($newArrayVideoThumb,$result5);
      } 
    }
        /*4*/
    if(!empty($_FILES['Video4']['name'])){
      $folder = 'NutritionGuidanceVideo'; //Set folder for upload  profile image   
      $result6 = $this->Media_upload_model->upload_video('Video4', $folder);
      if (is_array($result6) && array_key_exists('error', $result6)){
        $response = array('status' => FAIL,'msg' => strip_tags($result6['error']),'hash'=> get_csrf_token()['hash']);
       echo json_encode($response); exit;
      }else{
      array_push($newArrayVideo,$result6);
      }   
    }
        
    if(!empty($_FILES['videoThumb4']['name'])){
      $_FILES['videoThumb4']['name'] = 'vthumb4.png';
      $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
      $result7 = $this->image_model->upload_image('videoThumb4', $folder);
      if (is_array($result7) && array_key_exists('error', $result7)){
        $response = array('status' => FAIL,'msg' => strip_tags($result7['error']),'hash'=> get_csrf_token()['hash']);
          echo json_encode($response); exit;
      }else{
         array_push($newArrayVideoThumb,$result7);
      } 
    }
      /*5*/
    if(!empty($_FILES['Video5']['name'])){
      $folder = 'NutritionGuidanceVideo'; //Set folder for upload  profile image   
      $result8 = $this->Media_upload_model->upload_video('Video5', $folder);
      if (is_array($result8) && array_key_exists('error',$result8)){
        $response = array('status' => FAIL,'msg' => strip_tags($result8['error']),'hash'=> get_csrf_token()['hash']);
       echo json_encode($response); exit;
      }else{
      array_push($newArrayVideo,$result8);
      }   
    }

    if(!empty($_FILES['videoThumb5']['name'])){
      $_FILES['videoThumb5']['name'] = 'vthumb5.png';
      $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
      $result9 = $this->image_model->upload_image('videoThumb5', $folder);
      if (is_array($result9) && array_key_exists('error', $result9)){
        $response = array('status' => FAIL,'msg' => strip_tags($result9['error']),'hash'=> get_csrf_token()['hash']);
          echo json_encode($response); exit;
      }else{
         array_push($newArrayVideoThumb,$result9);
      } 
    }

    if(!empty($_FILES['pdfFile']['name'])){ 
      $imageName = 'pdfFile';
      $folder = "NutritionGuidancePdf";
      $pdf = $this->Pdf_model->upload_image($imageName,$folder);
      if(!empty($pdf['error'])){
         $response = array('status' =>FAIL, 'msg' =>'Please select a valid file type ','hash'=> get_csrf_token()['hash']); 
        echo json_encode($response); die;
      } 
      $data['pdf'] = $pdf['image_name']; 
    }

    $imageInsert              = json_encode($newArray); 
    $imagenewArrayVideo       = json_encode($newArrayVideo);
    $imagenewArrayVideoThumb  = json_encode($newArrayVideoThumb);

    $data['image'] = $imageInsert;
    $data['video'] = $imagenewArrayVideo;
    $data['videoThumb'] = $imagenewArrayVideoThumb;
    $data['title'] = sanitize_input_text($this->input->post('title'));
    $data['categoryId'] = sanitize_input_text($this->input->post('slectNurti'));
    $disp = trim(preg_replace('/\s+/',' ', $this->input->post('desc')));
    $data['description'] = sanitize_input_text($disp);
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
    $data['addedBy'] ='trainer';
    $data['addedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    $res['url'] = base_url().'admin/NutritionGuidance';
    }else{
    $data['addedBy'] = 'admin';
    $data['addedById'] = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
    $res['url'] = base_url().'admin/NutritionGuidance';
    }
    $data['crd'] = $data['upd'] = datetime();
    $responseInsertion = $this->common_model->insertData(NURRITIONGUIDANCE,$data);

    if($responseInsertion){
    $res['status'] = 1;
    $res['msg'] = 'NutritionGuidance added successfully.';
      if($data['categoryId']==1){

        $res['url']='nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(1);?>';

      }else if($data['categoryId']==2){
        $res['url']='Protein'; 
      }else if($data['categoryId']==3){
        $res['url']='Supplements'; 
      }else if($data['categoryId']==4){
        $res['url']='Macro_Tracking'; 
      }else if($data['categoryId']==5){
        $res['url']='Digestive_Disorders'; 
      }else{
        $res['url']='Special_Dietary_Requirements'; 
      }
    }else{
    $res['status'] = 0;
    $res['msg'] = 'Somthing went wong';
    $res['hash']= get_csrf_token()['hash'];
    }
    echo json_encode($res);

  }

  function What_Can_I_Eat(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "What Can I Eat";
    }else{
      $data['title']  = "What Can I Eat";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('nutritionGuidance',$data,'');
  }

   function fluids(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "fluids";
    }else{
      $data['title']  = "fluids";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('nutritionGuidance',$data,'');
  }

  function nutritionGuidance_list(){
    if(!empty($_POST['id'])){
      if($_POST['id']=='What Can I Eat'){
       // pr('dsad');
        $type=array('categoryId'=>1);
        $where=array('id'=>1);
        $data['id']=1;
      }
      if($_POST['id']=='Protein'){
        $type=array('categoryId'=>2);
         $where=array('id'=>2);
         $data['id']=2;
      }
      if($_POST['id']=='Supplements'){
        $type=array('categoryId'=>3);
         $where=array('id'=>3);
         $data['id']=3;
      }
       if($_POST['id']=='Macro Tracking'){  
        $type=array('categoryId'=>4);
         $where=array('id'=>4);
         $data['id']=4;
      }
       if($_POST['id']=='Digestive Disorders'){
       
        $type=array('categoryId'=>5);
         $where=array('id'=>5);
         $data['id']=5;
      }
      if($_POST['id']=='Special Dietary Requirements'){
    
        $type=array('categoryId'=>6);
         $where=array('id'=>6);
         $data['id']=6;
      }
      if($_POST['id']=='fluids'){
    
        $type=array('categoryId'=>7);
         $where=array('id'=>7);
         $data['id']=7;
      }
    }
   
    $data['titleN']  = $this->common_model->getsingle(NURRITIONGUIDANCECATEGORY,$where);
    $config['base_url']       = base_url()."admin/NutritionGuidance/nutritionGuidance_list";
    $config['total_rows']     = $this->NutritionGuidance_model->nutritionGuidanceCount($type);
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
    $data['nutritionGuidanceList'] = $this->NutritionGuidance_model->getAllnutritionGuidance($config['per_page'],$page,$type);
    $data['pagination'] = $this->ajax_pagination->create_links();
    $data['hash'] =   get_csrf_token()['hash'];
    $data['total_nutri_count']= $config['total_rows'];
    $rr= $this->load->view('get_nutritionGuidance_list',$data,true);
    echo json_encode(array('data'=>$rr,'hash'=>$data['hash'])); 
  }

  function Protein(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "Protein";
    }else{
      $data['title']  = "Protein";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('nutritionGuidance',$data,'');
  }

  function supplements(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "Supplements";
    }else{
      $data['title']  = "Supplements";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('nutritionGuidance',$data,'');
  }

  function macro_Tracking(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "Macro Tracking";
    }else{
      $data['title']  = "Macro Tracking";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('nutritionGuidance',$data,'');
  }

  function digestive_Disorders(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "Digestive Disorders";
    }else{
      $data['title']  = "Digestive Disorders";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('nutritionGuidance',$data,'');
  }

  function special_Dietary_Requirements(){
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title']  = "Special Dietary Requirements";
    }else{
      $data['title']  = "Special Dietary Requirements";
    }
    $where          = array('id'=> $_SESSION[ADMIN_USER_SESS_KEY]['userId']);
    $data['admin']  = $this->common_model->getsingle(USERS,$where);
    $this->load->admin_render('nutritionGuidance',$data,'');
  }

  function nutritionGuidanceDetail(){
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $data['title'] = "NutritionGuidance Detail";
    }else{
      $data['title'] = "NutritionGuidance Detail";
    }
    $this->check_admin_user_session();
    $nutritionId = decoding($this->uri->segment(4));
    $where= array('t.id'=>$nutritionId);
    $data['nutritionData'] = $this->NutritionGuidance_model->getDetails($where);
    $this->load->admin_render('nutritionGuidanceDetail',$data,'');
  }

  public function delete_nutritionGuidance(){
    $this->check_admin_user_session();
    $id = $_GET['id'];
    $table = NURRITIONGUIDANCE;
    $whereDelete = array('id'=>$id);
    $delete = $this->common_model->deleteData($table,$whereDelete);

    if($this->db->affected_rows() > 0){
      $this->load->model('image_model');
      $data=array('status'=>1,'message'=>'Deleted successfully');
    }else{
      $data=array('status'=>0,'message'=>'problem','hash'=>get_csrf_token()['hash']);
    }  
    echo json_encode($data);
  }
  //END DELETE FUNCTION
  function nutritionGuidanceEdit(){
   
    $this->check_admin_user_session();
    if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
      $is_data_exists['title']  = "Trainer-NutritionGuidance Edit";
    }else{
      $is_data_exists['title']  = "Admin-NutritionGuidance Edit";
    }
    $id = decoding($this->uri->segment(4));
    $where = array('id'=>$id);
    $is_data_exists['data']         = $this->common_model->is_data_exists(NURRITIONGUIDANCE,$where);
    $is_data_exists['categoryList'] = $this->common_model->getAll(NURRITIONGUIDANCECATEGORY);
    if(!empty($is_data_exists['data'])){
      $this->load->admin_render('editNutritionGuidance',$is_data_exists,'');
    }else{
      //$this->load->admin_render('addExercise','');
    }   

  }
  //edit 
    //UPDATE FUNCTION START
    function editNutritionGuidance(){
    //pr($_FILES);
    $this->check_admin_user_session();
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
    if($this->form_validation->run() == FALSE){
      $res['status'] = 0;
      $res['msg'] = validation_errors();
      $res['hash']= get_csrf_token()['hash'];
      echo json_encode($res);die();
    }
    
    //get data which are already exist
    $trainingId = $this->input->post('trainingId');
    $whereId = array('id'=>$trainingId);
    $existData = $this->common_model->is_data_exists(NURRITIONGUIDANCE,$whereId);
    //pr($trainingId);
    //----------------------------------------------------------------------------
    //check if title exist or not
    $categoryId = $existData->categoryId;
    $title = sanitize_input_text($this->input->post('title'));
    
    $whereCheck =array('title'=>$title,'id !='=>$trainingId,'categoryId'=>$categoryId);
    $check=$this->common_model->is_data_exists(NURRITIONGUIDANCE,$whereCheck);
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
            $folder =  "NutritionGuidancePdf";
            $pdf = $this->Pdf_model->upload_image($imageName,$folder);
            if(!empty($pdf['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Please select a valid file type ','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            $data['pdf'] = $pdf['image_name'];   
      }
      //for picture
  
     /* $videoThumbInsert = json_encode($newArrayVideoThumb);
      $videoInsert = json_encode($videoArray);
      $imageInsert = json_encode($newArray);*/

      $data['videoThumb']     = '';
      $data['image']          = '';
      $data['video']          = '';
      $data['title']          = sanitize_input_text($this->input->post('title'));
      $data['categoryId']     = sanitize_input_text($this->input->post('category_name'));
      //pr(sanitize_input_text($this->input->post('category_name')));
      $disp =  $this->input->post('desc');
      //$data['description']    = sanitize_input_text($disp);
      $data['description']    =  $disp;

      if($categoryId==1){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(1); 
      }else if($data['categoryId']==2){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(2); 
      }else if($data['categoryId']==3){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(3); 
      }else if($data['categoryId']==4){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(4); 
      }else if($data['categoryId']==5){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(5); 
      }else if($data['categoryId']==6){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(6);
      }
      else{
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(7); 
      }

      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        //$res['url']           = base_url()."admin/NutritionGuidance/?categoryId=". encoding(sanitize_input_text($this->input->post('category_name')));
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
       // $res['url']           = base_url()."admin/NutritionGuidanceVideo_thumb/?categoryId=". encoding(sanitize_input_text($this->input->post('category_name')));
      }
      $data['crd'] =    $data['upd'] = datetime();
      $whereUpadate = array('id'=>$trainingId);
      $wherecheck = array('postId'=>$trainingId,'refrenceTable'=>NURRITIONGUIDANCE);
      $check2 = $this->common_model->is_data_exists('postRevision',$wherecheck);
      if(!empty($check2)){
        $deleteArticle = $this->common_model->deleteData('postRevision',$wherecheck);
       }
      $responseUpdate = $this->common_model->updateFields(NURRITIONGUIDANCE, $data, $whereUpadate);

      if($responseUpdate){
        $res['status'] = 1;
        $res['msg'] = 'NutritionGuidance update successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);

  }


  function editNutritionGuidanceRevision(){
    //$pdf = $this->input->post('pdf');
    //pr($_FILES);
    $this->check_admin_user_session();
    $articleStatus = $this->input->post('articleStatus');
    //$pdf = $this->input->post('pdf');
    $description = $this->input->post('description');
    $isexits = $this->input->post('isexits');
    $categoryId = $this->input->post('categoryId');
    //pr($categoryId);
    //$whereId = array('id'=>$trainingId);
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
    $where =array('postId'=>$articleId,'refrenceTable'=>'nutritionguidance'); 
    $check = $this->common_model->is_data_exists('postRevision',$where);

    if($check){
      if($check->postStatus==1){
        $deleteA = $this->common_model->deleteData('postRevision',$where);
        $res['status'] = 1;
        echo json_encode($res);
        return false;
      }

      $data['title']           = $title;
      $data['description']     = $description;
      //$pdf = $this->input->post('pdf');
      //$data['pdf'] =$pdf;
      $data['categoryId']      = $categoryId;
      $data['upd'] = datetime();

     if(!empty($_FILES['edit-pdf']['name'])){ 
          $imageName = 'edit-pdf';
            $folder =  "NutritionGuidancePdf";
            $pdf = $this->Pdf_model->upload_image($imageName,$folder);
            if(!empty($pdf['error'])){
              $response = array('status' =>FAIL, 'msg' =>'Please select a valid file type ','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
            }  
            $data['pdf'] = $pdf['image_name'];   
      }

      $where =array('postId'=>$articleId,'refrenceTable'=>'nutritionguidance'); 
      $update = $this->common_model->updateFields('postRevision',$data,$where);

      if($update){
        $res['status'] = 1;
        $res['msg'] = 'Article updated successfully.';
        $res['url'] = base_url().'admin/nutritionguidance';
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
     // $data['isDisableComment'] = $this->input->post('radio');
      $data['pdf'] =$pdf;
      $data['categoryId']      = $categoryId;
      $data['postStatus']       = 0;
      $data['refrenceTable']    = 'nutritionguidance';
      $data['crd'] =$data['upd'] = datetime();
      $update = $this->common_model->insertData('postRevision',$data);
      if($update){
        $res['status'] = 1;
        $res['msg'] = 'Article updated successfully.';
        $res['url'] = base_url().'admin/article';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);
    }  
  }




  function editNutritionGuidance_V1(){
    //pr($_POST);
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
    $existData = $this->common_model->is_data_exists(NURRITIONGUIDANCE,$whereId);
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
    $check=$this->common_model->is_data_exists(NURRITIONGUIDANCE,$whereCheck);
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
            $folder =  "NutritionGuidancePdf";
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
            $folder =  "NutritionGuidance";
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
            $folder =  "NutritionGuidance";
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
            $folder =  "NutritionGuidance";
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
            $folder =  "NutritionGuidance";
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
            $folder =  "NutritionGuidance";
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
            $folder =  "NutritionGuidanceVideo";
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
      }

      if(!empty($_FILES['edit-video2']['name'])){ 
 
            $video = 'edit-video2';
            $folder =  "NutritionGuidanceVideo";
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
            $folder =  "NutritionGuidanceVideo";
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
            $folder =  "NutritionGuidanceVideo";
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
            $folder =  "NutritionGuidanceVideo";
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
          $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
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
          $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
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
          $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
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
          $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
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
          $folder = 'NutritionGuidanceVideo_thumb'; //Set folder for upload profile image 
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
     /* if(empty($newArray)){
        $response = array('status' =>FAIL, 'msg' =>'please select at least one image','hash'=> get_csrf_token()['hash']);  
            echo json_encode($response); die;
      }*/
      //check for if any image is not selected

      if($newArray[0]=='' AND $newArray[1]=='' AND  $newArray[2]=='' AND  $newArray[3]=='' AND  $newArray[4]==''){
        $response = array('status' =>FAIL, 'msg' =>'please select at least one image','hash'=> get_csrf_token()['hash']);  
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
      $disp =  $this->input->post('desc');
      //$data['description']    = sanitize_input_text($disp);
      $data['description']    =  $disp;

        if($categoryId==1){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(1); 
      }else if($data['categoryId']==2){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(2); 
      }else if($data['categoryId']==3){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(3); 
      }else if($data['categoryId']==4){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(4); 
      }else if($data['categoryId']==5){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(5); 
      }else if($data['categoryId']==6){
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(6);
      }
      else{
        $res['url']=base_url().'admin/nutritionGuidance/nutritionGuidanceEdit/'.encoding(7); 
      }


      if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
        $data['addedBy']      ='trainer';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
        //$res['url']           = base_url()."admin/NutritionGuidance/?categoryId=". encoding(sanitize_input_text($this->input->post('category_name')));
      }else{
        $data['addedBy']      = 'admin';
        $data['addedById']    = $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
       // $res['url']           = base_url()."admin/NutritionGuidanceVideo_thumb/?categoryId=". encoding(sanitize_input_text($this->input->post('category_name')));
      }
      $data['crd'] =    $data['upd'] = datetime();
      $whereUpadate = array('id'=>$trainingId);
      $responseUpdate = $this->common_model->updateFields(NURRITIONGUIDANCE, $data, $whereUpadate);

      if($responseUpdate){
        $res['status'] = 1;
        $res['msg'] = 'NutritionGuidance update successfully.';
      }else{
        $res['status'] = 0;
        $res['msg'] = 'Somthing went wong';
        $res['hash']= get_csrf_token()['hash'];
      }
      echo json_encode($res);

  }
  //END OF FUNCTION
  //end of edit

   function uploadImage(){

    $ext = pathinfo($_FILES['upload']['name'],PATHINFO_EXTENSION);
    if($ext!='mp4'){
     if(!empty($_FILES['upload']['name'])){ 
            $imageName = 'upload';
            $folder =  "ckeditorImage";
            $response_image1 = $this->image_model->upload_image($imageName,$folder);

            if(empty($response_image1['error'])){
              $data['fileName'] = $_FILES["upload"]["name"];
              $data['uploaded'] = 1;
              $data['url']      = base_url().'uploads/ckeditorImage/'.$response_image1;
              echo json_encode($data);die;
            }   
          }
    }else{
      if(!empty($_FILES['upload']['name'])){ 
            //pr($_FILES['upload']);
            $video  = "upload";
            $folder =  "ckeditorVideo";
            $video1 = $this->Media_upload_model->upload_video($video,$folder);
            //pr($video1);
            if(empty($video1['error'])){

              $data['fileName'] = $_FILES["upload"]["name"];
              $data['uploaded'] = 1;
              $data['url']=      base_url().'uploads/ckeditorVideo/'.$video1;
                echo json_encode($data);die; 
           
            }
      }
    }
       
   }

   function deletePdf(){
     $pdgname= $this->input->get('pdfName'); 
     $cat= $this->input->get('cat'); 
     $whe = array('pdf'=>$pdgname,'categoryId'=>$cat);
     $check = $this->common_model->is_data_exists(NURRITIONGUIDANCE,$whe);
     if($check){
      $data['pdf']='';
      $where =array('categoryId'=>$cat);
      $upd = $this->common_model->updateFields(NURRITIONGUIDANCE,$data,$where);
      $response = array('status' =>1, 'msg' =>'Pdf Deleted successfully');  
      echo json_encode($response); die; 
      //return false;
    }
   }

    function checkutritionGuidanceId(){
      if(!empty($_POST['articlearticle'])){
      $articleId = $_POST['articlearticle'];
      $where =array('postId'=>$articleId,'refrenceTable'=>'nutritionguidance');
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'nutritionguidance');
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'nutritionguidance');
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
    $where =array('postId'=>$articleId,'refrenceTable'=>'nutritionguidance'); 
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
      $where =array('postId'=>$articleId,'refrenceTable'=>'nutritionguidance'); 
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
      $data['refrenceTable']    = 'nutritionguidance';
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
  




