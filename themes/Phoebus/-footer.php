<?php 
    // deny any direct access to the file
    if(!defined("PH_VER")){ die(); }

?>  
    <!-- pus div for sticky footer -->
    <div class="push"></div>

    </div><!-- # end wrapp-all -->
        <!-- start .footer -->
        <footer class="footer full">
            <div class="container">
                <p>Designed by <a href="#" target="_blank">@mdadesigns</a> with <a href="#" target="_blank">Boostrap 2.2.0</a>.</p>
                <p>Powered by <a href="#">Phoebus CMS</a> &amp; <a target="_blank" href="http://isotope.metafizzy.co/">jQuery Isotope</a>.</p>
                <p>Code licensed under <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License v2.0</a>, documentation under <a href="http://creativecommons.org/licenses/by/3.0/">CC BY 3.0</a>.</p>
                <p>Page rendered in <span class="color"><?php echo $ph->renderTime(); ?></span> seconds.</p>
            </div>
            <a id="ph-tt" href="#"><i class="icon-arrow-up icon-white"></i></a>
            <?php //if(!$ph->session->is_loggedIn()): ?>
            <!-- Modal -->
            <div id="login-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Please enter your login credentials</h3>
                    </div>
                    <div class="modal-body">
                        <section id="login_message">
                            <div class="alert alert-info ">
                                <strong>Note:</strong> Username and password are case sensitive!
                            </div>
                        </section>
                        <form id="login-form" method="post" action="<?php $ph->admin->href("login/") ?>">
                            <fieldset>
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <input class="span3" name="login_form_username"  type="text" placeholder="[ * ]Username...">
                                </div>
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-asterisk"></i></span>
                                    <input class="span3"  name="login_form_password" type="password" placeholder="[ * ]Password...">
                                </div>
                                <br>
                                <p id="modal-load-animation">
                                    <span>Please Wait...</span>
                                </p>
                                <input type="hidden" name="login_form" value="log-in">
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a style="margin-right:25px;" href="#">Forgot your password? </a>
                        <a id="modal-login-btn" href="<?php $ph->admin->href("login/") ?>" class="btn btn-ph">Log In</a>
                    </div>
                
            </div>
        </footer><!-- #end .footer -->

        

<!-- Le Javascript  
======================================-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php $ph->jsUri('vendor/jquery-1.9.0.min.js'); ?>"><\/script>')</script>
        <script src="<?php $ph->jsUri('vendor/jquery.easing.js')?>"></script>
        <script src="<?php $ph->jsUri('vendor/jquery.colorbox.js')?>"></script>
        
        <script src="<?php $ph->jsUri('vendor/jquery.preloader.js')?>"></script>
        <script src="<?php $ph->jsUri('vendor/jquery.flexslider.min.js')?>"></script>
        <script src="<?php $ph->jsUri('vendor/jquery.isotope.js')?>"></script>
        <script src="<?php $ph->jsUri('vendor/bootstrap.min.js');?>"></script>
        <script src="<?php $ph->jsUri('main.js');?>"></script>
        <script src="<?php $ph->jsUri('plugins.js');?>"></script>
        <!--
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        -->
    </body>
</html>
