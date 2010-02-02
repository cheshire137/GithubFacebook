<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <!-- Include external files and scripts here (See HTML helper for more info.) -->
        <?php echo $scripts_for_layout ?>
    </head>
    <body>
        <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US" type="text/javascript"></script>
        <h1>Github Activity : <?php echo $title_for_layout; ?></h1>
        
        <fb:dashboard>
            <fb:action href="users">Users</fb:action>
        </fb:dashboard>
        
        <div class="container">
            <?php echo $content_for_layout; ?>
        </div>
        
        <script type="text/javascript">
            FB.init("b21dbdef364779f80d79072a4b3a8f17", "xd_receiver.htm");
        </script>
    </body>
</html>