<?php

    $con = mysqli_connect("thh2lzgakldp794r.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "c52rgdym3wse9u6y", "m3yyz6fsg0fdvzuh", "i54zqn1gz5e95xrv");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        echo "Connected successfully!";
    }

?>
