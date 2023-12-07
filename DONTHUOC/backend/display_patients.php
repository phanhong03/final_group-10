<!-- display_patients.php -->
<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "username", "password", "KDT");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ bảng BenhNhan
$result = $conn->query("SELECT * FROM BenhNhan");

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Họ và tên</th><th>Ngày sinh</th><th>Giới tính</th><th>Địa chỉ</th><th>Xóa</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id_benhnhan']}</td>";
        echo "<td>{$row['HoTenBN']}</td>";
        echo "<td>{$row['NgaySinh']}</td>";
        echo "<td>{$row['GioiTinh']}</td>";
        echo "<td>{$row['DiaChi']}</td>";
        echo "<td>";
        echo "<form action='delete_patient_form.php' method='post'>";
        echo "<input type='hidden' name='id_benhnhan' value='{$row['id_benhnhan']}'>";
        echo "<button type='submit'>Xóa</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Không có bệnh nhân nào.";
}

// Đóng kết nối
$conn->close();
?>