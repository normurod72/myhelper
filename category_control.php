<?php
	class Category
	{
		public $id;
		public $name;
		public $description;
		public $icon;
		function __construct($id, $name, $description, $icon)
		{
			$this->id=$id;
			$this->name=$name;
			$this->description=$description;
			$this->icon=$icon;
		}
	} 
	class CategoryController
	{
		private $db;
		function __construct(){
			require("config.php");
			$dbname = $configurations["db_name"];
			$host = $configurations["host_name"];
			$username = $configurations["username"];
			$password = $configurations["password"];
			$this->debug=$configurations["debug_mode"];
			$this->db=new PDO("mysql:dbname=$dbname;host=$host",$username,$password);
		    //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    	//echo "Database is connected";
		}
		function __destruct()
		{
			$this->db=null;
		}
		function addCategory(&$category)
		{
			$query=$this->formatWithQuote("INSERT INTO categories (name, description, icon) VALUES ([0], [1], [2]);", array($category->name, $category->description, $category->icon));
			if(!$this->db->exec($query))
			{
				$this->printError();
				return false;
			}
			$category->id=$this->db->lastInsertId();
			return true;
		}
		function deleteCategory($id)
		{
			if(!$this->db->exec($this->formatWithQuote( "DELETE FROM categories WHERE id=[0]; ", array($id))))
			{
				$this->printError();
				return false;
			}
			return true;
		}
		function updateCategory($category)
		{
			if($this->db->exec($this->formatWithQuote("UPDATE categories SET name=[0], description=[1], icon=[2] WHERE id=[3]", array($category->name, $category->description, $category->icon, $category->id))))
			{
				$this->printError();
				//return false;
			}
			return true;
		}
		function getCategory($id)
		{
			$res=$this->db->query($this->formatWithQuote("SELECT * FROM categories WHERE id=[0] LIMIT 1;",array($id)));
			if(!$res)
			{
				$this->printError();
				return null;
			}	
			$cat=null;
			foreach ($res as $row) 
			{
				$cat=new Category($row["id"], $row["name"], $row["description"], $row["icon"]);
			}
			return $cat;
		}
		function getAllCategories()
		{
			$cat=array();
			$res=$this->db->query("SELECT * FROM categories;");
			if(!$res)
			{
				$this->printError();
				
			}	
			else
			{
				foreach ($res as $row) 
				{
					$cat[]=new Category($row["id"], $row["name"], $row["description"], $row["icon"]);
				}
			}
			return $cat;

		}

		/*Utility Functions*/
		// FORMAT sting with db->quote()
		private function formatWithQuote($string, $arr)
		{
			if(is_array($arr))
			{
				for($i=0; $i<count($arr);$i++)
				{
					$string=str_replace("[$i]", $this->db->quote($arr[$i]), $string);
				}
			}
			return $string;
		}
		//PRINT database error
		private function printError()
		{
			if($this->debug)
			{	try{
					echo "DB ERROR ".($this->db->errorInfo()[2]);
				}
				catch(Exception $exc)
				{

				}
			}
		}
	/*END Utility Functions*/

	}
?>