<?php

require_once("config.php");

try {
    $conn = new PDO('mysql:host='.DB_SERVER.';port=3308;dbname='.DB_NAME, DB_USER, DB_PASS); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

if(!$conn){
	echo "Problem in database connection! Contact administrator!";
	exit();
}

?>
