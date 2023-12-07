<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "username", "password", "KDT");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra hành động
    $action = isset($_POST["action"]) ? $_POST["action"] : '';

    if ($action == "themdonthuoc") {
        // Lấy dữ liệu từ form và sử dụng prepared statements
        $id_benhnhan = $conn->real_escape_string($_POST["id_benhnhan"]);
        $id_bacsi = $conn->real_escape_string($_POST["id_bacsi"]);
        $ngaykedon = $conn->real_escape_string($_POST["NgayKeDon"]);

        // Kiểm tra xem bệnh nhân và bác sĩ có tồn tại không
        $benh_nhan_ton_tai = kiemTraTonTaiPrescription($conn, 'BenhNhan', 'id_benhnhan', $id_benhnhan);
        $bac_si_ton_tai = kiemTraTonTaiPrescription($conn, 'BacSi', 'id_bacsi', $id_bacsi);

        if (!$benh_nhan_ton_tai) {
            echo "Lỗi: Bệnh nhân không tồn tại.<br> <a href='index.php'>Quay lại</a>";
        } elseif (!$bac_si_ton_tai) {
            echo "Lỗi: Bác sĩ không tồn tại.<br> <a href='index.php'>Quay lại</a>";
        }elseif (!$bac_si_ton_tai && !$benh_nhan_ton_tai) {
            echo "Lỗi: Bệnh nhân và bác sĩ không tồn tại.<br> <a href='index.php'>Quay lại</a> ";
        }else {
            // Thực hiện truy vấn SQL để thêm đơn thuốc
            $stmt = $conn->prepare("INSERT INTO DonThuoc (id_benhnhan, id_bacsi, NgayKeDon) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $id_benhnhan, $id_bacsi, $ngaykedon);

            if ($stmt->execute()) {
                // Chuyển hướng sau khi thêm thành công
                header("Location: index.php");
                exit();
            } else {
                echo "Lỗi khi thêm đơn thuốc: " . $stmt->error;
            }
        }
    } elseif ($action == "suadonthuoc") {
        $id_donthuoc = isset($_POST["id_donthuoc"]) ? $_POST["id_donthuoc"] : '';
        $id_benhnhan = $conn->real_escape_string($_POST["id_benhnhan"]);
        $id_bacsi = $conn->real_escape_string($_POST["id_bacsi"]);
        $ngaykedon = $conn->real_escape_string($_POST["ngaykedon"]);

        // Kiểm tra xem đơn thuốc có tồn tại không
        $don_thuoc_ton_tai = kiemTraTonTaiPrescription($conn, 'DonThuoc', 'id_donthuoc', $id_donthuoc);

        // Kiểm tra xem bệnh nhân và bác sĩ có tồn tại không
        $benh_nhan_ton_tai = kiemTraTonTaiPrescription($conn, 'BenhNhan', 'id_benhnhan', $id_benhnhan);
        $bac_si_ton_tai = kiemTraTonTaiPrescription($conn, 'BacSi', 'id_bacsi', $id_bacsi);

        if (!$don_thuoc_ton_tai) {
            // Thông báo lỗi và thêm nút "Quay lại"
            echo "<p>Lỗi: Đơn thuốc có ID $id_donthuoc không tồn tại. <a href='index.php'>Quay lại</a></p>";
        } elseif (!$benh_nhan_ton_tai) {
            // Thông báo lỗi và thêm nút "Quay lại"
            echo "<p>Lỗi: Bệnh nhân có ID $id_benhnhan không tồn tại. <a href='index.php'>Quay lại</a></p>";
        } elseif (!$bac_si_ton_tai) {
            // Thông báo lỗi và thêm nút "Quay lại"
            echo "<p>Lỗi: Bác sĩ có ID $id_bacsi không tồn tại. <a href='index.php'>Quay lại</a></p>";
        } else {
            // Thực hiện truy vấn SQL để sửa đơn thuốc
            $stmt = $conn->prepare("UPDATE DonThuoc SET id_benhnhan = ?, id_bacsi = ?, NgayKeDon = ? WHERE id_donthuoc = ?");
            $stmt->bind_param("sssi", $id_benhnhan, $id_bacsi, $ngaykedon, $id_donthuoc);

            if ($stmt->execute()) {
                // Chuyển hướng sau khi sửa thành công
                header("Location: index.php");
                exit();
            } else {
                echo "Lỗi khi sửa đơn thuốc: " . $stmt->error;
            }
        }
    } elseif ($action == "xoadonthuoc") {
        $id_donthuoc = isset($_POST["id_donthuoc"]) ? $_POST["id_donthuoc"] : '';

        // Kiểm tra xem đơn thuốc có tồn tại không
        $don_thuoc_ton_tai = kiemTraTonTaiPrescription($conn, 'DonThuoc', 'id_donthuoc', $id_donthuoc);

        if (!$don_thuoc_ton_tai) {
            // Thông báo lỗi và thêm nút "Quay lại"
            echo "<p>Lỗi: Đơn thuốc có ID $id_donthuoc không tồn tại. <br> <a href='index.php'>Quay lại</a></p>";
        } else {
            // Hiển thị form xác nhận xóa hoặc thực hiện xóa trực tiếp
            echo "<form action='process_prescription_data.php' method='post'>";
            echo "<input type='hidden' name='action' value='xoadonthuoc'>";
            echo "<input type='hidden' name='id_donthuoc' value='$id_donthuoc'>";
            echo "<p>Bạn có chắc chắn muốn xóa đơn thuốc có ID $id_donthuoc không?</p>";

            // Thêm dòng này để xác nhận xóa
            echo "<input type='hidden' name='confirm_xoa' value='1'>";

            echo "<input type='submit' value='Xác nhận Xóa'>";
            echo "</form>";

            // Nếu có xác nhận xóa, thực hiện xóa và chuyển hướng
            if (isset($_POST["confirm_xoa"])) {
                // Thực hiện truy vấn SQL để xóa đơn thuốc sử dụng prepared statement
                $stmt = $conn->prepare("DELETE FROM DonThuoc WHERE id_donthuoc = ?");
                $stmt->bind_param("i", $id_donthuoc);

                if ($stmt->execute()) {
                    // Xóa thành công, hiển thị nút "Quay lại"
                    echo "<p>Xóa thành công. <a href='index.php'>Quay lại</a></p>";
                } else {
                    // Lỗi
                    echo "Lỗi khi xóa đơn thuốc: " . $stmt->error;
                }
            }
        }
    }
}

// Đóng kết nối
$conn->close();

function kiemTraTonTaiPrescription($conn, $table, $column, $value) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM $table WHERE $column = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return ($row["count"] > 0);
}
?>
