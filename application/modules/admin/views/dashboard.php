<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <section id="minimal-statistics">
                <div class="row">
                     <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <a href="<?php echo base_url();?>admin/users">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-users icon-opacity info font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Users</span>
                                                <h1 class="info mb-0"><?php if(!empty($total_user)){ echo $total_user; }else{ echo 0;}?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } else{ ?>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                        <a href="<?php echo base_url();?>admin/trainers/customers">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-users icon-opacity info font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Customers</span>
                                                <h1 class="info mb-0"><?php echo $total_customer;?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php }?>
                    <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <a href="<?php echo base_url();?>admin/video">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-video icon-opacity warning font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Videos</span>
                                                <h1 class="warning mb-0"><?php if(!empty($total_video)){ echo $total_video; }else{ echo 0;}?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }else{?>
                   <div class="col-xl-4 col-lg-6 col-md-12">
                        <a href="<?php echo base_url();?>admin/video">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-video icon-opacity warning font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Videos</span>
                                                <h1 class="warning mb-0"><?php if(!empty($total_video)){ echo $total_video; }else{ echo 0;}?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div> 
                <?php }?>
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <a href="<?php echo base_url()?>admin/recepie">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-book icon-opacity success font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Recipes</span>
                                                <h1 class="success mb-0"><?php echo $total_recepie; ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <a href="<?php echo base_url()?>admin/article">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-file-text icon-opacity danger font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Articles</span>
                                                <h1 class="danger mb-0"><?php echo $total_article;?></h1>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <a href="<?php echo base_url().'admin/trainers';?>">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-life-buoy icon-opacity info font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Trainers</span>
                                                <h1 class="info mb-0"><?php if(!empty($total_trainer)){ echo $total_trainer; }else{ echo 0 ;} ?></h1>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php }?>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <a href="<?php echo base_url()?>admin/forum">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-list icon-opacity danger font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Forums</span>
                                                <h1 class="danger mb-0"><?php echo $total_forum;?></h1>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                      <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <a href="<?php echo base_url()?>admin/training/edit_training?id=<?php echo encoding(1);?>">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-anchor icon-opacity danger font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Training</span>
                                                <h1 class="danger mb-0"><?php echo $total_training;?></h1>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <a href="<?php echo base_url();?>admin/nutritionGuidance/nutritionGuidanceEdit/<?php echo encoding(1);?>">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-clipboard icon-opacity danger font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Nutrition Guidance</span>
                                                <h1 class="danger mb-0"><?php echo $total_nutrition;?></h1>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <a href="<?php echo base_url()?>admin/recommendedProducts/edit_recommendedProducts?id=<?php echo encoding(1);?>">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-top">
                                                <i class="ft-check-square icon-opacity danger font-large-4"></i>
                                            </div>
                                            <div class="media-body text-right align-self-bottom mt-3">
                                                <span class="d-block mb-1 font-medium-1">Total Recommended Products</span>
                                                <h1 class="danger mb-0"><?php echo $total_recommended;?></h1>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }?>
                </div>
            </section>
      </div>
</div>