<?php 
    session_start();
    require('./lib/ftp_adduser.php');
    require('connectDB.php');


    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $file = $_FILES['file'];

        $sql = '';
        
        if(file_exists($file['tmp_name'])){
            move_uploaded_file($file['tmp_name'], './public/image/'.$file['name']);

            $sql = "INSERT INTO tb_account (ac_username, ac_password, `ac_fristname`, `ac_lastname`, `ac_email`, `ac_img`) 
                    VALUES ('$username', '$password', '$fname', '$lname', '$email', './public/image/{$file['name']}' )";
        }else{
            $sql = "INSERT INTO tb_account (ac_username, ac_password, `ac_fristname`, `ac_lastname`, `ac_email`) 
                    VALUES ('$username', '$password', '$fname', '$lname', '$email')";
        }

        if(mysqli_query($condb, $sql)){

            add_ftp_user("$username", "$password", __DIR__."/upload" ); //dir กำหนดตำแหน่งที่ต้องการให้เข้าถึง
            echo    "<script>
                        if(confrim('สมัครสมาชิกสำเร็จ')){
                            location.replace('ftp_login.php');
                        }
                    </script>";
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
    <h3>สมัครสมาชิก</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="text" name="fname" placeholder="Frist Name">
        <input type="text" name="lname" placeholder="Last Name"><br>
        <input type="file" name="file"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <button type="submit" name="submit">สมัคร</button>
        <a href="ftp_login.php">กลับไปหน้าล็อกอิน</a>
    </form>
</body>
</html>