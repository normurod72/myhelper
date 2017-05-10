<?php


class User 
{

	public $id;
	public $name;
	public $surname;
	public $address;
	public $lng;
	public $lat;
	public $professions=array();
	public $distance;
	public $email;
	public $password;
	public $contact_number;
	public $description;
	private $valid = false;

	function __construct($name, $surname, $address,$professions, $lng, $lat, $email, $password, $contact_number,$distance = -1, $id=-1, $description="" ){

		
		$this->professions=$professions;
		$this->id=$id;
		$this->setData($name, $surname, $email, $password, $contact_number, $address, $lat, $lng, $distance, $description);

	}
	function setData($name, $surname, $email, $password, $contact_number, $address, $lat = 41.2994958, $lng = 69.24007340000003, $distance = -1, $description=""){
		$this->name = $name;
		$this->surname = $surname;
		$this->address = $address;
		$this->lng = $lng;
		$this->lat = $lat;
		$this->email = $email;
		$this->password =$password;
		$this->contact_number = $contact_number;
		$this->distance=$distance;
		$this->description=$description;
		
		$this->valid = (preg_match('/^(?=.*[a-z0-9])(?=.*[@#$%^&+=\s]).{1,}$/i', $password)) && (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $email)) && preg_match('/^[1-9]/', $contact_number) && (preg_match('/^[a-zA-Z]+$/', $name)) && (preg_match('/^[a-zA-Z]+$/', $surname) && preg_match('/[a-z0-9]/i', $address));
	}
	function isValid(){
		return $this->valid;
	}
}

class UserController{
		private $db;
		private $debug=false;

	function __construct($dbname, $host, $username, $password, $debug){
		$this->debug=$debug;
		$this->db=new PDO("mysql:dbname=$dbname;host=$host",$username,$password);
	    //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    	//echo "Database is connected";
	}
	// Get All users
	function getAllUsers()
	{
		$users=array();
		$res=$this->db->query("SELECT * FROM users;");
		if(!$res)
		{
			$this->printError();
		}
		else
		{
			foreach($res as $row)
			{
				$id=$this->db->quote($row["id"]);
				$user=new User($row["name"], $row["surname"], $row["address"],
				array(),$row["lng"], $row["lat"], $row["email"] ,$row["password"], $row["contact_number"], $row["id"],$row["description"]);
				$user->id=$row["id"];
				$professions=array();
				$resP=$this->db->query("SELECT service_id FROM service_assign WHERE user_id=$id; ORDER BY service_id;");
				if($resP)
				{
					foreach($resP as $rowP)
					{
						$professions[]=$rowP["service_id"];
					}
					$resP->closeCursor();
				}
				$user->professions=$professions;
				$users[]=$user;


			}
		}
		return $users;

	}

