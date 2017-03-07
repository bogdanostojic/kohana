<?php
defined('SYSPATH') or die('No direct script access.');
class Controller_Page extends Controller_Application
{  
    public function action_about() 
    {      
    //View::set_global('site_name', 'Beta');
    $content = View::factory('pages/about');
    $this->template->content = $content;   
    } 
      public function action_why_egotist()   
      {
         // View::set_global('site_name', 'Delta');   
          $content = View::factory("pages/why_egotist");  
          $this->template->content = $content; 
      }
} 