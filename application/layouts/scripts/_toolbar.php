<script>
$(document).ready(function(){
	$('#toolbar_holder').mouseover(function(){
		$('#toolbar').slideDown('fast');
	});
	$('#toolbar_holder').mouseout(function(e) {
		if ($.contains(this, e.relatedTarget) == false) {
			$('#toolbar').slideUp('fast');
		}
	});
});
</script>
<style>
#toolbar_holder {
	position:fixed;
	z-index:99;
	bottom:0;
	left:0;
	right:0;
	color:#333;
}
#toolbar_holder a {
	color:#333;
}
#toolbar {
	display:none;
	height:40px;
	border-top:2px solid #000;
	background-color:#b6d7f4;
	background: -webkit-gradient(linear, 
								 left bottom, 
								 left top, 
								 color-stop(0.1, rgb(182,215,244)), 
								 color-stop(0.9, rgb(247,247,247)));
	background: -moz-linear-gradient(center bottom,
									 rgb(182,215,244) 10%, 
									 rgb(247,247,247) 90%);
	background: filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFF, 
																  endColorstr=#b6d7f4);
	background: -ms-filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#FFFFFF, 
																	  endColorstr=#b6d7f4, 
																	  GradientType=1);
}
</style>
<div id="toolbar_holder">
  <div style="height:10px;"></div>
  <div id="toolbar">
  	<div style="display:table;width:100%;height:100%;">
      <div style="display:table-cell;vertical-align:middle;text-align:center;height:100%;width:100%;">
        <!-- heres where all the code goes for the tool bar buttons and xp level and such -->
  	    <a href="/">home</a>
  	    <a href="/store">store</a>
      </div>
  	</div>
  </div>
</div>