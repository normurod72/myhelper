<?php 

if(!isset($_GET['page'])){header("Location:?page=home-services");}
include "service_control.php";

$service_controller= new ServiceController();

$services = $service_controller->getServicesForCategory($_GET['id']);

 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <?php include("includes.html"); ?>
  <link rel="stylesheet" type="text/css" href="css/navbar_fixed.css">
</head>
 <body>
 <div class="header1">
<?php include("header.php"); ?>
</div>
    <div class="container marketing ">

      <div class="row" style="margin-top: 60px;">
    <?php
        
      for ($i=0; $i < count($services); $i++) { 
      
     ?>

        <div class="col-sm-6 col-md-4 col-lg-4">
       
          <div class="hms-card" onclick="window.location.href='service.php?service_id=<?php echo $services[$i]->id; ?>'">
              <span class="fa <?php echo $services[$i]->icon; ?> hms-card-icon"></span>
              <h2><?php echo $services[$i]->name;?></h2>
              <p><?php echo $services[$i]->description; ?></p>
        </div>
       </div>       
     <?php } ?>
    </div>     
   </div>
  <?php include("footer.php"); ?>
 </body>
</html>