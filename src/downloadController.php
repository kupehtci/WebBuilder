<?php
    class DownloadController{
        private static $auxiliarPath = "./buffer"; 
    
        public function __construct(){
            // If directory for temporary save files to download is not created, create it 
            if(!file_exists(self::$auxiliarPath)){
                mkdir(self::$auxiliarPath); 
            }
        }

        private function DownloadFile($file){
            $file = $_POST["download"];
                
            if(!str_contains($file , "../")){
                $file = "../" . $file; 
            }
            if(file_exists($file)){
                
                ob_start(); 
                // // Define the header of the file 
                header("Content-Description: File Transfer"); 
                header("Content-Type: text/plain"); 
                header('Content-Disposition: attachment; filename="'.basename($file).'"'); 
                header("Expires: 0"); 
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
                header("Pragma: public"); 
                header("Content-Length: " . filesize($file)); 
                
                // Clean buffer to avoid getting also current php file code and read the file
                ob_clean(); 

                readfile($file); 
                exit; 
            }
            else{
                echo "<script> console.log('FILE DOES NOT EXIST')</script>";
            }
        }

        private function DownloadZIP($file){
            // Get folder directory path from that file 
            $folder = dirname($file); 
            $folder_name = basename($folder); 

            $zip = new ZipArchive(); 
            $zip_name = "./buffer/" . time() . ".zip"; 

            if($zip->open($zip_name, ZipArchive::CREATE) === TRUE){

                $exercise_archives = scandir($folder);

                foreach($exercise_archives as $archive){

                    $file_path = $folder ."/". $archive; 

                    if(basename($archive) != "." && basename($archive) != ".." && file_exists($file_path)){
                        $success = $zip->addFile($file_path); 
                    }
                    else if($archive != "." && $archive != ".."){
                    }
                }

                $zip->close();                 
            }
            else{
                echo "<script> console.log('ERROR CREATING ZIP FILE')</script>"; 
            }

            // Download the zip file
            if(file_exists($zip_name) && filesize($zip_name) > 0){
                ob_start(); 

                header("Content-Description: File Transfer"); 
                header("Content-Type: application/zip"); 
                header('Content-Disposition: attachment; filename="'.basename($zip_name).'"'); 
                // header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
                // header("Pragma: public"); 
                header("Content-Length: " . (string)(filesize($zip_name))); 
                
                ob_clean(); 

                flush(); 
                ob_end_flush();  
                @readfile($zip_name); 
                unlink($zip_name);
                exit; 
            }
        }

        public function Build(){

            // Handle download request by POST method 
            if(isset($_POST["download"])){
                $this->DownloadFile($_POST["download"]);
            }
            else if(isset($_POST["downloadZIP"])){
                $this->DownloadZIP($_POST["downloadZIP"]);
            }
        }
    }
?>