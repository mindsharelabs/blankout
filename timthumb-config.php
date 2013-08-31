<?php
/**
 * timthumb-config.php
 *
 * Use this file to override the Mindshare Theme API defaults for TimThumb.
 * This file can be safely deleted if you don't need it
 *
 * @created   8/27/13 11:38 AM
 * @author    Mindshare Studios, Inc.
 * @copyright Copyright (c) 2013
 * @link      http://www.mindsharelabs.com/documentation/
 *
 */

// Max sizes
define('MAX_WIDTH', 2400);
define('MAX_HEIGHT', 2400);

// External Sites
$ALLOWED_SITES = array(
	'flickr.com',
	'staticflickr.com',
	'picasa.com',
	'img.youtube.com',
	'upload.wikimedia.org',
	'photobucket.com',
	'imgur.com',
	'imageshack.us',
	'tinypic.com',
	'mind.sh',
	'mindsharestudios.com'
);
define('ALLOW_EXTERNAL', TRUE);

// Caching
define('FILE_CACHE_DIRECTORY', ABSPATH.'/wp-content/uploads/cache/');
//define('FILE_CACHE_DIRECTORY',''); // leave blank for system directory
define('FILE_CACHE_TIME_BETWEEN_CLEANS', 172800); // 2 days
define('BROWSER_CACHE_MAX_AGE', 1728000); // 20 days
