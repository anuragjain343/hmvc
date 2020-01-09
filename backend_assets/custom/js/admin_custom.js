 var TrainerListUrl = $('.navbar-brand').attr('href');

    

function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }
   toastr.remove();
toastr.clear();


  jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
  }, "Invalid email address or password");


    function home(){
        window.location.href = base_url+"admin/dashboard" ;
    }

    var proceed_err = 'Please fill all fields properly.';
    /* Validate plugin messages */
    jQuery.extend(jQuery.validator.messages, {
    required: "This field is required.",
    password: "This field is required.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Please enter at least {0} characters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

 jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    }, "Numbers and special characters are not allowed."); 

    jQuery.validator.addMethod("email", function(value, element) {
     return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
    }, 'Please enter valid email address.');



    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
   

    /** start script in application **/
    var logout = function () { 
        bootbox.confirm('Are you sure want to logout?', function (isTrue) {
            var link =  base_url+'admin/logout';
            if (isTrue) {
                $.ajax({
                    url:link,
                    type: 'POST',
                    dataType: "JSON",
                    success: function (data) {
                        console.log(123);
                        window.location.href = base_url+"admin/";
                    }
                });
            }
        });
    }
 
    function readURL(input) {
        var cur = input;
        if (cur.files && cur.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(cur).hide();
                $(cur).next('span:first').hide();
                $(cur).next().next('img').attr('src', e.target.result);
                $(cur).next().next('img').css("display", "block");
                $(cur).next().next().next('span').attr('style', "");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    jQuery('body').on('click', '.remove_img', function () {
        var img = jQuery(this).prev()[0];
        var span = jQuery(this).prev().prev()[0];
        var input = jQuery(this).prev().prev().prev()[0];
        jQuery(img).attr('src', '').css("display", "none");
        jQuery(span).css("display", "block");
        jQuery(input).css("display", "inline-block");
        jQuery(this).css("display", "none");
        jQuery(".image_hide").css("display", "block");
        jQuery("#user_image").val("");
    });

    //common class for onkeypress validatenumber call
    $('body').on('keypress','.number_only',validateNumbers);
    /*To validate number only*/
    function validateNumbers(event) {
      if (event.keyCode == 46){
        return false;
      }
      var key = window.event ? event.keyCode : event.which;
      if (event.keyCode == 9 || event.keyCode == 8 || event.keyCode == 46) {
          return true; //allow only number key and period key
      }
      else if ( (key < 48 || key > 57) && key != 190 ) {
          return false;
      }
      else return true;
    };


   $("#inputImage").change(function() {
   readURL(this);
  });
   
   $(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});

// ADD TRAINER JQUERY VALIDATION  

var biz_login_form = $("#addTrainer");
  
biz_login_form.validate({
    rules: {
       
        email: { 
            required: true,
            email: true
            },
            password:{
                required:true,
                 maxlength:50,
                 minlength:6,
                  noSpace: true,
            },
        details: { 
            required: true,
            maxlength:200,

        },
         TrainerName: { 
            required: true,
            maxlength:30,
            minlength:3,
            lettersonly: true,
        },
        
         userPlan:{ 
            required: true,
        },
        
    },       
});

// ADD TRAINER JS 
$('body').on('click','#add_trainer', function(){
     toastr.remove();
        // event.preventDefault();
            if(biz_login_form.valid()===false){
                toastr.error(proceed_err);
                return false;
            }
            var _that = $(this), 
            form = _that.closest('form'),      
            formData = new FormData(form[0]),
            f_action = form.attr('action');
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                    show_loader(); 
                },
                success: function (data, textStatus, jqXHR) {  
                  hide_loader(); 
                  
                    $("#hash").val(data.hash);
                    if (data.status == 1){ 
                        toastr.success(data.msg);
                          //var surl = '';
                        window.setTimeout(function (){
                             window.location.href = TrainerListUrl+'/trainers';
                        }, 2000);
                    }else if(data.status == -1){
                         toastr.error(data.msg);
                        window.setTimeout(function (){
                        window.location.reload();
                         }, 700); 
                    }
                    else {
                        if((data.msg).length>100){
                            //alert((data.msg).length);
                            toastr.error('Please fill all fields properly');
                            //toastr.error(data.msg);
                        }else{
                        toastr.error(data.msg);
                        }
                         $("#hash").val(data.hash);  
                    } 
                    
                },
            });
         
    });

//END OF FUNCTION 
 var deleteForum = function (id,base_url) {
 var csrf = $('#hashCsrf');
 var csrf_key = csrf.attr('data-keys');
 var csrf_hash = csrf.attr('data-values');
        bootbox.confirm({
            message: "Are you sure you want to delete this forum ?",
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
                    var url = base_url + 'admin/forum/delete_forum';                   
                    $.ajax({
                        method: "GET",
                        url: url,
                        dataType: "json",
                        data:{
                            "csrf_test_name":csrf_hash,
                            id:id
                        },
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

    function deletefn(id,csf){
        toastr.remove();
 
        bootbox.confirm({
            message: "Are you sure you want to delete this trainer? All data(Forum, Videos, Articles etc) related to this trainer will also be deleted forever.",
           buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
            callback: function(result){
            if(result){

                $.ajax({
                url: 'trainers/deleteTrainer',
                        type: 'POST',
                        data:{'userId':id,'csrf_test_name':csf},
                        beforeSend: function () { 
                           show_loader(); 
                        },
                        success: function (response) {  
                          hide_loader(); 
                            var data = JSON.parse(response);  
                             $("#hash").val(data.hash);      
                            if (data.status == 1){ 
                                toastr.success(data.msg);
                                window.setTimeout(function () {
                                     window.location.href = 'trainers';
                                }, 500);
                            }else {
                                toastr.error(data.msg);  
                               
                                // bootbox.hideAll();
                              } 
                        },
                        error:function (){
                            toastr.error('Failed! Please try again');
                        }
                    });
                }
            }
        });
    }// End
        function deletefnUser(id,csf){
        toastr.remove();
 
        bootbox.confirm({
            message: "Are you sure you want to delete this user? All data(Forum, Videos, Articles etc) related to this trainer will also be deleted forever.",
           buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
            callback: function(result){
            if(result){

                $.ajax({
                url: 'deleteInactiveUser',
                        type: 'POST',
                        data:{'userId':id,'csrf_test_name':csf},
                        beforeSend: function () { 
                           show_loader(); 
                        },
                        success: function (response) {  
                          hide_loader(); 
                            var data = JSON.parse(response);  
                             $("#hash").val(data.hash);      
                            if (data.status == 1){ 
                                toastr.success(data.msg);
                                window.setTimeout(function () {
                                     window.location.href = 'inactiveUsers';
                                }, 500);
                            }else {
                                toastr.error(data.msg);  
                               
                                // bootbox.hideAll();
                              } 
                        },
                        error:function (){
                            toastr.error('Failed! Please try again');
                        }
                    });
                }
            }
        });
    }// End

  // ADD TRAINER JQUERY VALIDATION  
var biz_add_forum = $("#add_Fourm");
biz_add_forum.validate({
    rules: {
       
        title: { 
            required: true,
                maxlength:100,
                minlength:2,
            },
            description:{
                required:true,
                minlength:2,
            },
    },       
});

// ADD TRAINER JS 
$('body').on('click','#addfourm', function(){
     toastr.remove();
         //event.preventDefault();
         
            if(biz_add_forum.valid()===false){
                toastr.error(proceed_err);
                return false;
            }
            var _that = $(this), 
            form = _that.closest('form'),      
            formData = new FormData(form[0]),
            f_action = form.attr('action');
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                    show_loader(); 
                },
                success: function (data, textStatus, jqXHR) {  
                  hide_loader(); 
                  
                    $("#hash").val(data.hash);
                    if (data.status == 1){ 
                        toastr.success(data.msg);
                          //var surl = '';
                        window.setTimeout(function (){
                             window.location.href = data.url;
                        }, 2000);
                    }else {
                        toastr.error(data.msg);

                         $("#hash").val(data.hash);  
                    } 
                    
                },
            });
         
    });



var biz_add_article = $("#addarticle");
$('body').on('click','#add_article', function(){
  //event.preventDefault();
  if(biz_add_article.valid()===false){
    toastr.error(proceed_err);
    return false;
    }
     var _that = $(this), 
     form = _that.closest('form'),      
     formData = new FormData(form[0]),
     f_action = form.attr('action');

     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      processData: false,
      contentType: false,
      beforeSend: function () { 
                    show_loader(); 
                },
      success: function(data){
                    hide_loader(); 
               
        
        var res = JSON.parse(data);
        if(res.status==1){

           setTimeout(function(){
                window.location=res.url},
                2000),
              toastr.success(res.msg)
              
               
        }else{
            $('#hash').val(res.hash);
            toastr.error(res.msg);

        }
      }
     });
   
});

