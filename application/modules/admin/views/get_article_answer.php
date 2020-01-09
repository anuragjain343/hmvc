
<?php if(!empty($answerList)){ 
 
    foreach($answerList as $value){?>
<li class="media media_pddng_chnge">
    <span class="media-left">
         <?php if(empty($value->profileImage)){?>
        <img class="media-object" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="Generic placeholder image" style="width: 64px;height: 64px;" />
        <?php }else{?>
         <?php if($value->answerBy=='admin' OR $value->answerBy=='trainer'){?>
    <img class="mr-1" src="<?php echo base_url().TRAINER_PROFILE_THUMB.$value->profileImage;?>" alt="" style="width: 64px;height: 64px;" >
  <?php }else{?>
      <img class="mr-1" src="<?php echo base_url().USER_PROFILE_THUMB.$value->profileImage;?>" alt="" style="width: 64px;height: 64px;" >
  <?php } ?>
            

        <?php }?>
    </span>
    <div class="media-body commnt-box">
        <h5 class="media-heading">Posted on <span><?php echo time_elapsed_string($value->crd);?></span> by <a href="<?php echo base_url()?>admin/trainers/trainerDetails/<?php echo encoding($value->userId);?>/<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['UserRole'];?>/<?php echo $value->answerBy;?>"><?php echo $value->fullName;?></a></h5>
        <p><?php echo $value->answer;?></p>
        <ul class="list-inline">
            <li class="pr-1">
                <a href="javascript:void(0);" class="">

                <span class="la la-thumbs-o-up" onclick="isLikeAnswer('admin/article/articleAnswerLike','<?php echo $article_id; ?>','<?php echo $value->answerId ?>');"></span>
                <span id="likeCount<?php echo $value->answerId;?>">
                <?php if($value->totalanslike){echo $value->totalanslike;}?></span> Likes</a> 
            </li>
            <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){?>
            <li class="pr-1" onclick="deleteArticleAnswer(<?php echo $value->answerId;?>);">
                <a href="javascript:void(0);" class="">
                <i class="la la-trash"></i>  Delete</a>
            </li>
            <?php }?>
        </ul>
    </div>                                                
 </li>
<?php } ?>
 
<?php }else{ ?>

  <li class="media media_pddng_chnge">
    <span class="media-left">  
<h3 style="color:black;"> No answer found</h3>

</span>
</li>

<?php }?>   
<script type="text/javascript">
    function deleteArticleAnswer(answerId) {
        var url = $('#baseurl').attr('data-name');
        var articleId = '<?php echo $article_id;?>'

        bootbox.confirm({
            message: "Are you sure you want to delete this comment ?",
            buttons: {
                confirm: {
                    label: 'OK',
                    className: 'btn btn-primary'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-default'
                }
            },
            callback: function (result) {
                if (result){
                    
                $.ajax({
                    method: "GET",
                    url: url+'admin/article/deleteArticleAnswer',
                    dataType: "json",
                    data:{answerId:answerId,articleId:articleId},
                    beforeSend: function () { 
                        show_loader(); 
                    },
                    success: function (data){
                        hide_loader();
                    if (data.status == 1){ 
                        toastr.success(data.message);
                        window.setTimeout(function (){
                         window.location.href = data.url;
                        }, 2000);
                    }else{
                        toastr.error(data.message);
                        hashCsrf.attr('data-values',data.hash);
                        return data.data;

                    } 
                    },
                    
                   
                });
            }
        }
    });
    }
</script>                                
