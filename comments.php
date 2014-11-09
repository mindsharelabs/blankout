<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to _blankout_comment() which is
 * located in the includes/template-tags.php file.
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if(post_password_required()) {
	return;
}


?>

<div id="comments" class="comments-area">
	<?php if(have_comments()) : ?>
		<header class="page-header">
			<h2 class="comments-title">
				<?php
				printf(_nx('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'blankout'),
					number_format_i18n(get_comments_number()), '<span>'.get_the_title().'</span>');
				?>
			</h2>
		</header>

		<?php if(get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through {?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h5 class="screen-reader-text"><?php _e('Comment navigation', 'blankout'); ?></h5>
				<ul class="pager">
					<li class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'blankout')); ?></li>
					<li class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'blankout')); ?></li>
				</ul>
			</nav>
			<?php endif; ?>

		<ol class="comment-list media-list">
			<?php

			wp_list_comments(array('callback' => '_blankout_comment', 'avatar_size' => 50));
			?>
		</ol>

		<?php if(get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through {?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e('Comment navigation', 'blankout'); ?></h1>

				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'blankout')); ?></div>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'blankout')); ?></div>
			</nav><!-- #comment-nav-below -->
			<?php endif; ?>

	<?php endif; ?>

	<?php
	if(!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
		?>
		<p class="no-comments"><?php _e('Comments are closed.', 'blankout'); ?></p>
	<?php endif; ?>

	<?php comment_form($args = array(
		'id_form'             => 'commentform',
		'id_submit'           => 'commentsubmit',
		'title_reply'         => __('Leave a Reply'),
		'title_reply_to'      => __('Leave a Reply to %s'),
		'cancel_reply_link'   => __('Cancel Reply'),
		'label_submit'        => __('Post Comment'),
		'comment_field'       => '<p><textarea placeholder="Start typing..." id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'comment_notes_after' => '<p class="form-allowed-tags">'.
			__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:').
			'</p><div class="alert alert-info">'.allowed_tags().'</div>'

	));

	?>
</div>
