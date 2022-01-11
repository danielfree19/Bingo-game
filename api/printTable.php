<?php

include_once "../includes/classes.php";
include_once "../includes/database.php";
include_once "../includes/functions.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

if(isset($_SESSION["bingoTable"])){
    $number = $_GET["number"];
    $amountofrolls = 0;
    $last="";
    $rolledNumbers = "<table  class='no-print table-bordered'><tr>";
    $arr = $_SESSION["bingoTable"];
    $res = "<table class='no-print table table-bordered'>";
    foreach ($arr as $key => $subarray){
        $res.= "<tr><td style='background-color: gray; font-size: 25px'>".strtoupper($key)."</td>";
        foreach ($subarray as $val){
            if($number == $val->getValue()){
                $last.= "<td style='padding:5px;background-color: green;'>".$val->getValue()."</td>";
                $res.="<td style='background-color: green;'>".$val->getValue()."</td>";
                $amountofrolls++;
            }
            else if($val->getState() == 1){
                $rolledNumbers.= "<td style='padding:5px;background-color: yellow;'>".$val->getValue()."</td>";
                $amountofrolls++;
                $res.="<td style='background-color: yellow;'>".$val->getValue()."</td>";
            }

            else{
                $res.="<td >".$val->getValue()."</td>";
            }
        }
        $res.="</tr>";
    }
    $rolledNumbers.=$last;
    $_SESSION["amountofrolls"] = $amountofrolls;
    $res.="</table><br>".$rolledNumbers."<table style='margin-left:250px;margin-top: 20px;' class='no-print table-bordered'><tr><td id='amountofrolls'>".$amountofrolls."</td></tr></table>";
    upload_bingo_cards($conn,$_SESSION["bingoTable"]);
    echo $res;
}


