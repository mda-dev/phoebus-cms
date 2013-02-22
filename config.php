<?php
	

	/**
	 * DEFINE PHOEBUS VERSION
	 */
	define("PH_VER", 1.0);



	/**
	 * DEFINE PHOEBUS ABSOLUTE PATH AND DIRECTORY
	 */
	define("PH_ABSPATH", dirname(__file__)."/");
	define("PH_DIR", str_replace($_SERVER['DOCUMENT_ROOT'], "", PH_ABSPATH) );
	//define("PH_DIR", "//");

	/**
	 * DEFINE PHOEBUS URL
	 */
	$protocol='http:';
		if(isset($_SERVER['HTTPS'] )) {
			$protocol='https:';
		}
	define("PH_URL", $url = $protocol . "//" . $_SERVER['SERVER_NAME'] . PH_DIR);



	/**
	 *  SET DEFAULT ADMIN PATH
	 */
	define("PH_ADMIN_LOCATION", "admin");

	/**
	 * DEFINE DEFAULT THEME
	 */
	define("PH_THEME", "Phoebus");


	/**
	 * DEFINE DEFAULT WEBSITE NAME
	 */
	define("WEBSITE", "Phoebus CMS");


	/**
	 * DEFINE DATABASE CONSTANTS
	 */
	
	//database prefix
	define("DB_PREFIX", "ph_");
	define("DB_HOST",	"localhost");
	define("DB_USER",	"root");
	define("DB_PASS",	"root");
	define("DB_NAME",	DB_PREFIX . "cms");


	define("PH_DEVELOP_MODE", TRUE);

?>