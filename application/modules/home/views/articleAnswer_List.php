<?php if(!empty($articalAnswerData)){ foreach($articalAnswerData as $value){ ?>
<div class="frlistItem frlistItemMedia">
  <div class="media">
    <?php if(empty($value->profileImage)){ ?>
    
    <img class="mr-3" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="">
  <?php }else{?>
      <?php if($value->ansAddedBy=='admin' OR $value->ansAddedBy=='trainer'){?>
    <img class="mr-3" src="<?php echo base_url().TRAINER_PROFILE_THUMB.$value->profileImage;?>" alt="">
  <?php }else{?>
      <img class="mr-3" src="<?php echo base_url().USER_PROFILE_THUMB.$value->profileImage;?>" alt="">
  <?php } ?>
  <?php }?>
    <div class="media-body forumInfo">
      <p class="paraText"><?php echo $value->answer;?></p>
      <div class="postedMeta">
        <div class="float-left">
          <p>Posted on <a href="#"><?php echo time_elapsed_string($value->articleAnsweCreate);?></a> By <a href="<?php echo base_url('home/users/otherUserProfile/').encoding($value->answerById); ?>"><?php echo $value->fullName;?></a></p>
        </div>
        <div class="float-right forumicon">
         
          <span><a href="javascript:void(0);" onclick="isAnswerLike('home/article/articleAnswerLike','<?php echo $value->id; ?>','<?php echo $value->answerId; ?>')"><i class="fas fa-thumbs-up mylike<?php echo $value->answerId; ?>" style="<?php if($value->currentUserLike){ echo "color:#5dbbf2"; }else{ echo "color: ";  } ?> "></i></a> 

              
                <span id="likans<?php echo $value->answerId;?>">
             
                <?php if(!empty($value->currentUserLike)==1 AND !empty($value->totalAnswerLike) AND $value->totalAnswerLike ==1)
                          {
                            echo 'You liked';
                          }
                        if(!empty($value->currentUserLike)==1 AND !empty($value->totalAnswerLike) AND $value->totalAnswerLike>1)
                          {
                           echo 'You and '.($value->totalAnswerLike-1).' others';
                          }
                           if(empty($value->currentUserLike) AND empty($value->totalAnswerLike))
                          {
                           echo '0 Like';
                          }
                          if(empty($value->currentUserLike) AND !empty($value->totalAnswerLike))
                          {
                            if($value->totalAnswerLike<2){
                               echo $value->totalAnswerLike.' Like';
                            }else{
                               echo $value->totalAnswerLike .' Likes';
                            }

                          
                          }

                          ?>
                 
               </span>
             </span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } } else{?>
  <center id="artiId"> No Comments yet</center>
<?php } ?>