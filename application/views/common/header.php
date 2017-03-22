<div id="logo">   
    <img src="<?php echo URL::base(); ?>media/images/logo.jpg" alt="<?php echo $site_name; ?>" style="height: 100px ; width: 150px;"/>
</div> 
<p id=»tagline»>   <em>Because it›s all about you!</em> </p>
<ul id=»main_nav»> 

</ul> 

<p id="account">

<?php if (Auth::instance()->logged_in()       && $user = Auth::instance()->get_user()) : ?>      Logged in as <?php echo $user->username; ?>.  <?php echo HTML::anchor('logout', 'Logout'); ?>
	<?php echo HTML::anchor('messages/add', 'New Message'); ?>
	   <li><a href="<?php echo URL::site(); ?>">Home</a></li> 
	       <li><a href="<?php echo URL::site("page/about"); ?>">About <?php echo $site_name; ?></a></li>  
    <li><a href="<?php echo URL::site("page/why_egotist"); ?>">Why use Egotist?</a></li>
<?php else: ?>
	<br>
       <?php echo HTML::anchor('login', 'Login'); ?> | <?php echo HTML::anchor('signup', 'Signup'); ?>
<?php endif; ?>

</p>
 <p>Copyright &copy; 2011 - <?php echo $site_name; ?></p>