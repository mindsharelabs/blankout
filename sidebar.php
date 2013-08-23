<div id="sidebar" class="col-lg-3">
	<?php if(is_active_sidebar('main-sidebar')) : ?>
		<?php dynamic_sidebar('main-sidebar'); ?>
	<?php else : ?>
	<div class="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php _e("Please activate some Widgets.", "blankout");  ?>
	</div>
	<?php endif; ?>
</div>
