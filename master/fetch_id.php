 <?php  
 	require_once("includes/connection.php");

	 if(isset($_POST["id"]))  
	 {  	
	 	  $idd = $_POST["id"];
	      $query = $conn->query("SELECT filename FROM account WHERE id = '$idd' LIMIT 1");  
	      $row = $query->fetch(); 
	      $filename = '../uploads/'.$row['filename'];
	      $result = [];
	      $result['id_doc'] = '<img src='.$filename.' class="img-fluid">';
	      echo json_encode($result);  
	 }  
 ?>