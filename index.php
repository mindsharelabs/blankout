<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					<header class="article-header">
						<?php //blankout_rich_snippets(); ?>
						<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<p class="byline vcard"><?php _e('Posted', 'blankout'); ?>
							<time class="updated" datetime="<?php echo the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format')); ?></time> <?php _e('by', 'blankout'); ?>
							<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e('filed under', 'blankout'); ?> <?php the_category(', '); ?>.
						</p>
					</header>
					<section class="entry-content clearfix">
						<?php echo mapi_excerpt(); ?>
					</section>
					<footer class="article-footer">
						<?php the_taxonomies('before=<p class="tags">&after=</p>'); ?>
					</footer>

					<?php //comments_template(); ?>
				</article>

			<?php endwhile; ?>

				<?php if(function_exists('blankout_page_nav')) : ?>
					<?php blankout_page_nav(); ?>
				<?php else : ?>
					<nav class="wp-prev-next">
						<ul class="clearfix">
							<li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "blankout")) ?></li>
							<li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "blankout")) ?></li>
						</ul>
					</nav>
				<?php endif; ?>

			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
