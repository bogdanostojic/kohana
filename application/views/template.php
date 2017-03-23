<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head> <?php foreach ($styles as $style) : ?> 
    <link  rel="stylesheet" href="<?php echo URL::base(); ?>media/css/<?php echo $style ; ?>.css" type="text/css" media="screen" /> 
    <?php endforeach; ?> 
    <?php foreach ($scripts as $script) : ?>   <script src=»<?php echo URL::base(); ?>media/js/<?php echo $script; ?>.js» /></script> <?php endforeach; ?>
<title><?php echo $site_name; ?></title>
</head>
    
    <body>   
        <div id="container">  
            <div id="header">    
                <?php echo View::factory('common/header'); ?>
      </div>     
            <div id="content">    
                <?php echo $content; ?>    
            </div>    
            <div id="footer">  
                <?php echo View::factory('common/footer'); ?>  
            </div>  
        </div> 
</body>
</html>