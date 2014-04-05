<div class="container">
	<footer class="footer" role="contentinfo">
		<hr />

		<?php if(is_active_sidebar('footer-widgets')) {
			dynamic_sidebar('footer-widgets');
		} ?>

		<nav role="navigation">
			<?php
			if ( has_nav_menu( 'footer-nav' ) ) {

				wp_nav_menu(
					array(
						 'container'       => FALSE, // remove nav container
						 'container_class' => 'footer-nav clearfix',
						 'menu'            => __('Footer Menu', 'blankout'),
						 'menu_class'      => 'nav footer-nav clearfix nav-pills',
						 'theme_location'  => 'footer-nav',
						 'before'          => '',
						 'after'           => '',
						 'link_before'     => '',
						 'link_after'      => '',
						 'depth'           => 1
					)
				); 
			} ?>
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
