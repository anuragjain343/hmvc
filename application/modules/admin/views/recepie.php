
<input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >

<input type="hidden" name="cat_id" id="cat_id" value="">

<span id="rList"></span>


<script type="text/javascript">
    function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }
    var data = $("#hash");
   
    
    ajax_fun('recepie/recepie_list');
    function ajax_fun(url)
    { 

        var id = $('#cat_id').val();
        var sendUrl = url+'/?id='+id;
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var dataObject={page:url,csrf_test_name:value};
    $.ajax({
        type:'POST',
        url:sendUrl,
        data:dataObject,
        dataType:'json',
        beforeSend: function () { 
             show_loader(); 
         },              
        success: function(res){ 

              hide_loader(); 
          
            $("#hash").attr('data-value',res.hash);
            $("#rList").html(res.data);
            $("#cat_id").val(res.categorId);
          
            $('#resp'+res.categoryId).addClass('active');

        }
    });
    }
    </script>

 