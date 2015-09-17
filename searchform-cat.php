<?php
/**
 * Use this form for category specific searches
 */
$placeholder = esc_attr__('Search', 'blankout') . ' ' . mapi_single_cat_title();
$cat = '';
// 1st check for categories sent in from mapi_cat_search_form
if (!empty($cat_str)) {
	$cat = $cat_str;
	// 2nd check if we are on a search results page
} elseif (!empty($_GET[ 'cat' ])) {
	$cat = $_GET[ 'cat' ];
}
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>" class="input-group">
	<?php if (get_search_query() == '') : ?>
		<input type="text" value="" name="s" id="s" placeholder="<?php echo $placeholder; ?>" class="form-control" />
	<?php else : ?>
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php the_search_query(); ?>" class="form-control" />
	<?php endif; ?>

	<?php if (!empty($cat)) : ?>
		<input type="hidden" name="cat" value="<?php echo $cat; ?>" />
	<?php endif; ?>

	<span class="input-group-btn">
		<button type="submit" id="searchsubmit" class="btn btn-default">Go</button>
	</span>
</form>
