<?php
App::import('Vendor', 'facebook');
Configure::load('facebook_config');

class AppController extends Controller {
    protected $facebook;

    function __construct()
    {
        parent::__construct();
        
        // Prevent the 'Undefined index: facebook_config' notice from being thrown.
        $GLOBALS['facebook_config']['debug'] = NULL;
        
        // Create a Facebook client API object.
        $api_key = Configure::read('Facebook.api_key');
        $secret = Configure::read('Facebook.secret');
        $this->facebook = new Facebook($api_key, $secret);
    }
}
?>