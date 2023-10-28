<?php
    class Navbar{

        public $root_folder = "../units";

        public $result = ""; 


        public function __construct(){   
        }

        public function __destruct(){
        }

        private function AddToResult($newConcatenatedResult){
            $this->result .= $newConcatenatedResult;
        }
        public function EchoResult(){
            echo $this->result;
        }

        public function Build() {
            
            $this->result .= "<nav> <ul>";       // Starts navigation

            // Initial dropdown for index and other main pages
            $this->result .= "<ul class='dropdown'>";  
            $this->result .= "<div class='nav-item'href='#'>X</div>"; 
            $this->result .= "<div class='dropdown-content'>
            <li><a href='./index.php'>Home</a></li>
            <li><a href='./index.php?page=contact'>Contact</a></li>
            </div> </ul>";
            
            $navbar_items = scandir($this->root_folder);
            

            foreach($navbar_items as $item){
                if($item != "." && $item != ".." && is_dir("$this->root_folder/$item") && $item != ".DS Store"){
                    $this->result .= "<ul class='dropdown'>";  
                    $this->result .= "<div class='nav-item'href='#'>$item</div>"; 
                    $this->result .= "<div class='dropdown-content'>"; 
                    
                    $sub_items = scandir("$this->root_folder/$item");

                    foreach($sub_items as $sub_item){
                        if($sub_item != "." && $sub_item != ".."){
                            $this->result .= "<li><a href='./index.php?file=units/$item/$sub_item&&option=0'>$sub_item</a></li>"; 
                        }
                    }
                    $this->result .= "</div> </ul>";
                }
            }
            $this->result .= "</ul> </nav> <hr>"; 

            return $this->result; 
        }

    }
?>