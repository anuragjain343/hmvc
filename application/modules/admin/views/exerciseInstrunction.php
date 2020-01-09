<input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >
<?php if(!empty($categoryIdMenu)){ ?>
<input type="hidden" id="categoryIdMenu" value="<?php echo $categoryIdMenu;?>">
<?php }?>
<sapn class="" id="exerciseList"></sapn>

<span id="exerciseList"></span>


<script type="text/javascript">
    function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }
    var data = $("#hash");
    ajax_fun('exercise_instrunction_list');
    function ajax_fun(url)
    { 
        var csrf_test_name=data.attr('data-name');
        var categoryIdMenu = $('#categoryIdMenu').val();
        var value=data.attr('data-value');
        var dataObject={page:url,csrf_test_name:value,categoryIdMenu:categoryIdMenu};
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
            $("#exerciseList").html(allData.data);
        }
    });
    }
    </script>

 