<div class="container">
	<footer class="footer">
		<hr />

		<?php if (is_active_sidebar('footer-widgets')) : dynamic_sidebar('footer-widgets'); endif; ?>

		<nav>
			<?php
			if (has_nav_menu('footer-nav')) {
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
						'depth'           => 1,
					)
				);
			}
			?>
		</nav>
		<div class="copyright pull-left">
			<?php mapi_social_links(); ?>
			&copy;<?php echo date('Y'); ?> <a href="<?php echo home_url('/') ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>. <?php _e('All rights reserved', 'blankout'); ?>.
		</div>
		<div class="pull-right text-center-xs">
			<?php blankout_footer_credit(); ?>
		</div>
	</footer>
</div>

<a href="#top" class="to-top" title="Back to top"><i class="fa fa-chevron-up"></i></a>
<?php wp_footer(); ?>
</body>
</html>
