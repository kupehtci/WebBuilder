<?php

class Footer{

    public $result = ""; 

    public function __construct(){

    }

    public function __destruct(){

    }

    public function Build(){
         $this->result .= "<footer> <p> This is the footer </p>";
         $this->result .= "<p>This website's icons were extracted from </p><a href='https://www.flaticon.com/free-icons/html' title='html icons'>Html icons created by Freepik - Flaticon</a>'";
         $this->result .= "</footer>";
    }
}

?> 