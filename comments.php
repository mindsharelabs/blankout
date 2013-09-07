<?php
/*
The comments page for Blankout
*/

// Do not delete these lines
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ('Please do not load this page directly. Thanks!');
}
?>

<section class="comments">
	<?php if(post_password_required()) {
		?>
		<div class="alert help">
			<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.", 'blankout'); ?></p>
		</div>
		<?php
		return;
	}
	?>

	<!-- You can start editing here. -->

	<?php if(have_comments()) : ?>

		<h3 id="comments"><?php comments_number('<span>No</span> Responses', '<span>One</span> Response', '<span>%</span> Responses'); ?> to &#8220;<?php the_title(); ?>&#8221;</h3>

		<nav id="comment-nav">
			<ul class="clearfix pager">
				<li class="previous"><?php previous_comments_link('&lquo; Previous') ?></li>
				<li class="next"><?php next_comments_link('Next &raquo;') ?></li>
			</ul>
		</nav>

		<?php wp_list_comments('type=comment&callback=blankout_comments'); ?>

		<nav id="comment-nav">
			<ul class="clearfix pager">
				<li class="previous"><?php previous_comments_link('&lquo; Previous') ?></li>
				<li class="next"><?php next_comments_link('Next &raquo;') ?></li>
			</ul>
		</nav>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if(comments_open()) : ?>

			<!-- If comments are open, but there are no comments. -->

		<?php else : // comments are closed ?>

			<!-- If comments are closed. -->
			<div class="alert alert-warning"><?php _e("Comments are closed.", 'blankout'); ?></div>

		<?php endif; ?>

	<?php endif; ?>


	<?php if(comments_open()) : ?>

		<section id="respond" class="respond-form">
			<h3 id="comment-form-title"><?php comment_form_title(__('Leave a Reply', 'blankout'), __('Leave a Reply to %s', 'blankout')); ?></h3>

			<div id="cancel-comment-reply">
				<p class="small"><?php cancel_comment_reply_link(); ?></p>
			</div>

			<?php if(get_option('comment_registration') && !is_user_logged_in()) : ?>
				<div class="alert help">
					<p><?php printf('You must be %1$slogged in%2$s to post a comment.', '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>'); ?></p>
				</div>
			<?php else : ?>

				<form action="<?php echo site_url(); ?>/wp-comments-post.php" method="post" id="commentform" role="form" class="form-horizontal">
					<?php if(is_user_logged_in()) : ?>

						<p class="comments-logged-in-as"><?php _e("Logged in as", 'blankout'); ?> <a href="<?php echo site_url(); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
							<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e("Log out of this account", 'blankout'); ?>"><?php _e("Log out", 'blankout'); ?> <?php _e("&raquo;", 'blankout'); ?></a>
						</p>

					<?php else : ?>

						<div class="form-group">
							<label for="author" class="col-lg-2 control-label"><?php _e("Name", 'blankout'); ?> <?php if($req) {
									_e('(required)', 'blankout');
								} ?></label>

							<div class="col-lg-10">
								<input type="text" name="author" id="author" class="form-control" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e('Your Name', 'blankout'); ?>" tabindex="1" <?php if($req) {
									echo "aria-required='true'";
								} ?> />
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-lg-2 control-label"><?php _e("Mail", 'blankout'); ?> <?php if($req) {
									_e('(required)', 'blankout');
								} ?></label>

							<div class="col-lg-10">
								<input type="email" name="email" id="email" class="form-control" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e('Your E-Mail', 'blankout'); ?>" tabindex="2" <?php if($req) {
									echo "aria-required='true'";
								} ?> />
							</div>
							<p class="help-block"><?php _e("(will not be published)", 'blankout'); ?></p>
						</div>
						<div class="form-group">
							<label for="url" class="col-lg-2 control-label"><?php _e("Website", 'blankout'); ?></label>

							<div class="col-lg-10">
								<input type="url" name="url" id="url" class="form-control" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e('Got a website?', 'blankout'); ?>" tabindex="3" />
							</div>
						</div>

					<?php endif; ?>
					<div class="form-group">
						<div class="col-lg-12">
							<textarea name="comment" id="comment" class="form-control" rows="4" placeholder="<?php _e('Your Comment here...', 'blankout'); ?>" tabindex="4"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<input name="submit" type="submit" id="submit" class="btn btn-primary" tabindex="5" value="<?php _e('Submit', 'blankout'); ?>" />
						</div>
					</div>
					<?php comment_id_fields(); ?>

					<?php do_action('comment_form', get_the_ID()); ?>
				</form>

			<?php endif; // If registration required and not logged in ?>
		</section>

	<?php endif; // if you delete this the sky will fall on your head ?>
</section>
