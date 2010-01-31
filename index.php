<?php
// the facebook client library
require_once 'facebook.php';

// some basic library functions
require_once 'lib.php';

// this defines some of your basic setup
require_once 'config.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user_id = $facebook->require_login();

try
{
  setup_database($facebook);
}
catch (Exception $ex)
{
  echo 'Failed to setup database: ' . $ex;
}

// Greet the currently logged-in user!
echo "<p>Hello, <fb:name uid=\"$user_id\" useyou=\"false\" />!</p>";

// Print out at most 25 of the logged-in user's friends,
// using the friends.get API method
echo "<p>Friends:</p>";
$friends = $facebook->api_client->friends_get();
$friends = array_slice($friends, 0, 25);
echo '<ul>';
foreach ($friends as $friend) {
  echo "<li>$friend</li>";
}
echo "</ul>\n";
?>
<a href="<?= $facebook->get_add_url() ?>">Put Github in your profile</a>, if you haven't already!