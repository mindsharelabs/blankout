<?php
/**
 * comments.php - Blankout comment functions
 *
 * @created   7/19/16 3:52 PM
 * @author    Mindshare Studios, Inc.
 * @copyright Copyright (c) 2006-2016
 * @link      https://mindsharelabs.com/
 */

/**
 * wp_list_comments callback
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function blankout_comments($comment, $args, $depth) {
	$GLOBALS[ 'comment' ] = $comment;
	$bgauthemail = get_comment_author_email(); ?>
	<article id="comment-<?php comment_ID(); ?>" <?php comment_class("media clearfix"); ?>>
		<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=48" class="pull-left media-object load-gravatar avatar avatar-48 photo" height="48" width="48" src="<?php echo get_stylesheet_directory_uri(); ?>/img/nothing.gif" />
		<header class="comment-author vcard">
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
			<time datetime="<?php comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
			<?php edit_comment_link(__('Edit', 'blankout'), '<button class="btn btn-default btn-xs">', '</button>') ?>
		</header>
		<?php if ($comment->comment_approved == '0') : ?>
			<div class="alert info">
				<p><?php _e('Your comment is awaiting moderation.', 'blankout') ?></p>
			</div>
		<?php endif; ?>
		<section class="comment_content media-body clearfix">
			<?php comment_text() ?>
			<button class="btn btn-primary btn-sm"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args[ 'max_depth' ]))) ?></button>
		</section>
	</article>
	<?php
}

/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function _blankout_comment($comment, $args, $depth) {
	$GLOBALS[ 'comment' ] = $comment;

	if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args[ 'has_children' ]) ? '' : 'parent'); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
			<a class="pull-left" href="#comment-<?php comment_ID(); ?>">
				<?php if (0 != $args[ 'avatar_size' ]) {
					echo get_avatar($comment, $args[ 'avatar_size' ]);
				} ?>
			</a>

			<div class="media-body">
				<div class="media-body-wrap panel panel-default">
					<div class="panel-heading">
						<h5 class="media-heading"><?php _e('Pingback: ', 'blankout');
							comment_author_link() ?></h5>

						<div class="comment-meta">
							<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
								<time datetime="<?php comment_time('c'); ?>">
									<?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'blankout'), get_comment_date(), get_comment_time()); ?>
								</time>
							</a>
							<?php edit_comment_link(__('<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'blankout'), '<span class="edit-link">', '</span>'); ?>
						</div>
					</div>

					<?php if ('0' == $comment->comment_approved) : ?>
						<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'blankout'); ?></p>
					<?php endif; ?>

					<div class="comment-content panel-body">
						<?php comment_text(); ?>
					</div>
					<!-- .comment-content -->

					<?php comment_reply_link(
						array_merge(
							$args, array(
									 'add_below' => 'div-comment',
									 'depth'     => $depth,
									 'max_depth' => $args[ 'max_depth' ],
									 'before'    => '<footer class="reply comment-reply panel-footer">',
									 'after'     => '</footer><!-- .reply -->',
								 )
						)
					); ?>
				</div>
			</div>
			<!-- .media-body -->
		</article><!-- .comment-body -->

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args[ 'has_children' ]) ? '' : 'parent'); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
			<a class="pull-left" href="#comment-<?php comment_ID(); ?>">
				<?php if (0 != $args[ 'avatar_size' ]) {
					echo get_avatar($comment, $args[ 'avatar_size' ]);
				} ?>
			</a>

			<div class="media-body">
				<div class="media-body-wrap panel panel-default">
					<div class="panel-heading">
						<h5 class="media-heading"><?php printf(__('%s <span class="says">says:</span>', 'blankout'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?></h5>

						<div class="comment-meta">
							<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
								<time datetime="<?php comment_time('c'); ?>">
									<?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'blankout'), get_comment_date(), get_comment_time()); ?>
								</time>
							</a>
							<?php edit_comment_link(__('<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'blankout'), '<span class="edit-link">', '</span>'); ?>
						</div>
					</div>

					<?php if ('0' == $comment->comment_approved) : ?>
						<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'blankout'); ?></p>
					<?php endif; ?>

					<div class="comment-content panel-body">
						<?php comment_text(); ?>
					</div>
					<!-- .comment-content -->

					<?php comment_reply_link(
						array_merge(
							$args, array(
									 'add_below' => 'div-comment',
									 'depth'     => $depth,
									 'max_depth' => $args[ 'max_depth' ],
									 'before'    => '<footer class="reply comment-reply panel-footer">',
									 'after'     => '</footer><!-- .reply -->',
								 )
						)
					); ?>
				</div>
			</div>
			<!-- .media-body -->
		</article><!-- .comment-body -->

		<?php
	endif;
}
