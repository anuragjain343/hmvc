<?php $pag=$row-1; $sn = $row; 
  if(!empty($result)) {    
    foreach($result as $get){ 
      if(!empty(get_user_session_data())){
        $wherecount = array('articleId'=>$get['id'],'userId'=>get_user_session_data()['userId']);
        $currentusercount = $this->common_model->get_total_count(ARTICLELIKE,$wherecount);
      } ?>

<div class="list-des">
  <div class="list-artcl">
    <div class="list-info">
      <div class="postedMeta-1">
        <a href="<?php echo base_url('home/article/articleDetail/').encoding($get['id']); ?>"><img src="<?php if(!empty($trainerDetail->profileImage)){ echo base_url().TRAINER_PROFILE_THUMB.$trainerDetail->profileImage;}else{ echo base_url().DEFAULT_IMAGE; } ?>"><?php if(!empty($trainerDetail->fullName)){ echo ucwords($trainerDetail->fullName); }else{ echo 'N/A'; } ?></a>
        <span class="postTime"><?php echo time_elapsed_string($get['crd']);?></span>
      </div>
      <a class="list-title" href="<?php echo base_url('home/article/articleDetail/').encoding($get['id']); ?>"><?php echo ucwords($get['title']); ?></a>
      <div class="maxContent">
        <p class="paraText"><?php echo substr($get['description'], 0, 120).'...'; ?>
        </p>
      </div>

      <div class="forumicon">
        <div class="float-left">
          <span><a href="javascript:void(0);" class="liked" onclick="listingArticleLike('home/article/listingArticleLike','<?php echo $get['id']; ?>')"><i class="fas fa-thumbs-up mylike_<?php echo $get['id']; ?>" style="<?php if(!empty($currentusercount)){ echo 'color:#5dbbf2; font-weight:900;';  }else{ echo 'color:#000;font-weight:200;';  }?>"></i></a>

            <span id="totallike_<?php echo $get['id']; ?>">
            <?php if(!empty($currentusercount) && !empty($get['TotalLike']) AND $get['TotalLike'] ==1){
                echo 'You liked';
              }
              if(!empty($currentusercount) && !empty($get['TotalLike']) && $get['TotalLike'] > 1){
                echo 'You and '.($get['TotalLike']-1).' others';
              }
              if(empty($currentusercount) AND empty($get['TotalLike'])){
                echo '0 Like'; 
              }
              if(empty($currentusercount) AND !empty($get['TotalLike'])){
                if($get['TotalLike'] < 2){ 
                  echo $get['TotalLike'].' Like';
                }else{
                  echo $get['TotalLike'].' Likes';
                }
              } ?>
            </span>
          </span>

          <span><i class="far fa-eye"></i> <?php echo $get['totalView']; ?> Views</span>

          <span><i class="far fa-comment-alt"></i> <?php echo $get['totalAnswer'];
            if($get['totalAnswer'] < 2 || empty($get['totalAnswer'])){ 
               $comment=' Comment';
            }else{
              $comment=' Comments';
            }?>
             <?php echo $comment;?>
          </span>
        </div>
        <div class="float-right">
          <div class="textLink">
            <a href="<?php echo base_url('home/article/articleDetail/').encoding($get['id']); ?>">Read More</a>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php $sn++; } 
}else{ ?>
  <div class="even pointer">
    <center><h2 style="font-size: 20px; color: #757575; margin-top: 80px;">No Article Found</h2></td>
  </div>
<?php } ?>
<!-- Paginate -->
<div class="pgination-block"><?php echo $pagination; ?></div>   
<script>
  function listingArticleLike(ctrl,articleId){
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