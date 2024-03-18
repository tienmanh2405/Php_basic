<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuanLy</title>
</head>
<body>
    <div class="ProductManagement">
    <div style="text-align:center"><?php 
            if(isset($_GET['insertProduct'])){
                echo '<h2 style="text-align:center; margin-top: 60px">THÊM SẢN PHẨM</h2>';
            }else {
                echo'<h2>Quản lý sản phẩm</h2>';
            } ?></div>
        <table>
            <?php
            include('connect.db.php');
            $Product = "SELECT * FROM product";
            $result = mysqli_query($conn, $Product);
                if (isset($_GET['insertProduct'])) {
                    echo '
                        <form method="post" action="#" enctype="multipart/form-data">
                        <tr>
                            <td>Tên sản phẩm</td>
                            <td><input type="text" name="name"></td>
                        </tr>
                        <tr>
                            <td>Giá sản phẩm</td>
                            <td><input type="text" name="price"></td>
                        </tr>
                        <tr>
                            <td>Hình ảnh</td>
                            <td><input type="file" name="file"></td>
                        </tr>
                        <tr>
                            <td>Mô tả</td>
                            <td><textarea rows="5" cols="50" name="describe"></textarea></td>
                        </tr>
                        <tr>
                            <td>Công ty cung cấp</td>
                            <td>
                                <select name="companyName">';
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['ProductCarrier'].">" . $row['ProductCarrier'] . "</option>";
                    }
                    echo '
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="insert" value="Thêm"><input type="reset" name="reset" value="Nhập lại"></td>
                        </tr>
                        </form>
                    ';
            
            }else if(isset($_GET['updateProduct'])){
                echo'
                    <h2>Update Product</h2>
                    <form action="#" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td><label for="name">Name:</label></td>
                            <td><input type="text" id="name" name="name" required></td>
                        </tr>
                        <tr>
                            <td><label for="img">Images:</label></td>
                            <td><input type="file" id="img" name="file_img" required></td>
                        </tr>
                        <tr>
                            <td><label for="ProductID">ProductID:</label></td>
                            <td><input type="text" id="ProductID" name="ProductID" required></td>
                        </tr>
                        <tr>
                            <td><label for="price">Price:</label></td>
                            <td><input type="text" id="price" name="price" required></td>
                        </tr>
                        <tr>
                            <td><label for="companyName">Company Name:</label></td>
                            <td><input type="text" id="companyName" name="companyName" required></td>
                        </tr>
                        <tr>
                            <td>Mô tả</td>
                            <td><textarea rows="5" cols="50" name="describe"></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Update" name="UpdateProduct"></td>
                        </tr> 
                    </table>
                    </form>
                ';
                if(isset($_POST['UpdateProduct'])) {
                    // Trích xuất dữ liệu từ biểu mẫu
                    $id = $_GET['id'];
                    $name = $_POST['name'];
                    $ProductID = $_POST['ProductID'];
                    $price = $_POST['price'];
                    $describe = $_POST['describe'];
                    $companyName = $_POST['companyName'];
                    $tpm_name = $_FILES['file_img']['tmp_name'];
                    $name_img =  $_FILES['file_img']['name'];
                    $random = rand(100,999);
                    $newName = 'images/'.$random.$name_img;
                    if (move_uploaded_file($tpm_name, $newName)) {
                        echo '<script>alert("Tệp ảnh đã được di chuyển thành công.");</script>';
                    } else {
                        echo '<script>alert("Lỗi khi di chuyển tệp ảnh.");</script>';
                    }// Thực hiện truy vấn chèn dữ liệu vào cơ sở dữ liệu
                     $sql = "UPDATE allproduct SET 
                        name = '$name',
                        ProductID = '$ProductID',
                        img = '$newName',
                        price = '$price', 
                        companyName = '$companyName',
                        description = '$describe'
                        WHERE id = '$id'";
                    if(mysqli_query($conn, $sql)){
                        echo '<script>alert("Cập nhật thông tin công ty thành công.");</script>';
                    } else{
                        echo '<script>alert("Lỗi");</script>' . mysqli_error($conn);
                    }
                    // Cập nhật thông tin công ty trong cơ sở dữ liệu
                    
                    //
                }
            }else if(isset($_GET['deleteProduct'])){
                $id = $_GET['id'];
                $sql= "DELETE FROM allproduct WHERE id = '$id'";
                if(mysqli_query($conn, $sql)){
                        echo '<script>alert("Xóa thông tin công ty thành công.");</script>';
                    } else{
                        echo '<script>alert("Lỗi");</script>' . mysqli_error($conn);
                    }
            }else{
                echo'<div style="text-align:center;margin-top: 25px"><a href="?quanly=sanpham&&insertProduct">Thêm sản phẩm</a></div>';
                
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
                    echo '<td><a href="?quanly=sanpham&&updateProduct&&id='.$row['id'].'">Sửa</a>|<a href="?quanly=sanpham&&deleteProduct&&id='.$row['id'].'">Xóa</a></td>';
                    echo '</tr>';
                }
                echo' <div class="pagination">';
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active_class = ($i == $page) ? "active" : "";

                    if ($i == 1) {
                        echo "<a href='?quanly=sanpham' class='$active_class'>$i</a> ";
                    } else {
                        echo "<a href='?quanly=sanpham&page=$i' class='$active_class'>$i</a> ";
                    }
                }
                echo'</div>';
                }
            ?>
        </table>
        <?php
        if(isset($_POST['insert'])){ 
            // Trích xuất dữ liệu từ biểu mẫu
            $name = $_POST['name'];
            $price = $_POST['price'];
            $describe = $_POST['describe'];
            $companyName = $_POST['companyName'];
            
            if( $companyName == "Akko"){
                $productID = 1;
            }else if($companyName == "Corsair"){
                $productID = 2;
            }else if($companyName == "Fuhlen"){
                $productID = 3;
            }else if($companyName == "Leopold"){
                $productID = 4;
            }else if($companyName == "Razer"){
                $productID = 5;
            }else{
                echo "Lỗi nhập sai công ty";
            }
            if(isset($_FILES['file'])){
                $tpm_name = $_FILES['file']['tmp_name'];
                $name_img =  $_FILES['file']['name'];
                $random = rand(100,999);
                $newName = 'images/'.$random.$name_img;
                if (move_uploaded_file($tpm_name, $newName)) {
                    echo '<script>alert("Tệp ảnh đã được di chuyển thành công.");</script>';
                } else {
                    echo '<script>alert("Lỗi khi di chuyển tệp ảnh.");</script>';
                }
                // Thực hiện truy vấn chèn dữ liệu vào cơ sở dữ liệu
                $sql = "INSERT INTO allproduct (name,img, price, description, companyName) VALUES ('$name','$newName', '$price', '$describe', '$companyName')";
            }else{
                $sql = "INSERT INTO allproduct (name, price, description, companyName) VALUES ('$name', '$price', '$describe', '$companyName')";
            }

            if(mysqli_query($conn, $sql)){
                echo '<script>alert("Thêm sản phẩm thành công.");</script>';
            } else{
                echo '<script>alert("Lỗi");</script>' . mysqli_error($conn);
            }
        }

        mysqli_close($conn); // Đóng kết nối
?>

</div>
</body>
</html>