	//ADD new user without image and desciption
	function addUser(&$user){
		
		if($user->isValid()){
			
			$query = $this->formatWithQuote("INSERT INTO users(name, surname,password, contact_number, email, distance, lng,lat, address, description) VALUES([0], [1], [2], [3], [4], [5], [6], [7], [8], [9]);",array($user->name,$user->surname,$user->password,$user->contact_number, $user->email,$user->distance, $user->lng, $user->lat, $user->address, $user->description));
			$res = $this->db->exec($query);

			if(!$res)
			{
				//echo $query;
				$this->printError();
				$user->id=-1;
				return false;
			}
			else
			{
				$id=$this->db->lastInsertId();
				$user->id=$id;
				// if(!$id)
				// 	echo "NO id";
				//$res->closeCursor();

				$idQ=$this->db->quote($id);
				$res=$this->db->exec("DELETE FROM service_assign WHERE user_id=$idQ;");
				if(!$res)
				{
					//$this->printError();
				}
				$query="INSERT INTO service_assign(user_id, service_id) VALUES ";
				foreach($user->professions as $pro)
				{
					$temp=$this->db->quote($pro);
					$query=$query."($idQ, $temp), ";
				}
				$query[strlen($query)-2]=";";
				$res=$this->db->exec($query);
				if(!$res)
				{
					//echo $query;
					$this->printError();
					return false;
				}

				return (!file_exists("profile_images/$id.png") || unlink("profile_images/$id.png"));
			}
			
		}
		return false;
	}
	//UPDATE all attributes of user
	function updateUser($user, $image=NULL)
	{
		if($user->isValid())
		{
			$query = $this->formatWithQuote("UPDATE users SET name=[0], surname=[1], address=[2], lat=[3], lng=[4], email=[5], password=[6], contact_number=[7], distance=[8], description=[9] WHERE id=[10];",array($user->name,$user->surname,$user->address,$user->lat, $user->lng,$user->email, $user->password, $user->contact_number, $user->distance, $user->description, $user->id));
				//echo "ID ".$user->id;

			if(!$this->db->exec($query))
			{
				//echo $query;
				$this->printError();
				//return false;
			}
			$professions=$user->professions;
			$id=$user->id;
			$query="DELETE FROM service_assign WHERE user_id=$id; ";
			$count=count($professions);
			if(!$this->db->exec($query))
			{
				$this->printError();
				return false;
			}
			if($professions && $count>0)
			{
				$new_pro="";
				for($i=0;$i<$count;$i++)
					$new_pro= $new_pro.$this->formatWithQuote("([0], [1]), ",array($id, $professions[$i]));
				$query= "INSERT INTO service_assign (user_id, service_id) VALUES ".substr($new_pro,0,strlen($new_pro)-2).";";
			}
			if(!$this->db->exec($query))
			{
				$this->printError();
				return false;
			}
			if($image && $id>0)
			{
				return copy($image, "profile_images/$id.png");
			}
			return true;

		}
		return false;
	}
	// UPDATE image for certain user
	function updateImage($user_id, $image)
	{
		if($user_id>0 && $image)
		{
			return copy($image, "profile_images/$id.png");
		}
		return true;
	}
	// DELETE user data from database and image 
	function deleteUser($id)
	{
		$id=$this->db->quote($id);
		// delete from database;
		$res=$this->db->exec("DELETE FROM users WHERE id=$id; DELETE FROM service_assign WHERE user_id=$id;");
		if(!$res)
		{
			$this->printError();
			return false;
		}
		//$res->closeCursor();
		// delete file;
		return (!file_exists("profile_images/$id.png") || unlink("profile_images/$id.png"));
	}
	// GET user FROM email and password
	function getUser($email, $password)
	{
		
		$res=$this->db->query($this->formatWithQuote("SELECT name, surname, address, lng, lat, contact_number, id, description FROM users WHERE email=[0] AND password=[1] LIMIT 1;",array($email, $password)));
		if(!$res)
		{
			$this->printError();
			return null;
		}
		else
		{
			$row=$res->fetch();
			$idQ=$this->db->quote($row["id"]);
			$user=new User($row["name"], $row["surname"], $row["address"],
				array(),$row["lng"], $row["lat"], $email ,$password, $row["contact_number"], $row["id"],$row["description"]);
			$user->id=$row["id"];
			$res->closeCursor();
			$professions=array();
			$res=$this->db->query("SELECT service_id FROM service_assign WHERE user_id=$idQ ORDER BY service_id;");
			if(!$res)
			{
				$this->printError();
			}
			else
			{
				foreach($res as $row)
				{
					$professions[]=$row["service_id"];
				}
			}
			$user->professions=$professions;
			return $user;
		}
	}
	// UPDATE given attributes of user
	function updateAttributes($user_id, $fields, $new_values)
	{
		if(is_array($fields) && is_array($new_values) && ($length=count($fields))==count($new_values))
		{
			$field_s="";
			for($i=0; $i<$length ;$i++)
			{
				$n_val=$this->db->quote($new_values[$i]);
				$field=$fields[$i];
				$field_s.="$field=$n_val, ";
			}
			$field_s=substr($field_s, 0,strlen($field_s)-2);
			$user_id=$this->db->quote($user_id);
			$query="UPDATE users SET "+$field_s+" WHERE id=$user_id;";
			if(! $this->db->exec($query))
			{
				$this->printError();
				return false;
			}
			return true;

		}
		return false;
	}
	// UPDATE given atrribute of user
	function updateAttribute($user_id, $field, $new_value)
	{

		$query=$this->formatWithQuote("UPDATE users SET $field=[0] WHERE id=[1];",array($new_value, $user_id));
		if(!$this->db->exec($query))
		{
			$this->printError();
			return false;
		}
		return true;
	}
	// GET user object from id
	function getUserById($id)
	{
		$idQ=$this->db->quote($id);
		$res=$this->db->query("SELECT email, password, name, surname, address, lng, lat, contact_number, description FROM users WHERE id=$id LIMIT 1;");
		if(!$res)
		{
			$this->printError();
			return null;
		}
		else
		{
			$row=$res->fetch();
			
			$user=new User($row["name"], $row["surname"], $row["address"],
				array(),$row["lng"], $row["lat"], $row["email"] ,$row["password"], $row["contact_number"], $id, $row["description"]);
			$user->id=$id;
			$professions=array();

			$res->closeCursor();
			$res=$this->db->query("SELECT service_id FROM service_assign WHERE user_id=$idQ ORDER BY service_id;");
			if(!$res)
			{
				$this->printError();
			}
			else
			{
				foreach($res as $row)
				{
					$professions[]=$row["service_id"];
				}
			}
			$user->professions=$professions;
			return $user;
		}
	}
	// SEARCH for user with given key
	function searchUser($key){
		$key=$this->db->quote("%".$key."%");
		$query = "SELECT id, name, surname, email, address FROM users WHERE name ILIKE $key OR surname ILIKE $key OR email ILIKE $key ";
	}
	// GET professions array for certain user
	function getProfessions($user_id)
	{
		$user_id=$this->db->quote($user_id);

		$res=$this->db->query("SELECT s.id, s.name, (SELECT count(a.user_id) FROM service_assign a WHERE a.service_id=s.id AND a.user_id=$user_id)>0  as selected FROM service_types s ORDER BY s.id;");
		if(!$res)
		{
			$this->printError();
			return array();
		}
		$arr=array();
		foreach ($res as $row) 
		{
			$temp["id"]=$row["id"];
			$temp["name"]=$row["name"];
			$temp["selected"]=$row["selected"];
			$arr[]=$temp;
		}
		return $arr;

	}
	// DESCTRUCTOR
	function __destructor(){
		$this->db = null;
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