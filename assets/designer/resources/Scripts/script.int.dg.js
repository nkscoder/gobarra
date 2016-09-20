function include(url){ 
  document.write('<script src="'+ url + '" type="text/javascript"></script>'); 
}
include(resource_url+'Scripts/helpers.min.js');
include(resource_url+'fancybox/jquery.fancybox-1.3.4.pack.js');
include(resource_url+'Scripts/addthis_widget.js');

if(Page=='home'){
	include(resource_url+'Scripts/jquery.mobile.customized.min.js');
	include(resource_url+'Scripts/fluid_dg.min.js');
}

if(Page=='details'){
include(resource_url+'zoom/magiczoomplus.js');
}

$(window).load(function(e){
	$(".forgot").fancybox({  'width' : 400, 'height' : 155, 'autoScale' : false, 'transitionIn' : 'elastic', 'transitionOut' : 'elastic', 'type' : 'iframe'});
	$(function(){$(".related-products").jCarouselLite({vertical:false,btnPrev:".prev1",btnNext:".next1",hoverPause:true,visible:4,auto:2000,speed:400});});
	$(".post-testimonial").fancybox({'width' : 450,'height' : 470,'autoScale' : false,'transitionIn': 'fade','transitionOut': 'fade','type' : 'iframe'}); 
	$(".invoice").fancybox({'width' :825,'height' : 481,'autoScale' : false,'transitionIn': 'fade','transitionOut': 'fade','type' : 'iframe'}); 
	$(".track-order").fancybox({'width' : 370,'height' : 210,'autoScale' : false,'transitionIn': 'fade','transitionOut': 'fade','type' : 'iframe'});
	$(".forgot").fancybox({'width' : 370,'height' : 195,'autoScale' : false,'transitionIn': 'fade','transitionOut': 'fade','type' : 'iframe'});
	$('#logo').flash({src: resource_url+'swf/logo.png', width: 273, height: 125, 'allowfullscreen':'true', 'menu' : 'false','wmode' : 'transparent', 'allowscriptaccess':'always','flashvars': {'Baseurl':site_url} });	
	$(".refer").fancybox({'width' : 320,'height' : 440,'autoScale' : false,'transitionIn': 'fade','transitionOut': 'fade','type' : 'iframe'});
	$("a[data-rel=gallery]").fancybox({'type':'image','titlePosition':'over'});
	$('a[data-rel=gallery]').live('click', function() {$(this).fancybox(settings).click();});
	
	$(".photo-scroll").jCarouselLite({btnPrev:".prev",btnNext:".next", vertical: false, hoverPause:true, visible: 4,
auto:2000, speed:400});
	
	if(Page=='home'){
		$(function(){$('#fluid_dg_wrap_1').fluid_dg({thumbnails: false,height:"297px", barPosition: "top", navigation: false, playPause: false, loader: "bar", time:3000, fx:'scrollLeft'})
})
}

	if(Page=='details'){
		$('.networks').click(function(){$('.networks').show();$(this).hide(0);$('.all_networks').hide(0);$(this).next().slideDown()})

$('.cl_btn').click(function(){$(this).parent().slideUp();$(this).parent().prev().slideDown()})
		}
	
});