<?php 
  session_start();
  include "post_control.php";
  include "user_control.php";
  if(!isset($_GET['page'])){header("Location:?page=dashboard");} 
  $post_controller = new PostController("myhelper_db", "localhost", "root", "", true);
  $post = $post_controller->getAllPosts(); 
  $user_controller = new UserController("myhelper_db", "localhost", "root", "", true);
  $users = $user_controller->getAllUsers();
 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<?php include("includes.html"); ?>
  <link rel="stylesheet" type="text/css" href="css/navbar_fixed.css">
  <style type="text/css">
    .header1{
      position: fixed;
      left: 0px;
      right: 0px;
      z-index: 9;
    }
    .hms-user-dashboar-body{
      margin-top: 60px;
    }
  </style>
</head>

 <body>
<div class="header1">
<?php include("header_dashboard.php"); ?>
</div>
  <div class="container-fluid">
     

      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <div class="col-md-12 placeholder">
              <img src="images/img.jpg" height="100" width="100"  alt="Generic placeholder thumbnail">
              <h4>Normurod Mamasoliev</h4>
              <span class="text-muted">Title of the user</span>
            </div>
          </ul>
          <ul class="nav nav-sidebar">
            <li <?php echo ($_GET['page']=='dashboard')?'class="active"':'';?>><a href="?page=dashboard">Dashboard</a></li>
            <li><a href="#">Analytics</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li <?php echo ($_GET['page']=='posts')?'class="active"':'';?>><a href="?page=posts">Posts</a></li>
            <li <?php echo ($_GET['page']=='users')?'class="active"':'';?>><a href="?page=users">Users <span class="sr-only">(current)</span></a></li>
            <li <?php echo ($_GET['page']=='categories')?'class="active"':'';?>><a href="?page=categories">Categories</a></li>
            <li><a href="">Services</a></li>
            <li><a href="">Settings</a></li>
          </ul>
        </div>




        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main hms-user-dashboar-body">

          <?php if($_GET['page']=='dashboard'){ ?>
          <h1 class="page-header">Dashboard</h1>
          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </div> 
          <?php } ?>
          
          <?php print_r($_POST); print_r($_GET); ?>





          <?php if($_GET['page']=='edit-post'){ 
            $post_current = $post_controller->getPost($_GET['id']);

            ?>
          <h1 class="page-header"><?php echo "Edit post"; ?></h1>
          <form class="hms-form-register" action="post_request_handler.php" method="post" enctype="multipart/form-data">
              <span class="hms-required-fields">* fields are required</span>
              <input type="text" readonly hidden name="id" value="<?php echo $post_current->id; ?>">
              <hr>
            <div class="col-md-12">
            </div>  
            <div class="col-md-6">
              
              <div class="form-group">
                <label class="control-label" for="hms-post-title">Title <span class="hms-required-fields">*</span></label>  
                <input id="hms-post-title" name="title" type="text" value="<?php echo $post_current->title; ?>"  class="form-control hms-form-control input-md" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="hms-post-description">Description <span class="hms-required-fields">*</span></label>  
                <textarea id="hms-post-description" name="description" value=""  rows="11" required class="form-control hms-form-control input-md"><?php echo $post_current->description; ?></textarea>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="hms-post-photo">Photo</label>  
                <img src="post_images/<?php echo ($post_current->id >0) ? $post_current->id : "post_default" ?>.png" class="thumbnail hms-thumbnail img-responsive">
                <input id="hms-post-photo" name="post_image" type="file" style="padding-top: 4px; top: -3px;position: relative;" class="form-control hms-form-control input-md">
              </div>
            </div>
            <div class="col-md-12">
              <br>
              <input name="edit" type="submit" style="float: right;" class="btn btn-primary btn-lg hms-btn-primary">
            </div>
          </form>
          <?php } ?>




           <?php if($_GET['page']=='add-post'){ ?>
          <h1 class="page-header"><?php echo "Add new post"; ?></h1>
          <form class="hms-form-register" action="post_request_handler.php" method="post" enctype="multipart/form-data">
              <span class="hms-required-fields">* fields are required</span>
              <input type="text" readonly hidden name="id">
              <hr>
            <div class="col-md-12">
            </div>  
            <div class="col-md-6">
              
              <div class="form-group">
                <label class="control-label" for="hms-post-title">Title <span class="hms-required-fields">*</span></label>  
                <input id="hms-post-title" name="title" type="text" placeholder="Post title . . ." class="form-control hms-form-control input-md" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="hms-post-description">Description <span class="hms-required-fields">*</span></label>  
                <textarea id="hms-post-description" name="description" placeholder="Post description . . ." rows="11" required class="form-control hms-form-control input-md"></textarea>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="hms-post-photo">Photo</label>  
                <img src="images/img.jpg" class="thumbnail hms-thumbnail img-responsive">
                <input id="hms-post-photo" name="post_image" type="file" style="padding-top: 4px; top: -3px;position: relative;" class="form-control hms-form-control input-md">
              </div>
            </div>
            <div class="col-md-12">
              <br>
              <input name="add" type="submit" style="float: right;" class="btn btn-primary btn-lg hms-btn-primary">
            </div>
          </form>
          <?php } ?>




          <?php if($_GET['page']=='users'){ ?>
          <h1 class="page-header">Users</h1>
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>actions</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i <count($users) ; $i++) { ?>
                  
                <tr>
                  <td><?php echo $users[$i]->id; ?></td>
                  <td><?php echo $users[$i]->name; ?></td>
                  <td><?php 
                  $res_pro = $user_controller->getProfessions($users[$i]->id);
                  for ($i=0; $i < count($res_pro); $i++) { 
                    echo $res_pro[$i];
                  }
                  ?></td>
                  <td><img src="profile_images/<?php echo ($users[$i]->id >0)? $users[$i]->id: "default"; ?>.png"></td>
                 
                  <td>
                    <button class="btn btn-md btn-danger hms-btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Delete</button>
                  </td>
                </tr>
                <?php } ?>
               
              </tbody>
            </table>
          </div>
          <?php } ?>





          <?php if($_GET['page']=='posts'){ ?>

          <h1 class="page-header">Posts</h1>
          <a class="btn btn-md btn-primary hms-btn-primary" id="add-post-item" href="?page=add-post">Add new</a>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Photo</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="posts">
             
             
                  <?php for ($i=0; $i < count($post) ; $i++) { ?>
                <tr id="<?php echo $post[$i]->id; ?>">   
                  <td class="post-item-id"><?php echo $post[$i]->id; ?></td>
                  <td class="post-item-title"><?php echo $post[$i]->title; ?></td>
                  <td class="post-item-photo"><img src="post_images/<?php echo ($post[$i]->id >0) ? $post[$i]->id : "post_default" ?>.png"></td>
                  <td class="post-item-description"><?php echo $post[$i]->description; ?></td>
                  <td>
                    <a class="btn btn-sm btn-primary hms-btn-primary" href="?page=edit-post&id=<?php echo $post[$i]->id; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <button class="btn btn-sm btn-danger hms-btn-danger delete-post" data-id="<?php echo $post[$i]->id; ?>"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                  </td>
                </tr>                
                 <?php } ?>
                
                <script type="text/javascript">
                $(function(){

                  $(".delete-post").click(function(){ 
                      var parentId=$(this).data('id');
                      $("#"+parentId+" td").hide();
                      $("#"+parentId).append('<td colspan="5" class="confirmation"><div class="alert alert-danger col-md-12"> Are you sure to delete this item? <button class="btn btn-sm btn-default confirm-yes">Yes</button> <button class="btn btn-sm btn-default confirm-no">No</button></div></td>');
                      

                      $(".confirm-yes").click(function(){
                        $.ajax({
                            method: "POST",
                          url: "post_request_handler.php",
                          dataType: "json",
                          data: {
                            delete: 1,
                            post_id: parentId
                          }
                        }).done(function(res){
                          console.log(res);
                          if(res.update == "SUCCESS"){
                              $("#"+parentId).hide('slow');
                              setTimeout(function(){
                                $("#"+parentId).remove();
                              },1000);
                            }else{
                              alert("Post cannot be deleted right now");
                               $("#"+parentId+" .confirmation").remove();
                               $("#"+parentId+" td").show();
                            }
                        }).fail(function(res){
                            console.log(res);
                        });

                      });
                      $(".confirm-no").click(function(){
                        $("#"+parentId+" .confirmation").remove();
                        $("#"+parentId+" td").show();
                      });
                  });
                });

                </script>
                
              </tbody>
            </table>
          </div>
          <?php } ?>








           <?php if($_GET['page']=='categories'){ ?>

           <h1 class="page-header">Categories</h1> 
           <a class="btn btn-md btn-primary hms-btn-primary" href="?page=add-category">Add new</a>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Icon</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="posts">

                <tr id="123">
                  <td class="post-item-id">123</td>
                  <td class="post-item-title">Hello today!</td>
                  <td class="post-item-photo">dolor,dolordol ordolo rdolor dolor</td>
                  <td class="post-item-description"><span class="fa fa-home hms-card-icon"></span></td>
                  <td>
                    <a class="btn btn-sm btn-primary hms-btn-primary" href="?page=edit-category&id=123"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <button class="btn btn-sm btn-danger hms-btn-danger delete-post" data-id="123"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                  </td>
                </tr>
                
             

                     

              </tbody>
            </table>
          </div>
           <?php } ?> 




           <?php if($_GET['page']=='add-category'){ ?>
          <h1 class="page-header">Add new Category</h1>
          <form class="hms-form-register" action="category_request_handler.php" method="post" enctype="multipart/form-data">
              <span class="hms-required-fields">* fields are required</span>
              <input type="text" readonly hidden name="id">
              <hr>
            <div class="col-md-12">
            </div>  
            <div class="col-md-12">
              
              <div class="form-group">
                <label class="control-label" for="hms-post-title">Name <span class="hms-required-fields">*</span></label>  
                <input id="hms-post-title" name="hms-post-title" type="text" placeholder="Post title . . ." class="form-control hms-form-control input-md" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="hms-post-description">Description <span class="hms-required-fields">*</span></label>  
                <textarea id="hms-post-description" name="hms-post-description" placeholder="Post description . . ." rows="11" required class="form-control hms-form-control input-md"></textarea>
              </div>

              <div class="form-group">
                <label class="control-label" for="hms-post-photo">Icon</label>  
                <select class="form-control hms-form-control" style="font-family: 'FontAwesome', Arial;">
                <?php 
                  echo file_get_contents("fa_icon_list");

                ?>
                  
                </select>
              </div>
            </div>
            
            <div class="col-md-12">
              <br>
              <input name="submit" type="submit" style="float: right;" class="btn btn-primary btn-lg hms-btn-primary">
            </div>
          </form>
           <?php } ?> 


            <?php if($_GET['page']=='edit-category'){ ?>
          <h1 class="page-header">Edit Category</h1>
          <form class="hms-form-register" action="category_request_handler.php" method="post" enctype="multipart/form-data">
              <span class="hms-required-fields">* fields are required</span>
              <input type="text" readonly hidden name="id">
              <hr>
            <div class="col-md-12">
            </div>  
            <div class="col-md-12">
              
              <div class="form-group">
                <label class="control-label" for="hms-post-title">Name <span class="hms-required-fields">*</span></label>  
                <input id="hms-post-title" name="hms-post-title" type="text" placeholder="Post title . . ." class="form-control hms-form-control input-md" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="hms-post-description">Description <span class="hms-required-fields">*</span></label>  
                <textarea id="hms-post-description" name="hms-post-description" placeholder="Post description . . ." rows="11" required class="form-control hms-form-control input-md"></textarea>
              </div>

              <div class="form-group">
                <label class="control-label" for="hms-post-photo">Icon</label>  
                <select class="form-control hms-form-control" style="font-family: 'FontAwesome', Arial;">
                <?php 
                  echo file_get_contents("fa_icon_list");

                ?>
                  
                </select>
              </div>
            </div>
            
            <div class="col-md-12">
              <br>
              <input name="submit" type="submit" style="float: right;" class="btn btn-primary btn-lg hms-btn-primary">
            </div>
          </form>
           <?php } ?> 

        </div>
      </div>
    </div>

    <div class="blog-footer col-md-10" style="float: right;border-top: 1px ridge #ccc;
    background: whitesmoke; padding-top: 10px;">
      <p>
        My helper  All rights reserved. &copy; 2017.
        <a href="http://myhelper.exyro.com">MyHelper</a> by <a href="#">student of IUT</a>.
        <a href="#" style="float: right">Back to top</a>
      </p>
      
    </div>
</body>
</html>