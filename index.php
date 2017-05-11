<?php
session_start();
include "category_control.php";
include "user_control.php";
include "post_control.php";
$category_controller = new CategoryController();
$all_categories = $category_controller->getAllCategories();
$user_controller = new UserController();
$all_users = $user_controller->getAllUsers();
$post_controller = new PostController();
$all_posts = $post_controller->getAllPosts();

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
<?php 
    if(isset($_SESSION['login'])){
    
    include("header_dashboard.php");
    
    }
    else
    {
      include("header.php");
    }


?>

    <!-- Carousel block start -->
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/car.jpg" alt="First slide" class="img-responsive">
        <div class="carousel-caption">
          <h3>Auto services</h3>
          <p>Best automative service providers</p>
        </div>
      </div>
      <div class="item">
        <img src="images/home.jpg" class="img-responsive" alt="Second slide">
        <div class="carousel-caption">
          <h3>Home services</h3>
          <p>Almost all type of home services</p>
        </div>
      </div>
      <div class="item">
        <img src="images/laptop.jpg" class="img-responsive" alt="Third slide">
        <div class="carousel-caption">
          <h3>Electronics</h3>
          <p>We can fix all type of gadgets</p>
        </div>
      </div>
    </div>
                
    <a class="left carousel-control hms-carousel-control" href="#carousel-example-generic" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control hms-carousel-control" href="#carousel-example-generic" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>        
  </div>
  <div class="main-text">
    <div class="col-md-12 text-center">
      <h1>We are always ready to help you!</h1>
      <br>
      <br>
      <form action="search.php" method="get">
        <div class="hms-carousel-search-caption">
          <input id="searchBox" type="search" name="key" placeholder="What are you looking for... ?" class="form-control hms-search-input">
          <button class="btn btn-clear btn-sm hms-search-btn">Search services</button>
        </div>
      </form>


    </div>
  </div>
   <!-- Carousel block end -->  

    <!-- News block start -->
  
   <div class="panel panel-default container hms-section-header">
    <div class="panel-body">
      <a href="main.php?page=news" title="Read more"><span class="glyphicon glyphicon-link"></span></a>
      <a href="main.php?page=news">
        Latest news 
      </a> 
    </div>
  </div>

  <div class="container">
    
    <?php 
    $number_posts = ((count($all_posts)>2) ? 2 : count($all_posts));
    for ($i=0; $i < $number_posts; $i++) { 
  

     ?>
    <div class="jumbotron hms-news-block col-md-6">
      <div class="bs-callout bs-callout-info">
        <div class="col-sm-5">
          
          <img style="height: 150px" src="post_images/<?php echo file_exists("post_images/".$all_posts[$i]->id.".png")?$all_posts[$i]->id : "post_default";?>.png" class="img-responsive">
        </div>
        <div class="col-sm-7">
          <p><?php echo $all_posts[$i]->title; ?></p>
          <p class="hms-news-block-description">
            <?php
                    if(strlen($all_posts[$i]->description)>30){
                      echo substr($all_posts[$i]->description, 0,30)."<b> . . .</b>";
                    }else{
                      echo $all_posts[$i]->description;
                    }
            ?>
          </p>
          <p class="hms-news-block-span"><span><?php echo $all_posts[$i]->create_date ?>| Administrator</span></p>
          <a href="main.php?page=view-post&post_id=<?php echo $all_posts[$i]->id ?>" style="font-size: 12pt;">Read more <i class="fa fa-angle-double-right"></i></a>
        </div>
      </div>
    </div>
<?php }?>
    
  </div>
    <!-- News block end -->

    <div class="panel panel-default container hms-section-header">
      <div class="panel-body">
        <a href="main.php?page=categories" title="Read more"><span class="glyphicon glyphicon-link"></span></a>
        <a href="main.php?page=categories">
          Our services
        </a>
      </div>
    </div>

    <div class="container marketing">
      <div class="row">

              <?php
                  $number = ((count($all_categories) < 7) ? count($all_categories) : 6); 
                  for ($i=0; $i < $number; $i++) { 
                    
                  

               ?>
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='services.php?page=home-services&id=<?php echo $all_categories[$i]->id;  ?>'">
              <span class="fa <?php echo $all_categories[$i]->icon ?> hms-card-icon"></span>
              <h2><?php echo $all_categories[$i]->name ?></h2>
              <p><?php echo $all_categories[$i]->description ?></p>
          </div>

        </div>
              <?php  } ?>

    

      </div>     
    </div>
    <!-- Categories block end -->

  <!-- Service providers block start -->
  <div class="panel panel-default container hms-section-header">
    <div class="panel-body">
      <a href="main.php?page=users" title="Read more"><span class="glyphicon glyphicon-link"></span></a>
      <a href="main.php?page=users">
        Top service providers 
      </a>
    </div>
  </div>

   <div class="container">
     <div class="row">
      <?php 
            $user_count = ((count($all_users) < 4)? count($all_users) : 3);
            for ($i=0; $i < $user_count; $i++) { 
              # code...
            
      ?>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail hms-thumbnail">
            <div class="col-md-12 hms-thumbnail-img">
              <img src="profile_images/<?php echo file_exists("profile_images/".$all_users[$i]->id.".png") ? $all_users[$i]->id:"default";?>.png" height="200" width="200" class="img-circle" alt="...">
            </div>
            <div class="caption">
              <h3><?php echo $all_users[$i]->name." ".$all_users[$i]->surname ?></h3>
              <p><?php echo $all_users[$i]->description ?></p>
              <p><a href="main.php?page=view-user&user_id=<?php echo $all_users[$i]->id ?>" class="btn btn-primary hms-btn-primary pull-right hms-btn-primary" role="button">More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>
            </div>
          </div>
        </div>
        <?php }?>

     
     </div>
   </div>
  
   <!-- Service providers block end -->
  
   <?php include("footer.php"); ?>

   <script type="text/javascript">
     $(function(){
        $(window).scroll( function() {
          navbar_fixed_onscroll();
        });

        navbar_fixed_onscroll();
     });
   </script>
</body>
</html>