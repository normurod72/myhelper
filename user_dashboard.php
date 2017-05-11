<?php 
    session_start();
    if(!isset($_SESSION['login'])){ header("Location:login.php");}
    include "user_control.php";
    include "service_control.php";
    if(!isset($_GET['page'])){header("Location:?page=dashboard");}
    $user_controller = new UserController();
    $user = $user_controller->getUserById($_SESSION['id']);
    $service_controller = new ServiceController();
    $all_services = $service_controller->getAllServices();

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Dashboard</title>
  <?php include("includes.html"); ?>
  <script type="text/javascript" src="js/update.js"></script>
  <link rel="stylesheet" type="text/css" href="css/navbar_fixed.css">
  <style type="text/css">
    @media (min-width: 768px) {
  .sidebar {
    position: absolute;
    top: 57px;
    bottom: 0;
    left: 0;
    z-index: 1000;
    display: block;
    padding: 20px;
    overflow-x: hidden;
    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    background-color: #f5f5f5;
    border-right: 1px solid #eee;
  }
}
  </style>
</head>
<body>
  <div class="header1">
    <?php include("header_dashboard.php"); ?>
  </div>
  <div class="container-fluid">
    <div class="container">
      <div class="row">
      <!--?php echo "User id is ".$user->id;?-->

        <div class="col-sm-3 col-md-3 well hms-user-well">
          <ul class="nav nav-sidebar">
            <div class="col-md-12 placeholder">
              <img src="profile_images/<?php echo file_exists("profile_images/".$user->id.".png") ? $user->id:"default";?>.png" height="120" width="120"  alt="Generic placeholder thumbnail">
              <h4><?php echo $user->name." ".$user->surname ?></h4>
              <span class="text-muted">Rating of the user 5.2</span>
            </div>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="<?= ($_GET['page']=='dashboard')?'active':''; ?>"><a href="?page=dashboard">Notifications <span class="sr-only">(current)</span></a></li>
            <li class="<?= ($_GET['page']=='archives')?'active':''; ?>"><a href="?page=archives">Archive</a></li>
            <li class="<?= ($_GET['page']=='profile')?'active':''; ?>"><a href="?page=profile">Edit profile</a></li>
          </ul>
        </div>


          <div class="col-sm-9 hms-user-dashboar-body">

          <?php if($_GET['page']=='dashboard'){
            require "order_control.php";
            
            $service_cont=new ServiceController();
            $order_cont=new OrderController();
            $orders=$order_cont->getNotSelectedOrderForUser($user->id);
            $order_count=count($orders);
           ?>

          <h1 class="page-header">Notifications <?php if($order_count>0){?><span class="badge"><?=$order_count?></span><?php }?></h1>

        <?php foreach($orders as $row){
          $service=$service_cont->getService($row->service_id);
          $service_name=($service)?$service->name: "Undefined Service"; 
        ?>
          <blockquote class="hms-user-notification-card">
            <div class="col-md-9">
              <h3><?= $service_name?></h3>
              <p class="hms-user-notification-card-message"><?= $row->description?></p>
              <!-- <hr> -->
              <input type='text' hidden value="<?=$row->id?>">
              <p class="blog-post-meta hms-user-notification-card-footer"> <button
                onclick="addMap('MyHELPER','41.348528','69.237278')" data-toggle="modal" data-target="#user_apply_modal"
               class="btn btn-primary hms-btn-primary">Apply</button> <span style="float: right;"><?=$row->address?> | <?=$row->contact_number?> | <?=$row->name?> | <?=$row->email?></span></p>
            </div>
            <div class="col-md-3">
              <i class="<?=($service)?$service->icon:''?>" ></i>
            </div>
          </blockquote>



<!-- Modal -->
<div id="user_apply_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button  type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change password</h4>
      </div>

      <div class="modal-body">
          
            
        </div>
      <div class="modal-footer">
        <button name="submit_to_order" id="submit_to_order" type="button" class="btn btn-success hms-btn-success" data-dismiss="modal">Submit</button>
        <button  type="button" class="btn btn-default hms-btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
</div>
<!-- Modal -->
<script type="text/javascript">
  function addMap(addr="Fizmasoft",lat=41.348528,lng=69.237278){
    $("#user_apply_modal .modal-body").html('<div style="overflow:hidden;width:100%;height:300px; margin-top:10px; margin-bottom:10px;resize:none;max-width:100%; border: 3px solid white;box-shadow: 0px 0px 1px 0px black;"><div style="width: 500px"><iframe width="600" height="300" src="http://www.maps.ie/create-google-map/map.php?width=500&amp;height=400&amp;hl=en&amp;coord='+lat+','+lng+'&amp;q=('+addr+')&amp;ie=UTF8&amp;t=h&amp;z=15&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="http://www.mapsdirections.info/de/erstellen-sie-eine-google-map/">Google Map</a> by <a href="http://www.mapsdirections.info/de/">Erstellen Google Map</a></iframe></div><a class="embed-map-code" href="http://www.hostingreviews.website/compare/ipage-vs-bluehost" id="authorize-maps-data">details here</a><style>#my-map-canvas img{max-width:none!important;background:none!important;}</style></div>');
  }
</script>

        <?php } ?>


          <?php } ?>


          <?php if($_GET['page']=='archives'){ 
             require "order_control.php";
            require "service_control.php";
            $service_cont=new ServiceController();
            $order_cont=new OrderController();
            $orders=$order_cont->getSelectedOrderForUser($user->id);
            $order_count=count($orders);
            ?>

          <h1 class="page-header">Active Orders</h1>

          <?php foreach($orders as $row){
          $service=$service_cont->getService($row->service_id);
          $service_name=($service)?$service->name: "Undefined Service"; 
        ?>
          <blockquote class="hms-user-notification-card">
            <div class="col-md-9">
              <h3><?= $service_name?></h3>
              <p class="hms-user-notification-card-message"><?= $row->description?></p>
              <!-- <hr> -->
              <input type='text' hidden value="<?=$row->id?>">
              <p class="blog-post-meta hms-user-notification-card-footer"> <button class="btn btn-primary hms-btn-primary">Cancel</button> <span style="float: right;"><?=$row->address?> | <?=$row->contact_number?> | <?=$row->name?> | <?=$row->email?></span></p>
            </div>
            <div class="col-md-3">
              <i class="<?=($service)?$service->icon:''?>" ></i>
            </div>
          </blockquote>
        <?php } ?>


          <?php } ?>
          

          <?php if($_GET['page']=='profile'){ ?>
            <h1 class="page-header">My Profile</h1>
            <form action="update.php" method="post" enctype="multipart/form-data" class="form-horizontal hms-form-register">
              <fieldset>
                <div class="col-md-6 has-feedback" style="padding-right: 35px;">

                  <div id="name_div_id_field" class="form-group has-feedback">
                    <label class="control-label" for="name">Name</label> 
                        <input id="name_field" name="user_name" type="text" value="<?php echo $user->name; ?>" placeholder="Your name . . ." class="form-control hms-form-control input-md" required="">
                         
                  </div>

                 
                  <div id="surname_div_id" class="form-group has-feedback">
                    <label class="control-label" for="surname">Surname</label>  
                        <input id="surname_id" name="user_surname" type="text" value="<?php echo $user->surname; ?>" placeholder="Your surname" class="form-control hms-form-control input-md" required="">
                        
                  </div>

                <div class="form-group">
                    <label class="control-label" for="login">What is your profession?</label>  
                      
                       <select class="form-control hms-form-control selectpicker" id="proff_id" name="user_proff"  multiple>
                        <?php for ($i=0; $i < count($all_services); $i++) { ?>
                        <option value="<?php echo $all_services[$i]->id ?>">
                        <?php echo $all_services[$i]->name; }?>  
                       </select>
                       
                      
                </div>

                  <div id="distance_div_id" class="form-group has-feedback">
                    <label class="control-label" for="how_far">How far can you travel (km)</label>
                      
       <input id="distance_id" name="user_distance" type="text" value="<?php echo $user->distance;?>" placeholder="e.g 99" class="form-control hms-form-control input-md" required="">
                       
                      
                  </div>

                  <div id="email_div_id" class="form-group has-feedback">
                   <label class="control-label" for="address1">E-mail</label>  
                    
                      <input id="email_id" name="user_email" type="text" value="<?php echo $user->email; ?>" placeholder="username@example.com" class="form-control hms-form-control input-md" required="">
                    
                  </div>


                      <div id="con_div_id" class="form-group has-feedback">
                        <label class="control-label" for="address1">Contact number</label>  
                          <div class="input-group">
                           <text class="input-group-addon" id="basic-addon">+998</text> 
                            <input id="contactphone_id" name="user_contactphone" type="text" value="<?php echo $user->contact_number; ?>" placeholder="Last seven numbe like 97 777 77 77" class="form-control input-md hms-form-control"  aria-describedby="basic-addon" required="">
                          </div>
                      </div>

                   <div class="form-group">
                         
                       <label class="control-label" for="address1">Password</label>  
                          <span class="help-block well hms-password-well"><a id="btn_change_pass" style="color:green" href="#" data-toggle="modal" data-target="#myModal"> Change your password  <span class="glyphicon glyphicon-pencil"></span></a></span>
                         
                       </div>


                  
                  </div>
                 
                 <div class="col-md-6" style="padding-left: 35px;">

                      <div class="form-group">
                          <label class="control-label">Photo</label>
                          <img src="profile_images/<?php echo file_exists("profile_images/".$user->id.".png") ? $user->id:"default";?>.png" style="width: 100%" class="img-responsive thumbnail hms-user-img-well" alt="Generic placeholder thumbnail">
                          <input type="file" name="user_image" class="form-control hms-form-control" style="padding-top: 4px;">
                      </div>
                  
                      
                      
                      <div class="form-group">
                          <label class="control-label" for="address">About me</label>
                          <textarea rows="10" name="describtion" placeholder="Description, e.g what you did before? your experience etc. " class="form-control hms-form-control"></textarea>
                      </div>

                  </div>


                  <div class="form-group col-md-12">
                      <label class="control-label" for="address">My current location</label>
                      <input id="lng_field" type="text" name="lng" value="<?php echo $user->lng; ?>" hidden >
                      <input id="lat_field" type="text" value="<?php echo $user->lat; ?>" name="lat" hidden >
                      <input type="text" name="address_hidden" id="hidden_address" hidden value="<?php echo $user->address; ?>">
                      <iframe onload="iframe()" id="map_id" height="294px" style="width: 104%;" src="googleMap.html"></iframe>
                  </div>

                  <div class="form-group" style="text-align: right;">
                    <label class="col-md-12 control-label" for="save"></label>
                      <div class="col-md-12">
                        <button id="edit" name="save" class="btn btn-success btn-lg hms-btn-success"> Save changes </button>
                    </div>
                  </div>
                </fieldset>
              </form>

          <?php } ?>

        </div>
      </div><!--container end-->
    </div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button  type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change password</h4>
      </div>

      <div class="modal-body" style="border-radius: 3px !important;">
        <div id="current_pass_div" class="form-group has-feedback">
          <label class="control-label" for="address1">Current password</label>  
          <input id="current_password_field" name="current_pass" type="password" class="form-control hms-form-control input-md" required="">            
        </div>
        <div id="new_pass_div" class="form-group has-feedback">
          <label class="control-label" for="address1">New password</label>  
          <input id="new_password_field" name="new_pass" type="password" class="form-control hms-form-control input-md" required="">            
        </div>
        <div id="confirm_pass_div" class="form-group has-feedback">
          <label class="control-label" for="address1">Confirm new password</label>  
          <input id="confirm_password_field" name="confirm_pass" type="password" class="form-control hms-form-control input-md" required="">            
        </div>
      </div>
      <div class="modal-footer">
        <button name="save_password" id="save_password" type="button" class="btn btn-success hms-btn-success" data-dismiss="modal">Save</button>
        <button  type="button" class="btn btn-default hms-btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


    </div> 
    <?php include("footer.php"); ?> 
</body>
</html>