<!DOCTYPE html>
<html>
<head>
	<title>Daniel Laplana Portfolio</title>
</head>
<body>
    <?php 
    set_include_path(
        dirname( $_SERVER["DOCUMENT_ROOT"] )
      );
    
    ?>
    <?php
        require_once "./main.php"; 

        $webBuilder = new WebBuilder(); 
        $webBuilder->BuildAll(); 
    ?>


    
</body>
</html>