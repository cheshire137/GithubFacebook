<?php
session_start();
require_once 'config.inc.php'; //has $api_key and $secret defined.
require_once 'facebook.php';
require_once 'lib.inc.php';

global $api_key, $secret;
$facebook = new Facebook($api_key, $secret);
$fb_user_id = $facebook->get_loggedin_user();

if ($fb_user_id) {
    $_SESSION['authorized'] = 'true';
    header("Location: $redirect_base/logged_in.php");
} else {
    require_once 'fb_login.inc.php';
}
?>