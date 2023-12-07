<!DOCTYPE html>
<html lang="en">
  <meta charset="UTF-8">
<head>
  <title>Đơn thuốc</title>
  <link rel="stylesheet" href="style2.css">
</head>
<body>
<?php
    // Lấy thông tin tên người dùng từ URL
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        // echo "Xin chào, $username!"; // Hiển thị thông báo chào mừng
    } else {
        echo "Không có thông tin người dùng được truyền vào.";
    }
    ?>
  <h1>Tạo Đơn thuốc</h1>
  <div class="buttons">
    <a href="donthuocganhat.php" class="button">Danh sách khác hàng đã được kê</a><br><br>
    <a href="trangchu.php?username=<?php echo urlencode($username); ?>" class="button">Kê đơn thuốc</a>
  </div>
</body>
</html>
