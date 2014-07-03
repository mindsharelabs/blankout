<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php include(get_stylesheet_directory().'/inc/carousel.php'); ?>
		</div>
	</div>
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					<header class="article-header post-header">
						<?php blankout_rich_snippets(); ?>

						<h1 class="entry-title page-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<small class="byline vcard"><?php _e("Posted", 'blankout'); ?>
							<time class="updated" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format', 'l, F j, Y')); ?></time> <?php _e("by", 'blankout'); ?>
							<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", 'blankout'); ?> <?php the_category(', '); ?>.
						</small>
					</header>
					<section class="entry-content clearfix" itemprop="articleBody">
						<?php the_content(); ?>
					</section>
					<footer class="article-footer"></footer>
				</article>

			<?php endwhile; ?>

				<?php blankout_page_nav(); ?>

			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
