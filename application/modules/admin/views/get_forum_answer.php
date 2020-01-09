
<?php if(!empty($answerList)){
//pr($answerList); 
    foreach($answerList as $value){
        ?>
<li class="media media_pddng_chnge">
    <span class="media-left">
         <?php if(empty($value->profileImage)){
            // pr($value);
            ?>
        <img class="media-object" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="Generic placeholder image" style="width: 64px;height: 64px;" />
        <?php }else{
            if($value->answerBy=='user'){
                $path = USER_PROFILE;
            }else{
                $path = TRAINER_PROFILE_THUMB;
            }
            ?>
              <img class="media-object" src="<?php echo base_url().$path.$value->profileImage;?>" alt="Generic placeholder image" style="width: 64px;height: 64px;" />
        <?php }?>
    </span>
    <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
     if($value->answerBy=='user'){
      $link=base_url('admin/users/userDetails/').encoding($value->user_id);
       }else{
        $link = base_url('admin/trainers/trainerDetails/').encoding($value->user_id);
   }

   }else{
    $link = '#';
   }?>
    <div class="media-body commnt-box">
        <h5 class="media-heading">Posted on <span><?php echo time_elapsed_string($value->crd);?></span> by <a href="<?php echo $link;?>"><?php echo $value->fullName;?></a></h5>
        <p><?php echo $value->answer;?></p>
        <ul class="list-inline">
            <li class="pr-1">
                <a href="javascript:void(0);" class="pad-rgt-0" onclick="answerLike('admin/forum/answerLike','<?php echo $value->answerId ?>')">

                <span class="la la-thumbs-o-up" id="mylike<?php echo $value->answerId;?>" ></span></a><span id="pasteLike<?php echo $value->answerId; ?>"><?php if($value->totalanslike){echo $value->totalanslike;}else{ echo 0; }?>  Likes</span>
            </li>
            <?php if($_SESSION[ADMIN_USER_SESS_KEY]['UserRole']=='admin'){
                ?>
            <li class="pr-1" onclick="delet(<?php echo $value->answerId;?>);">
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
    function delet(answerId) {
        var url = $('#baseurl').attr('data-name');
        var forumId = '<?php echo $forum_id;?>'
        bootbox.confirm({
            message: "Are you sure you want to delete this Answer ?",
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
                    url: url+'admin/forum/delete_comment',
                    dataType: "json",
                    data:{answerId:answerId,forumId:forumId},
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
