<!-- edit_patient_form.php -->
<form action="process_patient_data.php" method="post">
    ID của bệnh nhân: <input type="number" name="id_benhnhan"><br>
    Họ và tên: <input type="text" name="hoten"><br>
    Ngày sinh: <input type="date" name="ngaysinh"><br>
    Giới tính: <input type="text" name="gioitinh"><br>
    Địa chỉ: <input type="text" name="diachi"><br>
    <input type="hidden" name="action" value="suabenhnhan">
    <input type="submit" value="Sửa bệnh nhân">
</form>
