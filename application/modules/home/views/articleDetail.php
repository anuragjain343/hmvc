
  <section class="forumSec-details sec-pad-50 wrapper">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="forumList-details">
            <div class="frlistItem frDetailsSingle">
              <div class="media">
                <?php if(!empty($articalData->profileImage)){ ?>
                <img class="mr-3" src="<?php echo base_url().ADMIN_PROFILE.$articalData->profileImage;?>" alt="">
              <?php }else{?>
                 <img class="mr-3" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="">
              <?php }?>
                <div class="media-body forumInfo">
                  <a class="forumTitle" href="javascript:void(0);"><?php echo $articalData->title;?></a>
                  <div class="postedMeta">
                    <p>Posted on <a href="#">
                    <!--   <?php echo time_elapsed_string($articalData->articleCreate);?> -->
                        
                      </a> By <a href="<?php echo base_url('home/users/otherUserProfile/').encoding($articalData->addedById); ?>"><?php echo $articalData->fullName;?></a></p>
                  </div>
                  <p class="paraText"><?php echo $articalData->description;?></p>

                  <div class="forumicon">
                       <span><a href="javascript:void(0);" data-toggle="tooltip" title="Like" onclick="isLike('home/article/articleLike','<?php echo $articalData->articleId; ?>')"><i class="far fa-thumbs-up mylike" style="<?php if(!empty($currentUserLike)){ echo 'color:#5dbbf2';  }else{ echo 'color: ';  }?>"></i></a> 
                      <span id="totallike"> 
                        <?php if(!empty($currentUserLike)==1 AND !empty($articalData->totalLike) AND $articalData->totalLike ==1)
                          {
                            echo 'You liked';
                          }
                        if(!empty($currentUserLike)==1 AND !empty($articalData->totalLike) AND $articalData->totalLike>1)
                          {
                           echo 'You and '.($articalData->totalLike-1).' others';
                          }
                           if(empty($currentUserLike) AND empty($articalData->totalLike))
                          {
                           echo '0 Like';
                          }
                          if(empty($currentUserLike) AND !empty($articalData->totalLike))
                          {
                           if($articalData->totalLike<2){ 
                           echo $articalData->totalLike.' Like';
                         }else{
                          echo $articalData->totalLike.' Likes';
                         }
                          }

                          ?>
                      </span>
                    </span>

                  <span><i class="far fa-eye myview" data-toggle="tooltip" title="View" style="color:#5dbbf2;"></i> <?php if(empty($articleViewCount)){ echo '0';} else { echo $articleViewCount; } 
                  if($articleViewCount<2 OR empty($articleViewCount))
                    {
                      $viw ='View';
                    }else{
                      $viw ='Views';
                    }
                  ?>
                <?php echo $viw;?>
              </span>
                   
                    <span><i class="far fa-comment-alt" data-toggle="tooltip" title="Comment"></i><span id="totalanswerCount" data-value="<?php echo $articalAnswer;?>"> <?php echo $articalAnswer;?></span> 
                      <?php if($articalAnswer<2 OR empty($articalAnswer)){
                        $artAns='Comment';
                      }else{
                         $artAns='Comments';
                      }
                      ?>
                 <?php echo $artAns; ?></span>
                  </div>

                </div>
              </div>
            </div>
           
            <div class="forumAnswerBlock">
               <?php if($articalData->isDisableComment == 0){?>
                  <form id="answerByUser" action="<?php echo base_url()?>home/article/articleAnswerByUser" method="POST">
                     <input type="hidden" name="articleId" value="<?php echo $articalData->articleId?>">
                  <input type="hidden" name="answerById" value="<?php echo $_SESSION[USER_SESS_KEY]['userId']; ?>">
                   <input type="hidden" name="answerBy" value="user">
                  <div class="form-group">
                    <textarea  id="projectinput8"  class="form-control" placeholder="Write Comment" rows="4" name="answer"></textarea>
                  </div>
                  <div class="text-right">
                    <a type="submit" class="btn btn-theme btn-bg-t btn-round lft-btn" href="javascript:void(0);" id="addAnsbyUser">Send</a>
                  </div>
                </form>
              <?php }?>
              <h2>Comments</h2>
              <span id="answerListAll"></span>    
              <span id="ourBlogs"></span>    
          </div>
        
        </div>
      </div>
    </div>

  </section>
  
   <script type="text/javascript">
       window.onload = function() {
        isView('home/article/articleView','<?php echo $articalData->articleId;?>');
      };
    var data = $("#hasharticl");
      //alert(data);


    var baseurl ='<?php echo base_url();?>';
     //var data = $("#hash").attr('value');
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
        //alert(offset);
        var data = $("#hasharticl").attr('value');
    }else{ 
    //set offset =0 when is_load_more is 0
        offset = 0;
        var data = $("#hasharticl").attr('value');
    }
    var arid= '<?php echo $articalData->articleId;?>';
    //alert(baseurl);

    $.ajax({
        url: baseurl+"home/article/articleAnswer",
        type: "POST",
        data:{offset:offset,csrf_test_name:data,articleId:arid}, 
        dataType: "JSON",
        beforeSend: function() {
          // show_loader();
        }, 
        success: function(data){ 
         //   hide_loader();
           
             $("#hasharticl").val(data.hash);
            if(data.status==-1){
                toastr.error(data.msg);
                window.setTimeout(function () {
                      window.location.href = data.url;
                }, 1000); 
            }
         $('#btnLoadViewMe1').remove();
            //remove load more button 

            if(offset==0){ //clear div when offset 0
                $("#answerListAll").html('');
            }
            if(data.no_record==0){//show data in div when no previous record 
                $("#answerListAll").html(data.html_view);
                
            }else{
                //append data when already record show in view
                $("#answerListAll").append(data.html_view);
                $("#ourBlogs").append(data.btn_html);
            }
        },
    }); 
}


   </script>
 