<?php
// The contents of this file will be displayed to logged out
// users when Maintenance Mode is enabled in the Mindshare Theme API
// (Settings > Developer Settings > Maintenance Mode)
// Feel free to delete or replace with a regular HTML or PHP file.

$refresh_url = '/v1/';
die('<meta http-equiv="refresh" content="0;URL='.$refresh_url.'" />');
