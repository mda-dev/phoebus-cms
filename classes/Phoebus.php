<?php
/**
* Main Phoebus class
*/
class Phoebus
{
	private $_startTime;
	public $settings; 
	public $url;
	public $database;
	public $session;
	public $admin;
	public $tempalte;
	public $media;
	public $dir; 	

	function __construct()
	{

		$this->dir = PH_DIR;
		$this->_includeClasses();

    	/**
    	 * Define database object (handles all mySql queries)
    	 * @var Phoebus_database
    	 */
    	$this->database = new Phoebus_database();
		// do activation stuff :)
    	$_settings = $this->database->getRow("settings");
    	$themeName = $_settings["theme"];

		/**
		 * Define session object (handles user log-in log-out functions)
		 * @var Phoebus_session
		 */
		$this->session = new Phoebus_session();
		/**
		 * Define template object (handles loading of template files)
		 * @var Phoebus_template
		 */
		$this->template = new Phoebus_template($themeName);
		/**
		 * Define admin object (handles admin tempalte files and admin operations)
		 * @var Phoebus_admin
		 */
		$this->admin = new Phoebus_admin($this);
		/**
		 * Define cleanUrl onject (hadles sections of the url)
		 * @var Phoebus_cleanUrl
		 */
		$this->url = new Phoebus_cleanUrl($_SERVER['REQUEST_URI']);


		$this->media = new Phoebus_media;

		$this->_startTime = microtime(true);

		$this->settings = $this->database->getRow("settings");


	}

	public function __toString()
	{
		echo PH_URL;
	}

	public function dbCount($table)
	{
		$rows = $this->database->getTable($table);
		$count = count($rows);
		
		// insert leading zero if one digit number
		$val = sprintf("%02u", $count);


		return $val;
	}

	/**
	 * the time it took the server to render the page
	 * @return float [ex: 0,0001]
	 */
	public function renderTime()
	{
		$start = $this->_startTime;
		$end = microtime(true);
		$elapsedTime = round(($end - $start), 4);

		return $elapsedTime;
	}

	/**
	 * Echos a link from Phoebus instalation directory
	 * @param  string $string [aditional data passed to the href]
	 */
	public function href($string = "")
	{
		echo PH_URL .  $string;
	}

	/**
	 * Get current date in [weekday] [day]'th [month][year] format
	 * @return [type] [description]
	 */
	public function getDate()
	{
		return date('l jS \of F Y');
	}


	/**
	 * Automaticly include all subclass file
	 * @return [void]
	 */	
	private function _includeClasses()
	{
		$classFiles = PH_ABSPATH ."classes/";

		$classDir = opendir($classFiles);

		while($classFile = readdir($classDir)){
			$_tmp = explode(".", $classFile);
			$count = count($_tmp);
			$extention = $_tmp[$count - 1];

			if( $extention == "php" && 
				//ignore main file
				$classFile !== "Phoebus.php"){
				require_once($classFiles .$classFile);
		}
	}


	/**
	 * Funny localization of some strings
	 * @param  [string] $value [string to be localized]
	 * @return [string]        [localized string]
	 */
	public function queryResult($value)
	{
		if($value == "success"){
			return "hurray";
		}
		if($value == "error"){
			return "oh snap";
		}

		return $value;
	}

	/**
	 * Echoes a url from the resource/css folder
	 * @param  [string] $value [filename] ex: main.css
	 * @return [void]
	 */
	public function cssUri($value= "")
	{
		echo PH_URL . "ph_resources/css/" . $value;
	}

	/**
	 * Echoes a url from the resource/js folder
	 * @param  [string] $value [filename] ex: main.css
	 * @return [void]
	 */
	public function jsUri($value = "")
	{
		echo PH_URL . "ph_resources/js/" . $value;
	}

	/**
	 * Echoes a url from the resource/img folder
	 * @param  [string] $value [filename] ex: main.css
	 * @return [void]
	 */
	public function imgUri($value = "")
	{
		echo PH_URL . "ph_resources/img/" . $value;
	}
	public function checkCategory($categoryId , $categoryRelation)
	{
		$checkedAttr = NULL;

		if($categoryRelation){
			$item = array("id" => $categoryId);
			// echo "<pre>";
			// print_r($categoryRelation);
			// echo "</pre><pre>";
			// print_r($item);
			// echo "</pre>";

			if( in_array( $item , $categoryRelation) ){
				$checkedAttr = "checked='checked'";
			}
		}
		
		return $checkedAttr;
	}

	public function metaValue($metaId, $metaRelation)
	{
		$metaValue = NULL;
		foreach ($metaRelation as $relation) {
			if(array_key_exists($metaId , $relation) ){
				if(trim($relation[$metaId]) === ""){
					break;
				}else{
					$metaValue = $relation[$metaId];
				} 
				
			}
		}

		return $metaValue;
	}

	/**
	 * Parses string for exerp line and returns everything before it
	 * @param  [string] $content [post content to be parsed]
	 * @return [string]          [exerp of the content]
	 */
	public function justExerp($content)
	{
		$exerp = '<hr class="exerp" />';
		if(strpos($content, $exerp)){
			$part1 = explode($exerp, $content);
			return $part1[0];
		}
		
		
		return $content;
	}


	/**
	 * Formats unites depending on number of bytes
	 * @param  [int]    $bytes [number of bytes]
	 * @return [string]        [number of bytes formated in bytes, kb, mb, gb]
	 */
	public function formatSizeUnits($bytes)
	{
		if ($bytes >= 1073741824)
		{
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		}
		elseif ($bytes >= 1048576)
		{
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		}
		elseif ($bytes >= 1024)
		{
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		}
		elseif ($bytes > 1)
		{
			$bytes = $bytes . ' bytes';
		}
		elseif ($bytes == 1)
		{
			$bytes = $bytes . ' byte';
		}
		else
		{
			$bytes = '0 bytes';
		}

		return $bytes;
	}
}
?>
