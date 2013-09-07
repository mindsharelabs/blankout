<?php
/**
 * Blankout Theme WordPress Functions File
 *
 */

include(get_template_directory().'/inc/customize.php'); // enable theme customizer for Blankout (Appearance > Themes)
include(get_template_directory().'/inc/carousel-post-type.php');

/**
 * if TRUE, overrides the default bootstrap behavior where user must click on a top level menu item in order to see subpages
 */
define('BOOTSTRAP_DROPDOWN_ON_HOVER', FALSE);

/**
 * WordPress setup
 */
// Set content width value based on the theme's design
if(!isset($content_width)) {
	$content_width = 1170;
}

if(!function_exists('blankout_theme_features')) {

	// Register Theme Features
	function blankout_theme_features() {

		// Add theme support for Automatic Feed Links
		add_theme_support('automatic-feed-links');

		// Add theme support for Post Formats
		$formats = array('status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat',);
		//add_theme_support('post-formats', $formats);

		// Add theme support for Featured Images
		add_theme_support('post-thumbnails');

		// Set custom thumbnail dimensions
		set_post_thumbnail_size(125, 125, TRUE);

		// Add theme support for Custom Background
		$background_args = array(
			'default-color'          => 'ffffff',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support('custom-background', $background_args);

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
		load_theme_textdomain('blankout', get_template_directory().'/translation');
		$locale = get_locale();
		$locale_file = get_template_directory()."/translation/$locale.php";
		if(is_readable($locale_file)) {
			require_once($locale_file);
		}
	}

	// Hook into the 'after_setup_theme' action
	add_action('after_setup_theme', 'blankout_theme_features');
}

// Add theme support for custom CSS in the TinyMCE visual editor
function blankout_add_editor_styles() {
	add_editor_style('css/editor-style.css');
}

add_action('init', 'blankout_add_editor_styles');

register_nav_menus(
	array(
		 'main-nav'   => __('Main Navigation', 'blankout'), // main nav in header
		 'footer-nav' => __('Footer Navigation', 'blankout') // secondary nav in footer
	)
);

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
 *
 */
function blankout_configure_mapi() {
	if(!is_plugin_active('mcms-api/mcms-api.php') && !is_admin()) {
		wp_die('This theme requires the Mindshare Theme API plugin. Luckily, it\'s free, open source and dead easy to get! <br /><br /><strong>Step 1</strong> <a href="http://svn.mindsharestudios.com/mcms-api/mcms-api.zip">Download the zip.</a> <br /><strong>Step 2</strong> <a href="/wp-admin/plugin-install.php?tab=upload">Install and activate.</a>');
	}
	if(function_exists('mapi_update_option')) {
		mapi_update_option('load_bootstrap', TRUE);
		mapi_update_option('load_modernizr_js', TRUE);
		// let's not load Bootstrap CSS twice in the Mindshare Theme API
		mapi_get_option('load_bootstrap_css', FALSE);
	}
}

add_action('init', 'blankout_configure_mapi');

/**
 * Load frontend CSS/JS
 *
 */
function blankout_scripts_and_styles() {
	if(!is_admin()) { // @todo... Bryce, is this needed?

		wp_register_script('blankout-js', get_stylesheet_directory_uri().'/js/main.js', array('jquery'));
		wp_enqueue_script('blankout-js');

		wp_register_style('bootstrap-stylesheet', get_stylesheet_directory_uri().'/css/bootstrap.css', array(), '', 'all');
		wp_enqueue_style('bootstrap-stylesheet');
	}
}

add_action('wp_enqueue_scripts', 'blankout_scripts_and_styles'); // @todo priority was set to 999 .. why?

/**
 * @param $classes
 * @param $item
 *
 * @return array
 */
function blankout_add_active_class($classes, $item) {
	if($item->menu_item_parent == 0 && in_array('current-menu-item', $classes)) {
		$classes[] = "active";
	}
	return $classes;
}

add_filter('nav_menu_css_class', 'blankout_add_active_class', 10, 2);

if(!class_exists('Blankout_Menu_Walker')) {
	/**
	 * Class Blankout_Menu_Walker
	 */
	class Blankout_Menu_Walker extends Walker_Nav_Menu {
		/**
		 * @see   Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of page. Used for padding.
		 */
		function start_lvl(&$output, $depth = 0, $args = array()) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
		}

		/**
		 * @see   Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output       Passed by reference. Used to append additional content.
		 * @param object $item         Menu item data object.
		 * @param int    $depth        Depth of menu item. Used for padding.
		 * @param int    $current_page Menu item ID.
		 * @param object $args
		 */

		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			global $wp_query;
			$indent = ($depth) ? str_repeat("\t", $depth) : '';

			/**
			 * Dividers & Headers
			 * ==================
			 * Determine whether the item is a Divider, Header, or regular menu item.
			 * To prevent errors we use the strcasecmp() function to so a comparison
			 * that is not case sensitive. The strcasecmp() function returns a 0 if
			 * the strings are equal.
			 */
			if(strcasecmp($item->title, 'divider') == 0) {
				// Item is a Divider
				$output .= $indent.'<li class="divider">';
			} else {
				if(strcasecmp($item->title, 'divider-vertical') == 0) {
					// Item is a Vertical Divider
					$output .= $indent.'<li class="divider-vertical">';
				} else {
					if(strcasecmp($item->title, 'nav-header') == 0) {
						// Item is a Header
						$output .= $indent.'<li class="nav-header">'.esc_attr($item->attr_title);
					} else {

						$class_names = $value = '';
						$classes = empty($item->classes) ? array() : (array) $item->classes;
						$classes[] = ($item->current) ? 'active' : '';
						$classes[] = 'menu-item-'.$item->ID;
						$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

						if($args->has_children && $depth > 0) {
							$class_names .= ' dropdown-submenu';
						} else {
							if($args->has_children && $depth === 0) {
								$class_names .= ' dropdown';
							}
						}

						$class_names = $class_names ? ' class="'.esc_attr($class_names).'"' : '';

						$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
						$id = $id ? ' id="'.esc_attr($id).'"' : '';

						$output .= $indent.'<li'.$id.$value.$class_names.'>';

						$attributes = !empty($item->target) ? ' target="'.esc_attr($item->target).'"' : '';
						$attributes .= !empty($item->xfn) ? ' rel="'.esc_attr($item->xfn).'"' : '';
						$attributes .= !empty($item->url) ? ' href="'.esc_attr($item->url).'"' : '';
						$attributes .= ($args->has_children) ? ' data-toggle="dropdown" data-target="#" class="dropdown-toggle"' : '';

						$item_output = $args->before;

						/**
						 * Glyphicons
						 * ===========
						 * Since the the menu item is NOT a Divider or Header we check the see
						 * if there is a value in the attr_title property. If the attr_title
						 * property is NOT null we apply it as the class name for the glyphicon.
						 */
						if(!empty($item->attr_title)) {
							$item_output .= '<a'.$attributes.'><i class="'.esc_attr($item->attr_title).'"></i>&nbsp;';
						} else {
							$item_output .= '<a'.$attributes.'>';
						}

						$item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
						$item_output .= ($args->has_children && $depth == 0) ? ' <span class="caret"></span></a>' : '</a>';
						$item_output .= $args->after;

						$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
					}
				}
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
		 * @see   Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element           Data object
		 * @param array  $children_elements List of elements to continue traversing.
		 * @param int    $max_depth         Max depth to traverse.
		 * @param int    $depth             Depth of current element.
		 * @param array  $args
		 * @param string $output            Passed by reference. Used to append additional content.
		 *
		 * @return null Null on failure with no changes to parameters.
		 */

		function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
			if(!$element) {
				return;
			}

			$id_field = $this->db_fields['id'];

			//display this element
			if(is_object($args[0])) {
				$args[0]->has_children = !empty($children_elements[$element->$id_field]);
			}

			parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}
	}
}

