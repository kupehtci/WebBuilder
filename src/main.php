<?php
    class WebBuilder{

        public static $web_navbar = "NavBar Area"; 
        public static $web_tree = "";
        public static $web_content = "";
        public static $web_footer = "";

        private $css_root_folder = "../style";


        public function __construct(){
            // echo "WebBuilder class is loaded";
        }

        public function __destruct(){
            // echo "WebBuilder class is unloaded";
        }

        public function BuildContent(){
            // CONTENT PAGE SECTION 

            if (isset($_GET['page']) && !isset( $_GET['file'] )) {
                $value = $_GET['page'];
                echo "You provided the value: $value";
            } else {
                echo "<h1>Default webpage section</h1>"; 
                echo "<p>This is a text example, test test test test test test test test </p>"; 
            }

            //$units_folder_path = "./units"; 


            if(isset($_GET["file"]) && !isset( $_GET["page"]) && isset($_GET["option"])){
                
                $value = $_GET["file"];
                $option = $_GET["option"];
                echo "<p>Option: $value and option $option </p>"; 

                switch ($_GET["option"]){

                        case 0: 
                                
                        $file_to_read = "../" . $_GET["file"]; 
                        $content = file_get_contents($file_to_read); 
                        echo "Content: $content"; 

                        if($content != false){
                            $content_treated = nl2br(htmlspecialchars($content)); 
                            echo "<div class='file_read'><h1 class='file_read_text'> $content_treated </h1></div>";
                            echo "<h1>File exists</h1>"; 
                        }
                        else{
                            echo "<h1>File does not exist</h1>";
                            
                        }
                        echo "$content"; 

                        break; 
                    case 1: 
                        include $_GET["file"]; 
                        break; 
                    case 2: 
                        include $_GET["file"]; 
                        break; 
                    default: 
                        echo "<p>Invalid option</p>"; 
                        break; 
                }
            }
            else{
                echo "<p>Invalid file</p>"; 
            }
        }

        public function Build(){
            $this->LinkAllCSS();
            $this->BuildContent(); 
        }


        // Link all CSS files stored in the root folder into the web page 
        private function LinkAllCSS(){
            
            $css_files = scandir($this->css_root_folder);
            
            foreach($css_files as $file){
                if($file != "." && $file != ".."){
                    echo "<link rel='stylesheet' type='text/css' href='$this->css_root_folder/$file'>"; 
                }
            }
        }
    }

?>