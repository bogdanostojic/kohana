<?php 
defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller 
{

    public function action_getusers(){
    
    if(!$this->request->is_ajax())
      throw new HTTP_Exception_403;
    
    /*    sleep(2);
            
        $this->response->body(json_encode(array(
            'Test #1', 'Test #2', 'Test #3'
        )));*/


    /*            sleep(1);
        $user = Auth::instance()->get_user()->email;
        $this->response->body(json_encode(array(
            $user
        )));
        */
        $users = ORM::factory('user');
        $u = $users->find_all();
        
        $us = array();
        foreach ($u as $v)
        {
            array_push($us, $v->username);
        }   
        sleep(1);
        $this->response->body(json_encode($us));


  }             

}
?>