<?php require_once 'config.inc.php'; ?>
    <script type="text/javascript">
    function initFB() {
        FB_RequireFeatures(["XFBML"], function(){
            FB.init("<?php echo $api_key; ?>", "xd_receiver.htm");
        });}
    </script>
    </body>
</html>