<div class="app-content content">
    <div class="content-wrapper">
        <input type="hidden" name="">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Update Forum</h4>
                            <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <!-- <a data-action="reload">
                                            <i class="ft-rotate-cw"></i>
                                        </a> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="card-text">
                                  
                                </div>
                                <form class="form" id="add_Fourm" action="<?php echo base_url()?>admin/forum/editForum" method="POST">
                                    <div class="form-body">
                                        <div class="row">  
                                        <input type="hidden" name="arid" id="checkid" value="2">                                     
                                            <div class="form-group col-12 mb-2">
                                                <input  type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>">
                                                <label class="sr-only" for="complaintinput1">Enter Title</label>
                                                <input type="text" id="complaintinput1" class="form-control round autoSaveElement" placeholder="Title" name="title" value="<?php echo $data->title;?>" moduleType="forum" ">
                                            </div>

                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput5">Enter Description</label>
                                                <textarea id="complaintinput5" rows="5" class="form-control round autoSaveElement"  placeholder="Description" name="description" moduleType="forum"><?php echo $data->description;?></textarea>
                                            </div>
                                             <div class="col-12">
                                                <label class="mr-1" for="complaintinput6">Allow Comment</label>
                                                <?php $datwa='checked';
                                                if($data->isDisableComment==0)
                                                {
                                                  $datwa= 'checked';
                                                }else{
                                                   $dwata= 'checked';
                                                }
                                                ?>
                                                <label class="radio-inline">
<input type="radio" id="yes" name="radio" value="0" <?php if($data->isDisableComment==0)
                                                { echo 'checked';}?> >YES</label>
                                                <label class="radio-inline">
              <input type="radio" name="radio" value="1" id="no"  <?php if($data->isDisableComment==1)
                                                { echo 'checked';}?> >NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="fId" id="frmid" value="<?php echo $data->id?>">
                                    <div class="form-actions frm-btns">
                                        <a href="<?php echo base_url();?>admin/forum" class="btn btn-danger mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="button" class="btn btn-primary" id="addfourm"> <i class="la la-check-square-o"></i>Update</button>
                                       <!--  <a href="forum.html" type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Save
                                        </a> -->

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

 <div class="modal fade lsModal" id="forumModel" tabindex="-1" role="dialog" aria-labelledby="errorModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form>
          <div class="modal-body">
            
            <div class="form-group">
              <h6> A previous unsaved version of this post exist. Do you want to restore it?(Chosing Yes will override your current post and chosing No will have no effect on your current post.)           
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger mr-1" data-dismiss="modal" id="deleterevition">No</button>
             <button type="button"  class="btn btn-primary" data-dismiss="modal" id="updateRevision">Yes</button>
              
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
window.onload=my_code();
function my_code(){

  var id_ack = $('#frmid').val();
    formData = {articlearticle:id_ack},
    f_action = '<?php echo base_url();?>admin/forum/checkForumId',
    $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        $("#forumModel").modal();
        $('#checkid').attr('value',1);
       }
     }
     });
}


$('body').on('click','#updateRevision', function(){
  var id_ack = $('#frmid').val();
   formData = {articleId:id_ack},
     f_action ='<?php echo base_url();?>admin/forum/getRevitionData',
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
      var res = JSON.parse(data);
      //alert(res.article.postId);
      if(res.status == 1){
        //alert(res.article.description);
        $('#complaintinput1').attr('value',res.article.title);
        $('#checkid').attr('value',2);
        //$('#complaintinput5').attr('value',res.article.description);
        $("#complaintinput5").val(res.article.description);
       
        $('#frmid').attr('value',res.article.postId);
         
       }
     }
     }); 
    });
//

$('body').on('click','#deleterevition', function(){
  var id_ack = $('#frmid').val();
   formData = {articleId:id_ack},
     f_action ='<?php echo base_url();?>admin/forum/DeleteRevition',
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        $('#checkid').attr('value',2); 
       }
     }
     }); 
    });


var currentUser = '<?php echo base_url();?>admin/forum/edit_forum';
var valueexit = $('#checkid').attr('value');
   /* window.setInterval(function(){ 
        if($('#checkid').attr('value')==1){
         $("#forumModel").modal();
        } 
    }, 1000);
*/


/*if(currentUser){
    window.setInterval(function(){ 
        push_artical_data();
    }, 3000);
}*/

//ajax function to get notification list

/*function push_artical_data(){
 
    var title_a       = $('#complaintinput1').val();
    var id_a          = $('#frmid').val();
    var description_a     = $('#complaintinput5').val();
    var id_ackr = $('#checkid').val();
   
    if(title_a.length > 0 || description_a.length > 0){
     formData = {title:title_a,description:description_a,articleStatus:0,upd_articlearticle:id_a,isexits:id_ackr},
     f_action = '<?php echo base_url();?>admin/forum/editForumRevision',
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, 
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        $("#articalId").val(res.article_id);
       }

      }
     });
    }
  } */

var autosaveOn = false,
  timeoutId;
     $('.autoSaveElement').each(function(){
        var elem = $(this);
        var oldVal = elem.val();
        elem.data('oldVal', elem.val());
        elem.bind("propertychange change keyup input paste", function(event){
            newVal = elem.val();
            newVal.trim().replace(/\s+/g, " "); //remove extra whitespace if any
            if(newVal == '' || oldVal == newVal){
                return;
            }
            var oldVal = newVal;
          compareData(oldVal, newVal, elem);
        });
    });

/*var descOldVal = CKEDITOR.instances.description.getData();
CKEDITOR.instances.description.on('change', function(){ 
    var elem =CKEDITOR.instances.description;
    var newVal= elem.getData();
    newVal.trim().replace(/\s+/g, " "); 
    if (newVal == '' || descOldVal == newVal) {
        return;
    }
    descOldVal = newVal;
    compareData(descOldVal, newVal, elem)
});*/

function compareData(oldVal,newVal,elem){
    if (timeoutId) clearTimeout(timeoutId);
       timeoutId = setTimeout(function () {
     autoSaveData(elem);
    }, 750);
}

   //auto save ajax call
    function autoSaveData(elem) {
        //console.log(CKEDITOR.instances.description);
        if(autosaveOn){
            return; //return when previous ajax is in process
        }
        autosaveOn = true;
        var moduleType =  $('.autoSaveElement').attr('moduleType'); //get module type from elem
        switch(moduleType) {
            case 'article':
                var title_a     = $('#title').val();
                var id_a        = $('#articalId').val();
                var selValue    = $('input[name=radio]:checked').val(); 
                var description_a = CKEDITOR.instances.description.getData(); 
                var formData = {title:title_a,description:description_a,radio:selValue,articleStatus:0,upd_articlearticle:id_a},   
                f_action = '<?php echo base_url();?>admin/article/add_article1'; 
                break;
              case 'forum':
            // prepare your data accordingly
            var title_a       = $('#complaintinput1').val();
            var id_a          = $('#frmid').val();
            var description_a     = $('#complaintinput5').val();
            formData = {title:title_a,description:description_a,articleStatus:0,upd_articlearticle:id_a},
             f_action = '<?php echo base_url();?>admin/forum/editForumRevision';
            break;
            default:     
        }

     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
        autosaveOn = false; 
        var res = JSON.parse(data);
       if(res.status == 1){
       
        //$("#articalId").val(res.article_id);
         $("#forumId").val(res.forum_id);
        }
        }
        });
    }
</script>