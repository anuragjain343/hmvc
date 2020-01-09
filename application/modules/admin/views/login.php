
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>My Vegan trainer | Admin - Login</title>
     <?php $backend = base_url()."backend_assets/";?>
    <link rel="shortcut icon" type="image/png" href="<?php echo $backend; ?>img/fav.png">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,600,700,700i,800,900" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>css/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>css/chat-application.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>css/line-awesome-font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>css/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>css/style-dash.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>css/my-responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend;?>js/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $backend; ?>custom/css/admin_custom.css">
   </head>
  <body class="vertical-layout vertical-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="1-column">
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="box-wdth box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="text-center mb-1 login-logo">
                                        <img src="<?php echo $backend; ?>img/logo.png" alt="branding logo">
                                </div>
                                <div class="font-large-1  text-center">                       
                                    Member Login
                                </div>
                            </div>
                            <div class="card-content">                           
                                <div class="card-body">
                                    <form class="form-horizontal" action="" id="login" novalidate>
                                        <input type="hidden" id ="hash" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>" >
                                        <div class="text-danger error font_12" id="unsuccess" ></div>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="email" class="form-control round" name="userName" id="userName" placeholder="Your Username" required>

                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>

                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control round" id="password" placeholder="Enter Password" name ="password" required>
                                            
                                             
                                            <div class="form-control-position">
                                                <i class="ft-lock"></i>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12 text-center text-sm-left">
                                               
                                            </div>
                                          <!--   <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="#" class="card-link" data-toggle="modal" data-target="#exampleModal">Forgot Password?</a></div> -->
                                        </div>                           
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1 pressEnter">Login</button>    
                                        </div>                                   
                                    </form>
                                </div>                  
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
      </div>
    </div>
<!-- Modal -->
<div class="modal fade text-left" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recover Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Your Email Address:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
<div id="tl_admin_loader" class="tlr_loader" style="display: none;"></div>
<!-- BEGIN VENDOR JS-->
<script src="<?php echo $backend; ?>js/vendors.min.js" type="text/javascript"></script>
<script src="<?php echo $backend; ?>js/app-menu.min.js" type="text/javascript"></script>
<script src="<?php echo $backend; ?>js/app.min.js" type="text/javascript"></script>
<script src="<?php echo $backend; ?>js/toastr/toastr.min.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> 
<script>

function show_loader(){
 $('#tl_admin_loader').show();
 }

 function hide_loader(){
 $('#tl_admin_loader').hide();
 }


$(document).ready(function() {
$("#login").validate({
        rules: {
            userName: {
                required: true,
                maxlength: 40
            },
            password: {
                required: true,
            }, 
        }, 

        messages: {
        userName: {
            required: "UserName field is required.", 
            maxlength:"Max characters should be 30.",
        },
        password: { 
            required: "Password field is required.",
            maxlength:"Max characters should be 20."
        },
    } 
    });

});

/*if (form.valid() === false){
   toastr.error('message');
    return false;
}
*/
  $("#login").submit(function(e){
  e.preventDefault();
   if ($('#login').valid()==false) {
        return false;
    }
  $.ajax({
    type:"POST",
    url:"admin/login",
    data:$(this).serialize(),
    datatype:"JSON",
     beforeSend: function () { 
       show_loader(); 
       },
    success:function(res){
          hide_loader(); 
      var obj = JSON.parse(res);
        if(obj){
               $("#hash").val(obj.messages.hash);
          }
          if(obj.messages.successU){
            toastr.success(obj.messages.successU);
            var surl = 'admin/dashboard';
            window.setTimeout(function () {
            window.location.href = obj.url;
            }, 1000);
          } 
           if(obj.messages.successT){
            toastr.success(obj.messages.successT);
            var surl = 'admin/trainers/dashboard';
            window.setTimeout(function () {
            window.location.href = obj.url;
            }, 1000);
          }
          if(obj.messages.unsuccess){
          // $('#unsuccess').html(obj.messages.unsuccess);
           $('#unsuccess').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Alert!</h4>'+obj.messages.unsuccess+'</div>');
            window.setTimeout(function() { $('#unsuccess').html("")  }, 3000);
            
          }
    }
  });
});


</script>
</body>
</html>