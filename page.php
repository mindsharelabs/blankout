<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					<?php get_template_part('inc/article-header'); ?>

					<section class="entry-content clearfix" itemprop="articleBody">
						<?php the_content(); ?>
					</section>

					<?php get_template_part('inc/article-footer'); ?>

				</article>

			<?php endwhile; ?>

			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
