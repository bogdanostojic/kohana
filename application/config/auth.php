<?php defined('SYSPATH') or die('No direct access allowed.');
return array(
       'driver'       => 'ORM',
       'hash_method'  => 'sha1',
       'salt_pattern' => '2, 4, 5, 7, 12, 16, 25, 27, 29, 30',
       'lifetime'     => 1209600,
       'session_key'  => 'auth_user',
       'hash_key'	  => 'hash_key_patern',
);