/**
 * @param string $before
 * @param string $after
 */
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
		previous_posts_link('&laquo;');
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

/**
 * wp_list_comments callback
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function blankout_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$bgauthemail = get_comment_author_email(); ?>
	<article id="comment-<?php comment_ID(); ?>" <?php comment_class("media clearfix"); ?>>
		<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=48" class="pull-left media-object load-gravatar avatar avatar-48 photo" height="48" width="48" src="<?php echo get_template_directory_uri(); ?>/img/nothing.gif" />
		<header class="comment-author vcard">
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
			<time datetime="<?php comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
			<?php edit_comment_link(__('Edit', 'blankout'), '<button class="btn btn-default btn-xs">', '</button>') ?>
		</header>
		<?php if($comment->comment_approved == '0') : ?>
			<div class="alert info">
				<p><?php _e('Your comment is awaiting moderation.', 'blankout') ?></p>
			</div>
		<?php endif; ?>
		<section class="comment_content media-body clearfix">
			<?php comment_text() ?>
			<button class="btn btn-primary btn-sm"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></button>
		</section>
	</article>
<?php
}

/**
 * Adds a hidden div with HTML5 Microdata for posts.
 *
 * @see http://support.google.com/webmasters/bin/answer.py?hl=en&answer=99170 for info on rich snippets
 *
 */
