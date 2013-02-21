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

	//check for edit form
    if(isset($_POST["edit_entry"])){
        $queryMsg = $ph->database->updateRow($_POST, "portfolio");   
    };

    if(isset($_POST["new_entry"])){
       $queryMsg = $ph->database->insertRow($_POST, "portfolio");
    }

    if(isset($_POST["delete_entry"])){
        $queryMsg = $ph->database->deleteRow($_POST, "portfolio");
    }


	if(isset($_POST["new_category"])){
		$queryMsg = $ph->database->newCategory($_POST, "portfolio");
	}

	if(isset($_POST["delete_category"])){
		$queryMsg = $ph->database->deleteCategory($_POST, "portfolio");
	}

	if(isset($_POST["edit_category"])){
		$queryMsg = $ph->database->updateCategory($_POST, "portfolio");
	}

	if(isset($_POST['delete_meta'])){
        $queryMsg = $ph->database->deleteMeta($_POST);
    }

    if(isset($_POST['new_meta'])){
        $queryMsg = $ph->database->newMeta($_POST);
        $ph->admin->loadSubView("query-msg", $queryMsg);
    }

    if(isset($_POST['edit_meta'])){
        $queryMsg = $ph->database->updateMeta($_POST);
    }

    if($queryMsg){
    	$ph->admin->loadSubView("query-msg", $queryMsg);
    }

?>



<?php 	
	if($subView){
		if(strstr($subView, "manage")){
			$ph->admin->loadSubView("404");
		}else{
			$ph->admin->loadSubView("portfolio/" . $subView);
		}
	}else{
		$ph->admin->loadSubView("portfolio/entries");
	}
?>
