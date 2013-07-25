<?php
/*
Template Name: Custom Page Example
*/
?>

<?php get_header(); ?>

<div class="container-fluid">
	<div class="row-fluid">
		<div id="main" class="span9">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				<header class="article-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<p class="byline vcard"><?php _e("Posted", "blankout"); ?>
						<time class="updated" datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "blankout"); ?>
						<span class="author"><?php the_author_posts_link(); ?></span>.
					</p>
				</header>
				<section class="entry-content">
					<?php the_content(); ?>
				</section>
				<footer class="article-footer">
					<p class="clearfix"><?php the_tags('<span class="tags">Tags: ', ', ', '</span>'); ?></p>
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
