 <?php $frontend_assets = base_url()."frontend_assets/";?>
 <footer class="footerSec">
<!--     <div class="container">
       <div class="footerCnt">
          <ul class="list-inline footerLink">
              <?php if(!empty($_SESSION[USER_SESS_KEY])){ ?>
             <li><a href="<?php echo base_url()?>home/forum">Forum</a></li>
             <li><a href="<?php echo base_url()?>home/recipes">Recipes</a></li>
              <?php }?>
             <li><a href="#">Training explorations</a></li>
             <li><a href="#">Healthy life style</a></li>
             <li><a href="#">Cancellation</a></li>
             <li><a href="#">Contact Us</a></li>
          </ul>
       </div>
    </div> -->
    <div class="copyright">
       <div class="container">
          <div class="copyCnt">
             <div class="float-left">
                <p>&copy; 2019 myvegantrainer.com</p>
             </div>
             <div class="float-right">
                <p><a href="<?php echo base_url();?>home/TermsConditions/#term-condition">Terms & Conditions</a> | <a href="<?php echo base_url();?>home/TermsConditions/#privcy-policy">Privacy Policy</a></p>
             </div>
          </div>
       </div>
    </div>
  </footer>
  <div class="modal fade lsModal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-tie"></i> Log In or <a href="<?php echo base_url().'home/membership';?>" >Register</h5></a>
          <button type="button" class="close" data-dismiss="modal" aria-la Contact Usbel="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="lsForm">
            <form id="loginUser" method="POST" action="<?php echo base_url();?>home/users/login">
              <div class="form-group">
                <input type="hidden" id ="hash13" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>">
                 <div class="text-danger error font_12" id="unsuccess" ></div>
                <input class="form-control pressEnter" type="email" name="email" placeholder="Email">
                <input type="hidden" name="redirecturl" id="text3" value="">
              </div>
              <div class="form-group">
                <input class="form-control pressEnter" type="password" name="password" placeholder="Password">
              </div>
              <div class="form-group form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="rememberMe"> Remember me
                </label>
              </div>
             <!--  <div class="lsLink">
                 <a href="" data-target="#forgotpwdModal" data-toggle="modal" data-dismiss="modal">Forgot Password?</a>
              </div> -->
              <div class="form-group">

                <button type="submit" class="btn btn-theme btn-bg-t btn-block pressEnter"  id="login_user" >Log In</button>

              </div>
               <div class="lsLink">
                 <a href="" data-target="#forgotpwdModal" data-toggle="modal" data-dismiss="modal">Forgot Password?</a>
              </div>
              </div>
            </form>
            <div class="lsBtn">
              <p>Don't have an account? <a href="<?php echo base_url().'home/membership';?>">Register Now</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="modal fade lsModal" id="forgotpwdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-tie"></i> Forgot Your Password or <a href="" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Login</a></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="lsForm">
            <form id="forgotPass" action="<?php echo base_url()?>home/users/forgotPassword" method="POST">
              <div class="form-group">
                <p class="paraText">Enter your registerd email id to forgot your password.</p>
              </div>
              <input type="hidden" id ="hash4" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>">
                 <div class="text-danger error font_12" id="unsuccess3" ></div>
              <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email">
              </div>
              <div class="form-group mt-30">
                <button type="button" class="btn btn-theme btn-bg-t btn-block" id="forgot_Pass">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="modal fade lsModal" id="memberShipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-body">
          <h5 class="modal-title" id="exampleModalLabel"><b>Upgrade to premium</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="lsForm">
              <div class="form-group">
                You are on Free Plan. Please upgrade to premium plan to access this info.
              </div>
                 <div class="text-danger error font_12" id="unsuccess3" ></div>
              <div class="form-group mt-30">
                <a href="<?php echo base_url();?>home/membership" class="btn btn-theme btn-bg-t btn-block" >Go to Plans</a>
              </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade lsModal" id="rigsterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="modal-title" id="exampleModalLabel1"><i class="fas fa-user-tie"></i> Register or <a href="" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Log In</a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
          <div class="lsForm">
         
              <form id="add_user" action="<?php echo base_url();?>home/users/adduser" method="post">
              <div class="form-group text-center">
                <input type="hidden" id ="hash55" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>">
                <!-- <?php if(!empty($_GET['referralLink'])){?>
                <input type="text" name="refralId" value="<?php echo $_GET['referralLink'];?>">
                <?php }?> -->
                <div class="log_div">
                  <img src="<?php echo $frontend_assets;?>img/user-acnt-icn.png" id="pImg">
                  <div class="text-center upload_pic_in_album"> 
                    <input accept="image/*" class="inputfile hideDiv" id="file-1" name="profileImage" onchange=" return fileValidation();" style="display: none;" type="file">
                    <label for="file-1" class="upload_pic">
                      <span class="fa fa-camera"></span></label>
                  </div>

                </div> 
                  <p style="color: gray;font-size: 11px;">Image should be atleast 300*300px</p>
              </div>
              <div class="form-group">
               
                <input class="form-control" type="text" name="name" placeholder="Full Name">
              </div>
              <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email">
                <input class="form-control" id="free4User" type="hidden" name="freeuser" value="">
              </div>
              <div class="form-group">
              
                <input class="form-control" type="password" name="password" id="pass" placeholder="Password">
              </div>
              <div class="form-group">
                <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password">
                <input type="hidden" name="newurl" id="nurl" value="">
              
                <!-- <input type="text" name="signupId" id="nurl1" value="<?php if(!empty($_COOKIE['reffralId'])){echo $_COOKIE['reffralId']; }?>"> -->
              </div>
              <div class="form-group form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="rememberMe"> Remember me
                </label>
              </div>
              <div class="form-group">
              <!--   <a href="" class="btn btn-theme btn-bg-t btn-block"  id="addUser">Register</a> -->
              <button type="submit"  class="btn btn-theme btn-bg-t btn-block"  id="addUser" >Register</button>
              </div>
            </form>
            <div class="lsBtn">
              <p>Already have an account? <a href="" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Log In</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade lsModal csModal" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title" id="exampleModalLabel1"><i class="far fa-comment-alt"></i> Add Your Question</h5>
        <p class="model-dec">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
        <div class="lsForm">
          <form id="add_forum"  action="<?php echo base_url()?>home/forum/add_forum" method="POST">
            <input type="hidden" id ="hashid" name="<?php echo get_csrf_token()['name'];?>" value="<?php echo get_csrf_token()['hash'];?>">
            

            <div class="form-group">
              <input class="form-control" name="title" type="text" name="" placeholder="Enter Question">

            </div>
            <div class="form-group textArea">
              <textarea class="form-control"  name="description" placeholder="Enter Description"></textarea>
            </div>
            <div class="form-group">
                <button type="button"  class="btn btn-theme btn-bg-t btn-block"  id="addForum" >Post</button>
            </div>
          </form>
        </div>
      </div>
        
    </div>
  </div>
