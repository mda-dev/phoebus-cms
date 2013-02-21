<?php

if(!defined('PH_VER')){ exit();}
	$view = $ph->url->viewRequest(2);
	
	//	include footer
	$ph->admin->loadSubView("header");

	if(!$ph->session->is_loggedIn() ){
		$ph->admin->loadView("login");
	}else{

		if(!$view){
			$ph->admin->loadView("dashboard");
		}else{
			$ph->admin->loadView($view);
			// switch ($view) {
			// 	case 'blog':
			// 		$ph->admin->getPage("blog");
			// 		break;

			// 	case 'portfolio':
			// 		$ph->admin->getPage("portfolio");
			// 		break;

			// 	case 'about':
			// 		$ph->admin->getPage("about");
			// 		break;

			// 	case 'website':
			// 		$ph->admin->getPage("website");
			// 		break;
				
			// 	default:
			// 		$ph->admin->getPage("404");
			// 		break;
			// }
		}

	}


	//	include footer
	$ph->admin->loadSubView("footer");


?>