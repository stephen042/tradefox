<?php
require('../user/includes/connection.php');
$result = [];
$user_id = $_REQUEST['user'];
$get_user = $conn->query("SELECT * FROM account WHERE user_id = '$user_id' LIMIT 1");
    $balance = $get_user->fetch();

    $result['BTC'] = $balance['btc'];
    $result['ETH'] = $balance['eth'];
    $result['LTC'] = $balance['ltc'];
    $result['XRP'] = $balance['xrp'];
    $result['XMR'] = $balance['xmr'];
    $result['RISE'] = $balance['rise'];
    $result['BTS'] = $balance['bts'];
    $result['DASH'] = $balance['dash'];
    $result['ETH_BALANCE'] = $balance['eth_balance'];
    $result['BTC_BALANCE'] = $balance['btc_balance'];
    $result['ACCOUNT_BALANCE'] = $balance['account_balance'];
     echo json_encode($result);
    return json_encode($result);