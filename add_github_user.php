<?php
session_start();
require_once 'config.inc.php'; //has $api_key and $secret defined.
if (!array_key_exists('authorized', $_SESSION) || $_SESSION['authorized'] != 'true') {
    header("Location: $redirect_base/login.php");
    die();
}
require_once 'facebook.php';
require_once 'lib.inc.php';
global $api_key, $secret;
$facebook = new Facebook($api_key, $secret);
$fb_user = $facebook->get_loggedin_user();

// Not logged in Facebook user
if (!$fb_user) {
    header("Location: $redirect_base/login.php");
    die();
}

// Didn't pass a Facebook user ID in the form
if (!array_key_exists('fb_user_id', $_POST)) {
    header("Location: $redirect_base/logged_in.php?error=No Facebook user ID given");
    die();
}

// Given Facebook user ID and the actual logged-in Facebook user are different
if ($fb_user != $_POST['fb_user_id']) {
    header("Location: $redirect_base/logged_in.php?error=Cannot add repository for another Facebook user");
    die();
}

// Didn't pass a Github user name via form
if (
    !array_key_exists('github_users', $_POST) ||
    empty($_POST['github_users']) ||
    !array_key_exists('name', $_POST['github_users']) ||
    $_POST['github_users']['name'] == ''
) {
    header("Location: $redirect_base/logged_in.php?error=No Github user name given");
    die();
}

$github_user = $_POST['github_users']['name'];

if (add_github_user($fb_user, $github_user)) {
    header("Location: $redirect_base/logged_in.php?notice=Successfully added Github user");
} else {
    header("Location: $redirect_base/logged_in.php?error=Could not add Github user");
}
?>