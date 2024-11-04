<?php
require('../user/includes/connection.php');

$url='https://min-api.cryptocompare.com/data/price?fsym=GBP&tsyms=BTC,ETH,LTC,XRP,XMR,RISE,BTS,DASH&api_key='.MIN_API_KEY;

$rates= ( file_get_contents( $url ) );
   
// //update database rates every 10mins
$id = 1;
$query = "UPDATE rates SET rates =:rates WHERE id =:id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':rates', $rates); 
        $stmt->bindParam(':id', $id);

         $stmt->execute();

?>