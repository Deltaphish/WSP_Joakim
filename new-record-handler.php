<?php
// Tar rekorden och sänder den till DB
session_start();
if(empty($_SESSION['User'])){
  header('Location: login.php?error=1');
  die();
}

if(!empty($_POST['weight'])){
  $sqli = new mysqli('localhost','j','portal','gainz');

  if($sqli->connect_errno){
    echo "Connection error to server, please contact a admin.";
    die();
  }

  if(!$stmt = $sqli->prepare("SELECT recordID FROM records WHERE user=(?)")){
    echo "Error creating sql statment";
    die();
  }

  $stmt->bind_param("s",$_SESSION['User']);
  $stmt->execute();
  $res = $stmt->get_result()->fetch_array();
  if(empty($res)){

      if(!$stmt = $sqli->prepare("INSERT INTO records VALUES(recordID,?,?)")){
        echo "Error creating sql statment1";
        die();
      }
      else{
          $stmt->bind_param("si",$_SESSION['User'],$_POST['weight']);
      }
  }
  else{
    if(!$stmt = $sqli->prepare("UPDATE records SET record=(?) WHERE user=(?)")){
      echo "Error creating sql statment2";
      die();
    }
    else{
        $stmt->bind_param("is",$_POST['weight'],$_SESSION['User']);
    }
  }

  $stmt->execute();
  // Sänder data för grafen i home.php till DB
  $logstmt = $sqli->prepare("INSERT INTO log (id,user,weight) VALUES(id,?,?)");
  $logstmt->bind_param("si",$_SESSION['User'],$_POST['weight']);
  $logstmt->execute();
  header('Location: home.php');
  die();

}

?>
