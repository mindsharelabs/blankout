<?php
$placeholder = 'Search '.mcms_single_cat_title();
$cat = '';
// 1st check for categories sent in from mcms_cat_search_form
if(!empty($cat_str)) {
	$cat = $cat_str;
	// 2nd check if we are on a search results page
} elseif(!empty($_GET['cat'])) {
	$cat = $_GET['cat'];
}
?>
<form method="get" id="searchform-cat" action="<?php bloginfo('url'); ?>/">
	<?php if(get_search_query() == '') : ?>
	<!-- <input type="search" id="s" name="s" placeholder="<?=$placeholder?>" /> -->
	<input type="text" onfocus="if(this.value=='<?=$placeholder?>'){this.value='';
		}" onblur="if(this.value=='')this.value='<?=$placeholder?>';" value="<?=$placeholder?>" id="s-cat" name="s" />
	<?php else : ?>
	<!-- <input type="search" id="s" name="s" placeholder="<?php the_search_query(); ?>"  /> -->
	<input type="text" onfocus="if(this.value=='<?=$placeholder?>')this.value='';" onblur="if(this.value=='')this.value='<?=$placeholder?>';" value="<?php the_search_query(); ?>" id="s-cat" name="s" />
	<?php endif;?>
	<?php if(!empty($cat)) : ?>
	<input type="hidden" name="cat" value="<?=$cat?>" />
	<?php endif; ?>
	<input type="hidden" id="searchsubmit" />
</form>
