<?php
    ob_start();
    session_start();
    require('connectDB.php');

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1>
                    Service FTP website
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h3>upload file</h3>
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="file" id="file">
                    <button type="submit" name="submit">upload</button>
                </form>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-end">
                <a href="ftp_logout.php">ออกจากระบบ</a>
            </div>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No. </th>
                    <th scope="col">ชื่อไฟล์</th>
                    <th scope="col">ขนาดของไฟล์</th>
                    <th scope="col">ดาวโหลด</th>
                    <th scope="col">ลบ</th>
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
                        <td> <a href="./upload/<?=$list[$i]?>">ดาวโหลด</a> </td>
                        <td> <a href="ftp_delete.php?file=<?=$list[$i]?>">ลบ</a> </td>
                    </tr>
                <?php
                    $i++; 
                    endforeach; 
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<?php 
    ftp_close($ftp_con);
?>