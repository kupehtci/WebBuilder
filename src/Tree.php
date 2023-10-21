<?php

class Tree{
    public $result = ""; 

    public function __construct(){

    }

    public function __destruct(){

    }

    public function AddToResult($newConcatenatedResult){
        $this->result .= $newConcatenatedResult;
    }

    public function EchoResult(){
        if( $this->result == ""){
            echo "<p>Incomplete result for showing</p>"; 
        }
        else{
            echo $this->result;
        }
    }

    public function Build(){
        

        $this->AddToResult("<aside>");
        $this->AddToResult("Tree aside");
        $this->AddToResult("</aside>"); 
    }

    
}


?>