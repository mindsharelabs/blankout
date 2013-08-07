<?php
/*
This is the custom post type post template.
If you edit the post type name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom post type is called
register_post_type( 'bookmarks',
then your single template should be
single-bookmarks.php

*/
?>

<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				<header class="article-header">
					<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
					<p class="byline vcard"><?php _e("Posted", "blankout"); ?>
						<time class="updated" datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "blankout"); ?>
						<span class="author"><?php the_author_posts_link(); ?></span>
						<span class="amp">&</span> <?php _e("filed under", "blankout"); ?> <?php echo get_the_term_list(get_the_ID(), 'custom_cat', "") ?>.
					</p>
				</header>
				<section class="entry-content clearfix">
					<?php the_content(); ?>
				</section>
				<footer class="article-header">
					<p class="tags"><?php echo get_the_term_list(get_the_ID(), 'custom_tag', '<span class="tags-title">Custom Tags:</span> ', ', ') ?></p>
				</footer>

				<?php comments_template(); ?>
			</article>

			<?php endwhile; ?>



			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
