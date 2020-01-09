
  <section class="forumSec-details sec-pad-50" id="runtimeLike">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="forumList-details">
            <div class="frlistItem frDetailsSingle">
              <div class="media">
                <?php if(!empty($value->profileImage)){
      if($value->addedBy=='user'){$plink = base_url().USER_PROFILE_THUMB.$value->profileImage;}else{$plink = base_url().TRAINER_PROFILE_THUMB.$value->profileImage;}
    ?>
                <img class="mr-3" src="<?php echo $plink;?>" alt="">
              <?php }else{?>
                <img class="mr-3" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="">
              <?php }?>
                <div class="media-body forumInfo">
                  <a class="forumTitle" href="javascript:void(0);"><?php echo $forumData->title;?></a>
                  <div class="postedMeta">
                    <p>Posted on <a href="javascript:void(0);"><?php echo time_elapsed_string($forumData->crd);?></a> By <a href="<?php echo base_url('home/users/otherUserProfile/').encoding($forumData->addedById); ?>"><?php echo $forumData->fullName;?></a></p>
                  </div>
                  <p class="paraText"><?php echo $forumData->description;?></p>
                  <div class="forumicon">

                      <span ></span>
                      <input type="hidden" id="withoutRefresh">
                    <span id="old"><a href="Javascript:void(0)" data-toggle="tooltip" title="Like" onclick="isLikeForum('home/forum/forumLike','<?php echo $forumData->id ?>')" >
                      <?php 
                        if($currentUserLike=='1' &&  $forumData->totalLike >'1'){
                            $count = $forumData->totalLike-1;
                            $like = 'You and  '.$count.' others';
                          }elseif ($currentUserLike=='1' &&  $forumData->totalLike=='1'){
                             $like = 'You liked';                         
                          }else{
                           if($forumData->totalLike<2 OR empty($forumData->totalLike)){ 
                            $like =  $forumData->totalLike.' Like';
                            }else{
                              $like =  $forumData->totalLike.' Likes';
                            }
                          }
                      ?>
                     
                  <i class="far fa-thumbs-up mylike" style="<?php if(!empty($currentUserLike)){ echo 'color:#5dbbf2';  }else{ echo 'color: ';  }?>"></i></a><span id="likeCount<?php echo $forumData->id ?>"> <?php echo $like;?>

                    </span></span>
                    <span><i class="far fa-eye myview" data-toggle="tooltip" title="View" style="color:#5dbbf2;"></i> <?php if(empty($forumData->totalView)){ echo '';} else { echo $forumData->totalView; }?> 
                      <?php if($forumData->totalView<2 OR empty($forumData->totalView)){ 
                        $view='View';
                      }else{
                        $view='Views';
                      }
                        ?>
                  <?php echo $view; ?> </span>
                    <span><i class="far fa-comment-alt" data-toggle="tooltip" title="Answer"></i><span id="ans-count" data-value="<?php echo $answerCount;?>"><?php echo $answerCount;?>
                     <?php if($answerCount<2 OR empty($answerCount)){
                      $answ='Answer';
                     }else{
                       $answ='Answers';
                     } ?>

                    <?php echo $answ;?></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="forumAnswerBlock wrapper">
              
              <!-- -------------------------------------------------------------------- -->
                <?php  if($forumData->isDisableComment=='0'){ ?>

                <form action="<?php echo base_url()?>home/forum/forumAnswer" method="POST" id="answerByTrainer">
                  <div class="form-group">
                  <input type="hidden" id ="hash" data-name="<?php echo get_csrf_token()['name'];?>" data-value="<?php echo get_csrf_token()['hash'];?>">

                  <input type="hidden" name="forumId" value="<?php echo $forumData->id?>">
                  <?php if(!empty( $_SESSION[USER_SESS_KEY]['userId'])){?>
              <input type="hidden" name="answerById" value="<?php echo $_SESSION[USER_SESS_KEY]['userId']; ?>">
                   <input type="hidden" name="answerBy" value="<?php if(!empty($_SESSION[USER_SESS_KEY]['UserRole'])){ echo $_SESSION[USER_SESS_KEY]['UserRole']; } ?>">
                 <?php } ?>
                    <textarea class="form-control" id="forumAnswer" placeholder="Write Answers" rows="4" name="answer"></textarea>
                  </div>
                  <div class="text-right">
                    <a  class="btn btn-theme btn-bg-t btn-round lft-btn" href="javascript:void(0);" id="sendAns">Submit</a>
                  </div>
                </form>
             <?php } ?>
              <!-- -------------------------------------------------------------------- -->
              <ul class="media-list list-unstyled">
                <h2>Answers</h2>
                  <span id="ansList"></span>
                  <span id="ourBlogs"></span>
              </ul>
               
            </div>


          
          </div>
        </div>
      </div>
    </div>
  </section>
 

<span id="bsurl" data-value="<?php echo base_url();?>home/forum/answerList"></span>

  <script type="text/javascript">


    window.onload = function() {
        isView('home/forum/forumView','<?php echo $forumData->id;?>');
      };

    // First time load product page
  function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }
     var baseurl = $("#bsurl").attr('data-value');
     var data = $("#hash").attr('value');
    get_view_me_list1();
    //when click on load more button 
    $('body').on('click', "#btnLoadViewMe1", function (event) {
            is_load_more = 1;
        get_view_me_list1(is_load_more);
    });

    //ajax funnction to get_product_list 
   function get_view_me_list1(is_load_more=0){ 
    if(is_load_more!=0){
    //if is_load_more is not 0 then get offset data from btnlod attr
        offset = $('#btnLoadViewMe1').attr("data-offset");
        var data = $("#hash").attr('value');
    }else{ 
    //set offset =0 when is_load_more is 0
        offset = 0;
        var data = $("#hash").attr('value');
    }
    var fid= '<?php echo $forumData->id;?>';
    //alert(data);

    $.ajax({
        url: baseurl,
        type: "POST",
        data:{offset:offset,csrf_test_name:data,forumId:fid}, 
        dataType: "JSON",
        beforeSend: function() {
           show_loader();
        }, 
        success: function(data){ 
            hide_loader();
             $("#hash").val(data.hash);
            if(data.status==-1){
                toastr.error(data.msg);
                window.setTimeout(function () {
                      window.location.href = data.url;
                }, 1000); 
            }
         $('#btnLoadViewMe1').remove();
            //remove load more button 

            if(offset==0){ //clear div when offset 0
                $("#ansList").html('');
            }
            if(data.no_record==0){//show data in div when no previous record 
                $("#ansList").html(data.html_view);
                
            }else{
                //append data when already record show in view
                $("#ansList").append(data.html_view);
                $("#ourBlogs").append(data.btn_html);
            }
        },
    }); 
}

</script>
     </script>

