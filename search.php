<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<h1 class="archive-title"><span><?php _e('Search Results for', 'blankout'); ?>:</span> <?php the_search_query(); ?></h1>

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

					<?php get_template_part('inc/article-header'); ?>

					<section class="entry-content">
						<?php echo mapi_excerpt(); ?> <?php echo mapi_excerpt_more(); ?>
					</section>

					<?php get_template_part('inc/article-footer'); ?>

				</article>

			<?php endwhile; ?>

				<?php if(function_exists('blankout_page_nav')) : ?>
					<?php blankout_page_nav(); ?>
				<?php else : ?>
					<nav class="wp-prev-next">
						<ul class="clearfix">
							<li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', 'blankout')) ?></li>
							<li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', 'blankout')) ?></li>
						</ul>
					</nav>
				<?php endif; ?>



			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
