<?php
/**
 * article-footer.php
 * 
 * @created 9/7/13 12:16 AM
 * @author Mindshare Studios, Inc.
 * @copyright Copyright (c) 2013
 * @link http://www.mindsharelabs.com/documentation/
 * 
 */
 
?>
<?php if(is_page()) : ?>

	<footer class="article-footer">
		<?php
		wp_link_pages(
			array(
				 'before'           => '<ul class="pagination">'.__('Pages:', 'blankout'),
				 'after'            => '</div>',
				 'link_before'      => '<li>',
				 'link_after'       => '</li>',
				 'next_or_number'   => 'number',
				 'nextpagelink'     => __('Next page', 'blankout'),
				 'previouspagelink' => __('Previous page', 'blankout'),
				 'pagelink'         => '%',
				 'echo'             => 1
			)
		);
		?>
		<?php mapi_edit_link(); ?>
	</footer>

<?php elseif(is_singular()) : ?>

	<footer class="article-footer">
		<?php the_taxonomies('before=<p class="tags">&after=</p>&template=%s: %l'); ?>
		<?php mapi_edit_link(); ?>
	</footer>

<?php else : ?>

	<footer class="article-footer"></footer>

<?php endif; ?>
