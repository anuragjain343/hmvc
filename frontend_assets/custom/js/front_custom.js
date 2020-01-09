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
     return this.optional( element ) || ( /^[a-zA-Z0-9]+([-._][a-zA-Z0-9]+)*@([a-zA-Z0-9]+(-[a-zA-Z0-9]+)*\.)+[a-zA-Z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
    }, 'Please enter valid email address.');

 jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
  }, "Invalid email address or password");




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
                 noSpace: true,
                 maxlength:50,
                 minlength:6,
               
                 
            },
             cpassword:{
                required:true,
                 maxlength:50,
                 minlength:6,
                 equalTo: "#pass",
                  noSpace: true,
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
$("#add_user").submit(function(e){
  e.preventDefault();
//$('body').on('click','#addUser', function(){
     toastr.remove();
         //event.preventDefault();
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


//alert('hii');
var biz_login_form = $("#loginUser");
//alert(biz_login_form);
biz_login_form.validate({
  rules:{
    email:{ 
      required: true,
      email: true
    },
    password:{
      required:true,
      noSpace:true,
      maxlength:50,
      minlength:6,
      
    },
  },       
});

$("#loginUser").submit(function(e){
  e.preventDefault();
  //$('body').on('click','#login_user', function(e){
  //$("#login_user").submit(function(e){
  toastr.remove();
  //e.preventDefault();
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
        
      } 
      if(obj.messages.unsuccess){
      //  alert(obj.messages.unsuccess);
      $('#unsuccess').html('<div class="alert" style="background-color:#ffcccc; color:#4d0000;" >'+obj.messages.unsuccess+'</div>');
        window.setTimeout(function() { $('#unsuccess').html("")  }, 2000);

      $('#unsuccess-3').html('<div class="alert" style="background-color:#ffcccc; color:#4d0000;" >'+obj.messages.unsuccess+'</div>');
       window.setTimeout(function() { $('#unsuccess').html("")  }, 2000);
      }
    }
  });
});



$(document).on('keypress','.pressEnter',function(e){
  console.log(e.which);
});

// $('.pressEnter').keypress(function(e){
//  console.log(e.which);
//  alert(e.which);
//  if (e.which == 13) {
//   login();
//  }
// });


//on click login button
/*$(document).on('click',"#login_user", function(event){ 

  alert('You pressed enter!');
login();
});*/

// payment 
/*var payment = $("#payment_form");
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
         //event.preventDefault();
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
         
    });*/
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
  //event.preventDefault();
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
 //$("#sfree").remove();
  $('#free4User').val('');
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
    data: {'id':dt}, //only input
    processData: false,
    contentType: false,
    //dataType: "JSON", 
    beforeSend: function () { 
      show_loader(); 
    },
    success:function(res){
      hide_loader(); 
      var obj = JSON.parse(res);
      
      if(obj.status=='0'){
        $('#loginModal').modal('show'); 
        $("#text3").val(url);
      }/*else if(obj.status=='4'){
        $('#errorModal1').modal('show'); 
      }*/
      else{
        window.location.href = url;  
      }   
    }
  });
}

