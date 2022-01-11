<?php

function upload_bingo_table($conn,$bingoT){
    $res = "";
    $sql = "INSERT INTO bingogame(id,bingoTable) VALUES  ('".session_id()."','".serialize($bingoT)."');";
    if(mysqli_query($conn, $sql)){
        $res.= "Table was updated successfully.";
    } else {
        $res.= "ERROR: Could not able to execute $sql. "
            . mysqli_error($conn);
    }
    mysqli_close($conn);
    return $res;
}

function upload_bingo_cards($conn,$bingoC){
    $sql = "UPDATE bingogame SET bingoCards='".serialize($bingoC)."' where id='".session_id()."';";
    if(mysqli_query($conn, $sql)){
        echo "<script>console.log('Cards updated successfully.')</script>";
    } else {
        echo "<script>console.log('ERROR: Could not able to execute ".$sql.". ".mysqli_error($conn)."')</script>";
    }
    mysqli_close($conn);
}

function generateNumber($conn){
    $letters = array(0=>"b",1=>"i",2=>"n",3=>"g",4=>"o");
    do{
        $i = rand(0,4);
        $j = rand(0,14);
        $CurrentLetter = $letters[$i];
        $number = $_SESSION["bingoTable"][$CurrentLetter][$j];
    }while($number->getState() == 1);
    $_SESSION["bingoTable"][$letters[$i]][$j]->setState(1);
    updateCards($number->getValue());
    return $number->getValue();
}

function updateCards($number){
    foreach ($_SESSION["cards"] as $cardOb){
        foreach($cardOb->getCard() as $card){
            foreach ($card as $cell){
               if($cell->getValue()!="free")
                if($cell->getValue() == $number)
                   $cell->setState(1);
            }
        }
    }
}

function bingo_max_number($num){
    $letters = array(0=>"b",1=>"i",2=>"n",3=>"g",4=>"o");
    return($_SESSION["bingoTable"][$letters[$num]][14]->getValue());
}


function contains($val,$arr){
    if(count($arr)==0)
        return false;
    foreach ($arr as $value){
        if($value->getValue() == $val)
            return true;
    }
    return false;
}

function populate_column($col){
    $row= array();
    $temp=0;
    for($j=0;$j<5;$j++){
        do{
            $temp = rand((bingo_max_number($col)-14),bingo_max_number($col));
        }while(contains($temp,$row));
        $row[$j]=new cell($temp,0);
        if($j==2 and $col == 2){
            $row[$j]->setState(1);
            $row[$j]->setValue("free");
        }
    }
    return $row;
}

function create_bingo_cards($amount){

    if(!isset($_SESSION["cards"])){
        $cardNumber = 0;
        $cards = array();
    }
    else{
        $cardNumber = sizeof($_SESSION["cards"]);
        $cards = $_SESSION["cards"];
    }

    for($k=0;$k<$amount; $k++){
        $card = array();
        for($i=0;$i<5;$i++){
            $card[$i] = populate_column($i);
        }
        $cards[] = new card(++$cardNumber,$card);
    }
    $_SESSION["cards"] = $cards;

}

