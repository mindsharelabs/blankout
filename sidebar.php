<div id="sidebar" class="col-lg-3">
	<?php

	if (is_active_sidebar('blog-sidebar') && (is_archive() || is_singular('post'))) {

		dynamic_sidebar('blog-sidebar');
	} elseif (is_active_sidebar('main-sidebar')) {

		dynamic_sidebar('main-sidebar');
	} ?>
</div>
