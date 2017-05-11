<?php
	session_start();
	include "user_control.php";
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		if(isset($_POST['current_pass'])){
			
			if($_SESSION['password'] == $_POST['current_pass']){
				echo json_encode(array('password' => "TRUE" ));
			}else{
				echo json_encode(array('password' =>"FALSE"));
			}
		
		}
		else if(isset($_POST['update'])) 
		{
			$user_controller = new UserController();

			if($user_controller->updateAttribute($_SESSION['id'], 'password', $_POST['update'])){
				$_SESSION['password'] = $_POST['update'];
				echo json_encode(array('update' => "TRUE" ));
			}else{
				echo json_encode(array('update' => "FALSE" ));
			}

		}
		else
		{

			$user_controller = new UserController();
			$user = $user_controller->getUserById($_SESSION['id']);
			$user->name = $_POST['user_name'];
			$user->surname = $_POST['user_surname'];
			$user->distance = $_POST['user_distance'];
			$user->email = $_POST['user_email'];
			$user->address = $_POST['address_hidden'];
			$user->lat = $_POST['lat'];
			$user->lng = $_POST['lng'];
			$user->description  = $_POST['describtion'];
			$user->contact_number = $_POST['user_contactphone'];
			$user->id=$_SESSION["id"];
			if(isset($_POST['user_proff'])){
				$user->professions = $_POST['user_proff'];
			}
			if($user_controller->updateUser($user, $_FILES['user_image']['tmp_name'])){
				$_SESSION['login'] = $_POST['user_email'];
				//print_r($_POST);
				header("Location:user_dashboard.php");
			}else{
				echo "error";
			}
		}	
	}

?>