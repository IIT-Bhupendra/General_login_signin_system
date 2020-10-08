<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "loginsystem";
    
    $connect = mysqli_connect($servername, $username, $password, $database);
    if(!$connect)
        die(mysqli_connect_error());
?>