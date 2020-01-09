<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <div class="card ">
                        <div class="card-header bg-hexagons">
                            <h4 class="card-title ">Posted By</h4>
                        </div>
                        <div class="card-content collapse show bg-hexagons">
                            <div class="card-body pt-0 pb-1">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <?php 
                                            if($articleData->addedBy == 'trainer' OR $articleData->addedBy=='admin'){
                                                $path = TRAINER_PROFILE_THUMB;   
                                            }
                                          if(empty($articleData->profileImage)){ 
                                            ?>
                                        <img class="media-object user-dtl-prfle rounded-circle donutShadow" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="Avatar">
                                         <?php } else{?>
                                        <img class="media-object user-dtl-prfle rounded-circle donutShadow" src="<?php echo base_url().$path.$articleData->profileImage;?>" alt="Avatar">
                                        <?php }?>
                                    </div>
                                    <div class="media-body text-right mt-2">
                                        <h3 class="fnt-style-nme blue-grey lighten-1 "><?php echo $articleData->fullName;?>
                                        </h3>
                                        <h6 class="mt-1">
                                            <span class="text-muted"><?php echo time_elapsed_string($articleData->crd);?>
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="card">
                        <div class="card-header cstm-crd-header">
                            <h4 class="card-title pr-6" id="hidden-label-round-controls"><?php 
                           // pr($articleData);   
                            echo $articleData->title;?></h4>
                            <?php 
                                $base_url = base_url();  
                                $articleId = $articleData->id;
                                if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){   
                                    $clickDelete ="deleteArticleByAdmin('$articleId','$base_url')" ;
                                }else{
                                    $clickDelete ="deleteArticle('$articleId','$base_url')" ; 
                                }
                                
                            ?>
                            <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <?php

                                          $csrf = get_csrf_token()['hash'];?>
                                        <input type="hidden" id="hashCsrf" data-values="<?php echo $csrf;?>"  data-keys="<?php echo get_csrf_token()['name'];?>">

                                        <a onclick="<?php echo $clickDelete; ?>">
                                            <i class="ft-trash-2"></i>
                                        </a>
                                    </li>
                                    <li>
                                      <!--   <a data-action="reload" href="<?php echo base_url()?>admin/article/edit_article?id=<?php echo encoding($articleId);?>" ">
                                            <i class="ft-edit-2"></i> -->
                                        </a>

                                           <?php if($articleData->articleStatus==1) { ?>
                                                            <a href="<?php echo base_url()?>admin/article/edit_article?id=<?php echo encoding($articleId);?>" ">
                                                                <i class="ft-edit-2"></i>
                                                            </a>
                                        <?php }else{?>
                                            <a href="<?php echo base_url()?>admin/article/addArticle?id=<?php echo encoding($articleId);?>" ">
                                                                <i class="ft-edit-2"></i>
                                                            </a>
                                        <?php }?>





                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="card-text">
                                    <p><?php echo $articleData->description;?></p>
                                    <div class="mt-1">
                                        <ul class="list-inline mrb-0">
                                            <li class="pr-1">
                                                <a href="javascript:void(0);" class="" onclick="isLikeForum('admin/article/articleLike','<?php echo $articleData->id; ?>');">
                                                    <span class="la la-thumbs-o-up"></span> <span id="likeCount<?php echo $articleData->id;?>"><?php echo $totalLike; ?></span>
                                                </a>
                                            </li>
                                            <li class="pr-1 line-hgt">
                                                <a href="#" class="">
                                                    <span class="ft-eye icon-opacity"></span> <?php echo $totalView; ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                                <div class="card-header cstm-crd-header">
                                    <h4 class="card-title">Answers</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body crdBody">
                                        <ul class="media-list list-unstyled">
                                            <span id="artAnsList"></span>
                                            <span id="ourBlogs"></span>
                                        </ul>

                                      
                                         <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin' || $articleData->isDisableComment=='0'){?>
                                       <form id="answerByTrainer" action="<?php echo base_url()?>admin/article/articleAnswer" method="POST">
                                        <div class="form-group">
                                            <label for="projectinput8">Answers</label>
                                            
                                            <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >

                                            <input type="hidden" name="articleId" value="<?php echo $articleData->id?>">
                                            <input type="hidden" name="answerById" value="<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['userId']; ?>">
                                             <input type="hidden" name="answerBy" value="<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];?>">
                                            <textarea id="projectinput8" rows="5" class="form-control" name="answer" placeholder="Answer"  data-trigger="hover"
                                             data-placement="top" data-title="Comments"></textarea>
                                        </div>
                                        <div class="form-actions border-0 p-0 mt-0 right">
                                            <button type="button" class="btn btn-primary" id="sendArticleAns">
                                                <i class="la la-check-square-o"></i> Send
                                            </button>
                                        </div>
                                         
                                         </form>
                                    <?php }?>
                                       
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
      </div>
</div>
<span id="baseurl" data-name="<?php echo base_url();?>"></span>
<script type="text/javascript">
    function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }
     var baseurl = $("#baseurl").attr('data-name');
     var data = $("#hash").attr('value');
    get_view_me_list2();
    //when click on load more button 
    $('body').on('click', "#btnLoadViewMe1", function (event) {
            is_load_more = 1;
        get_view_me_list2(is_load_more);
    });


function get_view_me_list2(is_load_more=0){ 
    if(is_load_more!=0){
    //if is_load_more is not 0 then get offset data from btnlod attr
        offset = $('#btnLoadViewMe1').attr("data-offset");
        var data = $("#hash").attr('value');
    }else{ 
    //set offset =0 when is_load_more is 0
        offset = 0;
        var data = $("#hash").attr('value');
    }
    var fid= '<?php echo $articleData->id;?>';
    //alert(data);

    $.ajax({
        url: baseurl+"admin/article/artAns",
        type: "POST",
        data:{offset:offset,csrf_test_name:data,articleId:fid}, 
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
                $("#artAnsList").html('');
            }
            if(data.no_record==0){//show data in div when no previous record 
                $("#artAnsList").html(data.html_view);
                
            }else{
                //append data when already record show in view
                $("#artAnsList").append(data.html_view);
                $("#ourBlogs").append(data.btn_html);
            }
        },
    }); 
}
</script>