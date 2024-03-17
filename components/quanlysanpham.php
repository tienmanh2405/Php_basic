<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuanLy</title>
</head>
<body>
    <div class="ProductManagement">
    <div style="text-align:center"><h2>Quản lý sản phẩm</h2></div>
        <table>
            <?php
                echo'<div style="text-align:center;margin-top: 25px"><a href="?updateProduct">Thêm sản phẩm</a></div>';
                include('connect.db.php');
                $AllProduct = "SELECT * FROM AllProduct";
                $All = mysqli_query($conn, $AllProduct);
                $result_per_page = 4; // Số sản phẩm hiển thị trên mỗi trang
                $total_results = mysqli_num_rows($All); // Tổng số sản phẩm
                $total_pages = ceil($total_results / $result_per_page); // Tổng số trang
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $start_index = ($page - 1) * $result_per_page;

                $query = "$AllProduct LIMIT $start_index, $result_per_page";
                $result = mysqli_query($conn, $query);
                echo '<tr>
                    <td>ID</td>
                    <td>Product Price</td>
                    <td>Product Image</td>
                    <td>Company Phone</td>
                    <td>Action</td>
                    </tr>';
                while($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['price'] . '</td>';
                    echo '<td><img src="' . $row['img'] . '" alt="' . $row['name'] . '" style="width: 100px; height: 60px"></td>';
                    echo '<td>' . $row['companyName'] . '</td>';
                    echo '<td><a href="#">Sửa</a>|<a href="#">Xóa</a></td>';
                    echo '</tr>';
                }

            ?>
        </table>
        <div class="pagination">
    <?php
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $page) ? "active" : "";

        if ($i == 1) {
            echo "<a href='?quanly=sanpham' class='$active_class'>$i</a> ";
        } else {
            echo "<a href='?quanly=sanpham&page=$i' class='$active_class'>$i</a> ";
        }
    }
    ?>
</div>

        </div>
</body>
</html>