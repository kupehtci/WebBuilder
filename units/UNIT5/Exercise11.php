<html>
    <head>
        <title>Exercise 11</title>
    </head>
    <body>
        <h1>Exercise 11</h1>
        <?php
        echo "HELLO"; 
        // function copyFileByte($source, $destination) {
        //     $source_file = fopen($source, 'rb');
        //     $dest_file = fopen($destination, 'wb');
            
        //     if ($source_file && $destination) {
        //         while (!feof($source_file)) {
        //             $byte = fgetc($source_file);
        //             if ($byte !== false) {
        //                 if (is_numeric($byte)) {
        //                     fseek($source_file, -1, SEEK_CUR); // Move back one byte
        //                     fwrite($dest_file, '*'); // Overwrite with an asterisk
        //                 } else {
        //                     fwrite($dest_file, $byte);
        //                 }
        //             }
        //         }
                
        //         fclose($source_file);
        //         fclose($dest_file);
        //     }
        //     echo "<p> enters func</p>"; 
        // }

        // $source = './test.txt';
        // $dest = './destination.txt';
        // echo "HHHH";
        // // copyFileByte($source, $dest); 

        ?>

    </body>
</html>