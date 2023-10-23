<!DOCTYPE html>
<html>
<head>
	<title>Daniel Laplana Portfolio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php 
    // set_include_path(
    //     dirname( $_SERVER["DOCUMENT_ROOT"] )
    //   );
    
    ?>
    <?php
        require_once "./main.php"; 

        $webBuilder = new WebBuilder(); 
        $webBuilder->BuildAll(); 
    ?>


    
</body>
</html>