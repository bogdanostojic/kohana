<haed>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
</haed>
<h2>Private Profile for <?php echo $user->username; ?></h2>
<h3>Our Recent Messages:</h3> <?php if ($messages) : ?>
	<script>
	 
			jQuery.ajax({url: "<?php echo URL::site('ajax'); ?>", 
			       success: function(result) {
						var data = JSON.parse(result);
				console.log(data);	
				
				jQuery('#ajax-box').text('');
				
				for(var i in data){
					console.log(data[i]);
					
				jQuery('#ajax-box').append('<p id="ime">' + data[i] + '</p>');


				}
			}});
	
			</script>
			<h1>Kohana AJAX example</h1>
		<div id="ajax-box">Loading...</div>
       <?php foreach($messages as $message) : ?>     
                <p class="message">              
                      <?php echo $message->content; ?>           
                               <br />                 
                                  <span class="published">
                                  <?php echo Date::fuzzy_span($message->date_published)?>
                                  </span>             
                                         <?php if (time() - $message->date_published < 900) : ?>                       
    <div class="options">                            
      <a href="<?php echo url::site("messages/edit/{$message->user_id}/{$message->id}") ?>">Edit Message</a> 
      |
      <a href="<?php echo url::site("messages/delete/{$message->user_id}/{$message->id}") ?>">Delete Message</a>     
    </div>       
        <?php endif; ?> 
         </p>
         <hr/>
     <?php endforeach; ?> <?php else: ?>  
          <p>We have no messages in the system.</p>
           <?php endif; ?>
            <p>
            <?php echo HTML::anchor('messages/add', 'Create New Message'); ?>
            </p>
