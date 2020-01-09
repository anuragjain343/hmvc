<?php if(!empty($result)){ ?>
<ul class="recp-ul">
<? foreach($result as $recipe){ ?>
  <li>
    <div class="rec-info">
      <a href="<?php echo base_url('home/recipes/recipeDetail/').encoding($recipe['id']); ?>">
        <img src="<?php if(!empty($recipe['image'])){ echo base_url().RECEPIE_THUMB.$recipe['image']; }else{ echo base_url().DEFAULT_RECEPIE_IMAGE; } ?>" alt="">
        <div class="rec-txt">
          <h4 class="wordWrap"><?php echo ucwords($recipe['title']); ?></h4>
        </div>
      </a>
    </div>
  </li>
<?php } ?>
</ul>
<?php }else{ ?>
<div>
  <center><h2 style="font-size: 20px; color: #757575; margin-top: 80px;">No Recipe Found</h2></td>
</div>
<?php } ?>
<!-- Paginate -->
<div class="pgination-block"><?php echo $pagination; ?></div>