var addresp = $("#add_Recepie");
addresp.validate({
    rules: {
       
        title: { 
            required: true,
                maxlength:200,
                minlength:2,
            },
            category_name:{
                required:true,
                
            },
            description:{
                required:true, 
                 minlength:2,  
            },
            recepie_image:{
                required:true, 
            },
    },       
});


 $('#addRecepie').click(function(){
 var fl;
     toastr.remove();
            if(addresp.valid()===false){
                toastr.error(proceed_err);
                return false;
            }

             var _that = $(this), 
            form = _that.closest('form'),      
            formData = new FormData(form[0]),
            f_action = form.attr('action');


    //var actionUrl=$(this).attr('action');
/*
    var formData = new FormData(this);*/
 fl= $('#edit-video').val();
  
    if(fl){
    var video = document.getElementById('showVideo');    
    var canvas = document.createElement('canvas');
    canvas.id = "CursorLayer";
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
      var obj = {key :dataURL};
          //alert(obj["key"][i]);
          var ImageURL = obj["key"];
          var block = ImageURL.split(";");
         // Get the content type of the image
          var contentType = block[0].split(":")[1];// In this case "image/gif"
          // get the real base64 content of the file
          var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

          // Convert it to a blob to upload
          var dataImage =  b64toBlob(realData, contentType);
          //console.log(dataImage);
          formData.append("videoThumb", dataImage);
    } 
          
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      processData: false,
      contentType: false,
     // dataType:'JSON',
      beforeSend: function () { 
                    show_loader(); 
                },
      success: function(data){
                    hide_loader(); 
        var res = JSON.parse(data);
       
        if(res.status==1){
          setTimeout(function(){
          window.location=res.url},
          2000),
         toastr.success(res.msg)      
        }else if(res.status == '-1'){ 

            toastr.error(res.msg);
           /* window.setTimeout(function (){
            window.location.reload();
            }, 700); */
         }else{
          $('#hash').val(res.hash);
          toastr.error(res.msg);
        }
      }
    });
});









