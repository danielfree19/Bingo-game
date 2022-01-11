<?php

include_once "../includes/classes.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

if(isset($_SESSION["cards"])){
    echo true;
}
else{
    echo false;
}