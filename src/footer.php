<?php

class Footer{

    public $result = ""; 

    public function __construct(){

    }

    public function __destruct(){

    }

    public function Build(){
         $this->result .= "<footer> <p> This is the footer </p> </footer>";
    }
}

?> 