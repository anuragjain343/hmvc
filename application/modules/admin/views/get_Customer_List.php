

                                           <?php if(!empty($userList)){  foreach($userList as $value){?>
                                            <tr>
                                                <td class="text-truncate align-middle">
                                                    <ul class="list-unstyled users-list m-0">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willis Barstow" class="avatar avatar-sm width-cstm pull-up">
                                                            <?php if(!empty($value->profileImage)){ ?>
                                                            <img class="media-object rounded-circle" src="<?php echo base_url(USER_PROFILE_THUMB).$value->profileImage;?>" alt="Avatar">
                                                            <?php } else {?>
                                                             <img class="media-object rounded-circle" src="<?php echo base_url(DEFAULT_IMAGE);?>" alt="Avatar">
                                                            <?php }?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="text-truncate align-middle">
                                                    <a href="<?php echo base_url()?>admin/trainers/customerDetail/<?php echo encoding($value->id);?>"><?php sanitize_output_text(custom_echo( ucfirst($value->fullName),20));?></a>
                                                </td>                                                
                                                <td class="text-truncate align-middle">
                                                    <span><?php sanitize_output_text(custom_echo ($value->email,25));?></span>
                                                </td>
                                                <td class="align-middle eye-style">
                                                   <!--  <?php echo base_url()?>admin/trainers/trainerDetails/<?php echo encoding($value->id);?> -->
                                                    <a href="<?php echo base_url()?>admin/trainers/customerDetail/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>

                                                    <!-- <a ><i class="ft-trash icon-opacity clr2" onclick="deletefn('<?php echo $value->id ?>','<?php echo get_csrf_token()['hash'];?>')"></i></a> -->
                                                </td>
                                            </tr> 
                                              <?php } }else{?>
                                             
                                            <tr>
                                              <td class="text-center" colspan="4"><h5>No Customer Found.</h5></td>
                                            </tr>                                
                                     
                                        <?php } ?> 
                                        <tr>
                                          <td colspan="5">
                                         <?php echo $pagination; ?>
                                       </td>
                                       </tr>

                
<span id="baseurl" data-name="<?php echo base_url()?>"></span>

<script type="text/javascript">
   var  baseurl='<?php echo base_url()?>admin/trainers/customer_List';
function searchByLevel(vl,csf){
   var search_val = $('#iconLeft4').val();

        $.ajax({
        method: "POST",
        url: baseurl,
        //dataType: "json",
        data:{
        "csrf_test_name":csf,'search':search_val,
        id:vl
        },
        beforeSend: function () { 
        show_loader(); 
        },
        success: function (data){
            hide_loader(); 
            var allData=jQuery.parseJSON(data);
         $("#hash").attr('data-value',allData.hash);
            $("#rList").html(allData.data);
        },
        });
}
$(document).on('keyup','#iconLeft4',function(e){
  e.preventDefault(); 

  if(e.which === 13 || e.which === 37 ||e.which === 38 || e.which === 39 || e.which === 40 || e.which === 45 || e.which === 36 || e.which === 34 || e.which === 33 ||e.which === 35 || e.which === 115 || e.which === 119 || e.which === 120){
        return false;
  }
  
var  baseurl='<?php echo base_url();?>';
  if($(this).val().trim().length < 2   && $(this).val()!= ''){
   return false;
    };
    var  url = baseurl+'admin/trainers/customer_List';
    load_page(url);
});

var currentRequest = null;
// Load pagination for user list
function load_page(url){
 //alert(url);
  ///toastr.remove();
  var search_text = '';
  var search_val = $('#iconLeft4').val();
  var customSelect = $('#customSelect').val();

  if(search_val.trim().length >= 1){
      search_text = search_val;
  }
 
  currentRequest = $.ajax({
    url: url,
    type: 'post',
    data:{search:search_text,id:customSelect}, 
   // dataType: 'json',
    beforeSend: function() {
      if(currentRequest != null) {
        currentRequest.abort();
          show_loader(); 
      }
    },
    success: function(response){
        hide_loader(); 
      currentRequest = null;
      var allData=jQuery.parseJSON(response);
  
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
      //$('#recent-projects').css('display', 'block');
      //$('#rList').css('display', 'block');

    }
  });
}
</script>                                    