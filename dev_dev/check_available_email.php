<?php

	if($_SERVER["REQUEST_METHOD"]=='POST'){

		$db=new PDO("mysql:dbname=myhelper_db;host=localhost","root","");
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    	$email = $_POST['email'];
    	$email = $db->quote($email);

	     try {

	            $rows = $db->query("SELECT count(*) FROM users WHERE email = $email");
	    	       foreach ($rows as $row) {
	           		if($row["count(*)"]==0){
	           			echo json_encode(array('ok' => "true" ));
	           			break;
	           		}
	           		else{
	           			echo json_encode(array('ok' => "false" ));
	           			break;
	           		}
	           }
	        } catch (PDOException $ex) {
	           echo json_encode(array('ok' => "false" ));
	           $db = null;
	        }
	        $db=null;		
	}
?>