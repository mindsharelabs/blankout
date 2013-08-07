<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<h1 class="archive-title"><span>Search Results for:</span> <?php echo esc_attr(get_search_query()); ?></h1>

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				<header class="article-header">
					<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<p class="byline vcard"><?php _e("Posted", "blankout"); ?>
						<time class="updated" datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "blankout"); ?>
						<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", "blankout"); ?> <?php the_category(', '); ?>.
					</p>
				</header>
				<section class="entry-content">
					<?php the_excerpt('<span class="read-more">Read more &raquo;</span>'); ?>
				</section>
				<footer class="article-footer">
				</footer>
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
