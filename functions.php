<?php

/**
 * Blankout Theme WordPress Functions File
 *
 */

// uncomment for tilde support in mThumb/TimThumb in the Mindshare Theme API
/*if(!array_key_exists('DOCUMENT_ROOT', $_SERVER) && empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['DOCUMENT_ROOT'] = '/path/to/webroot/';
}*/

// check for dependencies
require_once(dirname(__FILE__).'/inc/dependencies/check.php');

/**
 * Constants
 */
define('BOOTSTRAP_DROPDOWN_ON_HOVER', FALSE); // if TRUE, overrides the default bootstrap behavior where user must click on a top level menu item in order to see subpages

/**
 * Includes
 */
//include(get_stylesheet_directory().'/inc/customize.php'); // enable theme customizer for Blankout (Appearance > Themes)
include(get_stylesheet_directory().'/inc/custom-post-types.php');
//include(get_stylesheet_directory().'/inc/woocommerce.php'); // enable WooCommerce support

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
		load_theme_textdomain('blankout', get_stylesheet_directory().'/translation');
		$locale = get_locale();
		$locale_file = get_stylesheet_directory()."/translation/$locale.php";
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

/**
 * Menus
 */
register_nav_menus(
	array(
		'main-nav'   => __('Main Navigation', 'blankout'), // main nav in header
		'footer-nav' => __('Footer Navigation', 'blankout') // secondary nav in footer
	)
);
if(!is_nav_menu('main-nav')) {
	wp_create_nav_menu('Main Navigation', array('slug' => 'main-nav'));
}
if(!is_nav_menu('footer-nav')) {
	wp_create_nav_menu('Footer Navigation', array('slug' => 'footer-nav'));
}

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
 *
 */
function blankout_configure_mapi() {
	if(function_exists('mapi_update_option')) {
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
 * Load frontend CSS/JS
 *
 */
function blankout_styles() {
	if(!is_admin()) {
		wp_enqueue_style('blankout-stylesheet', get_stylesheet_directory_uri().'/style.css', array(), '', 'all');
	}
}

add_action('wp_enqueue_style', 'blankout_styles', 999);

function blankout_scripts() {
	if(!is_admin()) {

		if(is_singular() && comments_open()) {
			wp_enqueue_script('comment-reply');
		}

		wp_enqueue_script('blankout-js', get_stylesheet_directory_uri().'/js/main.js', array('jquery'), FALSE, TRUE);
		wp_enqueue_style('blankout-stylesheet', get_stylesheet_directory_uri().'/style.css', array(), '', 'all');
	}
}

add_action('wp_enqueue_scripts', 'blankout_scripts', 999);

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
		 * @param array  $args
		 */
		function start_lvl(&$output, $depth = 0, $args = array()) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
		}

		/**
		 * @see      Walker::start_el()
		 * @since    3.0.0
		 *
		 * @param string       $output Passed by reference. Used to append additional content.
		 * @param object       $item   Menu item data object.
		 * @param int          $depth  Depth of menu item. Used for padding.
		 * @param array|object $args
		 * @param int          $id
		 *
		 * @internal param int $current_page Menu item ID.
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
	echo "</ul>".$after;
}

/**
 * Adjust pagination/pager container
 *
 * @param array $args
 *
 * @return array
 */
function blankout_link_pages_args($args) {

	$args['before'] = '<div class="pagination pagination-centered"><ul class="pagination">';
	$args['after'] = '</ul></div>';

	return $args;
}

/**
 * Wrap pagination/pager links in list items
 *
 * @param string $link
 * @param int    $page_number
 *
 * @return string
 */
function blankout_link_pages_link($link, $page_number) {

	global $page, $more;

	// blame core
	$not_current_page = ($page_number != $page);
	$more_front = (empty($more) && 1 == $page);
	if($not_current_page || $more_front) {
		$link = '<li>'.$link.'</li>';
	} else {
		$link = '<li class="active"><span>'.$link.'</span></li>';
	}

	return $link;
}

add_filter('wp_link_pages_args', 'blankout_link_pages_args');
add_filter('wp_link_pages_link', 'blankout_link_pages_link', 10, 2);

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
		<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=48" class="pull-left media-object load-gravatar avatar avatar-48 photo" height="48" width="48" src="<?php echo get_stylesheet_directory_uri(); ?>/img/nothing.gif" />
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
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function _blankout_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;

	if('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>


		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
			<a class="pull-left" href="#comment-<?php comment_ID(); ?>">
				<?php if(0 != $args['avatar_size']) {
					echo get_avatar($comment, $args['avatar_size']);
				} ?>
			</a>

			<div class="media-body">
				<div class="media-body-wrap panel panel-default">
					<div class="panel-heading">
						<h5 class="media-heading"><?php _e('Pingback: ', 'blankout');
							comment_author_link() ?></h5>

						<div class="comment-meta">
							<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
								<time datetime="<?php comment_time('c'); ?>">
									<?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'blankout'), get_comment_date(), get_comment_time()); ?>
								</time>
							</a>
							<?php edit_comment_link(__('<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'blankout'), '<span class="edit-link">', '</span>'); ?>
						</div>
					</div>

					<?php if('0' == $comment->comment_approved) : ?>
						<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'blankout'); ?></p>
					<?php endif; ?>

					<div class="comment-content panel-body">
						<?php comment_text(); ?>
					</div>
					<!-- .comment-content -->

					<?php comment_reply_link(
						array_merge(
							$args, array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<footer class="reply comment-reply panel-footer">',
								'after'     => '</footer><!-- .reply -->'
							)
						)
					); ?>
				</div>
			</div>
			<!-- .media-body -->
		</article><!-- .comment-body -->


	<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
			<a class="pull-left" href="#comment-<?php comment_ID(); ?>">
				<?php if(0 != $args['avatar_size']) {
					echo get_avatar($comment, $args['avatar_size']);
				} ?>
			</a>

			<div class="media-body">
				<div class="media-body-wrap panel panel-default">
					<div class="panel-heading">
						<h5 class="media-heading"><?php printf(__('%s <span class="says">says:</span>', 'blankout'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?></h5>

						<div class="comment-meta">
							<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
								<time datetime="<?php comment_time('c'); ?>">
									<?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'blankout'), get_comment_date(), get_comment_time()); ?>
								</time>
							</a>
							<?php edit_comment_link(__('<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'blankout'), '<span class="edit-link">', '</span>'); ?>
						</div>
					</div>

					<?php if('0' == $comment->comment_approved) : ?>
						<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'blankout'); ?></p>
					<?php endif; ?>

					<div class="comment-content panel-body">
						<?php comment_text(); ?>
					</div>
					<!-- .comment-content -->

					<?php comment_reply_link(
						array_merge(
							$args, array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<footer class="reply comment-reply panel-footer">',
								'after'     => '</footer><!-- .reply -->'
							)
						)
					); ?>
				</div>
			</div>
			<!-- .media-body -->
		</article><!-- .comment-body -->

	<?php
	endif;
}

