<?php
/*
Blankout Theme
Description: An advanced HTML5 theme framework by Mindshare Studios.
Author: Mindshare Studios, Inc
Author URI: http://mind.sh/are/

License: GPLv3
License URI: http://www.gnu.org/licenses/

Tags: html5, microdata, widgets, blank slate, starter theme, minimalist, developer, mindshare, flexble-width, translation-ready, microformats, rtl-language-support, responsive

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

Based loosely on:
	http://themble.com/bones/

Built using:
	jQuery
	LESS CSS
	Mindshare Theme API
	Twitter Bootstrap

*/
// Includes for custom post types
include(get_template_directory().'/inc/carousel-post-type.php');
// include(get_template_directory().'/inc/custom-post-types.php');

// Enables theme customizer for Blankout in Appearance >> Themes
include(get_template_directory().'/inc/customize.php');

//if TRUE, overrides the default bootstrap behavior where user must click on a top level menu item in order to see subpages
define('BOOTSTRAP_DROPDOWN_ON_HOVER', TRUE);

// check for Mindshare Theme API plugin (required)
if(!is_plugin_active('mcms-api/mcms-api.php') && !is_admin()) {
	wp_die('This theme requires the Mindshare Theme API plugin. Luckily, it\'s free, open source and dead easy to get! <br /><br /><strong>Step 1</strong> <a href="http://svn.mindsharestudios.com/mcms-api/mcms-api.zip">Download the zip.</a> <br /><strong>Step 2</strong> <a href="/wp-admin/plugin-install.php?tab=upload">Install and activate.</a>');
}

if(!isset($content_width)) {
	$content_width = 960;
}

// load global theme options
$theme_options = get_theme_mod( 'blankout_options' );

add_action('wp_enqueue_scripts', 'blankout_scripts_and_styles', 999);
add_filter('style_loader_tag', 'blankout_ie_conditional', 10, 2);

// Thumbnail sizes
add_theme_support('post-thumbnails');
set_post_thumbnail_size(125, 125, TRUE);
add_image_size('blankout-thumb-600', 600, 150, TRUE);
add_image_size('blankout-thumb-300', 300, 100, TRUE);

add_theme_support('automatic-feed-links');
add_theme_support('custom-background',
	array(
		 'default-image'          => '', // background image default
		 'default-color'          => '', // background color default (dont add the #)
		 'wp-head-callback'       => '_custom_background_cb',
		 'admin-head-callback'    => '',
		 'admin-preview-callback' => ''
	)
);

// adding post format support
/*add_theme_support('post-formats',
	array(
		 'aside', // title less blurb
		 'gallery', // gallery of images
		 'link', // quick link to other site
		 'image', // an image
		 'quote', // a quick quote
		 'status', // a Facebook like status update
		 'video', // video
		 'audio', // audio
		 'chat' // chat transcript
	)
);*/
function blankout_setup_menus() {
	register_nav_menus(
		array(
			 'main-nav'   => __('Main Navigation', 'blankout'), // main nav in header
			 'footer-nav' => __('Footer Navigation', 'blankout') // secondary nav in footer
		)
	);
}
add_action('init', 'blankout_setup_menus');


register_sidebar(
	array(
		 'name'          => __('Main Sidebar', 'blankout'),
		 'before_widget' => '<li id="%1$s" class="widget %2$s">',
		 'after_widget'  => '</li>',
		 'before_title'  => '<h4 class="widgettitle">',
		 'after_title'   => '</h4>',
	)
);

register_sidebar(
	array(
		 'name'          => __('Blog Sidebar', 'blankout'),
		 'before_widget' => '<li id="%1$s" class="widget %2$s">',
		 'after_widget'  => '</li>',
		 'before_title'  => '<h4 class="widgettitle">',
		 'after_title'   => '</h4>',
	)
);

