<?php if(!empty($trainingData)){ ?>
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card-body back-crd-body">
                        <div id="carousel-example-generic" class="carousel slide mb-1" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php 
                                $image = json_decode($trainingData->image);
                                $image = array_values(array_filter($image, 'strlen'));
                                foreach ($image as $k => $val) {
                                if(!empty($val)){
                                        ?>
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <?php }
                                  }
                                    ?>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php 
                                    $image = json_decode($trainingData->image);
                                    $image = array_values(array_filter($image, 'strlen'));
                                    foreach ($image as $k => $val) {
                                            if(!empty($val)){
                                        ?>
                                        <div class="carousel-item <?php if($k==0){echo 'active';}?>">
                                            <img src="<?php echo base_url(RECOMMENDEDPRODUCTS_MEDIUM).$val;?>" class="d-block w-100" alt="First slide">
                                        </div>
                            <?php }
                        }
                        ?>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="la la-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!-- <h4 class="card-title">Card title</h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-info">Button</a>   -->  
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card blck-sec">
                        <div class="card-body nutrtin-ttle EditSec">
                            <div class="EditLeft">
                                <h4 class="card-title"><?php echo $trainingData->title; ?></h4>
                            </div>
                            <!-- <h6 class="card-subtitle text-muted">Video Embed Card With Header & Footer</h6> -->
                             <?php 
                              $base_url = base_url();  
                              $trainerId = $trainingData->id;
                              $clickDelete ="deleteTraining('$trainerId','$base_url')" ;
                            ?>
                            <div class="EditRight">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a href="javascript:void(0);" onclick="<?php echo $clickDelete;?>">
                                            <i class="ft-trash-2"></i>
                                        </a>
                                    </li>
                                    <li>
                                       <a href="<?php echo base_url()?>admin/RecommendedProducts/edit_recommendedProducts?id=<?php echo encoding($trainerId);?>"">
                                            <i class="ft-edit-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php  if(!empty($trainingData->video)){ ?>
                        <div id="carousel-area" class="carousel slide vedio-slde" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php 
                                    $video = json_decode($trainingData->video);
                                    $video = array_values(array_filter($video, 'strlen'));
                                    foreach ($video as $k => $val) { ?>
                                <li data-target="#carousel-area" data-slide-to="0" class="active"></li>
                               <?php } ?>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php 
                                    $video = json_decode($trainingData->video);
                                    $video = array_values(array_filter($video, 'strlen'));
                                    foreach ($video as $k => $val) { ?>
                                        <div class="carousel-item <?php if($k==0){echo 'active';}?>">
                                            <video controls="" class="VideoHeight">
                                                <source src="<?php echo base_url(RECOMMENDEDPRODUCTS_VIDEO).$val;?>" type="video/mp4">
                                            </video>
                                        </div>
                                   <?php } 
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-area" role="button" data-slide="prev">
                                <span class="la la-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-area" role="button" data-slide="next">
                                <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    <?php }?>
                    <?php if(empty($trainingData->pdf)){
                        $pdf = 'No PDF';
                    }else{
                       $pdf = 'Download PDF';
                    } ?>
                        <div class="card-body">
                            <p class="card-text"><?php echo $trainingData->description; ?></p>
                        </div>
                        <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                            <span class="float-left"><?php echo time_elapsed_string($trainingData->crd); ?></span>
                        <?php if(!empty($trainingData->pdf)){?>
                            <span class="tags float-right">
                                <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right" href="<?php echo !empty($trainingData->pdf) ? base_url().TC_PDFS.$trainingData->pdf : JSV0; ?>"" target="_blank">
                                    <span class="white">Download PDF</span>
                                    <i class="ft-download pl-1 white"></i>
                                </a>
                            </span>
                    <?php }?>
                        </div>
                    </div>
                </div>
            </div>
      </div>
</div>
<?php }?>
<script type="text/javascript">
    var deleteTraining = function (id,base_url){
    var csrf = $('#hashCsrf');
    var csrf_key = csrf.attr('data-keys');
    var csrf_hash = csrf.attr('data-values');
        bootbox.confirm({
            message: "Are you sure you want to delete this Recommended Products ?",
            buttons: {
                confirm: {
                    label: 'OK',
                    className: 'btn btn-primary'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-default'
                }
            },
            callback: function (result) {
                if (result){
                    var url = base_url + 'admin/recommendedProducts/delete_recommendedProducts';
                    $.ajax({
                        method: "GET",
                        url: url,
                        dataType: "json",
                        data:{
                            "csrf_test_name":csrf_hash,
                            id:id
                        },
                        beforeSend: function () { 
                            show_loader(); 
                        },
                        success: function (data){
                            hide_loader();
                        if (data.status == 1){ 
                            toastr.success(data.message);
                            window.setTimeout(function (){
                             window.location.href = data.url;
                            }, 2000);
                        }else{
                            toastr.error(data.message);
                            hashCsrf.attr('data-values',data.hash);
                            return data.data;
  
                        } 
                        },
                        
                       
                    });
                }
            }
        });

    }
$('#carousel-area').carousel({
        pause: true,
        interval: false
    });
</script>
<!-- <script type="text/javascript">
    if($('#empty').val()==''){
        $('#done').hide();
    }
</script> -->
