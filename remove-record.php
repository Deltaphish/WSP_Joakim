<?php
session_start();
if(empty($_SESSION['User'])){
  header('Location: login.php?error=1');
  die();
}

  $sqli = new mysqli('localhost','j','portal','gainz');

  if($sqli->connect_errno){
    echo "Connection error to server, please contact a admin.";
    die();
  }
     if(!$stmt = $sqli->prepare("DELETE FROM records WHERE user=?")){
     echo "Error creating sql statment1";
     die();
   }

  $stmt->bind_param("s",$_SESSION['User']);
  $stmt->execute();
  header('Location: view-records.php');
  die();


?>