function add_search_box($items, $args) {
	$form = '<form role="search" class="navbar-search pull-right" method="get" id="searchform" action="'.home_url('/').'" >
	    <input type="text" class="search-query" value="'.get_search_query().'" name="s" id="s" placeholder="'.esc_attr__('Search', 'blankout').'" />
	    </form>';

	$items .= '<li class="pull-right">'.$form.'</li>';

	return $items;
}
if($theme_options['menu_search']) {
//	add_filter('wp_nav_menu_items', 'add_search_box', 10, 2);
}

function blankout_scripts_and_styles() {
	if(!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script('blankout-modernizr', get_stylesheet_directory_uri().'/js/libs/modernizr.custom.min.js', array(), '2.6.2'); // @todo MOVE TO PLUGIN
		wp_register_script('bootstrap-js', get_stylesheet_directory_uri().'/js/libs/bootstrap-ck.js', array('jquery'));
		wp_register_script('blankout-js', get_stylesheet_directory_uri().'/js/main.js', array('jquery'));

		wp_register_style('bootstrap-stylesheet', get_stylesheet_directory_uri().'/css/bootstrap.css', array(), '', 'all');

		if(is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}

		wp_enqueue_script('blankout-modernizr');
		wp_enqueue_script('bootstrap-js');
		wp_enqueue_script('blankout-js');
		
		wp_enqueue_style('bootstrap-stylesheet');
		
	}
}

// adding conditional wrapper around ie stylesheet, source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function blankout_ie_conditional($tag, $handle) {
	if('blankout-ie-only' == $handle) {
		$tag = '<!--[if lt IE 9]>'."\n".$tag.'<![endif]-->'."\n";
	}
	return $tag;
}

function blankout_main_nav() {
	if ( has_nav_menu( 'main-nav' ) ) {
		wp_nav_menu(
			array(
				 'container'       => ' ',
				 'container_class' => 'nav',
				 'menu'            => 'main-nav',
				 'menu_class'      => 'nav navbar-nav',
				 'theme_location'  => 'main-nav',
				 'depth'           => '2',
				 'walker'          => new Bootstrap_Menu_Walker()
			)
		);
	}
}

function blankout_footer_nav() {
	wp_nav_menu(
		array(
			 'container'       => '', // remove nav container
			 'container_class' => 'footer-nav clearfix', // class of container (should you choose to use it)
			 'menu'            => __('Footer Menu', 'blankout'), // nav name
			 'menu_class'      => 'nav footer-nav clearfix nav-pills', // adding custom nav class
			 'theme_location'  => 'footer-nav', // where it's located in the theme
			 'before'          => '', // before the menu
			 'after'           => '', // after the menu
			 'link_before'     => '', // before each link
			 'link_after'      => '', // after each link
			 'depth'           => 1, // limit the depth of the nav
			 //'fallback_cb'     => 'blankout_footer_nav_fallback' // fallback function
		)
	);
}

function add_active_class($classes, $item) {
	if($item->menu_item_parent == 0 && in_array('current-menu-item', $classes)) {
		$classes[] = "active";
	}
	return $classes;
}

add_filter('nav_menu_css_class', 'add_active_class', 10, 2);

