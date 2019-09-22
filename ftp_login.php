
<?php
    /**
     * 
     * เมื่อสมัครเสร็จให้ restart ftp service อันนี่ไปหาวิธีไม่ให้ restart เอา
     */
    ob_start();
    session_start();
    require('connectDB.php');

    if(isset($_POST['submit'])){
        
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $result = mysqli_query($condb, "SELECT * FROM tb_accout WHERE ac_username = '$username' AND ac_password = '$password' ");
        
        if(mysqli_num_rows($result)){
            
            $result = mysqli_fetch_assoc($result);
            
            print_r($result);
        }
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