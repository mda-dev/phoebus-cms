<?php 
	// deny any direct access to the file
    if(!defined("PH_VER")){ die(); }
    global $ph;

?>

<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
        	<h1>Contact Page<small>Subtext for header test</small></h1>
        </div>

    </div>
</div>

<div id="contact-container">
	<div class="container after-hero">
		<div class="row">
			<div class="span8">
				<form class="well stack">
					<fieldset>
						<div id="#info">
							<div class="alert alert-info">
								<strong>Note:</strong> Fields marked with <strong>[ * ]</strong> are required
							</div>
						</div>

						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i></span>
							<input class="span3" id="prependedInput" type="text" placeholder="[ * ]Name...">
						</div>

						<div class="input-prepend">
							<span class="add-on"><i class="icon-envelope"></i></span>
							<input class="span3" id="prependedInput" type="email" placeholder="[ * ]Email address...">
						</div>

						<div class="input-prepend">
							<span class="add-on"><i class="icon-pencil"></i></span>
							<input class="span3" id="prependedInput" type="text" placeholder="[ * ]Subject...">
						</div>
						<br>
						<label>Message: </label>
						<label>
							<textarea rows="9" class="span6" placeholder="[ * ]Write your message in here :)"></textarea>
						</label>

						<br>
						<button type="submit" class="btn">Submit</button>
					</fieldset>
				</form>
			</div>

			<aside class="span4">
				<div class="thumbnail">
					<img src="http://placekitten.com/400/600" alt="">
				</div>
			</aside>

		</div>
	</div>
</div>