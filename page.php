<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> itemscope itemtype="http://schema.org/BlogPosting">
					<header class="article-header page-header">
						<?php if (function_exists('bcn_display')) : ?>
							<ol class="breadcrumb">
								<?php bcn_display_list(); ?>
							</ol>
						<?php endif; ?>
						<h1 class="entry-title page-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					</header>
					<section class="entry-content clearfix" itemprop="articleBody">
						<?php the_content(); ?>
					</section>
					<footer class="article-footer">
						<?php
						wp_link_pages(
							array(
								'next_or_number'   => 'number',
								'nextpagelink'     => __('Next page', 'blankout'),
								'previouspagelink' => __('Previous page', 'blankout'),
								'pagelink'         => '%',
								'echo'             => 1
							)
						);
						?>
						<?php if (function_exists('mapi_edit_link')) {
							echo mapi_edit_link();
						} ?>
					</footer>
				</article>

			<?php endwhile; ?>

			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
