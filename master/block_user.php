<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php
if($_GET['uid']){
    $user_id = $_GET['uid'];
    $check_status = $conn->query("SELECT status FROM users WHERE id = '$user_id' LIMIT 1");
    $check_status->execute();
    $row = $check_status->fetch();

    if($row['status'] == 10){
        $stat = 0;
        $query = $conn->prepare("UPDATE users SET status=:s WHERE id=:u");
        $query->bindParam(':s', $stat);
        $query->bindParam(':u', $user_id);
        $query->execute();
        set_message('<div class="alert alert-success"><i class="fa fa-check"></i> <b>User was blocked successfully</b></div>');
        redirect_to("users.php");
        
    } elseif($row['status'] == 0){
        $stat = 10;
        $query = $conn->prepare("UPDATE users SET status=:s WHERE id=:u");
        $query->bindParam(':s', $stat);
        $query->bindParam(':u', $user_id);
        $query->execute();
        set_message('<div class="alert alert-success"><i class="fa fa-check"></i> <b>User was unblocked successfully</b></div>');
        redirect_to("users.php");
    }

} else {
    set_message('<div class="alert alert-danger"><i class="fa fa-warning"></i> <b>An error occurred. Try again!</b></div>');
    redirect_to("users.php");
}
?>