function checkLevelWithLoginCheck(dt,level,vid,pid){
  //alert('f');
  $.ajax({
    type:"GET",
    url:base_url+'home/isUserCheckMemberShip?plan='+level+'&postedBy='+pid,
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
      }else if(obj.status=='2'){
         $('#memberShipModal').modal('show'); 
      }else if(obj.status=='1'){
         $('#videoModal').modal('show'); 
      }
      else if(obj.status=='4'){
       
        $('#errorModal').modal('show'); 
      }
      else{
       //return true;
         playVideo(vid);
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
        //event.preventDefault();
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
        // event.preventDefault();
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

  function isLike11(ctrl,frmid){
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

  function isLike(ctrl,frmid){
   $.ajax({
    type:"GET",
    url:base_url+'/'+ctrl,
    data: {'id':frmid}, //only input
    success:function(res){
      var obj = JSON.parse(res);
     
      if(obj.status=='1'){

        $(".mylike").css("color", "#5dbbf2");
        if((obj.currentUserlikeCount=='1') && (obj.likeCount=='1')){
           $("#totallike").html('You liked');
        }
        if((obj.currentUserlikeCount=='1') && (obj.likeCount > '1')){
          var tot =parseInt(obj.likeCount)-1;
          $("#totallike").html('You and '+ tot  +' others ');
        }

      }
      else{
        $(".mylike").css("color", ""); 
        if((obj.currentUserlikeCount=='0') && (obj.likeCount=='0')){
            var tot =parseInt(obj.likeCount);
           $("#totallike").html(tot+' Like');

        }
        if((obj.currentUserlikeCount=='0') && (obj.likeCount >='1')){
          var tot =parseInt(obj.likeCount);
           if(obj.likeCount<2){
           $("#totallike").html(tot+' Like');
         }else{
            $("#totallike").html(tot+' Likes');
         }
        }
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
          if((obj.currentUserLike=='1') && (obj.likeCount=='1')){   
          $('#likans'+answerId).html('You liked');
        }
        if((obj.currentUserLike=='1') && (obj.likeCount > '1')){
          var tot =parseInt(obj.likeCount)-1;
          $('#likans'+answerId).html('You and '+ tot  +' others');
        }

      }
      else{
       $(".mylike"+answerId).css("color", ""); 
       if((obj.currentUserLike=='0') && (obj.likeCount=='0')){
         var tot =parseInt(obj.likeCount);
         $('#likans'+answerId).html(tot+' Like');
        }
        if((obj.currentUserLike=='0') && (obj.likeCount >='1')){
          var tot =parseInt(obj.likeCount);
          if(obj.likeCount<2){
           $('#likans'+answerId).html(tot+' Like');
          }else{
             $('#likans'+answerId).html(tot+' Likes');
          }
        }
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
      else if(obj.status=='3'){
      
        window.setTimeout(function (){
              window.location.href= base_url+'home/forum';
          }, 1000);
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
//END OF FUNCTION    searcharticle
$("#articleSearch").submit(function(e){
  e.preventDefault();

//$('body').on('click','#articleSearch', function(){
     //$('#srh').keypress()
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

$("#articleTitleSrearch").submit(function(e){
  e.preventDefault();

//$('body').on('click','#articleTitleSrearch', function(){
// event.preventDefault();
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
  //event.preventDefault();
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
        $("#answerListAll").prepend(data.view);
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

var answerByTrainer = $("#answerByTrainer");
answerByTrainer.validate({
    rules: {
        answer: { 
            required: true,
             maxlength: 1000,
             minlength:2,
            
            },    
    },       
});

 $('body').on('click','#sendAns', function(){
     toastr.remove();
         //event.preventDefault();
            if(answerByTrainer.valid()===false){
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
                      $("#ansList").prepend(data.html_view);
                      $("#forumAnswer").val('');
                      $('#artiId').hide();
                      var totalans = $('#ans-count').attr('data-value');
                      articleans = parseInt(totalans)+1;
                      $('#ans-count').attr('data-value',articleans);
                      $("#ans-count").html(articleans + ' Answers');
                    } else if(data.status=='3'){
                        window.setTimeout(function (){
                        window.location.href= base_url+'home/forum';
                        }, 1000);
                      }

                    else {
                        toastr.error(data.msg);
                         $("#hash").val(data.hash);  
                    }  
                },
            });
    });

jQuery(function() { //validation for alphabets and spaces
  jQuery.validator.addMethod("alpha_dash", function(value, element) {
    return this.optional(element) || /^[a-z ]+$/i.test(value); 
  }, "Alphabets, spaces, & dashes only."); 
});

//validation edit user profile
  $("#editUserProfile").validate({
    rules: {
      fullName : {       
        required: true,
        minlength: 2,
        maxlength: 20,
        alpha_dash: true,
      }
    },
    messages:{
      fullName:{
        required: "Please enter name",
        minlength: "Minimum length should be 2",
        maxlength: "Maximum length should be 20" ,
        alpha_dash: "Numbers and special characters are not allowed.",                  
      }
    }
  });

//edit user profile
$(document).on('click','#updateUser', function(){
    toastr.remove();
    if ($("#editUserProfile").valid() === true){
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
              }else{
                toastr.error(data.message);
              }
          },
      });
    }else{
      toastr.error(proceed_err); //error
    }  
});
/*end edit user profile*/
  function signupForFree(){
      $('#rigsterModal').modal('show'); 
    
    $('#free4User').val(1);
  }


jQuery.validator.addMethod("Space", function(value, element) { 
  return jQuery.trim(value).length > 0 ;
}, "Space are not allowed"); //only space not allowed validation

//validation change password
  $("#changePasswordform").validate({
    rules: {
      oldPassword : {       
        required: true
        },
      newPassword : {
        required: true,
        minlength: 6,
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
        minlength: "Minimum length should be 6",
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
$('body').on("click",".updateUserPassword",function(){
    toastr.remove();
    if ($("#changePasswordform").valid() === true){
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
            hide_loader(); 
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
      });  
    }else{
      toastr.error(proceed_err); //error
    }     
});//END change password js

