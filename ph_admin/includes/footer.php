<?php
    if(!defined("PH_VER")){ die(); }
    global $ph;
?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php $ph->jsUri('vendor/jquery-1.9.0.min.js'); ?>"><\/script>')</script>
        <script src="/ph/ph_resources/ckeditor/ckeditor.js"></script>
        <script src="<?php $ph->jsUri('vendor/bootstrap.min.js');?>"></script>
        <script src="<?php $ph->jsUri('adm_main.js');?>"></script>
        <script src="<?php $ph->jsUri('plugins.js');?>"></script>
        <script>
        //     var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
        //     (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        //     g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        //     s.parentNode.insertBefore(g,s)}(document,'script'));
        // </script>
    </body>

</html>