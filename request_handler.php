<?php
session_start();
include 'user_control.php';
	if($_SERVER['REQUEST_METHOD']=='POST'){

		switch ($_POST['submit']) {
			case 'Log in':
				$user_control = new UserController("myhelper_db", "localhost","root","",true);
				$user = $user_control->getUser($_POST['email'],$_POST['key']);
				if($user != null){

					$_SESSION['login'] = $_POST['email'];
					$_SESSION['password'] = $_POST['key'];
					$_SESSION['id'] = $user->id;
					header("Location:user_dashboard.php");
					echo "success";
				}else{
					echo "error";
				}
				break;
			
			default:
				# code...
				break;
		}

	}
?>