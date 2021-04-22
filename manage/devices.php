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

if(isset($_POST['register'])){
  $validation = $validator->make($_POST,[
    'sn' => 'required'
  ]);

  $validation->validate();

  if($validation->fails()){
    $errors = $validation->errors()->firstOfAll();
  } else {
    $data = array(
      'username' => $_SESSION['username'],
      'device_sn' => $_POST['sn']
    );

    if(!$db->addDevices($data)){
      $errors[0] = "Serial number cannot be verified!";
    } else {
      $success = "Success adding device";
    }
  }
}

$devices = $db->listDevices($_SESSION['username']);

include_once("template/header.php");
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="post" role="form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Register your devices</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="sn">Input your device's serial number</label>
            <input type="text" name="sn" id="sn" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="register">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">List Devices</h1>
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
    <div class="panel panel-primary">
      <div class="panel-heading">
        Devices
        <div class="pull-right">
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li><a href="#" data-toggle="modal" data-target="#myModal">Register new devices</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTable">
            <thead>
              <tr>
                <th>Serial Number</th>
                <th>Device Name</th>
                <th>Release Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($devices as $devices){ ?>
                <tr>
                  <td><?php echo $devices['device_sn']; ?></td>
                  <td><?php echo $devices['name']; ?></td>
                  <td><?php echo $devices['release_date']; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once("template/footer.php"); ?>

<!-- DataTables JavaScript -->
<script src="js/dataTables/jquery.dataTables.min.js"></script>
<script src="js/dataTables/dataTables.bootstrap.min.js"></script>

<script>
  $(document).ready(function(){
    $('#dataTable').DataTable({
      resposive: true
    });
  });
</script>