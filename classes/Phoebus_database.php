<?php 

class Phoebus_database
{
	var $db_connection;

	function __construct()
	{
			
		// Connect to the database
		$db_connection = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		$db_host = DB_HOST;
		$db_user = DB_USER;
		$db_pass = DB_PASS;
		$db_name = DB_NAME;

		if(!$db_connection){
			die("Mysql Error: could not connect to the database!");
		}else{
			//Select the database
			$db_select = mysql_select_db($db_name , $db_connection);

			if(!$db_select){
				die("Mysql Error: could not select '$db_name' database!");
			}
		}

		$this->db_connection = $db_connection;	
	}


	/**
	 * Retrieve a user from the database
	 * @param  string $username [ex: user_no1]
	 * @return array or NULL 	[ex: array($username[full_name] => "Jhon Doe")]
	 */
	public function getUser($username)
	{
		$query	 = "SELECT * ";
		$query	.= "FROM " . DB_PREFIX . "users ";
		$query	.= "WHERE username =\"$username\" ";
		$query	.= "LIMIT 1";
		$result	 = mysql_query($query, $this->db_connection);
		
		$this->confirm_query($result);

		// REMEMBER :
		// if no rows are returned, fetch_array will return false
		if($item_data = mysql_fetch_assoc($result)){
			return $item_data;
		}else{
			return NULL;
		}
	}


	/**
	 * Returns all rows from of a specified table
	 * @param  string $table [name of the table]
	 * @param  string $order [mysql sintax (ASC / DESC)]
	 * @return array		 [associative array]
	 */
	public function getTable($table, $order = "ASC", $clause = null )
	{
		$query	 = "SELECT * ";
		$query	.= "FROM " . DB_PREFIX . "$table ";

		if($clause){
			$query  .= $clause;
		}

		//$query  .= " ORDER BY id $order";



		$result = mysql_query($query, $this->db_connection);

		$this->confirm_query($result);

		$items = array();
		while ($row = mysql_fetch_assoc($result)){
			array_push($items, $row);
		}

		if(count($items) > 0 ){
			return $items;
		}else{
			return NULL;
		}
		
	}

