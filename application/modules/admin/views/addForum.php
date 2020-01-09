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
                            <h4 class="card-title" id="hidden-label-round-controls">Add New Forum</h4>
                            <!-- <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-v font-medium-3"></i>
                            </a> 
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a data-action="reload">
                                            <i class="ft-rotate-cw"></i>
                                        </a> 
                                    </li>
                                </ul>
                            </div>-->
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="card-text">
                                </div>
                                <form class="form" id="add_Fourm" action="<?php echo base_url()?>admin/forum/add_forum" method="POST" autocomplete="off">
                                    <div class="form-body">
                                        <div class="row">     
                                        <input type="hidden" name="frm" id="forumId" value="">                         
                                            <div class="form-group col-12 mb-2">


                                                <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                                <label class="sr-only" for="complaintinput1">Enter Title</label>
                                                <input type="text" id="complaintinput1" class="form-control round autoSaveElement" placeholder="Title" name="title" moduleType="forum">
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput5">Enter Description</label>
                                                <textarea id="complaintinput5" rows="5" class="form-control round autoSaveElement"  placeholder="Description" name="description" moduleType="forum"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="mr-1" for="complaintinput6">Allow Comment</label>
                                                <label class="radio-inline">
                                                    <input type="radio" id="yes" name="radio" value="0" checked="">YES</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="radio" value="1" id="no">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions frm-btns">
                                        <a href="<?php echo base_url();?>admin/forum"  class="btn btn-danger mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="button" class="btn btn-primary" id="addfourm"> <i class="la la-check-square-o"></i>Add</button>
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
<script type="text/javascript">
    $(document).ready(function() {
$(window).keydown(function(event){
if(event.keyCode == 13) {
event.preventDefault();
return false;
}
});
});
</script>

<script type="text/javascript">
var currentUrl = '<?php echo base_url();?>admin/forum/addforum';
/*if(currentUrl){
    window.setInterval(function(){       
        push_artical_data(1);
    }, 3000);
}
//ajax function to get notification list
function push_artical_data(flg){
    var title_a = $('#complaintinput1').val();
    var id_a = $('#forumId').val();
    var description_a = $('#complaintinput5').val();
    if(title_a.length > 0 || description_a.length > 0){
     formData = {title:title_a,description:description_a,forumStatus:0,upd_forum:id_a},
     f_action = '<?php echo base_url();?>admin/forum/add_forumAutoSave',
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
        var res = JSON.parse(data);
        if(res.status == 1){

         $("#forumId").val(res.forum_id);
        }
    }
    });
    }
  } 
*/
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
            var title_a = $('#complaintinput1').val();
            var id_a = $('#forumId').val();
            var description_a = $('#complaintinput5').val();
            formData = {title:title_a,description:description_a,forumStatus:0,upd_forum:id_a},
            f_action = '<?php echo base_url();?>admin/forum/add_forumAutoSave';
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