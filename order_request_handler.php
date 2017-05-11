<?php
//order
include("order_control.php");

if($_SERVER['REQUEST_METHOD']="POST"){
	if(isset($_POST['order_service'])){
		print_r($_POST);
		$order_control = new OrderController();
		$order=new Order(-1, $_POST['name'], $_POST['email'], $_POST['contact_number'], $_POST['service_id'],-1, $_POST['map_address'], $_POST['lat'], $_POST['lng'], $_POST['cost'], $_POST['description'], $_POST['date']);

		if($order_control->addOrder($order)){
			echo "success";
			header("Location:success.php");
		}else{
			header("Location:service.php?service_error=1");
		}
	}elseif(isset($_POST['delete_order'])){
		$order_controller = new OrderController();
		if($order_controller->deleteOrder($_POST['order_id'])){
			echo json_encode(array('delete' =>"SECCESS"));
		}else{
			echo json_encode(array('delete' =>"FAIL"));
		}
	}
}