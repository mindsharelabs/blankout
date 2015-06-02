<?php
/**
 * The template for displaying Comments.
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to _blankout_comment() which is
 * located in the includes/template-tags.php file.
 */

$show_facebook_comments = FALSE;

if(defined('FB_APP_ID') && FB_APP_ID != FALSE) {
	$show_facebook_comments = TRUE;
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if(post_password_required()) {
	return;
}

?>
<hr />
<div id="comments" class="comments-area">
	<h3 id="reply-title" class="comment-reply-title">Leave a Reply
		<small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Cancel Reply</a></small>
	</h3>

	<div role="tabpanel">

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<?php if($show_facebook_comments) : ?>
				<li class="active" role="presentation"><a href="#fb-comment-form" aria-controls="profile" role="tab" data-toggle="tab">Leave a Comment with Facebook</a></li>
			<?php endif; ?>
			<li <?php if(!$show_facebook_comments) : ?>class="active" <?php endif; ?> role="presentation"><a href="#wp-comment-form" aria-controls="messages" role="tab" data-toggle="tab">Leave a Comment</a></li>

		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<?php if($show_facebook_comments) : ?>
				<div role="tabpanel" class="tab-pane active" id="fb-comment-form">
					<div id="facebook-comments">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[ 0 ];
								if (d.getElementById(id)) {
									return;
								}
								js = d.createElement(s);
								js.id = id;
								js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=<?php echo FB_APP_ID; ?>";
								fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="10" data-colorscheme="light" data-width="100%"></div>
					</div>
				</div>
			<?php endif; ?>
			<div role="tabpanel" class="tab-pane active" id="wp-comment-form">
				<?php
				comment_form($args = array(
					'id_form'             => 'commentform',
					'id_submit'           => 'commentsubmit',
					'title_reply'         => '',
					'title_reply_to'      => __('Leave a Reply to %s'),
					'cancel_reply_link'   => __('Cancel Reply'),
					'label_submit'        => __('Post Comment'),
					'comment_field'       => '<p><textarea placeholder="Start typing..." id="comment" class="form-control" name="comment" cols="45" rows="3" aria-required="true"></textarea></p>',
					'comment_notes_after' => ''

				));

				?>
			</div>
		</div>
	</div>

	<?php if(have_comments()) : ?>
		<header class="page-header">
			<h2 class="comments-title">
				<?php
				printf(_nx('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'blankout'),
					number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
				?>
			</h2>
		</header>

		<?php if(get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through {?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h5 class="sr-only"><?php _e('Comment navigation', 'blankout'); ?></h5>
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
				<h5 class="sr-only"><?php _e('Comment navigation', 'blankout'); ?></h5>
				<ul class="pager">
					<li class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'blankout')); ?></li>
					<li class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'blankout')); ?></li>
				</ul>
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	if(!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
		?>
		<p class="no-comments"><?php _e('Comments are closed.', 'blankout'); ?></p>
	<?php endif; ?>

</div>
