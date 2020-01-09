
<div class="app-content content" id="IDBYSACHIN">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            <div class="content-header row"></div>
            <div class="row">
                <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="hidden-label-round-controls">Add New Article</h4>
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
                                <div class="card-text"></div>
                                <form class="form" id="addarticle" action="<?php echo base_url()?>admin/article/add_article" method="POST" autocomplete="off">
                                    <div class="form-body">
                                        <div class="row">        
                                            <input type="hidden" name="upd_articlearticle" id="articalId" value="">                       
                                                               
                                            <div class="form-group col-12 mb-2">
                                                <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                                <label class="sr-only" for="complaintinput1">Enter Title</label>
                                                <input type="text" id="title" class="form-control round autoSaveElement" placeholder="Title" name="title" moduleType="article">
                                            <input type="hidden" name="article" id="moduleType" value="1234">
                                            </div>
                                            <div class="form-group col-12 mb-2"> 
                                                <label class="sr-only" for="complaintinput5">Enter Description</label>
                                                <textarea id="description" rows="5" class="form-control round autoSaveElement"  placeholder="Description" name="description" moduleType="article"></textarea>
                                            </div>
                                            <div class="col-12 ">
                                                <label class="mr-1" for="complaintinput6">Allow Comment</label>
                                                <label class="radio-inline">
                                                    <input type="radio" id="yes" name="radio" value="0" checked>YES</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="radio" value="1" id="no" >NO</label>
                                            </div>
                                            
                                    </div>
                                    <div class="form-actions border-0 mt-0 frm-btns">
                                        <a href="<?php echo base_url();?>admin/article" class="btn btn-danger mr-1"><i class="ft-x"></i>Cancel
                                        </a>
                                        <button type="button" class="btn btn-primary" id="add_article"><i class="la la-check-square-o"></i>Add</button>
                                       <!--  <a href="forum.html" type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Save
                                        </a> -->

                                    </div>
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

var currentUser = '<?php echo base_url();?>admin/article/add_article1';
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
   
    descOldVal = newVal;
    compareData(descOldVal, newVal, elem)
});

function compareData(oldVal,newVal,elem){
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

                var title_a     = $('#title').val();
                var id_a        = $('#articalId').val();
                var selValue    = $('input[name=radio]:checked').val(); 
                var description_a = CKEDITOR.instances.description.getData(); 
                //alert(description_a);
                var formData = {title:title_a,description:description_a,radio:selValue,articleStatus:0,upd_articlearticle:id_a},   

                f_action = '<?php echo base_url();?>admin/article/add_article1'; 
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
