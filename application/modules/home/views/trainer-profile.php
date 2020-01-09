
<?php 
if(get_user_session_data() != ''){ $userLevel = $this->common_model->GetSingleJoinRecord(USERS,'userPlan',TBL_PLAN,'planId','planLevel',array('id'=>get_user_session_data()['userId']));  
//pr($userLevel);
$userDetail = $this->common_model->getsingle(USERS, array('id'=>get_user_session_data()['userId'])); } ?>

<div class="forumSearchSec" style="background-image:url(img/trainer-detail.jpg); min-height:450px;background-position:center; background-repeat:no-repeat;">
  <div class="container">
    <div class="box_icon mt-20">
      <div class="row">
        <div class="col-md-12">
          <div class="traner-dtl-prfle text-center mb-20">
              <img src="<?php if(!empty($trainerDetail->profileImage)){ echo base_url().TRAINER_PROFILE_THUMB.$trainerDetail->profileImage;}else{ echo base_url().DEFAULT_IMAGE; } ?>" />
          </div>
          <h2><?php if(!empty($trainerDetail->fullName)){ echo $trainerDetail->fullName; }else{ echo 'N/A'; } ?></h2>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="video-sec sec-pad-40">
    <div class="container">
      <div class="border-bottom">
      <div class="section-title text-center sec-arrow-dark">
        <h4>Videos</h4>
        <h2>Informational Videos</h2>  
      </div>
     
<!-- st -->
    
  <?php if(!empty($trainerInfoVideo)) { ?>
      <div class="videoHidden">
      <?php foreach($trainerInfoVideo as $infovideo){ 
        $levelType = explode(',',$infovideo->videoLevelType); ?>
        <div style="display:none;" id="video<?php echo $infovideo->id; ?>">
        <video class="lg-video-object lg-html5" controls preload="none">
          <source src="<?php echo base_url().INFORMATIONAL_VIDEO.$infovideo->informationalVideo; ?>" type="video/mp4">
        </video>
        </div>
      <?php } ?>
      </div>
      <div class="row"> 
        <?php  foreach($trainerInfoVideo as $video){ 
            $level = explode(',',$video->videoLevelType); 
            if(!empty($_SESSION[USER_SESS_KEY]['userId'])){
              $id= $_SESSION[USER_SESS_KEY]['userId'];
            }else{
              $id='';
            }
            ?>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="videoList" id="allVideos<?php echo $video->id;?>">
              <div class="videoBlock video-blck-box">
                <div class="videoThumb videoThumbWdth  cstm-vedio-thumb blog-pic-wrap">
                    <a style="cursor: pointer;" data-poster="<?php echo base_url().INFORMATIONAL_VIDEO_THUMB.$video->videoThumb; ?>" data-sub-html="<?php echo $video->title;?>" data-html="#video<?php echo $video->id; ?>" onclick="<?php if (empty(get_user_session_data())){ ?>
                        modalRegisterLogin() <?php }
                        else{ 
                          if($video->postedById != $userDetail->assignTrainer){ ?>
                          $('#errorModal').modal('show');
                        <?php }else {
                          if($video->postedById == $userDetail->assignTrainer){
                          foreach($level as $key => $val){

                              if($userDetail->userPlan==$val[$key] OR $userDetail->userPlan >= $val[$key]) { ?>
            
                                 playVideo('<?php echo $video->id;?>');
                              <?php }else{ ?>
                               
                                videomod();
                           <?php  }
                          }
                        }
                      }
                       }?>" >

                  <img class="" src="<?php echo base_url().INFORMATIONAL_VIDEO_THUMB.$video->videoThumb; ?>">   
                      <div class="videoPlay cstm-vedio-block vedio-play-icon">
                        <span class="fa fa-play"></span>
                      </div>                           
                    </a> 
                </div>
                <div class="absolute-gradient"></div>                           
                <div class="video-content infoVid">
                  <h3 class="wordWrap"><?php echo ucwords($video->title);?></h3>
                </div>
              </div>
            </div>
        
               
      </div>
        <?php } ?>
        </div>     
    <?php }else{ ?>
      <div class="NoDatatx">
        <h6 >No Video Found</h6>
      </div>
    <?php } ?>

