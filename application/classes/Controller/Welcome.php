<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Application {

	public function action_index()
	{
        
        // IZ KNJIGE - kako ne radi :
        // $this->request->response = View::factory('welcome'); 
      /* View::bind_global('username', $username);
        $username = "Bogdan Ostojic";
       // $site_name = 'PROBA, radi';
        
        // novo kako radi:
        $content = View::factory('welcome');
        $content->bind('random', $random);
       // $content->site_name = 'Sta god ti kazes jefe v 03.';
        $random = rand(1,10);
       // $view->random = rand(1,10);
        $this->template->content = $content;
        */
        
        /*<--------Ovako radi sa username, random i message globalnim promenljivama-------->*/
        $random = rand(1,10);
        /*
                ***STARO***
       $this->response->body(View::set_global('username', 'Bogdan Ostojic'));
       $this->response->body(View::bind_global('random', $random));
        
        */
        $content = View::factory('welcome')->bind('messages', $messages);
        $content->random = $random;
        $content->site_name = 'Ископаће те Били.';
        $content->username = 'Bogdan Ostojic';
        $message = new Model_Message;
           $message_count = $message->count_all();   
        $pagination = Pagination::factory(array(  
            'total_items'    => $message_count, 
            'items_per_page' => 3,  
        ));     
        $pager_links = $pagination->render();   
        $messages = $message->get_all($pagination->items_per_page, $pagination->offset);
        $this->template->content = $content;
        
        
	}
    
    public function action_echo()
    {
        $message = $this->request->param('id');
        $this->response->body('Is it : ' . $message);
    }

} // End Welcome
