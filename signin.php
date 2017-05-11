<!DOCTYPE html>
<html>
<head>
	<title>My helper</title>
  <?php 
  include("includes.html"); 
  include("service_control.php");
  $service_controller = new ServiceController();
  $all_services = $service_controller->getAllServices();


  ?>
  <script type="text/javascript" src="js/Validate.js"></script>
<style type="text/css">
  .navbar-wrapper
  {
    left:0;
    top: 0;
    background-color:#2495d0;
    position:absolute;
    margin-top: -4px;
  }
  .header1
  {
    overflow: hidden;
    position: relative; 
    height: 50px;
  }

</style>
</head>

 <body>
<div class="header1">
<?php include("header.php"); ?>
</div>
<div class="container">
  <form class="form-horizontal hms-form-register">
 
    <fieldset>
        <div id="name_div" class="form-group has-feedback">
          <label class="col-md-4 control-label" for="name">Name</label>  
            <div class="col-md-4">
              <input required id="name" name="name" type="text" placeholder="Your name . . ." class="form-control hms-form-control input-md" required>
             
            </div>
        </div>

       
        <div id="surname_div" class="form-group has-feedback">
          <label class="col-md-4 control-label" for="surname">Surname</label>  
            <div class="col-md-4">
              <input required id="surname" name="surname" type="text" placeholder="Your surname . . ." class="form-control hms-form-control input-md" >
               
            </div>
        </div>

      <div class="form-group">
          <label class="col-md-4 control-label" for="login">What is your profession(s)?</label>  
            <div class="col-md-4">
             <select required class="form-control hms-form-control" multiple="multiple" id="proff" name="proff">
              <?php for ($i=0; $i < count($all_services); $i++) { ?>
          		<option value="<?php echo $all_services[$i]->id ?>">
              <?php echo $all_services[$i]->name; ?>  
              </option>
          		
             <?php }?>
          	 </select>
              
            </div>
      </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="address">Address</label>
              <div class="col-md-4">
                <iframe id="map" height="300px" width="500px" src="googleMap.html"></iframe>
              </div>
        </div>

       
        <div id="distance_div" class="form-group has-feedback">
          <label class="col-md-4 control-label" for="how_far">How far can you travel (km)</label>
            <div class="col-md-4">
              <input required id="distance" name="distance" type="text" placeholder="e.g 99" class="form-control hms-form-control input-md" >
              
            </div>
        </div>

        <div id="email_div" class="form-group has-feedback">
         <label class="col-md-4 control-label" for="address1">E-mail</label>  
          <div class="col-md-4">
          	<input required id="email" name="name" type="text" placeholder="username@example.com" class="form-control hms-form-control input-md">
    	    </div>
        </div>

         <div id="password_div" class="form-group  has-feedback">
          <label class="col-md-4 control-label" for="how_far">Create your password</label>
           <div class="col-md-4">
             <input required id="password" name="password" type="password" placeholder="Create password. . . " class="form-control hms-form-control input-md" >
            
           </div>
         </div>

        <div id="confirm_div" class="form-group has-feedback">
          <label class="col-md-4 control-label" for="how_far">Confirm your password</label>
            <div class="col-md-4">
              <input required id="confirmPassword" name="password" type="password" placeholder="Confirm password. . . " class="form-control input-md hms-form-control" >
              
            </div>
        </div>

        <div id="con_div" class="form-group has-feedback">
          <label class="col-md-4 control-label" for="address1">Contact number</label>  
            <div class="col-md-4">
              <div class="input-group">
            <text class="input-group-addon" id="basic-addon">+998</text>
              <input required id="con_number" name="contactphone" type="text" placeholder="Last nine number like 97 777 77 77" class="form-control input-md hms-form-control" aria-describedby="basic-addon">
              </div>
            </div>
        </div>

		

        <div class="form-group">
          <label class="col-md-4 control-label" for="save"></label>
            <div class="col-md-8">
              <button id="save" name="save" class="btn btn-success hms-btn-success">Submit</button>
              <button id="cancel" name="cancel" class="btn btn-danger hms-btn-danger">Cancel</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <?php include("footer.php"); ?>
</body>
</html>