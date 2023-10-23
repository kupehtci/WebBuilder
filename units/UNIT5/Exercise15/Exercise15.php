<html>
    <head>
        <title>Exercise 15</title>
    </head>
    <body>
        <h1>Exercise 15</h1>
    <?php

    function hide($msg) {
        $key_file = fopen('./key.txt', 'w');
        $text_file = fopen('./text.txt', 'w');

        $poss = [];
        $txt_concate = '';
        
        $msg = str_replace(' ', '', $msg); 
        $msg = strtolower($msg);

        for ($i = 0; $i < strlen($msg); $i++) {
            $txt_concate .= $msg[$i];
            $poss[] = $i;
        }
        
        $imploded = implode(' ', $poss); 
        fwrite($key_file, $imploded);
        fwrite($text_file, $txt_concate);
        echo "<p>Hello</p>";
        fclose($key_file);
        fclose($text_file);
    }

    function Unhide() {
        $key_file = fopen('./key.txt', 'r');
        $text_file = fopen('./text.txt', 'r');
    
        $poss = explode(' ', fread($key_file, filesize('key.txt')));
        $text = fread($text_file, filesize('text.txt'));
    
        $msg = '';
        
        foreach ($poss as $i) {
            $msg .= $text[$i];
        }
    
        fclose($key_file);
        fclose($text_file);
    
        return $msg;
    }
    ?>

    <?php
    $messageToHide = "Hello world motherfuckers";
    hide($messageToHide);
    echo "Hided message";
    $retrievedMessage = Unhide();
    echo "inhided message";
    echo "<p>Retrieved Message: " . $retrievedMessage . "</p>";
    ?>
    </body>
</html>