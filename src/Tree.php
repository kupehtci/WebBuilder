<?php

class Tree{
    private $result = ""; 

    public function __construct(){

    }

    public function __destruct(){

    }

    public function AddToResult($newConcatenatedResult){
        $this->result .= $newConcatenatedResult;
    }

    public function Build(){
        

        $this->AddToResult("<aside>");
        $this->AddToResult("<h2>Folder Tree</h2>");
        $this->AddToResult("</aside>"); 

        $this->EchoResult(); 
    }

    public function EchoResult(){
        if( $this->result == ""){
            echo "<p>Incomplete result for showing</p>"; 
        }
        else{
            echo $this->result;
        }
    }
}

$tree_aside = new Tree(); 
$tree_aside->Build();

?>