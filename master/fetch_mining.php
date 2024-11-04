 <?php  
 	require_once("includes/connection.php");

	 if(isset($_POST["id"]))  
	 {  	
	 	  $did = $_POST["id"];
	      $query = $conn->query("SELECT payment_verify FROM mining WHERE id = '$did' LIMIT 1");  
	      $row = $query->fetch(); 
	      $filename = '../uploads/deposit/'.$row['payment_verify'];
	      $result = [];
	      $result['id_doc'] = '<img src='.$filename.' class="img-fluid">';
	      echo json_encode($result);  
	 }  
 ?>