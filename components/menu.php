<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <article class="section_1">
                <ul type="none">
                <?php
                include('connect.db.php');
                if(isset($_GET['quanly']) ) {
                    echo "<li><a href='?quanly=congty'>Quản lý công ty</a></li>";
                    echo "<li><a href='?quanly=sanpham'>Quản lý sản phẩm</a></li>";
                }else{

                
                // // Câu lệnh SQL
                 $sql = "SELECT * FROM product";
                // // Thực thi câu lệnh và lưu kết quả vào biến $result
                 $result = mysqli_query($conn, $sql);
                
                // // Kiểm tra và xử lý kết quả
                if (mysqli_num_rows($result) > 0) {
                     // Lặp qua từng dòng dữ liệu
                     while ($row = mysqli_fetch_assoc($result)) {
                         // Xử lý dữ liệu
                        echo "<li><a href='?product=" . $row['ProductID'] . "'>" . $row['ProductCarrier'] . "</a></li>";
                     }
                 } else {
                     echo "Không có dữ liệu.";
                 }
                }
                //Đóng kết nối
                mysqli_close($conn);
                ?>
                </ul>
    </article>
    
</body>
</html>
