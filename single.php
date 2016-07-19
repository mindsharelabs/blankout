<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> itemscope itemtype="http://schema.org/BlogPosting">
					<header class="article-header page-header">
						<h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<small class="byline vcard"><?php _e("Posted", 'blankout'); ?>
							<time class="updated" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format', 'l, F j, Y')); ?></time> <?php _e("by", 'blankout'); ?>
							<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", 'blankout'); ?> <?php the_category(', '); ?>.
						</small>
					</header>
					<section class="entry-content clearfix" itemprop="articleBody">
						<?php if (has_post_thumbnail()) : ?>
							<?php
							mapi_featured_img(
								array(
									'w'     => 'auto',
									'h'     => get_option('medium_size_h', 125),
									'class' => 'aligncenter mapi-featured-img',

								)
							);
							?>
						<?php endif; ?>
						<?php the_content(); ?>
					</section>
					<footer class="article-footer">
						<?php the_taxonomies('before=<p class="tags">&after=</p>&template=%s: %l'); ?>
						<?php
						wp_link_pages(
							array(
								'next_or_number'   => 'number',
								'nextpagelink'     => __('Next page', 'blankout'),
								'previouspagelink' => __('Previous page', 'blankout'),
								'pagelink'         => '%',
								'echo'             => 1,
							)
						);
						?>
						<?php if (function_exists('mapi_edit_link')) {
							echo mapi_edit_link();
						} ?>
					</footer>

					<?php

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) {
						comments_template();
					}
					?>
				</article>

			<?php endwhile; ?>
			<?php endif; ?>
			<?php blankout_nav_below(); ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
