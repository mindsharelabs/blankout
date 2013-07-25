<?php get_header(); ?>
<div id="content">
	<div id="inner-content" class="wrap clearfix">
		<div id="main" class="eightcol first clearfix" role="main">
			<article id="post-not-found" class="hentry clearfix">
				<header class="article-header">
					<h1><?php _e("404 Error - Article Not Found", "blankout"); ?></h1>
				</header>
				<section class="entry-content">
					<p>
						<strong><?php echo __('Error 404', 'blankout'); ?></strong>: <?php echo __('the requested page could not be found. Try a search to find what you were looking for. Alternatively, you can return to', 'blankout'); ?>
						<a href="javascript:history.go(-1);" title="<?php echo __('Go back to where you were', 'blankout'); ?>"><?php echo __('the previous page', 'blankout'); ?></a>.</p>
				</section>
				<section class="search">
					<p><?php get_search_form(); ?></p>
				</section>
				<footer class="article-footer"></footer>
			</article>
		</div>
	</div>
</div>
<?php get_footer(); ?>
