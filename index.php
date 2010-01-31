<?php
session_start();

// the facebook client library
require_once 'facebook.php';

// this defines some of your basic setup
require_once 'config.inc.php';

if (array_key_exists('authorized', $_SESSION) && $_SESSION['authorized'] == true) {
  header("Location: $redirect_base/logged_in.php");
} else {
  header("Location: $redirect_base/login.php");
}
?>