<?php
require('../assets/vendor/autoload.php');
require('../backend/db.php');

use Rakit\Validation\Validator;

if(isset($_GET['sn'])){
  $validator = new Validator;
  $db = new DB;

  $validation = $validator->make($_GET,[
    'sn' => 'required',
    'p1' => 'required|numeric',
    'p2' => 'required|numeric',
    'p3' => 'required|numeric',
    'p4' => 'required|in:0,1'
  ]);

  $validation->validate();

  if($validation->fails()){
    foreach($validation->errors()->firstOfAll() as $error){
      echo $error."<br/>";
    }
  } else {
    $data = array(
      'device_sn' => $_GET['sn'],
      'rms' => $_GET['p1'],
      'kurtosis' => $_GET['p2'],
      'skewness' => $_GET['p3'],
      'result' => ($_GET['p4'] == 1 ? 'OK' : 'BROKEN')
    );
    
    if($db->saveRecord($data)){
      echo "OK";
    } else {
      echo "FAIL";
    }
  }
} else {
  echo "OK";
}
?>