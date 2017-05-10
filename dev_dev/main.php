<?php if(!isset($_GET['page'])){header("Location:?page=home");} ?>

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

            
            <div class="jumbotron hms-news-block col-md-12">
              <div class="bs-callout bs-callout-info">
                <div class="col-sm-5"> 
                  <img src="images/img.jpg" class="img-responsive">
                </div>
                <div class="col-sm-7">
                  <p>Pet care services</p>
                  <p class="hms-news-block-description">We are planning to offer another type of service to our customers that involves pet care</p>
                  <p class="hms-news-block-span"><span>09.05.2017 | Administrator</span></p>
                  <a href="?page=view-post" style="font-size: 12pt;">Read more <i class="fa fa-angle-double-right"></i></a>
                </div>
              </div>
            </div>

            <div class="jumbotron hms-news-block col-md-12">
              <div class="bs-callout bs-callout-info">
                <div class="col-sm-5">
                  
                  <img src="images/img.jpg" class="img-responsive">
                </div>
                <div class="col-sm-7">
                  <p>Max auto service company</p>
                  <p class="hms-news-block-description">We are in last step of assigning contract one of the best auto service providers named "Max auto service"</p>
                  <p class="hms-news-block-span"><span>09.05.2017 | Administrator</span></p>
                  <a href="?page=news&id=2" style="font-size: 12pt;">Read more <i class="fa fa-angle-double-right"></i></a>
                </div>
              </div>
            </div>

           
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
        <?php if($_GET['page']=='categories'){ ?>
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
        <?php if($_GET['page']=='view-post'){ ?>
        <div class="col-sm-8 blog-main">
         
          <div class="blog-header">
            <h1 class="blog-title">Hello world</h1>
            <p class="blog-post-meta">January 1, 2014 by <a href="#">Admin</a></p>
          </div>

          <div class="blog-post">
            <img src="images/img.jpg" class="img-responsive thumbnail hms-thumbnail">
            
            <h3>Sub-heading</h3>
            <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <ul>
              <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
              <li>Donec id elit non mi porta gravida at eget metus.</li>
              <li>Nulla vitae elit libero, a pharetra augue.</li>
            </ul>
            <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
            <ol>
              <li>Vestibulum id ligula porta felis euismod semper.</li>
              <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
              <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
            </ol>
            <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
          </div>
         

        </div><!-- /.blog-main -->
        <?php } ?>
        <!-- Post page end  --> 



        <!-- Testimonials page start  --> 
        <?php if($_GET['page']=='view-post'){ ?>
        <div class="col-sm-8 blog-main">
         
          <div class="blog-header">
            <h1 class="blog-title">Hello world</h1>
            <p class="blog-post-meta">January 1, 2014 by <a href="#">Admin</a></p>
          </div>

          <div class="blog-post">
            <img src="images/img.jpg" class="img-responsive thumbnail hms-thumbnail">
            
            <h3>Sub-heading</h3>
            <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <ul>
              <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
              <li>Donec id elit non mi porta gravida at eget metus.</li>
              <li>Nulla vitae elit libero, a pharetra augue.</li>
            </ul>
            <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
            <ol>
              <li>Vestibulum id ligula porta felis euismod semper.</li>
              <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
              <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
            </ol>
            <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
          </div>
         

        </div><!-- /.blog-main -->
        <?php } ?>
        


         <!-- Users page start  --> 
        <?php if($_GET['page']=='users'){ ?>
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
        <?php if($_GET['page']=='view-user'){ ?>
        <div class="col-sm-8 blog-main">
         <h2>User name</h2>
         <hr>

          <div class="col-md-12 thumbnail hms-thumbnail">
            <img src="images/img.jpg" class="img-responsive" alt="...">
          </div>

          <h3>Info</h3>
          <ul>
            <li>Address</li>
            <li>Phone number</li>
            <li>Profession</li>
            <li>About user ...</li>
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