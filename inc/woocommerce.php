<?php
/**
 * WooCommerce Hooks for Blankout
 *
 * @created   11/7/13 10:17 AM
 * @author    Mindshare Studios, Inc.
 * @copyright Copyright (c) 2013
 * @link      http://www.mindsharelabs.com/documentation/
 *
 */

add_theme_support('woocommerce');

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// outer wrapper
add_action('woocommerce_before_main_content', 'blankout_woo_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'blankout_woo_wrapper_end', 10);

// item wrapper
//add_action('woocommerce_before_shop_loop_item', 'blankout_woo_item_start', 10);
//add_action('woocommerce_after_shop_loop_item', 'blankout_woo_item_end', 10);

/**
 * Adds Blankout code to Woo loop start
 */
function blankout_woo_wrapper_start() {
	?>
	<div class="container">
	<div class="row">
	<div id="main" class="col-lg-12">
<?php
}

/**
 * Adds Blankout code to Woo loop end
 */
function blankout_woo_wrapper_end() {
	?>
	</div>
	<?php //get_sidebar(); ?>
	</div>
	</div>
<?php
}

/**
 * Adds Blankout code to Woo item start
 *
 */
function blankout_woo_item_start() {
	// add any extra code to insert before each product here
}

/**
 * Adds Blankout code to Woo item end
 */
function blankout_woo_item_end() {
	// add any extra code to insert after each product here
}
