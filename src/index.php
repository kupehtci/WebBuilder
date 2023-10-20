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
        require_once './Navbar.php'; 
        require_once './main.php';
        require_once './Tree.php'; 

        $webBuilder = new WebBuilder(); 
        $webBuilder->Build(); 
    ?>

    
</body>
</html>