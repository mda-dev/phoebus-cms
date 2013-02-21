<?php 
	if(!defined("PH_VER")){ die(); }
	$queryMsg = NULL;
	$subView = $ph->url->viewRequest(3);
?>

<div id="hero-container" class="full">
	<div class="container">
		<div class="page-header">
			<h1>Blog</h1>
		</div>
	</div>
</div>

<?php 

	if(isset($_POST["new_post"])){
		$queryMsg = $ph->database->insertRow($_POST, "blog");
		$ph->admin->loadSubView("query-msg", $queryMsg);
	}

	if(isset($_POST["delete_post"])){
		$queryMsg = $ph->database->deleteRow($_POST, "blog");
		$ph->admin->loadSubView("query-msg", $queryMsg);
	}

	if(isset($_POST["edit_post"])){
		$queryMsg = $ph->database->updateRow($_POST, "blog");
		$ph->admin->loadSubView("query-msg", $queryMsg);
	}

	if(isset($_POST["new_category"])){
		$queryMsg = $ph->database->newCategory($_POST, "blog");
		$ph->admin->loadSubView("query-msg", $queryMsg);
	}

	if(isset($_POST["delete_category"])){
		$queryMsg = $ph->database->deleteCategory($_POST, "blog");
		$ph->admin->loadSubView("query-msg", $queryMsg);
	}

	if(isset($_POST["edit_category"])){
		$queryMsg = $ph->database->updateCategory($_POST, "blog");
		$ph->admin->loadSubView("query-msg", $queryMsg);
	}
?>



<?php 	
	if($subView){
		if(strstr($subView, "manage")){
			$ph->admin->loadSubView("404");
		}else{
			$ph->admin->loadSubView("blog/" . $subView);
		}
	}else{
		$ph->admin->loadSubView("blog/posts");
	}
?>
