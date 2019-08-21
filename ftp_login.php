<?php 
    ob_start();
    session_start();
    if(isset($_POST['submit'])){
        $_SESSION['ftp_username'] = $_POST['username'];
        $_SESSION['ftp_password'] = $_POST['password'];

        header('Location: index.php');
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
    <h3>
        Login FTP server
    </h3>
    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="submit"> Sing in </button>
    </form>
    <a href="ftp_register.php">สมัครสมาชิก</a>
</body>
</html>