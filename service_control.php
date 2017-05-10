<?php 
	class Service
	{
		public $id;
		public $category_id;
		public $name;
		public $description;
		public $icon;
		function __construct($id, $category_id, $name, $description, $icon)
		{
			$this->id=$id;
			$this->category_id=$category_id;
			$this->name=$name;
			$this->description=$description;
			$this->icon=$icon;
		}
	}
	class ServiceController
	{
		private $db;
		function __construct($dbname, $host, $username, $password, $debug){
			$this->debug=$debug;
			$this->db=new PDO("mysql:dbname=$dbname;host=$host",$username,$password);
		    //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    	//echo "Database is connected";
		}
		function __destruct()
		{
			$this->db=null;
		}
		function searchService($keyword)
		{
			$services=array();
			if($keyword && strlen($keyword)>0)
			{
				$query=$this->formatWithQuote("SELECT service_types.*, categories.name as category_name FROM service_types, categories WHERE lower(service_types.name) LIKE lower([0]) OR lower(service_types.description) LIKE lower([0]) AND service_types.category_id=categories.id; ",array("%".$keyword."%"));
				$res=$this->db->query($query);
				if(!$res)
				{
					echo $query;
					$this->printError();

				}
				else
				{
					foreach($res as $row)
					{
						$service=new Service($row["id"],$row["category_id"], $row["name"], $row["description"], $row["icon"]);
						$category_name=$row["category_name"];
						$services[]=array('category_name' =>$category_name , 'service'=>$service);
					}
				}
			}
			return $services;
		}
		function addService(&$service)
		{
			$query=$this->formatWithQuote("INSERT INTO service_types (category_id ,name, description, icon) VALUES ([0], [1], [2], [3]);", array($service->category_id, $service->name, $service->description, $service->icon));
			if(!$this->db->exec($query))
			{
				$this->printError();
				return false;
			}
			$service->id=$this->db->lastInsertId();
			return true;
		}
		function deleteService($id)
		{
			if(!$this->db->exec($this->formatWithQuote( "DELETE FROM service_types WHERE id=[0]; ", array($id))))
			{
				$this->printError();
				return false;
			}
			return true;
		}
		function updateService($service)
		{
			if($this->db->exec("UPDATE service_types SET category_id=[0] name=[1], description=[2], icon=[3] WHERE id=[4]", array($service->category_id, $service->name, $service->description, $service->icon, $service->id)))
			{
				$this->printError();
				//return false;
			}
			return true;
		}
		function getService($id)
		{
			$res=$this->db->query($this->formatWithQuote("SELECT * FROM service_types WHERE id=[0] LIMIT 1;",array($id)));
			if(!$res)
			{
				$this->printError();
				return null;
			}	
			$ser=null;
			foreach ($res as $row) 
			{
				$ser=new Service($row["id"],$row["category_id"], $row["name"], $row["description"], $row["icon"]);
			}
			return $ser;
		}
		function getAllServices()
		{
			$ser=array();
			$res=$this->db->query("SELECT * FROM service_types;");
			if(!$res)
			{
				$this->printError();
				
			}	
			else
			{
				foreach ($res as $row) 
				{
					$ser[]=new Service($row["id"], $row["category_id"], $row["name"], $row["description"], $row["icon"]);
				}
			}
			return $ser;

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