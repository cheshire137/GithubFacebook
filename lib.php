<?php
require_once 'config.php';
require_once 'facebook.php';

function setup_database($facebook)
{
  global $users_table, $repos_table;
  
  try
  {
    $facebook->api_client->data_createObjectType($users_table);
    $facebook->api_client->data_createObjectType($repos_table);
    $facebook->api_client->data_defineObjectProperty($users_table, 'user_id', 2);
    $facebook->api_client->data_defineObjectProperty($users_table, 'password', 2);
    $facebook->api_client->data_defineObjectProperty($repos_table, 'name', 2);
    $facebook->api_client->data_defineObjectProperty($repos_table, 'user_id', 2);
  }
  catch (FacebookRestClientException $ex) { }
}
?>