$('body').on('click','#editRecepie', function(){
//$('#editRecepie').submit(function(event){
  //event.preventDefault();
  var addresp = $("#editRecepie");
  if(addresp.valid()===false){
    toastr.error(proceed_err);
    return false;
    }

      var _that = $(this), 
      form = _that.closest('form'),      
      formData = new FormData(form[0]),
      f_action = form.attr('action');

    fl2= $('#edit-video').val();
    if(fl2){  
   var video = document.getElementById('showVideo');    
    var canvas = document.createElement('canvas');
    canvas.id = "CursorLayer";
   
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
      var obj = {key :dataURL};
          //alert(obj["key"][i]);
          var ImageURL = obj["key"];
          var block = ImageURL.split(";");
         // Get the content type of the image
          var contentType = block[0].split(":")[1];// In this case "image/gif"
          // get the real base64 content of the file
          var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

          // Convert it to a blob to upload
          var dataImage =  b64toBlob(realData, contentType);
          //console.log(dataImage);
          formData.append("videoThumb",dataImage);
    }      
     $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      processData: false,
      contentType: false,
      beforeSend: function () { 
                    show_loader(); 
                },
      success: function(data){
                    hide_loader(); 
               
        
        var res = JSON.parse(data);
        if(res.status==1){

           setTimeout(function(){
                window.location=res.url},
                2000),
              toastr.success(res.msg)
              
               
        }else if(res.status == -1){ 
            toastr.error(res.msg);
        /*    window.setTimeout(function (){
            window.location.reload();
        }, 700); */
        }else{
            $('#hash').val(res.hash);
            toastr.error(res.msg);
        }
      }
     });
   
});


    var deleteArticle = function (id,base_url){
    var csrf = $('#hashCsrf');
   var csrf_key = csrf.attr('data-keys');
    var csrf_hash = csrf.attr('data-values');
        bootbox.confirm({
            message: "Are you sure you want to delete this article ?",
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
                    var url = base_url + 'admin/article/delete_article';
                    $.ajax({
                        method: "GET",
                        url: url,
                        dataType: "json",
                        data:{
                            "csrf_test_name":csrf_hash,
                            id:id
                        },
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

    var deleteArticleByAdmin = function (id,base_url){
    var csrf = $('#hashCsrf');
   var csrf_key = csrf.attr('data-keys');
    var csrf_hash = csrf.attr('data-values');
        bootbox.confirm({
            message: "Are you sure you want to delete this article ?",
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
                    var url = base_url + 'admin/article/delete_article_by_admin';
                    $.ajax({
                        method: "GET",
                        url: url,
                        dataType: "json",
                        data:{
                            "csrf_test_name":csrf_hash,
                            id:id
                        },
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

  var deleteReject = function (id,base_url) {
    var csrf = $('#hashCsrf');
    var csrf_key = csrf.attr('data-keys');
    var csrf_hash = csrf.attr('data-values');
    //var url = base_url + 'admin/article/deleteReject';
    var url = base_url;
    $.ajax({
        method: "GET",
        url: url,
        dataType: "json",
        data:{
            "csrf_test_name":csrf_hash,
            "id":id,
        },
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

    var recepieDelete = function (id,base_url) {
    var csrf = $('#hashCsrf');
   var csrf_key = csrf.attr('data-keys');
    var csrf_hash = csrf.attr('data-values');
        bootbox.confirm({
            message: "Are you sure you want to delete this recipe ?",
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
                    var url = base_url + 'admin/recepie/delete_recepie';
                    
                    $.ajax({
                        method: "POST",
                        url: url,
                        dataType: "json",
                        data:{
                            "csrf_test_name":csrf_hash,
                            id:id
                        },
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

//var myStr = $(".original").text();
       // var trimStr = $.trim(myStr);
     

    var editArticle = function (id,base_url) {
        $.ajax({
            url: base_url + 'admin/article/edit_article',

            type: 'POST',
            data: {'id': id},
            beforeSend: function () {
                show_loader()
                },
            success: function (data, textStatus, jqXHR) {
                    hide_loader();  
                if (data.status == 1){ 
                    toastr.success(data.message);
                          //var surl = '';
                    window.setTimeout(function (){
                    window.location.href = data.url;
                        }, 2000);
                }else{
                    toastr.error(data.message);
  
                } 
                
             }
        });
    }



var biz_add_video = $("#postVideo");
biz_add_video.validate({
    rules: {
       
        title: { 
            required: true,
                maxlength:100,
                minlength:2,
            },
      levelName: { 
            required: true,
               
            },   

            
    }, 
          
});

var err_unknown = "Something went wrong.";


$('#post_Video').click(function(){
     var _that = $(this); 
     form = _that.closest('form');
     formData = new FormData(form[0]); 
     toastr.remove();
    
    if($('#postVideo').valid()==false) {
      toastr.error('Please fill all fields properly before proceeding.');
        return false;
    }

    var video = document.getElementById('showVideo'); 
  
    if(video.videoWidth==0 || video.videoHeight==0){
         toastr.error('Please fill all fields properly before proceeding.');
        return false;
    }

    var canvas = document.createElement('canvas');
    canvas.id = "CursorLayer";
 
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    //alert(canvas.width);
    //alert(canvas.height);
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
      var obj = {key :dataURL};
          //alert(obj["key"][i]);
          var ImageURL = obj["key"];
          var block = ImageURL.split(";");
         // Get the content type of the image
          var contentType = block[0].split(":")[1];// In this case "image/gif"
          // get the real base64 content of the file
          var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

          // Convert it to a blob to upload
          var dataImage =  b64toBlob(realData, contentType);
          //console.log(dataImage);
          formData.append("videoThumb", dataImage);
             
    var url = $("form").attr('action');

  $(".error").html(''); 
  $.ajax({
    type:"POST",
    url: url,
    cache:false,
    contentType: false,
    processData: false,
    data: formData,
    dataType: "json",
    beforeSend: function() {
            show_loader();                           
    },
   success:function(res){
        hide_loader(); 
       $("#hash").val(res.hash);
        if(res.status == 1){
            var surl = TrainerListUrl+'/video'; 
            //alert(TrainerListUrl);
            toastr.success(res.msg);
            window.setTimeout(function() { window.location = surl; },500);
        }else{
           toastr.error(res.msg);
        }   
    },
    error: function (jqXHR, textStatus, errorThrown){
        toastr.error(err_unknown);
    }
    });
    });

$('#post_training_Video').click(function(){
     var _that = $(this); 
     form = _that.closest('form');
     formData = new FormData(form[0]); 
     toastr.remove();
    
    if($('#postVideo').valid()==false) {
      toastr.error('Please fill all fields properly before proceeding.');
        return false;
    }

    var video = document.getElementById('showVideo');   
      if(video.videoWidth==0 || video.videoHeight==0){
         toastr.error('Please fill all fields properly before proceeding.');
        return false;
    } 
    var canvas = document.createElement('canvas');
    canvas.id = "CursorLayer";
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
      var obj = {key :dataURL};
          //alert(obj["key"][i]);
          var ImageURL = obj["key"];
          var block = ImageURL.split(";");
         // Get the content type of the image
          var contentType = block[0].split(":")[1];// In this case "image/gif"
          // get the real base64 content of the file
          var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

          // Convert it to a blob to upload
          var dataImage =  b64toBlob(realData, contentType);
          //console.log(dataImage);
          formData.append("videoThumb", dataImage);
             
    var url = $("form").attr('action');

  $(".error").html(''); 
  $.ajax({
    type:"POST",
    url: url,
    cache:false,
    contentType: false,
    processData: false,
    data: formData,
    dataType: "json",
    beforeSend: function() {
            show_loader();                           
    },
   success:function(res){
        hide_loader(); 
       $("#hash").val(res.hash);
        if(res.status == 1){
            var surl = TrainerListUrl+'/video/trainingVideo'; 
            //alert(TrainerListUrl);
            toastr.success(res.msg);
            window.setTimeout(function() { window.location = surl; },500);
        }else{
           toastr.error(res.msg);
        }   
    },
    error: function (jqXHR, textStatus, errorThrown){
        toastr.error(err_unknown);
    }
    });
    });

  function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;
        var byteCharacters = atob(b64Data);
        var byteArrays = [];
        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }
            var byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }
        var blob = new Blob(byteArrays, {type: contentType});
        return blob;
    }

    // delele video deleteTrainingVideo 
    function deleteVideo(vId,csrf,ctrl){
        toastr.remove();
 
        bootbox.confirm({
            message: "Are you sure you want to delete this video",
           buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
            callback: function(result){
      if(result){
       var flag = $('#flag').val();
        $.ajax({
            type:"POST",
            url: TrainerListUrl+'/'+ctrl,
            data: {'id':vId,csrf_test_name:csrf,flag:flag},
            dataType: "json",
            beforeSend: function() {
            //show_loader();                           
            },
            success:function(res){

           // hide_loader();  
            $("#hash").val(res.hash);
            if(res.status == 1){
           /* $("#updateVideo").hide();
             $("#edit-img").css('display','none');  
             $('#vdo').addClass('upload-imgs');
             $('#vdo').css('display','');
             $('#deletevideo').hide();*/
             var surl = TrainerListUrl+'/video'; 
            //alert(TrainerListUrl);
             toastr.success(res.message);
            window.setTimeout(function() { window.location = surl; },500);
            }else{
            toastr.error(res.message);
            }   
            }, 
        });
       }
        }
      });
    }

      // delele video deleteTrainingVideo 
    function deleteVideoByTrainer(vId,csrf,ctrl){
        toastr.remove();
 
        bootbox.confirm({
            message: "Are you sure you want to delete this video",
           buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
            callback: function(result){
      if(result){
       //var flag = $('#flag').val();
       newurl ='';
        $.ajax({
            type:"POST",
            url: TrainerListUrl+'/'+ctrl,
            data: {'id':vId,csrf_test_name:csrf},
            dataType: "json",
            beforeSend: function() {
            //show_loader();                           
            },
            success:function(res){
            // hide_loader();  
            $("#hash").val(res.hash);
            if(res.status == 1){
            toastr.success(res.message); 
            if(ctrl=='video/deleteinfoVideoByTrainer'){
                newurl ='/video';
            }else{
                newurl ='/video/trainingVideo';
            }
            var surl = TrainerListUrl+newurl; 
            window.setTimeout(function() { window.location = surl; },500);

            }else{
            toastr.error(res.message);
            }   
          },            
        });
       }
      }
    });
  }

  $(document).ready(function(){
  $('#hideme').click(function(){
    //alert();
    $("#personalLinkgh1").toggle();
  });
});

    // delele video deleteRecepeVideo 
    function deleteRecepeVideo(vId,csrf,ctrl){
      var setVal = $('#flagSet').val();
      var imageFlag = $('#imageFlag').val();
        $.ajax({
            type:"POST",
            url: TrainerListUrl+'/'+ctrl,
            data: {'id':vId,csrf_test_name:csrf,flag:setVal,imageFlag:imageFlag},
            dataType: "json",
            beforeSend: function() {
            //show_loader();                           
            },
            success:function(res){
           // hide_loader(); 
            $("#hash").val(res.hash);
            if(res.status == 1){
            var surl = TrainerListUrl+'/video'; 
            //alert(TrainerListUrl);
            toastr.success(res.message);
           // window.setTimeout(function() { window.location = surl; },500);
            }else{
            toastr.error(res.message);
            }   
            },
            
        });
}

  $(document).ready(function(){
  $('#hideme').click(function(){
    
    $("#personalLinkgh").toggle();
  });
});  

  //answer
var addAnswer = $("#answerByTrainer");
addAnswer.validate({
    rules: {
        answer: { 
            required: true,
            maxlength: 1000,
             minlength:2,
            },
         
    },       
});

// ADD TRAINER JS 
$('body').on('click','#sendArticleAns', function(){
  toastr.remove();
  // event.preventDefault();
  if(addAnswer.valid()===false){
      toastr.error(proceed_err);
      return false;
  }
  var _that = $(this), 
  form = _that.closest('form'),      
  formData = new FormData(form[0]),
  f_action = form.attr('action');
  $.ajax({
      type: "POST",
      url: f_action,
      data: formData, //only input
      processData: false,
      contentType: false,
      dataType: "JSON", 
      beforeSend: function () { 
          show_loader(); 
      },
      success: function (data, textStatus, jqXHR){  
        hide_loader(); 
          $("#hash").val(data.hash);
          if (data.status == 1){ 
             toastr.success(data.msg);
              window.setTimeout(function (){
            window.location.reload();
  }, 1000);
          }
          else {
              toastr.error(data.msg);
               $("#hash").val(data.hash);  
          }  
      },
  });
});



var err_unknown = "Something went wrong.";


$('#update_informationalVideo').click(function(){
  //update video
var biz_update_video = $("#updatevideos");


biz_update_video.validate({
    rules: {
        title: { 
            required: true,
                maxlength:100,
                minlength:2,
            }, 
            levelName: { 
            required: true,
               
            },    
    },       
});

     var _that = $(this); 
     form = _that.closest('form');
    // alert(form);
     formData = new FormData(form[0]); 
     toastr.remove();

     var isfilea =  $('#video_here').attr('src');
      if(isfilea.length == 0){
      toastr.error('Please select video.');
        return false;
     }
     
    if(biz_update_video.valid()==false) {
      toastr.error('Please fill all fields properly before proceeding.');
        return false;
    }

    var video = document.getElementById('updateVideo');  
    //alert(video);  
    var canvas = document.createElement('canvas');
    canvas.id = "CursorLayer";
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
      var obj = {key :dataURL};
          //alert(obj["key"][i]);
          var ImageURL = obj["key"];
          var block = ImageURL.split(";");
         // Get the content type of the image
          var contentType = block[0].split(":")[1];// In this case "image/gif"
          // get the real base64 content of the file
          var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

          // Convert it to a blob to upload
          var dataImage =  b64toBlob(realData, contentType);
          //console.log(dataImage);
          formData.append("videoThumb", dataImage);
             
    var url = $("form").attr('action');
  $(".error").html('');

  $.ajax({
    type:"POST",
    url: url,
    cache:false,
    contentType: false,
    processData: false,
    data: formData,
    dataType: "json",
    beforeSend: function() {
            show_loader();                           
    },
   success:function(res){
        hide_loader(); 
       $("#hash").val(res.hash);
        if(res.status == 1){
            var surl = TrainerListUrl+'/video'; 
            //alert(TrainerListUrl);
            toastr.success(res.msg);
            window.setTimeout(function() { window.location = surl; },500);
        }else{
           toastr.error(res.msg);
        }   
    },
    error: function (jqXHR, textStatus, errorThrown){
        toastr.error(err_unknown);
    }
  });
});


//update video
var biz_update_video = $("#updateTrainingVideos");
biz_update_video.validate({
    rules: {
        title: { 
            required: true,
                maxlength:100,
                minlength:2,
            }, 
            
        levelName:{ 
            required: true,
               
        },    
    },       
});

$('#update_traing_Video').click(function(){

     var _that = $(this); 
     form = _that.closest('form');
     formData = new FormData(form[0]); 
     toastr.remove();
       var isfilea =  $('#video_here').attr('src');
      if(isfilea.length == 0){
      toastr.error('Please select video.');
        return false;
     }
    
    if(biz_update_video.valid()==false) {
      toastr.error('Please fill all fields properly before proceeding.');
        return false;
    }

    var video = document.getElementById('updateVideo');  
    //alert(video);  
    var canvas = document.createElement('canvas');
    canvas.id = "CursorLayer";
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
      var obj = {key :dataURL};
          //alert(obj["key"][i]);
          var ImageURL = obj["key"];
          var block = ImageURL.split(";");
         // Get the content type of the image
          var contentType = block[0].split(":")[1];// In this case "image/gif"
          // get the real base64 content of the file
          var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

          // Convert it to a blob to upload
          var dataImage =  b64toBlob(realData, contentType);
          //console.log(dataImage);
          formData.append("videoThumb", dataImage);
             
    var url = $("form").attr('action');
  $(".error").html('');

  $.ajax({
    type:"POST",
    url: url,
    cache:false,
    contentType: false,
    processData: false,
    data: formData,
    dataType: "json",
    beforeSend: function() {
            show_loader();                           
    },
   success:function(res){
        hide_loader(); 
       $("#hash").val(res.hash);
        if(res.status == 1){
            var surl = TrainerListUrl+'/video/trainingVideo'; 
            //alert(TrainerListUrl);
            toastr.success(res.msg);
            window.setTimeout(function() { window.location = surl; },500);
        }
        else{
           toastr.error(res.msg);
        }   
    },
    error: function (jqXHR, textStatus, errorThrown){
        toastr.error(err_unknown);
    }
  });
});


var biz_update_form = $("#updateTrainer");
  
biz_update_form.validate({
    rules: {

        details: { 
            required: true,
            maxlength:200,

        },
         TrainerName: { 
            required: true,
            maxlength:30,
            minlength:3,
            lettersonly: true,
        },
        userPlan: { 
            required: true,
        },
        
    },       
});

// ADD TRAINER JS 
$('body').on('click','#update_trainer', function(event){
     toastr.remove();
         event.preventDefault();
            if(biz_update_form.valid()===false){
                toastr.error(proceed_err);
                return false;
            }
            var _that = $(this), 
            form = _that.closest('form'),      
            formData = new FormData(form[0]),
            f_action = form.attr('action');
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                   show_loader(); 
                },
                success: function (data, textStatus, jqXHR) {  
                  hide_loader(); 
                  
                   $("#hash").val(data.hash);
                    if (data.status == 1){ 
                       toastr.success(data.msg);
                          //var surl = '';
                        window.setTimeout(function (){
                            window.location.href = TrainerListUrl+'/trainers';
                        }, 2000);
                    }else if(data.status == -1){
                        toastr.error(data.msg);
                        window.setTimeout(function (){
                        window.location.reload();
                        }, 700); 
                    }
                    else {
                        toastr.error(data.msg);

                        $("#hash").val(data.hash);  
                    } 
                    
                },
            });
         
    });
//END OF FUNCTION 

  function answerLike(ctrl,frmid){
    var base_url = $('#baseurl').attr('data-name');
   $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    dataType: "JSON", 
    data: {'id':frmid}, //only input
    success:function(res){
      //var obj = JSON.parse(res);
      if(res.status=='1'){
       $("#pasteLike"+frmid).html(res.html);
      }
      else{
        $("#pasteLike"+frmid).html(res.html);
      }  
    }
  });
 }

  function userStatus(userId){
      var base_url1 = $('.navbar-brand').attr('href');
    //alert(base_url1);
    var base= '<?php echo base_url();?>';
    var base_url = $('#baseurl').attr('data-name');
  
    
   $.ajax({
    type:"GET",
    url: base_url1+'/users/userStatus',
    dataType: "JSON", 
    data: {'userId':userId}, //only input
    success:function(res){
      if(res.status=='1'){
       toastr.success(res.msg);
          window.setTimeout(function (){
             window.location.reload();
          }, 1000);
      }
      else{
        toastr.danger(res.msg);
      }  
    }
  });
 }
 
  function isLikeForum(ctrl,frmid){
    var base_url = $('#baseurl').attr('data-name');
   $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    data: {'id':frmid}, //only input
    success:function(res){
      var obj = JSON.parse(res);
      if(obj.status=='1'){
       $(".mylike").css("color", "#5dbbf2");
       //$("#anslike").addClass("liked");
        $("#likeCount"+frmid).html(obj.html);
      }else{
        $("#likeCount"+frmid).html(obj.html);
       $(".mylike").css("color", ""); 
      }  
    }
  });
 }

 function isLikeAnswer(ctrl,articleid,answerId){
    var base_url = $('#baseurl').attr('data-name');
   $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    data: {'aId':answerId,'artiId':articleid}, //only input
    success:function(res){
      var obj = JSON.parse(res);
      if(obj.status=='1'){
       $(".mylike").css("color", "#5dbbf2");
       //$("#anslike").addClass("liked");
        $("#likeCount"+answerId).html(obj.html);
      }
      else{
        $("#likeCount"+answerId).html(obj.html);
       $(".mylike").css("color", ""); 
      }  
    }
  });
 }

 var editTrainerProfile = $("#editTrainerProfile");
editTrainerProfile.validate({
    rules: {
        name: { 
            required: true,
            maxlength: 50,
             minlength:2,
             lettersonly: true,
            },

        details: { 
            required: true,
            maxlength: 200,
             minlength:2,
            },
         
    },       
});

// ADD TRAINER JS 
$('body').on('click','#editTrainer', function(){
     toastr.remove();
         event.preventDefault();
            if(editTrainerProfile.valid()===false){
                toastr.error(proceed_err);
                return false;
            }
            var _that = $(this), 
            form = _that.closest('form'),      
            formData = new FormData(form[0]),
            f_action = form.attr('action');
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                    show_loader(); 
                },
                success: function (data, textStatus, jqXHR){  
                  hide_loader(); 
                    $("#hash").val(data.hash);
                    if (data.status == 1){ 
                       toastr.success(data.msg);
                         window.setTimeout(function (){
                         window.location.href =data.url;
                    }, 1000);
                    }else if(data.status == -1){ 
                          toastr.error(data.msg);
                        window.setTimeout(function (){
                        window.location.reload();
                         }, 700); 
                    }
                    else {
                        toastr.error(data.msg);
                         $("#hash").val(data.hash);  
                    }  
                },
            });
    });
// ADD TRAINER JS 
$('body').on('click','#contentSubmit', function(){
     toastr.remove();
     var addContent = $("#addContent");
        // event.preventDefault();
            if(addContent.valid()===false){
                toastr.error(proceed_err);
                return false;
            }
            var _that = $(this), 
            form = _that.closest('form'),      
            formData = new FormData(form[0]),
            f_action = form.attr('action');
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                    show_loader(); 
                },
                success: function (data, textStatus, jqXHR) {  
                  hide_loader(); 
                  
                    $("#hash").val(data.hash);
                    if (data.status == 1){ 
                        toastr.success(data.msg);
                          //var surl = '';
                        window.setTimeout(function (){
                             window.location.href = data.url;
                        }, 2000);
                    }else {
                        toastr.error(data.msg);

                         $("#hash").val(data.hash);  
                    } 
                    
                },
            });
    });

  // ADD TRAINER JQUERY VALIDATION  
