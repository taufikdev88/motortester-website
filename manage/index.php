<?php
session_start();

if(!isset($_SESSION['username'])){
  header('location: ../');
}

require("backend/db.php");
$db = new DB;

$devices = $db->listDevices($_SESSION['username']);
$records = $db->listRecords($_SESSION['username']);

include_once("template/header.php");
?>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Dashboard</h1>
  </div>
</div>

<div class="row">
  <div class="col-lg-4 col-md-6">
    <div class="panel panel-red">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-cube fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge"><?php echo count($devices); ?></div>
            <div>Devices</div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <span class="pull-right">Total</span>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="panel panel-yellow">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-slack fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge"><?php echo count($records); ?></div>
            <div>Records  </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <span class="pull-right">Total</span>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="panel panel-green">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-calendar-o fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge" id="time">10:00</div>
            <div id="date">12 Januari 2020</div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <span class="pull-right">Date</span>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-5 col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">Last Record Data</div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Property</th>
                <th>Value</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Device SN</td>
                <td>: <?php if(count($records) != 0) echo $records[0]['device_sn']; ?></td>
              </tr>
              <tr>
                <td>Device name</td>
                <td>: <?php if(count($records) != 0) echo $records[0]['name']; ?></td>
              </tr>
              <tr>
                <td>RMS</td>
                <td>: <?php if(count($records) != 0) echo $records[0]['rms']; ?></td>
              </tr>
              <tr>
                <td>Kurtosis</td>
                <td>: <?php if(count($records) != 0) echo $records[0]['kurtosis']; ?></td>
              </tr>
              <tr>
                <td>Skewness</td>
                <td>: <?php if(count($records) != 0) echo $records[0]['skewness']; ?></td>
              </tr>
              <tr>
                <td>Result</td>
                <td>: <?php if(count($records) != 0) echo $records[0]['result']; ?></td>
              </tr>
              <tr>
                <td>Record Date</td>
                <td>: <?php if(count($records) != 0) echo $records[0]['created_at']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-7 col-md 7">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <i class="fa fa-bell fa-fw"></i> Notifications 
      </div>
      <div class="panel-body">
        <div class="list-group">
          <div class="list-group-item">No notification</div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once("template/footer.php"); ?>

<!-- jQuery Date Format -->
<script src="js/jqueryDateformat.min.js"></script>
<!-- <script src="js/raphael.min.js"></script>
<script src="js/morris.min.js"></script> -->

<script>
  dateRefresh = function(){
    var date = new Date();
    
    $("#time").text($.format.date(date, 'HH:mm:ss'));
    $("#date").text($.format.date(date, 'dd/MM/yyyy'));

    setTimeout(dateRefresh, 1000);
  };

  $(document).ready(function(){
    dateRefresh();

    // Morris.Bar({
    //   element: 'morris-bar-chart',
    //   data: [{
    //     y: 'RMS',
    //     a: <?php if(count($records) != 0) echo $records[0]['rms']; ?>
    //   }, {
    //     y: 'Kurtosis',
    //     a: <?php if(count($records) != 0) echo $records[0]['kurtosis']; ?>
    //   }, {
    //     y: 'Skewness',
    //     a: <?php if(count($records) != 0) echo $records[0]['skewness']; ?>
    //   }],
    //   xkey: 'y',
    //   ykeys: 'a',
    //   labels: 'Data',
    //   hideHover: 'auto',
    //   resize: true
    // });
  });
</script>