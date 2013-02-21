<?php if(!defined("PH_VER")){die();} ?>

<div id="message-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="alert alert-<?php echo $status ?>">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h3><?php echo ucfirst( $ph->queryResult( $status ) )?>!</h3>
					<?php 
						if(gettype($info) == "array"){
			                foreach ($info as $value) {
			                    echo "$value<br />";
			                }
			            }else{
			                echo $info;
			            }
		            ?>
				</div>
			</div>
		</div>
	</div>
</div>
