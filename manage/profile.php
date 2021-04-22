<?php
session_start();

if(!isset($_SESSION['username'])){
  header('location: ../');
}

require('../assets/vendor/autoload.php');
use Rakit\Validation\Validator;

$validator = new Validator;

require("backend/db.php");
$db = new DB;

if(isset($_POST['update'])){
  $validation = $validator->make($_POST,[
    'firstname'   => 'required',
    'lastname'    => 'required',
    'location'    => 'required',
    'role'        => 'required'
  ]);
  $validation->validate();

  if($validation->fails()){
    $errors = $validation->errors()->firstOfAll();
  } else {
    $data = array(
      'username' => $_SESSION['username'],
      'firstname' => $_POST['firstname'],
      'lastname' => $_POST['lastname'],
      'location' => $_POST['location'],
      'role' => $_POST['role']
    );

    if(!$db->updateUserInfo($data)){
      $errors[0] = "Cannot update user info";
    } else {
      $success = "Success update user info";
    }
  }
}

$user = $db->fetchUserdata($_SESSION['username']);
$locations = $db->fetchLocation();
$roles = $db->fetchRole();

include_once("template/header.php");
?>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">User Profile</h1>
  </div>
</div>

<?php
  if(!empty($errors)){
    foreach($errors as $error){
      echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$error."</div>";
    }
  }

  if(!empty($success)){
    echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$success."</div>";
  }
?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel tabbed-panel panel-primary">
      <div class="panel-heading clearfix">
        <div class="panel-title pull-left">Hello <?php echo $_SESSION['username']; ?></div>
        <div class="pull-right">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-primary-1" data-toggle="tab">User Info</a></li>
            <li><a href="#tab-primary-2" data-toggle="tab"> Edit Info</a></li>
          </ul>
        </div>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tab-primary-1">
            <div class="list-group col-lg-6">
              <div class="list-group-item">
                Username <span class="pull-right text-muted"><?php echo $user['username']; ?></span>
              </div>
              <div class="list-group-item">
                Firstname <span class="pull-right text-muted"><?php echo $user['firstname']; ?></span>
              </div>
              <div class="list-group-item">
                Lastname <span class="pull-right text-muted"><?php echo $user['lastname']; ?></span>
              </div>
              <div class="list-group-item">
                Email <span class="pull-right text-muted"><?php echo $user['email']; ?></span>
              </div>
            </div>
            <div class="list-group col-lg-6">
              <div class="list-group-item">
                Location <span class="pull-right text-muted"><?php echo $user['location']; ?></span>
              </div>
              <div class="list-group-item">
                Role <span class="pull-right text-muted"><?php echo $user['role']; ?></span>
              </div>
            </div>
            <div class="col-lg-12">
              <span class="pull-right">Joined at <?php echo $user['created_at']; ?></span>
            </div>
          </div>
          <div class="tab-pane fade" id="tab-primary-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                Edit Your Data
              </div>
              <div class="panel-body">
                <div class="row">
                  <form action="" role="form" method="post">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" value="<?php echo $user['username']; ?>" disabled>
                      </div>
                      <div class="form-group">
                        <label for="Username">Firstname</label>
                        <input name="firstname" type="text" class="form-control" value="<?php echo $user['firstname']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="Username">Lastname</label>
                        <input name="lastname" type="text" class="form-control" value="<?php echo $user['lastname']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="Username">Email</label>
                        <input type="text" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="location">Location</label>
                        <select name="location" id="location" class="form-control">
                          <?php foreach($locations as $location){ ?>
                            <option value="<?php echo $location['id']; ?>" <?php if($location['id'] == $user['location_id']) echo "selected"; ?>><?php echo $location['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                          <?php foreach($roles as $role){ ?>
                            <option value="<?php echo $role['id']; ?>"  <?php if($role['id'] == $user['role_id']) echo "selected"; ?>><?php echo $role['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <button name="update" type="submit" class="btn btn-success">Save</button>
                    </div>
                    <div class="col-lg-12">
                      <span class="pull-right">Last update at <?php echo $user['updated_at']; ?></span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once("template/footer.php"); ?>