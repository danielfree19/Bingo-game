<?php

include_once "../includes/classes.php";
include_once "../includes/database.php";
include_once "../includes/functions.php";
ini_set('session.gc_maxlifetime',7200);

session_start();

if(isset($_SESSION["wins"]) && sizeof($_SESSION["wins"])>0){
    echo json_encode(1);
}
else{
    echo json_encode(0);
}