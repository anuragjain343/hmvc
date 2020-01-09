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
                                                <th class="border-top-0">Answers</th>
                                                <th class="border-top-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php if(!empty($forumList)){ foreach($forumList as $value){?>
                                            <tr>
                                                <td class="text-truncate wdth-fix">
                                                    <a href="<?php echo base_url()?>admin/forum/forumDetail/<?php echo encoding($value->id);?>">
                                                    <h4 class="card-title mrb-5"><?php echo $value->title;?></h4></a>
                                                    <p class="mrb-0"><?php echo $value->description;?></p>
                                                </td>
                                                <td class="text-truncate align-middle media">
                                                    <ul class="list-unstyled users-list m-0 mr-1">
                                                        <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="" class="avatar avatar-sm width-cstm pull-up">
                                                            <?php if(!empty($value->profileImage)){
                                                                    if($value->addedBy=='user'){$plink = base_url().USER_PROFILE_THUMB.$value->profileImage;}else{$plink = base_url().TRAINER_PROFILE_THUMB.$value->profileImage;}
                                                                ?>
                                                        <img class="media-object rounded-circle" src="<?php echo $plink; ?>" alt="Avatar">
                                                            <?php }else{?>
                                                        <img class="media-object rounded-circle" src="<?php echo base_url().DEFAULT_IMAGE; ?>" alt="Avatar">
                                                            <?php }?>
                                                        </li>
                                                    </ul>
                                                    <?php if($value->addedBy=='user'){ $link=base_url('admin/users/userDetails/').encoding($value->userId); }else{ $link = base_url('admin/trainers/trainerDetails/').encoding($value->userId);}?>
                                                    <div class="media-body psted-by-text">
                                                        <h5 class="mt-0"><?php echo time_elapsed_string($value->crd);?> By <a href="<?php echo $link;?>"><?php echo $value->fullName;?></a></h5>
                                                    </div>
                                                </td>                                                                                                    <?php 
                                                        $base_url = base_url();  
                                                        $forumId = $value->id;
                                                        $clickDelete ="deleteForum('$forumId','$base_url')" ;
                                                    ?>
                                                <td class="text-truncate align-middle icn-dash">
                                                    <span class="ft-message-square"></span><?php echo $value->totalans;?>
                                                </td>
                                                <td class="align-middle eye-style">
                                                    <a href="<?php echo base_url()?>admin/forum/forumDetail/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>
                                                    <a href="javascript:void(0);" onclick="<?php echo $clickDelete; ?>">
                                                        <i class="ft-trash-2 clr2"></i></a>
                                                            <a href="<?php echo base_url()?>admin/forum/edit_forum?id=<?php echo encoding($forumId);?>" ">
                                                                <i class="ft-edit-2 clr2"></i>
                                                            </a>
                                                </td>
                                            </tr>                                
                                          <?php }}else{ ?>
                                            <tbody>
                                                  <tr>
                                                      <td> <h5>No Forum Found.</h5></td>
                                                      <td></td> 
                                                  </tr>                                
                                            </tbody>
                                          <?php }?>
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
            </div>