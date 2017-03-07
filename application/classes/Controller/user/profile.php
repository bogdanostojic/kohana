<?php defined("SYSPATH") or die("No direct script access.");

class Controller_User_Profile extends Controller_Application 
{
   public function action_index()   
   {            
       //View::factory('gde/se/nalazi/sadrzaj')->postavljamo u globalnu(korisnicko ime i naslov)
    $content = View::factory("profile/public")->set("user", "Taaest User")->bind("messages", $messages);
    //$messages = Request::factory('messages/get_messages')->execute();
    $id =  $this->request->param("id");  
    $messages_uri = "messages/get_messages/$id";
    $messages = Request::factory($messages_uri)->execute();
       
    $this->template->content = $content;  
    }
}