<?php
  function ConnectDb() {
    global $connect;
    //$username= "root";
    //$password= "1234";
    $username= "adminCVRi2KV";
    $password= "9uKVQmHjJ4l7";

    $connect = mysqli_connect("localhost","$username","$password","coursemate");

    if(mysqli_connect_errno()) {
      echo "Unable to connect to database: " . mysqli_connect_error() ."<br/>";
    }
  }

  function query($query) {
    global $connect;
    $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
    return $result;
  }

  function GetDbId() {
    global $connect;
    return mysqli_insert_id($connect);
  }

  function escape($str) {
    global $connect;
    return mysqli_real_escape_string($connect,$str);
  }

  function CloseDb() {
    global $connect;
    mysqli_close($connect);
  }
?>
