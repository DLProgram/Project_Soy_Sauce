<?php
//open mysql connection
    $conn = mysqli_connect("localhost", "scouter", "password","scouting_system");
    if (mysqli_connect_errno()){
    die("Database Connection Failed!!!" . mysqli_connect_error() . " ( " . mysqli_connect_errno() ." )");
    }

?>