	/**
	 * Create a new row in the blog table
	 * @param  array $post_data [$_POST array should be given]
	 * @return array            [query status ex: array("status" => "success", "info" => "x has been added")]
	 * 							[or  array("status" => "error", "info" => $errors[] )]
	 */
	public function insertRow($data, $table = "blog")
	{
		//make data safe for mysql insertion
		$safe_array = $this->_mysql_prep($data, $table);

		$safe_data = $safe_array["data"];
		$errors = $safe_array['errors'];

		//check the $errors array is not empty then exit function and return errors
		if(count($errors) > 0){
			array_push(
				$errors, 
				"Click <a href='#' style='color:inherit;font-weight:bold;'onClick='javascript: history.go(-1); return false;' >here</a> to go back "
			);

			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);

			return $query_msg;

		}else{

			//create mysql insert query
			$post_author = $_SESSION['full_name'];
			$post_date = date('l jS \of F Y');

			switch ($table) {

				case 'blog':
					$query = "INSERT INTO ";
					$query .= DB_PREFIX . "blog(title , slug, content, author, date, categ_rel) ";
					$query .= "VALUES( ";
					$query .= "'{$safe_data["post_title"]}',"; 
					$query .= "'{$safe_data["post_slug"]}',"; 
					$query .= "'{$safe_data["post_content"]}',"; 
					$query .= "'$post_author',";
					$query .= "'$post_date',";
					$query .= " {$safe_data["post_category"]}) ";
						$title_type = "post_title";
					break;
				
				case 'portfolio':
					$query  = "INSERT INTO ";
					$query .= DB_PREFIX . "portfolio(title ,slug, content, categ_rel, meta_rel) ";
					$query .= "VALUES( ";
					$query .= "'{$safe_data["entry_title"]}', ";
					$query .= "'{$safe_data["entry_slug"]}', ";
					$query .= "'{$safe_data["entry_content"]}', ";
					$query .= " {$safe_data["entry_category"]}, ";
					$query .= " {$safe_data["entry_meta"]}) ";
						$title_type = "entry_title";
					break;
			}
			
			$result = mysql_query($query, $this->db_connection);
			
			if($result){
				$query_msg = array(
					"status" => "success",
					"info" => "<u>{$safe_data[$title_type]}</u> has been created !"
				);
			}else{
				$query_msg = array(
					"status" => "error",
					"info" => "A mySQL error has occured: ". mysql_error()
				);
			}

			return $query_msg;
		}
	}


	/**
	 * Update a row in the blog table
	 * @param  array $post_data [$_POST array should be given]
	 * @return array            [query status ex: array("status" => "success", "info" => "x has been successfully updated")]
	 * 							[or  array("status" => "error", "info" => $errors[] )]
	 */
	public function updateRow($data, $table = "blog")
	{
		
		//make data safe for mysql insertion
		$safe_array = $this->_mysql_prep($data, $table);

		$safe_data = $safe_array["data"];
		$errors = $safe_array['errors'];


		//check the $errors array is not empty then exit function and return errors
		if(count($errors) > 0){
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);
			return $query_msg;

		}else{

			switch ($table) {

				case 'blog':
					$query  = "UPDATE " . DB_PREFIX . "blog ";
					$query .= "SET ";
					$query .= "title='{$safe_data["post_title"]}', ";
					$query .= "slug='{$safe_data["post_slug"]}', ";
					$query .= "content='{$safe_data["post_content"]}', ";
					$query .= "categ_rel={$safe_data["post_category"]} ";
					$query .= "WHERE id={$safe_data["edit_post"]}";
						$title_type = "post_title";
					break;
				
				case 'portfolio':
					$query  = "UPDATE " . DB_PREFIX . "portfolio ";
					$query .= "SET ";
					$query .= "title='{$safe_data["entry_title"]}', ";
					$query .= "slug='{$safe_data["entry_slug"]}', ";
					$query .= "content='{$safe_data["entry_content"]}', ";
					$query .= "categ_rel={$safe_data["entry_category"]}, ";
					$query .= "meta_rel={$safe_data["entry_meta"]},";
					$query .= "gallery_rel={$safe_data["entry_gallery"]} ";

					$query .= "WHERE id= {$safe_data["edit_entry"]} ";
						$title_type = "entry_title";
					break;

				case 'settings':
					$query  = "UPDATE " . DB_PREFIX . "settings ";
					$query .= "SET ";
					$query .= "title='{$safe_data["title"]}', ";
					$query .= "admin_folder='{$safe_data["admin_folder"]}', ";
					$query .= "theme='{$safe_data["theme"]}'";
					//$query .= "categ_rel={$safe_data["post_category"]} ";
					$query .= "WHERE id=1";
						$title_type = "title";
					break;
			}
			
			$result = mysql_query($query, $this->db_connection);

			if($result){
				$query_msg = array(
					"status" => "success",
					"info" => "<u>{$safe_data[$title_type]}</u> has been successfully updated!"
				);
			}else{
				$query_msg = array(
					"status" => "error",
					"info" => "A mySQL error has occured: ". mysql_error()
				);
			}

			return $query_msg;
		}
	}


	/**
	 * Delete a row in the blog table
	 * @param  string $title [actual post name should be given]
	 * @return array         [query status ex: array("status" => "success", "info" => "x has been successfully deleted")]
	 * 						 [or  array("status" => "error", "info" => $errors)]
	 */
	public function deleteRow($post, $table = "blog")
	{
		switch($table){
			case 'portfolio':
				$title_type = "delete_entry";
				break;
			case 'galleries':
				$title_type = "delete_gallery";
				break;
			default:
				$title_type = "delete_post";
				break;
		}

		$item = $this->_mysql_prep_string($post[$title_type]);

		$_isID = preg_match("/^\d+$/" , $item);

		if($_isID){
			$clause = "id = $item";
		}else{
			$clause = "title = '$item'";
		}

		$query = "DELETE FROM " . DB_PREFIX . "$table WHERE $clause";

		$result = mysql_query($query, $this->db_connection);


		if(!$result){
			$query_msg = array(
				"status" => "error",
				"info" => "A mySQL error has occured: ". mysql_error()
			);
		}else{
			$query_msg = array(
				"status" => "success",
				"info" => "<u>$item</u> has been successfully deleted!"
			);
		}

		return $query_msg;	
	}


	/**
	 * Delete a row from a specific category table
	 * NOTE: (works on portfolio categories and blog categories)
	 * @param  array  $post_data [$_POST array should be given]
	 * @param  string $table     [name of the table without 'ph_' prefix or '_category' sufix]
	 * @return array             [query status ex: array("status" => "success", "info" => "x has been successfully deleted")]
	 */
	public function deleteCategory($post, $table = "blog")
	{
		$errors = array();
		$title = $this->_mysql_prep_string($post['delete_category']);

		$query = "DELETE FROM " . DB_PREFIX . "{$table}_categories WHERE title = '$title'";

		$result = mysql_query($query, $this->db_connection);

		if(!$result){
			array_push($errors, "<u>$title</u> category could not be deleted!");
			array_push($errors, mysql_error());
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);
		}else{
			$query_msg = array(
				"status" => "success",
				"info" => "<u>$title</u> category has been successfully deleted!"
			);
		}

		return $query_msg;	
	}


	/**
	 * Create a row in specified category table 
	 * @param  array  $post_data [$_POST array should be given]
	 * @param  string $table     [name of the table without 'ph_' prefix or '_category' sufix]
	 * @return array             [query status ex: array("status" => "success", "info" => "x has been successfully added")]
	 */
	public function newCategory($data, $table = "blog")
	{
		$safe_array = $this->_mysql_prep($data, "category");

		$safe_data = $safe_array['data'];
		$errors = $safe_array["errors"];


		if(count($errors) > 0){
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);
			return $query_msg;

		}else{
			$query = "INSERT INTO ";
			$query .= DB_PREFIX . "{$table}_categories(title , slug) ";
			$query .= "VALUES(
				'{$safe_data["category_title"]}', 
				'{$safe_data["category_slug"]}')";

			$result = mysql_query($query, $this->db_connection);

			if(!$result){
				array_push($errors, "Database query failed!");
				array_push($errors,  mysql_error());

				$query_msg = array(
					"status" => "error",
					"info" => $errors 
				);
			}else{
				$query_msg = array(
					"status" => "success",
					"info" => "<u>{$safe_data["category_title"]}</u> category has been successfully added to the database!"
				);
			}
		}
		return $query_msg;
	}

	public function newGallery($data)
	{
		$safe_array = $this->_mysql_prep($data, "gallery");
		$safe_data = $safe_array["data"];
		$errors = $safe_array["errors"];

		if(count($errors) > 0){
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);
			return $query_msg;
		}else{
			$query = "INSERT INTO ";
			$query .= DB_PREFIX . "galleries(title , slug, items) ";
			$query .= "VALUES(
				'{$safe_data["gallery_title"]}', 
				'{$safe_data["gallery_slug"]}',
				{$safe_data["gallery_items"]})";

			$result = mysql_query($query, $this->db_connection);

			if(!$result){
				array_push($errors, "Database query failed!");
				array_push($errors,  mysql_error());

				$query_msg = array(
					"status" => "error",
					"info" => $errors 
				);
			}else{
				$query_msg = array(
					"status" => "success",
					"info" => "<u>" . ucfirst($safe_data["gallery_title"]) . "</u> gallery has been successfully added to the database!"
				);
			}
		}

		return $query_msg;
	}

	public function updateGallery($data)
	{
		$safe_array = $this->_mysql_prep($data, "gallery");
		$safe_data = $safe_array['data'];
		$errors = $safe_array['errors'];

		if(count($errors) > 0){
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);
			return $query_msg;

		}else{

			$query  = "UPDATE " . DB_PREFIX . "galleries ";
			$query .= "SET ";
			$query .= "title='{$safe_data["gallery_title"]}',";
			$query .= "slug='{$safe_data["gallery_slug"]}',";
			$query .= "items={$safe_data["gallery_items"]} ";

			$query .= "WHERE id={$safe_data["edit_gallery"]}";

			$result = mysql_query($query, $this->db_connection);

			if(!$result){
				array_push($errors, "Database query failed!");
				array_push($errors,  mysql_error());

				$query_msg = array(
					"status" => "error",
					"info" => $errors 
				);
			}else{
				$query_msg = array(
					"status" => "success",
					"info" => "<u>{$safe_data["gallery_title"]}</u> gallery has been successfully changed!"
				);
			}

		}

		return $query_msg;
	}

	
	/**
	 * Updates a row in specified category table
	 * @param  array  $post_data [$_POST array should be given]
	 * @param  string $table     [name of the table without 'ph_' prefix or '_category' sufix]
	 * @return array             [query status ex: array("status" => "success", "info" => "x has been successfully updated")]
	 */
	public function updateCategory($data, $table = "blog")
	{
		$safe_array = $this->_mysql_prep($data, "category");
		$safe_data = $safe_array['data'];
		$errors = $safe_array['errors'];

		if(count($errors) > 0){
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);
			return $query_msg;

		}else{

			$query  = "UPDATE " . DB_PREFIX . "{$table}_categories ";
			$query .= "SET ";
			$query .= "title='{$safe_data["category_title"]}',";
			$query .= "slug='{$safe_data["category_slug"]}'";

			$query .= "WHERE id={$safe_data["edit_category"]}";

			$result = mysql_query($query, $this->db_connection);

			if(!$result){
				array_push($errors, "Database query failed!");
				array_push($errors,  mysql_error());

				$query_msg = array(
					"status" => "error",
					"info" => $errors 
				);
			}else{
				$query_msg = array(
					"status" => "success",
					"info" => "<u>{$safe_data["category_title"]}</u> post has been successfully changed!"
				);
			}

		}

		return $query_msg;
	}


	/**
	 * Returns a single row from a specified table
	 * @param  string $table [name of the table without 'ph_' prefix]
	 * @param  string $slug  [slug key from database ex: 'hello-post']
	 * @return array or null [ex: array($item_data['title'] = > "Hello Post")]]
	 */
	public function getRow($table, $slug = 1)
	{	
		$_isID = preg_match("/^\d+$/" , $slug);

		if($_isID){
			$clause = "WHERE id =$slug ";	
		}else{
			$clause = "WHERE slug ='$slug' ";
		}

		$query	 = "SELECT * ";
		$query	.= "FROM " . DB_PREFIX . "$table ";
		$query	.= $clause;
		$query	.= "LIMIT 1";
		$result	 = mysql_query($query, $this->db_connection);
		
		$this->confirm_query($result);

		// REMEMBER :
		// if no rows are returned, fetch_array will return false
		if($item_data = mysql_fetch_assoc($result)){
			return $item_data;
		}else{
			return NULL;
		}
	}


	public function newMeta($form)
	{
		$errors = array();

		$safe_array = $this->_mysql_prep($form);
		$safe_data = $safe_array["data"];
		$errors = $safe_array["errors"];

		if(count($errors) > 0){
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);
			return $query_msg;
		}else{

			$query = "INSERT INTO ";
			$query .= DB_PREFIX . "portfolio_metas(title) ";
			$query .= "VALUES(
				'{$safe_data["meta_title"]}')";

			$result = mysql_query($query, $this->db_connection);

			if(!$result){
				array_push($errors, "Database query failed!");
				array_push($errors,  mysql_error());

				$query_msg = array(
					"status" => "error",
					"info" => $errors 
				);
			}else{
				$query_msg = array(
					"status" => "success",
					"info" => "<u>{$safe_data["meta_title"]}</u> meta has been successfully created in the database!"
				);
			}
		}

		return $query_msg;
	}


	public function deleteMeta($form)
	{
		$errors = array();
		$title = $this->_mysql_prep_string($form['delete_meta']);

		$query = "DELETE FROM " . DB_PREFIX . "portfolio_metas WHERE title = '$title'";

		$result = mysql_query($query, $this->db_connection);

		if(!$result){
			array_push($errors, "<u>$title</u> meta could not be deleted!");
			array_push($errors, mysql_error());
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);
		}else{
			$query_msg = array(
				"status" => "success",
				"info" => "<u>$title</u> meta has been successfully deleted!"
			);
		}

		return $query_msg;	
	}


	public function updateMeta($form)
	{

		$safe_array = $this->_mysql_prep($form);

		$safe_data = $safe_array["data"];
		$errors = $safe_array["errors"];


		if(count($errors) > 0){
			$query_msg = array(
				"status" => "error",
				"info" => $errors
			);

			return $query_msg;

		}else{
			$query  = "UPDATE " . DB_PREFIX . "portfolio_metas ";
			$query .= "SET ";
			$query .= "title='{$safe_data["meta_title"]}' ";

			$query .= "WHERE id={$safe_data["edit_meta"]}";

			$result = mysql_query($query, $this->db_connection);

			if(!$result){
				array_push($errors, "Database query failed!");
				array_push($errors,  mysql_error());

				$query_msg = array(
					"status" => "error",
					"info" => $errors 
				);
			}else{
				$query_msg = array(
					"status" => "success",
					"info" => "<u>{$safe_data["meta_title"]}</u> post has been successfully changed!"
				);
			}
		}

		return $query_msg;
	}


	/**
	 * Closes the current database connection
	 */
	public function close_connection()
	{
		mysql_close($this->db_connection);
	}

	

	private function confirm_query($result_set)
	{
		if(!$result_set){
			die("Database Query failed " . mysql_error()); 
		}
	}

	/**
	 * Creates a url slug from a string
	 * @param  string $str [ex: "My pöst title"]
	 * @return string      [ex: "my-post-title"]
	 */
	public function create_slug($str)
	{	
		$a = array(
			'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß',
			'à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','Ā',
			'ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ',
			'ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ',
			'ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ',
			'Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','Ż',
			'ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǎ','ǎ','Ǐ','ǐ','Ǒ','ǒ','Ǔ','ǔ','Ǖ','ǖ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ǻ','ǻ','Ǽ','ǽ','Ǿ','ǿ');

		$b = array(
			'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','ss',
			'a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A',
			'a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G',
			'g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L',
			'l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s',
			'S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z'
			,'Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');

		$no_accent = str_replace($a,$b, $str);
		$no_accent_or_whitespace = preg_replace( array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), $no_accent );
		$slug = strtolower($no_accent_or_whitespace);

		return $slug;
	}


	/**
	 * Prepare $_POST data for mysql insertion
	 * @param  array $post   [$_POST array]
	 * @param  string $table [name of the table needed for specific entries]
	 * @return array         [array with 2 index "data" the prepped data, and "errors" NULL or array with errors]
	 */
	private function _mysql_prep($post, $table = "blog")
	{
		//create prepped array for holding values
		$prepped_post = array();
		//create errors array for catching errors
		$errors = array();


		//set item type according to the specified table
		//needed to determine the array key that holds the slug
		switch ($table) {
			case 'blog':
				//ex: $post[post_slug]
				$item = "post";
				break;

			case 'category':
				//ex: $post[category_slug]
				$item = "category";
				break;
			case 'gallery':
				$item = "gallery";
				break;

			case 'portfolio':
				//ex: $post[entry_slug] (portfolio)
				$item = "entry";
				break;
			default:
				$item = NULL;
				break;
		}

		if($table !== "settings"){
			if(isset($post["{$item}_category"]) ){
				$_thisE = $post["{$item}_category"];
				$prepped_post["{$item}_category"] = "'". serialize($_thisE) ."'";
			}else{ 
				$prepped_post["{$item}_category"] = 'NULL'; }
		}
		

		

		foreach ($post as $key => $value) {

			// special rule for arrays (meta relation for portfolio)
			switch (gettype($value)) {
				case 'array':
					$prepped_post[$key] = "'". serialize($value) ."'";
				
					
					break;
				
				default:
					// if the field was empty insert error with field name
					if(Trim($value) === ""){
						// special rule if the field is category_slug, $post_slug, entry_slug
						if(strstr($key, "_slug")){
							//create slug from item title
							$slug = $this->create_slug($post[$item.'_title']);
							$prepped_post[$key] = $slug;
						}else{
							$name = explode("_", $key);
							$name = ucfirst($name[1]);
 							array_push($errors, "The value from <u>$name</u> field was empty!");
						}
					//if the field was not empty prep it for mysql insertion	
					}else{
						// special rule if the field is category_slug, $post_slug, entry_slug
						if(strstr($key, "_slug")){
							$prepped_post[$key] = $this->create_slug($value);
						}else{
							$prepped_post[$key] = $this->_mysql_prep_string($value);
						}
						
					}
					break;
			}
		}

		return array("data" => $prepped_post, "errors" => $errors);
	}


	/**
	 * Prepares a single string for mysql insertion
	 * @param  string $value [string that needs to be prepped]
	 * @return string        [prepped string]
	 */ 
	private function _mysql_prep_string( $value )
	{
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	public function mysqlCategoryRegex($id)
	{
		$regex = "REGEXP '{s:[0-9]*:\"id\";s:[0-9]*:\"$id\";}'";
		return "WHERE categ_rel " . $regex;
	}

	public function searchWebsite($table, $searchQuery)
	{
		$searchQuery = urldecode($searchQuery);
		$clause = "WHERE title LIKE ('%$searchQuery%') OR content LIKE ('%$searchQuery%')";
		$searchResults = $this->getTable($table, "ASC", $clause);

		if($searchResults){
			foreach ($searchResults as $result) {
				$word = $searchQuery;
				$high = "<span class='highlight'>$word</span>";
				$result["content"] = preg_replace( "/$word/", $high , $result["content"]);
			}
		}

		return $searchResults;
	}

}

