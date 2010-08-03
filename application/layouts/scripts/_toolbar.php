<script>
$(document).ready(function(){
	$('#toolbar_holder').mouseenter(function(){
		$('#toolbar').slideDown('fast');
	});
	$('#toolbar').mouseleave(function() {
		$(this).slideUp('fast');
	});
	$('#loginbutton').click(function(){
		$.fancybox({
			href:'/login?iframe=1',
			autoDimensions: false,
			width:200,
			height:300
		});
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
	height:100px;
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
  <!-- this empty div determines the distance you have to be from the bottom to pop up the menu -->
  <div style="height:20px;"></div>
  <div id="toolbar">
  	<div class="table" style="height:100%;">
      <div class="cell middle center" style="height:100%;width:100%;">
        <!-- heres where all the code goes for the tool bar buttons and xp level and such -->
        <?php if (Zend_Auth::getInstance()->hasIdentity()) : ?>
       		<button onclick="window.location='/logout'">logout</button>
       	<?php else : ?>
        	<button id="loginbutton">login</button>
        <?php endif; ?>
  	    <a href="/">home</a>
  	    <a href="/contact">contact</a>
  	    <a href="/store">store</a>
  	    <a href="/updates">updates</a>
      </div>
  	</div>
  </div>
</div>