<?php if(!empty($notifiList)){ 
foreach ($notifiList as $key => $value){
if($value->notificationType=='delete_article'){	
$url='admin/article/deleteAticle/'.encoding($value->referenceId);
}elseif($value->notificationType=='delete_training_video'){
	$url='admin/video/deleteTrVideoByAdmin/'.encoding($value->referenceId);
}
else{
$url='admin/video/deleteVideoByAdmin/'.encoding($value->referenceId);
}
?>
<a href="<?php echo base_url().$url;?>">
<div class="media"  <?php if($value->isRead=='0'){ echo 'style="background: #edeff2;';}?> id="notifiListstyle<?php echo $value->referenceId;?>">
	<div class="media-left align-self-center"><i class="ft-file-text icon-opacity font-medium-4 mt-2"></i></div>
		<div class="media-body" id="urlId" onclick="updatenotification('<?php echo $value->referenceId;?>')">
		<?php
		$msg = json_decode($value->notificationMessage);
		?>
		<h6 class="media-heading info"><?php echo $msg->title;?></h6>
		<p class="notification-text font-small-3 text-muted text-bold-600">
			<?php if($value->notificationBy==1){
			$newbody = str_replace("[UNAME]",'admin',$msg->body);	
			}else{
			$newbody = str_replace("[UNAME]",$value->fullName,$msg->body);
			}
			 echo $newbody;
			 ?>
		</p><small>
		<time class="media-meta text-muted" datetime=""><?php echo time_elapsed_string($value->createdOn);?></time></small>
	</div>
</div>
</a>	
<?php } }
else{?>
	<div class="media">
	<div class="media-left align-self-center"><i class="ft-share info font-medium-4 mt-2"></i></div>
		<div class="media-body">
		<h6 class="media-heading info">No notification received</h6>
		<p class="notification-text font-small-3 text-muted text-bold-600">Notification not found!</p><small>
	</div>
</div>
<?php } ?>
