<?php
session_start();
$_SESSION['User'] = NULL;
header('Location: index.php');
 ?>
