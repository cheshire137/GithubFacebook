<?php
require_once 'wmsfacebook/WMSFacebook.php';

function setup_database($facebook)
{
  $users_table = 'users';
  $repos_table = 'repositories';
  $facebook->api_client->data_createObjectType($users_table);
  $facebook->api_client->data_createObjectType($repos_table);
  $facebook->api_client->data_defineObjectProperty($users_table, 'user_id', 2);
  $facebook->api_client->data_defineObjectProperty($users_table, 'password', 2);
  $facebook->api_client->data_defineObjectProperty($repos_table, 'name', 2);
  $facebook->api_client->data_defineObjectProperty($repos_table, 'user_id', 2);
  /*$dataStore = $facebook->getWMSFacebookDataStore();
  
  $usersTable = $dataStore->createObjectType('users');
  if (null != $usersTable && get_class($usersTable) == "WMSFacebookDataStoreObject")
  {
    $usersTable.createPropertyString("user_id");
    $usersTable.createPropertyString("password");
  }
  
  $repositoriesTable = $dataStore->createObjectType('repositories');
  if (null != $repositoriesTable && get_class($repositoriesTable) == "WMSFacebookDataStoreObject")
  {
    $repositoriesTable.createPropertyString("name");
    $repositoriesTable.createPropertyString("user_id");
  }*/
}
?>