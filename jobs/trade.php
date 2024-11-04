<?php
require('../user/includes/connection.php');

//`id`, `user_id`, `asset`, `amount`, `count`, `status`, `inc`
$trading_stmt = $conn->query("SELECT * FROM trading WHERE status = '1' AND count != 0");
    while($row = $trading_stmt->fetch()) {
        $user_id = $row['user_id']; 
         $inc = $row['inc'];
          $id = $row['id'];
        $count = $row['count'] - 1;
        
        if($row['asset'] == "BTC") {
            $stmt = $conn->prepare("UPDATE account SET account_balance = account_balance+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }else{
            $stmt = $conn->prepare("UPDATE account SET eth_balance = eth_balance+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }
        
        
        $stmt2 = $conn->prepare("UPDATE trading SET count = '$count'  WHERE id = '$id'"); 
         $stmt2->execute();
        
          
        
        
    }

    