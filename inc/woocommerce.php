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

add_action('woocommerce_before_main_content', 'blankout_woo_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'blankout_woo_wrapper_end', 10);

/**
 * Adds Blankout code to Woo loop start
 *
 */
function blankout_woo_wrapper_start() {
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/Product">
	<?php get_template_part('inc/article-header'); ?>
	<section class="entry-content clearfix" itemprop="articleBody">
<?php
}

/**
 * Adds Blankout code to Woo loop end
 */
function blankout_woo_wrapper_end() {
	?>
	</section>
	<?php get_template_part('inc/article-footer'); ?>
	</article>
<?php
}