/**
 * Adds a hidden div with HTML5 Microdata for posts.
 *
 * @see http://support.google.com/webmasters/bin/answer.py?hl=en&answer=99170 for info on rich snippets
 *
 */
function blankout_rich_snippets() {
	if(function_exists('mapi_rich_snippets')) {
		mapi_rich_snippets();
	}
}

/**
 * Optionally displays a credit message in compatible themes when enabled in the Mindshare Theme API
 * (Settings > Developer Settings > Misc. Settings > Show Credit)
 *
 */
function blankout_copyright() {
	if(function_exists('mapi_copyright')) {
		mapi_copyright();
	}
}

/**
 * Optionally displays a credit message in compatible themes when enabled in the Mindshare Theme API
 * (Settings > Developer Settings > Misc. Settings > Show Credit)
 *
 */
function blankout_footer_credit() {
	$host = parse_url(esc_url(home_url()));
	$c = '<p id="credit" class="source-org copyright pull-right"><a class="no-icon tip" href="http://mind.sh/are/?ref='.$host['host'].'" target="_blank" title="Web design, development + SEO by Mindshare Studios"><img src="'.get_stylesheet_directory_uri().'/img/credit.png" alt="Web design, development + SEO by Mindshare Studios" /></a></p>';
	if(function_exists('mapi_get_option')) {
		if(mapi_get_option('show_credit') == TRUE || (array_key_exists('credit', $_GET) && $_GET['credit'] == 1)) {
			echo $c;
		}
	} else {
		if(isset($_GET['credit'])) {
			if($_GET['credit'] == 1) {
				echo $c;
			}
		}
	}
}

/**
 * Open Graph meta tags and language attributes (for IE)
 *
 * @param $output
 *
 * @return string
 */
function blankout_add_opengraph_doctype($output) {
	if(function_exists('mapi_add_opengraph_doctype')) {
		return mapi_add_opengraph_doctype($output);
	}
}

add_filter('language_attributes', 'blankout_add_opengraph_doctype');

/**
 * Adds Facebook Open Graph API stuff to head
 *
 */
function blankout_facebook_head() {
	if(function_exists('mapi_facebook_head')) {
		mapi_facebook_head();
	}
}

add_action('wp_head', 'blankout_facebook_head', 5);

/**
 * Changes the default behavior of Bootstrap dropdown nav menus
 * if the constant BOOTSTRAP_DROPDOWN_ON_HOVER is TRUE.
 *
 */
function blankout_enable_nav_hover() {
	if(function_exists('mapi_is_mobile_device')) {
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
}

// @todo, pretty sure this isn't working
add_filter('image_resize_dimensions', 'blankout_align_cropped_images_top', 11, 6);
function blankout_align_cropped_images_top($payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop) {

	// Change this to a conditional that decides whether you
	// want to override the defaults for this image or not.
	if(FALSE) {
		return $payload;
	}

	if($crop) {
		// crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
		$aspect_ratio = $orig_w / $orig_h;
		$new_w = min($dest_w, $orig_w);
		$new_h = min($dest_h, $orig_h);

		if(!$new_w) {
			$new_w = intval($new_h * $aspect_ratio);
		}

		if(!$new_h) {
			$new_h = intval($new_w / $aspect_ratio);
		}

		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor(($orig_w - $crop_w) / 2);
		$s_y = 0; // [[ formerly ]] ==> floor( ($orig_h - $crop_h) / 2 );
	} else {
		// don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
		$crop_w = $orig_w;
		$crop_h = $orig_h;

		$s_x = 0;
		$s_y = 0;

		//list($new_w, $new_h) = wp_constrain_dimensions($orig_w, $orig_h, $dest_w, $dest_h);
		$new_w = $orig_w;
		$new_h = $orig_h;

	}



	// the return array matches the parameters to imagecopyresampled()
	// int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
	return array(0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h);
}
