<?php
require('../user/includes/connection.php');
 
$trading_stmt = $conn->query("SELECT * FROM mining WHERE status = '2' AND count != 0");
    while($row = $trading_stmt->fetch()) {
        $user_id = $row['user_id']; 
        $asset = $row['asset'];
         $inc =  ($row['deposit'] * ($row['percentage'] / 100 )) / $row['duration'];
          $id = $row['id'];
        $count = $row['count'] - 1;
        
        if($asset == "BTC") {
        
        $stmt = $conn->prepare("UPDATE account SET btc = btc+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }elseif($asset == "ETH") {
        
        $stmt = $conn->prepare("UPDATE account SET eth = eth+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }elseif($asset == "XRP") {
        
        $stmt = $conn->prepare("UPDATE account SET xrp = xrp+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }
        elseif($asset == "LTC") {
        
        $stmt = $conn->prepare("UPDATE account SET ltc = ltc+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }elseif($asset == "BTS") {
        
        $stmt = $conn->prepare("UPDATE account SET bts = bts+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }
        elseif($asset == "DASH") {
        
        $stmt = $conn->prepare("UPDATE account SET dash = dash+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }
        elseif($asset == "XMR") {
        
        $stmt = $conn->prepare("UPDATE account SET xmr = xmr+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }
        elseif($asset == "RISE") {
        
        $stmt = $conn->prepare("UPDATE account SET rise = rise+ '$inc' WHERE user_id = '$user_id'");
          
          $stmt->execute();
        }
        
        //  ` `, ` `, ``, ` `, ``, ``,
        
        $stmt2 = $conn->prepare("UPDATE mining SET count = '$count', amount=amount + '$inc'  WHERE id = '$id'"); 
         $stmt2->execute();
        
          
        
        
    }

    