
<?php  $frontend_asset = base_url().'frontend_assets'; ?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
  <div class="forumSearchSec mb-0" style="background-image:url(<?php echo $frontend_asset ?>/img/searchbg.jpg);">
    <div class="container">
      <div class="box_icon">
        <div class="row">
          <div class="col-md-12">
            <h2>HAVE A QUESTION?</h2>
            <p>If you have any question you can ask below or enter what you are looking for!</p>
            <div id="live-search">
              <div class="forumSearchForm">
                <div class="forumSearchInput">
                  <form id ="searchInput" action="<?php echo base_url()?>home/forum/forum_List" method="POST">
                    <input type="hidden" id ="hashsearch" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>">
                  <input type="text" placeholder="Type your search terms here" autocorrect="off" autocomplete="off" name="search"> 
                  <button type="button" class="btn btn-theme btn-bg-t" id="searchByTitle"><i class="fas fa-search"></i></button>
                  </form>
                </div>
                <button class="btn btn-theme btn-bg-t margin_mini" onclick="isLogin('questionModal','');">Add Question</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>">

<span id="rList"></span>

<script type="text/javascript">
    function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }

    var data = $("#hash");
    ajax_fun('forum/forum_List');

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
            $("#hash1").attr('value',allData.hash);
            $("#hashid").attr('value',allData.hash);
            $("#hashsearch").attr('value',allData.hash);
            $("#rList").html(allData.data);
        }
    });
    }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(window).keydown(function(event){
              if(event.keyCode == 13) {
                event.preventDefault();
                return false;
              }
            });
          });
    var hs =$('#hash').attr('data-value');
  //$("#hash1").attr('value',hs);
   // alert(hs);
    </script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

