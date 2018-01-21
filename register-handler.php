<?php
// Tar emot Username och Password från register.php
// Om Username och Password inte finns i DB så skrivs de in.
if(empty($_POST['username']) || empty($_POST['passwd'])){
  echo("Registration failed");
  die();
}

$sqli = new mysqli('localhost','j','portal','gainz');

if($sqli->connect_errno){
  echo "Connection error to server, please contact a admin.";
  die();
}
if(!$stmt = $sqli->prepare("SELECT * FROM users WHERE userName=(?)")){
  echo "Error creating sql statment";
  die();
}
$stmt->bind_param("s",$_POST['username']);
$stmt->execute();
$res = $stmt->get_result()->fetch_all();
if(!empty($res)){
  header('Location: register.php?err=1');
  die();
}
$stmt = $sqli->prepare("INSERT INTO users VALUES(userID,?,?)");
$stmt->bind_param("ss",$_POST['username'],password_hash($_POST['passwd'],CRYPT_BLOWFISH));
$stmt->execute();
session_start();
$_SESSION['User'] = $_POST['username'];
header('Location: home.php');
?>
