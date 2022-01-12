<?php

include_once "../includes/classes.php";
include_once "../includes/database.php";
include_once "../includes/functions.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

if(isset($_SESSION["cards"])){
    $letters = array(0=>"b",1=>"i",2=>"n",3=>"g",4=>"o");

    $futureWins=array();
    if(!isset($_SESSION["rowsToCheck"])){
        $_SESSION["rowsToCheck"] = array('b'=>0,'i'=>1,'n'=>0,'g'=>1,'o'=>0);
    }
    $newRowsCheck = $_SESSION["rowsToCheck"];
    foreach ($_SESSION["cards"] as $card) {
        foreach ($_SESSION["rowsToCheck"] as $index => $value){
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
        foreach ($card->getCard() as $rowNum => $row) {
            $count[$numberOfCard][$i] = 0;
            foreach ($row as $key => $cell) {
                if($cell->getState() == 1){
                    $count[$numberOfCard][$i]++;
                }
                switch($letters[$rowNum]){
                    case 'b':
                        if($_SESSION["rowsToCheck"][$letters[0]]==0 && $count[$numberOfCard][$i] == 5){
                            if($card->getB()==0){
                                $card->BComplete();
//                                $newRowsCheck[$letters[0]]=1;
                                $card->addWins();
                            }
                        }
                        break;
                    case 'i':
                        if($_SESSION["rowsToCheck"][$letters[1]]==0 && $count[$numberOfCard][$i] == 5){
                            if($card->getI()==0) {
                                $card->IComplete();
//                                $newRowsCheck[$letters[1]]=1;
                                $card->addWins();
                            }
                        }
                        break;
                    case 'n':
                        if($_SESSION["rowsToCheck"][$letters[2]]==0 && $count[$numberOfCard][$i] == 5){
                            if($card->getN()==0) {
                                $card->NComplete();
//                                $newRowsCheck[$letters[2]]=1;
                                $card->addWins();
                            }
                        }
                        break;
                    case 'g':
                        if($_SESSION["rowsToCheck"][$letters[3]]==0 && $count[$numberOfCard][$i] == 5){
                            if($card->getG()==0) {
                                $card->GComplete();
//                                $newRowsCheck[$letters[3]]=1;
                                $card->addWins();
                            }
                        }
                        break;
                    case 'o':
                        if($_SESSION["rowsToCheck"][$letters[4]]==0 && $count[$numberOfCard][$i] == 5){
                            if($card->getO()==0) {
                                $card->OComplete();
//                                $newRowsCheck[$letters[4]]=1;
                                $card->addWins();
                            }
                        }
                        break;
                }
            }

            if($count[$numberOfCard][$i] == 4){
                $futureWins[$numberOfCard][$letters[$rowNum]]=1;
            }
            //row ends

            $i++;
        }

//        if($card->getB()||$card->getI()||$card->getN()||$card->getG()||$card->getO()){
//            $_SESSION["wins"][$numberOfCard]=array('b'=>$card->getB(),'i'=>$card->getI(),'n'=>$card->getN(),'g'=>$card->getG(),'o'=>$card->getO(),'all'=>$card->getB()+$card->getI()+$card->getN()+$card->getG()+$card->getO());
//        }

    }





    function check($num){}


    foreach ($count as $card){
        foreach ($card as $rowNum => $rowsSum){
            if($rowsSum == 5){

            }
        }
    }

//    foreach ($_SESSION["cards"] as $card){
//        echo $card->getCardNumber()." => ".$card->getWins()."<br>";
//    }
//    echo "<br><br>";
    // gives future winning cards that left at least one turn to win
    $answer = "Future to win cards ";
    foreach ($futureWins as $key => $val){
        $answer.=($key+1).", ";
    }
    if($answer!= "Future to win cards ")
        echo $answer;
}
