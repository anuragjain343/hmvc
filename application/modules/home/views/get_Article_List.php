 <?php if(!empty($articalList)){  
  foreach ($articalList as $key => $value){  
    if(!empty(get_user_session_data())){
      $wherecount = array('articleId'=>$value->articleId,'userId'=>get_user_session_data()['userId']);
      $currentusercount = $this->common_model->get_total_count(ARTICLELIKE,$wherecount);
    } ?>
    <div class="list-des">
      <div class="list-artcl">
        <div class="list-info">
          <div class="postedMeta-1">
            <a href="javascript:void(0);">
              <?php if(!empty($value->profileImage)){?>
              <img src="
                <?php echo base_url().TRAINER_PROFILE_THUMB.$value->profileImage;?>">
                <?php }else{?>
                <img src="
                  <?php echo base_url().DEFAULT_IMAGE;?>">
                  <?php }?>
                  <?php echo $value->fullName;?>
                </a>
              <!--   <span class="postTime">
                  <?php echo time_elapsed_string($value->crd); ?>
                </span> -->
              </div>
              <a class="list-title" href="javascript:void(0);"  onclick ="isRegisterLogin('<?php echo $value->addedById; ?>','<?php echo base_url();?>home/article/articleDetail/<?php echo encoding($value->articleId);?>')">
                <?php  custom_echo($value->title,100);?>
              </a>
              <div class="maxContent">
                <p class="paraText">
                  <?php  custom_echo($value->description,150);?>
                </p>
              </div>
              <div class="forumicon">
                <div class="float-left">
                  <span><a href="javascript:void(0);" class="liked" onclick="<?php if (empty(get_user_session_data())){ ?> LogRegisModel() <?php }else{ ?>homeListingArticleLike('home/article/listingArticleLike','<?php echo $value->articleId; ?>') <?php } ?>"><i class="fas fa-thumbs-up mylike_<?php echo $value->articleId; ?>" style="<?php if(!empty($currentusercount)){ echo 'color:#5dbbf2; font-weight:900;';  }else{ echo 'color:#000;font-weight:200;';  }?>"></i></a> 
                  <span id="totallike_<?php echo $value->articleId; ?>">
                    <?php if(!empty($currentusercount) && !empty($value->totalLike) AND $value->totalLike ==1){
                        echo 'You liked';
                      }
                      if(!empty($currentusercount) AND !empty($value->totalLike) AND $value->totalLike > 1){
                        echo 'You and '.($value->totalLike-1).' others';
                      }
                      if(empty($currentusercount) AND empty($value->totalLike)){
                        echo '0 Like'; 
                      }
                      if(empty($currentusercount) AND !empty($value->totalLike)){
                        if($value->totalLike < 2){ 
                         echo $value->totalLike.' Like';
                          }else{
                          echo $value->totalLike.' Likes';
                        }
                      } ?>
                  </span>
                  </span>
                  <span><i class="far fa-eye"></i>
                    <?php echo $value->totalView; 
                    if($value->totalView 
                    < 2 OR empty($value->totalView)){ 
                       $viw=' View';
                    }else{
                      $viw=' Views';
                    }
                    echo $viw;?>
                  </span>
                  <span>
                    <i class="far fa-comment-alt"></i>
                    <?php echo $value->totalAnswer;
                    if($value->totalAnswer < 2 OR empty($value->totalAnswer)){ 
                       $viw1=' Comment';
                    }else{
                      $viw1=' Comments';
                    } 
                    echo $viw1; ?>
                  </span>
                </div>
                <div class="float-right">
                  <div class="textLink">
                    <a href="javascript:void(0);" onclick ="isRegisterLogin('','<?php echo  base_url();?>home/article/articleDetail/<?php echo encoding($value->articleId);?>')">Read More
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

<?php }?> 
<div class="text-center">
<a href="<?php echo base_url().'home/article';?>" class="btn btn-theme btn-bg-t btn-round">View More</a>
 </div>
<?php }
else{?>
<div class="list-des">
  <div class="list-artcl">
    No article found.
  </div>
</div>
<?php }?>


     
 <script type="text/javascript">
  function LogRegisModel(){
    $('#loginModal').modal('show');
  
  }

  function homeListingArticleLike(ctrl,articleId){
   $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    data: {'id':articleId}, //only input
    success:function(res){
      var obj = JSON.parse(res);
      var articleLike= obj.likeCount;
      if(obj.status=='1'){

        $(".mylike_"+obj.articleId).css({
          'color' : '#5dbbf2',
          'font-weight' : '900'
        });
        if((obj.currentUserlikeCount=='1') && (obj.likeCount=='1')){
           $("#totallike_"+obj.articleId).html('You liked');
        }
        if((obj.currentUserlikeCount=='1') && (obj.likeCount > '1')){
          var tot =parseInt(obj.likeCount)-1;
          $("#totallike_"+obj.articleId).html('You and '+ tot  +' others ');
        }
      }else{

        $(".mylike_"+obj.articleId).css({
          'color' : '#000',
          'font-weight' : '200'
        });
        if((obj.currentUserlikeCount=='0') && (obj.likeCount=='0')){
          var tot =parseInt(obj.likeCount);
          $("#totallike_"+obj.articleId).html(tot+' Like');

        }
        if((obj.currentUserlikeCount=='0') && (obj.likeCount >='1')){
          var tot =parseInt(obj.likeCount);
           if(obj.likeCount<2){
           $("#totallike_"+obj.articleId).html(tot+' Like');
         }else{
            $("#totallike_"+obj.articleId).html(tot+' Likes');
         }
        }
      }  
    }
  });
 }
 </script>  