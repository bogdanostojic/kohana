<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Korisnik Model
 * Handles CRUD for user messages
 */
class Model_User extends Model_Auth_User {
   // Table name used by this model
   protected $_table = 'users';

  protected $_has_many = array(
              'user_tokens' => array('model' => 'user_token'),
              'roles' => array('model' => 'role', 'through' => 'roles_users')
            );
  protected $_ignored_columns = array('password_confirm');   

}











/* defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Auth_User 
{
       protected $_has_many = array(  
                   'user_tokens' => array('model' => 'user_token'),     
                   'roles'       => array(
                      'model' => 'role', 
                      'through' => 'roles_users'), 
                    'messages'     => array('model' => 'message')  

                         );
       protected $_labels = array(    
                'username'         => 'Username',  
                'email'            => 'Email Address',   
                'password'         => 'Password',  
                'password_confirm' => 'Password Confirmation'
                      );            

      protected $_ignored_columns = array('password_confirm');


   public function validate_create($array)       
    {           
           $array = Validation::factory($array)->rule('username', 'not_empty')
                      ->rule('username', 'min_length', array(':value', 2))
                      ->label('username', 'Korisnicko ime')
                      ->rule('password', 'not_empty')
                      ->label('password', 'Lozinka');

             if (Auth::instance()->logged_in()){
         $this->redirect("logged", 302);
      }

      $this->template->content = View::factory('profile/messages')
            ->bind('user', $user)
            ->bind('errors', $errors);    
      
      if ($_POST)
      {
          $post = $this->request->post();
             $status = Auth::instance()->login($post['username'], $post['password']);
             if ($validation->check() && $status) {
                $this->redirect("logged", 302);
             }
             else {
                $errors = $validation->errors("login");

             }  
      }    
    }

    public function validate_update($array)  
     {      
                  $array = Validate::factory($array)
                  ->rules('username', $this->_rules['username'])
                  ->rules('email', $this->_rules['email'])
                  ->label('username', $this->_labels['username'])
                  ->label('email', $this->_labels['email']);

              foreach($this->_callbacks as $key => $value)  
                 {        
                   $array->callback($key, array($this, $value));
                 }
             return $array; 
      }              

    public function validate_update_password($array) 
      {          
          $array = Validate::factory($array)
          ->rules('password', $this->_rules['password'])
          ->rules('password_confirm', $this->_rules['password_confirm'])
          ->label('password', $this->_labels['password'])
          ->label('password_confirm', $this->_labels['password_confirm']);
             return $array;      
       }   
}
*/