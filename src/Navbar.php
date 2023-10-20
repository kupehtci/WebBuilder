
<?php

    $web_root = $_SERVER['DOCUMENT_ROOT']; 
    $relative_root = $_SERVER['PATH_INFO']; 
    $own_dir = __DIR__; 
    $own_file_dir = dirname(__FILE__); 
    class Navbar{

    private $root_folder = "../units";

    public $result = ""; 


    public function __construct(){   
    }

    public function __destruct(){
    }

    private function AddToResult($newConcatenatedResult){
        $this->result .= $newConcatenatedResult;
    }
    private function EchoResult(){
        echo $this->result;
    }

    public function Build(){
        
        global $own_file_dir; 

        $this->AddToResult("<nav> <ul>");       // Starts navigation

        // Initial dropdown for index and other main pages
        $this->AddToResult("<ul class='dropdown'>");  
        $this->AddToResult("<div class='nav-item'href='#'>X</div>"); 
        $this->AddToResult("<div class='dropdown-content'>
        <li><a href='./index.php'>Home</a></li>
        <li><a href=''>ALT</a></li>
        </div> </ul>
        ");
        
        $navbar_items = scandir($this->root_folder);
        

        foreach($navbar_items as $item){
            if($item != "." && $item != ".." && is_dir("$this->root_folder/$item")){
                $this->AddToResult("<ul class='dropdown'>");  
                $this->AddToResult("<div class='nav-item'href='#'>$item</div>"); 
                $this->AddToResult("<div class='dropdown-content'>"); 
                
                $sub_items = scandir("$this->root_folder/$item");

                foreach($sub_items as $sub_item){
                    if($sub_item != "." && $sub_item != ".."){
                        $this->AddToResult("<li><a href='./index.php?file=units/$item/$sub_item&&option=0'>$sub_item</a></li>"); 
                    }
                }
                $this->AddToResult("</div> </ul>");
            }
        }
        $this->AddToResult("</ul> </nav> <hr>"); 

        $this->EchoResult(); 

    }

}

// Build the navbar
$navBar = new Navbar();  
$navBar->Build(); 
?>