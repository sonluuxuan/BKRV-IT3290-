
<?php
//header("Content-type: text/html; charset=utf-8");
$server_username = "root"; // điền username đăng nhập mysql
$server_password = ""; // điền password đăng nhập mysql
$server_host = "localhost";// điền tện host
$database = "BKRV"; // tên database

// tạo biến kết nối tới database
$conn = mysqli_connect($server_host,$server_username,$server_password,$database) or die("cannot connect to database");
mysqli_set_charset($conn, 'UTF8');
?>
