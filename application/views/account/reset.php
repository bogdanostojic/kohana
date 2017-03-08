<?php
    echo Form::open();
    echo Form::label('old_password', 'Old Password');
    echo Form::password('password'); 
    echo Form::label('new_password', 'New Password');
    echo Form::password('password'); 
    echo Form::close();

    $content = 'This is a test message';
    $author = 'Joe Tester'; 
    $timestamp = time() - 2500;   
   echo Html::message($content, $author, $timestamp); 

?>