<!-- en -->
    <div class="border-bottom" style="margin-top: 20px; margin-bottom: 20px;"></div>
    <div class="section-title text-center sec-arrow-dark">
      <h2>Training Videos</h2>  
    </div>
    <!-- st -->
    <?php if(!empty($trainerTrainVideo)){ ?>
      <div class="videoHidden">
      <?php foreach($trainerTrainVideo as $trainvideo){ 
        $TrainVideoLevel = explode(',',$trainvideo->videoLevelType);
         if(!empty($_SESSION[USER_SESS_KEY]['userId'])){
              $tid= $_SESSION[USER_SESS_KEY]['userId'];
            }else{
              $tid='';
            } ?>

        <div style="display:none;" id="video<?php echo $trainvideo->id; ?>">
        <video class="lg-video-object lg-html5" controls preload="none">
          <source src="<?php echo base_url().TRAINING_VIDEO.$trainvideo->trainingVideo; ?>" type="video/mp4">
        </video>
        </div>
      <?php } ?>
      </div>

         <div class="row">
        <?php  foreach($trainerTrainVideo as $video){ 
            $levelVideos = explode(',',$video->videoLevelType); 
            //print_r($levelVideos);?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="videoList" id="allVideosinfo<?php echo $video->id;?>">
              <div class="videoBlock video-blck-box">
                <div class="videoThumb videoThumbWdth  cstm-vedio-thumb blog-pic-wrap">
                    <a style="cursor: pointer;" data-poster="<?php echo base_url().TRAINING_VIDEO_THUMB.$video->videoThumb; ?>" data-sub-html="<?php echo $video->title;?>" data-html="#video<?php echo $video->id; ?>" onclick="<?php if (empty(get_user_session_data())){ ?>
                        modalRegisterLogin() <?php }
                        else{ 
                          if($video->postedById != $userDetail->assignTrainer){ ?>
                          $('#errorModal').modal('show');
                        <?php }else {
                          if($video->postedById == $userDetail->assignTrainer){
                          foreach($levelVideos as $key => $val){

                              if($userDetail->userPlan==$val[$key] OR $userDetail->userPlan >= $val[$key]) {?>
            
                                 playVideotr('<?php echo $video->id;?>');
                              <?php }else{ ?>
                               
                                videomod();
                           <?php  }
                          }
                        }
                      }
                       }?>">
                      <img class="" src="<?php echo base_url().TRAINING_VIDEO_THUMB.$video->videoThumb; ?>">   
                      <div class="videoPlay cstm-vedio-block vedio-play-icon">
                        <span class="fa fa-play"></span>
                      </div>                           
                    </a> 
                </div>
                <div class="absolute-gradient"></div>                           
                <div class="video-content infoVid">
                  <h3 class="wordWrap"><?php echo ucwords($video->title);?></h3>
                </div>
              </div>
            </div>
        

      </div>
        <?php } ?>
        </div>     
    <?php } else{ ?>
      <div class="NoDatatx">
        <h6 >No Video Found</h6>
      </div>
    <?php } ?>
    <!-- en -->
  </div>
  </div>
</section>

