<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
</head>
<body>
    <?php
        include('connect.db.php');

        // Xác định nếu 'product' đã được truyền qua URL 
        if(isset($_GET['product'])) {
            $productID = $_GET['product']; 
            $AllProduct = "SELECT * FROM AllProduct WHERE ProductID = $productID";
        } else {
            $AllProduct = "SELECT * FROM AllProduct";
        }
        
        $All = mysqli_query($conn, $AllProduct);
        
    ?>
    <article class="section_2">
        <?php
            $result_per_page = 6; // Số sản phẩm hiển thị trên mỗi trang
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
        ?>
        <?php while($row = mysqli_fetch_array($result)) {
            echo '<div class="card">
              <a href="#">
                  <img class="card-img-top"
                      src="' . $row['img'] . '" alt="' . $row['name'] . '">
                  <!-- <div >
                      <h5 class="card-title">Lindberg Chocolates Gift Box No Sugar</h5>
                      <p class="card-text">29.00$</p>
                      <input type="button" value="Add product" class="btn-dark add-card">
                  </div> -->
              </a>
              <strong>' . $row['name'] . '</strong>
            </div>';

    } ?>
        <div class="pagination">
            <?php
            // Hiển thị các liên kết phân trang
            for ($i = 1; $i <= $total_pages; $i++) {
                // Kiểm tra trang hiện tại để thêm class active
                $active_class = ($i == $page) ? "active" : "";
            
                echo "<a href='?page=$i' class='$active_class'>$i</a> ";
            }
            ?>
        </div>
    </article>
</body>
</html>
