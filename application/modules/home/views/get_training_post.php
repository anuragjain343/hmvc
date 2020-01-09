   <?php if(!empty($postList)){?>
    <?php  foreach($postList as $key => $value) {
                             
     ?>
        <div class="recipies-details  p-40">
            <div class="container">
                <div class="row">    

              
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="recipeInfo">                        
                            <div class="prdct-value-info">
                                <div class="prdct-value-name">
                                    <h2><?php  custom_echo($value->title,20);?></h2>
                                </div>
                                <div class="prdct-value-prc">
                                    <p>Posted on <span><?php echo time_elapsed_string($value->crd);?></span></p>
                                </div>
                                  
                                <div class="recipesDes">
                                    <span class="paraText">
                                    <?php echo $value->description;?></span>
                                </div>
                                
                                <?php if(!empty($value->pdf)){?>
                                <a href="<?php echo base_url().TC_PDF.$value->pdf;?>"  target="_blank"  class="btn btn-theme btn-bg-t">Download PDF</a>
                            <?php }?>

                                                 
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
         <?php } ?>
      <?php }else{ ?>
   
    
    <center>
    <h3 style="padding-top: 50px;"> NO RECORD FOUND</h3>
    </center>
               
        

    <?php }?>
<style type="text/css">
   .ad-gallery .ad-image-wrapper {
    z-index: 1 !important;
}
</style>
