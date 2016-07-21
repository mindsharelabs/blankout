<?php
/**
 * nav.php
 *
 * @created   7/19/16 3:53 PM
 * @author    Mindshare Labs, Inc.
 * @copyright Copyright (c) 2006-2016
 * @link      https://mindsharelabs.com/
 */

/**
 * Changes the default behavior of Bootstrap dropdown nav menus
 * if the constant BOOTSTRAP_DROPDOWN_ON_HOVER is TRUE.

 */
function blankout_enable_nav_hover() {
	if (function_exists('mapi_is_mobile_device')) {
		if (!mapi_is_mobile_device() && BOOTSTRAP_DROPDOWN_ON_HOVER) : ?>
			<style type="text/css">
				ul.nav li.dropdown:hover ul.dropdown-menu {
					display: block;
					margin:  0;
				}

				a.menu:after, .dropdown-toggle:after {
					content: none;
				}
			</style>
		<?php endif;
	}
}

/**
 * Adds a Bootstrap pager nav to various WP templates.
 */
function blankout_nav_above() {
	blankout_nav('above');
}

/**
 * Adds a Bootstrap pager nav to various WP templates.
 */
function blankout_nav_below() {
	blankout_nav();
}

/**
 * Adds a Bootstrap pager nav to various WP templates.
 *
 * @param string $position
 */
function blankout_nav($position = 'below') {
	?>
	<div id="nav-<?php echo $position; ?>" class="<?php echo get_post_type(); ?>-navigation">
		<h5 class="sr-only"><?php echo ucwords(get_post_type()); ?><?php _e('navigation', 'blankout'); ?></h5>
		<ul class="pager">
			<?php if (is_singular()) : ?>
				<li class="nav-previous"><?php next_post_link('%link', '&lsaquo; %title', TRUE) ?></li>
				<li class="nav-next"><?php previous_post_link('%link', '%title &rsaquo;', TRUE) ?></li>
			<?php elseif (is_search()) : ?>
				<?php if (get_next_posts_link('Previous Results')) : ?>
					<li class="nav-previous"><?php next_posts_link('Previous Results') ?></li>
				<?php endif; ?>
				<?php if (get_previous_posts_link('More Results')) : ?>
					<li class="nav-next"><?php previous_posts_link('More Results') ?></li>
				<?php endif; ?>
			<?php else : ?>
				<?php if (get_next_posts_link('Previous Entries')) : ?>
					<li class="nav-previous"><?php next_posts_link('Previous Entries') ?></li>
				<?php endif; ?>
				<?php if (get_previous_posts_link('Next Entries')) : ?>
					<li class="nav-next"><?php previous_posts_link('Next Entries') ?></li>
				<?php endif; ?>
			<?php endif; ?>
		</ul>
	</div>
	<?php
}


/**
 * Adds a login/out link to a specific wp_nav_menu.
 *
 * @param $items string The menu HTML.
 * @param $args  object Menu settings object.
 * @usage <code>add_filter('wp_nav_menu_items', 'blankout_add_loginout_nav', 10, 2);</code>
 *
 * @return string
 */
function blankout_add_loginout_nav($items, $args) {

	$target_menu_slug = apply_filters('blankout_add_loginout_nav_slug', 'footer-nav');

	if ($args->menu && $args->menu == $target_menu_slug) {
		$items .= '<li id="menu-item-loginout" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-loginout">' . wp_loginout('', FALSE) . '</li>';
	}

	return $items;
}

add_filter('wp_nav_menu_items', 'blankout_add_loginout_nav', 10, 2);

if (!class_exists('Blankout_Menu_Walker')) {
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
			if (strcasecmp($item->title, 'divider') == 0) {
				// Item is a Divider
				$output .= $indent . '<li class="divider">';
			} else {
				if (strcasecmp($item->title, 'divider-vertical') == 0) {
					// Item is a Vertical Divider
					$output .= $indent . '<li class="divider-vertical">';
				} else {
					if (strcasecmp($item->title, 'nav-header') == 0) {
						// Item is a Header
						$output .= $indent . '<li class="nav-header">' . esc_attr($item->attr_title);
					} else {

						$class_names = $value = '';
						$classes = empty($item->classes) ? array() : (array) $item->classes;
						$classes[] = ($item->current) ? 'active' : '';
						$classes[] = 'menu-item-' . $item->ID;
						$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

						if ($args->has_children && $depth > 0) {
							$class_names .= ' dropdown-submenu';
						} else {
							if ($args->has_children && $depth === 0) {
								$class_names .= ' dropdown';
							}
						}

						$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

						$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
						$id = $id ? ' id="' . esc_attr($id) . '"' : '';

						$output .= $indent . '<li' . $id . $value . $class_names . '>';

						$attributes = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
						$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
						$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
						$attributes .= ($args->has_children) ? ' data-toggle="dropdown" data-target="#" class="dropdown-toggle"' : '';

						$item_output = $args->before;

						/**
						 * Glyphicons
						 * ===========
						 * Since the the menu item is NOT a Divider or Header we check the see
						 * if there is a value in the attr_title property. If the attr_title
						 * property is NOT null we apply it as the class name for the glyphicon.
						 */
						if (!empty($item->attr_title)) {
							$item_output .= '<a' . $attributes . '><i class="' . esc_attr($item->attr_title) . '"></i>&nbsp;';
						} else {
							$item_output .= '<a' . $attributes . '>';
						}

						$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
						$item_output .= ($args->has_children && $depth == 0) ? ' <span class="caret"></span></a>' : '</a>';
						$item_output .= $args->after;

						$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
					}
				}
			}
		}

		/**
		 * Traverse elements to create list from elements.
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
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
			if (!$element) {
				return;
			}

			$id_field = $this->db_fields[ 'id' ];

			//display this element
			if (is_object($args[ 0 ])) {
				$args[ 0 ]->has_children = !empty($children_elements[ $element->$id_field ]);
			}

			parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}
	}
}

/**
 * Adds an CSS class 'active' to menu items.
 *
 * @param $classes
 * @param $item
 *
 * @return array
 */
function blankout_add_active_class($classes, $item) {
	if ($item->menu_item_parent == 0 && in_array('current-menu-item', $classes)) {
		$classes[] = "active";
	}

	return $classes;
}

add_filter('nav_menu_css_class', 'blankout_add_active_class', 10, 2);
