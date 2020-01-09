 
    <?php 

    $commyr = array(); 
   $dta =  json_encode($MonthComm);
   $dtaDis =  json_encode($MonthDisc);
   $wDis =  json_encode($WeekDisc);
   $wcom =  json_encode($WeekComm);


   $ycom =  json_encode($yearCom);
   $ydis =  json_encode($yearDis);
   //print_r($dta);

    ?>
<input type="hidden" name="chrtvl" id="chartValue" value='<?php echo $dta; ?>'>
<input type="hidden" name="chrtvl1" id="chartValue1" value='<?php echo $dtaDis; ?>'>
<input type="hidden" name="chrtvl2" id="chartValue2" value='<?php echo $wDis; ?>'>
<input type="hidden" name="chrtvl3" id="chartValue3" value='<?php echo $wcom; ?>'>

<input type="hidden" name="chrtvl4" id="chartValue4" value='<?php echo $ycom; ?>'>
<input type="hidden" name="chrtvl5" id="chartValue5" value='<?php echo $ydis; ?>'>



  <?php $backend = base_url()."backend_assets/";?>
<?php if(!empty($trainer)){ ?>  
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="ui-block">
                                <div class="top-header">
                                    <div class="top-header-thumb">
                                        <?php if(!empty($trainer->bannerImage)){ $link = BANNER_IMAGE.$trainer->bannerImage;}else{ $link = BANNER_DEFAULT;  }?>
                                        <img src="<?php echo base_url($link);?>">
                                    </div>                                    
                                    <div class="top-header-author">
                                        <?php if(!empty( $trainer->profileImage)){ ?>
                                        <img src="<?php echo base_url().TRAINER_PROFILE_THUMB.$trainer->profileImage;?>">
                                        <?php } else{?>
                                        <img src="<?php echo base_url(). DEFAULT_IMAGE;?>">
                                        <?php } ?>
                                        <div class="my-1">
                                            <label class="tranr-pcture"><?php echo $trainer->fullName;?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-section back-whte-clr">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <ul class="nav cstm-nav nav-pills">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="Basic-tab" data-toggle="pill" href="#Basic" aria-expanded="true">Basic Info</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="Videos-tab" data-toggle="pill" href="#Videos" aria-expanded="false">Training Videos</a>
                                                        </li>
                                                         <li class="nav-item">
                                                            <a class="nav-link" id="VideosInfo-tab" data-toggle="pill" href="#VideosInfo" aria-expanded="false">Informational<br>Videos</br></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link recpi" id="Recipes-tab" data-toggle="pill" href="#Recipes" aria-expanded="true">Recipes</a>
                                                        </li>
                                                         <li class="nav-item">
                                                            <a class="nav-link" id="Forum-tab" data-toggle="pill" href="#Forum" aria-expanded="true">Forum</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="Articles-tab" data-toggle="pill" href="#Articles" aria-expanded="false">Articles</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="Customers-tab" data-toggle="pill" href="#Customers" aria-expanded="false">Customers</a>
                                                        </li>
                                                         <li class="nav-item">
                                                            <a class="nav-link" id="Report-tab" data-toggle="pill" href="#Report" aria-expanded="false">Report</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content back-whte-clr mt-20">
                                    <div class="card-body">
                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel" class="tab-pane active" id="Basic" aria-labelledby="Basic-tab" aria-expanded="true">
                                                <div class="list-group">
                                                    <!-- <a href="#" class="list-group-item trainr-prfle active">Basic Info</a> -->
                                                    <div class="infoBlock">
                                                        <label>Full Name</label>
                                                        <p><?php echo $trainer->fullName;?></p>
                                                    </div>
                                                    <div class="infoBlock">
                                                        <label>Email</label>
                                                        <p><?php echo $trainer->email;?></p>
                                                    </div>
                                                    <div class="infoBlock brdr-none">
                                                        <label>Bio</label>
                                                        <p><?php echo $trainer->details;?></p>
                                                    </div>
                                                     <div class="infoBlock brdr-none">
                                                        <label>Referral Link</label>
                                                        <p><a href="<?php echo base_url().'?referralLink='.encoding($trainer->id);?>"><?php echo base_url().'?referralLink='.encoding($trainer->id);?></a></p>
                                                    </div>
                                                </div>
                                            </div>

                                <div class="tab-pane" id="Videos" role="tabpanel" aria-labelledby="Videos-tab" aria-expanded="false">
                                <div class="mt-30">
                                <span id="trainingVideo"></span>
                                </div>        
                                </div>
                                <div class="tab-pane" id="VideosInfo" role="tabpanel" aria-labelledby="VideosInfo-tab" aria-expanded="false">
                                <div class="mt-30">
                                    <span id="infovideo"></span>
                                </div>
                                </div>
                                        
                                       
                                        <!-- end of info video -->

                                            <div class="tab-pane" id="Recipes" role="tabpanel" aria-labelledby="Recipes-tab" aria-expanded="false">
                                                <span id="rpList"></span>
                                            </div>

                                            <div class="tab-pane" id="Forum" role="tabpanel" aria-labelledby="Forum-tab" aria-expanded="false">
                                                <span id="fList"></span>
                                            </div>

                                            <div class="tab-pane" id="Articles" role="tabpanel" aria-labelledby="Articles-tab" aria-expanded="false">
                                                <span id="aList"></span>
                                            </div>

                                            <div class="tab-pane" id="Customers" role="tabpanel" aria-labelledby="Customers-tab" aria-expanded="false">
                                                <div class="card-content">
                                                    <span id="cList"></span>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Report" role="tabpanel" aria-labelledby="Report-tab" aria-expanded="false">
                                                <div class="card-content">

                                                   
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="subscrpitn-plan-lst">
                                        <ul>
                                            <?php  $totfree=0;
            if(!empty($level4Same2))
            {        $tid =  $trainer->id;          
            foreach($level4Same2 as $value){

            if($value->commissionTrainerId == $tid AND $value->PlanLevel == '5'){
                                            $totfree = $totfree+1;
                                        }
                                    }
                                }
                                        ?>

                                            <?php $tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;
                                            if(!empty($level4Same)){ 
                                              // pr($level4Same);
                                              $tid =  $trainer->id;
                                                foreach($level4Same as $value){
                                                    if($value->commissionTrainerId == $tid AND $value->trainerId == $tid AND $value->userPlan=='3'){
                                                        $tot1 = $tot1+1;
                                                    }else if($value->commissionTrainerId == $tid AND $value->trainerId != $tid AND $value->userPlan=='3'){
                                                         $tot2 = $tot2+1;
                                                    }else if($value->commissionTrainerId == $tid AND $value->trainerId == $tid AND $value->userPlan=='4'){
                                                         $tot3 = $tot3+1;
                                                    }else if($value->commissionTrainerId == $tid AND $value->trainerId != $tid AND $value->userPlan=='4'){
                                                         $tot4 = $tot4+1;
                                                    }else if($value->commissionTrainerId == $tid AND $value->trainerId == '1' AND $value->userPlan=='1'){
                                                         $tot5 = $tot5+1;
                                                    }else if($value->commissionTrainerId == $tid AND $value->trainerId == '1' AND $value->userPlan=='2'){
                                                         $tot6 = $tot6+1;
                                                    }
                                                    else{
                                                        // $tot6 = $tot5+1;
                                                    }
                                                
                                                }
                                            }
                                            ?>


                                            <li class="brdr-lft-info">Free subscription through their link<span class="pln-lst-price"><?php echo $totfree;?></span></li>
                                            <div class="brdr-lne"></div>
                                           
                                             <li class="brdr-lft-theme">Level 1 through their link<span class="pln-lst-price"><?php echo $tot5;?></span></li>

                                            <div class="brdr-lne"></div>
                                             

                                            <li class="brdr-lft-pink">Level 2 through their link<span class="pln-lst-price"><?php echo $tot6;?></span></li>

                                            <div class="brdr-lne"></div>
                                              
                                                
                                            <li class="brdr-lft-warning">Level 3 through their link<span class="pln-lst-price"><?php echo $tot1;?></span></li>

                                            <div class="brdr-lne"></div>
                                               
                                            <li class="brdr-lft-warning"fList>Level 3 other through their link<span class="pln-lst-price"><?php echo $tot2;?></span></li>

                                            <div class="brdr-lne"></div>
                                              
                                              <li class="brdr-lft-pink">Level 4 through their link<span class="pln-lst-price"><?php echo $tot3;?></span></li>

                                              <div class="brdr-lne"></div>
                                                
                                                
                                              <li class="brdr-lft-pink">Level 4 other through their link<span class="pln-lst-price"><?php echo $tot4;?></span></li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                <div class="card chart-vegan">
                                    <div class="card-header dsplay-blck">
                                        <h4 class="card-title crd-ttle-spacng ttle-head dsplay-blck-lft">Column Chart</h4>
                                        <div class="dsplay-blck-rgt">
                                            <div class="form-group">
                                                <fieldset class="form-group mb-0">
                    <select class="custom-select round" id="customSelect">
                        
                        <option selected="" value="day">Day</option>
                        <option value="month">Month</option>
                        <option value="year">Year</option>
                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <div class="height-400">
                                                <canvas id="column-chart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h4 class="card-title mb-0 ttle-head">Commission</h4>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <?php $tod=0; if(!empty($today)){  foreach($today as $value){
                                                    $tod=$tod+$value->trainerCommission;
                                                } }?>
                                                <span class="float-right fnt-sze-price"><?php echo'£'. $tod;?></span>
                                                Today
                                            </li>
                                            <li class="list-group-item">
                                                  <?php $wek=0; if(!empty($week)){  foreach($week as $value){
                                                    $wek=$wek+$value->trainerCommission;
                                                } }?>
                                                <span class="float-right fnt-sze-price"><?php echo'£'. $wek;?></span>
                                                This Week
                                            </li>
                                            <li class="list-group-item">
                                                   <?php  $mnt=0; if(!empty($month)){ foreach($month as $value){
                                                    $mnt=$mnt+$value->trainerCommission;
                                                } }?>
                                                <span class="float-right fnt-sze-price"><?php echo'£'. $mnt;?></span>
                                                This Month
                                            </li>
                                        </ul>
                                        <div class="card-body">
                                            <h4 class="card-title mb-0 ttle-head">Discount</h4>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                              <?php $tod=0; if(!empty($today)){  foreach($today as $value){
                                                    $tod=$tod+$value->couponDiscount;
                                                } }?>
                                            <li class="list-group-item">
                                                <span class="float-right fnt-sze-price"><?php echo'£'. $tod; ?></span>
                                                Today
                                            </li>
                                            <?php $wek=0; if(!empty($week)){  foreach($week as $value){
                                                    $wek=$wek+$value->couponDiscount;
                                                } }?>
                                            <li class="list-group-item">
                                                <span class="float-right fnt-sze-price"><?php echo'£'. $wek; ?></span>
                                                This Week
                                            </li>
                                            <?php $mnt=0; if(!empty($month)){  foreach($month as $value){
                                                    $mnt=$mnt+$value->couponDiscount;
                                                } }?>
                                            <li class="list-group-item">
                                                <span class="float-right fnt-sze-price"><?php echo'£'. $mnt;?></span>
                                                This Month
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >

                            <input type="hidden" id="repid" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo $trainer->id;;?>" >
                           
                            <div class="col-xl-12 col-lg-12 col-md-12" id="rListdd">   
                           </div>
                        </div>
                                            </div>

                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
      </div>
