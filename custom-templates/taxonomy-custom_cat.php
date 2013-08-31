<?php
/*
This is the custom post type taxonomy template.
If you edit the custom taxonomy name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom taxonomy is called
register_taxonomy( 'shoes',
then your single template should be
taxonomy-shoes.php

*/
?>

<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<h1 class="archive-title h2"><span><?php _e("Posts Categorized:", "blankout"); ?></span> <?php single_cat_title(); ?></h1>

			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					<header class="article-header">
						<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<p class="byline vcard"><?php _e("Posted", "blankout"); ?>
							<time class="updated" datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "blankout"); ?>
							<span class="author"><?php the_author_posts_link(); ?></span>
							<span class="amp">&</span> <?php _e("filed under", "blankout"); ?> <?php echo get_the_term_list(get_the_ID(), 'custom_cat', "") ?>.
						</p>
					</header>
					<section class="entry-content">
						<?php the_excerpt('<span class="read-more">Read More &raquo;</span>'); ?>
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
