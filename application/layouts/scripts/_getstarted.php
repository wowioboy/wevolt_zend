<script>
$(document).ready(function(){
	$('#getStarted').click(function(){
		$.fancybox([{'content':'<img src="/images/getstarted/tut_content_1.png" />',
					 'title':'<img src="/images/getstarted/get_started_header.png" />'},
					{'content':'<img src="/images/getstarted/tut_content_2.png" />',
				     'title':'<img src="/images/getstarted/tut_2_header.png" />'},
					{'content':'<img src="/images/getstarted/tut_3_content.png" />',
					 'title':'<img src="/images/getstarted/tut_3_header.png" />'},
					{'content':'<img src="/images/getstarted/tut_4_content.png" />',
					 'title':'<img src="/images/getstarted/tut_4_header.png" />'},
					{'content':'<img src="/images/getstarted/tut_5_content.png" />',
					 'title':'<img src="/images/getstarted/tut_5_header.png" />'},
					{'content':'<img src="/images/getstarted/tut_6_content.png" />',
					 'title':'<img src="/images/getstarted/tut_6_header.png" />'},
					{'content':'<img src="/images/getstarted/tut_7_content.png" />',
					 'title':'<img src="/images/getstarted/tut_7_header.png" />'},
					{'content':
						'<img src="/images/getstarted/tut_8_content.png" usemap="#tutMap" />' +
						'<map name="tutMap" id="tutMap">' +
						'<area shape="rect" coords="376,191,560,310" href="/register?pro=1" />' +
						'<area shape="rect" coords="138,194,324,306" href="/register" />' +
						'</map>',
					 'title':'<img src="/images/getstarted/tut_8_header.png" />'}],
		{
			titlePosition:'inside',
			showNavArrows: false,
			scrolling: 'no',
			width:700,
			height:600,
			autoDimensions: false,
			titleFormat: function(title, slide, index, fancybox) {
				var prev = '';
				var next = '';
				if (index > 0) {
					prev = '<img id="prev" src="/images/getstarted/tut_prev.png" />';
				} 
				if (index < 7) {
					next = '<img id="next" src="/images/getstarted/tut_next.png" />';
				}
			    title = '<div class="divtable">' + 
			    		'<div class="divcell middle left" style="width:115px;">' + prev + '</div>' +
			    		'<div class="divcell middle center">' + title + '</div>' + 
			    		'<div class="divcell middle right" style="width:115px;">' + next + '</div>' +
			    		'</div>';
				return title;
			}
		});
	});
	$('#next').live('click', function(){
		$.fancybox.next();
	});
	$('#prev').live('click', function(){
		$.fancybox.prev();
	});
});
</script>
<div class="panel_holder" style="width:295px;">
  <div class="panel_top">
    <div class="divtable">
      <div class="divcell left middle">Get Started!</div>
    </div>
  </div>
  <div class="panel_body">
    <img id="getStarted" src="/images/getstarted/get_started_OFF2.jpg" onmouseover="this.src='/images/getstarted/get_started_OVER2.jpg'" onmouseout="this.src='/images/getstarted/get_started_OFF2.jpg'" border="0" />
  </div>
</div>