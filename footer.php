<div class="container">
	<footer class="footer" role="contentinfo">
		<hr />
		<nav role="navigation">
			<?php wp_nav_menu(
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
					 'fallback_cb'     => 'wp_page_menu'
				)
			); ?>
		</nav>
		<span class="copyright pull-left">
			&copy;<?php echo date('Y'); ?> <a href="<?php echo home_url('/') ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>. <?php _e('All rights reserved', 'blankout'); ?>.
		</span>
		<?php blankout_footer_credit(); ?>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
