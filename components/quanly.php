<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quanly</title>
</head>
<body>
    <article class="quanli">
        <?php include('connect.db.php'); 
            if(isset($_GET['quanly'])){
                echo 'Đây là trang quản lí';
            }else{
                echo 'error';
            }
        ?>
        
    </article>
</body>
</html>