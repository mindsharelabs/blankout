<?php
/**
 * opengraph.php
 *
 * @created   7/19/16 3:55 PM
 * @author    Mindshare Studios, Inc.
 * @copyright Copyright (c) 2006-2016
 * @link      https://mindsharelabs.com/
 */

/**
 * Adds a hidden div with HTML5 Microdata for posts.
 *
 * @see http://support.google.com/webmasters/bin/answer.py?hl=en&answer=99170 for info on rich snippets
 */
function blankout_rich_snippets() {
	if (function_exists('mapi_rich_snippets')) {
		mapi_rich_snippets();
	}
}

/**
 * Optionally displays a credit message in compatible themes when enabled in the Mindshare Theme API
 * (Settings > Developer Settings > Misc. Settings > Show Credit)
 */
function blankout_copyright() {
	if (function_exists('mapi_copyright')) {
		mapi_copyright();
	}
}

/**
 * Optionally displays a credit message in compatible themes when enabled in the Mindshare Theme API
 * (Settings > Developer Settings > Misc. Settings > Show Credit)
 */
function blankout_footer_credit() {
	$host = parse_url(esc_url(home_url()));
	$c = '<div id="credit" class="source-org copyright"><a class="no-icon tip" href="https://mind.sh/are/?ref=' . $host[ 'host' ] . '" target="_blank" title="Design and development by Mindshare Labs"><img src="' . get_stylesheet_directory_uri() . '/img/credit.png" alt="Design and development by Mindshare Labs" /></a></div>';
	if (function_exists('mapi_get_option')) {
		if (mapi_get_option('show_credit') == TRUE || (array_key_exists('credit', $_GET) && $_GET[ 'credit' ] == 1)) {
			echo $c;
		}
	} else {
		if (isset($_GET[ 'credit' ])) {
			if ($_GET[ 'credit' ] == 1) {
				echo $c;
			}
		}
	}
}

/**
 * Open Graph meta tags and language attributes (for IE)
 *
 * @param $output
 *
 * @return string
 */
function blankout_add_opengraph_doctype($output) {
	if (function_exists('mapi_add_opengraph_doctype')) {
		return mapi_add_opengraph_doctype($output);
	}
}

add_filter('language_attributes', 'blankout_add_opengraph_doctype');

/**
 * Adds Facebook Open Graph API stuff to head
 */
function blankout_facebook_head() {
	if (function_exists('mapi_facebook_head')) {
		mapi_facebook_head();
	}
}

add_action('wp_head', 'blankout_facebook_head', 5);
