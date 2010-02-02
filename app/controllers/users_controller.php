<?php
App::import('Vendor', 'facebook');
Configure::load('facebook_config');

class UsersController extends AppController
{
    public $name = 'Users';
    
    function beforeFilter()
    {
        $fb_user_id = $this->facebook->require_login();
        
        if (is_null($fb_user_id))
        {
            exit();
        }
        
        $this->Session->write('User.fb_user_id', $fb_user_id);
    }
    
    public function edit()
    {
        if (empty($this->data) == true || empty($this->data['User']) == true)
        {
            $this->Session->setFlash('No Github user given to edit');
            $this->redirect('index');
            exit();
        }
        
        if (!$this->User->facebookUserOwnsId(
            $this->Session->read('User.fb_user_id'),
            $this->data['User']['facebook_id']))
        {
            $this->Session->setFlash("You cannot edit another Facebook user's Github name");
            $this->redirect('index');
            exit();
        }
        
        $this->pageTitle = 'Edit Github User';
        $this->set('user', $this->data['User']);
    }
    
    public function index()
    {
        $this->pageTitle = 'Github Activity';
        $fb_user_id = $this->Session->read('User.fb_user_id');
        $users = $this->User->findAllByFacebookId($fb_user_id);
        $this->set('users', $users);
        $this->set('fb_user_id', $fb_user_id);
        
        $repos_data = array();
        foreach ($users as $user)
        {
            $repos_data[$user['User']['id']] =
                $this->User->getRepositories($user['User']['github_name']);
        }
        
        $this->set('repos_data', $repos_data);
    }
} 
?>