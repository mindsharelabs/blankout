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

	// setup some additional Bootstrap CSS classes
	jQuery('.mapi.edit-link,.aside-block .link-icons').addClass('pull-right');
	jQuery('.wp-caption-text, .gfield_description').addClass('muted');
	jQuery('.button, .button-primary, .field input[type="submit"], #wp-submit').addClass('btn');
	jQuery('.login p.error').addClass('alert alert-error');
	jQuery('.login p.message').addClass('alert alert-info');


	// tables
	jQuery('#main table, .form-table').addClass('table table-hover');

	// wordpress classes
	jQuery('.alignleft').addClass('text-left');
	jQuery('.alignright').addClass('text-right');
	jQuery('.aligncenter').addClass('text-center');
	jQuery('.post-edit-link').addClass('btn btn-xs btn-primary');

	// Gravity Forms stuff
	jQuery(".gform_wrapper .disable input").attr('disabled', 'disabled');

	// FlexSlider setup
	if(jQuery.isFunction(jQuery.fn.flexslider)) {
		// @see http://www.woothemes.com/flexslider/
		jQuery('.flexslider').flexslider({
			animation:      "fade",			//String: Select your animation type, "fade" or "slide"
			slideshow:      true,           //Boolean: Animate slider automatically
			slideshowSpeed: 10000,          //Integer: Set the speed of the slideshow cycling, in milliseconds
			animationSpeed: 400,            //Integer: Set the speed of animations, in milliseconds
			pauseOnAction:  true,           //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
			pauseOnHover:   true,           //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
			useCSS:         true,           //{NEW} Boolean: Slider will use CSS3 transitions if available
			touch:          true,           //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
			controlNav:     false,          //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			directionNav:   true,           //Boolean: Create navigation for previous/next navigation? (true/false)
			prevText:       "Previous",     //String: Set the text for the "previous" directionNav item
			nextText:       "Next",         //String: Set the text for the "next" directionNav item
			keyboard:       true            //Boolean: Allow slider navigating via keyboard left/right keys
		});

	} else {
		//console.log('Please enable FlexSlider (Settings > Developer Settings > Libraries & Plugins).');
	}

	/**
	 *  Enable Bootstrap tooltips for items with '.tip' class
	 */
	jQuery('.tip').tooltip({
		'container': 'body'
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
