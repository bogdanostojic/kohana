<h1>Sign up for Egotist.. We know we want to!</h1>
<?php echo Form::open(); ?>
        <div class="form-field">       
             <?php echo Form::label('username')?> 
                         <?php echo Form::input('username'); ?>   
        </div>
        <div class="form-field">     
                <?php echo Form::label('email', 'Email Address')?>      
                <?php echo Form::input('email'); ?>        
        </div>
        <div class="form-field">       
             <?php echo Form::label('password', 'Password')?>
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