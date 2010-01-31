<?php
require_once 'config.inc.php'; //has $api_key and $secret defined.
require_once 'facebook.php';
require_once 'lib.inc.php';

global $api_key, $secret;
$facebook = new Facebook($api_key, $secret);
$fb_user_id = $facebook->get_loggedin_user();

if ($fb_user_id) {
    $fb_user = get_facebook_user($fb_user_id);
    
    if ($fb_user != null) {
        $_SESSION['authorized'] = true;
        header("Location: $redirect_base/logged_in.php");
    } else {
        require_once 'fb_login.inc.php';
    }
} else {
    require_once 'fb_login.inc.php';
}
?>