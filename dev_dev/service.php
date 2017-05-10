<!DOCTYPE html>
<html>
<head>
	<title>Zaybal 2</title>
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
  
  <form role="form" action="" method="post">
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
            <input maxlength="100" type="text" required="required" class="form-control hms-form-control" placeholder="Your contact number" />
          </div>
          <div class="form-group">
            <label class="control-label">Your e-mail</label>
              <input maxlength="100" type="text" required="required" class="form-control hms-form-control" placeholder="your e-mail address" />
          </div>
          <label class="control-label">Address</label>
          <div class="form-group">
            <div class="col-md-4">
                <iframe height="300px" width="500px" src="googleMap.html"></iframe>
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
              <label  for="login">Choose type of service</label>  
                <div >
                  <select class="form-control hms-form-control" id="cleanig" name="cleanig">
                    <option>Nothing selected</option>
                    <option>House cleanig</option>
                    <option>Furniture cleanig</option>
                    <option>Pest control</option>
                    </select> 
                </div>
              </div>
              <div class="form-group">
                <label>Write what to do?</label>
                  <div>
                   <textarea class="form-control hms-form-control" placeholder="cleaning home... iphone screen repair..." style="height: 100px;">
                     
                    </textarea>
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
          <input class="form-control hms-form-control" type="date" value="2017-01-23" name="">
          <br> 
          <input class="form-control hms-form-control" type="time" value="15:15" name="">
          <br>
          <div class="form-group">
              <label  for="login">Max money that you can afford</label>  
                <div >
                  <select class="form-control hms-form-control" id="cleanig" name="cleanig">
                    <option>Nothing selected</option>
                    <option>100-200ming So'm</option>
                    <option>200-300ming So'm</option>
                    <option>400-500ming So'm</option>
                    </select> 
                </div>
                <br>
                  <a href="success.php" class="btn btn-success hms-btn-success pull-right" style="font-size: 20px;" >Submit</a>
        </div>
              </div>
          
          
      </div>
    </div>
  </form>
  
</div>

  <?php include("footer.php"); ?>
</body>
</html>