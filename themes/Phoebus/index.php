<?php
    // deny any direct access to the file
    if(!defined("PH_VER")){ die(); }

    $view = $ph->url->viewRequest(1);

$data = array(
            "blogCategories" => $ph->database->getTable("blog_categories")  
        );


$ph->template->loadSubView("-header", $data);

    if($view){
        $ph->template->loadView($view, $data);
    }else{
        $ph->template->loadView("home", $data);
    }

$ph->template->loadSubView("-footer", $data);
