  <?php $frontend_assets = base_url()."frontend_assets/";?>
   <section class="sec-pad-50 upr-heder-sec">
       <div class="shapes-bg-big">
           <div class="container">
                <div class="box_icon">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Informational Videos</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                        </div>
                    </div>
                </div>
            </div>
       </div>
   </section>
   <section class="video-sec sec-pad-50 wrapper">
      <span id="videoListAll"></span>
   </section>
   <script type="text/javascript">
   
      ajax_fun('<?php echo base_url()?>home/video/videoList');
     function ajax_fun(url){
       
       var baseurl = url;
        $.ajax({
        type:'GET',
        url:baseurl,            
        success: function(data){ 
            var allData=jQuery.parseJSON(data);
           //$("#hasharticl").attr('data-value',allData.hash);
          $("#videoListAll").html(allData.data);
        }
    });
    }
   </script>