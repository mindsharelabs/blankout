<div class="span3">
	<?php if(is_active_sidebar('Main Sidebar')) : ?>
	<?php dynamic_sidebar('Main Sidebar'); ?>
	<?php else : ?>
	<div class="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?php _e("Please activate some Widgets.", "blankout");  ?>
	</div>
	<?php endif; ?>
</div>
