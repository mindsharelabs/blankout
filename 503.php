<?php
// show a placeholder page or use a META refresh
$use_refresh = FALSE;
$refresh_url = '/v1/';
$reason = 'We\'re sorry, '.get_bloginfo('name').' is currently under construction by Mindshare Studios, Inc. We\'ll be back online soon.';

// stop editing ------------------------------------------------------------------------------------
if($use_refresh) {
	die('<meta http-equiv="refresh" content="0;URL='.$refresh_url.'" />');
} else {
	$sec_file = WP_PLUGIN_DIR.'/mcms-api/core/mapi-security.php';
	if(!function_exists('mapi_security_audit') && file_exists($sec_file)) {
		require_once($sec_file);
	}
	if(function_exists('mapi_security_audit')) {
		return mapi_security_audit(TRUE, $reason);
	} else {
		die($reason);
	}
}
?>
