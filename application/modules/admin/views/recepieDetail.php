
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before">
        </div>
        <div class="content-header row mt-10"></div>
        <div class="row match-height">
            <?php  if(!empty($recepieData)){?>
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card p-20"> 
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="card border-info border-lighten-4">
                                <div class="card-content">
                                    <?php 
                                            if(!empty($recepieData->image)){
                                                if(file_exists(RECEPIE_THUMB.$recepieData->image)){
                                                    $fileName = base_url().RECEPIE_THUMB.$recepieData->image;
                                                }else{
                                                    $fileName = base_url().DEFAULT_RECEPIE_IMAGE;
                                                }
                                            }else{

                                                $fileName = base_url().DEFAULT_RECEPIE_IMAGE; 
                                            } 
                                        
                                    ?>
                                    <img class="card-img-top img-fluid" src="<?php echo $fileName;?>" alt="Card image cap">
                                    <div class="card-body">
                                        <div class="text-center mt-1 lkes-vews-icn-count">
                                            <ul class="list-inline mb-1">
                                                <li class="pr-1">
                                                    <a href="javascript:void(0);" class="">
                                                    <span class="la la-thumbs-o-up"></span> <?php echo $recepieLike;?></a>
                                                </li>
                                                <li class="pr-1 line-hgt">
                                                    <a href="#" class="">
                                                    <span class="ft-eye"></span> <?php echo $recipeView;?> Views</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                                $base_url = base_url();  
                                 //$articleId = $articleData->id;
                                $recepieDelete ="recepieDelete('$recepieData->rId','$base_url')" ;
                                $csrf = get_csrf_token()['hash'];
                            ?>
                            <input type="hidden" id="hashCsrf" data-values="<?php echo $csrf;?>"  data-keys="<?php echo get_csrf_token()['name'];?>">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pl-0">
                            <div class="card-header cstm-crd-header2">
                                <h4 class="card-title">
                                    <a href="javascript:void(0);" class="pr-5 d-block"><?php echo $recepieData->title;?></a>
                                </h4>
                                <a class="heading-elements-toggle">
                                    <i class="la la-ellipsis-v font-medium-3"></i>
                                </a>
                                <div class="heading-elements heding-elmnt-top">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a onclick="<?php echo $recepieDelete; ?>">
                                            <i class="ft-trash-2"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <?php if($recepieData->recepieStatus==1){?>
                                       <a  href="<?php echo base_url()?>admin/recepie/editRecepie?id=<?php echo encoding($recepieData->rId);?>" ">
                                            <i class="ft-edit-2"></i>
                                        </a>
                                    <?php }else{?>
                                         <a  href="<?php echo base_url()?>admin/recepie/addRecepie?id=<?php echo encoding($recepieData->rId);?>" ">
                                            <i class="ft-edit-2"></i>
                                        </a>
                                    <?php }?>
                                    </li>
                                </ul>
                            </div>
                            <?php $userId = encoding($recepieData->addedById); ?>
                                <p class="card-subtitle text-muted mb-0 pt-1">
                                <span class="font-small-3"><?php echo time_elapsed_string($recepieData->created);?><a href="<?php echo base_url()?>admin/trainers/trainerDetails/<?php echo $userId;?>/<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];?>/<?php echo $recepieData->addedBy;?>"> <?php echo $recepieData->fullName;?> </a></span>
                                </p>
                                <p><?php echo $recepieData->description; ?></p>
                                    <?php                                             
                                        if(!empty($recepieData->video)){
                                            //$fileName = 'uploads/profile/thumb/'.$query->profile_image;
                                                if(file_exists(RECEPIE_VIDEO.$recepieData->video)){
                                                    $fileVideo = base_url().RECEPIE_VIDEO.$recepieData->video;
                                                }else{
                                                    $fileVideo = base_url();
                                                }
                                            }else{

                                                $fileVideo = base_url(); 
                                        }

                                    ?>
                                    <?php if(!empty($recepieData->video)){ ?>
<!--                                 <div id="carousel-area" class="carousel slide vedio-slde" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-area" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-area" data-slide-to="1"></li>
                                        <li data-target="#carousel-area" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <video controls="">
                                                <source src="<?php echo $fileVideo;?>" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-area" role="button" data-slide="prev">
                                        <span class="la la-angle-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-area" role="button" data-slide="next">
                                        <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div> -->
                                <div class="slide vedio-slde">
                                    <video controls="">
                                        <source src="<?php echo $fileVideo;?>" type="video/mp4">
                                    </video>
                                </div>
                            <?php }?>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        </div>
      </div>
</div>
