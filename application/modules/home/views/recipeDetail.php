<?php  if(!empty($recipeData)){
                     // pr($recipeData);                 
          if(!empty($recipeData->image)){
          //$fileName = 'uploads/profile/thumb/'.$query->profile_image;
              if(file_exists(RECEPIE_THUMB.$recipeData->image)){
                  $fileName = base_url().RECEPIE_THUMB.$recipeData->image;
              }else{
                  $fileName = base_url().DEFAULT_RECEPIE_IMAGE;
              }
          }else{

              $fileName = base_url().DEFAULT_RECEPIE_IMAGE; 
          } 
  ?>
   <section class="video-sec sec-pad-50 wrapper">
      <div class="container">
          <div class="section-title text-center sec-arrow-dark">
              <h4>Health</h4>
              <h2>Recipe Details</h2>  
          </div>
          <div class="recipies-details">
            <div class="row">
              <div class="col-md-5 col-lg-4">
                <div class="sticky">
                  <div class="recipeImg">
                    <img class="mr-3" src="<?php echo $fileName;?>" alt="" >
                  </div>   
                    <?php 
                        if($currentUserLike=='1' &&  $recipeLike >'1'){
                            $count = $recipeLike-1;
                            $like = 'You and  '.$count.' other like this';
                          }elseif ($currentUserLike=='1' &&  $recipeLike=='1'){
                             $like = 'You like this';                         
                          }else{
                           $like =  $recipeLike.' Likes';
                          }
                      ?>          
                  <div class="forumicon">
                    <div class="reciepIcons">
                      <span>
                        <a href="javascript:void(0);" onclick="recipeLike('home/recipes/recipeLike','<?php echo $recipeData->rId ?>')" class="liked">

                        <i class="fas fa-thumbs-up"></i></a>
                        <div id="pasteRecLike<?php echo $recipeData->rId; ?>" style= "display: inline-block;"><?php echo $like;?>
                        </div>
                      
                    </span>
                      <span><i class="far fa-eye"></i> <?php if(!empty($recipeView)){ echo $recipeView.' Views';}else{ echo '0 Views'; } ?> </span>
                    </div>
                  </div>


                </div>
              </div>
              <div class="col-md-7 col-lg-8">
                <div class="recipeInfo">                        
                  <div class="prdct-value-info">
                    <div class="prdct-value-name">
                      <h2><?php echo $recipeData->title; ?></h2>
                    </div>
                    <div class="prdct-value-prc">
                       <p>Posted on <span><?php echo time_elapsed_string($recipeData->createdby);?></span></p>
                    </div>
                    <div class="recipesDes">
                      <p class="paraText"><?php echo $recipeData->description;?></p>
                      <div class="reciepMoreInfo">
                          <?php                                             
                              if(!empty($recipeData->video)){
                                if(file_exists(RECEPIE_VIDEO.$recipeData->video)){
                                    $fileVideo = base_url().RECEPIE_VIDEO.$recipeData->video;
                                }else{
                                    $fileVideo = base_url();
                                }
                              }else{

                                $fileVideo = base_url(); 
                              }
                              if(!empty($recipeData->video)){
                          ?>
                        <div class="videoItem">
                          <video controls>
                            <source src="<?php echo $fileVideo;?>" type="video/mp4">
                          </video>
                        </div>
                            <?php }?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
   </section>
   <span id="baseurl" data-name="<?php echo base_url();?>"></span>
 <?php }?>
  <script type="text/javascript">
//function for view
      window.onload = function() {
        isRecipeView('home/recipes/recipeView','<?php echo $recipeData->rId;?>');
      };  

//function for like    
  function recipeLike(ctrl,rId){
    var base_url = $('#baseurl').attr('data-name');
   $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    dataType: "JSON", 
    data: {'id':rId}, //only input
    success:function(res){
      //var obj = JSON.parse(res);
      if(res.status=='1'){
       $("#pasteRecLike"+rId).html(res.html);
      }
      else{
        $("#pasteRecLike"+rId).html(res.html);
      }  
    }
  });
 }


 //definetion of recepie view
 function isRecipeView(ctrl,vid){
var base_url = $('#baseurl').attr('data-name');
  $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    data: {'id':vid}, //only input
    success:function(res){
      var obj = JSON.parse(res);
      if(obj.status=='1'){
       $(".myview").css("color", "#5dbbf2");
      } 
    }
  });
 }
  </script>