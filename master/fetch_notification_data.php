 <?php  
 	require_once("includes/connection.php");

	 if(isset($_POST["id"]))  
	 {  	
	 	  $tn_id = $_POST["id"];
	      $query = $conn->query("SELECT * FROM notification WHERE id = '$tn_id' LIMIT 1");  
	      $row = $query->fetch();  
	      echo json_encode($row);  
	 }  
 ?>