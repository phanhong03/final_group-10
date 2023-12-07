<!-- display_patients.php -->
<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "username", "password", "KDT");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM BacSi");

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Họ và tên</th><th>Chuyên môn</th><th>Số điện thoại</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id_bacsi']}</td>";
        echo "<td>{$row['HoTenBS']}</td>";
        echo "<td>{$row['ChuyenMon']}</td>";
        echo "<td>{$row['SDT']}</td>";
        echo "<form action='delete_doctor_form.php' method='post'>";
        echo "<input type='hidden' name='id_bacsi' value='{$row['id_bacsi']}'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Không có bác sĩ nào.";
}

// Đóng kết nối
$conn->close();
?>