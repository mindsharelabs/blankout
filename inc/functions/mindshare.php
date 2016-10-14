<?php
/**
 * mindshare.php
 * Settings specific to the Mindshare Security plugin.
 *
 * @created   2/3/16 4:10 PM
 * @author    Mindshare Labs, Inc.
 * @copyright Copyright (c) 2006-2016
 * @link      https://mindsharelabs.com/
 */

//remove_action('admin_menu', array('mcms_ui', 'clear_dashboard'));
//remove_action('admin_head', array('mcms_ui', 'admin_head'));

//Turn off Admin Bar tweaks with:
//remove_action('admin_bar_menu', array('mcms_ui', 'admin_bar_menu'));

//Set Mindshare defaults in WordPress (only needs to run once, then can be removed):
//add_action('admin_init', array('mcms_settings', 'defaults'));

// Set rewrite rules to /%category%/%postname%/
//add_action('admin_init', array('mcms_settings', 'rewrite'));

//Create a crossdomain.xml file (for Flash). Technically, this is deprecated but still works if you need it.
// Create the file like so:
/*if (is_plugin_active('mindshare-client-security.git/mcms-admin.php')) {
	mcms_files::crossdomain();
}*/
