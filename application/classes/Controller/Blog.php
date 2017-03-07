<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Blog extends Controller {

	public function action_index()
	{
        $post = ORM::factory('post')->find_all();
		$this->response->body($post[1]->body);
	}
    
} // End Welcome