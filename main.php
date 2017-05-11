<?php if(!isset($_GET['page'])){header("Location:?page=home");} 
include "post_control.php";
include "user_control.php";
$post_controller = new PostController();
$posts = $post_controller->getAllPosts();
$user_controller = new UserController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<?php include("includes.html"); ?>
</head>
<body>


  <div class="header1">
    <?php include("header.php");?>
  </div>
  <link rel="stylesheet" type="text/css" href="css/navbar_fixed.css">
  <div class="container">
      <div class="row">


        <!-- News page start  --> 
        <?php if($_GET['page']=='news'){ ?>
        <div class="col-sm-8 blog-main">
         
          <div class="blog-header">
            <h1 class="blog-title">News</h1>
            <p class="lead blog-description">The official news of the website.</p>
          </div>

            <?php for ($i=0; $i < count($posts); $i++) { 
              ?>
            <div class="jumbotron hms-news-block col-md-12">
              <div class="bs-callout bs-callout-info">
                <div class="col-sm-5"> 
                  <img src="post_images/<?php echo file_exists("post_images/".$posts[$i]->id.".png")?$posts[$i]->id : "post_default";?>.png" class="img-responsive">
                </div>
                <div class="col-sm-7">
                  <p><?php echo $posts[$i]->title; ?></p>
                  <p class="hms-news-block-description"><?php
                  if(strlen($posts[$i]->description)>30){
                      echo substr($posts[$i]->description, 0,30)."<b> . . .</b>";
                    }else{
                      echo $posts[$i]->description;
                    }
                  ?>
                   </p>
                  <p class="hms-news-block-span"><span><?php echo $posts[$i]->create_date; ?>| Administrator</span></p>
                  <a href="?page=view-post&post_id=<?php echo $posts[$i]->id;?>" style="font-size: 12pt;">Read more <i class="fa fa-angle-double-right"></i></a>
                </div>
              </div>
            </div>
            <?php }?>
           

           
           <nav aria-label="...">
            <ul class="pagination">
              <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
              <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
              <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
              <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
            </ul>
          </nav>

        </div>
        <?php } ?>
        <!-- News page end  --> 


         <!-- Categories page start  --> 
        <?php if($_GET['page']=='categories'){

        ?>
        <div class="col-sm-8 blog-main">
         
          <div class="blog-header">
            <h1 class="blog-title">All categories</h1>
            <hr>
          </div>

          <div class="blog-post">
            
            <h3>Category name</h3>
            
            <ul style="list-style: circle;">
              <li><a href="service.php">Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</a></li>
              <li><a href="#">Donec id elit non mi porta gravida at eget metus.</a></li>
              <li><a href="#">Nulla vitae elit libero, a pharetra augue.</a></li>
            </ul>
            
          </div>
         

        </div><!-- /.blog-main -->
        <?php } ?>
        <!-- Categories page end  --> 



        <!-- Post page start  --> 
        <?php 
        
        if($_GET['page']=='view-post'){ 
        $current_post = $post_controller->getPost($_GET['post_id']);
          
        ?>
        <div class="col-sm-8 blog-main">
         
          <div class="blog-header">
            <h1 class="blog-title"><?php echo $current_post->title; ?></h1>
            <p class="blog-post-meta"><?php echo $current_post->create_date; ?> <a href="#">Admin</a></p>
          </div>

          <div class="blog-post">
            <img src="post_images/<?php echo file_exists("post_images/".$current_post->id.".png")?$current_post->id : "post_default";?>.png" class="img-responsive thumbnail hms-thumbnail">
            
            
            <p><?php echo $current_post->description; ?></p>
            
          </div>
         

        </div><!-- /.blog-main -->
        <?php } ?>
        <!-- Post page end  --> 



       


         <!-- Users page start  --> 
        <?php if($_GET['page']=='users'){ 

        ?>
        <div class="col-sm-8 blog-main">
         <h2>Top users</h2>
         <hr>

          <div class="col-sm-6 col-md-6">
            <div class="thumbnail hms-thumbnail">
              <div class="col-md-12 hms-thumbnail-img">
                <img src="images/img.jpg" height="200" width="200" class="img-circle" alt="...">
              </div>
              <div class="caption">
                <h3>Thumbnail label</h3>
                <p>Lorem, ipsum Lorem, ipsum Lorem, ipsum Lorem, ipsum </p>
                <p><a href="#" class="btn btn-primary hms-btn-primary pull-right" role="button">More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6">
            <div class="thumbnail hms-thumbnail">
              <div class="col-md-12 hms-thumbnail-img">
                <img src="images/img.jpg" height="200" width="200" class="img-circle" alt="...">
              </div>
              <div class="caption">
                <h3>Thumbnail label</h3>
                <p>Lorem, ipsum Lorem, ipsum Lorem, ipsum Lorem, ipsum </p>
                <p><a href="#" class="btn btn-primary hms-btn-primary pull-right" role="button">More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>
              </div>
            </div>
          </div>
         

        </div><!-- /.blog-main -->
        <?php } ?>
        <!-- Users page end  -->


        


        <!-- Users page start  --> 
        <?php if($_GET['page']=='view-user'){ 
          $current_user = $user_controller->getUserById($_GET['user_id']);
        ?>
        <div class="col-sm-8 blog-main">
         <h2><?php echo $current_user->name." ".$current_user->surname; ?></h2>
         <hr>

          <div class="col-md-12 thumbnail hms-thumbnail">
            <img src="profile_images/<?php echo file_exists("profile_images/".$current_user->id.".png") ? $current_user->id:"default";?>.png" class="img-responsive" alt="...">
          </div>

          <h3>Info</h3><p><?php echo $current_user->description; ?></p>
          <ul>
            <li>Address</li>
            <p><p><?php echo $current_user->address; ?></p></p>
            <li>Phone number</li>
            <p><?php echo $current_user->contact_number; ?></p>
            <li>Profession</li>
            <p><?php print_r($current_user->professions); ?></p>
          </ul>
         

        </div><!-- /.blog-main -->
        <?php } ?>
        <!-- Users page end  --> 



        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
        <br><br><br>
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>There you can find latest and archives of our previous news</p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2017</a></li>
              <li><a href="#">February 2017</a></li>
              <li><a href="#">January 2017</a></li>
              <li><a href="#">December 2016</a></li>
              <li><a href="#">November 2016</a></li>
              <li><a href="#">October 2016</a></li>
              <li><a href="#">September 2016</a></li>
              <li><a href="#">August 2016</a></li>
              <li><a href="#">July 2016</a></li>
              <li><a href="#">June 2016</a></li>
              <li><a href="#">May 2016</a></li>
              <li><a href="#">April 2016</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">IUT</a></li>
              <li><a href="#">Fizmasoft</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div> 
  
   <?php include("footer.php"); ?>

</body>
</html>