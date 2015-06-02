document.write("<style>body{display:none;}</style>");

jQuery.noConflict();
jQuery(document).ready(function($) {

	// setup some additional Bootstrap CSS classes
	$('.aside-block .link-icons').addClass('pull-right');
	$('.mapi.edit-link').addClass('text-right');
	$('.wp-caption-text, .gfield_description').addClass('text-muted');
	$('.button, .button-primary, .field input[type="submit"], #wp-submit').addClass('btn');
	$('.login p.error').addClass('alert alert-error');
	$('.login p.message').addClass('alert alert-info');

	// tables
	$('#main table, .form-table').addClass('table table-hover');

	// wordpress classes
	$('.alignleft').addClass('text-left');
	$('.alignright').addClass('text-right');
	$('.aligncenter').addClass('text-center');

	// here for each comment reply link of wordpress
	$('.comment-reply-link').addClass('btn btn-primary');

	// here for the submit button of the comment reply form
	$('#commentsubmit').addClass('btn btn-primary');

	// the search widget
	$('input.search-field, .textwidget select, .widget_archive select').addClass('form-control');

	$('.post-template-sticky .sticky').addClass('jumbotron');
	$('.widget_rss ul').addClass('media-list');
	$('.widget_rss li').addClass('media');
	$('.widget_rss li a.rsswidget').addClass('media-heading');

	$('table#wp-calendar').addClass('table table-striped');

	// Gravity Forms stuff
	//$(".gform_wrapper .disable input").attr('disabled', 'disabled');

	// FlexSlider setup
	if ($('.flexslider').length && $.isFunction($.fn.flexslider)) {

		$(function() {
			var slider, // Global slider value to force playing and pausing by direct access of the slider control
				canSlide = true; // Global switch to monitor video state

			// Load the YouTube API. For some reason it's required to load it like this
			var tag = document.createElement('script');
			tag.src = "//www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[ 0 ];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			// Setup a callback for the YouTube api to attach video event handlers
			window.onYouTubeIframeAPIReady = function() {
				// Iterate through all videos
				$('.flexslider iframe').each(function() {
					// Create a new player pointer; "this" is a DOMElement of the player's iframe
					var player = new YT.Player(this, {
						playerVars: {
							autoplay: 0
						}
					});

					// Watch for changes on the player
					player.addEventListener("onStateChange", function(state) {
						switch (state.data) {
							// If the user is playing a video, stop the slider
							case YT.PlayerState.PLAYING:
								slider.flexslider("stop");
								canSlide = false;
								break;
							// The video is no longer player, give the go-ahead to start the slider back up
							case YT.PlayerState.ENDED:
							case YT.PlayerState.PAUSED:
								slider.flexslider("play");
								canSlide = true;
								break;
						}
					});

					$(this).data('player', player);
				});
			};

			// Setup the slider control
			slider = $('.flexslider').flexslider({
				animation: "fade",
				easing: "swing",
				slideshowSpeed: 6500,
				animationSpeed: 900,
				pauseOnHover: true,
				pauseOnAction: true,
				touch: true,
				video: true,
				controlNav: true,
				animationLoop: true,
				slideshow: true,
				useCSS: false, // Before you go to change slides, make sure you can!
				before: function() {
					if (!canSlide) {
						slider.flexslider("stop");
					}
				}
			});

			if ($.isFunction($.fn.fitVids)) {
				$('.flexslider').fitVids;
			}

			slider.on("click", ".flex-prev, .flex-next", function() {
				canSlide = true;
				$('.flexslider iframe').each(function() {
					$(this).data('player').pauseVideo();
				});
			});
		});

	} else if ($('.flexslider').length) {
		console.log('Please enable FlexSlider (Settings > Developer Settings > Libraries & Plugins).');
	}

	/**
	 *  Enable Bootstrap tooltips for items with '.tip' class
	 */
	$('.tip').tooltip({
		'container': 'body'
	});

	/**
	 *  Responsive jQuery
	 */

	// viewport width
	var viewport = $(window).width();

	// smaller than 481px
	if (viewport < 481) {

	}

	// larger than 481px
	if (viewport > 481) {

	}

	// larger than or equal to 768px
	if (viewport >= 768) {

		// load gravatars
		$('.comment img[data-gravatar]').each(function() {
			$(this).attr('src', $(this).attr('data-gravatar'));
		});
	}

	// larger than 1030px
	if (viewport > 1030) {

	}

	$(document.body).show();

});
