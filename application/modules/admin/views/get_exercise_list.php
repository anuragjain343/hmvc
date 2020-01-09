 <?php if(!empty($categoryIdMenu)){
        if($categoryIdMenu == 1){ $header = 'Exercise Instruction';}elseif ($categoryIdMenu == 2) { $header = 'Substituting Exercises';  }elseif($categoryIdMenu == 3){$header = 'Abdominal Work';}elseif($categoryIdMenu == 4){$header = 'Sets Reps & Timing Guidance';}elseif($categoryIdMenu == 5){$header = 'Types of Grip';}elseif($categoryIdMenu == 6){$header = 'Stretching';}elseif($categoryIdMenu == 7){$header = 'Glute Activation';}elseif($categoryIdMenu == 8){$header = 'Common Postural Problems';}else{$header = 'All';}
        }else{ $header = 'All';}
        if(!empty($categoryIdMenu)){
            $catTrainId = $categoryIdMenu;
        }else{
            $catTrainId = '';
        }
    ?>
    <div class="app-content content">
          <div class="content-wrapper">        
            <div class="content-wrapper-before Hedtxt">
                <h2 class="ml-2"><?php echo $header;?> (<?php if(!empty($total_article)) { echo $total_article;}else{ echo '0';}?>)</h2>
                <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right mr-2" href="<?php echo base_url();?>admin/Training/addExercise?catTrainId=<?php echo encoding($catTrainId); ?>">
                    <span class="white">Add New</span>
                    <i class="ft-file-text white"></i>
                </a>
            </div>
                <div class="content-header row mt-10"></div> 
                <div class="row match-height">
                <?php

                 if(!empty($exerciseList)){  ?>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card mrgn-tp-crd">            
                        <div class="card-content">
                            <div id="recent-projects" class="media-list position-relative">
                                <div class="table-responsive">
                                    <table class="table table-padded table-xl mb-0 user-list-tble" id="recent-project-table">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Heading</th>
                                                <th class="border-top-0">Posted By</th>
                                                <th class="border-top-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($exerciseList as $value){
                                                    if($value->addedBy == 'trainer'){
                                                        $path = TRAINER_PROFILE_THUMB;   
                                                    }else{
                                                        $path = ADMIN_PROFILE_THUMB;   
                                                    }
                                                ?>
                                            <tr>
                                                <td class="text-truncate wdth-fix">
                                                    <a href="<?php echo base_url()?>admin/Training/training_detail/<?php echo encoding($value->id);?>">
                                                    <h4 class="card-title mrb-5" id="fixTitle"><?php echo strip_tags($value->title);?></h4></a>
                                                    <p class="mrb-0"><?php echo strip_tags($value->description);?></p>
                                                </td>
                                                <td class="text-truncate align-middle media">
                                                    <ul class="list-unstyled users-list m-0 mr-1">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="" class="avatar avatar-sm width-cstm pull-up">
                                                            <?php if(!empty($value->profileImage)){?>
                                                        <img class="media-object rounded-circle" src="<?php echo base_url().TRAINER_PROFILE_THUMB.$value->profileImage; ?>" alt="Avatar">
                                                            <?php }else{?>
                                                        <img class="media-object rounded-circle" src="<?php echo base_url().DEFAULT_IMAGE; ?>" alt="Avatar">
                                                            <?php }?>
                                                        </li>
                                                    </ul>

                                                    <?php

                                                   $userId = encoding($value->addedById);

                                                    ?>
                                                    <?php 
                                                        $base_url = base_url();  
                                                        $trainerId = $value->id;
                                                         $clickDelete ="deleteTraining('$trainerId','$base_url')" ;
                                                    ?>
                                                    <div class="media-body psted-by-text">
                                                        <h5 class="mt-0"><?php echo time_elapsed_string($value->crd);?> By <a href="<?php echo base_url()?>admin/trainers/trainerDetails/<?php echo $userId;?>/<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];?>/<?php echo $value->addedBy;?>"><?php echo $value->fullName;?></a></h5>
                                                    </div>
                                                </td>                                                

                                                <?php
                                                    $csrf = get_csrf_token()['hash'];?>
                                                    <input type="hidden" id="hashCsrf" data-values="<?php echo $csrf;?>"  data-keys="<?php echo get_csrf_token()['name'];?>">
                                                    <td class="align-middle eye-style">
                                                    <a href="<?php echo base_url()?>admin/Training/training_detail/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>
                                                    <a href="javascript:void(0);" onclick="<?php echo $clickDelete; ?>">
                                                        <i class="ft-trash-2"></i></a>
                                                            <a href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding($value->id);?>" ">
                                                                <i class="ft-edit-2"></i>
                                                            </a>
                                                </td>
                                            </tr>                                
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                         <div class="page_link">
                                    <?php echo $pagination; ?>
                                   </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php }else{ ?>
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card mrgn-tp-crd p-30">
                            <div class="card-content text-center">                           
                                <div id="records">No Records Found</div> 
                            </div>
                        </div>
                    </div> 
            </div>
            </div>  
      </div>

  <?php }?>
     
  </div>

<script type="text/javascript">
    //delete Training
    var deleteTraining = function (id,base_url){
    var csrf = $('#hashCsrf');
    var csrf_key = csrf.attr('data-keys');
    var csrf_hash = csrf.attr('data-values');
        bootbox.confirm({
            message: "Are you sure you want to delete this training ?",
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
                    var url = base_url + 'admin/Training/delete_trainning';
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
</script>
