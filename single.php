<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					<header class="article-header page-header">
						<?php if(function_exists('bcn_display')) { ?>
							<ol class="breadcrumb">
								<?php bcn_display_list(); ?>
							</ol>
						<?php } ?>
						<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
						<p class="byline vcard"><?php _e("Posted", "blankout"); ?>
							<time class="updated" datetime="<?php echo the_time('Y-m-d'); ?>"><?php the_time('F jS, Y'); ?></time> <?php _e("by", "blankout"); ?>
							<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", "blankout"); ?> <?php the_category(', '); ?>.
						</p>
					</header>
					<section class="entry-content clearfix" itemprop="articleBody">
						<?php the_content(); ?>
					</section>
					<footer class="article-footer">
						<?php the_taxonomies('before=<p class="tags">&after=</p>&template=%s: %l'); ?>
						<?php edit_post_link(); ?>
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
