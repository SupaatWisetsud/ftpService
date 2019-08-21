<?php 
    $server = '127.0.0.1';
    $ftp_con = ftp_connect($server, 21, 90) ;
    
    $ftp_login = ftp_login( $ftp_con, "{$_SESSION['ftp_username']}", "{$_SESSION['ftp_password']}");

    if((!$ftp_con) || (!$ftp_login)){
        echo "ไม่สามารถเชื่อมต่อ FTP server ได้";
        exit();
    }
?>