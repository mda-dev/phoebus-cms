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

				$secure_pass = PH_AUTH_KEY . PH_SALT_KEY . md5($password);
				$db_pass = PH_AUTH_KEY . PH_SALT_KEY . $db_user['password'];

				if($secure_pass == $db_pass){
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
			$this->doLogOut();
		}else if( strpos($ph->url, "user-logout") ){
			$this->doLogOut();
		}
	}


}
