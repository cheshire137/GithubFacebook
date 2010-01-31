<?php
require_once 'config.inc.php';
require_once 'facebook.php';

function get_facebook_user($fb_user_id) {
  $rows = run_query("SELECT * FROM fb_github_users WHERE fb_user_id='%s'",
    array($fb_user_id));

  if (count($rows) > 0) {
    return $rows[0];
  } else {
    return null;
  }
}

function run_query($raw_query, $parameters) {
  global $db_host, $db_user, $db_name, $db_password, $db_user;
  $link = mysql_connect($db_host, $db_user, $db_password)
    or die('Could not connect to database in run_query: ' . mysql_error());
  mysql_select_db($db_name, $link)
    or die('Could not select database in run_query: ' . mysql_error());
  $query = vsprintf($raw_query, $parameters);
  $result = mysql_query($query, $link) or die('Invalid query: ' . mysql_error());
  $rows = array();
  while ($row = mysql_fetch_assoc($result)) {
    $rows[] = $row;
  }
  mysql_free_result($result);
  mysql_close($link);
  return $rows;
}
?>