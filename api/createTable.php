<?php

include_once "../includes/classes.php";
include_once "../includes/functions.php";
include_once "../includes/database.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

if(!isset($_SESSION["bingoTable"])){
    $arr = array("b"=>array(),"i"=>array(),"n"=>array(),"g"=>array(),"o"=>array());
    $i=1;
    foreach($arr as $key => $val){
        for($j = $i; $j<$i+15; $j++){
            $arr[$key][] = new cell($j,0);
        }
        $i+=15;
    }
    $_SESSION["bingoTable"] = $arr;
    upload_bingo_table($conn,$arr);
    echo json_encode(array("message"=>"done","sesid"=>session_id(),"table"=>serialize($arr)));
}
else{
    echo "Table already created";
}