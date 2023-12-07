<!-- add_patient_form.php -->
<form action="process_prescription_data.php" method="post">
    ID bệnh nhân: <input type="text" name="id_benhnhan"><br>
    ID Bác sĩ: <input type="text" name="id_bacsi"><br>
    Ngày kê đơn: <input type="date" name="NgayKeDon"><br>
    <input type="hidden" name="action" value="themdonthuoc">
    <input type="submit" value="Thêm đơn thuốc">
</form>
