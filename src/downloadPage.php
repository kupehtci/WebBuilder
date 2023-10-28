<?php
    require_once "./downloadController.php"; 
    $downloadController = new DownloadController();
    if(isset($_GET["downloadZIP"])){
        $downloadController->DownloadInExternalPage($_GET["downloadZIP"]);
    }
?>