<!-- delete_patient_form.php -->
<form action='process_patient_data.php' method='post'>
    <h2>Xóa thông tin bệnh nhân</h2>
    ID của bệnh nhân: <input type='number' name='id_benhnhan' required><br>
    
    <!-- Thêm dòng xác nhận xóa vào đây -->
    <input type='hidden' name='confirm_xoa' value='1'>
    
    <input type='hidden' name='action' value='xoabenhnhan'>
    <input type='submit' value='Xác nhận Xóa'>
</form>
