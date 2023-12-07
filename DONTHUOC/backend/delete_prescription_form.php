<!-- delete_prescription_form.php -->
<form action="process_prescription_data.php" method="post">
    <h2>Xóa thông tin đơn thuốc</h2>
    Đơn thuốc ID: <input type="number" name="id_donthuoc" required><br>
    
    <input type="hidden" name="action" value="xoadonthuoc">
    <input type="submit" value="Xóa đơn thuốc">
</form>
