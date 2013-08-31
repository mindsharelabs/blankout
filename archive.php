<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if(is_category()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e("Posts Categorized:", "blankout"); ?></span> <?php single_cat_title(); ?>
				</h1>

			<?php } elseif(is_tag()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e("Posts Tagged:", "blankout"); ?></span> <?php single_tag_title(); ?>
				</h1>

			<?php
			} elseif(is_author()) {
				global $post;
				$author_id = $post->post_author;
				?>
				<h1 class="archive-title h2">
					<span><?php _e("Posts By:", "blankout"); ?></span> <?php echo get_the_author_meta('display_name', $author_id); ?>
				</h1>
			<?php } elseif(is_day()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e("Daily Archives:", "blankout"); ?></span> <?php the_time('l, F j, Y'); ?>
				</h1>

			<?php } elseif(is_month()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e("Monthly Archives:", "blankout"); ?></span> <?php the_time('F Y'); ?>
				</h1>

			<?php } elseif(is_year()) { ?>
				<h1 class="archive-title h2">
					<span><?php _e("Yearly Archives:", "blankout"); ?></span> <?php the_time('Y'); ?>
				</h1>
			<?php } ?>

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					<header class="article-header">
						<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<p class="byline vcard"><?php _e("Posted", "blankout"); ?>
							<time class="updated" datetime="<?php echo the_time('Y-m-d'); ?>"><?php the_time('F jS, Y'); ?></time> <?php _e("by", "blankout"); ?>
							<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&</span> <?php _e("filed under", "blankout"); ?> <?php the_category(', '); ?>.
						</p>
					</header>
					<section class="entry-content clearfix">
						<?php the_post_thumbnail('blankout-thumb-300'); ?>
						<?php the_excerpt(); ?>
					</section>
					<footer class="article-footer">
					</footer>
				</article>

			<?php endwhile; ?>

				<?php blankout_page_nav(); ?>

			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