if(!class_exists('Bootstrap_Menu_Walker')) {
	class Bootstrap_Menu_Walker extends Walker_Nav_Menu {
	/**
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		function start_lvl( &$output, $depth ) {
			$indent = str_repeat( "\t", $depth );
			$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";		
		}

		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			/**
			 * Dividers & Headers
		     * ==================
			 * Determine whether the item is a Divider, Header, or regular menu item.
			 * To prevent errors we use the strcasecmp() function to so a comparison
			 * that is not case sensitive. The strcasecmp() function returns a 0 if 
			 * the strings are equal.
			 */
			if (strcasecmp($item->title, 'divider') == 0) {
				// Item is a Divider
				$output .= $indent . '<li class="divider">';
			} else if (strcasecmp($item->title, 'divider-vertical') == 0) {
				// Item is a Vertical Divider
				$output .= $indent . '<li class="divider-vertical">';
			} else if (strcasecmp($item->title, 'nav-header') == 0) {
				// Item is a Header
				$output .= $indent . '<li class="nav-header">' . esc_attr( $item->attr_title );
			} else {

				$class_names = $value = '';
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = ($item->current) ? 'active' : '';
				$classes[] = 'menu-item-' . $item->ID;
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

				if ($args->has_children && $depth > 0) {
					$class_names .= ' dropdown-submenu';
				} else if($args->has_children && $depth === 0) {
					$class_names .= ' dropdown';
				}

				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names .'>';

				$attributes = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' data-toggle="dropdown" data-target="#" class="dropdown-toggle"' : '';

				$item_output = $args->before;

				/**
				 * Glyphicons
				 * ===========
				 * Since the the menu item is NOT a Divider or Header we check the see
				 * if there is a value in the attr_title property. If the attr_title
				 * property is NOT null we apply it as the class name for the glyphicon.
				 */
				if(! empty( $item->attr_title )){
					$item_output .= '<a'. $attributes .'><i class="' . esc_attr( $item->attr_title ) . '"></i>&nbsp;';
				} else {
					$item_output .= '<a'. $attributes .'>';
				}

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ($args->has_children && $depth == 0) ? ' <span class="caret"></span></a>' : '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth. 
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element Data object
		 * @param array $children_elements List of elements to continue traversing.
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args
		 * @param string $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */

		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
	        if ( !$element ) {
	            return;
	        }

	        $id_field = $this->db_fields['id'];

	        //display this element
	        if ( is_object( $args[0] ) ) {
	           $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
	        }

	        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}
	}
}

function blankout_page_nav($before = '<div class="pagination pagination-centered">', $after = '</div>') {
	global $wp_query; // $wpdb
	//$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if($numposts <= $posts_per_page) {
		return;
	}
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before."<ul class='pagination'>";
	if($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = "First";
		echo '<li class="bpn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
	}
	if($paged <= 1) {
		echo '<li class="disabled"><span>&laquo;</span></li>';
	} else {
		echo '<li class="bpn-prev-link">';
		echo previous_posts_link('&laquo;');
		echo '</li>';
	}
	for($i = $start_page; $i <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="disabled"><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="bpn-next-link">';
	next_posts_link('&raquo;');
	echo '</li>';
	if($end_page < $max_page) {
		$last_page_text = "Last";
		echo '<li class="bpn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
	}
	echo $after."</ul>";
}

// Adding Translation Option
load_theme_textdomain('blankout', get_template_directory().'/translation');
$locale = get_locale();
$locale_file = get_template_directory()."/translation/$locale.php";
if(is_readable($locale_file)) {
	require_once($locale_file);
}

// wp_list_comments callback
function blankout_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
<div <?php comment_class("media"); ?>>
	<article id="comment-<?php comment_ID(); ?>" class="clearfix">
		<header class="comment-author vcard">
			<?php

			$bgauthemail = get_comment_author_email();
			?>
			<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=48" class="load-gravatar avatar avatar-48 photo pull-left" height="48" width="48" src="<?php echo get_template_directory_uri(); ?>/img/nothing.gif" />

			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
			<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
			<?php edit_comment_link(__('Edit', 'blankout'), '', '') ?>
		</header>
		<?php if($comment->comment_approved == '0') : ?>
		<div class="alert info">
			<p><?php _e('Your comment is awaiting moderation.', 'blankout') ?></p>
		</div>
		<?php endif; ?>
		<section class="comment_content clearfix">
			<?php comment_text() ?>
		</section>
		<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</article>
</div>
<?php
}

