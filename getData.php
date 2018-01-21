
<?php
	// Hämtar info för grafen från databasen och sänder den till
	// home.php via json
	if(empty($_GET)){
		die();
	}
	header('Content-type: application/json');

	$mysqli = new mysqli("localhost", "j","portal","gainz");
	if($mysqli->connect_errno){
		echo "Failed to connect to database";
	}
	
	$res = $mysqli->query("SELECT weight, date FROM log WHERE user=\"".$_GET['user']."\" ORDER BY date;");
	$data = $res->fetch_all();
	echo json_encode($data);

?>
