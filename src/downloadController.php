<?php
    class DownloadController{
        private static $auxiliarPath = "./downloads_buffer"; 

        public $root_files_folder = "../units";
    
        public function __construct(){
            // If directory for temporary save files to download is not created, create it 
            if(!file_exists(self::$auxiliarPath)){
                mkdir(self::$auxiliarPath); 
            }
        }

        public function Build(){

            if(isset($_POST["download"])){
                $file = $_POST["file"]; //$_POST["download"]; 
                $file = "../" . $file; 
                //$file = "../units/UNIT1/Exercise1.php"; 
                echo "<script> console.log('DOWNLOADING from $file') </script>"; 

                if(file_exists($file)){
                    echo "<script> console.log('FILE EXISTS')</script>"; 
                    
                    // Define the header of the file 
                    header("Content-Description: File Transfer"); 
                    header("Content-Type: text/plain"); 
                    header("Content-Disposition: attachment; filename=" . basename($file)); 
                    header("Expires: 0"); 
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
                    header("Pragma: public"); 
                    header("Content-Length: " . filesize($file)); 
                    
                    // Clean buffer
                    ob_clean(); 
                    flush(); 
                    
                    
                    readfile("./test.txt",true); 
                    exit; 
                }
                else{
                    echo "<script> console.log('FILE DOES NOT EXIST')</script>";
                }
            }
        }

    }
