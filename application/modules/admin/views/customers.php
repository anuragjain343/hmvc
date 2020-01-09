<input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >

<div class="app-content content" >
   
      <div class="content-wrapper">        
        <div class="content-wrapper-before Hedtxt">
            <h2 class="ml-2">Customers (<?php  if(!empty($total_user)){ 
                echo $total_user; } ?>)</h2>
        </div>
        <div class="clearfix"></div>
            <div class="content-header row mt-10"></div>            
            <div class="row match-height">                    
                <div class="col-xl-12 col-lg-12 col-md-12">                                 
                    <div class="card mrgn-tp-crd">                         
                        <div class="card-content">
                      <div class="row p-1 justify-content-end">
            <div class="col-12 col-lg-4 col-md-4 col-sm-6">
      <input type="text" id="iconLeft4" class="form-control round " placeholder="Search" ">
            </div>
            <div class="col-12 col-lg-4 col-md-4 col-sm-6">
              <div class="rs_mt-10">
                <select class="custom-select round" name="carlist" id="customSelect" onchange="searchByLevel(this.value,'<?php echo get_csrf_token()['hash'];?>');">
                  
                  <option  class=""  id=""       value="0" >All Level</option>
                  <option  class=""  id="free"   value="free"  >Free</option>
                  <option  class=""  id="level1" value="1"  >Level 1</option>
                  <option  class=""  id="level2" value="2"  >Level 2</option>
                  <option  class=""  id="level3" value="3"  >Level 3</option>
                  <option  class=""  id="level4" value="4" >Level 4</option>
                </select>  
              </div> 
            </div>
          </div>  
                            <div id="recent-projects" class="media-list">
                                <div class="table-responsive">
                                    <table class="table table-padded table-xl mb-0 user-list-tble" id="recent-project-table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Profile Pic</th>
                                                <th class="border-top-0">Name</th>                                                
                                                <th class="border-top-0">Email address</th>
                                                <th class="border-top-0">Action</th>          
                                            </tr>
                                               <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                        </thead>
                                        <tbody id="rList">
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
 
</div>

<script type="text/javascript">
    function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }

    var data = $("#hash");
    ajax_fun('<?php echo base_url();?>admin/trainers/customer_List');
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
