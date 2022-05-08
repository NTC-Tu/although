<?php
$user_ID = $_GET['user_ID'];
$sql = "DELETE FROM users where user_ID = $user_ID";
$query = mysqli_query($connect, $sql);
header('location: QLTaikhoan.php?page_layout=danhsach.php');
?>