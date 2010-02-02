<?php
App::import('Core', 'HttpSocket');
App::import('Vendor', 'spyc');

class User extends AppModel 
{
    public $name = 'User';
    
    public function facebookUserOwnsId($fb_user_id, $id)
    {
        $user = $this->find($id);
        
        if (empty($user) == false)
        {
            return $user['User']['facebook_id'] == $fb_user_id;
        }
        
        return false;
    }
    
    public function getRepositories($github_name)
    {
        $socket = new HttpSocket();
        $yaml = $socket->get("http://github.com/api/v2/yaml/repos/show/" . $github_name);
        $data = Spyc::YAMLLoad($yaml);
        return $data;
    }
} 
?>