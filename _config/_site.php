<?php

	/**
	* Site class
	*/
	class site
	{

		private $_dbConn;
		private $_root;
		private $_page;
		public $content;
		public $data;
		public $url;
		public $posts;
		private $validStart;

		function __construct($root)
		{
			$this->_root = $root;
			$this->posts = array();
			if((@include "_config.php") !== false){
      	$this->_dbConn = new mysqli($dbHost,$dbUser,$dbPass,$dbName);
				$this->validStart = true;
			}else {
				$this->validStart = false;
			}
		}

		public function dataExists()
		{
			if($this->validStart == false)
				return false;
			$DATA_TABLE = "SITE";
			$result = $this->_dbConn->query("SELECT * FROM " . $DATA_TABLE . " LIMIT 1;");
			if($result && $result->num_rows > 0)
			{
				$result = $result->fetch_object();
				$this->data = json_decode($result->CONFIG);
				return true;
			}else
				return false;
		}

		public function postsExist()
		{
			if($this->validStart == false)
				return false;
			$DATA_TABLE = "POSTS";
			$result = $this->_dbConn->query("SELECT * FROM " . $DATA_TABLE . ";");
			if($result && $result->num_rows > 0)
			{
				while($row = $result->fetch_object())
				{
					$tmp_post = new _post();
					$tmp_post->id = $row->ID;
					$tmp_post->date = strtotime($row->DATE);
					$tmp_post->data = json_decode($row->VARIABLES);
					$tmp_post->content = $row->CONTENT;
					$this->posts[$row->ID] = $tmp_post;
				}

				return true;
			}else
				return false;
		}


		public function dbConn()
		{
			return $this->_dbConn;
		}

		public function validateWebURL($url)
		{

			$this->url = $url;
			if($url == "/dbCreate.php")
			{
				if(file_exists($this->_root . DIRECTORY_SEPARATOR . "_config" . DIRECTORY_SEPARATOR . "_config.php")){
					return false;
				}else{
					$this->_page = "dbCreate.php";
					return true;
				}
			}
			if($this->validStart == false)
				return false;
			$url = (strpos($url, "?")? substr($url, 0, strpos($url, "?")) : $url);
			$URL_TABLE = "URLS";
			$temp_file = basename($url);
			$temp_file = rtrim($temp_file,"/");
			$result = $this->_dbConn->query("SELECT * FROM " . $URL_TABLE . " WHERE URL = '" . $url . "' OR REFERENCE_URL = '" . $url . "' LIMIT 1;");
			if($result && $result->num_rows > 0)
			{

				$temp_page = $result->fetch_object();
				if(!empty($temp_page->REDIRECT_URL))
				{
					$url = $temp_page->REDIRECT_URL;
					return $this->validateWebURL($url);
				}
				if(empty($temp_page->FILE))
					$this->_page = $temp_file;
				else
					$this->_page = $temp_page;
				$this->url = $url;
				return true;
			}else{
				$url = rtrim($url,"/");
				$result = $this->_dbConn->query("SELECT * FROM " . $URL_TABLE . " WHERE URL = '" . $url . "' OR REFERENCE_URL = '" . $url . "' LIMIT 1;");
				if($result && $result->num_rows > 0)
				{

					$temp_page = $result->fetch_object();
					if(!empty($temp_page->REDIRECT_URL))
					{
						$url = $temp_page->REDIRECT_URL;
						return $this->validateWebURL($url);
					}
					if(empty($temp_page->FILE))
						$this->_page = $temp_file;
					else
						$this->_page = $temp_page;
					$this->url = $url;
					return true;
				}
			}

			return false;
		}

		public function page(){
			if(isset($this->_page->FILE))
				return $this->_page->FILE;
			else
				return $this->_page;
		}

		public function root(){ return $this->_root;}

		public function contentExists(){
			$CONTENT_TABLE = "CONTENT";
			$result = $this->_dbConn->query("SELECT * FROM " . $CONTENT_TABLE . ";");
			if($result && $result->num_rows > 0)
			{
				while($row = $result->fetch_object())
				{
					if(isJson($row->CONTENT))
						$this->content[$row->NAME] = json_decode($row->CONTENT);
					else
						$this->content[$row->NAME] = $row->CONTENT;
				}
				return true;
			}else
				return false;
		}

		public function import($file,$page=null){
			$site = $this;
			$file = $this->buildFileName($file,"_includes");
			ob_start();
			include $file;
			$data = ob_get_contents();
			ob_end_clean();
			return $data;
		}




		private function buildFileName($filename,$dir)
		{

			if(mb_substr($filename, 0, 1) == DIRECTORY_SEPARATOR)
			{
				$filename = ltrim ($filename, DIRECTORY_SEPARATOR);
			}
			$file;
			if(strpos($filename,DIRECTORY_SEPARATOR) !== false)
			{
				$file = (mb_substr($filename, 0, 1) != "_") ? "_" . $filename : "" . $filename;
			}else{
				$file = $dir . DIRECTORY_SEPARATOR . $filename;
			}


			$file = $this->_root . DIRECTORY_SEPARATOR . $file;
			if(file_exists($file . ".php"))
				$file =  $file . ".php";
			elseif (file_exists($file . ".html"))
				$file = $file . ".html";
			elseif (file_exists($file . ".htm"))
				$file = $file . ".htm";


			return $file;
		}



	}

	/**
	*
	*/
	class _post
	{
		public $id;
		public $data;
		public $content;
		public $date;
	}

?>
