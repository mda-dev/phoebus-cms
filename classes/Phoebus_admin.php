<?php
/**
* Phoebus admin class
*/
class Phoebus_admin
{
	public $location;
	public $folder;
	public $path;

	function __construct($ph)
	{
		$this->path = PH_ABSPATH . "ph_admin/";
		$loc = $ph->database->getRow("settings");
		$this->folder = $loc["admin_folder"];
		$this->location = PH_DIR . $loc["admin_folder"] . "/";

	}

	function __toString()
	{
		return $this->location;
	}

	/**
	 * Includes admin index page
	 * @return [type] [description]
	 */
	public function index()
	{
		require_once $this->path . "/index.php";
	}
	
	/**
	 * Includes one of the primary admin pages
	 * @param  string $page [name of the file]
	 * @return bool         [true/false]
	 */
	public function getPage($page)
	{
		$file = $this->path . "adm_$page.php";

		if(file_exists($file)){
			require_once($file);
			return false;
		}else{
			return true;
		}
	}

	/**
	 * Includes items from the includes directory
	 * @param  string $page [name of the file]
	 * @return bool         [true/false]
	 */
	public function getIncludes($page)
	{
		$file = $this->path . "/includes/$page.php";
		if(file_exists($file)){
			require_once($file);
			return false;
		}else{
			return true;
		}
	}


	/**
	 * Create heading block for admin area
	 * @param  String $val [portfolio/blog etc]
	 * @return String      [html block]
	 */
	public function page_heading($val)
	{
        $heading  = "<section class='clearfix' style='margin-top:100px' id='heading' >";
        $heading .= "<span style='float:left' class='icon $val cleafix'>";
        $heading .= ucfirst($val);
        
        $heading .= "</span>";
        $heading .= $this->user_menu();
  		$heading .= "</section>";

        

        return $heading;

	}


	public function user_menu(){
		global $ph;
		$user = "<div class='user' style='float:right;'>";

        $user .= "    <img src='".PH_DIR."ph_admin/img/avatar.png'>";

        $user .= "    <h5>".$_SESSION['full_name']." <small>Website administrator</small></h5>";
        $user .= "    <ul>";
        $user .= "        <li><a href='user-logout'>Log Out</a></li>";
        $user .= "        <li><a target='_blank' href='". PH_DIR ."'>View website</a></li>";
        //$user .= "        <li><a href='" .PH_DIR."admin/blog'>New Blog Post</a></li>";
        //$user .= "        <li><a href='" .PH_DIR."admin/portfolio'>New Portfolio Entry</a></li>";
        $user .= "        <li class='sep'>Administrator Quick Links</li>";
        $user .= "    </ul>";
        $user .= "</div>";

        return $user;
	}


	/**
	 * Echo out the url for a specific file within admin css folder
	 * @param  string $css_file [name of the css file without extention]
	 */
	public function css_uri($css_file)
	{
		echo PH_URL ."ph_admin/css/$css_file.css";
	}


	/**
	 * Echo out the url for a specific file within admin js folder
	 * @param  string $css_file [name of the css file without extention]
	 */
	public function js_uri($js_file)
	{
		echo PH_URL ."ph_admin/js/$js_file.js";
	}


	/**
	 * Echos a link retative to Phoebus admin directory
	 * @param  string $string [aditional data passed to the href]
	 */
	public function href($string = null)
	{
		if($string == null){
			echo $this->location;
		}else{
			echo $this->location . $string;		
		}
	}



    public function returnMenuClass($class, $slice = NULL, $default = false)
	{
		global $ph;
		$view = $ph->url->viewRequest(2);

		if($default  && !$view){
			return $class;
		}elseif($default && $view == $slice){
			return $class;
		}elseif(!$default && $view == $slice){
			return $class;
		}
		
	}


	public function loadView($view = "index", $opt = array())
	{

		//-- do not load depentant views as a main view
		$view = str_replace("-", "", $view);
		$viewFile = $this->path . $view .".php";
		$file404 = $this->path . "404.php";


		extract($opt);
		if(!isset($ph)){ global $ph; }
		
		
		if(file_exists($viewFile)){
			require_once($viewFile);

		}elseif(file_exists($file404)){
			require_once($file404);

		}elseif(PH_DEVELOP_MODE){
			echo "<div style='margin: 100px auto;text-align:center;'>";
			echo "<h3>Sorry could not load $view.php from the admin directory! (file does not exist)</h3>";
			echo "<h5>If you do not wish to see these alerts please disable developer_mode in the config file!</h5>";
			echo "</div>";
		}
		unset($viewFile, $file404);
	}

	public function loadSubView($view = "index", $opt = array())
	{
		$viewFile = $this->path . "includes/" . $view .".php";
		$file404 = $this->path . "404.php";

		extract($opt);
		if(!isset($ph)){ global $ph; }
		
		
		if(file_exists($viewFile)){
			require_once($viewFile);

		// }elseif(file_exists($file404)){
		// 	require_once($file404);

		}elseif(PH_DEVELOP_MODE){
			echo "<div style='margin: 100px auto;text-align:center;'>";
			echo "<h3>Sorry could not load includes/$view.php from the admin directory! (file does not exist)</h3>";
			echo "<h5>If you do not wish to see these alerts please disable developer_mode in the config file!</h5>";
			echo "</div>";
		}
		unset($viewFile, $file404);
	}


}
