<?php
$x = 20;   

for ($i = 0; $i <= $x; $i++) {
    
    if ($i % 2 == 0 && $i % 3 == 0) {
        echo "I am $i, an even number multiple of 3"; 
    } 
    elseif ($i % 2 == 0) {
        echo "I am $i, an even number"; 
    } 
    elseif ($i % 3 == 0) {
        echo "I am $i, a multiple of 3";
    }
}
?>