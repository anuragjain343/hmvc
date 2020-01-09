  var base_url = $('.navbar-brand').attr('href');


function show_loader(){
 $('.preloader').show();
 }

 function hide_loader(){
 $('.preloader').hide();
 }

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
    equalTo: "Please enter the same password again.",
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



/*    toastr.options = {
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
    }*/
   

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

var user_register = $("#add_user");

user_register.validate({
    rules: {
       
        email: { 
            required: true,
            email: true,
            maxlength: 40,
            },
            password:{
                required:true,
                 maxlength:50,
                 minlength:6,
            },
             cpassword:{
                required:true,
                 maxlength:50,
                 minlength:6,
                 equalTo: "#pass",
            },
        name: { 
            required: true,
            maxlength:30,
            minlength:3,
            lettersonly: true,
        },    
    },       
});

// ADD TRAINER JS 
$('body').on('click','#addUser', function(){
     toastr.remove();
         event.preventDefault();
            if(user_register.valid()===false){
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
                    if (data.status == 2){ 
                       toastr.success(data.msg);
                          var surl = 'trainer';
                        window.setTimeout(function (){
                             window.location.href = base_url+'home/users/payment';
                            //window.location.reload();
                        }, 1000);
                    }else if(data.status == 1){ 
                       toastr.success(data.msg);
                         if(data.newurl){
                            window.setTimeout(function (){
                          window.location.replace(data.newurl);
                          }, 1000);

                         }else{ 
                        window.setTimeout(function (){
                           window.location.href = base_url+'home';
                        }, 1000);
                      }
                    }
                    else {
                        toastr.error(data.msg);
                         $("#hash").val(data.hash);  
                    } 
                    
                },
            });
         
    });
//END OF FUNCTION 


var biz_login_form = $("#loginUser");
biz_login_form.validate({
  rules:{
    email:{ 
      required: true,
      email: true
    },
    password:{
      required:true,
      maxlength:50,
      minlength:6,
    },
  },       
});

$('body').on('click','#login_user', function(){
  //$("#login_user").submit(function(e){
  toastr.remove();
  event.preventDefault();
  if(biz_login_form.valid()===false){
    toastr.error(proceed_err);
    return false;
  }
  var _that = $(this), 
  form = _that.closest('form'),      
  formData = new FormData(form[0]),
  f_action = form.attr('action');
  $.ajax({
    type:"POST",
    url:f_action,
    data: formData, //only input
    processData: false,
    contentType: false,
  //  dataType: "JSON", 
    beforeSend: function () { 
      show_loader(); 
    },
    success:function(res){
      hide_loader(); 
      var obj = JSON.parse(res);
      if(obj){
        $("#hash1").val(obj.messages.hash1);
      }
      if(obj.messages.success){
         toastr.success(obj.messages.success);

        if(obj.messages.redirecturl){
           window.setTimeout(function (){
            //window.location.href = obj.messages.redirecturl;
            window.location.replace(obj.messages.redirecturl);
           }, 1000);
        }else{
        window.setTimeout(function (){
         window.location.reload();
           }, 1000);
      }
          //window.setTimeout(function() { window.location = base_url; }, 500);
      } 
      if(obj.messages.unsuccess){
      // $('#unsuccess').html(obj.messages.unsuccess);
      $('#unsuccess').html('<div class="alert" style="background-color:#ffcccc; color:#4d0000;" >'+obj.messages.unsuccess+'</div>');
        window.setTimeout(function() { $('#unsuccess').html("")  }, 2000);
      }
    }
  });
});

// payment 
var payment = $("#payment_form");
payment.validate({
    rules: {
        cardNo: { 
            required: true,
            maxlength: 12,
            },
            expdate:{
                 maxlength:8,
                 minlength:6,
            },
             cvv:{
                required:true,
                 maxlength:8,
                 minlength:6,
                 equalTo: "#pass",
            },
        couponCde: { 
            required: true,
            maxlength:30,
            minlength:3,
        },    
    },       
});

// ADD TRAINER JS 
$('body').on('click','#make_payment', function(){
     toastr.remove();
         event.preventDefault();
            if(payment.valid()===false){
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
                    $("#hash2").val(data.hash);
                    if (data.status == 1){ 
                       toastr.success(data.msg);
                        
                        window.setTimeout(function (){
                             window.location.href = base_url;
                        }, 2000);
                    }else if(data.status == 2){
                      toastr.error(data.msg);
                      $("#hash2").val(data.hash);
                       
                        window.setTimeout(function (){
                             window.location.href = base_url;
                        }, 2000);

                    }
                    else {
                        toastr.error(data.msg);
                         $("#hash2").val(data.hash);  
                    } 
                    
                },
            });
         
    });
//END OF FUNCTION 

var biz_forgotPass = $("#forgotPass");
biz_forgotPass.validate({
  rules:{
    email:{ 
      required: true,
      email: true
    },
  },       
});

