<?php
/*
Plugin Name: Hashtag social wall
Plugin URI: http://github.com
Description: Hashtag social wall
Version: 1.0
Author: Nil Borodulya
Author URI: http://github.com
*/

try{
	require_once  dirname(__FILE__).'/config.php';
	if (!class_exists('nilCorePlugin.php')) {
		require_once(HASHTAG_WALL_SOCIAL_CORE_PATH.'nilCorePlugin.php');
	}
	if (!class_exists(HASHTAG_WALL_SOCIAL_COMMON_PATH.'nilHashtagWallSocialPlugin.php')) {
		require_once(HASHTAG_WALL_SOCIAL_COMMON_PATH.'nilHashtagWallSocialPlugin.php');
	}

	$GLOBALS['nilHashtagWallSocialPlugin'] = new nilHashtagWallSocialPlugin(__FILE__);
} catch(Exception $e) {
	echo $e->getMessage();
}