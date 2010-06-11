<?php
$spotlights = new Model_DbTable_Spotlight;
$results = $spotlights->fetchAll("rating != 'a'", "createddate desc", 6);
?>
<script>
$(document).ready(function(){
	$("#spotlight_container").cycle({
		fx: 'fade',
		speed: 800,
		random: true,
		timeout: 5000,
		pager: '#lowernavs'
	});
});
</script>
<div class="panel_holder" style="width:280px;">
<div class="panel_top">
  <div class="divtable">
    <div class="divcell left middle">Spotlight</div>
    <div class="divcell right middle"><span id="lowernavs"></span></div>
  </div>
</div>
<div class="panel_body" style="height:154px;">
  <div id="spotlight_container">
    <?php foreach ($results as $spotlight) : ?>
	  <div style="visibility:hidden;">
	    <?php if ($spotlight->FullImage) : ?>
		  <a href="<?php echo $spotlight->Link; ?>">
		    <img src="<?php echo $spotlight->Thumb; ?>" border="0" />
		  </a>
	    <?php else : ?>
		  <div style="height:5px;"></div>
		  <table>
		    <tr>
		      <td valign="top"><img src="<?php echo $spotlight->Thumb; ?>"></td>
		      <td valign="top" style="padding-left:5px;padding-right:2px;">
		        <div class="sender_name"><?php echo $spotlight->Header; ?></div>
		        <div class="messageinfo" style="font-size:12px;color:#000000;">
		          <?php echo $spotlight->Comment; ?>
		          <br />
		          <a href="<?php echo $spotlight->Link; ?>">CHECK IT OUT</a>
		        </div>
		      </td>
		    </tr>
		  </table>
	    <?php endif; ?>
	  </div>
    <?php endforeach; ?>
  </div>
</div>
</div>