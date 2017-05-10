<?php
	include "post_control.php";
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['delete'])){
			$post_controller = new PostController("myhelper_db","localhost","root","", true);
		
			if($post_controller->deletePost($_POST['post_id'])){
				echo json_encode(array('update' => "SUCCESS" ));
			}
			else{
				echo json_encode(array('update' => "FAIL" ));
			}
		}elseif(isset($_POST['add'])){
			
			$post = new Post($_POST['title'], $_POST['description'],-1, date("Y-m-d h:i:s"));
			$post_controller = new PostController("myhelper_db","localhost","root","", true);
			if($post_controller->addPost($post,$_FILES['post_image']['tmp_name'])){
				header('Location:admin.php?page=posts');
			}else{
				echo "error";
			}

		}elseif(isset($_POST['edit'])){
			$post_controller = new PostController("myhelper_db","localhost","root","", true);
			$post = $post_controller->getPost($_POST['id']);
			print_r($_POST);
			$post->title = $_POST['title'];
			$post->description = $_POST['description'];

			if($post_controller->updatePost($post,$_FILES['post_image']['tmp_name'])){
				header('Location:admin.php?page=posts');
			}else{
				echo "error";
			}
		}
	}

?>