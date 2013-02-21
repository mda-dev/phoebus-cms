<?php  if(!defined("PH_VER")){ die(); } ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php $ph->cssUri('bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php $ph->cssUri('bootstrap-responsive.min.css'); ?>">
        <link rel="stylesheet" href="<?php $ph->cssUri('main.css'); ?>">
        <link rel="stylesheet" href="<?php $ph->cssUri('adm_main.css'); ?>">
        <script src="<?php $ph->jsUri('vendor/modernizr-2.6.2-respond-1.1.0.min.js'); ?>"></script>

    </head>
    <body id="#admin">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
<?php if($ph->session->is_loggedIn()): ?> 
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php $ph->admin->href() ?>">Phoebus Dashboard</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">

                            <li class="dropdown <?php echo $ph->admin->returnMenuClass('active', 'blog'); ?>">
                                <a href="<?php $ph->admin->href("blog/")?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-comment icon-white"></i> Blog <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php $ph->admin->href("blog/new-post")?>">
                                            <i class="icon-edit"></i> Create new post
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php $ph->admin->href("blog/new-category")?>">
                                            <i class="icon-edit"></i> Create new category
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?php $ph->admin->href("blog/posts/")?>">
                                            <i class="icon-th-list"></i> Manage Posts
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php $ph->admin->href("blog/categories/")?>">
                                            <i class="icon-th-list"></i> Manage Categories
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown <?php echo $ph->admin->returnMenuClass('active', 'portfolio'); ?>">
                                <a href="<?php $ph->admin->href("portfolio/")?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-picture icon-white"></i> Portfolio <b class="caret"></b></a>
                                <ul class="dropdown-menu ">
                                    <li>
                                        <a href="<?php $ph->admin->href("portfolio/new-entry/")?>">
                                            <i class="icon-edit"></i> Create new entry
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php $ph->admin->href("portfolio/new-category/")?>">
                                            <i class="icon-edit"></i> Create new category
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php $ph->admin->href("portfolio/new-meta/")?>">
                                            <i class="icon-edit"></i> Create new meta
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?php $ph->admin->href("portfolio/entries/")?>">
                                            <i class="icon-th-list"></i> Manage entries
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php $ph->admin->href("portfolio/categories/")?>">
                                            <i class="icon-th-list"></i> Manage categories
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php $ph->admin->href("portfolio/metas/")?>">
                                            <i class="icon-th-list"></i> Manage metas
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown <?php echo $ph->admin->returnMenuClass('active', 'galleries'); ?>">
                                <a href="<?php $ph->admin->href("gallery/")?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-camera icon-white"></i> Media galleries <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php $ph->admin->href("gallery/new")?>">
                                            <i class="icon-edit"></i> Create new gallery
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?php $ph->admin->href("gallery/galleries/")?>">
                                            <i class="icon-th-list"></i> Manage galleries
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown <?php echo $ph->admin->returnMenuClass('active', 'about'); ?>">
                                <a href="<?php $ph->admin->href("about/")?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-info-sign icon-white"></i> About<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php $ph->admin->href("about/")?>">
                                            <i class="icon-info-sign"></i> Manage about page
                                        </a>
                                    </li>
                     
                                    <li>
                                        <a href="<?php $ph->admin->href("about/resume/")?>">
                                            <i class="icon-user"></i> Manage resume page
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php $ph->admin->href("about/contact/")?>">
                                            <i class="icon-envelope"></i> Manage contact page
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown <?php echo $ph->admin->returnMenuClass('active', 'website'); ?>">
                                <a href="<?php $ph->admin->href("website/")?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-globe icon-white"></i> Website settings <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php $ph->admin->href("website/general/")?>">
                                            <i class="icon-wrench"></i> General settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php $ph->admin->href("website/template/")?>">
                                            <i class="icon-eye-open"></i> Template settings
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="nav pull-right">
                            <li class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-user icon-white"></i> <?php echo $_SESSION["full_name"]?><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a target="_blank" href="<?php $ph->href() ?>">
                                            <i class="icon-share"></i> View website
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?php $ph->admin->href("user-logout") ?>">
                                            <i class="icon-off"></i> Log out
                                        </a>
                                    </li>
                                </ul>
                                
                            </li>
                        </ul>
        

                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
<?php endif; ?>
