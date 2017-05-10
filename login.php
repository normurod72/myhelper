<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <?php include("includes.html"); ?>
    <link rel="stylesheet" type="text/css" href="css/navbar_fixed.css">
    <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<div class="header1">
    <?php include("header.php"); ?>
</div>
    
<section id="login">
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">               
                <h1>Log in your account</h1>
                <form role="form" action="request_handler.php" method="post" id="login-form" autocomplete="off">
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control hms-form-control" placeholder="Email or Username">
                    </div>
                    <div class="form-group">
                        <label for="key" class="sr-only">Password</label>
                        <input type="password" name="key" id="key" class="form-control hms-form-control" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <span id="checkbox_id" class="character-checkbox" onclick="showPassword()"></span>
                        <span class="label">Show password</span>
                    </div>
                    <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block hms-btn-danger" name="submit" value="Log in">
                </form>
                <a href="javascript:;" class="forget" data-toggle="modal" data-target=".forget-modal">Forgot your password?</a>
                <hr/>                  
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close hms-btn-danger" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Recovery password</h4>
            </div>
            <div class="modal-body">
                <p>Type your email account</p>
                <input type="email" name="recovery-email" id="recovery-email" class="form-control hms-form-control" autocomplete="off">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default hms-btn-primary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom hms-btn-danger">Recovery</button>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
<?php include("footer.php"); ?>

</body>
</html>
