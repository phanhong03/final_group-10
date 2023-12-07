<!DOCTYPE html>
<html lang="vi" style="
    background-position: center;
    /* background-size: cover; */
    background-attachment: fixed;
    background-image: url('https://caodangyduochcm.edu.vn/wp-content/uploads/2018/10/thuoc-ke-don.jpg');
">
<head>
  <meta charset="UTF-8">
  <title>Mẫu đơn thuốc</title>
</head>
<link rel="stylesheet" href="style.css">


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
    <!-- <marquee>Chào mừng <?php echo $username?> đă đến với webside đăng ký thông tin sinh viên , chúc bạn ngày mới tốt lành !</marquee>
  <h1>hellô</h1> -->
  <div class="container">
  <div class="header" style="
    background-color: white;
">
    <h1 style="color: RED;">KÊ ĐƠN THUỐC</h1>
    
    </div>
    <div class="body">
      <table>
        <tr>
          <th>Họ Tên BN:</th>
          <td> <input type="text" id="input1" name="tenKhachHang"></td>
           <style>
    /* Ẩn khung xung quanh của trường nhập */
    #input1{
        font-family: 'Times New Roman', serif;
    border: none;
    outline: none;
    font-size: 18px;

    }
    input {
    font-family: 'Times New Roman', serif;
    border: none;
    outline: none;
    font-size: 14.99px;

    }</style>
        </tr>
        <tr>
          <th>Giới tính:</th>
          <td>  <input type="radio" id="nam" name="gioiTinh" value="Nam">
            <label for="nam">Nam</label>
          
            <input type="radio" id="nu" name="gioiTinh" value="Nữ">
            <label for="nu">Nữ</label></td>
        </tr>
        <tr>
          <th>Tuổi:</th>
          <td>
            <label for="tuoi"></label>
            <input type="number" id="input1" name="tuoi" min="1" max="120"></td>
        </tr>
        <tr>
          <th>Địa chỉ:</th>
          <td><input type="text" id="input1" name="diachi"></td>
        </tr>
        <tr>
          <th>Mã BN:</th>
          <td><input type="text" id="input1" name="tenKhachHang"></td>
        </tr>
        <tr>
          <th>Ngày kê:</th>
          <td>  <label for="ngayKham"></label>
            <input type="date" id="input1" name="ngayKham"></td>
        </tr>
        
        <tr>
          <th style="color: red">Chẩn Đoán:</th>
          <td><input type="text" id="input1" name="chandoan"></td>
        </tr>
      </table>
      <br>
      <table>
        <table id="medicineTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên thuốc</th>
                    <th>Liều lượng</th>
                    <th>Cách dùng</th>
                  
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu sẽ được thêm vào đây -->
            </tbody>
        </table>
        
        <button onclick="themDong()">Thêm Dòng</button>
        
        <script>
            function themDong() {
                // Lấy ra bảng và tbody
                var table = document.getElementById("medicineTable");
                var tbody = table.getElementsByTagName("tbody")[0];
        
                // Tạo một dòng mới
                var newRow = tbody.insertRow();
        
                // Thêm ô cho STT
                var sttCell = newRow.insertCell(0);
                sttCell.innerHTML = tbody.rows.length;
        
                // Thêm ô cho Tên thuốc
                var tenThuocCell = newRow.insertCell(1);
                tenThuocCell.innerHTML = '<input type="text">';
        
                // Thêm ô cho Liều lượng
                var lieuLuongCell = newRow.insertCell(2);
                lieuLuongCell.innerHTML = '<input type="text">';
        
                // Thêm ô cho Cách dùng
                var cachDungCell = newRow.insertCell(3);
                cachDungCell.innerHTML = '<input type="text">';
        
                // Thêm ô cho nút Xóa
                var deleteCell = newRow.insertCell(4);
                deleteCell.innerHTML = '<button onclick="xoaDong(this)">Xóa</button>';
            }
        
            function xoaDong(button) {
                // Lấy ra hàng cha (tr) của nút được bấm
                var row = button.parentNode.parentNode;
        
                // Lấy ra tbody chứa dòng đó
                var tbody = row.parentNode;
        
                // Xóa dòng khỏi tbody
                tbody.removeChild(row);
        
                // Cập nhật lại STT cho các dòng còn lại
                capNhatSTT();
            }
        
            function capNhatSTT() {
                var table = document.getElementById("medicineTable");
                var tbody = table.getElementsByTagName("tbody")[0];
        
                // Duyệt qua tất cả các dòng và cập nhật STT
                for (var i = 0; i < tbody.rows.length; i++) {
                    tbody.rows[i].cells[0].innerHTML = i + 1;
                }
            }
        </script>
      </table>
      <br>
      
      <br>
      <table>
        <tr>
          <h4>Lời dặn</h4>
          <td><textarea id="instructions" name="instructions" rows="3" required=""></textarea></td>
        </tr>
        <style>
            #instructions{
                width: 670px;
                font-family: 'Times New Roman', serif;
                border: none;
                outline: none;
                font-size: 18px;
            }

        </style>
      </table>
      <br>
      <table>
        <tr>
          <th>Bác sĩ điều trị</th>
          <td>
            <p>
              BS.<?php echo $username?>
            </p>
          </td>
        </tr>
      </table>
      <br>
      <table>
        <tr>
          <v>-Nếu có triệu chứng bất thường vui lòng đến cơ sở y tế gần nhất</v>
        </tr>
      </table>
      <br>
      <table>
        <tr>
          <v>-Khám lại xin đem theo đơn này</v>
        </tr>
      </table>
    </div>
  </div>
  <style>
    v{
    font-weight: bold;
    color: blue;

    }
</style>
<br>
<br>
<button type="button" class="print" onclick="window.print()">In đơn thuốc</button>
<div class="buttons">
    <a href="trangds.php?username=<?php echo urlencode($username); ?>" class="button">Quay lại</a>
  </div>
  <style>
    .buttons {
  text-align: center;
  margin: 20px;
}

.button {
  display: inline-block;
  padding: 10px 20px;
  text-decoration: none;
  color: #fff;
  background-color: #0017ff;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: #2980b9;
}

  </style>
</body>

</html>
