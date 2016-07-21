<?php
/**
 * pagination.php
 *
 * @created   7/19/16 3:54 PM
 * @author    Mindshare Labs, Inc.
 * @copyright Copyright (c) 2006-2016
 * @link      https://mindsharelabs.com/
 */

/**
 * @param string $before
 * @param string $after
 */
function blankout_page_nav($before = '<div class="pagination pagination-centered">', $after = '</div>') {
	global $wp_query; // $wpdb
	//$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ($numposts <= $posts_per_page) {
		return;
	}
	if (empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	if ($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if (($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if ($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if ($start_page <= 0) {
		$start_page = 1;
	}
	echo $before . "<ul class='pagination'>";
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = "First";
		echo '<li class="bpn-first-page-link"><a href="' . get_pagenum_link() . '" title="' . $first_page_text . '">' . $first_page_text . '</a></li>';
	}
	if ($paged <= 1) {
		echo '<li class="disabled"><span>&laquo;</span></li>';
	} else {
		echo '<li class="bpn-prev-link">';
		previous_posts_link('&laquo;');
		echo '</li>';
	}
	for ($i = $start_page; $i <= $end_page; $i++) {
		if ($i == $paged) {
			echo '<li class="disabled"><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
		} else {
			echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
		}
	}
	echo '<li class="bpn-next-link">';
	next_posts_link('&raquo;');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "Last";
		echo '<li class="bpn-last-page-link"><a href="' . get_pagenum_link($max_page) . '" title="' . $last_page_text . '">' . $last_page_text . '</a></li>';
	}
	echo "</ul>" . $after;
}

/**
 * Adjust pagination/pager container
 *
 * @param array $args
 *
 * @return array
 */
function blankout_link_pages_args($args) {

	$args[ 'before' ] = '<div class="pagination pagination-centered"><ul class="pagination">';
	$args[ 'after' ] = '</ul></div>';

	return $args;
}

/**
 * Wrap pagination/pager links in list items
 *
 * @param string $link
 * @param int    $page_number
 *
 * @return string
 */
function blankout_link_pages_link($link, $page_number) {

	global $page, $more;

	// blame core
	$not_current_page = ($page_number != $page);
	$more_front = (empty($more) && 1 == $page);
	if ($not_current_page || $more_front) {
		$link = '<li>' . $link . '</li>';
	} else {
		$link = '<li class="active"><span>' . $link . '</span></li>';
	}

	return $link;
}

add_filter('wp_link_pages_args', 'blankout_link_pages_args');
add_filter('wp_link_pages_link', 'blankout_link_pages_link', 10, 2);
