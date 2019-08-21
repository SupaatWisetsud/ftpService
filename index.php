<?php
    ob_start();
    session_start();

    if(!isset($_SESSION['ftp_username']) && !isset($_SESSION['ftp_password'])) header("Location: ftp_login.php");

    require('ftp_connect.php');

    if(isset($_POST['submit'])){

        $destination_file = $_FILES['file']['name'];
        $source_file = $_FILES['file']['tmp_name'];
        $size_file=$_FILES['file']['size'];

        $upload = ftp_put($ftp_con, $destination_file, $source_file, FTP_BINARY);    

        // check upload status  
        if (!$upload) {
            echo `FTP upload has failed!`;
            exit();
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
    <style>
        table{
            margin-top: 10px;
            border:2px solid #333;
        }
        td, th{
            border:2px solid #333;
            padding: 5px 20px;
        }
    </style>
</head>
<body>
    <a href="ftp_logout.php">ออกจากระบบ</a>
    <hr>
    <h3>upload file</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <button type="submit" name="submit">upload</button>
    </form>
    <hr>
    <table>
        <thead>
            <tr>
                <th>No. </th>
                <th>ชื่อไฟล์</th>
                <th>ขนาดของไฟล์</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $list = ftp_nlist($ftp_con, './');
                $i = 0;
                foreach($list as $row):
            ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= $list[$i] ?></td>
                    <td><?= number_format(ftp_size($ftp_con, "{$list[$i]}")/1024, 0); ?> KB</td>
                    <td> <a href="ftp_delete.php?file=<?=$list[$i]?>">ลบ</a> </td>
                </tr>
            <?php
                $i++; 
                endforeach; 
            ?>
        </tbody>
    </table>
</body>
</html>
<?php 
    ftp_close($ftp_con);
?>