<?php 
	if(!defined("PH_VER")){ die(); }
	global $ph;

	$loginErrors = $ph->session->loginErrors;

	if($loginErrors){ $alertType = "error"; }else{ $alertType = "info"; }

?>

<div>
<style>
	body{ background: url("<?php $ph->imgUri('hero-bg.jpg') ?>") repeat center #320951; }
</style>

<div id="login-modal" class="modal" tabindex="-1" style="text-align:center;" >
	<form id="login-form" method="post" action="/ph/admin/">

		<div class="modal-header">
			<h3 id="myModalLabel">Please enter your login credentials</h3>
		</div>
		<div class="modal-body">
			<section id="login_message">
				<div class="alert alert-<?php echo $alertType ?>">
					<?php if($loginErrors): ?>
							<h3>Oh snap!</h3>
						<?php if(isset($loginErrors['username'])): ?>

							User: <strong><?php echo $_POST['login_form_username']?></strong> could not be found!
						<?php endif; ?>

						<?php if(isset($loginErrors['password'])): ?>
							Password for <strong><?php echo $_POST['login_form_username']?></strong> was incorrect!
						<?php endif; ?>

					<?php else: ?>
						<strong>Note:</strong> Username and password are case sensitive!
					<?php endif; ?>
				</div>
			</section>

			<fieldset>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input class="span3" name="login_form_username" type="text" placeholder="Username...">
				</div>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-asterisk"></i></span>
					<input class="span3" name="login_form_password" type="password" placeholder="Password...">
				</div>
				<br>
				<p id="modal-load-animation">
					<span>Please Wait...</span>
				</p>
			</fieldset>

		</div>
		<div class="modal-footer">
			<a style="margin-right:25px;" href="#">Forgot your password? </a>
			<button type="submit" class="btn btn-ph" name="login_form">Log In</a>
		</div>
	</form>
</div>



</div>

