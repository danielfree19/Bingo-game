<?php

include_once "../includes/classes.php";
include_once "../includes/database.php";
include_once "../includes/functions.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

$wins = array();


if(isset($_SESSION["cards"])){
    $count = 0 ;
    foreach ($_SESSION["cards"] as $card) {
        foreach ($card->getCard() as $row) {
            foreach ($row as $key => $cell) {
                if($cell->getState()){
                    $count++;
                }
            }
        }
        if($count == 25){
            $wins[]=$card->getCardNumber();
        }
        $count = 0;
    }

    if(sizeof($wins)>0){
        if(!isset($_SESSION["wins"])){
            $_SESSION["wins"] = array();
        }
        foreach($wins as $value){
            $_SESSION["cards"][$value-1]->addWins();
            $_SESSION["cards"][$value-1]->allTableComplete();
            //print_r($_SESSION["cards"][$value-1]);
        }
    }
    echo json_encode($wins) ;
    //print_r($_SESSION["wins"]);
}
else{
    echo json_encode($wins) ;
}
