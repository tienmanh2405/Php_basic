<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuanLy</title>
</head>
<body>
    <div class="company">
        <?php
            include('connect.db.php');
            $companies = "SELECT * FROM companies";
            $result = mysqli_query($conn, $companies);
            if(isset($_GET['updateCompany'])){
                echo'
                    <h2>Update Company</h2>
                    <form action="#" method="post">
                    <table>
                        <tr>
                            <td><label for="CompanyName">Company Name:</label></td>
                            <td><input type="text" id="CompanyName" name="CompanyName" required></td>
                        </tr>
                        <tr>
                            <td><label for="CompanyAddress">Company Address:</label></td>
                            <td><input type="text" id="CompanyAddress" name="CompanyAddress" required></td>
                        </tr>
                        <tr>
                            <td><label for="CompanyPhone">Company Phone:</label></td>
                            <td><input type="text" id="CompanyPhone" name="CompanyPhone" required></td>
                        </tr>
                        <tr>
                            <td><label for="CompanyEmail">Company Email:</label></td>
                            <td><input type="email" id="CompanyEmail" name="CompanyEmail" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Update" name="Update"></td>
                        </tr> 
                    </table>
                    </form>
                ';
                if(isset($_POST['Update'])) {
                    // Trích xuất dữ liệu từ biểu mẫu
                    $CompanyID = $_GET['CompanyID'];
                    $CompanyName = $_POST['CompanyName'];
                    $CompanyAddress = $_POST['CompanyAddress'];
                    $CompanyPhone = $_POST['CompanyPhone'];
                    $CompanyEmail = $_POST['CompanyEmail'];

                    // Cập nhật thông tin công ty trong cơ sở dữ liệu
                    $sql = "UPDATE companies SET 
                            CompanyName = '$CompanyName', 
                            CompanyAddress = '$CompanyAddress', 
                            CompanyPhone = '$CompanyPhone', 
                            CompanyEmail = '$CompanyEmail' 
                            WHERE CompanyID = '$CompanyID'";

                    if(mysqli_query($conn, $sql)){
                        echo '<script>alert("Cập nhật thông tin công ty thành công.");</script>';
                    } else{
                        echo '<script>alert("Lỗi");</script>' . mysqli_error($conn);
                    }
                }
            }else if(isset($_GET['deleteCompany'])){
                $CompanyID = $_GET['CompanyID'];
                $sql= "DELETE FROM companies WHERE CompanyID = '$CompanyID'";
                if(mysqli_query($conn, $sql)){
                        echo '<script>alert("Xóa thông tin công ty thành công.");</script>';
                    } else{
                        echo '<script>alert("Lỗi");</script>' . mysqli_error($conn);
                    }
            }
                else{
                echo '<div style="text-align:center"><h2>Quản lý công ty</h2></div>
                <table>
                    <tr>
                        <td>CompanyID</td>
                        <td>Company Name</td>
                        <td>Company Address</td>
                        <td>Company Phone</td>
                        <td>Company Email</td>
                        <td>Active</td>
                    </tr>
                ';
                while($row = mysqli_fetch_array($result)) {
                    echo '
                    <tr>
                        <td>'.$row["CompanyID"].'</td>
                        <td>'.$row["CompanyName"].'</td>
                        <td>'.$row["CompanyAddress"].'</td>
                        <td>'.$row["CompanyPhone"].'</td>
                        <td>'.$row["CompanyEmail"].'</td>
                        <td><a href="?quanly=congty&&updateCompany&&CompanyID='.$row["CompanyID"].'">Sửa</a>|<a href="?quanly=congty&&deleteCompany&&CompanyID='.$row["CompanyID"].'">Xóa</a></td>
                    </tr>';
                }
                echo '</table>';

            }
           
        ?>
    </div>
</body>
</html>