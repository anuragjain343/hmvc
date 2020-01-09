
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

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <section id="minimal-statistics">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="subscrpitn-plan-lst">
                                <ul>
                                    
                                    <?php $totfree=0;
                                      if(!empty($level4Same1)){ 
                                      
                                      $tid =  $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
                                    foreach($level4Same1 as $value){
                                    if($value->commissionTrainerId == $tid AND $value->PlanLevel == '5'){
                                        $totfree= $totfree+1;
                                    }
                                    }
                                    } 

                                     $tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;
                                    if(!empty($level4Same)){ 
                                      // pr($level4Same);
                                      $tid =  $_SESSION[ADMIN_USER_SESS_KEY]['userId'];
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
                                       
                                    <li class="brdr-lft-warning">Level 3 other through their link<span class="pln-lst-price"><?php echo $tot2;?></span></li>

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
                                        <span class="float-right fnt-sze-price"><?php echo '£'. $tod; ?></span>
                                        Today
                                    </li>
                                    <?php $wek=0; if(!empty($week)){  foreach($week as $value){
                                            $wek=$wek+$value->couponDiscount;
                                        } }?>
                                    <li class="list-group-item">
                                        <span class="float-right fnt-sze-price"><?php echo '£'.$wek; ?></span>
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
                   
                    <div class="col-xl-12 col-lg-12 col-md-12" id="rList">   
                   </div>

                </div>
            </section>
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
    ajax_fun('<?php echo base_url().'admin/report/user_List'; ?>');
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
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
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
