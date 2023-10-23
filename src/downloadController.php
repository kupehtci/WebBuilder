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

        private function DownloadFile($file){
            $file = $_POST["download"];
                
            if(!str_contains($file , "../")){
                $file = "../" . $file; 
            }
        
            echo "<script> console.log('DOWNLOADING from $file') </script>"; 

            if(file_exists($file)){

                
                echo "<script> console.log('FILE EXISTS')</script>"; 
                
                // Define the header of the file 
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
            $zip_name = "./buffer/temporal_$folder_name.zip"; 

            if($zip->open($zip_name, ZipArchive::CREATE) == TRUE){
                
                // Add all files from exercise into the zip file
                $exercise_dir = "../"; 
                $exercise_archives = scandir($exercise_dir); 
                foreach($exercise_archives as $archive){
                    if($archive != "." && $archive != ".."){
                        $zip->addFile($exercise_dir . $archive, $archive); 
                    }
                }

                $zip->close(); 

                // Define the header of the file 
                header("Content-Description: File Transfer"); 
                header("Content-Type: application/zip"); 
                header('Content-Disposition: attachment; filename="'.basename($zip_name).'"'); 
                header("Expires: 0"); 
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
                header("Pragma: public"); 
                header("Content-Length: " . filesize($zip_name)); 
                ob_end_flush();

                // Clean buffer to avoid getting also current php file code and read the file
                ob_clean(); 

                readfile($zip_name); 
                exit; 
            }
            else{
                echo "<script> console.log('ERROR CREATING ZIP FILE')</script>"; 
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
