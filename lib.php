<?php
require_once 'config.php';
require_once 'facebook.php';

function get_facebook_user($fb_user_id) {
  $query = sprintf("SELECT * FROM fb_github_users WHERE fb_user_id='%s'",
    mysql_real_escape_string($fb_user_id));
  $rows = run_query($query);
  
  if (count($rows) > 0) {
    return $rows[0];
  } else {
    return null;
  }
}

function run_query($query) {
  global $db_host, $db_user, $db_name, $db_password, $db_user;
  $link = mysql_connect($db_host, $db_user, $db_password)
    or die('Could not connect to database in get_facebook_user: ' . mysql_error());
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