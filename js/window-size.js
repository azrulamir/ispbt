var windowwidth = $(window).width();
var windowheight = $(window).height();

$(document).ready(function(){
	
	var mainwrapperwidth = windowwidth * 85 / 100;
	$('#main-wrapper').css({'width' : mainwrapperwidth});
	$('#header-wrapper').css({'width' : mainwrapperwidth});
	
	var contentwidth = (mainwrapperwidth * 85 / 100) - 35;
	$('#body-wrapper').css({'width' : contentwidth});
	$('#footer').css({'width' : contentwidth});
	
	var sidebarwidth = mainwrapperwidth * 15 / 100;
	var sidebarheight = $('#body-wrapper').height();
	$('#side-menu').css({'width' : sidebarwidth, 'height' : 'auto'});
	
	var errorwrapperheight = $('#error-wrapper').height();
	var centerpos = windowheight / 2 - errorwrapperheight;
	$('#error-wrapper').css({'margin-top' : centerpos});
	
});
