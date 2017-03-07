<?php echo defined('SYSPATH') or die('No direct script access.'); 

class Controller_User_Account extends Controller_Application
{   
    public function action_login()  
    {                  
        $content = View::factory('account/login');       
        $this->template->content = $content;   
    }
     public function action_signup()    
     {      
         $content = View::factory('account/signup');          
         $this->template->content = $content;   
     } 
} 