<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php 
if(isset($_GET['id'])){
    $deposit_id = $_GET['id'];  
    $depositQuery = $conn->query("SELECT * FROM mining WHERE id = '$deposit_id' LIMIT 1");
    $depositRow = $depositQuery->fetch();

    
    try {
        $filePath = '../uploads/deposit/'.$identityRow['payment_verify'];
        if(file_exists($filePath)){
            unlink($filePath);
        }
        $status = 2;
        $deposit_stmt = $conn->prepare("UPDATE mining SET status =:s WHERE id = '$deposit_id'");
         $deposit_stmt->bindParam(':s', $status);
        $deposit_stmt->execute();

        set_message('<div class="alert alert-success"><i class="fa fa-info-circle"></i> Mining have continued successfully</div>');
        redirect_to("mining.php");
    } catch(ErrorException $e) {
         $conn->rollBack();
         set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Operation Failed. Try again!</div>');
       redirect_to("mining.php");
    }
       
} else {
    set_message('<div class="alert alert-danger"><i class="fa fa-info-circle"></i> Invalid Request. Try again!</div>');
    redirect_to("mining.php");
}
?>