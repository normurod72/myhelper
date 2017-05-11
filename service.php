<!DOCTYPE html>
<html>
<head>
	<title>Service</title>
	<?php include("includes.html"); ?>
  <link rel="stylesheet" type="text/css" href="css/navbar_fixed.css">
</head>

 <body>
<div class="header1">
<?php include("header.php"); ?>
</div>
<br>
<div class="container">
  
<div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
        <p>Step 1</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p>Step 2</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p>Step 3</p>
      </div>
    </div>
  </div>
  
  <form role="form" action="order_request_handler.php" method="post">
    <div class="row setup-content" id="step-1">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3> Enter your details</h3>
          <div class="form-group">
            <label class="control-label">Name</label>
            <input  maxlength="100" name="name" type="text" required="required" class="form-control hms-form-control" placeholder="Enter First Name"  />
          </div>
          <div class="form-group">
            <label class="control-label">Phone number</label>
            <input maxlength="100" type="text" required="required" name="contact_number" class="form-control hms-form-control" placeholder="Your contact number" />
          </div>
          <div class="form-group">
            <label class="control-label">Your e-mail</label>
              <input maxlength="100" type="email" required="required" name="email" class="form-control hms-form-control" placeholder="your e-mail address" />
          </div>
          <label class="control-label">Address</label>
          <div class="form-group">
            <div class="col-md-4">
                <input id="lat" type="text" value="41.2994958" readonly name="lat" hidden >
                <input id="lng" type="text" value="69.24007340000003" name="lng" readonly hidden >
                <input type="text" value="Tashkent, Uzbekistan" name="map_address" id="map_address" hidden readonly>
                <iframe id="map_id" onload="need()" height="300px" width="500px" src="googleMap.html"></iframe>
            </div>
          </div>
         </div>
          <button class="btn hms-btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
      </div>
    </div>
    <div class="row setup-content" id="step-2">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Write what problem you have</h3>
          <div class="form-group">
              <input type="text" name="service_id" value="<?php echo $_GET['service_id']; ?>" hidden>
              </div>
              <div class="form-group">
                <label>Write what to do?</label>
                  <div>
                   <textarea name="description" class="form-control hms-form-control" placeholder="cleaning home... iphone screen repair..." style="height: 100px;"></textarea>
            </div>
          </div>  
        </div>
        <button class="btn hms-btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
      </div>
    </div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Time and Money</h3>
          <input class="form-control hms-form-control" name="date" type="date" value="2017-01-23" name="">
          <br> 
          <input class="form-control hms-form-control" name="time" type="time" value="15:15" name="">
          <br>
          <div class="form-group">
              <label  for="login">Max money that you can afford</label>  
                <div >
                  <select class="form-control hms-form-control" id="cleanig" name="cost">
                    <option value="0">Nothing selected</option>
                    <option value="200">100-200ming So'm</option>
                    <option value="300">200-300ming So'm</option>
                    <option value="500">400-500ming So'm</option>
                    </select> 
                </div>
                <br>
                <input type="submit" class="btn btn-success hms-btn-success pull-right" value="Submit" name="order_service">
                  <!-- <a href="success.php" class="" style="font-size: 20px;" ></a> -->
        </div>
              </div>
          <script type="text/javascript">
            $(function(){
                  $("#map_id").contents().find("#pac-input").focusout(function(){
                      something();
                  });
            });

            function something(){
              var lng_field = $('#lng');
              var lat_field = $('#lat');

              var valueOf = $("#map_id").contents().find("#pac-input").val();

              var geocoder =  new google.maps.Geocoder();
              console.log(geocoder);
                geocoder.geocode( { 'address': valueOf}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                lng = results[0].geometry.location.lng().toString();
                lat = results[0].geometry.location.lat().toString();
              lat_field.val(lat =="" ? "41.2994958" : lat);
              lng_field.val(lng =="" ? "69.24007340000003": lng);
              $('#map_address').val(valueOf==""?"Tashkent,Uzbekistan":valueOf);

            }

             });
            }
           function need(){
            $("#map_id").contents().find("#pac-input").val("Tashkent, Uzbekistan");
           }
          </script>
          
      </div>
    </div>
  </form>
  
</div>

  <?php include("footer.php"); ?>
</body>
</html>