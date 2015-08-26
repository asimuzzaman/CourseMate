<?php
  require_once("database.php");
  session_start();
  function whoami() { //name is similar to unix command
    if(!isset($_SESSION['user'])) return NULL;
    else return $_SESSION['user'];
  }

  function ToDate($time) {
    return date('d/m/Y H:i;s', $time);
  }
  $USERNAME= whoami();
  //$USERNAME = "admin"; //hard login, temporary user, to be removed
  ConnectDb();
  function GetId($username){
    $query= "SELECT id FROM users WHERE username = '$username'";
    $result= query($query);
    $row= mysqli_fetch_array($result);
    return $row[0];
  }
  $USERID= GetId($USERNAME);
?>
