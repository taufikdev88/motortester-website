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

  function checkEmailAndUsername($data){
    $username = $data['username'];
    $email = $data['email'];
  
    $query = sprintf("select * from userdata where username = '%s' or email = '%s'",
      $this->mysqli->real_escape_string($username), 
      $this->mysqli->real_escape_string($email)
    );
    
    $result = $this->mysqli->query($query);
    if($result->num_rows > 0){
      return false;
    }

    return true;
  }

  function saveUserdata($data){
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];

    $query = sprintf("insert into userlogin(`username`,`password`) values ('%s','%s')",
      $this->mysqli->real_escape_string($username),
      sha1($this->mysqli->real_escape_string($password))
    );
    $result = $this->mysqli->query($query);

    if(!$result){
      return false;
    }

    $query = sprintf("insert into userdata(`username`,`email`) values ('%s','%s')",
      $this->mysqli->real_escape_string($username),
      $this->mysqli->real_escape_string($email)
    );
    $result = $this->mysqli->query($query);

    if(!$result){
      $query = sprintf("delete from userlogin where username = '%s'",
        $this->mysqli->real_escape_string($username)
      );
      $this->mysqli->query($query);
      
      return false;
    } 

    return true;
  }

  function checkLogin($data){
    $username = $data['username'];
    $password = $data['password'];

    $query = sprintf("select * from userlogin where username = '%s' and password = '%s'",
      $this->mysqli->real_escape_string($username),
      sha1($this->mysqli->real_escape_string($password))
    );
    $result = $this->mysqli->query($query);

    if($result->num_rows == 0){
      return false;
    }

    return true;
  }

  function saveRecord($data){
    $query = sprintf("insert into devicerecords (`device_sn`,`rms`,`kurtosis`,`skewness`,`result`) values ('%s','%s','%s','%s','%s')",
      $this->mysqli->real_escape_string($data['device_sn']),
      $this->mysqli->real_escape_string($data['rms']),
      $this->mysqli->real_escape_string($data['kurtosis']),
      $this->mysqli->real_escape_string($data['skewness']),
      $this->mysqli->real_escape_string($data['result'])
    );
    $result = $this->mysqli->query($query);
    
    if(!$result){
      return false;
    }

    return true;
  }
}