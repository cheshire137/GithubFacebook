<?php
require_once 'config.inc.php';
require_once 'facebook.php';

function add_github_user($fb_user_id, $github_name) {
  if (is_null($fb_user_id) || is_null($github_name)) {
    return false;
  }
  
  $link = get_connection();
  $query = sprintf("INSERT INTO fb_github_users (github_user_name, fb_user_id) VALUES(%s, %s)",
    mysql_real_escape_string($github_name),
    mysql_real_escape_string($fb_user_id));
  $success = run_insert_query($link, $query);
  disconnect($link);
  return $success;
}

function disconnect($link) {
  mysql_close($link);
}

function get_connection() {
  global $db_host, $db_user, $db_name, $db_password, $db_user;
  $link = mysql_connect($db_host, $db_user, $db_password)
    or die('Could not connect to database in run_query: ' . mysql_error());
  mysql_select_db($db_name, $link)
    or die('Could not select database in run_query: ' . mysql_error());
  return $link;
}

function get_facebook_user($fb_user_id) {
  $link = get_connection();
  $query = sprintf("SELECT * FROM fb_github_users WHERE fb_user_id='%s'",
    mysql_real_escape_string($fb_user_id));
  $rows = run_select_query($link, $query);
  disconnect($link);

  if (count($rows) > 0) {
    return $rows[0];
  } else {
    return null;
  }
}

function get_next_id_for_table($link, $table_name) {
  global $db_name;
  $query = sprintf("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA='%s' AND TABLE_NAME='%s'",
    mysql_real_escape_string($db_name),
    mysql_real_escape_string($table_name));
  $rows = run_select_query($link, $query);
  
  if (count($rows) > 0) {
    return $rows[0]['AUTO_INCREMENT'];
  } else {
    return null;
  }
}

function run_insert_query($link, $query) {
  return mysql_query($query, $link);
}

function run_select_query($link, $query) {
  $result = mysql_query($query, $link)
    or die('Invalid query: ' . mysql_error());
  $rows = array();
  while ($row = mysql_fetch_assoc($result)) {
    $rows[] = $row;
  }
  mysql_free_result($result);
  return $rows;
}
?>