<?php
// the facebook client library
require_once 'facebook.php';

// some basic library functions
require_once 'lib.php';

// this defines some of your basic setup
require_once 'config.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();

try
{
  setup_database($facebook);
}
catch (Exception $ex)
{
  echo 'Failed to setup database: ' . $ex;
}
?>
<h2>Hi <fb:name firstnameonly="true" uid="<?=$user?>" useyou="false"/>!</h2><br/>
<a href="<?= $facebook->get_add_url() ?>">Put Github in your profile</a>, if you haven't already!