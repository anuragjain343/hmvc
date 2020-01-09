  <input type= "hidden"   id="hasharticl" value="<?php echo $catid; ?>">
 <section class="video-sec wrapper">
    <span id="answerListAll"></span>    
    <span id="ourBlogs"></span> 
      <center style="display:none;">
    <img src="<?php  echo base_url();?>frontend_assets/img/Spinner-1s-100px.apng" id="showloder" >
    </center>
</section>
       
               
           
  

    <script type="text/javascript">

     function show_loader(){
 $('#showloder').show();
 }

 function hide_loader(){
 $('#showloder').hide();
 }
    var data = $("#hasharticl");
      //alert(data);
    var baseurl ='<?php echo base_url();?>';
     //var data = $("#hash").attr('value');
    get_view_me_list1();
    //when click on load more button 
    $('body').on('click', "#btnLoadViewMe1", function (event) {
            is_load_more = 1;
        get_view_me_list1(is_load_more);
    });

    //ajax funnction to get_product_list 
   function get_view_me_list1(is_load_more=0){ 
    if(is_load_more!=0){
    //if is_load_more is not 0 then get offset data from btnlod attr
        offset = $('#btnLoadViewMe1').attr("data-offset");
        //alert(offset);
        var data = $("#hasharticl").attr('value');
    }else{ 
    //set offset =0 when is_load_more is 0
        offset = 0;
       // alert(offset);
        var data = $("#hasharticl").attr('value');
    }
    var arid= '<?php echo $catid; ?>';
    //alert(baseurl);

    $.ajax({
        url: baseurl+"home/nutritionGuidance/nutritionGuidanceDetail",
        type: "POST",
        data:{offset:offset,csrf_test_name:data,nId:arid}, 
        dataType: "JSON",
        beforeSend: function() {
           show_loader();
        }, 
        success: function(data){ 
          hide_loader();
           
             $("#hasharticl").val(data.hash);
            if(data.status==-1){
                toastr.error(data.msg);
                window.setTimeout(function () {
                      window.location.href = data.url;
                }, 1000); 
            }
         $('#btnLoadViewMe1').remove();
            //remove load more button 

            if(offset==0){ //clear div when offset 0
                $("#answerListAll").html('');
            }
            if(data.no_record==0){//show data in div when no previous record 

                $("#answerListAll").html(data.html_view);
                
            }else{
                //append data when already record show in view
                //alert(data.html_view);
                $("#answerListAll").append(data.html_view);
                $("#ourBlogs").append(data.btn_html);
            }
        },
    }); 
}

   



</script>
<script type="text/javascript">
$('#allVideos1').lightGallery({
      selector : ".videoThumb a",
      thumbnail:true,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
}); 

</script>
 