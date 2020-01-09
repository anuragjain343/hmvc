

                        <div class="card">            
                        <div class="card-content">
                            <div id="recent-projects" class="media-list position-relative">
                                <div class="table-responsive">
                                     <div class="row m-0 p-2">
                                     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-right" style="line-height: 35px;">
                                            <fieldset class="form-group mb-0">  
                                                <select class="custom-select round" name ="" id="searchlevel" onchange="searchByLevel(this.value);">

                                <?php if(!empty($cat)){ $sel='selected';
                                    }else{ $sel='';}?>

                                        <option value=""  <?php if($cat1=='') echo 'selected';?> <?php if($cat=='') echo 'selected';?>>All</option>    
                                        < <option  value="5"  <?php if($cat1=='5') echo 'selected';?> >Free</option> 

                                        <option value="1"  <?php if($cat1=='1') echo 'selected';?> >Level 1</option>

                                       <option value="2"  <?php if($cat1=='2') echo 'selected';?>  >Level 2</option>
                                       <option value="3"  <?php if($cat1=='3') echo 'selected';?> >Level 3</option>
                                       <option value="4"  <?php if($cat1=='4') echo 'selected';?> >Level 4</option>
                                        
                                                    </select>
                                            </fieldset>
                                        </div>
                                         <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                            <fieldset class="form-group mb-0">
                            <select class="custom-select round" name ="secltcust" id="customMonth" onchange="searchByMonth1(this.value);">
                                <?php if(!empty($cat)){ $sel='selected';
                                    }else{ $sel='';}?>

                                             <option value="0" <?php if($cat=='') echo 'selected';?>>All Month</option>
                    
                                                    
                                        <option  value="1" 
                                        <?php if($cat=='1') echo 'selected';?>>January</option>
                                        <option value="2" 
                                        <?php if($cat=='2') echo 'selected';?>>February</option>
                                        <option value="3" 
                                        <?php if($cat=='3') echo 'selected';?>>March</option>
                                        <option value="4" 
                                        <?php if($cat=='4') echo 'selected';?>>April</option>
                                        <option value="5" 
                                        <?php if($cat=='5') echo 'selected';?>>May</option>
                                        <option value="6" 
                                        <?php if($cat=='6') echo 'selected';?>>June</option>
                                        <option value="7" 
                                        <?php if($cat=='7') echo 'selected';?>>July</option>
                                        <option value="8" 
                                        <?php if($cat=='8') echo 'selected';?>>August</option>
                                        <option value="9" 
                                        <?php if($cat=='9') echo 'selected';?>>September</option>
                                        <option value="10"
                                         <?php if($cat=='10') echo 'selected';?>>October</option>
                                        <option value="11" 
                                        <?php if($cat=='11') echo 'selected';?>>November</option>
                                        <option value="12" 
                                        <?php if($cat=='12') echo 'selected';?>>December</option>
                                                    </select>
                                                </fieldset>
                                        </div>
                                    </div>
                                    
                                    
                                      
                                    <table class="table table-padded table-xl mb-0 user-list-tble" id="recent-project-table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Name</th>
                                                <th class="border-top-0">Subscription Plan</th>
                                                <th class="border-top-0">Price</th>
                                                <th class="border-top-0">Discount</th>
                                                <th class="border-top-0">Commission</th>
                                                <th class="border-top-0">Trainer Link</th>
                                                 <th class="border-top-0">Trainer Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($userList)){
                                              $planLevel='';
                                                foreach ($userList as $key => $value) {
                                                     if($value->PlanLevel==1){
                                                     $planLevel='Level 1';
                                                   }else if($value->PlanLevel==2){
                                                    $planLevel='Level 2';
                                                   }else if($value->PlanLevel==3){
                                                    $planLevel='Level 3';
                                                   }else if($value->PlanLevel==4){
                                                    $planLevel='Level 4';
                                                   }else{
                                                     $planLevel='Free';
                                                   } 
                                             
                                             ?>
                                            <tr>
                                                <td class="text-truncate align-middle">
                                                  <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){ ?>
                                                    <a href="<?php echo base_url().'admin/users/userInfo/'.encoding($value->id);?>"><?php echo $value->fullName; ?></a>
                                                  <?php }else{ ?>
                                                     <a href="<?php echo base_url().'admin/users/userDetails/'.encoding($value->id);?>"><?php echo $value->fullName; ?></a>
                                                  <?php }?>
                                                </td>                                                
                                                <td class="text-truncate align-middle">
                                                  
                                                    <span><?php echo $planLevel; ?></span>
                                                </td>
                                                <td class="text-truncate align-middle">
                                                    <span><?php echo'£'. $value->amount; ?></span>
                                                </td>
                                                <td class="text-truncate align-middle">
                                                    <span><?php echo'£'. $value->couponDiscount; ?></span>
                                                </td>
                                                <td class="text-truncate align-middle">
                                                    
                                                    <span><?php echo'£'. $value->trainerCommission; ?></span>
                                                </td>
                                                <td class="text-truncate align-middle">
                                                <?php echo $value->trainerLink;?>
                                                   

                                                </td>
                                                 <td class="text-truncate align-middle">
                                                    <?php echo $value->trainerSelect;?>
                                                </td>
                                            </tr>  

                                          <?php } ?>

                                           <?php } else{?>
                                            <tr>
                                                <td class="text-truncate align-middle">
                                                    NO USER FOUND
                                                </td>
                                            </tr>
                                            <?php }?>
                               
                                        </tbody>
                                    </table>
                                    <div class="col-xl-4 col-lg-4 col-md-4">
                                    <div class="table-responsive">

                                    <table class="table table-padded table-xl mb-0 user-list-tble">
                                     <thead>
                                         <tr>
                                            <th class="border-top-0">Total Commission</th>

                                            <th class="border-top-0">Total Discount</th>
                                        </tr>
                                            </thead>
                                            <tbody>

                                             <tr><td class="">
                                                <?php if(!empty($value->totalComm)){
                                                echo '£'. $value->totalComm; }else{
                                                	echo '£'.'0';
                                                } ?></td>

                                           
                                             <td class="">
                                                <?php if(!empty($value->totalDiscount)){
                                                echo '£'. $value->totalDiscount; }else{
                                                	echo '£'.'0';
                                                } ?></td>
                                            </tr>

                                             </tbody>
                                        </table>
                                     
                                         <!-- totalDiscount -->
                                     </div>
                                    </div>
                                     <div class="page_link">
                                    <?php echo $pagination; ?>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
 <script type="text/javascript">

 var data = $("#hash");
 var data12 = '';

