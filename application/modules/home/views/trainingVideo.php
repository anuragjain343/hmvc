  <?php $frontend_assets = base_url()."frontend_assets/";?>
   <section class="sec-pad-50 upr-heder-sec">
       <div class="shapes-bg-big">
           <div class="container">
                <div class="box_icon">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Training Videos</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                        </div>
                    </div>
                </div>
            </div>
       </div>
   </section>
   <section class="video-sec sec-pad-50 wrapper">
      <span id="videoListTraining"></span>
   </section>
   <script type="text/javascript">
     var userid ='<?php echo $userId; ?>';
     var userPlan ='<?php echo $userPlan; ?>';
      ajax_fun('<?php echo base_url()?>home/video/videoTrainingList?id='+userid+'&plan='+userPlan);
     function ajax_fun(url){
      // alert(url);
       var baseurl = url;
        $.ajax({
        type:'GET',
        url:baseurl,            
        success: function(data){ 
            var allData=jQuery.parseJSON(data);
           //$("#hasharticl").attr('data-value',allData.hash);
          $("#videoListTraining").html(allData.data);
        }
    });
    }
   </script>