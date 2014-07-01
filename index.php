<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					<header class="article-header post-header">
						<h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<small class="byline vcard"><?php _e("Posted", 'blankout'); ?>
							<time class="updated" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format', 'l, F j, Y')); ?></time> <?php _e("by", 'blankout'); ?>
							<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", 'blankout'); ?> <?php the_category(', '); ?>.
						</small>
					</header>
					<section class="entry-content clearfix">
						<?php if(function_exists('mapi_excerpt')) {
							echo mapi_excerpt().mapi_excerpt_more();
						} ?>
					</section>

					<?php get_template_part('inc/article-footer'); ?>

					<?php if(comments_open()) {
						comments_template();
					} ?>
				</article>

			<?php endwhile; ?>

				<?php blankout_page_nav(); ?>

			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
