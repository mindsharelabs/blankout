<?php
/**
 * Check for dependencies
 */
require_once(dirname(__FILE__) . '/inc/dependencies/check.php');

/**
 * Misc. function includes
 */
require_once get_stylesheet_directory() . '/inc/functions/comments.php';
require_once get_stylesheet_directory() . '/inc/functions/nav.php';
require_once get_stylesheet_directory() . '/inc/functions/opengraph.php';
require_once get_stylesheet_directory() . '/inc/functions/pagination.php';
require_once get_stylesheet_directory() . '/inc/functions/woocommerce.php';
//require_once get_stylesheet_directory().'/inc/functions/mindshare.php';

// Enable Gravity forms CSS styling if CSS is disabled in the plugin settings
if (get_option('rg_gforms_disable_css') == 1) {
	include_once get_stylesheet_directory() . '/inc/functions/gravity-forms.php';
}
// Enable field visibility settings in Gravity Forms
add_filter('gform_enable_field_label_visibility_settings', '__return_true');

/**
 * Facebook app ID for Facebook comments plugin input your
 * app ID to enable Facebook comments, e.g. '13586768111'
 */
define('FB_APP_ID', FALSE);

/**
 * When TRUE, this overrides the default Bootstrap behavior where
 * user must click on a top level menu item in order to see subpages
 */
define('BOOTSTRAP_DROPDOWN_ON_HOVER', FALSE);

/**
 * WordPress theme setup
 */
if (!isset($content_width)) {
	/**
	 * Set content width value based on the Bootstrap grid
	 */
	$content_width = 1170;
}

/**
 * Add theme support for custom CSS in the TinyMCE visual editor
 */
function blankout_add_editor_styles() {
	add_editor_style('css/editor-style.css');
}

add_action('init', 'blankout_add_editor_styles');

if (!function_exists('blankout_theme_features')) {

	// Register Theme Features
	function blankout_theme_features() {

		// Add theme support for WP 4.1+ title tag output style
		add_theme_support('title-tag');

		// Add theme support for Automatic Feed Links
		add_theme_support('automatic-feed-links');

		// Add theme support for Post Formats
		$formats = array(
			'status',
			'quote',
			'gallery',
			'image',
			'video',
			'audio',
			'link',
			'aside',
			'chat',
		);
		//add_theme_support('post-formats', $formats);

		// Add theme support for Featured Images
		add_theme_support('post-thumbnails');

		// Set custom thumbnail dimensions
		set_post_thumbnail_size(125, 125, TRUE);

		// Add theme support for Custom Header
		$header_args = array(
			'default-image'      => '',
			'width'              => 1170,
			'height'             => 480,
			'flex-width'         => TRUE,
			'flex-height'        => TRUE,
			'random-default'     => TRUE,
			'header-text'        => TRUE,
			'default-text-color' => '000',
			'uploads'            => TRUE,

		);
		//add_theme_support('custom-header', $header_args);

		// Add theme support for Semantic Markup
		$markup = array('search-form', 'comment-form', 'comment-list');
		add_theme_support('html5', $markup);

		// Add theme support for Translation
		/*load_theme_textdomain('blankout', get_stylesheet_directory() . '/translation');
		$locale = get_locale();
		$locale_file = get_stylesheet_directory() . "/translation/$locale.php";
		if (is_readable($locale_file)) {
			require_once($locale_file);
		}*/
	}

	// Hook into the 'after_setup_theme' action
	add_action('after_setup_theme', 'blankout_theme_features');
}

/**
 * Menus setup
 */
register_nav_menus(
	array(
		'main-nav'   => __('Main Navigation', 'blankout'), // main nav in header
		'footer-nav' => __('Footer Navigation', 'blankout'), // secondary nav in footer
		'side-nav'   => __('Sidebar Navigation', 'sfcc'), // secondary nav in sidebar
	)
);
//if (!is_nav_menu('main-nav')) { wp_create_nav_menu('Main Navigation'); }

/**
 *  Widget setup
 */
function blankout_widgets_init() {

	register_sidebar(
		array(
			'name'          => __('Main Sidebar', 'blankout'),
			'id'            => 'main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __('Blog Sidebar', 'blankout'),
			'id'            => 'blog-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __('Footer Widgets', 'blankout'),
			'id'            => 'footer-widgets',
			'before_widget' => '<div id="%1$s" class="widget col-lg-4 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		)
	);
}

add_action('widgets_init', 'blankout_widgets_init');

/**
 * Customizing sidebar widgets
 *
 * @param $links
 *
 * @return mixed
 */
function blankout_add_cat_count($links) {
	$links = str_replace('</a> (', '</a> <span class="badge">', $links);
	$links = str_replace(')', '</span>', $links);

	return $links;
}

add_filter('wp_list_categories', 'blankout_add_cat_count');

/**
 * Check for Mindshare Theme API plugin and initialize options
 */
function blankout_configure_mapi() {
	if (function_exists('mapi_update_option')) {
		mapi_update_option('load_bootstrap', TRUE);
		add_action('wp_enqueue_scripts', 'mapi_load_bootstrap');

		mapi_update_option('load_font_awesome', TRUE);
		add_action('wp_enqueue_scripts', 'mapi_load_font_awesome');

		// let's not load Bootstrap CSS twice in the Mindshare Theme API
		mapi_update_option('load_bootstrap_css', FALSE);
	}
}

add_action('wp_loaded', 'blankout_configure_mapi');

/**
 * Remove Mindshare API Social CSS
 */
function blankout_dequeue_social_css() {
	wp_dequeue_style('mapi-social');
}

add_action('wp_enqueue_scripts', 'blankout_dequeue_social_css', 101);

/**
 * Load frontend CSS/JS
 */
function blankout_styles() {
	if (!is_admin()) {
		wp_enqueue_style('blankout-font-stylesheet', '//fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic%7CSource+Code+Pro:400,600,700%7COswald:400,700,300', array(), '', 'all');
		if (get_option('rg_gforms_disable_css') == 1) {
			wp_enqueue_style('blankout-gforms', get_stylesheet_directory_uri() . '/css/gforms-blankout.min.css');
		}
		wp_enqueue_style('blankout-stylesheet', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all');
	}
}

add_action('wp_enqueue_scripts', 'blankout_styles', 999);

/**
 * Enqueue scripts
 */
function blankout_scripts() {
	if (!is_admin()) {

		if (is_singular() && comments_open()) {
			wp_enqueue_script('comment-reply');
		}

		wp_enqueue_script('blankout-js', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), FALSE, TRUE);
	}
}

add_action('wp_enqueue_scripts', 'blankout_scripts', 999);

