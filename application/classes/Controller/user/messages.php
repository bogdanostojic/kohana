<?php defined("SYSPATH") or die("No direct script access.");


class Controller_User_Messages extends Controller_Application
{
   public function action_index()  
   {           
       URL::redirect();   
   }
   public function action_get_messages() 
   {     
       /*
       $id = (int) $this->request->param("id"); 
      $messages = array(  
          1=> array(
            "This is test message one",
            "This is test message one",
            "This is test message one"
      ),
          2=> array(
            "This is test message two",
            "This is test message two",
            "This is test message two"
      ),
          3=> array(
            "This is test message three",
            "This is test message three",
            "This is test message three"
      )
      );            
       $messages = array_key_exists($id, $messages) ? $messages[$id] : NULL; 
       $this->response->body(View::factory('profile/messages')->set('messages', $messages));
       */
       
        $messages = new Model_Message;      
       $user_id = $this->request->param('id');   
       $message_count = $messages->count_all($user_id); 
       
       if($user_id)
       {
           $message_count = $messages->where('user_id', '=', $user_id)->count_all();
       }
       else
       {
           $message_count = $messages->count_all();
           
       }
       $pagination = Pagination::factory(array(       
           'total_items'   => $message_count,   
           'items_per_page' => 3,      
       ));       
       $pager_links = $pagination->render(); 
       $messages = $messages->get_all($pagination->items_per_page,   $pagination->offset, $user_id);
        $this->template->content = View::factory('profile/messages')
            ->set('messages', $messages)
            ->set('pager_links', $pager_links); 
   }
    
    public function action_add() 
    {   
        $messages = new Model_Message;  
        $user_id = $this->request->param('id');   
        $this->template->content = View::factory('profile/message_form');  
        if (isset ($_POST) &&  isset($_POST['content']))    
        {      
            $messages->create_message($user_id, (string) $_POST['content']); 
           // $redirect = URL::site('messages/get_messages/$user_id'); 
            //Request::instance()->redirect($redirect);    
            
            $this->redirect("messages/get_messages/$user_id");
        }        
    }
     public function action_edit()   
     {
         
      
      $user_id = $this->request->param('user_id');
      $message_id = $this->request->param('message_id');
      //$messages = new Model_Message;
      $messages = ORM::factory('Message',$message_id);
      $message = $messages->get_message($message_id);
      if ($messages->user_id != $user_id) 
      {         
          throw new Exception("User is not owner of the message");     
      }
      $this->template->content = View::factory('profile/message_form')->bind('value', $message['content']);
      if ($_POST && $_POST['content'])  
      {      
          $messages->update_message($_POST['content']);
          $this->redirect("messages/get_messages/$user_id");
         // $redirect = url::site("messages/get_messages/$user_id"); 
        //  Request::instance()->redirect($redirect);   
      }
   }
    
    public function action_delete()
    {

        $user_id = $this->request->param('user_id'); 
        $message_id = $this->request->param('message_id'); 

        $message = ORM::factory('Message', $message_id);     //Preko $message->find() ne funkcionise, radi samo ovako.
        if ($message->user_id != $user_id)
        { 
            throw new Exception("User is not owner of the message");   
        }            
       // i jedno i drugo radi;
       // $messages->delete($message_id);    
          $message->delete();
        
        //Radi ORM-ova Delete funkcija, sa
        $this->redirect("messages/get_messages/$user_id");
    }
}

?>