function blankout_rich_snippets() {
	if(function_exists('mapi_option')) : ?>
		<div itemscope itemtype="http://data-vocabulary.org/Organization" class="microdata-meta hide contact">
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
	<?php endif;
}

/**
 * Optionally displays a credit message in compatible themes when enabled in the Mindshare Theme API
 * (Settings > Developer Settings > Misc. Settings > Show Credit)
 *
 * @todo Move to API
 */
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

/**
 * Optionally displays a credit message in compatible themes when enabled in the Mindshare Theme API
 * (Settings > Developer Settings > Misc. Settings > Show Credit)
 *
 * @todo Move to API
 */
function blankout_footer_credit() {
	$cc = 'V2Vic2l0ZSBkZXNpZ24sIGRldmVsb3BtZW50LCBhbmQgU0VPIGJ5IE1pbmRzaGFyZSBTdHVkaW9zLCBJbmM=';
	$host = parse_url(get_bloginfo('url'));
	$c = '<p id="credit" class="source-org copyright pull-right"><a class="no-icon" href="http://mind.sh/are/?ref='.$host['host'].'" target="_blank" title="'.base64_decode($cc).'"><img src="'.get_template_directory_uri().'/img/credit.png" alt="'.base64_decode($cc).'" /></a></p>';
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

/**
 * Open Graph meta tags and language attributes (for IE)
 *
 * @todo Move to API or possibly delete?
 *
 * @param $output
 *
 * @return string
 */
function blankout_add_opengraph_doctype($output) {
	return $output.' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}

add_filter('language_attributes', 'blankout_add_opengraph_doctype');

/**
 * Adds Facebook Open Graph API stuff to head
 *
 */
function blankout_facebook_head() {
	if(is_singular()) : ?>
		<meta property="fb:admins" content="<?php mapi_facebook_id(); ?>" />
		<meta property="og:title" content="<?php echo get_the_title_rss(); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php the_permalink_rss(); ?>" />
		<meta property="og:site_name" content="<?php bloginfo_rss('name'); ?>" />
		<?php if(!has_post_thumbnail(get_the_ID())) : // the post does not have featured image, use a default image ?>
			<meta property="og:image" content="<?php echo get_template_directory_uri().'/img/nothumb.gif'; ?>" />
		<?php else : ?>
			<meta property="og:image" content="<?php echo esc_attr(mapi_get_attachment_image_src(NULL, 'medium')); ?>" />
		<?php endif; ?>
	<?php endif;
}

add_action('wp_head', 'blankout_facebook_head', 5);

/**
 * Changes the default behavior of Bootstrap dropdown nav menus
 * if the constant BOOTSTRAP_DROPDOWN_ON_HOVER is TRUE.
 *
 */
function blankout_enable_nav_hover() {
	if(!mapi_is_mobile_device() && BOOTSTRAP_DROPDOWN_ON_HOVER) : ?>
		<style type="text/css">
			ul.nav li.dropdown:hover ul.dropdown-menu {
				display:block;
				margin:0;
			}
			a.menu:after, .dropdown-toggle:after {
				content:none;
			}
		</style>
	<?php endif;
}
