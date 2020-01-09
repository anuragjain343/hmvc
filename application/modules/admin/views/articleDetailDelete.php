
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Delete Article</h4>
                            <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="card-text">
                                </div>
                                <form class="form" id="" action="" method="POST">
                                    <div class="form-body">
                                        <div class="row">                                       
                                            <div class="form-group col-12 mb-2">
                                                <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                                <label class="sr-only" for="complaintinput1">Enter Title</label>
                                                <input type="text" id="title" class="form-control round" placeholder="Title" name="title" value="<?php echo $data->title;?>" readonly>

                                                <input type="hidden" name="id" value="<?php echo encoding($data->id); ?>">
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput5">Enter Description</label>
                                                <textarea id="description" rows="5" class="form-control round"  placeholder="Description" name="description" readonly><?php echo $data->description;?></textarea>
                                            </div>
                                            <div class="col-12 ">
                                                <label class="mr-1" for="complaintinput6">Allow Comment</label>
                                                <label class="radio-inline"><input type="radio" name="radio" value="0" <?php if($data->isDisableComment=='0'){ echo "checked"; }?> disabled >YES</label>
                                                <label class="radio-inline"><input type="radio" name="radio" value="1" <?php if($data->isDisableComment=='1'){ echo "checked"; }?>disabled >NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    $base_url = base_url();  
                                    $clickDelete ="deleteArticle('$data->id','$base_url')" ;
                                    $base_url1 = base_url().'admin/article/deleteReject';  
                                    $clickDeleteReject ="deleteReject('$data->id','$base_url1')" ;
                                    ?>
                                    <div class="form-actions frm-btns">
                                      
                                    <button type="button" class="btn btn-danger mr-1" onclick="<?php echo $clickDeleteReject; ?>"><i class="ft-x"></i>Reject</button>    
                                    <button type="button" class="btn btn-primary" onclick="<?php echo $clickDelete; ?>"><i class="la la-check-square-o"></i>Accept</button>
                                      

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
     CKEDITOR.replace('description',{
        removePlugins: ','
     });
</script>