<section class="video-sec pb-40">
  <div class="container">
    <div class="border-bottom">
      <div class="section-title text-center sec-arrow-dark">
          <h4>Health</h4>
          <h2>Recipes</h2>  
      </div>
      <div class="row">
      <?php if(!empty($trainerRecipe)){ 
        foreach($trainerRecipe as $recipe){ ?>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="recepie-list transition">
                  <div class="media media-res recepie-media">
                      <?php if(!empty($recipe->image)){?>
                      <img class="mr-3" src="<?php echo base_url().RECEPIE_THUMB.$recipe->image; ?>" alt="image">
                    <?php }else{?>
                       <img class="mr-3" src="<?php echo base_url().DEFAULT_RECEPIE_IMAGE; ?>" alt="image">
                    <?php }?>
                      <div class="media-body">
                          <h2 class="mt-0"><?php echo ucwords($recipe->title); ?></h2>
                          <p><?php echo ucfirst(substr($recipe->description, 0, 100)).'...'; ?></p>
                      </div>
                  </div>
                  <div class="detail-icon">
                      <a href="javascript:void(0);" onclick="<?php if (empty(get_user_session_data())){ ?>
                        modalRegisterLogin() <?php }else{ if($recipe->addedById != $userDetail->assignTrainer){ ?>
                          $('#errorModal').modal('show');
                        <?php }else{ ?>
                        window.open('<?php echo base_url('home/recipes/recipeDetail/').encoding($recipe->id); ?>','_self'); <?php } } ?> "><i class="fas fa-arrow-right"></i></a>
                  </div>
              </div>
          </div>
        <?php } }else{ ?>
          <div class="col-lg-12">
            <div class="NoDatatx">
              <h6 >No Recipe Found</h6>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>

<section class="video-sec pb-40">
  <div class="container">
  <div class="border-bottom">
    <div class="section-title text-center sec-arrow-dark">
      <h4>Articles</h4>
      <h2>Trainer Articles</h2>  
    </div>
    <div class="mt-30">
    <?php if(!empty($trainerArticle)){ 
        foreach($trainerArticle as $article){ 
          if(!empty(get_user_session_data())){
            $wherecount = array('articleId'=>$article->id,'userId'=>get_user_session_data()['userId']);
            $currentusercount = $this->common_model->get_total_count(ARTICLELIKE,$wherecount);
          } ?>
      <div class="list-des">
        <div class="list-artcl">
          <div class="list-info">
            <div class="postedMeta-1">
              <a>
                <img src="<?php if(!empty($trainerDetail->profileImage)){ echo base_url().TRAINER_PROFILE_THUMB.$trainerDetail->profileImage;}else{ echo base_url().DEFAULT_IMAGE; } ?>"> <?php echo $trainerDetail->fullName; ?></a>
              <span class="postTime"><?php echo time_elapsed_string($article->crd);?></span>
            </div>
            <a class="list-title" href="javascript:void(0);" onclick="<?php if (empty(get_user_session_data())){ ?>
              modalRegisterLogin(); <?php }else{ if($article->addedById != $userDetail->assignTrainer){ ?>
                  $('#errorModal').modal('show');
                <?php }else{ ?>
                window.open('<?php echo base_url('home/article/articleDetail/').encoding($article->id); ?>','_self'); <?php } } ?>">
                <?php echo ucwords($article->title); ?></a>

            <div class="maxContent">
              <p class="paraText"><?php echo substr($article->description, 0, 120).'...'; ?>
              </p>
            </div>

            <div class="forumicon">
              <div class="float-left">
                <span><a href="javascript:void(0);" class="liked" onclick="<?php if (empty(get_user_session_data())){ ?> modalRegisterLogin(); <?php }else{ ?>listingArticleLike('home/article/listingArticleLike','<?php echo $article->id; ?>') <?php } ?>"><i class="fas fa-thumbs-up mylike_<?php echo $article->id; ?>"></i></a> 

                  <span id="totallike_<?php echo $article->id; ?>">
                    <?php if(!empty($currentusercount) && !empty($article->TotalLike) AND $article->TotalLike ==1){
                        echo 'You liked';
                      }
                      if(!empty($currentusercount) AND !empty($article->TotalLike) AND $article->TotalLike > 1){
                        echo 'You and '.($article->TotalLike-1).' others';
                      }
                      if(empty($currentusercount) AND empty($article->TotalLike)){
                        echo '0 Like'; 
                      }
                      if(empty($currentusercount) AND !empty($article->TotalLike)){
                        if($article->TotalLike < 2){ 
                         echo $article->TotalLike.' Like';
                          }else{
                          echo $article->TotalLike.' Likes';
                        }
                      } ?>
                  </span>

                </span>
                <span><i class="far fa-eye"></i> <?php echo $article->totalView; if($article->totalView < 2 || empty($article->totalView)){ 
                       $view=' View';
                    }else{
                      $view=' Views';
                    } ?>
                  <?php echo $view;?>
                </span>
                <span><i class="far fa-comment-alt"></i> <?php echo $article->totalAnswer;
                  if($article->totalAnswer < 2 || empty($article->totalAnswer)){ 
                     $comment=' Comment';
                  }else{
                    $comment=' Comments';
                  }?>
                   <?php echo $comment;?>
                 </span>
              </div>
              <div class="float-right">
                <div class="textLink">
                  <a href="javascript:void(0);" onclick="<?php if (empty(get_user_session_data())){ ?>
                    modalRegisterLogin(); <?php }else{ if($article->addedById != $userDetail->assignTrainer){ ?>
                    $('#errorModal').modal('show');
                    <?php }else{ ?>
                    window.open('<?php echo base_url('home/article/articleDetail/').encoding($article->id); ?>','_self'); <?php } } ?> ">Read More</a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <?php } }else{ ?>
        <div class="NoDatatx">
          <h6>No Article Found</h6>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
  </div>
</section>

<section class="video-sec">
  <div class="container">
      <div class="section-title text-center sec-arrow-dark">
        <h4>Forums</h4>
        <h2>Trainer Forums</h2>  
      </div>
      <div class="mt-30 row justify-content-center">
        <div class="col-md-12 col-lg-12">
        <?php if(!empty($trainerForum)){ ?>
          <div class="table-responsive">
            <table class="table table-striped forum-tble">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Heading</th>
                  <th scope="col" class="wdth-block">Posted By</th>
                  <th scope="col">Answers</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($trainerForum as $forum){ ?>
                <tr class="sml-wdth-brdr">
                  <td class="align-middle fntwht500 fnt-wgt-500 table-hed sml-wdth-pad" >
                    <a class="tble-hed-sec" href="javaScript:void(0)" onclick="<?php if (empty(get_user_session_data())){ ?>
                    modalRegisterLogin(); <?php }else{ if($forum->addedById != $userDetail->assignTrainer){ ?>
                    $('#errorModal').modal('show');
                    <?php }else{ ?>
                    window.open('<?php echo base_url('home/forum/forumDetail/').encoding($forum->id); ?>','_self') <?php } } ?>"> <?php custom_echo($forum->title,60); ?> </a>
                      <p class="desctn"><?php custom_echo($forum->description,100);?></p>
                  </td>
                  <td class="align-middle wdth-block">
                    <div class="media media-res img-tble sml-wdth-lft">

                      <img src="<?php if(!empty($trainerDetail->profileImage)){ echo base_url().TRAINER_PROFILE_THUMB.$trainerDetail->profileImage;}else{ echo base_url().DEFAULT_IMAGE; } ?>" class="align-self-start mr-3">

                      <div class="media-body">
                        <div class="lgt-wgt-txt mt-0">Added By <span style="font-weight: 700;"><?php echo $trainerDetail->fullName; ?></span></div>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle sml-wdth-none">
                    <div class="forumicon fnt-size">
                      <span style="padding-left: 15px;"><i class="far fa-comment-alt"></i><?php echo $forum->totalAnswer; ?></span>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table> 
          </div>
          <?php }else{ ?> 
            <tr>
              <div class="NoDatatx">
                <h6>No Forum Found</h6>
              </div>
            </tr>
          <?php } ?>    
        </div>
      </div>
    </div>
</section>


  <!--Show error message for subscribe trainer to access trainer detail-->
  <div class="modal fade lsModal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form>
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="form-group">
              <h6>Look like you don't have access of this content. To access <?php echo $trainerDetail->fullName; ?>'s content, please subscribe.</h6>              
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-theme btn-bg-b" data-dismiss="modal">Cancel</button>
              <a href="<?php echo base_url('home/trainers'); ?>" class="btn btn-theme btn-bg-t" >Subscribe</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--video error modal-->
  <div class="modal fade lsModal" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form>
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="form-group">
            
              <h6>Look like you don't have access of this content. Please upgrade your membership plan to LEVEL <span id="levelId"></span>.</h6>
                     
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-theme btn-bg-b" data-dismiss="modal">Cancel</button>
              <a href="<?php echo base_url('home/trainers'); ?>" class="btn btn-theme btn-bg-t" >Subscribe</a>
          </div>
        </form>
      </div>
    </div>
  </div>   
  <!--End of Video error modal-->

  <!--End of error message for subscribe trainer to access trainer detail-->

<script type="text/javascript">

/*function playVideo(id){
 
  $('#allVideosinfo').lightGallery({
    selector : ".videoThumb a",
    thumbnail:false,
    controls:false,
    enableDrag:false,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
  });
}
*/
function playTrainingVideo(vid){
  $('#allVideostr'+vid).lightGallery({
    selector : ".videoThumb a",
    thumbnail:false,
    controls:false,
    enableDrag:false,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
  });
}

function modalRegisterLogin(){
 
  $('#loginModal').modal('show');
}

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
     <script type="text/javascript">

function playVideo(id){

  $('#allVideos'+id).lightGallery({
    autoplayFirstVideo: true,
    selector : ".videoThumb a",
    thumbnail:false,
    controls:false,
    enableDrag:false,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
  });
}

function playVideotr(id){

  $('#allVideosinfo'+id).lightGallery({
    autoplayFirstVideo: true,
    selector : ".videoThumb a",
    thumbnail:false,
    controls:false,
    enableDrag:false,
    autoplayControls:false,
    fullScreen:false,
    share:false,
    zoom:false,
    download:false
  });
}
function videomod(){
 $('#videoModal').modal('show');
}
</script>
