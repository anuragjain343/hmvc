
                        <div class="card">            
                        <div class="card-content">
                            <div id="recent-projects" class="media-list position-relative">
                                <div class="table-responsive">
                                     <div class="row m-0 p-2">
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-6 text-right" style="line-height: 35px;">
                                           <fieldset class="form-group mb-0">  
                                                <input type="checkbox" class="iscust" name="promote" name="mycustomer" id="iscumtomer"/>
                                                <label for="switchery2" class="font-medium-1 m-0" >My Customer</label>
                                            </fieldset>
                                        </div>
                                         <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                            <fieldset class="form-group mb-0">
                            <select class="custom-select round" name ="secltcust" id="customMonth" onchange="searchByMonth(this.value);">
                                <?php if(!empty($cat)){ $sel='selected';
                                    }else{ $sel='';}?>

                                             <option value="0" <?php if($cat=='') echo 'selected';?>>All Month</option>
                    
                                                    
                                        <option  value="1" <?php if($cat=='1') echo 'selected';?>>January</option>
                                        <option value="2" <?php if($cat=='2') echo 'selected';?>>February</option>
                                        <option value="3" <?php if($cat=='3') echo 'selected';?>>March</option>
                                        <option value="4" <?php if($cat=='4') echo 'selected';?>>April</option>
                                        <option value="5" <?php if($cat=='5') echo 'selected';?>>May</option>
                                        <option value="6" <?php if($cat=='6') echo 'selected';?>>June</option>
                                        <option value="7" <?php if($cat=='7') echo 'selected';?>>July</option>
                                        <option value="8" <?php if($cat=='8') echo 'selected';?>>August</option>
                                        <option value="9" <?php if($cat=='9') echo 'selected';?>>September</option>
                                        <option value="10" <?php if($cat=='10') echo 'selected';?>>October</option>
                                        <option value="11" <?php if($cat=='11') echo 'selected';?>>November</option>
                                        <option value="12" <?php if($cat=='12') echo 'selected';?>>December</option>
                                                    </select>
                                                </fieldset>
                                        </div>
                                    </div>
                                    
                                        <!-- <div class="dsplay-blck-rgt">
                                            <div class="form-group">

                                                
                                            </div>
                                        </div>
                                       
                                            <div class="form-group">
                                            <label class="form-check-label">My Customer
                                            <input type="checkbox" name="mycustomer" class="form-control iscust" id="iscumtomer"></label>
                                            </div> -->
                                      
                                    <table class="table table-padded table-xl mb-0 user-list-tble" id="recent-project-table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Name</th>
                                                <th class="border-top-0">Subscription Plan</th>
                                                <th class="border-top-0">Price</th>
                                                <th class="border-top-0">Discount</th>
                                                <th class="border-top-0">Commission</th>
                                                <th class="border-top-0">My Customer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($userList)){
                                              $planLevel='';
                                                foreach ($userList as $key => $value) {
                                                     if($value->userLevel==1){
                                                     $planLevel='Level 1';
                                                   }else if($value->userLevel==2){
                                                    $planLevel='Level 2';
                                                   }else if($value->userLevel==3){
                                                    $planLevel='Level 3';
                                                   }else if($value->userLevel==4){
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

                                                <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='trainer'){
                                                if($value->trainerId == $_SESSION[ADMIN_USER_SESS_KEY]['userId']){
                                                    $cust='Yes';
                                                   }else{
                                                     $cust='No';
                                                   }
                                                }else{
                                                 if($value->trainerId == $trId){
                                                    $cust='Yes';
                                                   }else{
                                                     $cust='No';
                                                   }   
                                                }
                                            ?>
                                                    <span><?php echo $cust; ?></span>
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
                                    <div class="col-xl-3 col-lg-3 col-md-3">
                                    <div class="table-responsive">
                                        <table class="table table-padded table-xl mb-0 user-list-tble">
                                            <thead>
                                            <tr><th class="border-top-0">Total Commission</th></tr>
                                            </thead>
                                            <tbody>
                                             <tr><td class="text-truncate align-middle">
                                                <?php if(!empty($value->totalComm)){
                                                echo '£'. $value->totalComm; } ?></td></tr>
                                             </tbody>
                                        </table>
                                     
                                         
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
    var data12 = '<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['userId'];?>';

var  baseurl='<?php echo base_url()?>admin/report/user_List';
var checkbx;
function searchByMonth(vl){
   // alert(vl);
    var value1= data12; 
    var checkbx = $( "input:checked" ).length;
    
    ajax_fun33('<?php echo base_url(); ?>admin/report/user_List?month='+vl+'&customer='+checkbx+'&trainer='+value1);   

}
$('body').on('click',' .iscust', function(){

     var sel = $("#customMonth").val();
     var value1=data12; 
     //alert(value1);
    var checkbx = $( "input:checked" ).length;
    //alert(checkbx);
    ajax_fun33('<?php echo base_url(); ?>admin/report/user_List?month='+sel+'&customer='+checkbx+'&trainer='+value1);
 
});


    
    function ajax_fun33(url)

    { 
        //var checkbx = $( "input:checked" ).length;
      //alert(checkbx);
        var sel = $("#customMonth").val();


        var checkbx = $( "input:checked" ).length;
        //alert(checkbx);
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var value1=data12;
        var dataObject={page:url,csrf_test_name:value,userId:value1,mnt:sel,mycus:checkbx,};
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
               $('.iscust').prop('checked', true);
                }
              
           // $('.iscust').prop('checked', true);
        }
    });
    }
               
</script>                                    