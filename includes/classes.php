<?php

class cell{
    private $val;
    private $state;

    public function __construct($val,$state){
        $this->val = $val;
        $this->setState($state);
    }

    public function getValue(){
        return $this->val;
    }

    public function getState(){
        return $this->state;
    }

    public function setState($state){
        $this->state = $state;
    }
    public function setValue($value){
        $this->val = $value;
    }

    public function __toString(){
        return $this->val.' '.$this->state;
    }
}

class card{
    private $cardNumber;
    private $card;
    private $wins;
    private $b;
    private $i;
    private $n;
    private $g;
    private $o;
    private $allTable;

    public function __construct($cardNumber,$card){
        $this->cardNumber = $cardNumber;
        $this->card = $card;
        $this->wins = 0;
        $this->b=0;
        $this->i=0;
        $this->n=0;
        $this->g=0;
        $this->o=0;
        $this->allTable=0;
    }

    public function getCardNumber(){
        return $this->cardNumber;
    }
    public function getCard(){
        return $this->card;
    }

    public function setCardNumber($cardNumber){
        $this->cardNumber = $cardNumber;
    }
    public function setCard($card){
        $this->card = $card;
    }

    public function getWins(): int
    {
        return $this->wins;
    }

    public function addWins(){
        $this->wins++;
    }

    public function BComplete(){
        $this->b = 1;
    }
    public function IComplete(){
        $this->i = 1;
    }
    public function NComplete(){
        $this->n = 1;
    }
    public function GComplete(){
        $this->g = 1;
    }
    public function OComplete(){
        $this->o = 1;
    }
    public function allTableComplete(){
        $this->allTable = 1;
    }

    public function getB(){
        return $this->b;
    }
    public function getI(){
        return $this->i;
    }
    public function getN(){
        return $this->n;
    }
    public function getG(){
        return $this->g;
    }
    public function getO(){
        return $this->o;
    }
    public function getAllTable(){
        return $this->allTable;
    }

    public function __toString(){
        return $this->cardNumber." ".$this->card;
    }
}
