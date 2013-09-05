<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div id="main" class="col-lg-9">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					<header class="article-header page-header">
						<?php //blankout_rich_snippets(); ?>
						<?php if(function_exists('bcn_display')) : ?>
							<ol class="breadcrumb">
								<?php bcn_display_list(); ?>
							</ol>
						<?php endif; ?>
						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
					</header>
					<section class="entry-content clearfix" itemprop="articleBody">
						<?php the_content(); ?>
					</section>
					<footer class="article-footer">
						<?php the_taxonomies('before=<p class="tags">&after=</p>'); ?>
						<?php mapi_edit_link(); ?>
					</footer>
				</article>

			<?php endwhile; ?>

			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
