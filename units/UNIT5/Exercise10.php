<?php
function copyFileByte($source, $destinationFile) {
    $source_file = fopen($source, 'rb');
    $dest_file = fopen($destinationFile, 'wb');
    
    if ($source_file && $dest_file) {
        while (!feof($source_file)) {
            $bytes = fgetc($source_file);
            if ($bytes !== false) {
                fwrite($dest_file, $bytes);
                echo "$bytes";
            }
        }
        
        fclose($source_file);
        fclose($dest_file);
    }
}

$source = 'test.txt';
$dest = 'destination.txt';

copyFileByte($source, $dest); 

?>