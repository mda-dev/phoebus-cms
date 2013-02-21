<?php 
class Phoebus_template{
	private $_ph;
	public $themeName;
	public $theme_homepage;
	public $path;
	public $dir;
	
	function __construct($themeName){

		$_isValidTheme = file_exists(PH_ABSPATH . "themes/". $themeName ."/index.php");
		
		if( $_isValidTheme ){
			$this->themeName = $themeName . "/";
		}else{
			$this->themeName = PH_THEME . "/";
		}

		$this->path = PH_ABSPATH . "themes/" . $this->themeName;
		$this->dir = PH_DIR ."themes/" . $this->themeName;
	}

	
	/**
	 * Echos a link relative to the Phoebus instalation directory
	 * @param  string $string [aditional data passed to the href]
	 */
	public function href($string = null)
	{
		if($string == null){
			echo $this->dir;
		}else{
			echo $this->dir . $string;		
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
			echo "<h3>Sorry could not load $view.php from the template directory! (file does not exist)</h3>";
			echo "<h3>Error trying to load 404.php from the template directory! (file does not exist)</h3>";
			echo "<h5>If you do not wish to see these alerts please disable developer_mode in the config file!</h5>";
			echo "</div>";
		}
		unset($viewFile, $file404);
	}

	public function loadSubView($view, $opt = array())
	{
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
			echo "<h3>Sorry could not load $view.php from the template directory! (file does not exist)</h3>";
			echo "<h3>Error trying to load 404.php from the template directory! (file does not exist)</h3>";
			echo "<h5>If you do not wish to see these alerts please disable developer_mode in the config file!</h5>";
			echo "</div>";
		}
		unset($viewFile, $file404);
	}

	public function getAllThemes()
	{
		$themes_dir = PH_ABSPATH ."themes/";
		$valid_themes = array();

		//get all files in specified directory
		$dirContents = glob($themes_dir . "*");
		//print each file name
		foreach($dirContents as $file)
		{
		 //check to see if file is directory and if it countains an index.php page
		 	if(is_dir($file) && file_exists($file . "/index.php")){
		 		$dir = explode("/", $file);
		  		$themeName = $dir[ count($dir)-1];
		  		array_push($valid_themes, $themeName);
		 	}
		}

		return $valid_themes;
	}

	public function item_metas($meta_rel)
	{
		global $ph;
		// if no metas fount exit
		if($meta_rel == null){
			return null;
		}

		//unserialize meta relations for item
		$meta_rel = unserialize($meta_rel);
		//temp array to hold meta names
		$temp = array();

		//get list of all existing metas
		$metas = $ph->database->getTable("portfolio_metas");


		// array that will be returned
		$compiled = array();

			//populate temp array with existing meta information ($id => $name);
			foreach ($metas as $meta) {
				$temp[$meta['id']] = $meta['title'];
			}

			//compare relation id with existing meta id
			//if a match was found insert meta $name => $value inside compiled array
			foreach ($meta_rel as $rel_id => $value) {
				if(isset($temp[$rel_id+1])){
					$name = $temp[$rel_id+1];
					$compiled[$name] = $value;
				}
			}

		return $compiled;     
	}

	public function css_uri($css_file)
	{
        $css_uri = PH_URL. "themes/". $this->themeName . "css/". $css_file;
        echo $css_uri;
	}

	public function js_uri($js_file)
	{
        $js_uri = PH_URL. "themes/". $this->themeName . "js/". $js_file;
        echo $js_uri;
	}

	public function img_uri($js_file)
	{
        $js_uri = PH_URL. "themes/". $this->themeName . "img/". $js_file;
        echo $js_uri;
	}

	public function make_exerp($post, $link = "#")
	{
		$exerp = strstr($post , "</p>" , true);
		$exerp .= "... <a href='$link'>Read More</a>";
		$exerp .= "</p>";

		echo $exerp;
	}


	public function returnMenuClass($class, $slice = NULL, $default = false)
	{
		global $ph;
		$view = $ph->url->viewRequest(1);

		if($default && !$view){
			return $class;
		}elseif($default && $view == $slice){
			return $class;
		}elseif(!$default && $view == $slice){
			return $class;
		}
	}


	public function firstImage($id, $gall){
        foreach ($gall as $key => $value) {
            if($value["id"] == $id){
                $image = unserialize($value["items"]);
                return $image[0]["url"];
            }
        }

        return "http://placehold.it/1440x700&text=gallery+not+found";
    }

}
