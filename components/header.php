<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>
<body>
    <div class="form_header">
            <header>
                <h1>Banner</h1>
            </header>
            <nav>
                <ul type="none">
                    <?php
                        if(isset($_GET['quanly'])) {
                            echo '<li><a href="index.php">Đăng xuất</a></li>';
                        }else{
                            echo '<li><a href="index.php">Trang chủ</a></li>|';
                            echo '<li><a href="?quanly=congty">Quản lý</a></li>';
                        }
                    
                    ?>
                </ul>
            </nav>
    </div>
</body>
</html>