</div>
</div>
<?php }?>

<input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>" >
<input type="hidden" name="" id="userId" value="<?php echo $trainer->id;?>">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }


 //recepie listing ajax function recpi

 



 $('#Articles-tab').on('click',function(){
    ajax_fun1('admin/trainers/trainerArtList','2');
  });


    //article listing ajaxfunction
    var data = $("#hash");
    ajax_fun1('admin/trainers/trainerArtList','2');
    function ajax_fun1(url,slag=''){ 
      console.log('article');
        if(slag==2){
            var base_url1 = '<?php echo base_url();?>'+url;
        }else{
            var base_url1 = url;
        }
        
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var userId = $('#userId').val();
        alert
        var dataObject={page:url,csrf_test_name:value,userId:userId};
    $.ajax({
        type:'POST',
        url:base_url1,
        data:dataObject,
      
        beforeSend: function () { 
             show_loader(); 
         },              
        success: function(data){ 
              hide_loader(); 
            var allDataa=jQuery.parseJSON(data);
            $("#hash").attr('data-value',allDataa.hash);
            $("#aList").html(allDataa.data);
        }
    });
    }

    //user listing ajaxfunction

     $('#Customers-tab').on('click',function(){
   ajax_fun2('admin/trainers/trainerCustomerList','2');
  });


    var data = $("#hash");
   
    function ajax_fun2(url,slag=''){ 
      console.log('article');
        if(slag==2){
            var base_url1 = '<?php echo base_url();?>'+url;
        }else{
            var base_url1 = url;
        }
        
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var userId = $('#userId').val();
        var dataObject={page:url,csrf_test_name:value,userId:userId};
    $.ajax({
        type:'POST',
        url:base_url1,
        data:dataObject,
      
        beforeSend: function () { 
             show_loader(); 
         },              
        success: function(data){ 
              hide_loader(); 
            var allDataa=jQuery.parseJSON(data);
            $("#hash").attr('data-value',allDataa.hash);
            $("#cList").html(allDataa.data);
        }
    });
    }

    var data = $("#hash");
    var data12 = $("#repid");
   
    $('#Report-tab').on('click',function(){
    ajax_fun33('<?php echo base_url().'admin/trainers/report_user_List'; ?>');
    });


