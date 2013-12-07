<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<h1 class="archive-title"><span><?php _e('Search Results for', 'blankout'); ?>:</span> <?php the_search_query(); ?></h1>

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

					<header class="article-header page-header">
						<h1 class="entry-title page-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<small class="byline vcard"><?php _e("Posted", 'blankout'); ?>
							<time class="updated" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format', 'l, F j, Y')); ?></time> <?php _e("by", 'blankout'); ?>
							<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", 'blankout'); ?> <?php the_category(', '); ?>.
						</small>
					</header>

					<section class="entry-content">
						<?php echo mapi_excerpt(); ?> <?php echo mapi_excerpt_more(); ?>
					</section>

					<footer class="article-footer"></footer>

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
