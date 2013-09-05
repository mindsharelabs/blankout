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

	// Bootsrtap CSS classes to Gravity Forms
	jQuery(document).bind('gform_post_render', function() {
		jQuery('.button').addClass('btn btn-primary');
		jQuery('.gform_next_button').addClass('pull-right');
		jQuery('.gform_button').addClass('pull-right btn-success controls');
		jQuery('.gform_page').addClass('row');
		jQuery('.gform_page_footer').addClass('col-lg-8');
		jQuery('.gfield_error').addClass('inputWarning');
		jQuery('.validation_error').addClass('alert alert-error');
	});

	// FlexSlider
	if(jQuery.isFunction(jQuery.fn.flexslider)) {
		// FlexSlider config @see http://www.woothemes.com/flexslider/
		jQuery('.flexslider').flexslider({
			animation: "slide"
		});

	} else {
		//console.log('Please enable FlexSlider (Settings > Developer Settings > Libraries & Plugins).');
	}

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
