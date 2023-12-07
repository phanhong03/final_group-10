<!-- index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý bệnh nhân</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }
  </style>
</head>

<body>
  <h2>Danh sách bệnh nhân</h2>

  <?php include 'display_patients.php'; ?>

  <h2>Nhập thông tin bệnh nhân</h2>
  <?php include 'add_patient_form.php'; ?>

  <h2>Sửa thông tin bệnh nhân</h2>
  <?php include 'edit_patient_form.php'; ?>

  <?php include 'process_patient_data.php'; ?>

  <h2>Danh sách bác sĩ</h2>
  <?php include 'display_doctors.php'; ?>


  <h2>Danh sách đơn thuốc</h2>
  <?php include 'display_prescriptions.php'; ?>

  <h2>Thêm đơn thuốc</h2>
  <?php include 'add_prescription_form.php'; ?>

  <?php include 'edit_prescription_form.php'; ?>

  <?php include 'process_prescription_data.php'; ?>

</body>

</html>