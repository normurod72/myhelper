<?php
//order
include("order_control.php");

if($_SERVER['REQUEST_METHOD']="POST"){
	if(isset($_POST['order_service'])){
		$order_control = new OrderController("myhelper_db","localhost","root","",true);

		
	}
}