<?php echo Form::open(); ?>
<?php echo Form::label('username', 'Username')?>  
<?php echo Form::input('username'); ?>     
<?php echo Form::label('password', 'Password')?> 
<?php echo Form::password('password'); ?>    
<?php echo Form::submit('submit', 'Login'); ?>  
    <?php echo Form::close(); ?>