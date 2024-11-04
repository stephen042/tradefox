<?php
require_once("includes/initialize.php");
$curl = curl_init();
$username = $_POST['user_id'];
$amount = $_POST['amount'];
$name = $_POST['name'];
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.commerce.coinbase.com/charges',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"description":"Put your investing ideas into action with full range of investments. Enjoy real benefits and rewards on your accrue investing.","name":"Account Top Up","amount":'.$amount.',"pricing_type":"no_price","metadata":{"customer_id":"'.$username.'","customer_name":"'.$name.'"},"redirect_url":"https://app.global-emmytyips.com/user/deposit.php","cancel_url":"https://app.global-emmytyips.com/user/deposit.php"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Accept: application/json',
    'X-CC-Version: 2018-03-22',
    'X-CC-Api-Key: '.COINBASE_C_API_KEY
  ),
));

$response = curl_exec($curl);

curl_close($curl); 
 $response;

$response = json_decode($response,true);
$response  = $response['data'];
$customer_id = $response['metadata']['customer_id'];
$customer_name = $response['metadata']['customer_name'];
$hosted_url = $response['hosted_url']; 
$code = $response['code'];
$id = $response['id'];
$type = "Coinbase";
 $date = date("D, M j Y h:i:s A");
  

 $stmt =  $conn->prepare("INSERT INTO `deposit` ( `user_id`, `transaction_id`, `date`, `type`, `amount`, `status`, `code`)
                    VALUES (?,?,?,?,?,?,?)");

        if($stmt->execute([$customer_id,$id,$date,$type,$amount,"PENDING",$code])){
            echo json_encode($response);
        }