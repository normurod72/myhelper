<?php

include "service_control.php";
	if($_SERVER["REQUEST_METHOD"]=='POST'){
		if(isset($_POST['add'])){
			$service = new Service(-1, $_POST['category_id'], $_POST['title'], $_POST['description'], $_POST['icon']);
			//print_r($service);
			$service_controller = new ServiceController("myhelper_db","localhost","root","",true);
			if($service_controller->addService($service)){
				header('Location:admin.php?page=services');
			}else{
				echo "error";
			}
		}elseif(isset($_POST['edit'])){
			$service_controller = new ServiceController("myhelper_db","localhost","root", "",true);
			$service = $service_controller->getService($_POST['id']);
			$service->name = $_POST['title'];
			$service->category_id = $_POST['category_id'];
			$service->description = $_POST['description'];
			$service->icon = $_POST['icon'];
			
			if($service_controller->updateService($service)){
				header('Location:admin.php?page=services');
			}else{
				echo "error";
			}
		}elseif(isset($_POST['delete'])){
			$service_controller = new ServiceController("myhelper_db","localhost","root", "",true);
			
			if($service_controller->deleteService($_POST['service_id'])){
				echo json_encode(array('delete' => "SUCCESS" ));
			}
			else{
				echo json_encode(array('delete' => "FAIL" ));
			}
		}


	}
?>