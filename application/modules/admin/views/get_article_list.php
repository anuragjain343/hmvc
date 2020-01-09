

                                            <?php  if(!empty($articleList)){  foreach($articleList as $value){
                                                    if($value->addedBy == 'trainer' OR $value->addedBy=='admin'){
                                                        $path = TRAINER_PROFILE_THUMB;   
                                                    }else{
                                                        $path = ADMIN_PROFILE_THUMB;   
                                                    }
                                                ?>
                                            <tr>
                                                <td class="text-truncate wdth-fix">
                                                    <a href="<?php echo base_url()?>admin/article/articleDetail/<?php echo encoding($value->id);?>">
                                                    <h4 class="card-title mrb-5" id="fixTitle"><?php echo strip_tags($value->title);?></h4></a>
                                                    <p class="mrb-0"><?php echo strip_tags($value->description);?></p>
                                                </td>
                                                <td class="text-truncate align-middle media min-hgt-tble">
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
                                                        if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){   
                                                    $clickDelete ="deleteArticleByAdmin('$articleId','$base_url')";
                                                    }else{
                                                         $clickDelete ="deleteArticle('$articleId','$base_url')" ;
                                                    }
                                                    ?>
                                        <div class="media-body psted-by-text">
                                    <h5 class="mt-0">
                                        <?php echo time_elapsed_string($value->crd);?> By 
   <?php 
   if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){ ?>                                     
<a href="<?php echo base_url()?>admin/trainers/trainerDetails/<?php echo $userId;?>/<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];?>/<?php echo $value->addedBy;?>"><?php echo $value->fullName;?></a></h5>
<?php }else{ ?>
    <a href="javascript:void(0);"><?php echo $value->fullName;?></a></h5>
    <?php } ?>
                                                    </div>
                                                </td>      

                                                 <td class="text-truncate align-middle icn-dash">
                                                     <?php if($value->articleStatus==1) {
                                                echo '<p style="color:green;"> Published </p>';
                                               }else{
                                                echo '<p style="color:#fa626b;">Draft </p>';
                                               }

                                                   ?>
                                               
                                                </td>

                                                <td class="text-truncate align-middle icn-dash">
                                                    <span class="la la-thumbs-o-up"></span><?php echo $value->totalArticlelike;?>
                                                </td>
                                                <?php
                                                    $csrf = get_csrf_token()['hash'];?>
                                                    <input type="hidden" id="hashCsrf" data-values="<?php echo $csrf;?>"  data-keys="<?php echo get_csrf_token()['name'];?>">
                                                    <td class="align-middle eye-style">
                                                    <a href="<?php echo base_url()?>admin/article/articleDetail/<?php echo encoding($value->id);?>"><i class="ft-eye icon-opacity"></i></a>
                                                    <a href="javascript:void(0);" onclick="<?php echo $clickDelete; ?>">
                                                        <i class="ft-trash-2"></i></a>
                                                        <?php if($value->articleStatus==1) { ?>
                                                            <a href="<?php echo base_url()?>admin/article/edit_article?id=<?php echo encoding($articleId);?>" ">
                                                                <i class="ft-edit-2"></i>
                                                            </a>
                                                        <?php }else{?>
                                                            <a href="<?php echo base_url()?>admin/article/addArticle?id=<?php echo encoding($articleId);?>" ">
                                                                <i class="ft-edit-2"></i>
                                                            </a>
                                                        <?php }?>
                                                           
                                                       
                                                </td>
                                            </tr>                                
                                          <?php } } ?>

                                          <tr>
                                       
                                            <td colspan="4"><?php echo $pagination; ?></td>
                                        </tr>
                                       

          
  


