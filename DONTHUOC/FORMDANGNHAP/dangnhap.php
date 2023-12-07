
<?php
include 'ketnoi.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Mã hóa mật khẩu bằng md5
    $check_query = "SELECT * FROM user_management WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        header("Location: /DONTHUOC/trangds.php?username=" .$username);
    } else {
        echo "Tên người dùng hoặc mật khẩu không đúng.";
    }
}
?>
