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