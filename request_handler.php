<?php
session_start();
include 'user_control.php';
	if($_SERVER['REQUEST_METHOD']=='POST'){

		switch ($_POST['submit']) {
			case 'Log in':
				if($_POST['role']=='user'){
					$user_control = new UserController();
					$user = $user_control->getUser($_POST['email'],$_POST['key']);
					if(isset($user->id)){
						$_SESSION['login'] = $_POST['email'];
						$_SESSION['password'] = $_POST['key'];
						$_SESSION['id'] = $user->id;
						header("Location:user_dashboard.php");
					}else{
						header("Location:login.php&error=1");
					}
				}else if($_POST['role']=='admin'){
						require("config.php");
						$dbname = $configurations["db_name"];
						$host = $configurations["host_name"];
						$username = $configurations["username"];
						$password = $configurations["password"];
						$debug=$configurations["debug_mode"];
						$db=new PDO("mysql:dbname=$dbname;host=$host",$username,$password);
				    	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
				    	$username=$db->quote($_POST['email']);
				    	$password=$db->quote($_POST['key']);
				    	$res=$db->query("SELECT count(*) FROM admin WHERE login=$username AND password=$password;");
				    	if($res)
				    	{
				    		$count=(int)$res->fetch()['count(*)'];
				    		if($count>0)
				    		{
				    			$_SESSION['admin_login'] = $_POST['email'];
				    			$_SESSION['admin_password'] = $_POST['key'];
				    			header("Location:admin.php");
				    		}else{
				    			header("Location:login.php");
				    		}
				    		
				    	}
					}
				break;
			
			default:
				# code...
				break;
		}

	}
?>