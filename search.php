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
    <?php 
      include("header.php");
      include("service_control.php");
      $search = new ServiceController("myhelper_db","localhost","root","",true);
      $keyword=$_GET["key"];
      $results=array();
      if($keyword && strlen($keyword)>0)
        $results=$search->searchService($keyword);

    ?>
  </div>
  <link rel="stylesheet" type="text/css" href="css/navbar_fixed.css">
  <div class="container">
      
      <div class="row">
        <h2><?=count($results)?> of result found for <kbd>"<?=$keyword?>"</kbd></h2>
        <hr>

        
        <?php foreach($results as $row){ 
        ?>
        <!-- Search result start -->
        <div class="col-sm-9 col-md-8">
          <div class="jumbotron hms-news-block col-md-12">
              <div class="bs-callout bs-callout-info">
                <div class="col-sm-4 hms-search-block-header"> 
                  <i class="fa fa-chain"></i>
                </div>
                <div class="col-sm-8">
                  <p><?=$row["service"]->name?></p>
                  <p class="hms-news-block-description"><?=$row["service"]->description?></p>
                  <p class="hms-news-block-span"><span>Service is from '<?=$row["category_name"]?>' Category</span></p>
                  <a href="service.php">Apply <i class="fa fa-angle-double-right hms-search-block-btn"></i></a>
                </div>
              </div>
            </div>
        </div>
        <?php }
        ?>   
        <!-- Search result end -->
        
        <?php if(count($results)==0){ ?>
          <div class="col-sm-9 col-md-8">
          <div class="jumbotron hms-news-block col-md-12">
              <div class="bs-callout bs-callout-info">
                <div class="col-sm-4 hms-search-block-header"> 
                  <i class="fa fa-chain"></i>
                </div>
                <div class="col-sm-8">
                  <p>No results found for the search '<?=$_GET['key'];?>'</p>
                </div>
              </div>
            </div>
        </div>
        <?php } ?>

        
        <!-- Sidebar start -->
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