
<?php
	// Tar emot Username och Password från login.php
	// Om Username och Lösenord stämmer med databasen så sänds användaren vidare till home.php
	// Annars sänds så kommer användaren tillbaks till login.php
	if(!empty($_POST['username']) && !empty($_POST['password'])){
		$sqli = new mysqli('localhost','j','portal','gainz');
		echo "car";
		if($sqli->connect_errno){
			echo "Connection error to server, please contact a admin.";
			die();
		}
		echo "car"; 
		if(!$stmt = $sqli->prepare('SELECT hash from users where userName=(?)')){
			echo "Error creating sql statment";
			die();
		}
		$stmt->bind_param("s",$_POST['username']);
		echo "car";
		$stmt->execute();
		echo "car";
		$res = $stmt->get_result();
		echo "car";
		$hash = $res->fetch_array();
		echo $hash[0];

		if(password_verify($_POST['password'],$hash[0])){
			session_start();
			$_SESSION['User'] = $_POST['username'];
			header('Location: home.php');
			die();
		}
		else{
			header('Location: login.php?error=1');
			die();
		}
	}
?>
