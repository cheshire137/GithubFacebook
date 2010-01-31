<?php
session_start();
include_once 'header.inc.php';
if (!array_key_exists('authorized', $_SESSION) || $_SESSION['authorized'] != true) {
    header("Location: http://github.3till7.net/login.php");
}
include_once 'config.inc.php'; //has $api_key and $secret defined.
include_once 'facebook.php';
global $api_key, $secret;
$facebook = new Facebook($api_key, $secret);
$fb_user = $facebook->get_loggedin_user();

if ($fb_user) {
    echo('<fb:profile-pic class="fb_profile_pic_rendered FB_ElementReady"' .
    'facebook-logo="true" size="square" uid="' . $fb_user . '"></fb:profile-pic>');
    echo "<pre>Debug:" . print_r($facebook) . "</pre>";
    echo "<pre>Debug:" . print_r($fb_user) . "</pre>";
}
include_once 'footer.inc.php';
?>
