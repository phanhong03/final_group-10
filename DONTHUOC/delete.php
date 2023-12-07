<?php
include 'conect.php';
// Kiểm tra xem có tham số id được truyền vào không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa dữ liệu từ bảng con trước
    $sql_delete_chitiet = "DELETE FROM ChiTietKeDon WHERE id_donthuoc IN (SELECT id_donthuoc FROM DonThuoc WHERE id_benhnhan = $id)";
    $result_delete_chitiet = $conn->query($sql_delete_chitiet);

    // Tiếp theo, xóa dữ liệu từ bảng cha
    $sql_delete_don = "DELETE FROM DonThuoc WHERE id_benhnhan = $id";
    $result_delete_don = $conn->query($sql_delete_don);

    // Tiếp theo, xóa dữ liệu từ bảng cha của DonThuoc (BenhNhan)
    $sql_delete_benhnhan = "DELETE FROM BenhNhan WHERE id_benhnhan = $id";
    $result_delete_benhnhan = $conn->query($sql_delete_benhnhan);

    if ($result_delete_benhnhan) {
        header("Xóa thành công");
    } else {
        echo "Lỗi xóa từ bảng BenhNhan: " . $conn->error;
    }
} else {
    echo "ID không được cung cấp.";
}

?>
