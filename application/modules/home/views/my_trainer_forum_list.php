<?php if(!empty($result)){ ?>
  <section class="forumSec frm-block sec-pad-30">
    <div class="container wrapper">
          <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped forum-tble">
                        <thead class="thead-dark">
                            <tr>
                              <th scope="col">Heading</th>
                              <th scope="col" class="wdth-block">Posted On</th>
                              <th scope="col">Answers</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($result as $key => $value){ ?>
                            <tr class="sml-wdth-brdr">
                                <td class="align-middle fntwht500 fnt-wgt-500 table-hed sml-wdth-pad" >
                                  <a class="tble-hed-sec" href="<?php echo base_url('home/forum/forumDetail/').encoding($value['id']);?>"><?php  custom_echo($value['title'],30); ?></a>
                                    <p class="desctn"><?php custom_echo($value['description'],50);?></p>
                                </td>
                                <td class="align-middle wdth-block">
                                    <div class="media media-res img-tble sml-wdth-lft">
                                    <div class="media-body">
                                      <div class="lgt-wgt-txt mt-0"><?php echo time_elapsed_string($value['crd']); ?></div>
                                    </div>
                                    </div>
                                    <!-- <div class="text-center align-middle sml-wdth-block">
                                        <div class="forumicon fnt-size">
                                            <span><i class="far fa-comment-alt"></i><?php //echo $value['totalAns'];?></span>
                                        </div>
                                    </div> -->
                                </td>
                                <td class="text-center align-middle sml-wdth-none">
                                    <div class="forumicon fnt-size">
                                        <span><i class="far fa-comment-alt"></i><?php echo $value['totalAns'];?></span>
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
  <div>
    <center><h2 style="font-size: 20px; color: #757575; margin-top: 80px;">No Forum Found</h2></center>
  </div>
<?php }?>