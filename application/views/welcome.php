<h1>Welcome to 
    <?php echo $site_name; ?>
</h1> 
<p>
    <?php echo $random; ?> is a number between 1 and 10 </br>
<<h1>Recent Messages on Egotist</h1>
<?php foreach ($messages as $message) : ?>
   <p class="message">     
       <?php echo $message['content']; ?>  <br />    
            <span class="published"><?php echo Date::fuzzy_span($message['date_published'])?></span>
    
</p> 
<hr/>

<?php endforeach; ?> 

    <?php 
    $encrypt = Encrypt::instance()->encode('super.secret.person@example.com');
    echo "$encrypt </br>";
    $decrypt = Encrypt::instance()->decode($encrypt);
    echo "$decrypt ";
     echo Form::open(); 
            echo Form::input('username', $username);
echo Form::close();




    echo $pager_links; 
?>
</p>