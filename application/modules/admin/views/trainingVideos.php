<input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before Hedtxt">
            <h2 class="ml-2">Training Videos (<?php if(!empty($total_rows)){ echo $total_rows; } ?>)</h2>

            <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right mr-2" href="<?php echo base_url();?>admin/video/addTrainingVideo">
                <span class="white">Add New</span>
                <i class="ft-video white"></i>
            </a>
        </div>
            <div class="content-header row mt-10"></div>
            
            <div class="row match-height mrgn-rs-crd">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card mrgn-tp-crd p-20">            
                        <div class="card-content">
                            <div id="recent-projects" class="media-list position-relative">
                                 <div class="videoSec mb-1 ml-auto">
                                         <input type="text" id="iconLeft4" class="form-control round " placeholder="Search">
                                    </div> 
                        <sapn class="" id="rList"></sapn>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
</div>
<script type="text/javascript">
    function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }

    var data = $("#hash");
    ajax_fun('trainingVideo_List');
    function ajax_fun(url)
    { 
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var dataObject={page:url,csrf_test_name:value};
    $.ajax({
        type:'POST',
        url:url,
        data:dataObject,
      
        beforeSend: function () { 
             show_loader(); 
         },              
        success: function(data){ 
              hide_loader(); 
            var allData=jQuery.parseJSON(data);
            $("#hash").attr('data-value',allData.hash);
            $("#rList").html(allData.data);
        }
    });
    }
    $(document).on('keyup','#iconLeft4',function(e){
        
  e.preventDefault(); 
   if(e.which === 13 || e.which === 37 ||e.which === 38 || e.which === 39 || e.which === 40 || e.which === 45 || e.which === 36 || e.which === 34 || e.which === 33 ||e.which === 35 || e.which === 115 || e.which === 119 || e.which === 120){
        return false;
  }

var  baseurl='<?php echo base_url();?>';
  if($(this).val().trim().length <  2 && $(this).val()!= ''){
   return false
    };
  // var  url = base_url+'admin/user/loadPagination/0';
    var  url = baseurl+'admin/video/trainingVideo_List';
    load_page(url);
});

var currentRequest = null;
// Load pagination for user list
function load_page(url){
 //alert(url);
  toastr.remove();
  var search_text = '';
  var search_val = $('#iconLeft4').val();
  if(search_val.trim().length >= 1){
      search_text = search_val;
  }
  currentRequest = $.ajax({
    url: url,
    type: 'post',
    data:{search:search_text}, 
   // dataType: 'json',
    beforeSend: function() {
     // $('#recent-projects').css('display', 'none');

      if(currentRequest != null) {
        currentRequest.abort();
      }
        show_loader();  
    },
    success: function(response){
        hide_loader(); 
      currentRequest = null;
      var allData=jQuery.parseJSON(response);
        // alert(allData);
      //$('#recent-projects').css('display', 'block');
      $("#hash").attr('data-value',allData.hash);
       //$('#recent-projects').css('display', 'block');
      $('#rList').html(allData.data);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      currentRequest = null;
      if(textStatus != 'abort' && errorThrown != "abort"){
        toastr.warning(unknown_error_msg); //error
      }      
    },
    complete: function () {
      // $('.spin').css('display','none');
      //$('.spin .fa-spin').css('display','none');
     // $('#recent-projects').css('display', 'block');
    }
  });
}

    </script>
