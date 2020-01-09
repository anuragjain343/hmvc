<?php if(!empty($forumList)){?>
  <section class="forumSec frm-block sec-pad-30">
    <div class="container wrapper">
          <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped forum-tble">
                        <thead class="thead-dark">
                            <tr>
                              <th scope="col">Heading</th>
                              <th scope="col" class="wdth-block nnw-width">Posted By</th>
                              <th scope="col">Answers</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($forumList as $key => $value){ ?>
                            <tr class="sml-wdth-brdr">
                                <td class="align-middle fntwht500 fnt-wgt-500 table-hed sml-wdth-pad" >
                                  <a class="tble-hed-sec" href="javaScript:void(0)" onclick="isLogin('','home/forum/forumDetail/<?php echo encoding($value->id);?>');"><?php  custom_echo($value->title,60); ?></a>
                                    <p class="desctn"><?php custom_echo($value->description,100);?></p>
                                </td>
                                <td class="align-middle wdth-block">
                                    <div class="media media-res img-tble sml-wdth-lft">
                                    <?php if(!empty($value->profileImage)){
                                      if($value->addedBy=='user'){
                                        $plink = base_url().USER_PROFILE_THUMB.$value->profileImage;
                                      }
                                      else{
                                        $plink = base_url().TRAINER_PROFILE_THUMB.$value->profileImage;
                                      }
                                    ?>
                                    <img class="align-self-start mr-3" src="<?php echo $plink;?>" alt="Image">
                                      <?php } 
                                      else{?>
                                        <img class="align-self-start mr-3" src="<?php echo base_url().DEFAULT_IMAGE;?>" alt="Image">
                                        <?php }?> 

                                          <div class="media-body">
                                            <div class="lgt-wgt-txt mt-0"><?php echo time_elapsed_string($value->crd); ?> By <a href="<?php echo base_url('home/users/otherUserProfile/').encoding($value->userId); ?>"><?php echo $value->fullName; ?></a></div>
                                          </div>
                                    </div>
                                    <div class="text-center align-middle sml-wdth-block">
                                        <div class="forumicon fnt-size">
                                            <span><i class="far fa-comment-alt"></i><?php echo $value->ansCoun;?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle sml-wdth-none">
                                    <div class="forumicon fnt-size">
                                        <span><i class="far fa-comment-alt"></i><?php echo $value->ansCoun;?></span>
                                    </div>
                                </td>
                            </tr>
                           <?php } ?>
                  </tbody>
              </table> 
              <div class="page_link">
                <?php echo $pagination; ?>
              </div>
            </div>    
         </div>
      </div>
    </div>
  </section>
  <?php }else{?>
    <section>
      <div class="container wrapper">
      <center id="frmId"><h3 style="margin-top: 150px;">No data found</h3></center>
      </div>
    </section>
  <?php }?>