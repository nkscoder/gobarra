<?php /*?>// If there is any suggestion to make it better, Please let me know - Developer: Anup Tripathi<?php */?>

<?php  $container_id= "scroll_pagination_travelpost";?>

<div class="<?php echo $container_id;?>"><?php echo @$scroll_pagination;?></div>

<div id="scrollMsg" style="display:none;">****************</div>

<img src="<?php echo base_url().'modules/scroll_pagination/views/loader.gif';?>" style="display:none;" />

<script src="<?php echo base_url();?>modules/scroll_pagination/views/jquery.ba-throttle-debounce.min.js"></script>

<script>

var pages=new Array();

var shown=1;

var container_id='<?php echo $container_id;?>';

var footer_height= parseInt(($(window).height()));

$(document).ready(function(e) {

	$('.'+container_id+' .scroll_paging:eq(0) a').each(function(index, element) {

        var chr=$(this).text();

		if(!isNaN(chr))

		pages.push(chr);

    });

	});

$(window).scroll($.debounce( 250, true, function(){

    $('#scrollMsg').html('SCROLLING!');

}));

$(window).scroll($.debounce( 250, function(){

    $('#scrollMsg').html('DONE!');

	var wh=$(window).scrollTop() + $(window).height();

	var dh=$(document).height();

	var dh1=$(document).height()-footer_height;

	if( wh > dh1 && shown<pages.length ) 

	{

		$('.'+container_id+' .scroll_paging a:eq('+shown+')').trigger('click');

		shown++;

	}

}));

</script>