</div>

  <div class="modal fade lsModal" id="errorModal1" tabindex="-1" role="dialog" aria-labelledby="errorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form>
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="form-group">
              <h6>Look like you don't have access of this content. To access<span id="fName"></span> 's content, please subscribe.</h6>              
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-theme btn-bg-b" data-dismiss="modal">Cancel</button>
              <a href="<?php echo base_url('home/trainers'); ?>" class="btn btn-theme btn-bg-t" >Subscribe</a>
          </div>
        </form>
      </div>
    </div>
  </div>
   <!-- jquery js -->
   <script src="<?php echo $frontend_assets;?>js/jquery-3.3.1.min.js"></script>
  
   <!-- bootstrap js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

   <script src="<?php echo $frontend_assets;?>js/bootstrap.min.js"></script>
   <!-- owl.carousel js -->
   <script src="<?php echo $frontend_assets;?>js/owl.carousel.min.js"></script>
   <!-- wow js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
   <!-- main js -->
   <script src="<?php echo $frontend_assets;?>js/main.js"></script>
    <?php if(!empty($front_js)) { load_js($front_js); }?>
<!-- <script src="http://vjs.zencdn.net/4.12/video.js"></script> -->
   </body>
</html>


<script type="text/javascript">
   

 
function fileValidation(){
    var fileInput = document.getElementById('file-1');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
         toastr.error('Please upload file having extensions .jpeg/.jpg/.png/.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {

            var reader = new FileReader();
            reader.onload = function(e) {
             document.getElementById('pImg').src = window.URL.createObjectURL(fileInput.files[0]);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

</script>