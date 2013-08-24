<?php $placeholder = esc_attr__('Search', 'blankout'); ?>
<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>" class="input-group">
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php echo $placeholder; ?>" class="form-control" />
	<span class="input-group-btn">
		<button type="submit" id="searchsubmit" class="btn btn-default">Go</button>
	</span>
	<!--<input type="hidden" id="searchsubmit" />-->
</form>
<!--<form class="form-search" action="/" method="get">
<div class="input-append">
	<input type="text" name="s" class="span7 search-query">
	<button type="submit" class="btn">Search</button>
</div>
</form>-->
