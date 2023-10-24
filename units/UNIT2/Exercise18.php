<?php
            for($i = 0; $i <= 127; $i++){
                $char_value = chr($i);  //Convert number into character value in ASCII
                echo "<tr>"; 
                echo "<td>$i</td>"; 
                echo  "<td>$char_value</td>"; 
                echo "</tr>"; 
            }
?>