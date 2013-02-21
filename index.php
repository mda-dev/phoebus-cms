<?php
/**
 * Create Phoebus object
 * Load Config file
 */
	require_once ("config.php");
	require_once (PH_ABSPATH ."classes/Phoebus.php");

	//---- DO NOT CHANGE THE FOLLOWING LINE!
	//---------------------------------------
		$ph = new Phoebus();
	//---------------------------------------
		
/**
 * listen for any login-logout requests
 */
	$ph->session->checkLogin();

/**
 * 
 */


	//$ph->media->createThumbs("images", 820);

	if($ph->url->viewRequest(1) == $ph->admin->folder){
		$ph->admin->loadView();
	}else{
		$ph->template->loadView();
	}
	
/*=====
        Close Phoebus Database
===============================================*/
	$ph->database->close_connection();
	unset($ph);


 
 