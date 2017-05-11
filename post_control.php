<?php

	class Post
	{
		public $id;
		public $title;
		public $description;
		public $create_date;
		function __construct($title, $description, $id=-1, $create_date)
		{
			$this->title=$title;
			$this->description=$description;
			$this->id=$id;
			$this->create_date=$create_date;
		}
	}  
	class PostController
	{
		private $db;
		function __construct(){
			require("config.php");
			$dbname = $configurations["db_name"];
			$host = $configurations["host_name"];
			$username = $configurations["username"];
			$password = $configurations["password"];
			$this->debug=$configurations["debug_mode"];
			$this->db=new PDO("mysql:dbname=$dbname;host=$host",$username,$password);
		    //$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    	//echo "Database is connected";
		}
		function __destruct()
		{
			$this->db=null;
		}
		function addPost(&$post, $image=NULL)
		{
			$query=$this->formatWithQuote("INSERT INTO posts (title, description) VALUES ([0], [1]);",array($post->title, $post->description));
			if(!$this->db->exec($query))
			{
				$this->printError();
				return false;
			}
			else
			{
				$id=$post->id=$this->db->lastInsertId();
				$res=$this->db->query("SELECT create_date FROM posts WHERE id=$id LIMIT 1;");
				if(!$res || $id<=0)
				{
					$this->printError();
					return false;
				}

				$date=null;
				foreach($res as $row)
					$date=$row["create_date"];
				$post->create_date=$date;
				if($image)
				{
					return copy($image, "post_images/$id.png");
				}
				return true;
			}
		}
		function updatePost($post,$image=NULL)
		{
			$id=$post->id;
			$query=$this->formatWithQuote("UPDATE posts SET title = [0], description=[1] WHERE id=[2];",array($post->title, $post->description, $id));
			if(!$this->db->exec($query))
			{
				//echo $query;
				$this->printError();
				//return false;
			}
			if($image)
			{
				return copy($image, "post_images/$id.png"); 
			}
			return true;
		}
		function deletePost($id)
		{
			if($this->db->exec($this->formatWithQuote("DELETE FROM posts WHERE id=[0];",array($id))))
			{
				return (!file_exists("post_images/$id.png") || unlink("post_images/$id.png"));
			}
			else
				return false;
		}
		function getPost($id)
		{
			$query=$this->formatWithQuote("SELECT title, description, create_date FROM posts WHERE id=[0] LIMIT 1;",array($id));
			$res=$this->db->query($query);
			if(!$res)
			{
				$this->printError();
				return null;
			}
			else
			{
				$post=null;
				foreach($res as $row)
				{
					$post=new Post($row["title"], $row["description"],$id, $row["create_date"] );
				}
				return $post;
			}	
		}
		function getAllPosts()
		{
			$posts=array();
				$res=$this->db->query("SELECT * FROM posts ORDER BY create_date DESC;");
				if(!$res)
				{
					$this->printError();
				}
				else
				{
					foreach($res as $row)
					{
						$posts[]=new Post($row["title"], $row["description"], $row["id"], $row["create_date"]);
					}	
				}
			return $posts;

		}
		function getPosts($limit, $offset)
		{
			$posts=array();
			if($limit>0)
			{	
		
				$res=$this->db->query("SELECT * FROM posts ORDER BY create_date DESC LIMIT $limit OFFSET $offset;");
				if(!$res)
				{
					$this->printError();
				}
				else
				{
					foreach($res as $row)
					{
						$posts[]=new Post($row["title"], $row["description"], $row["id"], $row["create_date"]);
					}	
				}
			}
			return $posts;

		}
		function getPostCount()
		{
			$count=0;
			$res=$this->db->query("SELECT count(*) FROM posts;");
			if(!$res)
			{
				printError();
			}
			else
			{
				foreach($res as $row)
				{
					$count=(int)$row["count(*)"];
				}
			}
			return $count;
		}
		function getLastNPosts($n)
		{
			$posts=array();
			if($n>0)
			{	
		
				$res=$this->db->query("SELECT * FROM posts ORDER BY create_date DESC LIMIT $n;");
				if(!$res)
				{
					$this->printError();
				}
				else
				{
					foreach($res as $row)
					{
						$posts[]=new Post($row["title"], $row["description"], $row["id"], $row["create_date"]);
					}	
				}
			}
			return $posts;
		}
	/*Utility Functions*/
		// FORMAT sting with db->quote()
		private function formatWithQuote($string, $arr)
		{
			if(is_array($arr))
			{
				for($i=0; $i<count($arr);$i++)
				{
					$string=str_replace("[$i]", $this->db->quote($arr[$i]), $string);
				}
			}
			return $string;
		}
		//PRINT database error
		private function printError()
		{
			if($this->debug)
			{	try{
					echo "DB ERROR ".($this->db->errorInfo()[2]);
				}
				catch(Exception $exc)
				{

				}
			}
		}
	/*END Utility Functions*/

	}

?>