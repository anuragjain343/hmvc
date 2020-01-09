
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Update Article</h4>
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
                                <form class="form" id="addarticle" action="<?php echo base_url()?>admin/article/editArticle" method="POST">
                                    <div class="form-body">
                                        <div class="row">  
                                        <input type="hidden" name="arid" id="checkid" value="2">                                     
                                            <div class="form-group col-12 mb-2">
                                                <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value ="<?php echo get_csrf_token()['hash'];?>" >
                                            
                                                <label class="sr-only" for="complaintinput1">Enter Title</label>
                                                <input type="text" id="title" class="form-control round autoSaveElement" placeholder="Title" name="title" value="<?php echo $data->title;?>" moduleType="article">

                                                <input type="hidden" name="id" value="<?php echo encoding($data->id); ?>">
                                            </div>
                                            <div class="form-group col-12 mb-2">
                                                <label class="sr-only" for="complaintinput5">Enter Description</label>
                                                <textarea id="description" rows="5" class="form-control round"  placeholder="Description" name="description" moduleType="article"><?php echo $data->description;?></textarea>
                                            </div>
                                            <div class="col-12 ">
                                                <label class="mr-1" for="complaintinput6">Allow Comment</label>
                                                <label class="radio-inline">
                                                    <input type="radio" id="r1" name="radio" value="0" <?php if($data->isDisableComment=='0'){ echo "checked"; }?> >YES</label>
                                                <label class="radio-inline"><input type="radio" name="radio" " id="r2" value="1" <?php if($data->isDisableComment=='1'){ echo "checked"; }?> >NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="artId" id="article_id" value="<?php echo $data->id?>">
                                    <div class="form-actions frm-btns">
                                        <a href="<?php echo base_url();?>admin/article" class="btn btn-danger mr-1"><i class="ft-x"></i>Cancel
                                        </a>
                                        <button type="button" class="btn btn-primary" id="add_article"><i class="la la-check-square-o"></i>Update</button>
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

<!--  -->

 <div class="modal fade lsModal" id="articleModel" tabindex="-1" role="dialog" aria-labelledby="errorModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
             <button type="button" class="btn btn-primary" data-dismiss="modal" id="updateRevision">Yes</button>
              
          </div>
        </form>
      </div>
    </div>
  </div>

<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
        
            $("#addarticle").validate({
                ignore: [],
            rules:{
                title:{
                required: true,
                minlength:2,
                maxlength:200
                },
               description:{
                         required: function() 
                        {
                         CKEDITOR.instances.description.updateElement();
                        },

                         minlength:2
                    }
                },

                errorPlacement: function(error, element) 
                {
                    if (element.attr("name") == "add_article") 
                   {
                    error.insertBefore("#add_article");
                    } else {
                    error.insertBefore(element);
                    }
                }

            })

        });

</script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
     CKEDITOR.replace('description',{
        removePlugins: ','
     });
</script>

<script type="text/javascript">
window.onload=my_code();
function my_code(){
  var id_ack = $('#article_id').val();
    formData = {articlearticle:id_ack},
    f_action = '<?php echo base_url();?>admin/article/checkArticleId',
    $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        $("#articleModel").modal();
        $('#checkid').attr('value',1);
       }
     }
     });
}


$('body').on('click','#updateRevision', function(){
  var id_ack = $('#article_id').val();
   formData = {articleId:id_ack},
     f_action ='<?php echo base_url();?>admin/article/getRevitionData',
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        $('#title').attr('value',res.article.title);
        $('#checkid').attr('value',2);
        CKEDITOR.instances['description'].setData(res.article.description);
        $('#article_id').attr('value',res.article.postId);
        if(res.article.isDisableComment==1){
         $("#r2").prop("checked", true);
        }else{
         $("#r1").prop("checked", true);
        }
         
       }
     }
     }); 
    });
//

