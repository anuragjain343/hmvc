          
           <?php if(!empty($ansList)){ 
            ?>
              <?php foreach($ansList as $value){ ?>
              <div class="frlistItem frlistItemMedia">
                <div class="media">
              <?php if(!empty($value->profileImage)){
      if($value->answerBy=='user'){$plink = base_url().USER_PROFILE_THUMB.$value->profileImage;}else{$plink = base_url().TRAINER_PROFILE_THUMB.$value->profileImage;}
    ?>
                    <img class="mr-3" src="<?php echo $plink;?>" alt="">
                  <?php } else{?>
                  <img class="mr-3" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="">
                  <?php }?>
                  <div class="media-body forumInfo">
                    <p class="paraText"><?php echo $value->answer;?></p>
                    <div class="postedMeta">
                      <div class="float-left">
                        <p>Posted on <a href="#"><?php echo time_elapsed_string($value->crd);?></a> By <a href="<?php echo base_url('home/users/otherUserProfile/').encoding($value->answerById); ?>"><?php echo $value->fullName;?></a></p>
                      </div>
                      <div class="float-right forumicon">
                        <?php if(!empty($value->currentUserLike)){
                          $addclass= "color:#5dbbf2;";
                        }else{
                            $addclass= " ";
                          }

                          if($value->currentUserLike=='1' &&  $value->totalanslike >'1'){
                            $count = $value->totalanslike-1;
                            $like = 'You and  '.$count.' others';
                          }elseif ($value->currentUserLike=='1' &&  $value->totalanslike=='1'){
                             $like = 'You liked';                         
                          }else{
                             if($value->totalanslike<2 OR empty($value->totalanslike)){ 
                              $like =  $value->totalanslike.' Like';
                            }else{
                               $like =  $value->totalanslike.' Likes';
                            }
                          }
                          
                          ?>
                        <span><a href="javascript:void(0)" id="mylike<?php echo $value->answerId;?>" data-toggle="tooltip" title="Like" class="" style="<?php echo  $addclass;?>" onclick="answerLike('home/forum/answerLike','<?php echo $value->answerId ?>','<?php echo !empty($fmId)?$fmId:$fmId=""; ?>')">
                          <i class="fas fa-thumbs-up"></i>
                        </a><span id="pasteLike<?php echo $value->answerId;?>"> <?php  echo $like; ?> </span></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php }?>
          <?php } else{?>
            <center id="artiId"> No Answers yet</center>
          <?php }?>
             