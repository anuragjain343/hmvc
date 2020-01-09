

    <div class="app-content content">
          <div class="content-wrapper">        
            <div class="content-wrapper-before">
                <a class="btn btn-sm btn-danger danger box-shadow-3 round btn-min-width pull-right mr-2" href="<?php echo base_url()?>admin/forum/addforum">
                    <span class="white">Add New</span>
                    <i class="ft-list pl-1 white"></i>
                </a>
            </div>
                <div class="content-header row mt-10"></div> 
                <div class="card forum-crd">            
                    <div class="card-content">
                        <div class="row">
                            <?php  if(!empty($forumData1)){
                                foreach ($forumData1 as $value) {
                                  
                                ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="timeline-card card border-grey border-lighten-2">
                                    <div class="card-header">
                                        <h4 class="card-title ttle-vdio clr">
                                            
                                           <?php echo $value->title;?>
                                        </h4>
                                        <p class="card-subtitle text-muted mb-0 pt-1">
                                            <span class="font-small-3">Posted on <?php echo time_elapsed_string($value->crd);?>  By <b><?php echo $value->fullName;?></b></span>
                                        </p>
                                        <a class="heading-elements-toggle">
                                            <i class="la la-ellipsis-v font-medium-3"></i>
                                        </a>
                                    </div>
                                    <div class="card-content">
                                        <div class="row m-1 mt-0">
                                            <div class="col-xl-6 col-lg-12">
                                                <div class="align-self-center">
                                                   <?php if(!empty($value->profileImage)){?>
                                                    <img class="img-fluid" src="<?php echo base_url().ADMIN_PROFILE_THUMB.$value->profileImage; ?>" alt="Trainer-pic">
                                                    <?php }else{?>
                                                        <img class="img-fluid" src="<?php echo base_url().DEFAULT_IMAGE; ?>" alt="Trainer-pic">
                                                 
                                                    <?php }?>
                                                </div>              
                                            </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="text-center mt-1">
                                                <h3 class="font-large-1"> <?php echo $value->fullName;?></h3>
                                                <ul class="list-inline mb-1 artcle-icns">
                                                    <li class="pr-1 clr2 mt-10">
                                                        <span class="la la-thumbs-o-up"></span>13 Likes
                                                    </li>
                                                    <li class="pr-1 clr2 mt-10">
                                                        <span class="ft-eye"></span>70 Views
                                                    </li>
                                                    <li class="pr-1 clr2 mt-10">
                                                        <span class="ft-message-square"></span>100 Answers
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                      </div>
                                      <p class="line-height-2 p-1"> <?php echo $value->description;?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                        </div>
                </div>
            </div>   
      </div>
</div>

