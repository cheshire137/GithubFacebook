<?php
App::import('Vendor', 'facebook');

class UsersController extends AppController
{
    public $name = 'Users';
    var $facebook;
    
    function beforeFilter()
    {
    }
    
    public function index()
    {
        Configure::load('facebook_config');
        $api_key = Configure::read('Facebook.api_key');
        $secret = Configure::read('Facebook.secret');
        $this->log('API key: ' . $api_key, LOG_DEBUG);
        $this->pageTitle = 'Github Activity';
        $this->facebook = new Facebook($api_key, $secret);
        $fb_user_id = $this->facebook->get_loggedin_user();
        $friends = $this->facebook->api_client->friends_get();  
        $this->set('friends', $friends);  
        $this->set('facebook_id', $fb_user_id);
        $this->set('users', $this->User->findAllByFacebookId($fb_user_id));
    }
} 
?>