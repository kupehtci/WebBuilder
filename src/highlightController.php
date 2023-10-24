<?php
abstract class HighlightController{

    /**
     * Highlights the content of a file depending on its extension
     * @param string $file The file path from the file that is going to be highlighted
     * @return string   The content of the file highlighted depending on the format
     * @throws DomainException
     */
    public static function HighlightFileContent($file){
        
        $result = ""; 

        $content = file_get_contents($file);
        if($content == false){
            $result .= "<h1 class='file_read_text'> File not found or its empty</h1>";
            return $result; 
        }
        else if($content == ""){
            $result .= "<h1 class='file_read_text'> File is empty </h1>";
            return $result; 
        }
        $highlighter = new \Highlight\Highlighter(); 

        try{
                            
            if(str_contains($file,".php")){
                $highlighted = $highlighter->highlight('php', $content);
            }
            else if(str_contains($file,".css")){
                $highlighted = $highlighter->highlight('css', $content);
            }
            else if(str_contains($file,".html")){
                $highlighted = $highlighter->highlight('html', $content);
            }
            else if(str_contains($file,".js")){
                $highlighted = $highlighter->highlight('javascript', $content);
            }
            else if(str_contains($file,".txt")){
                $highlighted = $highlighter->highlight('plaintext', $content);
            }
            else if(str_contains($file,".md")){
                $highlighted = $highlighter->highlight('markdown', $content);
            }
            else{
                $result .= "<h1 class='file_read_text'> File format not supported </h1>";
                return $result; 
            }
            
            // If cannot be read by the highlighter, show the content as it is
            if($highlighted->value == ""){
                $content_treated = nl2br(htmlspecialchars($content)); 
                $result .=  "<h1 class='file_read_text'> $content_treated </h1>";
                return $result; 
            }

            $result .= "<pre class='file_read_text'><code class=\"hljs {$highlighted->language}\">";
            $result .=  $highlighted->value;
            $result .=  "</code></pre>";
        }
        catch(DomainException $excep){
            $result .=   "<pre class='file_read_text'><code>";
            $result .=   htmlentities($content);
            $result .=   "</code></pre>";
            echo "<script class='error'>Error: {$excep->getMessage()}</script>";
        }
        return $result; 
    }
}
?>