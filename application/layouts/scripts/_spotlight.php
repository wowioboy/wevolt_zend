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
<div class="panel_holder" style="width:280px;margin:0px auto;">
<div class="panel_top">
  <div class="table fill">
    <div class="cell left middle">Spotlight</div>
    <div class="cell right middle"><span id="lowernavs"></span></div>
  </div>
</div>
<div class="panel_body" style="height:154px;">
  <div id="spotlight_container">
    <?php foreach ($results as $spotlight) : ?>
	  <div style="visibility:hidden;">
	    <?php if ($spotlight->FullImage) : ?>
		  <a href="<?php echo $spotlight->Link; ?>">
		    <img src="<?php echo $spotlight->Thumb; ?>" height="154" width="275" border="0" />
		  </a>
	    <?php else : ?>
		  <table>
		    <tr>
		      <td valign="top"><img src="<?php echo $spotlight->Thumb; ?>" height="100" width="100"></td>
		      <td valign="top" style="padding-left:5px;padding-right:2px;">
		        <div class="sender_name" style="color:#000;font-size:14px;"><?php echo $spotlight->Header; ?></div>
		        <div style="font-size:12px;color:#000;">
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