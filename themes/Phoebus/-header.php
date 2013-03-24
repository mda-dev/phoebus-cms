<?php 
    // deny any direct access to the file
    if(!defined("PH_VER")){ die(); }

    extract($ph->settings);



?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Le CSS 
======================================-->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php $ph->cssUri('bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?php $ph->cssUri('bootstrap-responsive.css')?>">
        <link rel="stylesheet" href="<?php $ph->cssUri('flexslider.css')?>">
        <link rel="stylesheet" href="<?php $ph->cssUri('main.css')?>">
        <link rel="stylesheet" href="<?php $ph->cssUri('colorbox.css')?>">

        <!-- Modernizer -->
        <script src="<?php $ph->jsUri('vendor/modernizr-2.6.2-respond-1.1.0.min.js')?>"></script>
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

<!-- Le Content
======================================-->

<div class="wrap-all">
        <div class="navbar  navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php $ph->href() ?>"><?php echo $title ?></a>
                    <!-- start nav-collapse -->
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="<?php echo $ph->template->returnMenuClass('active', 'home', true) ?>">

                                <a href="<?php $ph->href() ?>">
                                    Home
                                </a>
                            </li>

                            <li class="<?php echo $ph->template->returnMenuClass('active', 'about') ?>">
                                <a href="<?php $ph->href('about') ?>">About</a>
                            </li>
                            
                            <li class="<?php echo $ph->template->returnMenuClass('active', 'portfolio') ?>">
                                <a href="<?php $ph->href('portfolio') ?>">Portfolio</a>
                            </li>

                            <li class="<?php echo $ph->template->returnMenuClass('active', 'contact') ?>">
                                <a href="<?php echo $ph->href('contact') ?>">Contact</a>
                            </li>
                            
                            <li class="dropdown <?php echo $ph->template->returnMenuClass('active', 'blog') ?>">

                                <a href="<?php $ph->href('blog')?>" class="dropdown-toggle" data-toggle="dropdown">Blog<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php $ph->href('blog')?>">All blog Posts</a></li>

                                    <?php if ($blogCategories): ?>
                                    <li class="divider"></li>
                                        <?php foreach ($blogCategories as $category):?>
                                        <li>
                                            <a href="<?php $ph->href('blog/categories/'. $category["slug"])?>">
                                                <?php echo $category["title"]?>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>

                        <form action="<?php $ph->href("search/") ?>"  method="get" class="navbar-form pull-right">
                            <div class="input-prepend">
                                <button class="btn">Search</button>
                                <input name="for" class="" id="search-input" type="text" placeholder=" ...">
                            </div>
                        </form>
                        <?php if($ph->session->is_loggedIn()):?>

                        <!-- start admin-nav -->
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="<?php $ph->admin->href(); ?> " class="dropdown-toggle" data-toggle="dropdown">Administrator<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php $ph->admin->href();?>" >Admin Dashboard</a></li>
                                    <li><a href="<?php $ph->admin->href('user-logout');?>" >Log Out</a></li>
                                    <li class="nav-header">Admin Actions</li>
                                    
                                    <li><a href="<?php $ph->admin->href("blog/new")  ?>">New Blog Item</a></li>
                                    <li><a href="<?php $ph->admin->href("portfolio/new") ?>">New Portfolio Item</a></li>

                                </ul>
                            </li>
                        </ul><!-- #end admin-nav -->
                        <?php endif; ?>

                    </div><!-- #end nav-collapse -->
                </div>
            </div>
        </div>