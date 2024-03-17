<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuanLiThietBiDienTu</title>
    <link rel="stylesheet" href="./quanlithietbi.css">
</head>

<body>
    <div class="form_page">
        <?php include_once('./components/header.php');?>
        <section class="form_section">
            <?php include_once('./components/menu.php');?>
            <?php
            // Kiểm tra nếu có tham số quanli được truyền qua URL
            if(isset($_GET['quanly']) && $_GET['quanly'] === 'congty') {
                include_once('./components/quanlycongty.php');
            }else if(isset($_GET['quanly']) && $_GET['quanly'] === 'sanpham'){
                include_once('./components/quanlysanpham.php');
            } else {
                include_once('./components/content.php');
            }
            ?>
        </section>
        <?php include_once('./components/footer.php');?>
    </div>
</body>

</html>