<?php

include_once "../includes/classes.php";
include_once "../includes/database.php";
include_once "../includes/functions.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

if(isset($_SESSION["cards"])){
    $wins=array();
    $rowsToCheck = array('b'=>0,'i'=>1,'n'=>0,'g'=>1,'o'=>0);
    foreach ($_SESSION["cards"] as $card) {
        foreach ($rowsToCheck as $index => $value){
            if($value == 1){
                switch($index){
                    case 'b':
                        $card->BComplete();
                        break;
                    case 'i':
                        $card->IComplete();
                        break;
                    case 'n':
                        $card->NComplete();
                        break;
                    case 'g':
                        $card->GComplete();
                        break;
                    case 'o':
                        $card->OComplete();
                        break;
                }
            }
        }
    }
    $i=0;
    $count = array();
    $count[0] = array();
    $count[0][$i] = 0;
    foreach ($_SESSION["cards"] as $card) {
        $numberOfCard = $card->getCardNumber()-1;
        $i=0;
        foreach ($card->getCard() as $row) {
            $count[$numberOfCard][$i] = 0;
            foreach ($row as $key => $cell) {
                if($cell->getState() == 1){
                    $count[$numberOfCard][$i]++;
                }
                else{
               
                }
            }   
            $i++;
        }
    }
    print_r($count);    
    
}
