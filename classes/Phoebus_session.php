<?php
class Phoebus_session{
	var $loginErrors;
	var $username;
	var $fullname;
	var $email;


	function __construct(){
		session_start();
		$this->loginErrors = array();
		
	}


	/**
	 * Checks if $_SESSION['username'] has been set
	 * @return boolean [description]
	 */
	public function is_loggedIn()
	{
		if( isset($_SESSION['user_name']) )
			{ return true; }
		else 
			{ return false; }
	}


	/**
	 * Log in the user and set $_SESSION['user_name'] and $_SESSION['full_name']
	 * @param  string $username [username value should be given]
	 * @param  string $password [password value should be given]
	 * @return 					[returns nothing]
	 */
	private function _doLogIn($username, $password)
	{
		global $ph;

		//check to see if user is allready in
		if(!isset($_SESSION["user_name"])){

			$db_user = $ph->database->getUser($username);

			//if username has been found in the database
			if($db_user){

				$pass = md5($password);
				$saltedPass = md5( $db_user["salt"] . $pass);
				$db_pass = $db_user['password'];

				if($saltedPass === $db_pass){
					$_SESSION['user_name']	= $username;
					$_SESSION['full_name']	= ucfirst($db_user["first_name"]) ." ". ucfirst($db_user["last_name"]);
					$_SESSION['email']		= $db_user['email'];
					header("Location: " .PH_URL. PH_ADMIN_LOCATION. "/");

				}else{ $this->loginErrors['password'] = true; }

			}else{ $this->loginErrors['username'] = true; }
		}
	}


	/**
	 * Logs out the user and destroys $_SESSION
	 * @return 	[returns nothing]
	 */	
	private function _doLogOut()
	{
		$_SESSION = array();
		
		// 3. Destroy the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}
		// 4. Destroy the session
		session_destroy();

		//5. redirect to gomepage
		header("Location: ". PH_URL);
	}


	/**
	 * Listen to any log-in or logout requests and execute them
	 * @return [returns nothing]
	 */
	public function checkLogin()
	{
		global $ph;
		if(isset($_POST["login_form"])){
			$username = $_POST["login_form_username"];
			$password = $_POST["login_form_password"];

			if(!isset($_SESSION["user_name"])){
				$this->_doLogIn($username, $password);
			}
			
		}else if(isset($_POST["user-logout"])){
			$this->_doLogOut();
		}else if( strpos($ph->url, "user-logout") ){
			$this->_doLogOut();
		}
	}


	public function createSalt(){
		$a = array(
				'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß',
				'à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','Ā',
				'ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ',
				'ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ',
				'ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ',
				'Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','Ż',
				'ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǎ','ǎ','Ǐ','ǐ','Ǒ','ǒ','Ǔ','ǔ','Ǖ','ǖ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ǻ','ǻ','Ǽ','ǽ','Ǿ','ǿ',
				'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','ss',
				'a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A',
				'a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G',
				'g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L',
				'l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s',
				'S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z',
				'Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
		$a_count = count($a) - 1;
		$ran_str = "";

		for($i = 0; $i < 20 ; $i++){
			$ran_str .= $a[rand(0, $a_count) ];
		}
		return md5($ran_str);
	}


}
