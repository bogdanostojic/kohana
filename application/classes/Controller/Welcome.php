<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Application {

	public function action_index()
	{
        // IZ KNJIGE - kako ne radi :
        // $this->request->response = View::factory('welcome'); 
       View::bind_global('username', $username);
        $username = "Bogdan Ostojic";
       // $site_name = 'PROBA, radi';
        
        // novo kako radi:
        $content = View::factory('welcome');
        $content->bind('random', $random);
       // $content->site_name = 'Sta god ti kazes jefe v 03.';
        $random = rand(1,10);
       // $view->random = rand(1,10);
        $this->template->content = $content;
	}
    
    public function action_echo()
    {
        $message = $this->request->param('id');
        $this->response->body('Is it : ' . $message);
    }

} // End Welcome
