<h1>Welcome to 
    <?php echo $site_name; ?>
</h1> 
<p>
    <?php echo $random; ?> is a number between 1 and 10 </br>

    <?php 
    $encrypt = Encrypt::instance()->encode('super.secret.person@example.com');
    echo "$encrypt </br>";
    $decrypt = Encrypt::instance()->decode($encrypt);
    echo "$decrypt ";
     echo Form::open(); 
            echo Form::input('username', $username);
echo Form::close();

    
?>
</p>