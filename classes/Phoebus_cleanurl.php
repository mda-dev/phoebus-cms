<?php
class Phoebus_cleanUrl
{
	public $site_path;

	function __construct()
	{

		$this->site_path = $this->_removeSlash($_SERVER["REQUEST_URI"]);
	}

	function __toString()
	{

		return $this->site_path;
	}


	/**
	 * Removes trailing slash from url
	 * @param  string $string [URI string ex: "/folder/folder/" ]
	 * @return string         [ex: "/folder/folder"]
	 */
	private function _removeSlash($string)
	{
		$lastLetter = $string[strlen($string)-1];
		if( $lastLetter == "/" ){
			$string = rtrim($string, "/");
		}
		return $string;
	}


	/**
	 * Parse trough the 
	 * @param  int $segment [description]
	 * @return [type]          [description]
	 */
	public function viewRequest($segment)
	{
		$url = $this->site_path;
		$url = explode("/", $url);

		if(PH_DIR !== "/"){
			$parent_dir = explode("/", PH_DIR);
			$dir_count = 0;
			foreach ($parent_dir as $dir) {
				if($dir !== ""){
					$dir_count++;
				} 
			}
			
			$segment += $dir_count;
		}

		if(isset($url[$segment])){
			return $url[$segment];
		}
		else{
			return false;
		}
	}
	
}
