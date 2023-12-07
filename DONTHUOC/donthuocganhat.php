<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <title>Thông tin bệnh nhân</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        #searchInput {
            padding: 8px;
            margin-top: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<input type="text" id="searchInput" placeholder="Tìm kiếm...">

    <?php
    include 'conect.php';
    $sql = "SELECT
                BenhNhan.id_benhnhan,
                BenhNhan.HoTenBN,
                BenhNhan.NgaySinh,
                BenhNhan.GioiTinh,
                BenhNhan.DiaChi,
                DonThuoc.id_donthuoc,
                DonThuoc.NgayKeDon,
                BacSi.id_bacsi,
                BacSi.HoTenBS,
                BacSi.ChuyenMon,
                BacSi.SDT,
                ChiTietKeDon.dose,
                LieuLuong.TenThuoc,
                LieuLuong.min_single_dose,
                LieuLuong.max_single_dose,
                LieuLuong.min_daily_dose,
                LieuLuong.max_daily_dose,
                LieuLuong.min_period_dose,
                LieuLuong.max_period_dose
            FROM
                BenhNhan
            JOIN DonThuoc ON BenhNhan.id_benhnhan = DonThuoc.id_benhnhan
            JOIN BacSi ON DonThuoc.id_bacsi = BacSi.id_bacsi
            JOIN ChiTietKeDon ON DonThuoc.id_donthuoc = ChiTietKeDon.id_donthuoc
            JOIN LieuLuong ON ChiTietKeDon.id_lieuluong = LieuLuong.id_lieuluong";

    $result = $conn->query($sql);

    // Kiểm tra và hiển thị dữ liệu
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>ID Bệnh nhân</th>
                    <th>Tên bệnh nhân</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>ID Đơn thuốc</th>
                    <th>Ngày kê đơn</th>
                    <th>ID Bác sĩ</th>
                    <th>Tên bác sĩ</th>
                    <th>Chuyên môn</th>
                    <th>SĐT Bác sĩ</th>
                    <th>Dose</th>
                    <th>Tên thuốc</th>
                    <th>Min Single Dose</th>
                    <th>Max Single Dose</th>
                    <th>Min Daily Dose</th>
                    <th>Max Daily Dose</th>
                    <th>Min Period Dose</th>
                    <th>Max Period Dose</th>
                    <th>Max Thao Tác</th>
                </tr>
            </thead>";

        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id_benhnhan']}</td>
                    <td>{$row['HoTenBN']}</td>
                    <td>{$row['NgaySinh']}</td>
                    <td>{$row['GioiTinh']}</td>
                    <td>{$row['DiaChi']}</td>
                    <td>{$row['id_donthuoc']}</td>
                    <td>{$row['NgayKeDon']}</td>
                    <td>{$row['id_bacsi']}</td>
                    <td>{$row['HoTenBS']}</td>
                    <td>{$row['ChuyenMon']}</td>
                    <td>{$row['SDT']}</td>
                    <td>{$row['dose']}</td>
                    <td>{$row['TenThuoc']}</td>
                    <td>{$row['min_single_dose']}</td>
                    <td>{$row['max_single_dose']}</td>
                    <td>{$row['min_daily_dose']}</td>
                    <td>{$row['max_daily_dose']}</td>
                    <td>{$row['min_period_dose']}</td>
                    <td>{$row['max_period_dose']}</td>
                    <td>
                        <a href='delete.php?id={$row['id_benhnhan']}'>Delete</a>
                    </td>
                </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Không có dữ liệu.";
    }

    // Đóng kết nối
    $conn->close();
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tham chiếu đến ô input tìm kiếm
            var searchInput = document.getElementById("searchInput");

            // Lắng nghe sự kiện khi có sự thay đổi trong ô input
            searchInput.addEventListener("input", function() {
                // Lấy giá trị nhập liệu từ ô tìm kiếm
                var keyword = searchInput.value.toLowerCase();

                // Lấy tất cả các dòng trong tbody của bảng
                var rows = document.querySelectorAll("tbody tr");

                // Lặp qua từng dòng và ẩn hiện dựa trên từ khóa tìm kiếm
                rows.forEach(function(row) {
                    var shouldShow = false;

                    // Lấy tất cả các ô trong dòng hiện tại
                    var cells = row.getElementsByTagName("td");

                    // Lặp qua từng ô và kiểm tra xem có từ khóa tìm kiếm không
                    Array.from(cells).forEach(function(cell) {
                        if (cell.textContent.toLowerCase().includes(keyword)) {
                            shouldShow = true;
                        }
                    });

                    // Ẩn/Hiện dòng dựa trên kết quả tìm kiếm
                    if (shouldShow) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>
</body>
</html>
