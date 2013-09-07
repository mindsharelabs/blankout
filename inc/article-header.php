<?php
/**
 * article-header.php
 *
 * @created   9/6/13 11:38 PM
 * @author    Mindshare Studios, Inc.
 * @copyright Copyright (c) 2013
 * @link      http://www.mindsharelabs.com/documentation/
 *
 */

?>

<?php if(is_404()) : ?>

	<header class="article-header page-header">
		<h1 class="entry-title page-title"><?php _e('404 - Page Not Found', 'blankout'); ?></h1>
	</header>

<?php elseif(is_front_page()) : ?>
	<header class="article-header page-header">
		<?php blankout_rich_snippets(); ?>

		<h1 class="entry-title page-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		<small class="byline vcard"><?php _e("Posted", 'blankout'); ?>
			<time class="updated" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format', 'l, F j, Y')); ?></time> <?php _e("by", 'blankout'); ?>
			<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", 'blankout'); ?> <?php the_category(', '); ?>.
		</small>
	</header>

<?php elseif(is_singular()) : ?>

	<header class="article-header page-header">
		<?php //blankout_rich_snippets(); ?>
		<?php if(function_exists('bcn_display')) : ?>
			<ol class="breadcrumb">
				<?php bcn_display_list(); ?>
			</ol>
		<?php endif; ?>
		<h1 class="entry-title page-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		<small class="byline vcard"><?php _e("Posted", 'blankout'); ?>
			<time class="updated" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format', 'l, F j, Y')); ?></time> <?php _e("by", 'blankout'); ?>
			<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", 'blankout'); ?> <?php the_category(', '); ?>.
		</small>
	</header>

<?php else : ?>

	<header class="article-header">
		<h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		<small class="byline vcard"><?php _e("Posted", 'blankout'); ?>
			<time class="updated" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format', 'l, F j, Y')); ?></time> <?php _e("by", 'blankout'); ?>
			<span class="author"><?php the_author_posts_link(); ?></span> <span class="amp">&amp;</span> <?php _e("filed under", 'blankout'); ?> <?php the_category(', '); ?>.
		</small>
	</header>

<?php endif; ?>
