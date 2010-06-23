<?php
$latests = new Model_DbTable_Latest;
$results = $latests->fetchAll("IsActive = '1' and rating != 'a'", null, 6);
?>
<script>
$(document).ready(function(){
	$("#latest_container").cycle({
		fx: 'fade',
		timeout: 7000,
		pauseOnPagerHover: true,
		speed: 800,
		pager: '#latestnavs'
	});
});
</script>
<div class="panel_holder" style="width:412px;">
<div class="panel_top">
  <div class="divtable">
    <div class="divcell left middle">Latest</div>
    <div class="divcell right middle"><span id="latestnavs"></span></div>
  </div>
</div>
<div class="panel_body" style="height:230px;">
  <div id="latest_container">
    <?php foreach ($results as $latest) : ?>
	  <div style="visibility:hidden;">
		  <a href="<?php echo $latest->Link; ?>">
		    <img src="<?php echo $latest->Thumb; ?>" border="0" />
		  </a>
	  </div>
    <?php endforeach; ?>
  </div>
</div>
</div>