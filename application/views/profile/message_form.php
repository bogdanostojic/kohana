<?php 
$form_type = Request::initial()->action() == 'add' ? 'Create New' : 'Edit' ?> 
<h2><?php echo $form_type; ?> Message</h2> 
<?php echo Form::open(); ?>   
<div class=”field”>    
    <?php $body = isset($value) ? $value : '';?>   
    <?php echo Form::textarea('content', $body); ?>   
</div>
<div class=”field”>  
    <?php echo Form::submit('message_form', "$form_type Message"); ?> 
</div>
<?php echo Form::close(); ?> 