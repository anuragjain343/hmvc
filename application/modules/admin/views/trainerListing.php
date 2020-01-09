<input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >



<span id="rList"></span>


<script type="text/javascript">
    function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }
    var data = $("#hash");
    ajax_fun('trainer/trainerListing');
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
    </script>

 