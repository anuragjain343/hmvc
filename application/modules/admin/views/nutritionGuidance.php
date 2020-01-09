<input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >
<input type="hidden" id="categoryIdMenu" value="<?php echo $title;?>">
<sapn class="" id="rList"></sapn>

<span id="rList">
   
</span>


<script type="text/javascript">
    function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }
   
   var data = $("#hash");
   
    ajax_fun('nutritionGuidance_list');
    function ajax_fun(url)
    { 
        //alert(url);
    /*var csrf_test_name=data.attr('data-name');
    var value=data.attr('data-value');
    var dataObject={page:url,csrf_test_name:value};*/

    var categoryIdMenu = $('#categoryIdMenu').val();
    var value=data.attr('data-value');
    var dataObject={page:url,csrf_test_name:value,id:categoryIdMenu};



    $.ajax({
    type:'POST',
    url:url,
    data:dataObject,
    beforeSend: function () { 
        // show_loader(); 
     },              
    success: function(data){ 
          //hide_loader(); 
        var allData=jQuery.parseJSON(data);
        $("#hash").attr('data-value',allData.hash);
        $("#rList").html(allData.data);
    }
    });
    }
    </script>

 