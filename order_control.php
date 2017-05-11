<?php
	class Order
	{
		public $id;
		public $name;
		public $email;
		public $contact_number;
		public $service_id;
		public $master_id;
		public $address;
		public $lat;
		public $lng;
		public $money;
		public $description;
		public $due_date;
		//public $distance=-1;
		function __construct ($id, $name, $email, $contact_number, $service_id,$master_id, $address, $lat, $lng, $money, $description, $due_date)
		{
			$this->id=$id;
			$this->name=$name;
			$this->email=$email;
			$this->contact_number=$contact_number;
			$this->service_id=$service_id;
			$this->master_id=$master_id;
			$this->address=$address;
			$this->lat=$lat;
			$this->lng=$lng;
			$this->money=$money;
			$this->description=$description;
			$this->due_date=$due_date;
		}

	}
	class OrderController
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
		function addOrder(&$order)
		{
			//print_r($order);
			$query=$this->formatWithQuote("INSERT INTO orders (name, email, contact_number, service_id, master_id, address, lat, lng, money, description, due_date) VALUES ([0], [1], [2], [3], [4], [5], [6], [7], [8], [9], [10]);",array($order->name, $order->email, $order->contact_number, $order->service_id, $order->master_id, $order->address, $order->lat, $order->lng, $order->money, $order->description, $order->due_date));
			$res=$this->db->exec($query);
			if(!$res)
			{
				$this->printError();
				return false;
			}
			$order->id=$this->db->lastInsertId();
			return true;
		}
		function cleanOldOrders()
		{
			$query="DELETE FROM orders WHERE due_date>CURRENT_TIMESTAMP;";
			if(!$this->db->exec($query))
			{
				$this->printError();
				return false;
			}
			return true;
		}
		function deleteOrder($id)
		{
			$query=$this->formatWithQuote("DELETE FROM orders WHERE id=[0];",array($id));
			if(!$this->db->exec($query))
			{
				$this->printError();
				return false;
			}
			return true;
		}
		function unsetMaster($id)
		{
			$query=$this->formatWithQuote("UPDATE orders SET master_id=-1 WHERE id=[0];", array($id));
			if(!$this->exec($query))
			{
				$this->printError();
				return false;
			}
			return true;	
		}
		function setMaster($id, $master_id)
		{
			$query=$this->formatWithQuote("SELECT master_id>0 as selected FROM orders WHERE id=[0] LIMIT 1;", array($id));
			$res=$db->query($query);
			if(!$res)
			{
				$this->printError();
				return false;
			}
			$row=$res->fetch();
			if((boolean)$row["selected"])
				return false;
			$query=$this->formatWithQuote("UPDATE orders SET master_id=[0] WHERE id=[1];", array($master_id, $id));
			if(!$this->exec($query))
			{
				$this->printError();
				return false;
			}
			return true;
		}
		function getOrder($id)
		{
			$query=$this->formatWithQuote("SELECT * FROM orders WHERE id=[0]; ", array($id));
			$res=$this->db->query($query);
			if(!$res)
			{
				$this->printError();
				return null;
			}
			$order=null;
			foreach($res as $row)
			{
				$order=new Order($id, $row["name"], $row["email"], $row["contact_number"], $row["service_id"], $row["master_id"], $row["address"], $row["lat"], $row["lng"], $row["money"], $row["description"], $row["due_date"]);
			}
			return $order;
		}
		function getAllOrders(){
			$orders=array();
				$res=$this->db->query("SELECT * FROM orders;");
				if(!$res)
				{
					$this->printError();
				}
				else
				{
					foreach($res as $row)
					{
						$orders[]=new Order($row["id"], $row["name"], $row["email"], $row["contact_number"], $row["service_id"], $row["master_id"],$row["address"],$row["lat"],$row["lng"],$row["money"],$row["description"],$row["due_date"]);
					}	
				}
			return $orders;

		}
		function getNotSelectedOrderForUser($user_id)
		{
			$orders=array();
			$query=$this->formatWithQuote("SELECT o.* FROM orders o INNER JOIN service_assign a ON a.service_id=o.service_id WHERE a.user_id=[0] AND o.master_id=-1 AND o.due_date< CURRENT_TIMESTAMP;", array($user_id));
			$res=$this->db->query($query);
			if(!$res)
			{
				$this->printError();
			}
			else
			{
				foreach ($res as $row)
				{
					$orders[]=new Order($row["id"], $row["name"], $row["email"], $row["contact_number"], $row["service_id"], $row["master_id"], $row["address"], $row["lat"], $row["lng"], $row["money"], $row["description"], $row["due_date"]);					
				}
			}
			return $orders;

		}
		function getSelectedOrderForUser($user_id)
		{
			$orders=array();
			$query=$this->formatWithQuote("SELECT o.* FROM orders o INNER JOIN service_assign a ON a.service_id=o.service_id WHERE a.user_id=[0] AND o.master_id=[0] AND o.due_date< CURRENT_TIMESTAMP;", array($user_id));
			$res=$this->db->query($query);
			if(!$res)
			{
				$this->printError();
			}
			else
			{
				foreach ($res as $row)
				{
					$orders[]=new Post($row["id"], $row["name"], $row["email"], $row["contact_number"], $row["service_id"], $row["master_id"], $row["address"], $row["lat"], $row["lng"], $row["money"], $row["description"], $row["due_date"]);					
				}
			}
			return $orders;
		}
		function getOrderForUser($user_id)
		{
			$orders=array();
			$query=$this->formatWithQuote("SELECT o.* FROM orders o INNER JOIN service_assign a ON a.service_id=o.service_id WHERE a.user_id=[0] AND (o.master_id=[0] OR o.master_id=-1) AND o.due_date< CURRENT_TIMESTAMP;;", array($user_id));
			$res=$this->db->query($query);
			if(!$res)
			{
				$this->printError();
			}
			else
			{
				foreach ($res as $row)
				{
					$orders[]=new Post($row["id"], $row["name"], $row["email"], $row["contact_number"], $row["service_id"], $row["master_id"], $row["address"], $row["lat"], $row["lng"], $row["money"], $row["description"], $row["due_date"]);					
				}
			}
			return $orders;
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