var  baseurl='<?php echo base_url()?>admin/trainers/report_user_List';
var checkbx;
function searchByMonth1(vl){
    var value1=data12.attr('data-value'); 
    var checkbx = $( "input:checked" ).length;
    ajax_fun33('<?php echo base_url(); ?>admin/trainers/report_user_List?month='+vl+'&customer='+checkbx+'&trainer='+value1);   

}

$('body').on('click',' .iscust', function(){

     var sel = $("#customMonth").val();
     var value1=data12.attr('data-value'); 
     //alert(value1);
    var checkbx = $( "input:checked" ).length;
    //alert(checkbx);
    ajax_fun33('<?php echo base_url(); ?>admin/trainers/report_user_List?month='+sel+'&customer='+checkbx+'&trainer='+value1);
 
});


    
    function ajax_fun33(url)
    { 
        //alert(url);
         var sel = $("#customMonth").val();
       // var selectval = sel.attr('value');

        var checkbx = $( "input:checked" ).length;
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var value1=data12.attr('data-value');
        //alert(value1);
        var dataObject={page:url,csrf_test_name:value,userId:value1,mnt:sel,mycus:checkbx,};
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
            $("#rListdd").html(allData.data);

               $("#iscumtomer").attr('checked'); 
               if(checkbx==1){
               $('.iscust').prop('checked', true);
                }
              
            
        }
    });
    }



    var data = $("#hash");

 $('#Forum-tab').on('click',function(){
   ajax_fu44('<?php echo base_url().'admin/trainers/forum_List'; ?>');
  });

    function ajax_fu44(url){

        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var value1=data12.attr('data-value');
        var dataObject={page:url,csrf_test_name:value,userId:value1};

     $.ajax({
        type:'POST',
        url:url,
        data:dataObject,
        beforeSend: function (){ 
             show_loader(); 
         },              
        success: function(data){ 
            hide_loader(); 
            var allData=jQuery.parseJSON(data);
            $("#hash").attr('data-value',allData.hash);
            $("#fList").html(allData.data);
        }
     });
     
    }

 $('#Videos-tab').on('click',function(){
   ajax_fu55('<?php echo base_url().'admin/trainers/trainingVideo_List'; ?>');
  });


    var data = $("#hash");
    
    function ajax_fu55(url)
    {// alert(url);
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var value1=data12.attr('data-value');
        var dataObject={page:url,csrf_test_name:value,userId:value1};
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
            $("#trainingVideo").html(allData.data);
        }
    });
    }
   var data = $("#hash");
   
    $('#VideosInfo-tab').on('click',function(){
     ajax_fun66('<?php echo base_url().'admin/trainers/infoVideo_List'; ?>');
  });
   
    function ajax_fun66(url)
    { 
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var value1=data12.attr('data-value');
        var dataObject={page:url,csrf_test_name:value,userId:value1};
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
            $("#infovideo").html(allData.data);
        }
    });
    }
  
