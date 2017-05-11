<?php 
	session_start();
	
	include ("user_control.php");
	if($_SERVER["REQUEST_METHOD"] == 'POST'){
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$password = $_POST['password'];
		$number = $_POST['number'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$professions = $_POST['professions'];
		$distance = $_POST['distance'];
		$lng = $_POST['longitute'];
		$lat = $_POST['latitude'];

		$user = new User($name, $surname, $address, $professions, $lng, $lat, $email, $password, $number,$distance, -1);
		$user_controller = new UserController();
		if($user_controller->addUser($user)){
			$_SESSION["login"] = $email;
			$_SESSION["password"] = $password;
			$_SESSION["id"]=$user->id;
			echo json_encode(array('ok' => "true"));	
		}else{
			echo json_encode(array('ok' => "false"));

		}		
	}
 ?>		
