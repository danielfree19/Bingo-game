<?php

include_once "../includes/classes.php";
include_once "../includes/functions.php";
include_once "../includes/database.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

echo generateNumber($conn);