<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User_Account extends Controller_Application 
{
       /*public function action_login() 
            {             
                if (Auth::instance()->logged_in())
                            {          
                                Request::instance()->redirect('profile/private'); 
                            }
             $this->template->content = View::factory('account/login')->bind('user', $user)->bind('errors', $errors); 
             if ($_POST)
                {
                    $user = ORM::factory('user');
                    $status = $user->login($_POST);

                    if ($status)
                        { 
                            $this->redirect('register');
                        }
                    else
                        {
                            $errors = $_POST->errors('login');
                        }
                    }
            }*/

            public function action_login()
   {  

    $validation = Validation::factory($this->request->post())
                      ->rule('username', 'not_empty')
                      ->rule('username', 'min_length', array(':value', 2))
                      ->label('username', 'Korisnicko ime')
                      ->rule('password', 'not_empty')
                      ->label('password', 'Lozinka');

      if (Auth::instance()->logged_in()){
         $this->redirect("profile/private", 302);
      }

      $this->template->content = View::factory('account/login')
            ->bind('user', $user)
            ->bind('errors', $errors);    
      
      if ($_POST)
      {
          $post = $this->request->post();
             $status = Auth::instance()->login($post['username'], $post['password']);
             if ($validation->check() && $status) {
                $this->redirect("profile/private", 302);
             }
             else {
                $errors = $validation->errors("login");

             }  
      }  
   }



       public function action_logout()
       {
        Auth::instance()->logout();
        $this->redirect('login');
        }

       public function action_signup() 
   {
        $validation = Validation::factory($this->request->post())
                          ->rule('username', 'not_empty')
                          ->rule('username', 'min_length', array(':value', 2))
                          ->label('username', 'Korisnicko ime')

                          ->rule('password', 'not_empty')
                          ->label('password', 'Lozinka')

                          ->rule('password_confirm', 'not_empty')
                          ->rule('password_confirm', 'matches' , array(':validation' , 'password_confirm', 'password'))

                          ->label('email', 'E-mail')
                          ->rule('email', 'not_empty');

  
      $this->template->content = View::factory('account/signup');

      if ($_POST) {
          $user = new Model_User;
         $user->values($_POST);
         if ($validation->check()) {
            $user->save();
            $role = ORM::factory('role')->where('name', '=', 'login')->find();
            $user->add('roles', $role);
            $this->redirect("page/about");
         }
         else {
            $errors = $validation->errors("signup");
            $a = $this->request->post();
            $this->template->content = View::factory('account/login')
            ->bind('post', $a)
            ->bind('errors', $errors);
         }
      }

   }



       /*public function action_signup()
       {
        $content = View::factory('account/signup');
        $this->template->content = $content;
            if ($_POST)
                {
                    $user = new Model_User;
                    $post = $user->validate_create($_POST);
                    if ($post->check())
                        {
                            $user->values($post);
                            $user->save();
                            $user->add('roles', ORM::factory('role')->find(1));
                        }
                    else 
                        {
                            $this->errors = $post->errors('signup');
                            Request::instance()->redirect('signup');
                        }
                        Request::instance()->redirect('');
                }
        }*/
}