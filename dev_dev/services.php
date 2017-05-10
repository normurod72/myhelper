<?php if(!isset($_GET['page'])){header("Location:?page=home-services");} ?>
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

    <?php if($_GET['page']=='home-services'){ ?>
      <div class="row" style="margin-top: 60px;">

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-home hms-card-icon"></span>
              <h2>Cleaning</h2>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <i class="fa fa-car hms-card-icon" aria-hidden="true"></i>
              <h2>Painting</h2>
              </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-laptop hms-card-icon"></span>
              <h2>Laundary</h2>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-cut hms-card-icon"></span>
              <h2>Electrical</h2>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-truck hms-card-icon"></span>
              <h2>Handyman</h2>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-database hms-card-icon"></span>
              <h2>Plumbing</h2>
            </div>
        </div>

      </div>     
    <?php } ?>

    <?php if($_GET['page']=='auto-services'){ ?>
      <div class="row" style="margin-top: 60px;">

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-home hms-card-icon"></span>
              <h2>Battery Services</h2>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <i class="fa fa-car hms-card-icon" aria-hidden="true"></i>
              <h2>Flate tire change</h2>
              </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-laptop hms-card-icon"></span>
              <h2>Fuel delivery</h2>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if($_GET['page']=='fashion-services'){ ?>
      <div class="row" style="margin-top: 60px;">

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-home hms-card-icon"></span>
              <h2>Tailor</h2>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <i class="fa fa-car hms-card-icon" aria-hidden="true"></i>
              <h2>Watch repair</h2>
              </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-laptop hms-card-icon"></span>
              <h2>Goldsmith</h2>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if($_GET['page']=='electronic-services'){ ?>
      <div class="row" style="margin-top: 60px;">

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-home hms-card-icon"></span>
              <h2>Mobile repair</h2>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <i class="fa fa-car hms-card-icon" aria-hidden="true"></i>
              <h2>Laptop repair</h2>
              </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-laptop hms-card-icon"></span>
              <h2>Tablet repair</h2>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-cut hms-card-icon"></span>
              <h2>TV repair</h2>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-truck hms-card-icon"></span>
              <h2>Printer repair</h2>
          </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-database hms-card-icon"></span>
              <h2>Game Console repair</h2>
            </div>
        </div>
         <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-database hms-card-icon"></span>
              <h2>Windows support</h2>
            </div>
        </div>
         <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-database hms-card-icon"></span>
              <h2>Wifi support</h2>
            </div>
        </div>
         <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-database hms-card-icon"></span>
              <h2>Appliances</h2>
            </div>
        </div>

      </div>
    <?php } ?>

    <?php if($_GET['page']=='moving-services'){ ?>
      <div class="row" style="margin-top: 60px;">

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-home hms-card-icon"></span>
              <h2>Home to home</h2>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <i class="fa fa-car hms-card-icon" aria-hidden="true"></i>
              <h2>Production moving</h2>
              </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-laptop hms-card-icon"></span>
              <h2>Moving melting things</h2>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if($_GET['page']=='storage-services'){ ?>
      <div class="row" style="margin-top: 60px;">

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-home hms-card-icon"></span>
              <h2>Furniture or electronics</h2>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <i class="fa fa-car hms-card-icon" aria-hidden="true"></i>
              <h2>Flowers</h2>
              </div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="hms-card" onclick="window.location.href='service.php'">
              <span class="fa fa-laptop hms-card-icon"></span>
              <h2>Pets</h2>
          </div>
        </div>
      </div>
    <?php } ?>

    </div>
    <?php include("footer.php"); ?>
 </body>
</html>