$(document).on('click','#Recipes-tab',function(){

  setTimeout(function(){
    var element = $('.tab-container li');
    var slider = $('.tab-container');
    var sliderWrapper = $('.wrapper-slider');
    var totalWidth = sliderWrapper.innerWidth();
    var elementWidth = element.outerWidth();
    var sliderWidth = 0;
    var positionSlideX = slider.position().left;
    var newPositionSlideX = 0;

      sliderWrapper.append('<span class="prev-slide"><</span><span class="next-slide">></span>');

      element.each(function(){
        sliderWidth = sliderWidth + $(this).outerWidth() + 10;
      });
    

      slider.css({
        'width': sliderWidth
      });

      $('.next-slide').click(function(){
        if(newPositionSlideX>(totalWidth-sliderWidth)){
          newPositionSlideX = newPositionSlideX - elementWidth;
          slider.css({
            'left' : newPositionSlideX
         }, check());
        };
      });

      $('.prev-slide').click(function(){
        if(newPositionSlideX>=-sliderWidth){
          newPositionSlideX = newPositionSlideX + elementWidth;
          console.log(newPositionSlideX);
          slider.css({
            'left' : newPositionSlideX
         }, check());
        };
      });

      function check() {
        if( sliderWidth >= totalWidth && newPositionSlideX > (totalWidth-sliderWidth)){
           $('.next-slide').css({
            'right' : 0
          });
        } else {
           $('.next-slide').css({
            'right' : -$(this).width()
          });
        };

        if( newPositionSlideX < 0){
           $('.prev-slide').css({
            'left' : 0
          });
        } else {
          $('.prev-slide').css({
            'left' : -$(this).width()
          });
        };
      };

      $(window).resize(function(){
        totalWidth = sliderWrapper.innerWidth();
        check();
      });
      check();
  },0);
    
});


    var data = $("#hash");
 ajax_fun('admin/trainers/trainerRecListing','1');
    function ajax_fun(url,flag=''){ 

        console.log('recepie');
        if(flag==1){
            var base_url1 = '<?php echo base_url();?>'+url;

            
        }else{
            var base_url1 = url;

        }
        var csrf_test_name=data.attr('data-name');
        var value=data.attr('data-value');
        var userId = $('#userId').val();
        var dataObject={page:url,csrf_test_name:value,userId:userId};
    $.ajax({
        type:'POST',
        url:base_url1,
        data:dataObject,
      
        beforeSend: function () { 
             show_loader(); 
         },              
        success: function(data){ 
              hide_loader(); 
            var allData=jQuery.parseJSON(data);
            $("#hash").attr('data-value',allData.hash);
            $("#rpList").html(allData.data);
        }
    });
    }

    // getcommis('<?php echo $dta; ?>');
   
     
