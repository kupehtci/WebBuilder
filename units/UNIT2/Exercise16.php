<?php
    $num = 5; 
    $res = 0; 
    $min_index = 2; 
    $max_index = 5; 
    For($i = $min_index; $i <= $max_index; $i++){
        $res = $num * $i; 
        echo "$num x $i = $res <br>"; 
    }
?>