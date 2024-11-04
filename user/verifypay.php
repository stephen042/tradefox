<?php
 require_once("includes/initialize.php");
try {
            $stmt = $conn->query("SELECT * FROM `deposit` WHERE `status`='PENDING' AND `code` != ''"); 
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $stmt->fetch()) {
                   $code = $row['code'];
                   $id = $row['id'];
                    $amount = $row['amount'];
                    $username = $row['user_id'];
                    $curl = curl_init();
                    
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.commerce.coinbase.com/charges/'.$code,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'GET',
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'X-CC-Api-Key: '.COINBASE_C_API_KEY
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
                     $response = json_decode($response,true);
                      $response = $response['data'];
                     
                     
                     $timeline = $response['timeline'];
                     $latest_timeline = end($timeline);
                     
                     if( $latest_timeline['status'] == "CANCELED") {
                            
                           $stmt = $conn->prepare("UPDATE `deposit` SET `status` = 'CANCELED'  WHERE `id` = '$id'");
                            $stmt->execute(); 
                     }
                     
                     if( $latest_timeline['status'] == "EXPIRED") {//Expired
                            
                           $stmt = $conn->prepare("UPDATE `deposit` SET `status` = 'EXPIRED'  WHERE `id` = '$id'");
                            $stmt->execute(); 
                     }
                      if( $latest_timeline['status'] == "COMPLETED") {//Completed
                            
                           $stmt = $conn->prepare("UPDATE `deposit` SET `status` = 'COMPLETED'  WHERE `id` = '$id'");
                            $stmt->execute(); 
                            
                             $stmt2 = $conn->prepare("UPDATE `account` SET `account_balance` = `account_balance` + '$amount'  WHERE `user_id` = '$username'");
                               $stmt2->execute(); 
                            
                     }
                    
    
        
                }
                }catch(PDOException $e) {
                    //  echo $e;
                }finally{
                     
                }
        
         
