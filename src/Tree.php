<?php declare(strict_types=1);      // Allow to hard tyupe functions

function ConsoleLogTree($message){
    echo "<script> console.log('$message')</script>"; 
}

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

    // Depending on $item extension, returns a different icon
    private function GenerateIcon($item){
        $icon = ""; 
        if(str_contains($item, ".php")){
            $icon = "<img src='../style/icons/php.png' class='icon'>"; 
        }
        else if(str_contains($item, ".html")){
            $icon = "<img src='../style/icons/html.png' class='icon'>"; 
        }
        else if(str_contains($item, ".css")){
            $icon = "<img src = '../style/icons/css.png' class='icon'> "; 
        }
        else if(str_contains($item,".txt") || str_contains($item, ".md")){
            $icon = "<img src = '../style/icons/txt.png' class='icon'>"; 
        }

        return $icon; 
    }

    private function MakeDirectoryTree($path, $file_selected){
        // If file is selected, show content
        if(isset($_GET["file"])){

            $dir_scan = scandir($path);
            if($dir_scan == false) return; 

            foreach($dir_scan as $item)
            {
                if($item != "." && $item != ".." && $item != ".DS_Store")
                {
                    if(is_dir("$path/$item"))       // If it is a directory, recursively show the content 
                    {
                        $this->result .= "<ul class='tree-dropdown'>";                                                          // A ul for each folder
                        $this->result .= "<span class='folder-line'></span>";                                                   // Folder tree decoration line 
                        $this->result .= "<img src='../style/icons/folder.png' class='icon'>";                                  // Folder icon 
                        $this->result .= "<div class='nav-item'href='#'>$item</div> <div class='tree-dropdown-content'>";       // Folder dropdown files  
                        
                        $this->MakeDirectoryTree("$path/$item", $file_selected);                                                // Show each directory content recursively

                        $this->result .= "</div> </ul>";
                    }
                    else
                    {
                        // Change icon depending on item file format 
                        $icon = $this->GenerateIcon($item); 
                        
                        
                        $file_selected = basename($file_selected);

                        if($item == $file_selected){
                            $this->result .= "<li class='tree-dropdown-item-selected'>
                                <span class='folder-line'></span>
                                $icon
                                <a href='./index.php?file=$path/$item&&option=0'>$item</a>
                                </li>"; 
                        }
                        else{
                            $this->result .= "<li class='tree-dropdown-item'>
                                <span class='folder-line'></span>    
                                $icon
                                <a href='./index.php?file=$path/$item&&option=0'>$item</a>
                                </li>"; 
                        }
                    }
                }
            }

        }
    }

    public function Build(){
        $this->result .= "<aside>";
        $this->result .= "<h1 class='contents-title'>CONTENTS</h1>";
        
        $this->MakeDirectoryTree("../units", $_GET["file"]);

        $this->result .= "</aside>"; 
    }

    
}


?>