<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuanLy</title>
</head>
<body>
    <div class="company">
    <div style="text-align:center"><h2>Quản lý công ty</h2></div>
    <table>
        <tr>
            <td>CompanyID</td>
            <td>Company Name</td>
            <td>Company Address</td>
            <td>Company Phone</td>
            <td>Company Email</td>
            <td>Active</td>
        </tr>
        <?php
            include('connect.db.php');
            $companies = "SELECT * FROM companies";
            $result = mysqli_query($conn, $companies);
            while($row = mysqli_fetch_array($result)) {
                echo '
                    <tr>
                    <td>'.$row["CompanyID"].'</td>
                    <td>'.$row["CompanyName"].'</td>
                    <td>'.$row["CompanyAddress"].'</td>
                    <td>'.$row["CompanyPhone"].'</td>
                    <td>'.$row["CompanyEmail"].'</td>
                    <td><a href="#">Sửa</a>|<a href="#">Xóa</a></td>
                    </tr>
                ';
            }
        ?>
    </table>
    </div>
</body>
</html>