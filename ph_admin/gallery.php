<?php 
    if(!defined("PH_VER")){ die(); }
    $queryMsg = NULL;
    $subView = $ph->url->viewRequest(3);
?>

<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
            <h1>Galleries</h1>
        </div>
    </div>
</div>

<?php 
    
    if(isset($_POST["new_gallery"])){
        $queryMsg = $ph->database->newGallery($_POST);
    }
    if(isset($_POST["edit_gallery"])){
        $queryMsg = $ph->database->updateGallery($_POST);
    }

    if(isset($_POST["delete_gallery"])){
        $queryMsg = $ph->database->deleteRow($_POST, "galleries");
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
            $ph->admin->loadSubView("gallery/" . $subView);
        }
    }else{
        $ph->admin->loadSubView("blog/posts");
    }
?>