var  baseurl='<?php echo base_url()?>admin/report/alluser_List';
var checkbx;
function searchByMonth1(vl){
   // alert(vl);
    var value1= ''; 
    var checkbx = '';
    
    ajax_fun33('<?php echo base_url(); ?>admin/report/alluser_List?month='+vl+'&customer='+checkbx+'&trainer='+value1);   

}

function searchByLevel(vl1){
	var vl= ''; 
    var checkbx = '';
    var value1= ''; 
   // alert(vl1);
   ajax_fun33('<?php echo base_url(); ?>admin/report/alluser_List?month='+vl+'&customer='+vl1+'&trainer='+value1);   
}



    
    function ajax_fun33(url)

    { 
        //var checkbx = $( "input:checked" ).length;
      //alert(checkbx);
        var sel = $("#customMonth").val();
        var sel1 = $("#searchlevel").val();
        var checkbx = $( "input:checked" ).length;
        //alert(checkbx);
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var value1=data12;
        var dataObject={page:url,csrf_test_name:value,userId:value1,mnt:sel,mycus:sel1,};
        $.ajax({
        type:'POST',
        url:url,
        data:dataObject,
        beforeSend: function () { 
             show_loader(); 
         },              
        success: function(data){ 
            //alert('ff');
              hide_loader(); 
            var allData=jQuery.parseJSON(data);
            $("#hash").attr('data-value',allData.hash);
            $("#rList").html(allData.data);

              
             $("#iscumtomer").attr('checked'); 
               if(checkbx==1){
              // $('.iscust').prop('checked', true);
                }
              
           // $('.iscust').prop('checked', true);
        }
    });
    }


                        

                        </script>                                    