$('body').on('click','#forgot_Pass', function(){
  //$("#login_user").submit(function(e){
  toastr.remove();
  event.preventDefault();
  if(biz_forgotPass.valid()===false){
    toastr.error(proceed_err);
    return false;
  }
  var _that = $(this), 
  form = _that.closest('form'),      
  formData = new FormData(form[0]),
  f_action = form.attr('action');
  $.ajax({
    type:"POST",
    url:f_action,
    data: formData, //only input
    processData: false,
    contentType: false,
   // dataType: "JSON", 
    beforeSend: function () { 
      show_loader(); 
    },
    success:function(res){
      hide_loader(); 
      var obj = JSON.parse(res);
      if(obj.status==0){
        $("#hash4").val(obj.hash);
         $('#unsuccess3').html('<div class="alert" style="background-color:#ffcccc; color:#4d0000;" >'+obj.msg+'</div>');
         window.setTimeout(function() { $('#unsuccess3').html("")  }, 2000);
      }
      if(obj.status==1){
        toastr.success(obj.msg);
        window.setTimeout(function (){
        window.location.href =  base_url+'home';
      }, 1000);
      } 
    }
  });
});
function isLogin(dt,url){

    $.ajax({
    type:"GET",
    url:base_url+'home/isUserLoginAndCheckMemberShip',
    data: {'id':1}, //only input
    processData: false,
    contentType: false,
    //dataType: "JSON", 
    beforeSend: function (){ 
      show_loader(); 
    },
    success:function(res){
      hide_loader(); 
      var obj = JSON.parse(res);
      var dataModel= dt;
      if(obj.status=='0'){
        $('#loginModal').modal('show'); 
      }else if(obj.status=='2'){
         $('#memberShipModal').modal('show');
      }
      else{
        if(dataModel==''){
           window.location.href = base_url+url;
        }else{
         $('#'+dataModel).modal('show');
        }
      } 
      
    }
  });
}

 function isRegister(dt,url){
    $.ajax({
    type:"GET",
    url:base_url+'home/isUserLoginAndCheckMemberShip',
    data: {'id':1}, //only input
    processData: false,
    contentType: false,
    //dataType: "JSON", 
    beforeSend: function () { 
      show_loader(); 
    },
    success:function(res){
      hide_loader(); 
      var obj = JSON.parse(res);
      var dataModel= dt;
      if(obj.status=='0'){
        $('#rigsterModal').modal('show'); 
        $('#nurl').attr('value',dt);
      }else if(obj.status=='2'){
         window.location.replace(dt);
      }else if(obj.status=='1'){
         window.location.replace(dt);
      }
      else{
        if(dataModel==''){
           window.location.href = base_url+url;
        }else{
         $('#'+dataModel).modal('show');
        }
      } 
      
    }
  });
}
 function isRegisterLogin(dt,url){
    $.ajax({
    type:"GET",
    url:base_url+'home/isUserLoginAndCheckMemberShip',
    data: {'id':1}, //only input
    processData: false,
    contentType: false,
    //dataType: "JSON", 
    beforeSend: function () { 
      show_loader(); 
    },
    success:function(res){
      hide_loader(); 
      var obj = JSON.parse(res);
      var dataModel= dt;
      if(obj.status=='0'){
        $('#loginModal').modal('show'); 
        $("#text3").val(url);
      }
      else{
        window.location.href = url;  
      }   
    }
  });
}

 // payment 
var addForum = $("#add_forum");
addForum.validate({
    rules: {
        title: { 
            required: true,
            maxlength: 100,
             minlength:5,
            },
        description: { 
            required: true,
            minlength:5,
        },    
    },       
});

// ADD TRAINER JS 
$('body').on('click','#addForum', function(){
     toastr.remove();
         event.preventDefault();
            if(addForum.valid()===false){
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

                    $("#hashid").val(data.hash);
                    if (data.status == 1){ 
                       toastr.success(data.msg);
                        
                        window.setTimeout(function (){
                             window.location.href = base_url+'home/forum';
                        }, 2000);
                    }else if(data.status == 2){
                      toastr.error(data.msg);
                      $("#hashid").val(data.hash);
                       
                        window.setTimeout(function (){
                             window.location.href = base_url;
                        }, 2000);

                    }
                    else {
                        toastr.error(data.msg);
                         $("#hashid").val(data.hash);  
                    } 
                    
                },
            });
         
    });

