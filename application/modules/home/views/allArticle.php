  <?php $frontend_assets = base_url()."frontend_assets/";?>
  <div class="forumSearchSec" style="background-image:url(<?php echo $frontend_assets ?>img/searchbg.jpg);">
    <div class="container">
      <div class="box_icon">
        <div class="row">
          <div class="col-md-12">
            <h2>Search Articles</h2>
            <p>If you have any question you can ask below or enter what you are looking for!</p>
            <div id="live-search">
              <div class="forumSearchForm">
                <div class="forumSearchInput">
                  <form id="articleTitleSrearch" action="<?php echo base_url()?>home/article/articleDetailList" method="POST">
                  <input id="searchInput" type="text" name ="article" placeholder="Type your search terms here" autocorrect="off" autocomplete="off"> 
                    <input type="hidden" id ="hasharticl" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >
                  <button type="submit"  class="btn btn-theme btn-bg-t" id="articleTitleSrearch"><i class="fas fa-search"></i></button>
                  </form>
                </div>
                <!-- <button class="btn btn-theme btn-bg-t" data-toggle="modal" data-target="#questionModal">Add Question</button> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="articlesSec sec-pad-30">
    <span id="artiListAll"></span>
  </section>

 <script type="text/javascript">
     
    var data = $("#hasharticl");
    ajax_fun('<?php echo base_url();?>home/article/articleDetailList');
    function ajax_fun(url){ 
       var baseurl        = url;
      var csrf_test_name  = data.attr('data-name');
      var value           = data.attr('data-value');
      var dataObject      = {page:baseurl};
      $.ajax({
        type:'POST',
        url:baseurl,
        data:dataObject,
        beforeSend: function () { 
             //show_loader(); 
         },              
        success: function(data){ 
           // hide_loader(); 
            var allData=jQuery.parseJSON(data);
           $("#hasharticl").attr('data-value',allData.hash);
            $("#artiListAll").html(allData.data);
        }
    });
    }
    
/*  $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});*/
   </script>