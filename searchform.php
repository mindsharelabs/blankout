<?php $placeholder = esc_attr__('Search', 'blankout'); ?>
<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<label class="screen-reader-text" for="s"><?php echo __('Search for:', 'blankout'); ?></label>
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php echo $placeholder; ?>" /> <input type="submit" id="searchsubmit" value="<?php echo $placeholder; ?>" />
	<!--<input type="hidden" id="searchsubmit" />-->
</form>
<!--<form class="form-search" action="/" method="get">
<div class="input-append">
	<input type="text" name="s" class="span7 search-query">
	<button type="submit" class="btn">Search</button>
</div>
</form>-->
