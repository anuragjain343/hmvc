
                <?php  if(!empty($userList)){ foreach($userList as $value){  ?>
           
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
                      <a href="<?php echo base_url()?>admin/users/userDetails/<?php echo encoding($value->id);?>"><?php sanitize_output_text(custom_echo( ucfirst($value->fullName),20));?></a>
                    </td>                                                
                      <td class="text-truncate align-middle">
                        <span><?php sanitize_output_text(custom_echo ($value->email,25));?></span>
                    </td>                                             <td class="text-truncate align-middle">
                     <?php if($value->status=='Active'){$class = 'text-success';}else{$class = 'text-danger';} ?>
                      <span class="<?php echo $class;?>"><?php echo sanitize_output_text($value->status);?></span>
                    </td>
                    <td class="align-middle eye-style">
                      <a href="<?php echo base_url()?>admin/users/userDetails/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>
                    <?php if($value->status=='Inactive'){?>
                      <a ><i class="la la-check text-success" onclick="userStatus('<?php echo $value->id ?>')"></i></a>
                    <?php }else{?>
                      <a ><i class="la la-times text-danger" onclick="userStatus('<?php echo $value->id ?>')"></i></a>
                    <?php }?>
                      </td>
                  </tr>                                
               
                
                <?php }

                 }else{ ?>
                  <tr><td>
                   No Record Found.
                   </td>
                 </tr>
               <?php }
                ?>
               <tr>
                   <td colspan="5"><?php echo $pagination;?></td>
                 </tr>
           
                

                     <!-- NN -->  

<span id="baseurl" data-name="<?php echo base_url()?>"></span>

<script type="text/javascript">


var  baseurl='<?php echo base_url()?>admin/users/user_List';
function searchByLevel(vl,csf){
   var search_val = $('#iconLeft4').val();
  /*if(search_val.length < 2   && $(this).val()!= ''){
    search_val=0;
    }*/
 //  alert(search_val);
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
// search user

$(document).on('keyup','#iconLeft4',function(e){
  e.preventDefault(); 

    //alert(e.which);
  if(e.which === 13 || e.which === 37 ||e.which === 38 || e.which === 39 || e.which === 40 || e.which === 45 || e.which === 36 || e.which === 34 || e.which === 33 ||e.which === 35 || e.which === 115 || e.which === 119 || e.which === 120){
        return false;
  }
// 13 ,37 38 39 40

  var  baseurl='<?php echo base_url();?>';
  var value = $(this).val().toLowerCase();

  

    if($(this).val().trim().length < 2 && $(this).val() != ''){

      return false;
    };


    

    var  url = baseurl+'admin/users/user_List';
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
    //alert(search_text);
    /*if(search_text.which === 13){
        return false;
    }*/
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