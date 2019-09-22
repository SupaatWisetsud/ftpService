<?php 

    $condb = mysqli_connect('localhost', 'root', '', 'db_ftp') or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".mysqli_connect_error());

    mysqli_set_charset($condb, 'utf8');

?>