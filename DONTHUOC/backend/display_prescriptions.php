<!-- display_patients.php -->
<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "username", "password", "KDT");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ bảng BenhNhan
$result = $conn->query("SELECT * FROM DonThuoc");

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>ID bệnh nhân</th><th>ID bác sĩ</th><th>Ngày kê đơn</th><th>Thao tác</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id_donthuoc']}</td>";
        echo "<td>{$row['id_benhnhan']}</td>";
        echo "<td>{$row['id_bacsi']}</td>";
        echo "<td>{$row['NgayKeDon']}</td>";
        echo "<td>";
        echo "<form action='delete_prescription_form.php' method='post'>";
        echo "<input type='hidden' name='id_donthuoc' value='{$row['id_donthuoc']}'>";
        echo "<button type='submit'>Xóa</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Không có đơn thuốc nào.";
}

// Đóng kết nối
$conn->close();
?>