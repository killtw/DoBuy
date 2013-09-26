window.onresize = fix_height;

function fix_height() {
	var screen_height = get_screen_height();
	var frame_obj = document.getElementById("frame");
	frame_obj.height = screen_height - document.getElementById("bar").clientHeight - 20 + "px";
	return false;
}

function get_screen_height() {
	var myHeight = 0;
	if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myHeight = window.innerHeight;
	} else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
		//IE 6+ in 'standards compliant mode'
		myHeight = document.documentElement.clientHeight;
	}
	return myHeight;
}
jQuery(document).ready(fix_height);