<!-- edit_prescription_form.php -->
<form action="process_prescription_data.php" method="post">
    <h2>Sửa thông tin đơn thuốc</h2>
    Đơn thuốc ID: <input type="number" name="id_donthuoc" required><br>
    Bệnh nhân ID: <input type="number" name="id_benhnhan" required><br>
    Bác sĩ ID: <input type="number" name="id_bacsi" required><br>
    Ngày kê đơn: <input type="date" name="ngaykedon" required><br>

    <!-- Thêm các trường khác của đơn thuốc nếu cần -->

    <input type="hidden" name="action" value="suadonthuoc">
    <input type="submit" value="Sửa đơn thuốc">
</form>
