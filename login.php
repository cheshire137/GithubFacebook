<?php
require_once 'config.php'; //has $api_key and $secret defined.
require_once 'facebook.php';
global $api_key, $secret;
$facebook = new Facebook($api_key, $secret);
$fb_user_id = $facebook->get_loggedin_user();

if ($fb_user_id) {
    $fb_user = get_facebook_user($fb_user_id);
    
    if ($fb_user != null) {
        $_SESSION['authorized']='true';
        header("Location: $redirect_base/logged_in.php");
    } else {
        header("Location: $redirect_base/connect_account.php");
    }
} else {
    // Is this login button sufficient here?
    include_once 'header.inc.php';
    ?>
    <fb:login-button></fb:login-button>
    <?php
    include_once 'footer.inc.php';
}
?>