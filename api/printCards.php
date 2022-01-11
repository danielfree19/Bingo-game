<?php

include_once "../includes/classes.php";
ini_set('session.gc_maxlifetime',7200);
session_start();

if(isset($_SESSION["cards"])){
    $cards=$_SESSION["cards"];
    $res="";
    $letters = array(0=>"b",1=>"i",2=>"n",3=>"g",4=>"o");
    foreach ($cards as $cardOb){
        $res.="<div class='break page'><table class='table table-bordered'><tr><th colspan='6'>card number ".$cardOb->getCardNumber()."</th></tr>";
        $card = $cardOb->getCard();
        for($i=0;$i<5;$i++){
            $res.="<tr><td>".$letters[$i]."</td>";
            for($j=0;$j<5;$j++){
                if($card[$i][$j]->getState()==1)
                    $res.="<td style='background-color: green;'>".$card[$i][$j]->getValue()."</td>";
                else
                    $res.="<td>".$card[$i][$j]->getValue()."</td>";
            }
            $res.="</tr>";
        }
        $res.="</table></div>";
    }
    echo $res;
}