var biz_add_addNurti = $("#addNurti");
biz_add_addNurti.validate({
    rules: {
       
        title: { 
            required: true,
                maxlength:100,
                minlength:2,
            },
            description:{
                required:true,
                minlength:2,
            },
            slectNurti:{
                required:true,
                
            },
         
    },       
});

// ADD TRAINER JS 
$('body').on('click','#add_Nurti', function(){
    var fl1,fl2,fl3,fl4,fl5;
     toastr.remove();
         //event.preventDefault();
    if(biz_add_addNurti.valid()===false){
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this), 
    form = _that.closest('form'),      
    formData = new FormData(form[0]),

      
     fl1= $('#edit-video1').val();
  
    if(fl1){
   
    video = document.getElementById('showVideo1');  
    var canvas = document.createElement('canvas');
    canvas.id = "CursorLayer";
    
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    var dataURL = canvas.toDataURL();
    var obj = {key :dataURL};
    var ImageURL = obj["key"];
    var block = ImageURL.split(";");
    var contentType = block[0].split(":")[1];
    var realData = block[1].split(",")[1];
    var dataImage =  b64toBlob(realData, contentType);

    formData.append("videoThumb", dataImage);
    }
    /*2*/
    
     fl2= $('#edit-video2').val();
    if(fl2){  
    video1 = document.getElementById('showVideo2');      
    var canvas1 = document.createElement('canvas');
    canvas1.id = "CursorLayer";
    canvas1.width = 640;
    canvas1.height = 360;
    var context1 = canvas1.getContext('2d');
    context1.drawImage(video1, 0, 0, canvas1.width, canvas1.height);
    var dataURL1 = canvas1.toDataURL();
    var obj1 = {key :dataURL1};
    var ImageURL1 = obj1["key"];
    var block1 = ImageURL1.split(";");
    var contentType1 = block1[0].split(":")[1];
    var realData1 = block1[1].split(",")[1];
    var dataImage1 =  b64toBlob(realData1, contentType1);
    formData.append("videoThumb2", dataImage1);
    }
   

    
     fl3= $('#edit-video3').val();
    if(fl3){  
     video2 = document.getElementById('showVideo3');     
    var canvas2 = document.createElement('canvas');
    canvas2.id = "CursorLayer";
    canvas2.width = 640;
    canvas2.height = 360;
    var context2 = canvas2.getContext('2d');
    context2.drawImage(video2, 0, 0, canvas2.width, canvas2.height);
    var dataURL2 = canvas2.toDataURL();
    var obj2 = {key :dataURL2};
    var ImageURL2 = obj2["key"];
    var block2 = ImageURL2.split(";");
    var contentType2 = block2[0].split(":")[1];
    var realData2 = block2[1].split(",")[1];
    var dataImage2 =  b64toBlob(realData2, contentType2);
    formData.append("videoThumb3", dataImage2);
    }
   
     fl4= $('#edit-video4').val();
    if(fl4){
    video3 = document.getElementById('showVideo4');    
    var canvas3 = document.createElement('canvas');
    canvas3.id = "CursorLayer";
    canvas3.width = 640;
    canvas3.height = 360;
    var context3 = canvas3.getContext('2d');
    context3.drawImage(video3, 0, 0, canvas3.width, canvas3.height);
    var dataURL3 = canvas3.toDataURL();
    var obj3 = {key :dataURL3};
    var ImageURL3 = obj3["key"];
    var block3 = ImageURL3.split(";");
    var contentType3 = block3[0].split(":")[1];
    var realData3 = block3[1].split(",")[1];
    var dataImage3 =  b64toBlob(realData3, contentType3);
    formData.append("videoThumb4", dataImage3);
    }

    fl5= $('#edit-video5').val();
    if(fl5){
    video4 = document.getElementById('showVideo5');    
    var canvas4 = document.createElement('canvas');
    canvas4.id = "CursorLayer";
    canvas4.width = 640;
    canvas4.height = 360;
    var context4 = canvas4.getContext('2d');
    context4.drawImage(video4, 0, 0, canvas4.width, canvas4.height);
    var dataURL4 = canvas4.toDataURL();
    var obj4 = {key :dataURL4};
    var ImageURL4 = obj4["key"];
    var block4 = ImageURL4.split(";");
    var contentType4 = block4[0].split(":")[1];
    var realData4 = block4[1].split(",")[1];
    var dataImage4 =  b64toBlob(realData4, contentType4);
    formData.append("videoThumb5", dataImage4);
    }


            f_action = form.attr('action');
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                    show_loader(); 
                },
                success: function (data, textStatus, jqXHR) {  
                  hide_loader(); 
                  
                    $("#hash").val(data.hash);
                    if (data.status == 1){ 
                        toastr.success(data.msg);
                          //var surl = '';
                        window.setTimeout(function (){
                            window.location.href = data.url;
                        }, 2000);
                    }else if(data.status == -1){ 
                          toastr.error(data.msg);
                       /* window.setTimeout(function (){
                        window.location.reload();
                         }, 700);*/ 
                    }
                    else {
                         
                        toastr.error(data.msg);

                         $("#hash").val(data.hash);  
                    } 
                    
                },
            });
         
    });
 /*add excr*/
