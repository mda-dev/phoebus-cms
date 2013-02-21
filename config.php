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


	/**
	 * DEFINE SECURITY KEYS
	 */
	define("PH_AUTH_KEY",        'g^F#g4lQ:JIxd$CJx|R3=P7ZNh~m^VBT*u^6dZ$.y*Bc=/*sei5A`By(DY&orM-_');
	define("PH_SALT_KEY",		 'S-s4Y&&6.i>rE|!kqiFEB+`A^UZp+HtUF7k8t#m^*+#_a5njBMz$mp) (q)fIOL<');


	define("PH_DEVELOP_MODE", TRUE);

?>