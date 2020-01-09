                     <div class="row match-height">
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
                                                <th class="border-top-0">Like</th>
                                                <th class="border-top-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!empty($articleList)){ 

                                            foreach($articleList as $value){
                                                if($value->addedBy == 'trainer'){
                                                            $path = TRAINER_PROFILE_THUMB;   
                                                        }else{
                                                            $path = TRAINER_PROFILE_THUMB;   
                                                        }
                                                                ?>
                                                                <tr>
                                                                    <td class="text-truncate wdth-fix">
                                                                        <h4 class="card-title mrb-5"><?php echo strip_tags($value->title);?></h4>
                                                                        <p class="mrb-0"><?php echo strip_tags($value->description);?></p>
                                                                    </td>
                                                                     <td class="text-truncate align-middle media">
                                                                        <ul class="list-unstyled users-list m-0 mr-1">
                                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="" class="avatar avatar-sm width-cstm pull-up">
                                                                                <?php if(!empty($value->profileImage)){?>
                                                                            <img class="media-object rounded-circle" src="<?php echo base_url().$path.$value->profileImage; ?>" alt="Avatar">
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
                                                                            $articleId = $value->id;
                                                                            $clickDelete ="deleteArticleByTrainer('$articleId','$base_url')" ;
                                                                        ?>
                                                                        <div class="media-body psted-by-text">
                                                                            <h5 class="mt-0"><?php echo time_elapsed_string($value->crd);?> By <a href="<?php echo base_url()?>admin/trainers/trainerDetails/<?php echo $userId;?>/<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];?>/<?php echo $value->addedBy;?>"><?php echo $value->fullName;?></a></h5>
                                                                        </div>
                                                                    </td>                                                 
                                                                    <td class="text-truncate align-middle icn-dash">
                                                                        <span class="ft-thumbs-up"></span><?php echo $value->totalArticlelike;?>
                                                                    </td>
                                                                    <?php
                                                    $csrf = get_csrf_token()['hash'];?>
                                                    <input type="hidden" id="hashCsrf" data-values="<?php echo $csrf;?>"  data-keys="<?php echo get_csrf_token()['name'];?>">
                                                    <td class="align-middle eye-style">
                                                    <a href="<?php echo base_url()?>admin/article/articleDetail/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>
                                                    <a href="#" onclick="<?php echo $clickDelete; ?>">
                                                        <i class="ft-trash-2"></i></a>
                                                            <a href="<?php echo base_url()?>admin/article/edit_article?id=<?php echo encoding($articleId);?>" ">
                                                                <i class="ft-edit-2"></i>
                                                            </a>
                                                </td>
                                                                </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                                
                                                                 </table>
<?php echo $pagination;?>
                                                           <?php }else{?>
                                                           
                                                                 <table>
                                                                     <tbody>
                                                            </tbody>
                                                        </table>
                                                            <div id="record">No Records Found</div> 
                                                    <?php }?>
                                                            <div class="page_link">
                                                            
                                                               </div>
                                                    </div>
                                                </div>