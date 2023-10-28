<?php
class Footer{

    public $result = ""; 

    public function __construct(){

    }

    public function __destruct(){

    }

    public function Build(){
         $this->result .= "<hr><footer> <p> This is the footer </p>";
         $this->result .= "<p>This website's icons were extracted from </p>
         <a href='https://www.flaticon.com/free-icons/html' title='html icons'>Html icons created by Freepik - Flaticon</a>'
         <a href='https://www.flaticon.es/iconos-gratis/archivos-y-carpetas' title='archivos y carpetas iconos'>Archivos y carpetas iconos creados por The Chohans - Flaticon</a>";
         $this->result .= "</footer>";
    }
}
?> 