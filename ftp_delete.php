<?php
    session_start();
    require('ftp_connect.php');
    if(isset($_GET['file'])){
        $file = $_GET['file'];
        if (ftp_delete($ftp_con, $file)) {
            header("Location: index.php");
        } else {
            echo "could not delete $file";
            exit();
        }
    }
    
?>