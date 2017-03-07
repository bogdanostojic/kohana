<?php defined("SYSPATH") or die("No direct script access.");


class Controller_User_Messages extends Controller 
{
   public function action_index()  
   {           
       URL::redirect();   
   }
   public function action_get_messages() 
   {     
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
   }
}

?>