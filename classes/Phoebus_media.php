<?php 
/**
* MEDIA CLASS
*/
class Phoebus_media
{

	private $_folder;
	private $_dir;

	public function __construct()
	{
		$this->_folder = PH_ABSPATH . "ph_media/";
		$this->_dir = PH_DIR . "ph_media/";
		$this->imageDir = $this->_dir . "images/";
		$this->imageThumbDir = $this->imageDir . "thumbs/";
	}

	public function get_image($name){
		$image_dir = PH_URL. "ph_media/images/";
	}

	public function folderPath($addOn = "")
	{
		return $this->_folder . $addOn;
	}

	public function href($item){
		echo $this->_dir. $item;
	}







	public function thumbHref($image, $size = 820)
	{
		echo $this->getThumb($image, $size);		 
	}


	public function getThumb($image, $size = 820)
	{
		if( (substr($image, 0, 7) == "http://") || (substr($image, 0, 4) == "www.")){
			return $image;
		}else{
			return $this->imageThumbDir . "{$size}/thumb_{$image}";
		}
	}

	public function imageHref($image)
	{
		echo $this->getImage($image);
	}

	public function getImage($image, $realpath = false)		
	{

		if( (substr($image, 0, 7) == "http://") || (substr($image, 0, 4) == "www.")){
			return $image;
		}else{
			if($realpath){
				return $_SERVER["DOCUMENT_ROOT"] . $this->imageDir . $image;
			}else{
				return $this->imageDir . $image;
			}
		}
		
	}


	public function itemsIn($folder)
	{
		$imgdir = PH_ABSPATH ."ph_media/$folder/"; //Pick your folder
		$allowed_types = array("png","jpg","jpeg","gif"); //Allowed types of files
		$dimg = opendir($imgdir);//Open directory
		while($imgfile = readdir($dimg))
		{
		  if( in_array(strtolower(substr($imgfile,-3)),$allowed_types) or
		      in_array(strtolower(substr($imgfile,-4)),$allowed_types) )
		/*If the file is an image add it to the array*/
		  {$images[] = $imgfile;}
		}
		closedir($dimg);
		return $images;
	}


function createThumbs($folderName , $thumbWidth) 
{

	$pathToImages = $this->folderPath($folderName . "/");
	$pathToThumbs = $pathToImages . "thumbs/";
	$pathToThumbDir = $pathToThumbs . $thumbWidth . "/";
	// open the directory

	//check for thumbs directory
	if(!is_dir($pathToThumbs)){
		mkdir($pathToThumbs, 0777);
	}
	//check for specific width directory
	if(!is_dir($pathToThumbDir)){
		mkdir($pathToThumbDir, 0777);
	}

	$dir = opendir( $pathToImages );


// loop through it, looking for any/all JPG files:
	while (false !== ($fname = readdir( $dir ))) {
// parse path for the extension
		$info = pathinfo($pathToImages . $fname);

		// continue only if this is a JPEG image
		if ((strtolower($info['extension'])) && ((strtolower($info['extension']) == 'jpg') || (strtolower($info['extension']) == 'jpeg')) ) 
		{
			echo "Creating thumbnail for {$fname} <br />";

// load image and get image size
			$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
			$width = imagesx( $img );
			$height = imagesy( $img );

// calculate thumbnail size
			$new_width = $thumbWidth;
			$new_height = floor( $height * ( $thumbWidth / $width ) );

// create a new temporary image
			$tmp_img = imagecreatetruecolor( $new_width, $new_height );

// copy and resize old image into new image 
			imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

// save thumbnail into a file
			imagejpeg( $tmp_img, "{$pathToThumbDir}/thumb_{$fname}", 80 );
		}


	}
// close the directory
	closedir( $dir );
}



}
