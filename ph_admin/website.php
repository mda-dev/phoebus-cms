<?php 
	if(!defined("PH_VER")){ die(); }
	$queryMsg = NULL;
	$subView = $ph->url->viewRequest(3);
?>

<div id="hero-container" class="full">
	<div class="container">
		<div class="page-header">
			<h1>Website Settings</h1>
		</div>
	</div>
</div>

<?php 

	
?>



<?php 	
	if($subView){
		if(strstr($subView, "manage")){
			$ph->admin->loadSubView("404");
		}else{
			$ph->admin->loadSubView("website/" . $subView);
		}
	}else{
		$ph->admin->loadSubView("website/general");
	}
?>