// search forum
$('body').on('click','#searchByTitle', function(){
    $.ajax({
    type:"GET",
    url:base_url+'home/isUserLoginAndCheckMemberShip',
    data: {'id':1}, //only input
    processData: false,
    contentType: false,
    //dataType: "JSON", 
    beforeSend: function (){ 
      show_loader(); 
    },
    success:function(res){
      hide_loader(); 
      var obj = JSON.parse(res);
      var dataModel= 'questionModal';
      if(obj.status=='0'){
        $('#loginModal').modal('show'); 
        window.stop();
      }else if(obj.status=='2'){
         $('#memberShipModal').modal('show');
          window.stop();
      }
      else{
        if(dataModel==''){
           window.location.href = base_url+url;
        }else{
         
        }
      } 
      
    }

  })
     toastr.remove();
         event.preventDefault();
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
              dataType: "HTML", 
               beforeSend: function (){ 
                    show_loader(); 
                },

             success: function (data, textStatus, jqXHR){  
               hide_loader();
            var allData=jQuery.parseJSON(data);
             //alert(allData.data);
           // alert(hash);
            $("#hash").attr('data-value',allData.hash);0
            $("#hash1").attr('value',allData.hash);
            $("#hashid").attr('value',allData.hash);
            $("#hashsearch").attr('value',allData.hash);
            $("#rList").html(allData.data);
        }
      }); 
    });

  function isLike(ctrl,frmid){
   $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    data: {'id':frmid}, //only input
    success:function(res){
      var obj = JSON.parse(res);
      var articleLike= obj.likeCount;
      if(obj.status=='1'){
       $(".mylike").css("color", "#5dbbf2");
         var totlik = $('#totallike').attr('data-value');
         //alert(totlik);
         articleLike = parseInt(totlik)+1;
         $('#totallike').attr('data-value',articleLike);
         $("#totallike").html(articleLike);
      }
      else{
       $(".mylike").css("color", ""); 
         var totlik = $('#totallike').attr('data-value');
          //alert(totlik);
          articleLike =parseInt(totlik)-1;
           $('#totallike').attr('data-value',articleLike);
          $("#totallike").html(articleLike);   
      }  
    }
  });
 }
  function isAnswerLike(url,articleId,answerId){
    $.ajax({
    type:"GET",
    url:base_url+'/'+url+'?articleId='+articleId+'&answerId='+answerId,
    //data: {'id':frmid}, //only input
    success:function(res){
      var obj = JSON.parse(res);
      var articleLike= obj.likeCount;
      if(obj.status=='1'){
       $(".mylike"+answerId).css("color", "#5dbbf2");
        $('#lik'+answerId).html(obj.likeCount);
      }
      else{
       $(".mylike"+answerId).css("color", ""); 
       $('#lik'+answerId).html(obj.likeCount);

      }  
    }
  });
  }
   function isLikeForum(ctrl,frmid){
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
      }
      else{
        $("#likeCount"+frmid).html(obj.html);
       $(".mylike").css("color", ""); 
      }  
    }
  });
 }

 function answerLike(ctrl,frmid,fmId){
   $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    data: {'id':frmid,'fmId':fmId}, //only input
    success:function(res){
      var obj = JSON.parse(res);
      if(obj.status=='1'){
       $("#mylike"+frmid).addClass("liked");
       $("#pasteLike"+frmid).html(obj.html);
      }
      else{
        $("#mylike"+frmid).removeClass("liked");
        $("#pasteLike"+frmid).html(obj.html);
      }  
    }
  });
 }

 function isView(ctrl,vid){

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
//END OF FUNCTION   

$('body').on('click','#articleSearch', function(){
 event.preventDefault();
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
          dataType: "HTML", 
         beforeSend: function (){ 
              show_loader(); 
          },
       success: function (data, textStatus, jqXHR){  
         hide_loader();
      var allData=jQuery.parseJSON(data);
      $("#hash").attr('data-value',allData.hash);
      $("#artiList").html(allData.data);
  }
}); 
});


$('body').on('click','#articleTitleSrearch', function(){
 event.preventDefault();
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
          dataType: "HTML", 
         beforeSend: function (){ 
              show_loader(); 
          },
       success: function (data, textStatus, jqXHR){  
         hide_loader();
      var allData=jQuery.parseJSON(data);
      $("#hash").attr('data-value',allData.hash);
      $("#artiListAll").html(allData.data);
  }
}); 
});

$('body').on('click','#addAnsbyUser', function(){
  toastr.remove();
  event.preventDefault();
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
    beforeSend: function (){ 
      show_loader(); 
    },
    success: function (data, textStatus, jqXHR){ 
      hide_loader(); 
      // $("#hash").val(data.hash);
      if (data.status == 1){ 
        $("#answerListAll").append(data.view);
        $("#projectinput8").val('');
        $('#artiId').hide();
        var totalans = $('#totalanswerCount').attr('data-value');
        articleans = parseInt(totalans)+1;
        $('#totalanswerCount').attr('data-value',articleans);
        $("#totalanswerCount").html(articleans);
      }
      else {
        toastr.error(data.msg);
        $("#hash").val(data.hash); 
      } 
    },
  });
});

 $('body').on('click','#sendAns', function(){
     toastr.remove();
         event.preventDefault();
            // if(addAnswer.valid()===false){
            //     toastr.error(proceed_err);
            //     return false;
            // }
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
                    //alert(data.html); 
                    $("#ansList").html(data.html);
                    $("#ans-count").html(data.answerCount);
                    $("#forumAnswer").val('');
                    }
                    else {
                        toastr.error(data.msg);
                         $("#hash").val(data.hash);  
                    }  
                },
            });
    });


 