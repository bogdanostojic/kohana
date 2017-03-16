<div id="logo">   
    <img src="<?php echo URL::base(); ?>media/images/logo.jpg" alt="<?php echo $site_name; ?>" style="height: 100px ; width: 150px;"/>
</div> 
<p id=»tagline»>   <em>Because it›s all about you!</em> </p>
<ul id=»main_nav»> 
    <li><a href="<?php echo URL::site(); ?>">Home</a></li> 
    <li><a href="<?php echo URL::site("page/about"); ?>">About <?php echo $site_name; ?></a></li>  
    <li><a href="<?php echo URL::site("page/why_egotist"); ?>">Why use Egotist?</a></li>
      <li><a href="<?php echo URL::site("/messages/add/1"); ?>">Add message</a></li>
</ul> 

 <p>Copyright &copy; 2011 - <?php echo $site_name; ?></p>