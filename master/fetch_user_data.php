<?php  
 	require_once("includes/connection.php");

	 if(isset($_POST["id"]))  
	 {  	
	 	  $u_id = $_POST["id"];
	      $query = $conn->query("SELECT * FROM users WHERE id = '$u_id' LIMIT 1");  
	      $row = $query->fetch();  
	      echo json_encode($row);  
	 }  
?>