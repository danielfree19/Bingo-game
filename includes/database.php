<?php

$serverName = "127.0.0.1";
$dbUsername = "root";
$dbPass = "";
$dbName = "bingo";

$conn = mysqli_connect($serverName,$dbUsername,$dbPass,$dbName);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
