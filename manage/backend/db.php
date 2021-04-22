<?php

class DB {
  private $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $db = "motortester";

  private $mysqli;

  function __construct(){
    $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db); 
  }

  function __destruct(){
    $this->mysqli->close();
  }

  function fetchUserdata($username){
    $query = sprintf("select userdata.*,location.name as location ,role.name as role from userdata inner join location on userdata.location_id = location.id inner join role on userdata.role_id = role.id where userdata.username = '%s'",
      $this->mysqli->real_escape_string($username)
    );
    $result = $this->mysqli->query($query)->fetch_assoc();

    return $result;
  }

  function fetchLocation(){
    $query = "select * from location where id != 195 order by id asc";
    $result = $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);

    return $result;
  }

  function fetchRole(){
    $query = "select * from role where id != 4 order by id asc";
    $result = $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);

    return $result;
  }

  function updateUserInfo($data){
    $username = $data['username'];
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $location = $data['location'];
    $role = $data['role'];

    $query = sprintf("update userdata set firstname = '%s', lastname = '%s', location_id = '%s', role_id = '%s' where username = '%s'",
      $this->mysqli->real_escape_string($firstname),
      $this->mysqli->real_escape_string($lastname),
      $this->mysqli->real_escape_string($location),
      $this->mysqli->real_escape_string($role),
      $this->mysqli->real_escape_string($username)
    );
    $result = $this->mysqli->query($query);

    if(!$result){
      return false;
    }

    return true;
  }

  function listDevices($username){
    $query = sprintf("select userdevices.*, devices.name, devices.release_date from userdevices join devices on userdevices.device_sn = devices.sn where username = '%s' order by created_at desc",
      $this->mysqli->real_escape_string($username)
    );
    $result = $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);

    return $result;
  }

  function listRecords($username){
    $query = sprintf("SELECT devicerecords.*, userdevices.username, devices.name FROM devicerecords JOIN userdevices ON devicerecords.device_sn = userdevices.device_sn join devices ON devicerecords.device_sn = devices.sn WHERE username = '%s' order by created_at desc",
      $this->mysqli->real_escape_string($username)
    );
    $result = $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);

    return $result;
  }

  function addDevices($data){
    $username = $data['username'];
    $device_sn = $data['device_sn'];

    $query = sprintf("insert into userdevices (`username`,`device_sn`) values ('$username','$device_sn')",
      $this->mysqli->real_escape_string($username),
      $this->mysqli->real_escape_string($device_sn)
    );
    $result = $this->mysqli->query($query);

    if(!$result){
      return false;
    }

    return true;
  }

  function delRecord($data){
    $query = sprintf("SELECT devicerecords.*, userdevices.username FROM devicerecords JOIN userdevices ON devicerecords.device_sn = userdevices.device_sn WHERE devicerecords.id = '%s' and username = '%s'",
      $this->mysqli->real_escape_string($data['id']),
      $this->mysqli->real_escape_string($data['username'])
    );

    if($this->mysqli->query($query)->num_rows == 0){
      return false;
    }

    $query = sprintf("delete from devicerecords where id = '%s'",
      $this->mysqli->real_escape_string($data['id'])
    );
    $result = $this->mysqli->query($query);

    if(!$result){
      return false;
    }
    
    return true;
  }
}