// @see http://support.google.com/webmasters/bin/answer.py?hl=en&answer=99170 for info on rich snippets
function blankout_rich_snippets() {
	if(function_exists('mapi_option')) {
		?>
	<div itemscope itemtype="http://data-vocabulary.org/Organization" class="microdata-meta contact">
		<meta itemprop="name" content="<?php mapi_option('sitename_txt'); ?>" />
		<meta itemprop="tel" content="<?php mapi_option('phone_txt'); ?>" />
		<meta itemprop="email" content="<?php mapi_option('email'); ?>" />
		<meta itemprop="url" content="<?php echo home_url(); ?>" />
		<address itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">
			<span itemprop="street-address"><?php mapi_option('addr1_txt'); ?> <?php mapi_option('addr2_txt'); ?></span> <span itemprop="locality"><?php mapi_option('city_txt'); ?></span>
			<span itemprop="region"><?php mapi_option('state'); ?></span> <span itemprop="postal-code"><?php mapi_option('zip_txt'); ?></span>
		</address>
			<span itemprop="geo" itemscope itemtype="http://data-vocabulary.org/Geo">
				<meta itemprop="latitude" content="<?php mapi_option('lat_txt'); ?>" />
				<meta itemprop="longitude" content="<?php mapi_option('long_txt'); ?>" />
			</span>
	</div>
	<?php
	}
}

function blankout_copyright() {
	echo '<!--compression-none-->';
	echo '<!-- Copyright '.date('Y').' '.get_bloginfo('name').' -->';
	$c = 'PCEtLSBXZWIgZGVzaWduLCBkZXZlbG9wbWVudCwgYW5kIFNFTyBieSBodHRwOi8vbWluZC5zaC9hcmUvIC0tPgoJPG1ldGEgbmFtZT0iYXV0aG9yIiBjb250ZW50PSJNaW5kc2hhcmUgU3R1ZGlvcywgSW5jLiIgLz4KCQ==';
	if($_GET['credit'] == 1) {
		echo base64_decode($c);
	} elseif(function_exists('mapi_get_option')) {
		if(mapi_get_option('show_credit') == TRUE || $_GET['credit'] == 1) {
			echo base64_decode($c);
		}
	}
	echo '<!--compression-none-->';
}

function blankout_footer_credit() {
	$cc = 'V2Vic2l0ZSBkZXNpZ24sIGRldmVsb3BtZW50LCBhbmQgU0VPIGJ5IE1pbmRzaGFyZSBTdHVkaW9zLCBJbmM=';
	$host = parse_url(get_bloginfo('url'));
	$c = '<span class="copyright pull-left">Copyright &copy; '.date('Y').' '.get_bloginfo('name').'</span><p id="credit" class="source-org copyright pull-right"><a class="no-icon" href="http://mind.sh/are/?ref='.$host['host'].'" target="_blank" title="'.base64_decode($cc).'"><img src="'.get_bloginfo('template_directory').'/img/credit.png" alt="'.base64_decode($cc).'" /></a></p>';
	if(function_exists('mapi_get_option')) {
		if(mapi_get_option('show_credit') == TRUE || $_GET['credit'] == 1) {
			echo $c;
		}
	} else {
		if($_GET['credit'] == 1) {
			echo $c;
		}
	}
}

// ACF setup
function blankout_acf_settings($options) {
	$options = array(
		'options_page'     => array(
			'capability' => 'edit_theme_options', // capability to view options page
			'title'      => __('Global Options', 'acf'),
			'pages'      => array(), // an array of sub pages ('Header, Footer, Home, etc')
		),
		'activation_codes' => array(
			'repeater'         => 'QJF7-L4IX-UCNP-RF2W',
			'options_page'     => 'OPN8-FA4J-Y2LW-81LS',
			'flexible_content' => 'FC9O-H6VN-E4CL-LT33',
			'gallery'          => 'GF72-8ME6-JS15-3PZC',
		),
	);
	return $options;
}

add_filter('acf_settings', 'blankout_acf_settings');

function blankout_enable_nav_hover() {
	if(!mapi_is_mobile_device() && BOOTSTRAP_DROPDOWN_ON_HOVER) {
		?>
	<style type="text/css">
		ul.nav li.dropdown:hover ul.dropdown-menu {
			display:block;
			margin:0;
		}
		a.menu:after, .dropdown-toggle:after {
			content:none;
		}
	</style>
	<?php
	}
}
