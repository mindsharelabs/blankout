/*
 Blankout Scripts File

 This file should contain any js scripts you want to add to the site.
 Instead of calling it in the header or throwing it inside wp_head()
 this file will be called automatically in the footer so as not to
 slow the page load.

 */

jQuery.noConflict();
jQuery(document).ready(function() {
	init();
});

function init() {

	// bind Bootsrtap's CSS classes to Gravity Forms
	jQuery(document).bind('gform_post_render', function() {
		jQuery('.button').addClass('btn btn-primary');
		jQuery('.gform_next_button').addClass('pull-right');
		jQuery('.gform_button').addClass('pull-right btn-success controls');
		jQuery('.gform_page').addClass('row');
		jQuery('.gform_page_footer').addClass('col-lg-8');
		jQuery('.gfield_error').addClass('inputWarning');
		jQuery('.validation_error').addClass('alert alert-error');
	});

	// Enable flexslider. Make sure to turn on jquery.flexslider in Developer Options
	console.log(typeof(jQuery('.flexslider').flexslider));
	jQuery('.flexslider').flexslider({
		animation: "slide"
	});

	/**
	 *  Responsive jQuery
	 */

	// viewport width
	var viewport = jQuery(window).width();

	// smaller than 481px
	if(viewport < 481) {

	}

	// larger than 481px
	if(viewport > 481) {

	}

	// larger than or equal to 768px
	if(viewport >= 768) {

		// load gravatars
		jQuery('.comment img[data-gravatar]').each(function() {
			jQuery(this).attr('src', jQuery(this).attr('data-gravatar'));
		});
	}

	// larger than 1030px
	if(viewport > 1030) {

	}


}

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if(!window.getComputedStyle) {
	window.getComputedStyle = function(el, pseudo) {
		this.el = el;
		this.getPropertyValue = function(prop) {
			var re = /(\-([a-z]){1})/g;
			if(prop == 'float') {
				prop = 'styleFloat';
			}
			if(re.test(prop)) {
				prop = prop.replace(re, function() {
					return arguments[2].toUpperCase();
				});
			}
			return el.currentStyle[prop] ? el.currentStyle[prop] : null;
		}
		return this;
	}
}

/* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
 */
(function(w) {
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if(!( /iPhone|iPad|iPod/.test(navigator.platform) && navigator.userAgent.indexOf("AppleWebKit") > -1 )) {
		return;
	}
	var doc = w.document;
	if(!doc.querySelector) {
		return;
	}
	var meta = doc.querySelector("meta[name=viewport]"), initialContent = meta && meta.getAttribute("content"), disabledZoom = initialContent + ",maximum-scale=1", enabledZoom = initialContent + ",maximum-scale=10", enabled = true, x, y, z, aig;
	if(!meta) {
		return;
	}
	function restoreZoom() {
		meta.setAttribute("content", enabledZoom);
		enabled = true;
	}

	function disableZoom() {
		meta.setAttribute("content", disabledZoom);
		enabled = false;
	}

	function checkTilt(e) {
		aig = e.accelerationIncludingGravity;
		x = Math.abs(aig.x);
		y = Math.abs(aig.y);
		z = Math.abs(aig.z);
		// If portrait orientation and in one of the danger zones
		if(!w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) )) {
			if(enabled) {
				disableZoom();
			}
		} else if(!enabled) {
			restoreZoom();
		}
	}

	w.addEventListener("orientationchange", restoreZoom, false);
	w.addEventListener("devicemotion", checkTilt, false);
})(this);
