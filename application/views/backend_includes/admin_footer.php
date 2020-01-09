 <?php $backend = base_url()."backend_assets/";?>
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block"><?php echo COPYRIGHT; ?><a class="text-bold-800 grey darken-2" id="weburl" href="<?php echo base_url();?>" target="_blank">MyVeganTrainer</a></span>
    </div>
  
 


</footer>
<!-- BEGIN VENDOR JS-->
<div id="tl_admin_loader" class="tlr_loader" style="display: none;"></div>

<script src="<?php echo $backend; ?>js/vendors.min.js" type="text/javascript"></script>
<script src="<?php echo $backend; ?>js/app-menu.min.js" type="text/javascript"></script>
<script src="<?php echo $backend; ?>js/app.min.js" type="text/javascript"></script>
<script src="<?php echo $backend; ?>js/switchery.min.js" type="text/javascript"></script>
<script src="<?php echo $backend; ?>js/switch.min.js" type="text/javascript"></script>
<script src="<?php echo $backend; ?>js/toastr/toastr.min.js"></script>
 <script src="<?php echo $backend; ?>custom/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?php echo $backend; ?>custom/js/admin_custom.js"></script> 
<script src="<?php echo $backend; ?>js/bootbox/bootbox.min.js"></script>

<?php  if(!empty($back_js)) { load_js($back_js);}?>
<script src="<?php echo $backend; ?>js/custom.js" type="text/javascript"></script>

<script type="text/javascript">
var currentUser='<?php echo $_SESSION[ADMIN_USER_SESS_KEY]['userId'];?>';

if(currentUser){
		window.setInterval(function(){

		    get_notification_list();
		}, 3000);
	}
	//ajax function to get notification list
	function get_notification_list(){
		$.ajax({
            url: '<?php echo base_url() ?>admin/notifictionList',
            type: "get",
            data: {},
            cache: false,
            dataType: "JSON", 
            success: function(data) {
            	
	            if(data.status == 1){
	            	var msg  = data.html;  
	            	var URL   = data.url;         	
	            	var title = data.title;	
	            	spawnNotification(msg,title,URL);//call function to show notification popup
	            }
	            $('.notifyCount').html(data.count);

	            $('.notifyCount').show();
	            if(data.count==0){
	            	$('.notifyCount').hide();
	            }  
            }
	    });
	}
	//show notification
    Notification.requestPermission();
    function spawnNotification(theBody,theTitle,URL) {
        var options = {
            body: theBody,
        }
        var notification = new Notification(theTitle, options);
        notification.onclick = function(event) {
            event.preventDefault(); // prevent the browser from focusing the Notification's tab
            window.location.href = URL; 
        }
        setTimeout(notification.close.bind(notification), 2000);
    }

    function notificationList(){
        $.ajax({
            url: '<?php echo base_url() ?>admin/userNotificationList',
            type: "get",
            data: {},
            cache: false,
            dataType: "JSON", 
            success: function(data) {
               
                if(data.status == 1){
                 $('#anotificationList').html(data.data);

                }else{
                 $('#anotificationList').html(data.data);    
                }
            }
        });

    }

    function updatenotification(rid){

        $.ajax({
            url: '<?php echo base_url() ?>admin/updateNotification',
            type: "get",
            data: {id:rid},
            cache: false,
            dataType: "JSON", 
            success: function(data) {
                if(data.status == 1){
                $('.notifyCount').hide();
               
                }else{
                 $('.notifyCount').hide(); 
              
                }
            }
        });
  
    }
</script>

</body>
</html>