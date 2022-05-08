<?php
$ProductID = $_GET['ProductID'];
$sql = "DELETE FROM news where ProductID = $ProductID";
$query = mysqli_query($connect, $sql);
header('location: QLBaiViet-user.php?page_layout=danhsach.php');
?>