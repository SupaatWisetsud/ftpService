<?php 
    session_start();
    require('./lib/ftp_adduser.php');

    if(isset($_POST['submit'])){
        add_ftp_user("{$_POST['username']}", "{$_POST['password']}", 'C:\Users\Mr.Bowman\Desktop'); //dir กำหนดตำแหน่งที่ต้องการให้เข้าถึง
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>สมัครสมาชิก</h3>
    <form method="post">
        <input type="text" name="username">
        <input type="password" name="password">
        <button type="submit" name="submit">สมัคร</button>
        <a href="ftp_login.php">กลับไปหน้าล็อกอิน</a>
    </form>
</body>
</html>