// ADD TRAINER JS 
$('body').on('click','#addExercise', function(){
    var fl1,fl2,fl3,fl4,fl5;
     toastr.remove();
     var addExercises = $("#add_exercise");
        // event.preventDefault();
            if(addExercises.valid()===false){
                toastr.error(proceed_err);
                return false;
            }
            var _that = $(this), 
            form = _that.closest('form'),      
            formData = new FormData(form[0]),
            f_action = form.attr('action');
    fl1= $('#edit-video1').val();
  
    if(fl1){
            var video = document.getElementById('showVideo1'); 
            var canvas = document.createElement('canvas');
            canvas.id = "CursorLayer";
           
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            var dataURL = canvas.toDataURL();
            //console.log(dataURL);
              var obj = {key :dataURL};
                  //alert(obj["key"][i]);
                  var ImageURL = obj["key"];
                  var block = ImageURL.split(";");
                 // Get the content type of the image
                  var contentType = block[0].split(":")[1];// In this case "image/gif"
                  // get the real base64 content of the file
                  var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

                  // Convert it to a blob to upload
                  var dataImage =  b64toBlob(realData, contentType);
                  //console.log(dataImage);
                  formData.append("videoThumb1", dataImage);

}
                  //--------------------------
    fl2= $('#edit-video2').val();
  
    if(fl2){
            var video = document.getElementById('showVideo2'); 
            var canvas = document.createElement('canvas');
            canvas.id = "CursorLayer";
           
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            var dataURL = canvas.toDataURL();
            //console.log(dataURL);
              var obj = {key :dataURL};
                  //alert(obj["key"][i]);
                  var ImageURL = obj["key"];
                  var block = ImageURL.split(";");
                 // Get the content type of the image
                  var contentType = block[0].split(":")[1];// In this case "image/gif"
                  // get the real base64 content of the file
                  var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

                  // Convert it to a blob to upload
                  var dataImage =  b64toBlob(realData, contentType);
                  //console.log(dataImage);
                  formData.append("videoThumb2", dataImage);
}
                  //--------------------------------------------------------------
 fl3= $('#edit-video3').val();
  
    if(fl3){
            var video = document.getElementById('showVideo3'); 
            var canvas = document.createElement('canvas');
            canvas.id = "CursorLayer";
                    
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            var dataURL = canvas.toDataURL();
            //console.log(dataURL);
              var obj = {key :dataURL};
                  //alert(obj["key"][i]);
                  var ImageURL = obj["key"];
                  var block = ImageURL.split(";");
                 // Get the content type of the image
                  var contentType = block[0].split(":")[1];// In this case "image/gif"
                  // get the real base64 content of the file
                  var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

                  // Convert it to a blob to upload
                  var dataImage =  b64toBlob(realData, contentType);
                  //console.log(dataImage);
                  formData.append("videoThumb3", dataImage);
}
                  //-------------------------------------------------------
 fl4= $('#edit-video4').val();
  
    if(fl4){
            var video = document.getElementById('showVideo4'); 
            var canvas = document.createElement('canvas');
            canvas.id = "CursorLayer";
         
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            var dataURL = canvas.toDataURL();
            //console.log(dataURL);
              var obj = {key :dataURL};
                  //alert(obj["key"][i]);
                  var ImageURL = obj["key"];
                  var block = ImageURL.split(";");
                 // Get the content type of the image
                  var contentType = block[0].split(":")[1];// In this case "image/gif"
                  // get the real base64 content of the file
                  var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

                  // Convert it to a blob to upload
                  var dataImage =  b64toBlob(realData, contentType);
                  //console.log(dataImage);
                  formData.append("videoThumb4", dataImage);

                  //----------------------------------------------------------
}
 fl5= $('#edit-video5').val();
  
    if(fl5){
            var video = document.getElementById('showVideo5'); 
            var canvas = document.createElement('canvas');
            canvas.id = "CursorLayer";
          
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            var dataURL = canvas.toDataURL();
            //console.log(dataURL);
              var obj = {key :dataURL};
                  //alert(obj["key"][i]);
                  var ImageURL = obj["key"];
                  var block = ImageURL.split(";");
                 // Get the content type of the image
                  var contentType = block[0].split(":")[1];// In this case "image/gif"
                  // get the real base64 content of the file
                  var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

                  // Convert it to a blob to upload
                  var dataImage =  b64toBlob(realData, contentType);
                  //console.log(dataImage);
                  formData.append("videoThumb5", dataImage);
}
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                    show_loader(); 
                },
                success: function (data, textStatus, jqXHR) {  
                  hide_loader(); 
                  
                    $("#hash").val(data.hash);
                    if (data.status == 1){ 
                        toastr.success(data.msg);
                          //var surl = '';
                        window.setTimeout(function (){
                             window.location.href = data.url;
                        }, 2000);
                    }else if(data.status == -1){ 
                          toastr.error(data.msg);
                      /*  window.setTimeout(function (){
                        window.location.reload();
                         }, 700);*/ 
                    }
                    else {
                        toastr.error(data.msg);

                         $("#hash").val(data.hash);  
                    } 
                    
                },
            });
         
    });

     var deleteNutritionGuidance = function (id,baseurl,base_url) {
    //alert(base_url);
    var csrf = $('#hashCsrf');
   var csrf_key = csrf.attr('data-keys');
    var csrf_hash = csrf.attr('data-values');
        bootbox.confirm({
            message: "Are you sure you want to delete this nutrition guidance ?",
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
                    var url = base_url+'admin/nutritionGuidance/delete_nutritionGuidance';
                    
                    $.ajax({
                        method: "GET",
                        url: url,
                        dataType: "json",
                        data:{
                            "csrf_test_name":csrf_hash,
                            id:id
                        },
                        beforeSend: function () { 
                            show_loader(); 
                        },
                        success: function (data){
                            hide_loader();
                        if (data.status == 1){ 
                            toastr.success(data.message);
                            window.setTimeout(function (){
                             window.location.href = baseurl;
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
  /*code by sunil*/

    //common class for onkeypress validatenumber call
    $('body').on('keypress','.decimal_only',validateDecNumbers);
    /*To validate decimal and number only*/
    function validateDecNumbers(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode == 8) {
            return true;
          } else if (charCode == 46 && $(this).val().indexOf('.') != -1) {
            return false;
          } else if (charCode > 31 && charCode != 46 && (charCode < 48 || charCode > 57 )) {
            return false;
          }
          return true;
    }


var addPlanVal = $("#addPlan");
 addPlanVal.validate({
    rules: {
        title: { 
            required: true,
            maxlength: 50,
            minlength:2,
             
            },
        amount:{
          required: true,
          max:1000,
        },    
        planType: { 
            required: true,
        },
        planLevel: { 
            required: true,
        }
    },       
});


$('body').on('click','#add_plan', function(){
     toastr.remove();
        if(addPlanVal.valid()===false){
                toastr.error(proceed_err);
                return false;
        }
        var vContent = CKEDITOR.instances['planDescription'].getData();
        if(vContent ==''){
           toastr.error(proceed_err);
           return false;
        }
        var _that = $(this), 
        form = _that.closest('form'),      
        formData = new FormData(form[0]),
        f_action = form.attr('action');
        formData.append("planDescription",vContent);
       // console.log(formData);
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                    show_loader(); 
                },
                success: function (data, textStatus, jqXHR){  
                  hide_loader(); 
                   console.log(data);
                    //$("#hash").val(data.hash);
                    if (data.status == 1){ 
                       toastr.success(data.msg);
                         window.setTimeout(function (){
                         window.location.href =data.url;
                        }, 1000);
                    }
                    else {
                        toastr.error(data.msg);
                        // $("#hash").val(data.hash);  
                    }  
                },
            });
    });

    function deleteData(id,csf,typ,planLevel,createdBy,createdId){
        if(typ =='activePlan'){
            msg = 'Are you sure you want to active this plan?.';
            planStatus =1; 

        }
        if(typ =='inactivePlan'){
            msg = 'Are you sure you want to inactive this plan?.';
            planStatus =0; 
        }
        toastr.remove();
 
        bootbox.confirm({
            message: msg,
           buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
            callback: function(result){
            if(result){

                $.ajax({
                url: 'membership/deletePlan',
                        type: 'POST',
                        data:{'planId':id,'status':planStatus,'csrf_test_name':csf,'planLevel':planLevel,'createdBy':createdBy,'createdById':createdId},
                        beforeSend: function () { 
                           show_loader(); 
                        },
                        success: function (response) {  
                          hide_loader(); 
                            var data = JSON.parse(response);  
                             $("#hash").val(data.hash);      
                            if (data.status == 1){ 
                                toastr.success(data.msg);
                                window.setTimeout(function () {
                                     window.location.href = 'membership';
                                }, 500);
                            }else {
                                toastr.error(data.msg);  
                               
                                // bootbox.hideAll();
                              } 
                        },
                        error:function (){
                            toastr.error('Failed! Please try again');
                        }
                    });
                }
            }
        });
    }// End


var editPlanVal = $("#editPlan");
editPlanVal.validate({
    rules: {
        title: { 
            required: true,
            maxlength: 50,
            minlength:2,
             
            },
        amount:{
          required: true,
          max:1000,
        },     
    },       
});

$('body').on('click','#update_plan', function(){
   
   
    toastr.remove();
    if(editPlanVal.valid()===false){
            toastr.error(proceed_err);
            return false;
    }
    var vContent = CKEDITOR.instances['planDescription'].getData();
    if(vContent ==''){
        toastr.error(proceed_err);
        return false;
     }
    var _that = $(this), 
    form = _that.closest('form'),      
    formData = new FormData(form[0]),
    f_action = form.attr('action');
  
    formData.append("planDescription",vContent);
    // console.log(formData);
    $.ajax({
        type: "POST",
        url: f_action,
        data: formData, //only input
        processData: false,
        contentType: false,
        dataType: "JSON", 
        beforeSend: function () { 
            show_loader(); 
        },
        success: function (data, textStatus, jqXHR){  
          hide_loader(); 
           console.log(data);
            //$("#hash").val(data.hash);
            if (data.status == 1){ 
               toastr.success(data.msg);
                 window.setTimeout(function (){
                 window.location.href =data.url;
                }, 1000);
            }
            else {
                toastr.error(data.msg);
                // $("#hash").val(data.hash);  
            }  
        },
    });
});


/* code start for coupon*/

var addCoupanVal = $("#addCoupon");
 addCoupanVal.validate({
    rules: {
        couponName: { 
            required: true,
            maxlength: 50,
            minlength:2,
             
            },
        percentage:{
          required: true,
          max:99,
        },    
       /* duration: { 
            required: true,
            },*/
     
         
    },       
});


$('body').on('click','#add_coupon', function(){
     toastr.remove();
        if(addCoupanVal.valid()===false){
                toastr.error(proceed_err);
                return false;
        }
/*        var vContent = CKEDITOR.instances['couponDescription'].getData();
        if(vContent ==''){
           toastr.error(proceed_err);
           return false;
        }*/
        var _that = $(this), 
        form = _that.closest('form'),      
        formData = new FormData(form[0]),
        f_action = form.attr('action');
       // formData.append("couponDescription",vContent);
       // console.log(formData);
            $.ajax({
                type: "POST",
                url: f_action,
                data: formData, //only input
                processData: false,
                contentType: false,
                dataType: "JSON", 
                beforeSend: function () { 
                    show_loader(); 
                },
                success: function (data, textStatus, jqXHR){  
                  hide_loader(); 
                   console.log(data);
                    //$("#hash").val(data.hash);
                    if (data.status == 1){ 
                       toastr.success(data.msg);
                         window.setTimeout(function (){
                         window.location.href =data.url;
                        }, 1000);
                    }
                    else {
                        toastr.error(data.msg);
                        // $("#hash").val(data.hash);  
                    }  
                },
            });
    });


var editCouponVal = $("#editCoupon");
editCouponVal.validate({
    rules: {
        couponName: { 
            required: true,
            maxlength: 50,
            minlength:2,
             
            },
           
    },       
});

$('body').on('click','#update_coupon', function(){
    toastr.remove();
    if(editCouponVal.valid()===false){
            toastr.error(proceed_err);
            return false;
    }
   
    var _that = $(this), 
    form = _that.closest('form'),      
    formData = new FormData(form[0]),
    f_action = form.attr('action');
    // console.log(formData);
    $.ajax({
        type: "POST",
        url: f_action,
        data: formData, //only input
        processData: false,
        contentType: false,
        dataType: "JSON", 
        beforeSend: function () { 
            show_loader(); 
        },
        success: function (data, textStatus, jqXHR){  
          hide_loader(); 
          
            //$("#hash").val(data.hash);
            if (data.status == 1){ 
               toastr.success(data.msg);
                 window.setTimeout(function (){
                 window.location.href =data.url;
                }, 1000);
            }
            else {
                toastr.error(data.msg);
                // $("#hash").val(data.hash);  
            }  
        },
    });
});

/*end code by sunil*/

jQuery(function() { //validation for alphabets and spaces
  jQuery.validator.addMethod("alpha_dash", function(value, element) {
    return this.optional(element) || /^[a-z ]+$/i.test(value); 
  }, "Alphabets, spaces, & dashes only."); 
});

//validation edit admin profile
  $("#editAdminProfile").validate({
    rules: {
      name : {       
        required: true,
        minlength: 2,
        maxlength: 20,
        alpha_dash: true,
      }
    },
    messages:{
      name:{
        required: "Please enter name",
        minlength: "Minimum length should be 2",
        maxlength: "Maximum length should be 20" ,
        alpha_dash: "Numbers and special characters are not allowed.",                  
      }
    }
  });


//edit admin profile
$('body').on('click','#updateAdminProfile', function(){
    toastr.remove();
    if ($("#editAdminProfile").valid() === true){
        var _that = $(this), 
        form = _that.closest('form'),      
        formData = new FormData(form[0]),
        f_action = form.attr('action');

        $.ajax({
            type: "POST",
            url: f_action,
            data: formData, //only input
            processData: false,
            contentType: false,
            dataType: "JSON", 
            beforeSend: function () { 
                show_loader(); 
            },
            success: function (data, textStatus, jqXHR){  

                hide_loader(); 
                if(data.status==-1){
                    toastr.error(data.msg);
                    window.setTimeout(function () {
                        window.location.href = data.url;
                    }, 1000); 
                } 
                if (data.status == 1){ 
                    toastr.success(data.message);
                     window.setTimeout(function (){
                     window.location.href =data.url;
                    }, 1000);
                }else if(data.status == 0){
                    toastr.error(data.message);
                    window.setTimeout(function (){
                        window.location.reload();
                    }, 700);
                }
                else {
                    toastr.error(data.message); 
                    window.setTimeout(function (){
                        window.location.reload();
                    }, 700); 
                }  
            },
        });
    }else{
      toastr.error(proceed_err); //error
    } 
});
            
/*end edit admin profile*/

jQuery.validator.addMethod("Space", function(value, element) { 
  return jQuery.trim(value).length > 0 ;
}, "Space are not allowed"); //only space not allowed validation

//validation change password
  $("#changePasswordForm").validate({
    rules: {
      oldPassword : {       
        required: true
        },
      newPassword : {
        required: true,
        minlength: 4,
        maxlength: 32,
        Space:true,
      },
      cNewPassword : {
        required: true,
        equalTo: "#password"
      },
    },
    messages:{
      oldPassword:{
        required: "Please enter current password"                   
      },
      newPassword:{
        required: "Please enter new password",
        minlength: "Minimum length should be 4",
        maxlength: "Maximum length should be 32",
        Space:"Only space not allowed",
      },
      cNewPassword : {
        required: "Please enter confirm password",
        equalTo:  " Enter Confirm Password Same as new password"
      },
    }
  });
// change password js start
$('body').on("click",".updatePassword",function(){
    console.log('hello');
    toastr.remove();
    if ($("#changePasswordForm").valid() === true){
      var _that = $(this), 
      form = _that.closest('form'), 
      formData = new FormData(form[0]),
      f_action = form.attr('action');  
      $.ajax({
          type: "POST",
          url: f_action,
          data: formData, //only input
          processData: false,
          contentType: false,
          dataType: "JSON",
          beforeSend: function () { 
            show_loader(); 
          }, 
          success: function (data) {  
            if(data.status==-1){
                toastr.error(data.msg);
                window.setTimeout(function () {
                      window.location.href = data.url;
                }, 1000); 
            }
            else if (data.status == 1){ 
              toastr.success(data.message);
              window.setTimeout(function () {
                window.location.reload(true);
              }, 1000);
            }else if (data.status == 0){
              toastr.error(data.message);
            }
          }, 
          error: function(){
            toastr.error(err_unknown); //error
          },
          complete: function () {
            hide_loader(); 
          }
      });  
    }else{
      toastr.error(proceed_err); //error
    }     
});//END change password js


