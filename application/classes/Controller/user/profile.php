<?php defined('SYSPATH') or die('No direct script access.');
class Controller_User_Profile extends Controller_Application 
{

       public function action_index() 
        {          
          $id = $this->request->param('id');
          $user = new Model_User($id);

          if (!$user->id)             
            {      
              throw new Exception('Not a valid user');             
            }
             $content = View::factory('profile/public')
             ->set('user', $user)
             ->bind('messages', $messages)
             ->bind('pager_links', $pager_links);
             $pagination = Pagination::factory(array(
                                 'total_items'    => $user->message_count(),
                                 'items_per_page' => 3,
                                 ));
             $pager_links = $pagination->render();
             $messages = $user->messages->limit($pagination->items_per_page)->offset($pagination->offset)->find_all(); 
             $this->template->content = $content;       
           }
       public function action_private()
       {              
        $this->request->param('id');
        $content = View::factory('profile/private')
        ->bind('user', $user)
        ->bind('messages', $messages)
        ->bind('pager_links', $pager_links);
        $user = Auth::instance()->get_user();
        $message = new Model_Message;
        $messages = $message->get_all();                         
        $this->template->content = $content;
        }


}