<h1>Sign up for КОХАНА ЋАЋА.. You know you want to!</h1> 
<?php echo Form::open(); ?>   <div class="form-field"> 
    <?php echo Form::label('first_name')?> 
    <?php echo Form::input('first_name'); ?>  
</div>   <div class="form-field">      
    <?php echo Form::label('last_name')?>  
    <?php echo Form::input('last_name'); ?>
</div>  
<div class="form-field">   
    <?php echo Form::label('email', 'Email Address')?>
    <?php echo Form::input('email'); ?>
</div>    
<div class="form-field">     
    <?php echo Form::label('password'); ?>   
    <?php echo Form::password('password'); ?> 
</div>  
<div class="form-field">
      <?php echo Form::label('password_confirm', 'Confirm Password')?>
    <?php echo Form::password('password_confirm'); ?>
</div>  
<div class="form-field">
    <?php echo Form::submit('submit', 'Create new account'); ?> 
</div>
<?php echo Form::close(); ?>