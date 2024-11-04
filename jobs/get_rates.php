<?php
require('../user/includes/connection.php');


$get_rates = $conn->query("SELECT `rates` FROM rates WHERE id = '1'");
    $rates = $get_rates->fetch();

    echo  $rates['rates'];