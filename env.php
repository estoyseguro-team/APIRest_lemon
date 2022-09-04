<?php


    $hostname="localhost";
    $username="root";
    $password="";
    $dbname="apirest";
    $usertable="user";
    $yourfield = "your_field";

    $mysqli = new mysqli($hostname, $username, $password, $dbname);

    if (mysqli_connect_error()) {
        die('Error de Conexión (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
    
    
    

    ?>