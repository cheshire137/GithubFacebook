<?php
session_start();
require_once 'config.inc.php'; //has $api_key and $secret defined.
if (!array_key_exists('authorized', $_SESSION) || $_SESSION['authorized'] != 'true') {
    header("Location: $redirect_base/login.php");
}
require_once 'facebook.php';
include_once 'header.inc.php';
global $api_key, $secret;
$facebook = new Facebook($api_key, $secret);
$fb_user = $facebook->get_loggedin_user();

if (array_key_exists('error', $_GET) && $_GET['error'] != '') {
    echo '<p class="error">' . $_GET['error'] . '</p>';
}

if ($fb_user) {
    ?>
    <fb:profile-pic class="fb_profile_pic_rendered FB_ElementReady" facebook-logo="true" size="square" uid="<?php echo $fb_user; ?>"></fb:profile-pic>
    <form method="post" action="<?php echo $redirect_base; ?>/add_github_user.php">
        <input type="hidden" value="<?php echo $fb_user; ?>" name="fb_user_id" />
        <fieldset>
            <legend>Connect to Github</legend>
            <ol>
                <li><label for="github_users_name">Github user name:</label>
                <input type="text" size="20" id="github_users_name" name="github_users[name]" /></li>
                <?php
                //<li><label for="github_users_password">Github password (optional):</label>
                //<input type="password" size="20" id="github_users_password" name="github_users[password]" /></li>
                ?>
                <li><input type="submit" value="Add Github User &raquo;"/></li>
            </ol>
        </fieldset>
    </form>
    <?php
} else {
    echo 'No Facebook user--not logged in';
}

include_once 'footer.inc.php';
?>
