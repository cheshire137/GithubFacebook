<?php
App::import('Vendor', 'facebook_config', array('file' => 'facebook_config.inc.php'));
App::import('Vendor', 'facebook');

class UsersController extends AppController
{ 
    public $name = 'Users';
    
    public function index()
    {
        global $api_key, $secret;
        $facebook = new Facebook($api_key, $secret);
        $fb_user_id = $facebook->get_loggedin_user();
        $this->set('facebook_id', $fb_user_id);
        $this->set('users', $this->User->findAllByFacebookId($fb_user_id));
    }
} 
?>