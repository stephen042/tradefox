 <?php  
 	require_once("includes/connection.php");

	 if(isset($_POST["id"]))  
	 {  	
	 	  $t_id = $_POST["id"];
	      $query = $conn->query("SELECT * FROM trade_history WHERE id = '$t_id' LIMIT 1");  
	      $row = $query->fetch();  
	      echo json_encode($row);  
	 }  
 ?>