<?php

include_once "../includes/classes.php";
include_once "../includes/functions.php";
include_once "../includes/database.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

$amount = $_GET["amount"];

create_bingo_cards($amount);
upload_bingo_cards($conn,$_SESSION["cards"]);
echo json_encode("cards created");