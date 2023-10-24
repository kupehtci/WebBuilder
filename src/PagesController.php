<?php
    /**
     * PagesController class store and create the main pages of the website like home, contact, etc
     */
    abstract class PagesController{

        /**
         * Home function returns the home page
         * @return string $return the home webpage as string for being echo
         */
        public static function Home(){
            $return = ""; 
            $return .= "<h1 class='home_title'>This is the Home page</h1>"; 
            $return .= "<p class='home_text'>This is the content of the home page</p>"; 
            return $return; 
        }

        /**
         * Contact function returns the contact page
         * @return string $return the contact webpage as string for being echo
         */
        public static function Contact(){
            $return = ""; 
            $return .= "<h1 class='home_title'>Contact Page</h1>"; 
            $return .= "<p class='home_text'>This web page was created by <b>Daniel Laplana Gimeno</b></p>"; 
            return $return; 
        }
    }

?>