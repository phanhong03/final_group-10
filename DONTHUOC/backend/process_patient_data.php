<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "username", "password", "KDT");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra hành động
    $action = $_POST["action"];

    if ($action == "thembenhnhan") {
        // Lấy dữ liệu từ form và sử dụng prepared statements
        $hoten = $conn->real_escape_string($_POST["hoten"]);
        $ngaysinh = $conn->real_escape_string($_POST["ngaysinh"]);
        $gioitinh = $conn->real_escape_string($_POST["gioitinh"]);
        $diachi = $conn->real_escape_string($_POST["diachi"]);

        $result = $conn->query("SELECT MAX(id_benhnhan) AS max_id FROM BenhNhan");
        $row = $result->fetch_assoc();
        $next_id = $row["max_id"] + 1;

        // Thực hiện truy vấn SQL để thêm bệnh nhân mới sử dụng prepared statement
        $stmt = $conn->prepare("INSERT INTO BenhNhan (HoTenBN, NgaySinh, GioiTinh, DiaChi) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $hoten, $ngaysinh, $gioitinh, $diachi);

        if ($stmt->execute()) {
            // Chuyển hướng sau khi thêm thành công
            header("Location: index.php");
            exit();
        } else {
            echo "Lỗi khi thêm bệnh nhân: " . $stmt->error;
        }
    } elseif ($action == "suabenhnhan") {
        $id_benhnhan = $_POST["id_benhnhan"];
        $hoten = $conn->real_escape_string($_POST["hoten"]);
        $ngaysinh = $conn->real_escape_string($_POST["ngaysinh"]);
        $gioitinh = $conn->real_escape_string($_POST["gioitinh"]);
        $diachi = $conn->real_escape_string($_POST["diachi"]);

        // Kiểm tra xem bệnh nhân có tồn tại không
        $benh_nhan_ton_tai = kiemTraTonTaiPatient($conn, 'BenhNhan', 'id_benhnhan', $id_benhnhan);

        if (!$benh_nhan_ton_tai) {
            // Thông báo lỗi và thêm nút "Quay lại"
            echo "<p>Lỗi: Bệnh nhân có ID $id_benhnhan không tồn tại. <a href='index.php'>Quay lại</a></p>";
        } else {
            // Thực hiện truy vấn SQL để sửa bệnh nhân
            $stmt = $conn->prepare("UPDATE BenhNhan SET HoTenBN = ?, NgaySinh = ?, GioiTinh = ?, DiaChi = ? WHERE id_benhnhan = ?");
            $stmt->bind_param("ssssi", $hoten, $ngaysinh, $gioitinh, $diachi, $id_benhnhan);

            if ($stmt->execute()) {
                // Sửa thành công, hiển thị nút "Quay lại"
                header("Location: index.php");
                exit();
            } else {
                echo "Lỗi khi sửa bệnh nhân: " . $stmt->error;
            }
        }
    } elseif ($action == "xoabenhnhan") {
        // Lấy ID của bệnh nhân cần xóa
        $id_benhnhan = $_POST["id_benhnhan"];

        // Kiểm tra xem bệnh nhân có tồn tại không
        $benh_nhan_ton_tai = kiemTraTonTaiPatient($conn, 'BenhNhan', 'id_benhnhan', $id_benhnhan);

        if (!$benh_nhan_ton_tai) {
            echo "<p>Lỗi: Bệnh nhân có ID $id_benhnhan không tồn tại.<br> <a href='index.php'>Quay lại</a></p>";
        } else {
            // Hiển thị form xác nhận xóa hoặc thực hiện xóa trực tiếp
            echo "<form action='process_patient_data.php' method='post'>";
            echo "<input type='hidden' name='action' value='xoabenhnhan'>";
            echo "<input type='hidden' name='id_benhnhan' value='$id_benhnhan'>";
            echo "<p>Bạn có chắc chắn muốn xóa bệnh nhân có ID $id_benhnhan không?</p>";

            // Thêm dòng này để xác nhận xóa
            echo "<input type='hidden' name='confirm_xoa' value='1'>";

            echo "<input type='submit' value='Xác nhận Xóa'>";
            echo "<a href='index.php'><button type='button'>Quay lại</button></a>";
            echo "</form>";

            // Nếu có xác nhận xóa, thực hiện xóa và chuyển hướng
            if (isset($_POST["confirm_xoa"])) {
                // Thực hiện truy vấn SQL để xóa bệnh nhân sử dụng prepared statement
                $stmt = $conn->prepare("DELETE FROM BenhNhan WHERE id_benhnhan = ?");
                $stmt->bind_param("i", $id_benhnhan);

                if ($stmt->execute()) {
                    // Chuyển hướng sau khi xóa thành công
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Lỗi khi xóa bệnh nhân: " . $stmt->error;
                }
            }
        }
    }
}

// Đóng kết nối
$conn->close();
function kiemTraTonTaiPatient($conn, $table, $column, $value) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM $table WHERE $column = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return ($row["count"] > 0);
}
?>