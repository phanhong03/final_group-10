<?php
$host = "localhost";
$port = 3306; // Thay đổi thành cổng 3306 c
$username = "root";
$password = "";
$dbname = "login"; //doithanh login

$conn = new mysqli($host, $username, $password, $dbname, $port);
?>