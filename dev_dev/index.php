<?php
session_start();
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
      <h1>We always ready to help you!</h1>
      <br>
      <br>
      <div class="hms-carousel-search-caption">
        <input id="searchBox" type="search" name="search" placeholder="What are you looking for... ?" class="form-control hms-search-input">
        <button class="btn btn-clear btn-sm hms-search-btn">Search services</button>
      </div>
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
    
    <div class="jumbotron hms-news-block col-md-6">
      <div class="bs-callout bs-callout-info">
        <div class="col-sm-5">
          
          <img src="images/img.jpg" class="img-responsive">
        </div>
        <div class="col-sm-7">
          <p>Pet care services</p>
          <p class="hms-news-block-description">We are planning to offer another type of service to our customers that involves pet care</p>
          <p class="hms-news-block-span"><span>09.05.2017 | Administrator</span></p>
          <a href="main.php?page=view-post" style="font-size: 12pt;">Read more <i class="fa fa-angle-double-right"></i></a>
        </div>
      </div>
    </div>

    <div class="jumbotron hms-news-block col-md-6">
      <div class="bs-callout bs-callout-info">
        <div class="col-sm-5">
          
          <img src="images/img.jpg" class="img-responsive">
        </div>
        <div class="col-sm-7">
          <p>Max auto service company</p>
          <p class="hms-news-block-description">We are in last step of assigning contract one of the best auto service providers named "Max auto service"</p>
          <p class="hms-news-block-span"><span>09.05.2017 | Administrator</span></p>
          <a href="../migration" style="font-size: 12pt;">Read more <i class="fa fa-angle-double-right"></i></a>
        </div>
      </div>
    </div>
    
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

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='services.php?page=home-services'">
              <span class="fa fa-home hms-card-icon"></span>
              <h2>Home services</h2>
              <p>We are always ready to fix the problem that occured at your house. Such as, cleaning house, electrical problems, laundary, painting and etc</p>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='services.php?page=auto-services'">
              <i class="fa fa-car hms-card-icon" aria-hidden="true"></i>
              <h2>Auto services</h2>
              <p>We have assigned contract with several best auto service providers. So that, you can order any kind of auto services that inluded in our service category. In addition, we also can provide services at  anywhere</p>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='services.php?page=electronic-services'">
              <span class="fa fa-laptop hms-card-icon"></span>
              <h2>Electronics</h2>
              <p>Prior to now, it natural that anyone has some kind of electronic. Such as, phone, laptop, Television and etc. So, if some problems occures on your gadget just let us know and our specalists will be at your house </p>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='services.php?page=fashion-services'">
              <span class="fa fa-cut hms-card-icon"></span>
              <h2>Fashion services</h2>
              <p>We can offer several type of fashion services. That includes tailor services, watch repair services and goldsmith as well. We are arranging to include new type of fashion service soon</p>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='services.php?page=moving-services'">
              <span class="fa fa-truck hms-card-icon"></span>
              <h2>Moving services</h2>
              <p>If you are arraning to move new house or location. We can help you to find moving services providers that can safely lead your thing to that destination</p>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='services.php?page=storage-services'">
              <span class="fa fa-database hms-card-icon"></span>
              <h2>Storage services</h2>
              <p>We can keep your things or pets safely in some period of time. Especially, our storage services includes keeping pets, flowers and other things</p>
          </div>
        </div>

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
      
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail hms-thumbnail">
            <div class="col-md-12 hms-thumbnail-img">
              <img src="images/img.jpg" height="200" width="200" class="img-circle" alt="...">
            </div>
            <div class="caption">
              <h3>Elbek Khoshimjonov</h3>
              <p>Master of electronic services</p>
              <p><a href="main.php?page=view-user" class="btn btn-primary hms-btn-primary pull-right hms-btn-primary" role="button">More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-4">
          <div class="thumbnail hms-thumbnail">
            <div class="col-md-12 hms-thumbnail-img">
              <img src="images/img.jpg" height="200" width="200" class="img-circle" alt="...">
            </div>
            <div class="caption">
              <h3>Normurod Mamasoliyev</h3>
              <p>Auto service provider</p>
              <p><a href="#" class="btn btn-primary hms-btn-primary pull-right" role="button">More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>
            </div>
          </div>
        </div>

      <div class="col-sm-6 col-md-4">
          <div class="thumbnail hms-thumbnail">
            <div class="col-md-12 hms-thumbnail-img">
              <img src="images/img.jpg" height="200" width="200" class="img-circle" alt="...">
            </div>
            <div class="caption">
              <h3>Dostonbek Oripjonov</h3>
              <p>Storage service provider</p>
              <p><a href="#" class="btn btn-primary hms-btn-primary pull-right" role="button">More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>
            </div>
          </div>
        </div>

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