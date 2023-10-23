<?php
    // INCLUDE SECTION 
    require_once './Navbar.php'; 
    require_once './Tree.php';  
    require_once './downloadController.php'; 
    require_once './footer.php'; 

    // INCLUDE THE FILES FROM SYNTAX HIGHLIGHTER
    require_once("../vendor/scrivo/Highlight.php/Highlight/Autoloader.php");
    spl_autoload_register("\\Highlight\\Autoloader::load");

    // Function to print the message in the console using JS
    function ConsoleLog($message){
        echo "<script>console.log('$message');</script>"; 
    }



    // Main class that builds the web by combining navbar, aside tree, content and footer
    class WebBuilder{
        public $web_links = ""; 
        public $web_navbar = ""; 
        public $web_tree = "";
        public $web_content = "";
        public $web_footer = "";
        private $css_root_folder = "../style";


        public function __construct(){
        }

        public function __destruct(){
            // echo "WebBuilder class is unloaded";
        }

        // Link all CSS files stored in the root folder into the web page 
        private function LinkAllCSS(){
            
            $css_files = scandir($this->css_root_folder);
            
            foreach($css_files as $file){
                if($file != "." && $file != ".."){
                    $this->web_links .=  "<link rel='stylesheet' type='text/css' href='$this->css_root_folder/$file'>"; 
                }
            }
        }

        public function BuildContent() {
            
            if (isset($_GET['page']) && !isset( $_GET['file'] )) {
                $value = $_GET['page'];
            } 

            // HOME PAGE
            if(!isset($_GET["file"]) && !isset($_GET["page"])){     
                $this->web_content .= "<h1 class='home_title'>This is the Home page</h1>"; 
                $this->web_content .= "<p class='home_text'>This is the content of the home page</p>"; 
            }
            // FILE EXPLORATION AND OPTIONSn
            else if(isset($_GET["file"]) && !isset( $_GET["page"]) && isset($_GET["option"])){
                
                $file = $_GET["file"];
                $option = $_GET["option"];
                ConsoleLog("File: $file and option $option"); 

                // OPTIONS SECTION FOR A FILE 
                $this->web_content .=  "<div class='options-section'><a class='option-link' href='./index.php?file=$file&&option=0'>Show content</a>
                                        <a class='option-link' href='./index.php?file=$file&&option=1'>Execute files</a>
                                        <a class='option-link' href='./index.php?file=$file&&option=2'>Download</a></div>"; 
                $this->web_content .= "<hr>";   // Horizontal line to separate options from content

                // DEPENDING ON OPTION, SHOW DIFFERENT CONTENT
                switch ($_GET["option"]){

                    case 0: // Show content option
                        
                        // Add ../ relative path if it is not already there
                        $file_to_read = $file;
                        if(!str_contains($file , "../")){
                            $file_to_read = "../" . $file_to_read; 
                        }
                        
                        // Get file and text highlighter
                        $content = file_get_contents($file_to_read); 

                        $highlighter = new \Highlight\Highlighter(); 
                        $content_highlighted = "";

                        // if(str_contains($file,".css")){
                        //     $content_highlighted = $highlighter->highlight($content);
                        // }

                        try{
                            
                            if(str_contains($file_to_read,".php")){
                                $highlighted = $highlighter->highlight('php', $content);
                            }
                            else if(str_contains($file_to_read,".css")){
                                $highlighted = $highlighter->highlight('css', $content);
                            }
                            else if(str_contains($file_to_read,".html")){
                                $highlighted = $highlighter->highlight('html', $content);
                            }
                            else if(str_contains($file_to_read,".js")){
                                $highlighted = $highlighter->highlight('javascript', $content);
                            }
                            else if(str_contains($file_to_read,".txt")){
                                $highlighted = $highlighter->highlight('plaintext', $content);
                            }
                            else if(str_contains($file_to_read,".md")){
                                $highlighted = $highlighter->highlight('markdown', $content);
                            }
                            else{
                                $this->web_content .= "<h1 class='file_read_text'> File format not supported </h1>";
                                break; 
                            }
                            
                            // If cannot be read by the highlighter, show the content as it is
                            if($highlighted->value == ""){
                                $content_treated = nl2br(htmlspecialchars($content)); 
                                $this->web_content .=  "<h1 class='file_read_text'> $content_treated </h1>";
                                break; 
                            }

                            $this->web_content .= "<pre class='file_read_text'><code class=\"hljs {$highlighted->language}\">";
                            $this->web_content .=  $highlighted->value;
                            $this->web_content .=  "</code></pre>";
                        }
                        catch(DomainException $excep){
                            $this->web_content .=   "<pre class='file_read_text'><code>";
                            $this->web_content .=   htmlentities($content);
                            $this->web_content .=   "</code></pre>";
                            echo "<script class='error'>Error: {$excep->getMessage()}</script>";
                        }

                        // if($content != false){
                        //     $content_treated = nl2br(htmlspecialchars($content)); 
                        //     $this->web_content .=  "<h1 class='file_read_text'> $content_treated </h1>";
                        // }
                        // else{
                        //     $this->web_content .=  "<h1>File does not exist</h1>";
                            
                        // }

                        break; 
                    case 1:     // Show file execution option
                        $file_to_read = $file; 
                        if(!str_contains($file , "../")){
                            $file_to_read = "../" . $file_to_read; 
                        }
                        ob_start(); 
                        require_once "$file_to_read"; 
                        $output = ob_get_clean();
                        $this->web_content .= "<h1 class ='output-title'>OUTPUT</h1>";
                        $this->web_content .= "<div class='file-execution-output'>
                                    <div class='external-content'>$output</div>
                                    </div>";
                        // external-content is used in css to prevent the execution of the css code from the file and only show the output
                        break; 
                    case 2:     // Download file option
                        $this->web_content .= "<div class='download-section'>";
                        $this->web_content .= "<form method='post' action=''>"; 
                        $this->web_content .= "<button class='download-button' type='submit' name='download' value='$file'>Download File</button></form>"; 
                        $this->web_content .= "<form method='post' action=''>"; 
                        $this->web_content .= "<button class='download-button' type='submit' name='downloadZIP' value='$file'>Download folder as ZIP</button></form>"; 
                        $this->web_content .= "</div>"; 

                        break; 
                    default: 
                        $option_choosen = $_GET["option"];
                        ConsoleLog("No option value for option $option_choosen");
                        break; 
                }
            }
            else{
                ConsoleLog("No file value");
            }
        }

        public function BuildNavbar(){
            $navBar = new Navbar();  
            $navBar->Build(); 
            $this->web_navbar =  $navBar->result; 
        }

        private function BuildTreeAside(){
            $tree_aside = new Tree(); 
            $tree_aside->Build(); 
            $this->web_tree = $tree_aside->result;
        }

        private function BuildFooter(){
            $footer = new Footer(); 
            $footer->Build(); 
            $this->web_footer = $footer->result;
        }

        private function BuildDownloadController(){
            $downloadController = new DownloadController(); 
            $downloadController->Build();
        }

        /**
         * Links all the css and builds all the web page sections
         */
        private function GroupWebSections(){
            $this->LinkAllCSS();
            $this->BuildNavbar();
            $this->BuildTreeAside();
            $this->BuildContent(); 
            $this->BuildFooter(); 
            $this->BuildDownloadController(); 
        }

        /**
         * Build all the sections of the web page and echo them
         */
        public function BuildAll(){
            
            // Group all the sections and echo them
            $this->GroupWebSections(); 
            $sections_joined = "$this->web_links $this->web_navbar <div class='main_section'>$this->web_tree <main>$this->web_content</main></div> $this->web_footer";
            echo "$sections_joined";  
        }


        
    }

?>