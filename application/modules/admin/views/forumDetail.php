
    <div class="app-content content">
          <div class="content-wrapper">        
            <div class="content-wrapper-before">
            </div>
                <div class="content-header row mt-10"></div> 
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <div class="timeline-card card border-grey border-lighten-2">
                            <div class="card-header cstm-crd-header">
                              <h4 class="card-title">
                               <a href="javascript:void(0);"><?php echo $forumData->title;?></a>
                              </h4>
                              <p class="card-subtitle text-muted mb-0 pt-1">
                                 <span class="font-small-3"><?php echo time_elapsed_string($forumData->crd);?> by <a href="#"><?php echo $forumData->fullName;?></a></span>
                              </p>
                            </div>
                            <div class="card-content">
                              <div class="row m-1">
                                <div class="col-xl-7 col-lg-12">
                                  <div class="align-self-center">
                                   <?php  if(empty($forumData->profileImage)){ ?>
                                    <img class="img-fluid" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="Timeline Image 1">
                                    <?php } else{
                                                if($forumData->addedBy=='user'){
                                                    $path = USER_PROFILE;
                                                }else{
                                                    $path = TRAINER_PROFILE_THUMB;
                                                }
                                        ?>
                                     <img class="img-fluid" src="<?php echo base_url().$path.$forumData->profileImage;?>" alt="Timeline Image 1">
                                    <?php }?>
                                  </div>              
                                </div>
                                <div class="col-xl-5 col-lg-12">
                                    <div class="text-center mt-1">
                                        <ul class="list-inline mb-1">
                                            <li class="pr-1">
                                                <a href="javascript:void(0);" class="" onclick="isLikeForum('admin/forum/forumLike','<?php echo $forumData->id ?>')">
                                                <span class="la la-thumbs-o-up" style="<?php if(!empty($currentUserLike)){ echo 'color:#5dbbf2';  }else{ echo 'color: ';  }?>"></span> <span id="likeCount<?php echo $forumData->id ?>"><?php echo $forumData->totalLike; ?> 

                                          <?php 

                                          if(!empty($forumData->totalLike) AND ($forumData->totalLike)>1){  ?> 
                                           Likes
                                       <?php }else{ ?>
                                         Like
                                       <?php }?>
                                              </span></a>
                                            </li>
                                            <li class="pr-1 line-hgt">
                                                <a href="#" class="">
                                                <span class="ft-eye"></span> <?php echo $forumData->totalView; ?>  
                                            <?php if(!empty($forumData->totalView) AND ($forumData->totalView)>1){  ?> 
                                           Views
                                       <?php }else{ ?>
                                         View
                                       <?php }?>
                                        </a>
                                            </li>
                                            <li class="line-hgt">
                                                <a href="#" class="">
                                                <span class="ft-message-square"></span> <?php echo $forumData->totalAnswer; ?> 
                                            
                                               <?php if(!empty($forumData->totalAnswer) AND ($forumData->totalAnswer)>1){  ?> 
                                           Answers
                                       <?php }else{ ?>
                                         Answer
                                       <?php }?>

                                        </a>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                              </div>
                              <p class="line-height-2 p-1"> <?php echo $forumData->description;?></p>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        <div class="">
                            <div class="card">
                                <div class="card-header cstm-crd-header">
                                    <h4 class="card-title">Answers</h4>
                                    <?php 
                                        $base_url = base_url();  
                                        $forumId = $forumData->id;
                                        $clickDelete ="deleteForum('$forumId','$base_url')" ;
                                    ?>
                                  <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <?php

                                          $csrf = get_csrf_token()['hash'];?>
                                        <input type="hidden" id="hashCsrf" data-values="<?php echo $csrf;?>"  data-keys="<?php echo get_csrf_token()['name'];?>">
                                        <?php if($forumData->addedById == $_SESSION[ADMIN_USER_SESS_KEY]['userId'] OR $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){?>
                                        <a onclick="<?php echo $clickDelete; ?>">
                                            <i class="ft-trash-2"></i>
                                        </a>
                                      <?php } ?>
                                    </li>
                                    <li>
                                      <!--   <a data-action="reload" href="<?php echo base_url()?>admin/forum/edit_forum?id=<?php echo encoding($forumId);?>" ">
                                            <i class="ft-edit-2"></i>
                                        </a> -->
                                          <?php if($forumData->addedById == $_SESSION[ADMIN_USER_SESS_KEY]['userId'] OR $_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){  ?>

                                           <?php if($forumData->forumStatus==1) { ?>
                                                            <a href="<?php echo base_url()?>admin/forum/edit_forum?id=<?php echo encoding($forumId);?>" ">
                                                                <i class="ft-edit-2"></i>
                                                            </a>
                                        <?php }else{?>
                                            <a href="<?php echo base_url()?>admin/forum/edit_forum?id=<?php echo encoding($forumId);?>>" ">
                                                                <i class="ft-edit-2"></i>
                                                            </a>
                                        <?php }?>

                                        <?php } ?>

                                    </li>
                                </ul>
                            </div>
                                </div>
                                
                                <div class="card-content">

                                    <div class="card-body crdBody">
                                     
                                        <ul class="media-list list-unstyled">
                                            <span id="rList"></span>
                                            <span id="ourBlogs"></span>
                                        </ul>

                                      
                                       <form id="answerByTrainer" action="<?php echo base_url()?>admin/forum/forumAnswer" method="POST">
                                         
                                        <div class="form-group">
                                            <label for="projectinput8">Answers</label>
                                            
                                            <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >

                                            <input type="hidden" name="forumId" value="<?php echo $forumData->id?>">
                                            <input type="hidden" name="answerById" value="<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['userId']; ?>">
                                             <input type="hidden" name="answerBy" value="trainer">
                                            <textarea id="projectinput8" rows="5" class="form-control" name="answer" placeholder="Answer"  data-trigger="hover"
                                             data-placement="top" data-title="Comments"></textarea>
                                        </div>
                                        <div class="form-actions border-0 mt-0 p-0 right">
                                            <button type="button" class="btn btn-primary" id="sendArticleAns">
                                                <i class="la la-check-square-o"></i> Send
                                            </button>
                                        </div>
                                         
                                         </form>
                                       
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
      </div>
<span id="baseurl" data-name="<?php echo base_url();?>"></span>



<script type="text/javascript">  
    // First time load product page
      function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }
     var baseurl = $("#baseurl").attr('data-name');
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
        url: baseurl+"admin/forum/ansList2",
        type: "POST",
        data:{offset:offset,csrf_test_name:data,forumId:fid}, 
        dataType: "JSON",
        beforeSend: function() {
           show_loader();
        }, 
        success: function(data){ 
            hide_loader();
           // alert(data.hash);
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
                $("#rList").html('');
            }
            if(data.no_record==0){//show data in div when no previous record 
                $("#rList").html(data.html_view);
                
            }else{
                //append data when already record show in view
                $("#rList").append(data.html_view);
                $("#ourBlogs").append(data.btn_html);
            }
        },
    }); 
}

</script>