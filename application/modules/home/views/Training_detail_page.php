    <section class="video-sec wrapper">
        <input type="hidden" name="catid" id="catid" value="<?php echo $catid;?>">
        <span id="ansList"></span>
        <span id="ourBlogs">
  
        </span>  
 
      <center style="display:none;">
    <img src="<?php  echo base_url();?>frontend_assets/img/Spinner-1s-100px.apng" id="showloder" >
    </center>
   
    </section>
    <span id="bsurl" data-value="<?php echo base_url();?>home/Training/training_post_list"></span>
    
  <script type="text/javascript">
    var catid = $('#catid').val();
//     $('#allVideos1').lightGallery({
//       selector : ".videoThumb a",
//       thumbnail:true,
//     autoplayControls:false,
//     fullScreen:false,
//     share:false,
//     zoom:false,
//     download:false
// }); 
     function show_loader(){
        $('#showloder').show();
    }

 function hide_loader(){
 $('#showloder').hide();
 }
     var baseurl = $("#bsurl").attr('data-value');
     var data = $("#hash").attr('value');
    get_view_me_list1();
    //when click on load more button 
    $('body').on('click', "#btnLoadViewMe1", function (event) {
            is_load_more = 1;
        get_view_me_list1(is_load_more);
    });

    //ajax funnction to get_product_list 
   function get_view_me_list1(is_load_more=0){ 
    var catid = $('#catid').val();
    if(is_load_more!=0){
    //if is_load_more is not 0 then get offset data from btnlod attr
        offset = $('#btnLoadViewMe1').attr("data-offset");
        var data = $("#hash").attr('value');
    }else{ 
    //set offset =0 when is_load_more is 0
        offset = 0;
        var data = $("#hash").attr('value');
    }
    //alert(data);

    $.ajax({
        url: baseurl,
        type: "POST",
        data:{offset:offset,csrf_test_name:data,catid:catid}, 
        dataType: "JSON",
        beforeSend: function() {
           show_loader();
        }, 
        success: function(data){ 
            hide_loader();
             $("#hash").val(data.hash);
            if(data.status==-1){
                toastr.error(data.msg);
                window.setTimeout(function () {
                      window.location.href = data.url;
                }, 1000); 
            }
         $('#btnLoadViewMe1').remove();
            //remove load more button 

            if(offset==0){ //clear div when offset 0
                $("#ansList").html('');
            }
            if(data.no_record==0){//show data in div when no previous record 
                $("#ansList").html(data.html_view);
                
            }else{
                //append data when already record show in view
                $("#ansList").append(data.html_view);
                $("#ourBlogs").append(data.btn_html);
            }
        },
    }); 
}
</script>