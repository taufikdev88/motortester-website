<?php
session_start();

if(!isset($_SESSION['username'])){
  header('location: ../');
}

require("backend/db.php");
$db = new DB;

if(isset($_GET['remove'])){
  $data = array(
    'username' => $_SESSION['username'],
    'id' => $_GET['remove']
  );

  if(!$db->delRecord($data)){
    $errors[0] = "Cannot delete records right now!";
  } else {
    $success = "Delete successfull!";
  }
}

$records = $db->listRecords($_SESSION['username']);

include_once("template/header.php");
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Record details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table">
                <thead><tr><th>Property</th><th>Value</th></tr></thead>
                <tbody>
                  <tr><td>RMS</td><td><span id="rms"></span></td></tr>
                  <tr><td>Kurtosis</td><td><span id="kurtosis"></span></td></tr>
                  <tr><td>Skewness</td><td><span id="skewness"></span></td></tr>
                </tbody>
              </table>
            </div>  
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">List Records</h1>
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
        Records
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTable">
            <thead>
              <tr>
                <th>Record Date</th>
                <th>Serial Number</th>
                <th>Device Name</th>
                <th>Result</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($records as $record){ ?>
                <tr>
                  <td><?php echo $record['created_at']; ?></td>
                  <td><?php echo $record['device_sn']; ?></td>
                  <td><?php echo $record['name']; ?></td>
                  <td><?php echo $record['result']; ?></td>
                  <td>
                    <a href="#" onclick="showDetails(<?php echo $record['rms']; ?>, <?php echo $record['kurtosis']; ?>, <?php echo $record['skewness']; ?>)" class="btn btn-success">
                      <i class="fa fa-info-circle"></i> Details 
                    </a>
                    <a href="#" onclick="remove(<?php echo $record['id']; ?>)" class="btn btn-danger">
                      <i class="fa fa-warning"></i> Remove
                    </a>
                  </td>
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

  function showDetails(rms, kurtosis, skewness){
    $('#rms').text(rms);
    $('#kurtosis').text(kurtosis);
    $('#skewness').text(skewness);
    $('#myModal').modal('show');
  };

  function remove(id){
    var r = confirm("Are you sure to delete record ?");
    if(r == true){
      location.href = 'records.php?remove=' + id;
    }
  };
</script>