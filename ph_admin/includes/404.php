<?php 
if(!defined("PH_VER")){ die();}	
?>
<div id="oh-snap-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="alert alert-error">
					<h2>Something went wrong!</h2>
					<h3>Probabile reasons you are seeing this page:</h3>
					<ul>
						<li>
							<h4>You have clicked on an invalid link.</h4>
						</li>
						<li>
							<h4>You have typed an invalid address.</h4>
						</li>
					</ul>
					<h3>Other things to try:</h3>
					<ul>
						<li>
							<h4>
								<a href="<?php echo $ph->admin->href() ?>" class="error-link">Go back to admin dashboad</a>
							</h4>
						</li>
						<li>
							<h4>
								<a href="#" class="error-link back">Go back to the previous page</a>
							</h4>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