// Column chart
 
// ------------------------------
//$(window).on("load", function(){
   // var ctx = document.getElementById('column-chart').getContext('2d');
   

    var commsvl = $('#chartValue').attr('value');
    var commsvl1 = $('#chartValue1').attr('value');

    var wkcom = $('#chartValue2').attr('value');
    var wkdis = $('#chartValue3').attr('value');

    var ycom = $('#chartValue4').attr('value');
    var ydis = $('#chartValue5').attr('value');


    var allwkcom= jQuery.parseJSON(wkcom);
    var allwkdis= jQuery.parseJSON(wkdis);

    var allData= jQuery.parseJSON(commsvl);
    var allData1= jQuery.parseJSON(commsvl1);
   

    var yearCo = jQuery.parseJSON(ycom);
    var yearDis= jQuery.parseJSON(ydis);

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#column-chart");

    // Chart Options
    var chartOptions = {
        // Elements options apply to all of the options unless overridden in a dataset
        // In this case, we are setting the border of each bar to be 2px wide and green
        elements: {
            rectangle: {
                borderWidth: 2,
                borderColor: 'rgb(0, 255, 0)',
                borderSkipped: 'bottom'
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration:500,
        legend: {
            position: 'top',
        },

        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                   // drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    //drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }]
        },
        title: {
            display: false,
            text: 'Chart.js Bar Chart'
        }
    };


    // Chart Data
    var chartData = {
        labels: ["January", "February", "March", "April", "May", "June","July","August","September","October","November","December"],
        datasets: [{
            label: "Commission",
            data: [allData['jn'],allData['fb'], allData['mr'],allData['ap'], allData['my'], allData['ju'],allData['jl'], allData['au'], allData['sp'], allData['ot'], allData['no'], allData['de']],
            backgroundColor: "#8cdad8",
            hoverBackgroundColor: "#8cdad8",
            borderColor: "transparent"
        }, {
            label: "Discount",
            data: [allData1['jn'],allData1['fb'], allData1['mr'],allData1['ap'], allData1['my'], allData1['ju'],allData1['jl'], allData1['au'], allData1['sp'], allData1['ot'], allData1['no'], allData1['de']],
            backgroundColor: "#1e90ff",
            hoverBackgroundColor: "#1e90ff",
            borderColor: "transparent"
        }]
    };

    var chartDataToday = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday","Saturday","Sunday"],
        datasets: [{
            label: "Commission",
           
            data: [allwkdis['mo'],allwkdis['tu'], allwkdis['we'],allwkdis['th'],allwkdis['fr'],allwkdis['st'],allwkdis['su']],
            backgroundColor: "#8cdad8",
            hoverBackgroundColor: "#8cdad8",
            borderColor: "transparent"
        }, {
            label: "Discount",
           data: [allwkcom['mo'],allwkcom['tu'], allwkcom['we'],allwkcom['th'],allwkcom['fr'],allwkcom['st'],allwkcom['su']],
            backgroundColor: "#1e90ff",
            hoverBackgroundColor: "#1e90ff",
            borderColor: "transparent"
        }]
    };
    

 var chartDataYear = {
        labels: ["2013", "2014", "2015", "2016", "2017","2018","2019"],
        datasets: [{
            label: "Commission",
            data: [yearCo['mo'],yearCo['tu'], yearCo['we'],yearCo['th'],yearCo['fr'],yearCo['st'],yearCo['su']],
            backgroundColor: "#8cdad8",
            hoverBackgroundColor: "#8cdad8",
            borderColor: "transparent"
        }, {
            label: "Discount",
            data: [yearDis['mo'],yearDis['tu'], yearDis['we'],yearDis['th'],yearDis['fr'],yearDis['st'],yearDis['su']],
            backgroundColor: "#1e90ff",
            hoverBackgroundColor: "#1e90ff",
            borderColor: "transparent"
        }]
    };

   

$(document).ready(function(){
    var myBar ='';
    bar_chat(chartDataToday);
});
    // Create the chart

    $('#customSelect').on('change',function(e) {
        var case_value = this.value;
        myBar.destroy(); //destroy old chart
     
        switch(case_value){
        case"day":
            bar_chat(chartDataToday);
        break;
        case"month":
            bar_chat(chartData);
        break;
        
        case"year":
            bar_chat(chartDataYear);
        break;
    }
});


var bar_chat = function(bar_Data) {
// myBar.destroy();
  //var ctx = document.getElementById("canvas").getContext("2d");
  myBar = new Chart(ctx, {
    type: "bar",
    data: bar_Data,
    options: chartOptions
  });
};

</script>

