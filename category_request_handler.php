<?php

include "category_control.php";
	if($_SERVER["REQUEST_METHOD"]=='POST'){
		if(isset($_POST['add'])){
			$category = new Category(-1, $_POST['title'], $_POST['description'], $_POST['icon']);
			$category_controller = new CategoryController("myhelper_db","localhost","root","",true);
			if($category_controller->addCategory($category)){
				header('Location:admin.php?page=categories');
			}else{
				echo "error";
			}
		}elseif(isset($_POST['edit'])){
			$category_controller = new CategoryController("myhelper_db","localhost","root", "",true);
			$category = $category_controller->getCategory($_POST['id']);
			$category->title = $_POST['title'];
			$category->description = $_POST['description'];
			$category->icon = $_POST['icon'];
			if($category_controller->updateCategory($category->id)){
				header('Location:admin.php?page=categories');
			}else{
				echo "error";
			}
		}elseif(isset($_POST['delete'])){
			$category_controller = new CategoryController("myhelper_db","localhost","root", "",true);
			
			if($category_controller->deleteCategory($_POST['post_id'])){
				echo json_encode(array('delete' => "SUCCESS" ));
			}
			else{
				echo json_encode(array('delete' => "FAIL" ));
			}
		}


	}
?>