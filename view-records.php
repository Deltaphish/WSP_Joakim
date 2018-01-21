<head>
  <link rel="stylesheet" type="text/css" href="./CSS/main.css">
  <link rel="stylesheet" type="text/css" href="./CSS/home.css">
  <link rel="stylesheet" type="text/css" href="./CSS/view-record.css">
</head>

<nav>
  <h1>GainzQuest</h1>
  <a href="logout.php" id="link1">Logout</a>
  <a href="new-record.php" id="link2">New record</a>
  <a href="view-records.php" id="link3">View Records</a>
</nav>

<div id="centering-div"/>

<?php
// Hämtar alla rekorder från användare och
// Visar dem i en tabel
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
if(!$stmt = $sqli->prepare("SELECT * FROM records")){
  echo "Error creating sql statment";
  die();
}
$stmt->execute();
$res = $stmt->get_result()->fetch_all();

$weight = array();

foreach($res as $key => $row){
  $weight[$key] = $row[2];
}
array_multisort($weight,SORT_DESC,$res);
echo('<table><tr><th>User</th><th>Record</th><th></th></tr>');
foreach($res as $key => $row){
  if($row[1] == $_SESSION['User']){
	echo('<tr> <td>'.$row[1].'</td><td>'.$row[2].' </td><td><a href="remove-record.php">Remove record</a></td></tr>');  
  }
  else{
	echo('<tr> <td>'.$row[1].'</td><td>'.$row[2].'</td><td></td></tr>');
  }
}
echo ('</table>');
  ?>
</div>
