<?php get_header(); ?>
<div id="content">
	<div id="inner-content" class="wrap clearfix">
		<div id="main" class="eightcol first clearfix" role="main">
			<article id="post-not-found" <?php post_class('post-not-found hentry clearfix'); ?>>
				<header class="article-header">
					<h1><?php _e("404 Error - Page Not Found", "blankout"); ?></h1>
				</header>
				<section class="entry-content">
					<p>
						<strong><?php _e('Error 404', 'blankout'); ?></strong>: <?php _e('the requested page could not be found. Try a search to find what you were looking for. Alternatively, you can return to', 'blankout'); ?>
						<a href="javascript:history.go(-1);" title="<?php _e('Go back to where you were', 'blankout'); ?>"><?php _e('the previous page', 'blankout'); ?></a>.</p>
				</section>
				<section class="search">
					<?php get_search_form(); ?>
					<?php if(function_exists('wbz404_suggestions')) : wbz404_suggestions(); endif; ?>
				</section>
				<footer class="article-footer"></footer>
			</article>
		</div>
	</div>
</div>
<?php get_footer(); ?>