$('body').on('click','#deleterevition', function(){
  var id_ack = $('#article_id').val();
   formData = {articleId:id_ack},
     f_action ='<?php echo base_url();?>admin/article/DeleteRevition',
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


var currentUser = '<?php echo base_url();?>admin/article/edit_article';
var valueexit = $('#checkid').attr('value');


/*window.setInterval(function(){ 
    if($('#checkid').attr('value')==1){
      $("#articleModel").modal();
    } 
  }, 1000);
*/

/*
if(currentUser){
  window.setInterval(function(){   
      push_artical_data();
  }, 3000);
}

//ajax function to get notification list

function push_artical_data(){
    var title_a       = $('#title').val();
    var id_a          = $('#article_id').val();
    var id_status     = $('#articlestatusval').val();
    var selValue      = $('input[name=radio]:checked').val(); 
    var description_a = CKEDITOR.instances.description.getData();
    var id_ackr = $('#checkid').val();
    if(title_a.length > 0 || description_a.length > 0){
     formData = {title:title_a,description:description_a,radio:selValue,articleStatus:0,upd_articlearticle:id_a,isexits:id_ackr},
     f_action = '<?php echo base_url();?>admin/article/editArticle1',
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, 
      success: function(data) {
      var res = JSON.parse(data);
      if(res.status == 1){
        //$("#articalId").val(res.article_id);
       }

      }
     });
    }
  } 
*/

  var autosaveOn = false,
        timeoutId;
    //all elements that needs to be checked need to have autoSaveElement class
    $('.autoSaveElement').each(function(){
        var elem = $(this);
        // Save current value of element
        var oldVal = elem.val();
        //alert(oldVal);
        elem.data('oldVal', elem.val());
        // Look for changes in the value
        elem.bind("propertychange change keyup input paste", function(event){
            newVal = elem.val();
            //alert(newVal);
            //alert('helo');
            newVal.trim().replace(/\s+/g, " "); //remove extra whitespace if any
            // If value is same...
            if(newVal == '' || oldVal == newVal){
                return;
            }
            // Update stored value with new one
            var oldVal = newVal;

            compareData(oldVal, newVal, elem);
        });
    });


var descOldVal = CKEDITOR.instances.description.getData();
CKEDITOR.instances.description.on('change', function(){ 

    var elem =CKEDITOR.instances.description;
    var newVal= elem.getData();
    newVal.trim().replace(/\s+/g, " "); 
     //remove extra whitespace if any
    // If value is same...
    if (newVal == '' || descOldVal == newVal) {
        return;
    }
    //console.log(descOldVal +' === '+newVal);
    // Update stored value with new one
    descOldVal = newVal;
    compareData(descOldVal, newVal, elem);
});


function compareData(oldVal,newVal,elem){
//alert(elem);  
    // If a timer was already started, clear it.
    if (timeoutId) clearTimeout(timeoutId);
        //trigger AJAX after the user stops writing for more than 750 milliseconds
    timeoutId = setTimeout(function () {
     // call auto save ajax here
     autoSaveData(elem);
    }, 750);
}

   //auto save ajax call
    function autoSaveData(elem) {
        console.log(CKEDITOR.instances.description);
        //alert(elem);
        if(autosaveOn){
            return; //return when previous ajax is in process
        }
        autosaveOn = true;
        var moduleType =  $('.autoSaveElement').attr('moduleType'); //get module type from elem
       //alert(moduleType);
        switch(moduleType) {
            case 'article':

            // prepare your data accordingly
            //you the IDs of all element of this module
            /* var title = $('#title');
            var desc = $('#articleDescription');*/

    var title_a       = $('#title').val();
    var id_a          = $('#article_id').val();
    //var id_status     = $('#articlestatusval').val();
    var selValue      = $('input[name=radio]:checked').val(); 
    var description_a = CKEDITOR.instances.description.getData();


    //var id_ackr =     $('#checkid').val();

            //alert(description_a);
           /* var formData = {title:title_a,description:description_a,radio:selValue,articleStatus:0,upd_articlearticle:id_a}, 
*/            
            var formData = {title:title_a,description:description_a,radio:selValue,articleStatus:0,upd_articlearticle:id_a},  

            f_action = '<?php echo base_url();?>admin/article/editArticle1'; 
                break;
            case 'forum':
                // prepare your data accordingly
                break;
            default:
                // prepare your data accordingly
        }

     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      success: function(data) {
        autosaveOn = false; 
        var res = JSON.parse(data);
       if(res.status == 1){
        $("#articalId").val(res.article_id);
        }
        }
        });
    }
</script>

